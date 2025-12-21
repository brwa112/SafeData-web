<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\ClientController;
use App\Http\Controllers\Pages\HostingController;
use App\Http\Controllers\Pages\ProductController;
use App\Http\Controllers\Pages\ServiceController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Analytics\VisitorController;
use App\Http\Controllers\System\Users\RoleController;
use App\Http\Controllers\System\Users\UserController;
use App\Http\Controllers\System\Users\PermissionController;
use App\Http\Controllers\System\Settings\Settings\LogController;
use App\Http\Controllers\System\Settings\Settings\ThemeController;
use App\Http\Controllers\System\Settings\Pages\SocialLinkController;
use App\Http\Controllers\System\Settings\Settings\LanguageController;
use App\Http\Controllers\System\Settings\Settings\KeyLanguageController;
use App\Http\Controllers\System\Settings\Pages\MailInformationController;
use App\Http\Controllers\System\Settings\Settings\ImportExportController;
use App\Http\Controllers\System\Settings\Settings\TranslationsController;
use App\Http\Controllers\System\Settings\Settings\GroupPermissionController;
use App\Http\Controllers\System\Settings\Settings\SyncTranslationController;

// if (app()->isProduction()) {
//     URL::forceScheme('https');
// }

Route::middleware('auth')->group(function () {

    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // profile route
    Route::get('/profile', [ProfileController::class, 'Index'])->name('profile');

    // Visitor Analytics
    Route::prefix('visitors')->as('visitors.')->group(function () {
        Route::get('/', [VisitorController::class, 'index'])->name('index');
        Route::delete('/{visitor}', [VisitorController::class, 'destroy'])->name('destroy');
        Route::delete('/', [VisitorController::class, 'destroyAll'])->name('destroy_all');
    });

    Route::prefix('pages')->as('pages.')->group(function () {

        // services routes
        Route::prefix('services')->as('services.')->group(function () {
            Route::get('/', [ServiceController::class, 'index'])->name('index');
            Route::post('/', [ServiceController::class, 'store'])->name('store');
            Route::post('/{service}', [ServiceController::class, 'update'])->name('update');
            Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('destroy');
            Route::delete('/{service}/force', [ServiceController::class, 'forceDelete'])->name('force_delete');
            Route::post('/{service}/restore', [ServiceController::class, 'restore'])->name('restore');
        });

        // products routes
        Route::prefix('products')->as('products.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::post('/', [ProductController::class, 'store'])->name('store');
            Route::post('/{product}', [ProductController::class, 'update'])->name('update');
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
            Route::delete('/{product}/force', [ProductController::class, 'forceDelete'])->name('force_delete');
            Route::post('/{product}/restore', [ProductController::class, 'restore'])->name('restore');
        });

        // hostings routes
        Route::prefix('hostings')->as('hostings.')->group(function () {
            Route::get('/', [HostingController::class, 'index'])->name('index');
            Route::post('/', [HostingController::class, 'store'])->name('store');
            Route::post('/{hosting}', [HostingController::class, 'update'])->name('update');
            Route::delete('/{hosting}', [HostingController::class, 'destroy'])->name('destroy');
            Route::delete('/{hosting}/force', [HostingController::class, 'forceDelete'])->name('force_delete');
            Route::post('/{hosting}/restore', [HostingController::class, 'restore'])->name('restore');
        });

        // clients routes
        Route::prefix('clients')->as('clients.')->group(function () {
            Route::get('/', [ClientController::class, 'index'])->name('index');
            Route::post('/', [ClientController::class, 'store'])->name('store');
            Route::post('/{client}', [ClientController::class, 'update'])->name('update');
            Route::delete('/{client}', [ClientController::class, 'destroy'])->name('destroy');
            Route::delete('/{client}/force', [ClientController::class, 'forceDelete'])->name('force_delete');
            Route::post('/{client}/restore', [ClientController::class, 'restore'])->name('restore');
        });
    });

    Route::prefix('system')->as('system.')->group(function () {

        // User resource
        Route::prefix('users')->as('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
            // Soft-deleted user management
            Route::delete('/{user}/force', [UserController::class, 'forceDelete'])->name('force_delete');
            Route::post('/{user}/restore', [UserController::class, 'restore'])->name('restore');

            // Update user settings
            Route::post('/user-setting', [ProfileController::class, 'update'])->name('setting');

            // Update profile avatar
            Route::post('/update-avatar', [UserController::class, 'updateAvatar'])->name('update-avatar');

            Route::resource('roles', RoleController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->names('roles');
            Route::resource('permissions', PermissionController::class)->only(['index', 'store', 'update', 'destroy'])->names('permissions');
        });

        // Settings
        Route::prefix('settings')->group(function () {

            Route::get('/', fn() => Inertia::render('System/Settings/Index'))->name('settings');

            // Settings controller
            Route::as('settings.')->group(function () {
                // Social Links
                Route::get('/social-links', [SocialLinkController::class, 'index'])->name('social-links.index');
                Route::put('/social-links', [SocialLinkController::class, 'update'])->name('social-links.update');

                // Mail Information
                Route::get('/mail-information', [MailInformationController::class, 'index'])->name('mail-information.index');
                Route::put('/mail-information', [MailInformationController::class, 'update'])->name('mail-information.update');

                // Phone Numbers
                Route::post('/social-links/phone', [SocialLinkController::class, 'storePhone'])->name('social-links.store-phone');
                Route::put('/social-links/phone/{id}', [SocialLinkController::class, 'updatePhone'])->name('social-links.update-phone');
                Route::delete('/social-links/{id}', [SocialLinkController::class, 'destroy'])->name('social-links.destroy');

                Route::resource('/group-permission', GroupPermissionController::class)->only(['index', 'store', 'update', 'destroy'])->names('group_permissions');
                // user types removed: route disabled
                Route::get('/logs', [LogController::class, 'index'])->name('logs.index');

                // Visitor Analytics
                Route::prefix('visitors')->as('visitors.')->group(function () {
                    Route::get('/', [VisitorController::class, 'index'])->name('index');
                    Route::delete('/{visitor}', [VisitorController::class, 'destroy'])->name('destroy');
                    Route::delete('/', [VisitorController::class, 'destroyAll'])->name('destroy_all');
                });

                Route::resource('translations', TranslationsController::class)->only(['index', 'store', 'update', 'destroy'])->names('translations');
                Route::resource('keys', KeyLanguageController::class)->only(['index', 'store', 'update', 'destroy'])->names('keys');
                Route::resource('languages', LanguageController::class)->only(['index', 'store', 'update', 'destroy'])->names('languages');
                Route::resource('theme', ThemeController::class)->only(['index', 'store', 'update', 'destroy'])->names('theme');
                // Import/Export translation
                Route::get('/export', [ImportExportController::class, 'exportTranslations'])->name('export.translations');
                Route::get('/export', [ImportExportController::class, 'exportTranslations'])->name('export.translations');
                Route::get('/translations/export', [ImportExportController::class, 'export'])->name('translations.export');
                Route::get('sync-translations', [SyncTranslationController::class, 'syncTranslations'])->name('translations.sync');
            });
        });
    });
});
