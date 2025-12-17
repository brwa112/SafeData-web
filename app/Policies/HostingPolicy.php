<?php

namespace App\Policies;

use App\Models\System\Users\User;
use App\Models\Pages\Hosting;
use Illuminate\Auth\Access\HandlesAuthorization;

class HostingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasDirectPermission('view_hostings');
    }

    public function view(User $user, Hosting $hosting)
    {
        return $user->hasDirectPermission('view_hostings');
    }

    public function create(User $user)
    {
        return $user->hasDirectPermission('create_hostings');
    }

    public function update(User $user, Hosting $hosting)
    {
        return $user->hasDirectPermission('edit_hostings');
    }

    public function delete(User $user, Hosting $hosting)
    {
        return $user->hasDirectPermission('delete_hostings');
    }

    public function restore(User $user, Hosting $hosting)
    {
        return $user->hasDirectPermission('delete_hostings');
    }
}
