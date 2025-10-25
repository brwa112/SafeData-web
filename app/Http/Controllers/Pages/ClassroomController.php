<?php

namespace App\Http\Controllers\Pages;

use App\Models\Pages\Classroom;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Models\Pages\Branch;
use App\Models\System\Users\User;
use App\Traits\HandlesSorting;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    use HandlesSorting;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Classroom::class);

        $filters = $this->getFilters($request);

        $query = Classroom::query()
            ->with(['user', 'branch'])
            ->withTrashed()
            ->search($filters['search'])
            ->filterByDateRange($filters['start_date'], $filters['end_date']);

        $this->applySortingToQuery($query, $filters['sort_by'], $filters['sort_direction'], $this->getSortableFields());

        $classrooms = $query->paginate($filters['number_rows']);

        return inertia('Pages/Classroom/Index', [
            'classrooms' => $classrooms,
            'filter' => $filters,
            ...$this->getListings(),
        ]);
    }

    private function getSortableFields(): array
    {
        return [
            // Simple column sorting (classrooms table)
            'id' => $this->simpleSort('classrooms.id'),
            'title' => $this->simpleSort('classrooms.title'),
            'views' => $this->simpleSort('classrooms.views'),
            'order' => $this->simpleSort('classrooms.order'),
            'created_at' => $this->simpleSort('classrooms.created_at'),
            'updated_at' => $this->simpleSort('classrooms.updated_at'),

            // Related model sorting
            'user.name' => $this->relatedSort(
                User::class,
                'name',
                'id',
                'classrooms.user_id'
            ),
            'branch.name' => $this->relatedSort(
                Branch::class,
                'name',
                'id',
                'classrooms.branch_id'
            ),
        ];
    }

    public function store(ClassroomRequest $request)
    {
        $this->authorize('create', Classroom::class);

        $data = $request->validated();

        $Classroom = Classroom::create($data);

        // Handle images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $Classroom->addMedia($image)
                    ->preservingOriginal()
                    ->toMediaCollection('images');
                
                // Log media addition
                $Classroom->logMediaAddition($image->getClientOriginalName());
            }
        }

        return redirect()->back();
    }

    public function update(ClassroomRequest $request, Classroom $Classroom)
    {
        $this->authorize('update', $Classroom);

        $data = $request->validated();

        $Classroom->update($data);

        // Handle images upload
        if ($request->hasFile('images')) {
            // Delete specific images by ID if provided
            if ($request->input('deleted_image_ids') && is_array($request->input('deleted_image_ids'))) {
                foreach ($request->input('deleted_image_ids') as $mediaId) {
                    $media = $Classroom->getMedia('images')->where('id', $mediaId)->first();
                    if ($media) {
                        $fileName = $media->file_name;
                        $media->delete();
                        // Log media deletion
                        $Classroom->logMediaDeletion($fileName);
                    }
                }
            } elseif ($request->input('remove_images')) {
                // Clear all existing images if remove_images flag is set
                $oldImages = $Classroom->getMedia('images');
                $Classroom->clearMediaCollection('images');
                // Log bulk deletion
                foreach ($oldImages as $media) {
                    $Classroom->logMediaDeletion($media->file_name);
                }
            }

            // Add new images
            foreach ($request->file('images') as $image) {
                $Classroom->addMedia($image)
                    ->preservingOriginal()
                    ->toMediaCollection('images');
                
                // Log media addition
                $Classroom->logMediaAddition($image->getClientOriginalName());
            }
        } elseif ($request->input('deleted_image_ids') && is_array($request->input('deleted_image_ids'))) {
            // Delete specific images even if no new images are being uploaded
            foreach ($request->input('deleted_image_ids') as $mediaId) {
                $media = $Classroom->getMedia('images')->where('id', $mediaId)->first();
                if ($media) {
                    $fileName = $media->file_name;
                    $media->delete();
                    // Log media deletion
                    $Classroom->logMediaDeletion($fileName);
                }
            }
        } elseif ($request->input('remove_images')) {
            // Only clear all images if no new images are being uploaded
            $oldImages = $Classroom->getMedia('images');
            $Classroom->clearMediaCollection('images');
            // Log bulk deletion
            foreach ($oldImages as $media) {
                $Classroom->logMediaDeletion($media->file_name);
            }
        }

        return redirect()->back();
    }

    public function destroy(Classroom $Classroom)
    {
        $this->authorize('delete', $Classroom);

        $Classroom->delete();

        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $Classroom = Classroom::withTrashed()->findOrFail($id);

        $this->authorize('delete', $Classroom);

        // Delete all associated media
        $Classroom->clearMediaCollection('images');

        // Permanently delete the Classroom
        $Classroom->forceDelete();

        return redirect()->back();
    }

    public function restore($id)
    {
        $Classroom = Classroom::withTrashed()->findOrFail($id);

        $this->authorize('restore', $Classroom);

        $Classroom->restore();

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

