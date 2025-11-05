<?php

namespace App\Http\Controllers\Pages\Frontend;

use App\Models\Pages\Calendar\CalendarAcademic;
use App\Models\Pages\Calendar\CalendarOfficial;
use App\Models\Pages\Calendar\CalendarImportant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        // Get current branch from session or default
        $branchId = $request->input('branch_id') ?? session('selected_branch_id');

        // Get active calendar data for the selected branch
        $academic = CalendarAcademic::where('branch_id', $branchId)
            ->where('is_active', true)
            ->first();

        $official = CalendarOfficial::where('branch_id', $branchId)
            ->where('is_active', true)
            ->first();

        $important = CalendarImportant::where('branch_id', $branchId)
            ->where('is_active', true)
            ->first();

        return inertia('Frontend/Pages/Calendar/Index', [
            'academic' => $academic ? [
                'description' => $academic->getTranslations('description'),
                'activities' => $academic->getTranslations('activities'),
            ] : null,
            'official' => $official ? [
                'description' => $official->getTranslations('description'),
                'holidays' => $official->getTranslations('holidays'),
            ] : null,
            'important' => $important ? [
                'events' => $important->getTranslations('events'),
            ] : null,
        ]);
    }
}

