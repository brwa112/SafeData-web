<?php

namespace App\Policies;


use App\Models\Pages\Client;
use App\Models\System\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasDirectPermission('view_clients');
    }

    public function view(User $user, Client $client)
    {
        return $user->hasDirectPermission('view_clients');
    }

    public function create(User $user)
    {
        return $user->hasDirectPermission('create_clients');
    }

    public function update(User $user, Client $client)
    {
        return $user->hasDirectPermission('edit_clients');
    }

    public function delete(User $user, Client $client)
    {
        return $user->hasDirectPermission('delete_clients');
    }

    public function restore(User $user, Client $client)
    {
        return $user->hasDirectPermission('delete_clients');
    }
}
