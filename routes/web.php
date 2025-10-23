<?php

use App\Http\Controllers\Pages\Frontend\AboutController;
use App\Http\Controllers\Pages\Frontend\AcademicsController;
use App\Http\Controllers\Pages\Frontend\AdmissionController;
use App\Http\Controllers\Pages\Frontend\CalendarController;
use App\Http\Controllers\Pages\Frontend\CampusController;
use App\Http\Controllers\Pages\Frontend\HomeController;
use App\Http\Controllers\Pages\Frontend\NewsController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// Route::redirect('/', '/control');

// Default routes (will use first branch or session branch)
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/admission', [AdmissionController::class, 'index'])->name('admission.index');
Route::get('/academics', [AcademicsController::class, 'index'])->name('academic.index');
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
Route::prefix('campus')->name('campus.')->group(function () {
    Route::get('/', [CampusController::class, 'index'])->name('index');
    Route::get('/{slug}', [CampusController::class, 'show'])->name('show');
    Route::get('/class/{slug}', [CampusController::class, 'showClass'])->name('show_class');
});
Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});

// Route Locale
Route::post('lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    if (in_array($locale, ['en', 'ar', 'ckb']))
        App::setLocale($locale);
})->name('lang');
