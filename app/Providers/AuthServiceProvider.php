<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Pages\Branch;
use App\Models\Pages\Client;
use App\Policies\LogsPolicy;
use App\Policies\UserPolicy;
use App\Models\Pages\Gallery;
use App\Models\Pages\Hosting;
use App\Models\Pages\Product;
use App\Models\Pages\Service;
use App\Policies\BranchPolicy;
use App\Policies\ClientPolicy;
use App\Policies\ThemesPolicy;
use App\Policies\GalleryPolicy;
use App\Policies\HostingPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ServicePolicy;
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
        Gallery::class => GalleryPolicy::class,
        Branch::class => BranchPolicy::class,
        Service::class => ServicePolicy::class,
        Product::class => ProductPolicy::class,
        Hosting::class => HostingPolicy::class,
        Client::class => ClientPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
