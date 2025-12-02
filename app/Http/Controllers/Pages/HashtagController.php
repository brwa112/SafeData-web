<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\Hashtag;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class HashtagController extends Controller
{
    public function index(Request $request)
    {
        $query = Hashtag::query()->withTrashed()->withCount('news');

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
        $hashtags = $query->paginate($perPage)->withQueryString();

        return Inertia::render('Pages/Hashtags/Index', [
            'hashtags' => $hashtags,
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
        ], [], [
            'name.en' => __('pages.name.en'),
            'name.ckb' => __('pages.name.ckb'),
            'name.ar' => __('pages.name.ar'),
        ]);

        $validated['slug'] = Str::slug($validated['name']['en']);
        
        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Hashtag::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        Hashtag::create($validated);

        return redirect()->back();
    }

    public function update(Request $request, Hashtag $hashtag)
    {
        $validated = $request->validate([
            'name' => 'required|array',
            'name.en' => 'required|string|max:255',
            'name.ckb' => 'required|string|max:255',
            'name.ar' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ], [], [
            'name.en' => __('pages.name.en'),
            'name.ckb' => __('pages.name.ckb'),
            'name.ar' => __('pages.name.ar'),
        ]);

        // Update slug if name changed
        if ($validated['name']['en'] !== $hashtag->getTranslation('name', 'en')) {
            $newSlug = Str::slug($validated['name']['en']);
            $originalSlug = $newSlug;
            $count = 1;
            while (Hashtag::where('slug', $newSlug)->where('id', '!=', $hashtag->id)->exists()) {
                $newSlug = $originalSlug . '-' . $count;
                $count++;
            }
            $validated['slug'] = $newSlug;
        }

        $hashtag->update($validated);

        return redirect()->back();
    }

    public function destroy(Hashtag $hashtag)
    {
        $hashtag->delete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $hashtag = Hashtag::withTrashed()->findOrFail($id);
        $hashtag->restore();
        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $hashtag = Hashtag::withTrashed()->findOrFail($id);
        $hashtag->forceDelete();
        return redirect()->back();
    }
}
