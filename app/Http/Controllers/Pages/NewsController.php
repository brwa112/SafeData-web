<?php

namespace App\Http\Controllers\Pages;

use App\Models\Pages\News;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Traits\HandlesSorting;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use LogsActivity, HandlesSorting;

    public function index(Request $request)
    {
        $this->authorize('viewAny', News::class);

        $filters = $this->getFilters($request);

        $news = News::query()
            ->with(['user', 'branch', 'category', 'hashtags'])
            ->search($filters['search'])
            ->filterByDateRange($filters['start_date'], $filters['end_date'])
            ->when($filters['branch_id'], function ($query, $branchId) {
                $query->where('branch_id', $branchId);
            })
            ->when($filters['category_id'], function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($filters['hashtag_ids'], function ($query, $hashtagIds) {
                $ids = array_filter(explode(',', $hashtagIds));
                if (!empty($ids)) {
                    $query->whereHas('hashtags', function ($q) use ($ids) {
                        $q->whereIn('hashtags.id', $ids);
                    });
                }
            })
            ->orderBy($filters['sort_by'], $filters['sort_direction'])
            ->paginate($filters['number_rows']);

        // Get all branches for the dropdown
        $branches = \App\Models\Pages\Branch::where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(function ($branch) {
                return [
                    'id' => $branch->id,
                    'name' => $branch->getTranslations('name'),
                    'slug' => $branch->slug,
                ];
            });

        // Get all categories and hashtags for the dropdowns
        $categories = \App\Models\Pages\Category::where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->getTranslations('name'),
                    'slug' => $category->slug,
                ];
            });

        $hashtags = \App\Models\Pages\Hashtag::where('is_active', true)
            ->orderBy('name')
            ->get()
            ->map(function ($hashtag) {
                return [
                    'id' => $hashtag->id,
                    'name' => $hashtag->getTranslations('name'),
                    'slug' => $hashtag->slug,
                ];
            });

        return inertia('Pages/News/Index', [
            'news' => $news,
            'branches' => $branches,
            'categories' => $categories,
            'hashtags' => $hashtags,
            'filter' => $filters,
        ]);
    }

    public function store(NewsRequest $request)
    {
        $this->authorize('create', News::class);

        $data = $request->validated();

        // Extract hashtag IDs for many-to-many relationship
        $hashtagIds = $data['hashtag_ids'] ?? [];
        unset($data['hashtag_ids']);

        $news = News::create($data);

        // Sync hashtags (many-to-many)
        $news->hashtags()->sync($hashtagIds);

        // Update hashtag usage counts
        foreach ($hashtagIds as $hashtagId) {
            $hashtag = \App\Models\Pages\Hashtag::find($hashtagId);
            if ($hashtag) {
                $hashtag->incrementUsage();
            }
        }

        // Handle images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $news->addMedia($image)
                    ->preservingOriginal()
                    ->toMediaCollection('images');
            }
        }

        return redirect()->back();
    }

    public function update(NewsRequest $request, News $news)
    {
        $this->authorize('update', $news);

        $data = $request->validated();

        // Extract hashtag IDs for many-to-many relationship
        $hashtagIds = $data['hashtag_ids'] ?? [];
        unset($data['hashtag_ids']);

        $news->update($data);

        // Get old hashtag IDs before syncing
        $oldHashtagIds = $news->hashtags->pluck('id')->toArray();

        // Sync hashtags (many-to-many)
        $news->hashtags()->sync($hashtagIds);

        // Update hashtag usage counts
        // Decrement old hashtags that were removed
        $removedHashtagIds = array_diff($oldHashtagIds, $hashtagIds);
        foreach ($removedHashtagIds as $hashtagId) {
            $hashtag = \App\Models\Pages\Hashtag::find($hashtagId);
            if ($hashtag) {
                $hashtag->decrementUsage();
            }
        }

        // Increment new hashtags that were added
        $addedHashtagIds = array_diff($hashtagIds, $oldHashtagIds);
        foreach ($addedHashtagIds as $hashtagId) {
            $hashtag = \App\Models\Pages\Hashtag::find($hashtagId);
            if ($hashtag) {
                $hashtag->incrementUsage();
            }
        }

        // Handle images upload
        if ($request->hasFile('images')) {
            // Delete specific images by ID if provided
            if ($request->input('deleted_image_ids') && is_array($request->input('deleted_image_ids'))) {
                foreach ($request->input('deleted_image_ids') as $mediaId) {
                    $media = $news->getMedia('images')->where('id', $mediaId)->first();
                    if ($media) {
                        $media->delete();
                    }
                }
            } elseif ($request->input('remove_images')) {
                // Clear all existing images if remove_images flag is set
                $news->clearMediaCollection('images');
            }

            // Add new images
            foreach ($request->file('images') as $image) {
                $news->addMedia($image)
                    ->preservingOriginal()
                    ->toMediaCollection('images');
            }
        } elseif ($request->input('deleted_image_ids') && is_array($request->input('deleted_image_ids'))) {
            // Delete specific images even if no new images are being uploaded
            foreach ($request->input('deleted_image_ids') as $mediaId) {
                $media = $news->getMedia('images')->where('id', $mediaId)->first();
                if ($media) {
                    $media->delete();
                }
            }
        } elseif ($request->input('remove_images')) {
            // Only clear all images if no new images are being uploaded
            $news->clearMediaCollection('images');
        }

        return redirect()->back();
    }

    public function destroy(News $news)
    {
        $this->authorize('delete', $news);

        $news->delete();

        return redirect()->back();
    }

    protected function getFilters(Request $request): \Illuminate\Support\Collection
    {
        $filter = $request->query('filter', []);
        
        return collect([
            'search' => $filter['search'] ?? '',
            'number_rows' => $filter['number_rows'] ?? 10,
            'sort_by' => $filter['sort_by'] ?? 'id',
            'sort_direction' => $filter['sort_direction'] ?? 'desc',
            'start_date' => $filter['start_date'] ?? null,
            'end_date' => $filter['end_date'] ?? null,
            'branch_id' => $filter['branch_id'] ?? '',
            'category_id' => $filter['category_id'] ?? '',
            'hashtag_ids' => $filter['hashtag_ids'] ?? '',
        ]);
    }
}
