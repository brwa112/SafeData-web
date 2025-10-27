<?php

namespace App\Http\Controllers\Pages;

use App\Models\Pages\News;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\Pages\Branch;
use App\Models\Pages\Category;
use App\Models\Pages\Hashtag;
use App\Models\System\Users\User;
use App\Traits\HandlesSorting;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use HandlesSorting;

    public function index(Request $request)
    {
        $this->authorize('viewAny', News::class);

        $filters = $this->getFilters($request);

        $query = News::query()
            ->with(['user', 'branch', 'category', 'hashtags'])
            ->withTrashed()
            ->search($filters['search'])
            ->filterByDateRange($filters['start_date'], $filters['end_date'])
            ->filterByBranch($filters['branch_id'])
            ->filterByCategory($filters['category_id'])
            ->filterByHashtags($filters['hashtag_ids']);

        $this->applySortingToQuery($query, $filters['sort_by'], $filters['sort_direction'], $this->getSortableFields());

        $news = $query->paginate($filters['number_rows']);

        return inertia('Pages/News/Index', [
            'news' => $news,
            'filter' => $filters,
            ...$this->getListings(),
        ]);
    }

    private function getSortableFields(): array
    {
        return [
            // Simple column sorting (news table)
            'id' => $this->simpleSort('news.id'),
            'title' => $this->simpleSort('news.title'),
            'views' => $this->simpleSort('news.views'),
            'order' => $this->simpleSort('news.order'),
            'created_at' => $this->simpleSort('news.created_at'),
            'updated_at' => $this->simpleSort('news.updated_at'),

            // Related model sorting
            'user.name' => $this->relatedSort(
                User::class,
                'name',
                'id',
                'news.user_id'
            ),
            'branch.name' => $this->relatedSort(
                Branch::class,
                'name',
                'id',
                'news.branch_id'
            ),
            'category.name' => $this->relatedSort(
                Category::class,
                'name',
                'id',
                'news.category_id'
            ),
        ];
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
            $hashtag = Hashtag::find($hashtagId);
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
                
                // Log media addition
                $news->logMediaAddition($image->getClientOriginalName());
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
            $hashtag = Hashtag::find($hashtagId);
            if ($hashtag) {
                $hashtag->decrementUsage();
            }
        }

        // Increment new hashtags that were added
        $addedHashtagIds = array_diff($hashtagIds, $oldHashtagIds);
        foreach ($addedHashtagIds as $hashtagId) {
            $hashtag = Hashtag::find($hashtagId);
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
                        $fileName = $media->file_name;
                        $media->delete();
                        // Log media deletion
                        $news->logMediaDeletion($fileName);
                    }
                }
            } elseif ($request->input('remove_images')) {
                // Clear all existing images if remove_images flag is set
                $oldImages = $news->getMedia('images');
                $news->clearMediaCollection('images');
                // Log bulk deletion
                foreach ($oldImages as $media) {
                    $news->logMediaDeletion($media->file_name);
                }
            }

            // Add new images
            foreach ($request->file('images') as $image) {
                $news->addMedia($image)
                    ->preservingOriginal()
                    ->toMediaCollection('images');
                
                // Log media addition
                $news->logMediaAddition($image->getClientOriginalName());
            }
        } elseif ($request->input('deleted_image_ids') && is_array($request->input('deleted_image_ids'))) {
            // Delete specific images even if no new images are being uploaded
            foreach ($request->input('deleted_image_ids') as $mediaId) {
                $media = $news->getMedia('images')->where('id', $mediaId)->first();
                if ($media) {
                    $fileName = $media->file_name;
                    $media->delete();
                    // Log media deletion
                    $news->logMediaDeletion($fileName);
                }
            }
        } elseif ($request->input('remove_images')) {
            // Only clear all images if no new images are being uploaded
            $oldImages = $news->getMedia('images');
            $news->clearMediaCollection('images');
            // Log bulk deletion
            foreach ($oldImages as $media) {
                $news->logMediaDeletion($media->file_name);
            }
        }

        return redirect()->back();
    }

    public function destroy(News $news)
    {
        $this->authorize('delete', $news);

        $news->delete();

        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $news = News::withTrashed()->findOrFail($id);

        $this->authorize('delete', $news);

        // Delete all associated media
        $news->clearMediaCollection('images');

        // Permanently delete the news
        $news->forceDelete();

        return redirect()->back();
    }

    public function restore($id)
    {
        $news = News::withTrashed()->findOrFail($id);

        $this->authorize('restore', $news);

        $news->restore();

        return redirect()->back();
    }

    protected function getListings(): array
    {
        $branches = Branch::where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(function ($branch) {
                return [
                    'id' => $branch->id,
                    'name' => $branch->getTranslations('name'),
                    'slug' => $branch->slug,
                ];
            });

        $categories = Category::where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->getTranslations('name'),
                    'slug' => $category->slug,
                ];
            });

        $hashtags = Hashtag::where('is_active', true)
            ->orderBy('name')
            ->get()
            ->map(function ($hashtag) {
                return [
                    'id' => $hashtag->id,
                    'name' => $hashtag->getTranslations('name'),
                    'slug' => $hashtag->slug,
                ];
            });

        return [
            'branches' => $branches,
            'categories' => $categories,
            'hashtags' => $hashtags,
        ];
    }
}

