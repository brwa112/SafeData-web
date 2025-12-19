<?php

namespace App\Policies;

use  App\Models\System\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasDirectPermission('view_settings');
    }
}
