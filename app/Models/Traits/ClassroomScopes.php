<?php

namespace App\Models\Traits;

trait ClassroomScopes
{
    public function scopeSearch($query, $search)
    {
        if (empty($search)) {
            return $query;
        }

        return $query->where(function ($query) use ($search) {
            $query->where('title->en', 'like', "%$search%")
                ->orWhere('title->ckb', 'like', "%$search%")
                ->orWhere('content->en', 'like', "%$search%")
                ->orWhere('content->ckb', 'like', "%$search%");
        });
    }

    // Filter by branch
    public function scopeFilterByBranch($query, $branchId = null)
    {
        if (empty($branchId)) {
            return $query;
        }

        return $query->where('branch_id', $branchId);
    }

    // Filter by creation date range
    public function scopeFilterByDateRange($query, $startDate = null, $endDate = null)
    {
        if (!empty($startDate) && !empty($endDate)) {
            // Both dates provided - filter between the range
            return $query->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate);
        } elseif (!empty($startDate)) {
            // Only start date provided
            return $query->whereDate('created_at', '>=', $startDate);
        } elseif (!empty($endDate)) {
            // Only end date provided
            return $query->whereDate('created_at', '<=', $endDate);
        }

        return $query;
    }
}
