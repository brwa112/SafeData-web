<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages\Gallery;
use App\Models\Pages\GalleryCategory;
use App\Models\Pages\Branch;
use App\Http\Requests\GalleryRequest;
use App\Traits\HandlesSorting;

class GalleryController extends Controller
{
    use HandlesSorting;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Gallery::class);

        $filters = $this->getFilters($request);

        $query = Gallery::query()
            ->with(['user', 'branch', 'category'])
            ->withTrashed()
            ->search($filters['search'])
            ->filterByDateRange($filters['start_date'], $filters['end_date'])
            ->filterByBranch($filters['branch_id'])
            ->filterByCategory($filters['category_id']);

        $this->applySortingToQuery($query, $filters['sort_by'], $filters['sort_direction'], $this->getSortableFields());

        $gallery = $query->paginate($filters['number_rows']);

        return inertia('Pages/Gallery/Index', array_merge([
            'gallery' => $gallery,
            'filter' => $filters,
        ], $this->getListings()));
    }

    protected function getSortableFields(): array
    {
        return [
            'id' => $this->simpleSort('galleries.id'),
            'title' => $this->simpleSort('galleries.title'),
            'order' => $this->simpleSort('galleries.order'),
            'created_at' => $this->simpleSort('galleries.created_at'),

            'branch.name' => $this->relatedSort(Branch::class, 'name', 'id', 'galleries.branch_id'),
            'category.name' => $this->relatedSort(GalleryCategory::class, 'name', 'id', 'galleries.gallery_category_id'),
        ];
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

        $categories = GalleryCategory::where('is_active', true)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->getTranslations('name'),
                    'slug' => $category->slug,
                ];
            });

        return [
            'branches' => $branches,
            'categories' => $categories,
        ];
    }

    public function store(GalleryRequest $request)
    {
        $this->authorize('create', Gallery::class);

        $data = $request->validated();


        $gallery = Gallery::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $gallery->addMedia($image)
                    ->preservingOriginal()
                    ->toMediaCollection('images');
            }
        }

        return redirect()->back();
    }

    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $this->authorize('update', $gallery);

        $data = $request->validated();


        $gallery->update($data);

        // Handle deleted images
        if ($request->input('deleted_image_ids') && is_array($request->input('deleted_image_ids'))) {
            foreach ($request->input('deleted_image_ids') as $mediaId) {
                $media = $gallery->getMedia('images')->where('id', $mediaId)->first();
                if ($media) {
                    $media->delete();
                }
            }
        } elseif ($request->input('remove_images')) {
            $gallery->clearMediaCollection('images');
        }

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $gallery->addMedia($image)
                    ->preservingOriginal()
                    ->toMediaCollection('images');
            }
        }

        return redirect()->back();
    }

    public function destroy(Gallery $gallery)
    {
        $this->authorize('delete', $gallery);

        $gallery->delete();

        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $gallery = Gallery::withTrashed()->findOrFail($id);

        // Authorize force delete explicitly (policy has a forceDelete method)
        $this->authorize('forceDelete', $gallery);

        $gallery->clearMediaCollection('images');

        $gallery->forceDelete();

        return redirect()->back();
    }

    public function restore($id)
    {
        $gallery = Gallery::withTrashed()->findOrFail($id);

        $this->authorize('restore', $gallery);

        $gallery->restore();

        return redirect()->back();
    }
}
