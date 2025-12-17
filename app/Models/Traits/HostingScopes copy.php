<?php

namespace App\Models\Traits;

trait HostingScopes
{
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%");
    }
}
