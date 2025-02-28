<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pages\Service;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasDirectPermission('view_services');
    }

    public function view(User $user, Service $service)
    {
        return $user->hasDirectPermission('view_services');
    }

    public function create(User $user)
    {
        return $user->hasDirectPermission('create_services');
    }

    public function update(User $user, Service $service)
    {
        return $user->hasDirectPermission('edit_services');
    }

    public function delete(User $user, Service $service)
    {
        return $user->hasDirectPermission('delete_services');
    }

    public function restore(User $user, Service $service)
    {
        return $user->hasDirectPermission('delete_services');
    }
}
