<?php

namespace App\Models\Traits;

trait UserScopes
{
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%");
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeWithRole($query, $role)
    {
        return $query->whereHas('roles', function ($q) use ($role) {
            $q->where('name', $role);
        });
    }
}
