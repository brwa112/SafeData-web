<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/control';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->routes(function () {

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->as('auth.')
                ->group(base_path('routes/auth.php'));

            Route::middleware('web', 'auth')
                ->prefix('control')
                ->as('control.')
                ->group(base_path('routes/control.php'));

            Route::middleware('web')
                ->group(base_path('routes/frontend.php'));
        });
    }
}
