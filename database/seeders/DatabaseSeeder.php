<?php

namespace Database\Seeders;

use App\Models\System\Settings\Settings\Language;
use App\Models\System\Settings\System\GroupPermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\System\Users\UserSettings;
use Database\Seeders\RolePermissionSeeder;
use App\Models\System\Settings\System\UserType;
use App\Models\System\Users\User;
use App\Traits\GenerateSlugKey;

class DatabaseSeeder extends Seeder
{
    use GenerateSlugKey;

    private const TEST_USER_DATA = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
    ];

    public function run(): void
    {
        DB::transaction(function () {
            $this->createUserTypes();
            $user = $this->createTestUser();
            $this->createPermissions($user);
            $this->callAdditionalSeeders();
            $this->createUserSettings($user);
            $this->createDeveloperUser();
            $this->createTheme($user);
            Artisan::call('translations:cache');
        });
    }

    private function createTheme($user): void
    {
        $themes = [
            ['name' => 'light', 'slug' => 'light'],
            ['name' => 'dark', 'slug' => 'dark'],
        ];

        foreach ($themes as $theme) {
            $user->theme()->firstOrCreate($theme);
        }
    }

    private function createUserTypes(): void
    {
        $userTypes = [
            ['name' => 'user', 'slug' => 'user'],
            ['name' => 'admin', 'slug' => 'admin'],
            ['name' => 'developer', 'slug' => 'developer'],
        ];

        foreach ($userTypes as $userType) {
            UserType::firstOrCreate($userType);
        }
    }

    private function createTestUser(): User
    {
        $user = [
            [
                'name' => 'Super Admin',
                'email' => 'super@safedatait.com',
                'password' => 'password',
                'user_type_id' => UserType::where('name', 'admin')->first()->id,
            ],
            [
                'name' => 'developer',
                'email' => 'developer@safedatait.com',
                'password' => 'password',
                'user_type_id' => UserType::where('name', 'developer')->first()->id,
            ],
        ];

        foreach ($user as $key => $value) {
            User::firstOrCreate($value);
        }

        return User::first();
    }

    private function createDeveloperUser()
    {
        $user = User::where('email', 'developer@safedatait.com')->first();
        $this->createUserSettings($user);
    }

    private function createPermissions(User $user): void
    {
        $permissionsData = [
            [
                'name' => 'news',
                'slug' => 'news',
                'description' => 'Manage news articles and their data',
            ],
            [
                'name' => 'campus',
                'slug' => 'campus',
                'description' => 'Manage campus and their data',
            ],
            [
                'name' => 'classroom',
                'slug' => 'classroom',
                'description' => 'Manage classroom and their data',
            ],
            [
                'name' => 'users',
                'slug' => 'users',
                'description' => 'Manage users and their permissions',
            ],
            [
                'name' => 'settings',
                'slug' => 'settings',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'usertypes',
                'slug' => 'usertypes',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'permissions',
                'slug' => 'permissions',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'status',
                'slug' => 'status',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'group_permissions',
                'slug' => 'group-permissions',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'languages',
                'slug' => 'languages',
            ],
            [
                'name' => 'keys',
                'slug' => 'keys',
                'description' => 'Custom permissions for specific use cases',
            ],
            [
                'name' => 'translations',
                'slug' => 'translations',
                'description' => 'Manage translations for the application',
            ],
            [
                'name' => 'themes',
                'slug' => 'themes',
                'description' => 'Manage themes for the application',
            ],
            [
                'name' => 'logs',
                'slug' => 'logs',
                'description' => 'View system logs and activities',
            ],
            [
                'name' => 'roles',
                'slug' => 'roles',
                'description' => 'Manage roles and their permissions',
            ],
            [
                'name' => 'home',
                'slug' => 'home',
                'description' => 'Manage home page settings and content',
            ],
        ];

        foreach ($permissionsData as $permissionData) {
            GroupPermission::firstOrCreate(
                [
                    'name' => $permissionData['name'],
                    'slug' => $permissionData['slug'],
                    'description' => $permissionData['description'] ?? null,
                    'user_id' => $user->id,
                ],
                array_merge($permissionData, ['user_id' => $user->id])
            );
        }
    }

    private function createUserSettings(User $user): void
    {
        UserSettings::firstOrCreate(
            ['user_id' => $user->id],
            [
                'font_scale' => 'medium',
                'theme' => 'dark',
                'language_id' => Language::where('slug', 'en')->first()->id ?? null,
            ]
        );
    }

    private function callAdditionalSeeders(): void
    {
        $this->call([
            TranslationsSeeder::class,
            RolePermissionSeeder::class,
        ]);
    }
}
