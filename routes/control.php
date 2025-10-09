<?php

use App\Http\Controllers\System\Users\UserController;
use App\Http\Controllers\Pages\ClientController;
use App\Http\Controllers\Pages\HostingController;
use App\Http\Controllers\Pages\ProductController;
use App\Http\Controllers\Pages\ServiceController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\System\Users\PermissionController;
use App\Http\Controllers\System\Users\RoleController;
use App\Http\Controllers\System\Users\UserSettingsController;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// if (app()->isProduction()) {
//     URL::forceScheme('https');
// }

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // profile route
    Route::get('/profile', [ProfileController::class, 'Index'])->name('profile');

    Route::prefix('pages')->as('pages.')->group(function () {
        Route::resource('services', ServiceController::class);
        Route::resource('products', ProductController::class);
        Route::resource('hostings', HostingController::class);
        Route::prefix('clients')->as('clients.')->group(function () {
            Route::get('/', [ClientController::class, 'index'])->name('index');
            Route::post('/', [ClientController::class, 'store'])->name('store');
            Route::post('/{client}', [ClientController::class, 'update'])->name('update');
            Route::delete('/{client}', [ClientController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('system')->as('system.')->group(function () {
        // Route::prefix('users')->as('users.')->group(function () {
        //     Route::get('/', [UserController::class, 'index'])->name('index');
        //     Route::get('/create', [UserController::class, 'create'])->name('create');
        //     Route::post('/', [UserController::class, 'store'])->name('store');
        //     Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        //     Route::put('/{user}', [UserController::class, 'update'])->name('update');
        //     Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        // });

        // User resource
        Route::prefix('users')->as('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');

            // Update user settings
            Route::post('/user-setting', [ProfileController::class, 'update'])->name('setting');
            
            // Update profile avatar
            Route::post('/update-avatar', [UserController::class, 'updateAvatar'])->name('update-avatar');

            Route::resource('roles', RoleController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->names('roles');
            Route::resource('permissions', PermissionController::class)->only(['index', 'store', 'update', 'destroy'])->names('permissions');
        });

        // Route::prefix('roles')->as('roles.')->group(function () {
        //     Route::get('/', [RoleController::class, 'index'])->name('index');
        //     Route::post('/', [RoleController::class, 'store'])->name('store');
        //     Route::put('/{role}', [RoleController::class, 'update'])->name('update');
        //     Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
        // });

        // Route::prefix('permissions')->as('permissions.')->group(function () {
        //     Route::get('/', [PermissionController::class, 'index'])->name('index');
        //     Route::post('/', [PermissionController::class, 'store'])->name('store');
        //     Route::put('/{permission}', [PermissionController::class, 'update'])->name('update');
        //     Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('destroy');
        // });
    });
});
