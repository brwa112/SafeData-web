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
            // $this->createPermissions($user);
            $this->callAdditionalSeeders();
            $this->createUserSettings($user);
            $this->createDeveloperUser();
            $this->createTheme($user);
            $this->createSocialLinks();
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
    private function createSocialLinks(){
        $links = [
            'facebook' => 'https://www.facebook.com/safedatacompany',
            'telegram' => 'https://www.instagram.com/safedatacompany?igsh=MThvbmM4Zm80MDJ4eg==',
            'email' => 'https://linkedin.com/',
            'instagram' => 'info@safedatait.com',
        ];
        SocialLink::create([
            'facebook' => $links['facebook'],
            'telegram' => $links['telegram'],
            'email' => $links['email'],
            'instagram' => $links['instagram'],
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
