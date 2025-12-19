<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Pages\Client;
use App\Policies\LogsPolicy;
use App\Policies\UserPolicy;
use App\Models\Pages\Hosting;
use App\Models\Pages\Product;
use App\Models\Pages\Service;
use App\Policies\ClientPolicy;
use App\Policies\ThemesPolicy;
use App\Policies\HostingPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ServicePolicy;
use App\Policies\SettingPolicy;
use App\Models\Pages\SocialLink;
use App\Models\System\Users\User;
use App\Policies\PermissionPolicy;
use App\Models\System\Users\Permission;
use Spatie\Activitylog\Models\Activity;
use App\Models\System\Settings\Reasons\Log;
use App\Models\System\Settings\Settings\Theme;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Permission::class => PermissionPolicy::class,
        Log::class => LogsPolicy::class,
        Activity::class => LogsPolicy::class, // Add policy for Spatie Activity model
        Theme::class => ThemesPolicy::class,
        Service::class => ServicePolicy::class,
        Product::class => ProductPolicy::class,
        Hosting::class => HostingPolicy::class,
        Client::class => ClientPolicy::class,
        SocialLink::class => SettingPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
