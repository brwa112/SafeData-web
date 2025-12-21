<?php

namespace Database\Seeders;

use App\Models\Pages\SocialLink;
use App\Models\System\Settings\Settings\Language;
use App\Models\System\Settings\System\GroupPermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\System\Users\UserSettings;
use Database\Seeders\RolePermissionSeeder;
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
        // DB::transaction(function () {
        $user = $this->createTestUser();
        // user types removed: createUserTypes() skipped
        $this->createPermissions($user);
        $this->callAdditionalSeeders();
        $this->createUserSettings($user);
        $this->createDeveloperUser();
        $this->createTheme($user);
        $this->createSocialLink();
        Artisan::call('translations:cache');
        // });
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
    public function createSocialLink()
    {
        $links = [
            'facebook' => 'https://www.facebook.com/yourpage',
            'instagram' => 'https://www.instagram.com/yourprofile',
            'telegram' => 'https://t.me/yourchannel',
            'email' => 'mailto:info@safedata.com',
        ];
        //social links seeding removed
        SocialLink::firstOrCreate([
            'facebook' => $links['facebook'],
            'instagram' => $links['instagram'],
            'telegram' => $links['telegram'],
            'email' => $links['email'],
        ]);
    }
    // user types were removed from the system; seeding not required

    private function createTestUser(): User
    {
        $user = [
            [
                'name' => 'Super Admin',
                'email' => 'super@safedatait.com',
                'password' => 'password',
            ],
            [
                'name' => 'developer',
                'email' => 'developer@safedatait.com',
                'password' => 'password',
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
                'name' => 'dashboard',
                'slug' => 'dashboard',
                'description' => 'Access to the main dashboard',
            ],
            [
                'name' => 'users',
                'slug' => 'users',
                'description' => 'Manage users and their permissions',
            ],
            [
                'name' => 'permissions',
                'slug' => 'permissions',
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
                'name' => 'products',
                'slug' => 'products',
                'description' => 'Manage products page settings and content',
            ],
            [
                'name' => 'services',
                'slug' => 'services',
                'description' => 'Manage services page settings and content',
            ],
            [
                'name' => 'clients',
                'slug' => 'clients',
                'description' => 'Manage clients page settings and content',
            ],
            [
                'name' => 'hostings',
                'slug' => 'hostings',
                'description' => 'Manage hostings page settings and content',
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
