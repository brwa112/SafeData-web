<?php

namespace Database\Seeders;

use App\Models\System\Settings\System\GroupPermission;
use  App\Models\System\Users\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $this->createPermissions($user);

        // Get all permissions that were actually created
        $allPermissionNames = Permission::pluck('name')->toArray();

        // Get only view permissions for user role
        $userPermissionNames = Permission::where('name', 'like', 'view_%')->pluck('name')->toArray();

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
        );
        $adminRole->syncPermissions($allPermissionNames);

        $userRole = Role::firstOrCreate(
            ['name' => 'user'],
        );
        $userRole->syncPermissions($userPermissionNames);

        $this->createSuperAdmin();
        $this->createDeveloper();
    }

    private function createPermissions(User $user): void
    {
        $permissionsData = [
            [
                'name' => 'dashboard',
                'slug' => 'dashboard',
                'description' => 'Access to the main dashboard',
                'actions' => ['view', 'create', 'edit', 'delete', 'restore'],
            ],
            [
                'name' => 'users',
                'slug' => 'users',
                'description' => 'Manage users and their permissions',
                'actions' => ['view', 'create', 'edit', 'delete', 'restore'],
            ],
            [
                'name' => 'permissions',
                'slug' => 'permissions',
                'description' => 'System settings and configurations',
                'actions' => ['view', 'create', 'edit', 'delete', 'restore'],
            ],
            [
                'name' => 'group_permissions',
                'slug' => 'group-permissions',
                'description' => 'System settings and configurations',
                'actions' => ['view', 'create', 'edit', 'delete', 'restore'],
            ],
            [
                'name' => 'languages',
                'slug' => 'languages',
                'actions' => ['view', 'create', 'edit', 'delete', 'restore'],
            ],
            [
                'name' => 'keys',
                'slug' => 'keys',
                'description' => 'Custom permissions for specific use cases',
                'actions' => ['view', 'create', 'edit', 'delete', 'restore'],
            ],
            [
                'name' => 'translations',
                'slug' => 'translations',
                'description' => 'Manage translations for the application',
                'actions' => ['view', 'create', 'edit', 'delete', 'restore'],
            ],
            [
                'name' => 'themes',
                'slug' => 'themes',
                'description' => 'Manage themes for the application',
                'actions' => ['view', 'create', 'edit', 'delete', 'restore'],
            ],
            [
                'name' => 'logs',
                'slug' => 'logs',
                'description' => 'View system logs and activities',
                'actions' => ['view'],  // Only view!
            ],
            [
                'name' => 'roles',
                'slug' => 'roles',
                'description' => 'Manage roles and their permissions',
                'actions' => ['view', 'create', 'edit', 'delete', 'restore'],
            ],
            [
                'name' => 'products',
                'slug' => 'products',
                'description' => 'Manage products page settings and content',
                'actions' => ['view', 'create', 'edit', 'delete', 'restore'],
            ],
            [
                'name' => 'services',
                'slug' => 'services',
                'description' => 'Manage services page settings and content',
                'actions' => ['view', 'create', 'edit', 'delete', 'restore'],
            ],
            [
                'name' => 'clients',
                'slug' => 'clients',
                'description' => 'Manage clients page settings and content',
                'actions' => ['view', 'create', 'edit', 'delete', 'restore'],
            ],
            [
                'name' => 'hostings',
                'slug' => 'hostings',
                'description' => 'Manage hostings page settings and content',
                'actions' => ['view', 'create', 'edit', 'delete', 'restore'],
            ],
            [
                'name' => 'settings',
                'slug' => 'settings',
                'description' => 'Manage settings page settings and content',
                'actions' => ['view'],  // Only view!
            ],
        ];

        foreach ($permissionsData as $permissionData) {
            $actions = $permissionData['actions'] ?? [];
            unset($permissionData['actions']);

            $group = GroupPermission::firstOrCreate(
                ['name' => $permissionData['name']],
                array_merge($permissionData, ['user_id' => $user->id])
            );

            // Create individual permissions for each action
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => $action . '_' . $group->name,
                    'group_permission_id' => $group->id,
                ]);
            }
        }
    }

    private function createSuperAdmin()
    {
        $groupPermissions = GroupPermission::whereNotIn('name', ['permissions', 'layer_one_group_name_permissions', 'group_permissions'])->get();

        // Get only existing permissions for these groups
        $allPermissionNames = Permission::whereIn('group_permission_id', $groupPermissions->pluck('id'))
            ->pluck('name')
            ->toArray();

        $user = User::first();

        $adminRole = Role::firstOrCreate(
            ['name' => 'super_admin'],
        );

        $adminRole->syncPermissions($allPermissionNames);

        if ($user) {
            $user->assignRole($adminRole);
            $user->givePermissionTo($allPermissionNames);
        }
    }

    private function createDeveloper()
    {
        $groupPermissions = GroupPermission::whereIn('name', ['users', 'roles', 'permissions', 'group_permissions'])->get();

        // Get only existing permissions for these groups
        $allPermissionNames = Permission::whereIn('group_permission_id', $groupPermissions->pluck('id'))
            ->pluck('name')
            ->toArray();

        $user = User::where('email', 'developer@safedatait.com')->first();

        $adminRole = Role::firstOrCreate(
            ['name' => 'developer'],
        );

        $adminRole->syncPermissions($allPermissionNames);

        if ($user) {
            $user->assignRole($adminRole);
            $user->givePermissionTo($allPermissionNames);
        }
    }
}
