<?php

use App\Http\Controllers\Pages\Frontend\AboutController;
use App\Http\Controllers\Pages\Frontend\AcademicsController;
use App\Http\Controllers\Pages\Frontend\AdmissionController;
use App\Http\Controllers\Pages\Frontend\CalendarController;
use App\Http\Controllers\Pages\Frontend\CampusController;
use App\Http\Controllers\Pages\Frontend\HomeController;
use App\Http\Controllers\Pages\Frontend\NewsController;
use Illuminate\Support\Facades\Route;

// Branch-specific routes (e.g., /kurd-genius/news)
Route::prefix('{branch_slug}')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('branch.home.index');
    Route::get('/about', [AboutController::class, 'index'])->name('branch.about.index');
    Route::get('/admission', [AdmissionController::class, 'index'])->name('branch.admission.index');
    Route::get('/academics', [AcademicsController::class, 'index'])->name('branch.academic.index');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('branch.calendar.index');
    
    Route::prefix('campus')->name('branch.campus.')->group(function () {
        Route::get('/', [CampusController::class, 'index'])->name('index');
        Route::get('/{slug}', [CampusController::class, 'show'])->name('show');
        Route::get('/class/{slug}', [CampusController::class, 'showClass'])->name('show_class');
    });
    
    Route::prefix('news')->name('branch.news.')->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('index');
        Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
    });
});
