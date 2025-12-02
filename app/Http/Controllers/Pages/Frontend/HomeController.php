<?php

namespace App\Http\Controllers\Pages\Frontend;

use App\Models\Pages\Home\HomeHero;
use App\Models\Pages\Home\HomeHistory;
use App\Models\Pages\Home\HomeMessage;
use App\Models\Pages\Home\HomeMission;
use App\Models\Pages\Home\HomeKnow;
use App\Models\Pages\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Get the selected branch ID from session or use null for all branches
        $branchId = session('selected_branch_id');

        // Fetch home sections for the selected branch
        $hero = HomeHero::where('is_active', true)
            ->when($branchId, function ($query) use ($branchId) {
                return $query->where('branch_id', $branchId);
            }, function ($query) {
                return $query->whereNull('branch_id');
            })
            ->first();

        $history = HomeHistory::where('is_active', true)
            ->when($branchId, function ($query) use ($branchId) {
                return $query->where('branch_id', $branchId);
            }, function ($query) {
                return $query->whereNull('branch_id');
            })
            ->first();

        $message = HomeMessage::where('is_active', true)
            ->when($branchId, function ($query) use ($branchId) {
                return $query->where('branch_id', $branchId);
            }, function ($query) {
                return $query->whereNull('branch_id');
            })
            ->first();

        $mission = HomeMission::where('is_active', true)
            ->when($branchId, function ($query) use ($branchId) {
                return $query->where('branch_id', $branchId);
            }, function ($query) {
                return $query->whereNull('branch_id');
            })
            ->first();

        $social = HomeKnow::where('is_active', true)
            ->when($branchId, function ($query) use ($branchId) {
                return $query->where('branch_id', $branchId);
            }, function ($query) {
                return $query->whereNull('branch_id');
            })
            ->first();

        // Fetch latest news for the home page (limit to 3)
        $latestNews = News::query()
            ->ofBranch($branchId)
            ->with(['category', 'hashtags', 'branch'])
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($news) {
                return [
                    'id' => $news->id,
                    'slug' => $news->slug,
                    'title' => $news->getTranslations('title'),
                    'content' => $news->getTranslations('content'),
                    'image' => $news->getFirstMediaUrl('images', 'medium') ?: $news->getFirstMediaUrl('images'),
                    'created_at' => $news->created_at?->format('Y-m-d'),
                    'category' => $news->category ? [
                        'name' => $news->category->getTranslations('name'),
                        'slug' => $news->category->slug,
                    ] : null,
                    'branch' => $news->branch ? [
                        'name' => $news->branch->getTranslations('name'),
                        'slug' => $news->branch->slug,
                    ] : null,
                ];
            });

        return inertia('Frontend/Pages/Home/Index', [
            'hero' => $hero ? [
                'title' => $hero->getTranslations('title'),
                'subtitle' => $hero->getTranslations('subtitle'),
                'metadata' => $hero->metadata,
                'hero_image' => $hero->getFirstMediaUrl('hero_image'),
                'background_video' => $hero->getFirstMediaUrl('background_video'),
            ] : null,
            'history' => $history ? [
                'description' => $history->getTranslations('description'),
                'image_1' => $history->getFirstMediaUrl('image_1'),
                'image_2' => $history->getFirstMediaUrl('image_2'),
            ] : null,
            'message' => $message ? [
                'description' => $message->getTranslations('description'),
                'author_image' => $message->getFirstMediaUrl('author_image'),
            ] : null,
            'mission' => $mission ? [
                'description' => $mission->getTranslations('description'),
                'image' => $mission->getFirstMediaUrl('images'),
            ] : null,
            'social' => $social ? [
                'is_active' => $social->is_active,
                'metadata' => $social->metadata,
            ] : null,
            'news' => $latestNews,
        ]);
    }
}
