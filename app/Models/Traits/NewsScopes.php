<?php

namespace App\Models\Traits;

trait NewsScopes
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
                ->orWhere('content->ckb', 'like', "%$search%")
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name->en', 'like', "%$search%")
                        ->orWhere('name->ckb', 'like', "%$search%");
                })
                ->orWhereHas('hashtags', function ($q) use ($search) {
                    $q->where('name->en', 'like', "%$search%")
                        ->orWhere('name->ckb', 'like', "%$search%");
                });
        });
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
