<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pages\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasDirectPermission('view_products');
    }

    public function view(User $user, Product $product)
    {
        return $user->hasDirectPermission('view_products');
    }

    public function create(User $user)
    {
        return $user->hasDirectPermission('create_products');
    }

    public function update(User $user, Product $product)
    {
        return $user->hasDirectPermission('edit_products');
    }

    public function delete(User $user, Product $product)
    {
        return $user->hasDirectPermission('delete_products');
    }

    public function restore(User $user, Product $product)
    {
        return $user->hasDirectPermission('delete_products');
    }
}
