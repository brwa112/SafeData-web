<?php

namespace App\Http\Controllers\System\Settings\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class SyncTranslationController extends Controller
{
    public function syncTranslations(Request $request)
    {
        // First, import translations from PHP files to database
        Artisan::call('db:seed', ['--class' => 'TranslationsSeeder']);
        
        // Then, cache translations from database to JSON files
        Artisan::call('translations:cache');
        
        return redirect()->back()->with('success', __('common.updated'));
    }
}

