<?php

namespace App\Http\Middleware;

use App\Models\Pages\Branch;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleBranchSelection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Remove trailing slash from URL (except root)
        $path = $request->path();
        if ($path !== '/' && str_ends_with($request->getRequestUri(), '/')) {
            return redirect(rtrim($request->getRequestUri(), '/'), 301);
        }
        
        // Reserved paths that should not be treated as branch slugs
        $reservedPaths = ['control', 'lang', 'login', 'register', 'password', 'forgot-password'];
        
        // Get the first segment of the URL path
        $firstSegment = $request->segment(1);
        
        // Skip branch handling for reserved paths
        if (in_array($firstSegment, $reservedPaths)) {
            return $next($request);
        }
        
        // Get all active branches
        $branches = Branch::active()->ordered()->get();
        
        // Check if the first segment matches a branch slug
        $selectedBranch = $branches->firstWhere('slug', $firstSegment);
        
        // If no branch found in URL, use session or default branch
        if (!$selectedBranch) {
            $selectedBranchId = session('selected_branch_id');
            $selectedBranch = $selectedBranchId 
                ? $branches->firstWhere('id', $selectedBranchId) 
                : $branches->first();
        }
        
        // Store selected branch in session for consistency
        if ($selectedBranch) {
            session(['selected_branch_id' => $selectedBranch->id]);
            session(['selected_branch_slug' => $selectedBranch->slug]);
        }

        // Share branches data with Inertia
        inertia()->share([
            'branches' => $branches,
            'selectedBranch' => $selectedBranch,
            'branchPrefix' => $selectedBranch ? $selectedBranch->slug : '',
        ]);

        return $next($request);
    }
}
