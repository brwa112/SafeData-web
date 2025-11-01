<?php

namespace App\Http\Controllers\System\Settings\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Settings\Pages\Academic\UpdateChooseRequest;
use App\Http\Requests\System\Settings\Pages\Academic\UpdateApproachRequest;
use App\Models\Pages\Branch;
use App\Models\Pages\Academic\AcademicChoose;
use App\Models\Pages\Academic\AcademicApproach;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    public function index(Request $request)
    {
        $branchId = $request->input('branch_id') ?? Branch::active()->ordered()->first()->id;

        $choose = AcademicChoose::where('branch_id', $branchId)->first();
        $approach = AcademicApproach::where('branch_id', $branchId)->first();

        return inertia('System/Settings/Pages/Academic/Index', [
            'choose' => $choose ? [
                'id' => $choose->id,
                'description' => $choose->getTranslations('description'),
                'reasons' => $choose->getTranslations('reasons'),
                'is_active' => $choose->is_active,
            ] : null,
            'approach' => $approach ? [
                'id' => $approach->id,
                'description' => $approach->getTranslations('description'),
                'features' => $approach->getTranslations('features'),
                'is_active' => $approach->is_active,
            ] : null,
        ]);
    }

    public function updateChoose(UpdateChooseRequest $request)
    {
        $validated = $request->validated();

        // Define the three colors that repeat
        $colors = [
            ['bg' => 'bg-[#F0457D]/100', 'border' => 'border-[#F0457D]'],
            ['bg' => 'bg-[#FFD44D]/100', 'border' => 'border-[#FFD44D]'],
            ['bg' => 'bg-[#0099F5]/100', 'border' => 'border-[#0099F5]']
        ];

        // Assign colors to reasons if not provided
        foreach (['en', 'ckb'] as $lang) {
            if (isset($validated['reasons'][$lang]) && is_array($validated['reasons'][$lang])) {
                foreach ($validated['reasons'][$lang] as $index => &$reason) {
                    $colorIndex = $index % 3;
                    $reason['bgColor'] = $reason['bgColor'] ?? $colors[$colorIndex]['bg'];
                    $reason['borderColor'] = $reason['borderColor'] ?? $colors[$colorIndex]['border'];
                }
            }
        }

        $choose = AcademicChoose::firstOrCreate([
            'branch_id' => $request->input('branch_id'),
        ], [
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'description' => $validated['description'] ?? ['en' => '', 'ckb' => ''],
            'reasons' => $validated['reasons'] ?? ['en' => [], 'ckb' => []],
            'is_active' => $validated['is_active'] ?? false,
        ]);

        $choose->update([
            'user_id' => auth()->id(),
            'description' => $validated['description'] ?? $choose->description,
            'reasons' => $validated['reasons'] ?? $choose->reasons,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        return redirect()->back()->with('success', trans('common.record') . ' ' . trans('common.updated'));
    }

    public function updateApproach(UpdateApproachRequest $request)
    {
        $validated = $request->validated();

        $approach = AcademicApproach::firstOrCreate([
            'branch_id' => $request->input('branch_id'),
        ], [
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'description' => $validated['description'] ?? ['en' => '', 'ckb' => ''],
            'features' => $validated['features'] ?? ['en' => [], 'ckb' => []],
            'is_active' => $validated['is_active'] ?? false,
        ]);

        $approach->update([
            'user_id' => auth()->id(),
            'description' => $validated['description'] ?? $approach->description,
            'features' => $validated['features'] ?? $approach->features,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        return redirect()->back()->with('success', trans('common.record') . ' ' . trans('common.updated'));
    }
}
