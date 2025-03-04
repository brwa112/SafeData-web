<?php

use App\Http\Controllers\System\UserController;
use App\Http\Controllers\Pages\ClientController;
use App\Http\Controllers\Pages\HostingController;
use App\Http\Controllers\Pages\ProductController;
use App\Http\Controllers\Pages\ServiceController;
use App\Http\Controllers\System\PermissionController;
use App\Http\Controllers\System\RoleController;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

if (app()->isProduction()) {
    URL::forceScheme('https');
}

Route::middleware('auth')->group(function () {

    Route::prefix('system/users')->as('system.users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

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

        Route::prefix('roles')->as('roles.')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::post('/', [RoleController::class, 'store'])->name('store');
            Route::put('/{role}', [RoleController::class, 'update'])->name('update');
            Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('permissions')->as('permissions.')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('index');
            Route::post('/', [PermissionController::class, 'store'])->name('store');
            Route::put('/{permission}', [PermissionController::class, 'update'])->name('update');
            Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('destroy');
        });
    });
});
