<?php

namespace App\Http\Controllers\Pages;

use App\Models\Pages\Campus;
use App\Http\Controllers\Controller;
use App\Http\Requests\CampusRequest;
use App\Models\Pages\Branch;
use App\Models\System\Users\User;
use App\Traits\HandlesSorting;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    use HandlesSorting;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Campus::class);

        $filters = $this->getFilters($request);

        $query = Campus::query()
            ->with(['user', 'branch'])
            ->withTrashed()
            ->search($filters['search'])
            ->filterByDateRange($filters['start_date'], $filters['end_date'])
            ->filterByBranch($filters['branch_id']);

        $this->applySortingToQuery($query, $filters['sort_by'], $filters['sort_direction'], $this->getSortableFields());

        $campuses = $query->paginate($filters['number_rows']);

        return inertia('Pages/Campus/Index', [
            'campuses' => $campuses,
            'filter' => $filters,
            ...$this->getListings(),
        ]);
    }

    private function getSortableFields(): array
    {
        return [
            // Simple column sorting (campuses table)
            'id' => $this->simpleSort('campuses.id'),
            'title' => $this->simpleSort('campuses.title'),
            'views' => $this->simpleSort('campuses.views'),
            'order' => $this->simpleSort('campuses.order'),
            'created_at' => $this->simpleSort('campuses.created_at'),
            'updated_at' => $this->simpleSort('campuses.updated_at'),

            // Related model sorting
            'user.name' => $this->relatedSort(
                User::class,
                'name',
                'id',
                'campuses.user_id'
            ),
            'branch.name' => $this->relatedSort(
                Branch::class,
                'name',
                'id',
                'campuses.branch_id'
            ),
        ];
    }

    public function store(CampusRequest $request)
    {
        $this->authorize('create', Campus::class);

        $data = $request->validated();

        $campus = Campus::create($data);

        // Handle images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $campus->addMedia($image)
                    ->preservingOriginal()
                    ->toMediaCollection('images');
                
                // Log media addition
                $campus->logMediaAddition($image->getClientOriginalName());
            }
        }

        return redirect()->back();
    }

    public function update(CampusRequest $request, Campus $campus)
    {
        $this->authorize('update', $campus);

        $data = $request->validated();

        $campus->update($data);

        // Handle images upload
        if ($request->hasFile('images')) {
            // Delete specific images by ID if provided
            if ($request->input('deleted_image_ids') && is_array($request->input('deleted_image_ids'))) {
                foreach ($request->input('deleted_image_ids') as $mediaId) {
                    $media = $campus->getMedia('images')->where('id', $mediaId)->first();
                    if ($media) {
                        $fileName = $media->file_name;
                        $media->delete();
                        // Log media deletion
                        $campus->logMediaDeletion($fileName);
                    }
                }
            } elseif ($request->input('remove_images')) {
                // Clear all existing images if remove_images flag is set
                $oldImages = $campus->getMedia('images');
                $campus->clearMediaCollection('images');
                // Log bulk deletion
                foreach ($oldImages as $media) {
                    $campus->logMediaDeletion($media->file_name);
                }
            }

            // Add new images
            foreach ($request->file('images') as $image) {
                $campus->addMedia($image)
                    ->preservingOriginal()
                    ->toMediaCollection('images');
                
                // Log media addition
                $campus->logMediaAddition($image->getClientOriginalName());
            }
        } elseif ($request->input('deleted_image_ids') && is_array($request->input('deleted_image_ids'))) {
            // Delete specific images even if no new images are being uploaded
            foreach ($request->input('deleted_image_ids') as $mediaId) {
                $media = $campus->getMedia('images')->where('id', $mediaId)->first();
                if ($media) {
                    $fileName = $media->file_name;
                    $media->delete();
                    // Log media deletion
                    $campus->logMediaDeletion($fileName);
                }
            }
        } elseif ($request->input('remove_images')) {
            // Only clear all images if no new images are being uploaded
            $oldImages = $campus->getMedia('images');
            $campus->clearMediaCollection('images');
            // Log bulk deletion
            foreach ($oldImages as $media) {
                $campus->logMediaDeletion($media->file_name);
            }
        }

        return redirect()->back();
    }

    public function destroy(Campus $campus)
    {
        $this->authorize('delete', $campus);

        $campus->delete();

        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $campus = Campus::withTrashed()->findOrFail($id);

        $this->authorize('delete', $campus);

        // Delete all associated media
        $campus->clearMediaCollection('images');

        // Permanently delete the campus
        $campus->forceDelete();

        return redirect()->back();
    }

    public function restore($id)
    {
        $campus = Campus::withTrashed()->findOrFail($id);

        $this->authorize('restore', $campus);

        $campus->restore();

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

        return [
            'branches' => $branches,
        ];
    }
}

