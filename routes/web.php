<?php

use App\Http\Controllers\Pages\Frontend\HomeController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// Route::redirect('/', '/control');

// Default routes (will use first branch or session branch)
Route::middleware('track.visitors')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::post('/send-mail', [HomeController::class, 'sendMail'])
        ->name('send.mail')
        ->middleware('mail.config');
});

// Route Locale
Route::post('lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    if (in_array($locale, ['en', 'ar', 'ckb']))
        App::setLocale($locale);
})->name('lang');
