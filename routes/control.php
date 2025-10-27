<?php

use App\Http\Controllers\System\Users\UserController;
use App\Http\Controllers\Pages\NewsController;
use App\Http\Controllers\Pages\CampusController;
use App\Http\Controllers\Pages\ClassroomController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\System\Settings\Pages\HomeController;
use App\Http\Controllers\System\Users\PermissionController;
use App\Http\Controllers\System\Users\RoleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\System\Settings\Settings\UserTypeController;
use App\Http\Controllers\System\Settings\Settings\LogController;
use App\Http\Controllers\System\Settings\Settings\TranslationsController;
use App\Http\Controllers\System\Settings\Settings\KeyLanguageController;
use App\Http\Controllers\System\Settings\Settings\LanguageController;
use App\Http\Controllers\System\Settings\Settings\ThemeController;
use App\Http\Controllers\System\Settings\Settings\ImportExportController;
use App\Http\Controllers\System\Settings\Settings\SyncTranslationController;
use App\Http\Controllers\System\Settings\Settings\GroupPermissionController;

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

        Route::prefix('news')->as('news.')->group(function () {
            Route::get('/', [NewsController::class, 'index'])->name('index');
            Route::post('/', [NewsController::class, 'store'])->name('store');
            Route::post('/{news}', [NewsController::class, 'update'])->name('update');
            Route::delete('/{news}', [NewsController::class, 'destroy'])->name('destroy');
            Route::delete('/{news}/force', [NewsController::class, 'forceDelete'])->name('force_delete');
            Route::post('/{news}/restore', [NewsController::class, 'restore'])->name('restore');
        });

        Route::prefix('campus')->as('campus.')->group(function () {
            Route::get('/', [CampusController::class, 'index'])->name('index');
            Route::post('/', [CampusController::class, 'store'])->name('store');
            Route::post('/{campus}', [CampusController::class, 'update'])->name('update');
            Route::delete('/{campus}', [CampusController::class, 'destroy'])->name('destroy');
            Route::delete('/{campus}/force', [CampusController::class, 'forceDelete'])->name('force_delete');
            Route::post('/{campus}/restore', [CampusController::class, 'restore'])->name('restore');
        });

        Route::prefix('classrooms')->as('classrooms.')->group(function () {
            Route::get('/', [ClassroomController::class, 'index'])->name('index');
            Route::post('/', [ClassroomController::class, 'store'])->name('store');
            Route::post('/{classroom}', [ClassroomController::class, 'update'])->name('update');
            Route::delete('/{classroom}', [ClassroomController::class, 'destroy'])->name('destroy');
            Route::delete('/{classroom}/force', [ClassroomController::class, 'forceDelete'])->name('force_delete');
            Route::post('/{classroom}/restore', [ClassroomController::class, 'restore'])->name('restore');
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

            // System controllers
            // Route::prefix('systems')->group(function () {
            //     Route::resource('/group-permission', GroupPermissionController::class)->only(['index', 'store', 'update', 'destroy'])->names('layer_one_group_name_permissions');
            //     Route::resource('/user-types', UserTypeController::class)->names('usertype');
            //     Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
            // });


            // Route::prefix('/reasons')->as('reasons.')->group(function () {});

            // Settings controller
            Route::as('settings.')->group(function () {
                Route::resource('/group-permission', GroupPermissionController::class)->only(['index', 'store', 'update', 'destroy'])->names('group_permissions');
                Route::resource('/user-types', UserTypeController::class)->names('usertype');
                Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
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

            // Pages controllers
            Route::as('pages.')->group(function () {
                Route::prefix('home')->as('home.')->group(function () {
                    Route::get('/', [HomeController::class, 'index'])->name('index');
                    Route::post('/hero', [HomeController::class, 'updateHero'])->name('hero.update');
                    Route::post('/history', [HomeController::class, 'updateHistory'])->name('history.update');
                    Route::post('/message', [HomeController::class, 'updateMessage'])->name('message.update');
                    Route::post('/mission', [HomeController::class, 'updateMission'])->name('mission.update');
                    Route::post('/social', [HomeController::class, 'updateSocial'])->name('social.update');
                });
            });
        });
    });
});
