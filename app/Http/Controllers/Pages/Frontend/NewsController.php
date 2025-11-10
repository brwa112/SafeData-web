<?php

namespace App\Http\Controllers\Pages\Frontend;

use App\Models\Pages\Client;
use App\Models\Pages\Hosting;
use App\Models\Pages\Product;
use App\Models\Pages\Service;
use App\Http\Controllers\Controller;
use App\Models\Pages\News;
use App\Models\Pages\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        // Get selected branch from request/session
        $selectedBranchId = $request->input('branch_id') ?? session('selected_branch_id');
        
        // Items per page
        $perPage = 6;

        // Get categories for filtering
        $categories = NewsCategory::query()
            ->select('id', 'name', 'slug')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->getTranslations('name'),
                    'slug' => $category->slug,
                ];
            });

        // Get selected category from request, default to first category
        $selectedCategory = $request->input('category');
        if (!$selectedCategory && $categories->isNotEmpty()) {
            $selectedCategory = $categories->first()['slug'];
        }

        // Get search query
        $searchQuery = $request->input('search');

        // Get featured news (latest one for hero section)
        $featuredNews = News::query()
            ->ofBranch($selectedBranchId)
            ->with(['category', 'hashtags', 'branch', 'media'])
            ->latest()
            ->first();

        // Build query for news
        $newsQuery = News::query()
            ->ofBranch($selectedBranchId)
            ->with(['category', 'hashtags', 'branch', 'media'])
            ->latest();

        // Filter by category if provided
        if ($selectedCategory) {
            $newsQuery->whereHas('category', function ($query) use ($selectedCategory) {
                $query->where('slug', $selectedCategory);
            });
        }

        // Filter by search query if provided
        if ($searchQuery) {
            $newsQuery->where(function ($query) use ($searchQuery) {
                $query->where('title->en', 'LIKE', "%{$searchQuery}%")
                      ->orWhere('title->ckb', 'LIKE', "%{$searchQuery}%")
                      ->orWhere('content->en', 'LIKE', "%{$searchQuery}%")
                      ->orWhere('content->ckb', 'LIKE', "%{$searchQuery}%");
            });
        }

        // Get paginated news
        $newsPaginated = $newsQuery->paginate($perPage);

        // Transform pagination data
        $news = [
            'data' => $newsPaginated->map(function ($newsItem) {
                return [
                    'id' => $newsItem->id,
                    'slug' => $newsItem->slug,
                    'news_category_id' => $newsItem->news_category_id,
                    'title' => $newsItem->getTranslations('title'),
                    'content' => $newsItem->getTranslations('content'),
                    'created_at' => $newsItem->created_at->format('Y-m-d'),
                    'branch' => $newsItem->branch_name,
                    'category' => $newsItem->category_name,
                    'hashtags' => $newsItem->hashtag_names,
                    'images' => $newsItem->images,
                ];
            }),
            'current_page' => $newsPaginated->currentPage(),
            'last_page' => $newsPaginated->lastPage(),
            'per_page' => $newsPaginated->perPage(),
            'total' => $newsPaginated->total(),
            'from' => $newsPaginated->firstItem(),
            'to' => $newsPaginated->lastItem(),
        ];

        return inertia('Frontend/Pages/News/Index', [
            'featuredNews' => $featuredNews ? [
                'id' => $featuredNews->id,
                'slug' => $featuredNews->slug,
                'title' => $featuredNews->getTranslations('title'),
                'content' => $featuredNews->getTranslations('content'),
                'created_at' => $featuredNews->created_at->format('Y-m-d'),
                'branch' => $featuredNews->branch_name,
                'category' => $featuredNews->category_name,
                'hashtags' => $featuredNews->hashtag_names,
                'images' => $featuredNews->images,
            ] : null,
            'news' => $news,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'searchQuery' => $searchQuery,
        ]);
    }

    public function show($slug)
    {
        // Find news by slug or ID (fallback)
        $news = News::query()
            ->active()
            ->where(function($query) use ($slug) {
                $query->where('slug', $slug)
                      ->orWhere('id', $slug);
            })
            ->with(['category', 'hashtags', 'branch', 'media'])
            ->firstOrFail();

        // Increment views
        $news->incrementViews();

        return inertia('Frontend/Pages/News/Show', [
            'news' => [
                'id' => $news->id,
                'slug' => $news->slug,
                'title' => $news->getTranslations('title'),
                'content' => $news->getTranslations('content'),
                'created_at' => $news->created_at->format('Y-m-d'),
                'formatted_date' => $news->formatted_date,
                'branch' => $news->branch_name,
                'category' => $news->category_name,
                'hashtags' => $news->hashtag_names,
                'images' => $news->images,
                'views' => $news->views,
            ],
        ]);
    }
}

