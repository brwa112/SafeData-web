<?php

namespace App\Http\Controllers;

use App\Models\Pages\GalleryCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class GalleryCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = GalleryCategory::query()->withTrashed()->withCount('galleries');

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhereRaw("JSON_EXTRACT(name, '$.en') LIKE ?", ["%{$search}%"])
                    ->orWhereRaw("JSON_EXTRACT(name, '$.ckb') LIKE ?", ["%{$search}%"])
                    ->orWhereRaw("JSON_EXTRACT(name, '$.ar') LIKE ?", ["%{$search}%"]);
            });
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'desc');
        $query->orderBy($sortBy, $sortDirection);

        // Pagination
        $perPage = $request->get('number_rows', 10);
        $categories = $query->paginate($perPage)->withQueryString();

        return Inertia::render('Pages/GalleryCategories/Index', [
            'categories' => $categories,
            'filter' => $request->only(['search', 'sort_by', 'sort_direction']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|array',
            'name.en' => 'required|string|max:255',
            'name.ckb' => 'required|string|max:255',
            'name.ar' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']['en']);
        
        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $count = 1;
        while (GalleryCategory::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        GalleryCategory::create($validated);

        return redirect()->back();
    }

    public function update(Request $request, GalleryCategory $galleryCategory)
    {
        $validated = $request->validate([
            'name' => 'required|array',
            'name.en' => 'required|string|max:255',
            'name.ckb' => 'required|string|max:255',
            'name.ar' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        // Update slug if name changed
        if ($validated['name']['en'] !== $galleryCategory->getTranslation('name', 'en')) {
            $newSlug = Str::slug($validated['name']['en']);
            $originalSlug = $newSlug;
            $count = 1;
            while (GalleryCategory::where('slug', $newSlug)->where('id', '!=', $galleryCategory->id)->exists()) {
                $newSlug = $originalSlug . '-' . $count;
                $count++;
            }
            $validated['slug'] = $newSlug;
        }

        $galleryCategory->update($validated);

        return redirect()->back();
    }

    public function destroy(GalleryCategory $galleryCategory)
    {
        $galleryCategory->delete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $galleryCategory = GalleryCategory::withTrashed()->findOrFail($id);
        $galleryCategory->restore();
        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $galleryCategory = GalleryCategory::withTrashed()->findOrFail($id);
        $galleryCategory->forceDelete();
        return redirect()->back();
    }
}
