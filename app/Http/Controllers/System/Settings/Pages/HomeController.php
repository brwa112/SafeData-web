<?php

namespace App\Http\Controllers\System\Settings\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Settings\Pages\Home\UpdateHeroRequest;
use App\Http\Requests\System\Settings\Pages\Home\UpdateHistoryRequest;
use App\Http\Requests\System\Settings\Pages\Home\UpdateMessageRequest;
use App\Http\Requests\System\Settings\Pages\Home\UpdateMissionRequest;
use App\Http\Requests\System\Settings\Pages\Home\UpdateSocialRequest;
use App\Models\Pages\Branch;
use App\Models\Pages\Home\HomeHero;
use App\Models\Pages\Home\HomeHistory;
use App\Models\Pages\Home\HomeMessage;
use App\Models\Pages\Home\HomeMission;
use App\Models\Pages\Home\HomeKnow;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $branchId = $request->input('branch_id') ?? Branch::active()->ordered()->first()->id;

        $hero = HomeHero::where('branch_id', $branchId)->first();
        $history = HomeHistory::where('branch_id', $branchId)->first();
        $message = HomeMessage::where('branch_id', $branchId)->first();
        $mission = HomeMission::where('branch_id', $branchId)->first();
        $social = HomeKnow::where('branch_id', $branchId)->first();

        return inertia('System/Settings/Pages/Home/Index', [
            'hero' => $hero ? [
                'id' => $hero->id,
                'title' => $hero->getTranslations('title'),
                'subtitle' => $hero->getTranslations('subtitle'),
                'metadata' => $hero->metadata,
                'is_active' => $hero->is_active,
                'hero_image' => $hero->getFirstMediaUrl('hero_image'),
                'background_video' => $hero->getFirstMediaUrl('background_video'),
            ] : null,
            'history' => $history ? [
                'id' => $history->id,
                'description' => $history->getTranslations('description'),
                'is_active' => $history->is_active,
                'images' => [
                    $history->getFirstMediaUrl('image_1'),
                    $history->getFirstMediaUrl('image_2'),
                ],
            ] : null,
            'message' => $message ? [
                'id' => $message->id,
                'description' => $message->getTranslations('description'),
                'is_active' => $message->is_active,
                'author_image' => $message->getFirstMediaUrl('author_image'),
            ] : null,
            'mission' => $mission ? [
                'id' => $mission->id,
                'description' => $mission->getTranslations('description'),
                'is_active' => $mission->is_active,
                'image' => $mission->getFirstMediaUrl('images'),
            ] : null,
            'social' => $social,
        ]);
    }

    public function updateHero(UpdateHeroRequest $request)
    {
        $validated = $request->validated();

        // Ensure required fields exist when creating a new record (DB may require non-null title)
        $hero = HomeHero::firstOrCreate([
            'branch_id' => $request->input('branch_id'),
            'user_id' => auth()->id(),
        ], [
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'title' => $validated['title'] ?? ['en' => '', 'ckb' => ''],
            'subtitle' => $validated['subtitle'] ?? ['en' => '', 'ckb' => ''],
            'metadata' => $validated['metadata'] ?? [],
            'is_active' => $validated['is_active'] ?? false,
        ]);

        // Update with validated values (or keep existing)
        $hero->update([
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'title' => $validated['title'] ?? $hero->title,
            'subtitle' => $validated['subtitle'] ?? $hero->subtitle,
            'metadata' => $validated['metadata'] ?? $hero->metadata,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        // Handle media removal (both image and video use same flag)
        if ($request->input('remove_hero_background')) {
            $hero->clearMediaCollection('hero_image');
            $hero->clearMediaCollection('background_video');
        }

        if ($request->hasFile('background_image')) {
            $hero->clearMediaCollection('hero_image');
            $hero->addMediaFromRequest('background_image')->toMediaCollection('hero_image');
        }

        if ($request->hasFile('background_video')) {
            $hero->clearMediaCollection('background_video');
            $hero->addMediaFromRequest('background_video')->toMediaCollection('background_video');
        }

        return back()->with('success', __('system.hero_section_updated'));
    }

    public function updateHistory(UpdateHistoryRequest $request)
    {
        $validated = $request->validated();

        // Ensure required fields on create for HomeHistory
        $history = HomeHistory::firstOrCreate([
            'branch_id' => $request->input('branch_id'),
            'user_id' => auth()->id(),
        ], [
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'description' => $validated['description'] ?? ['en' => '', 'ckb' => ''],
            'is_active' => $validated['is_active'] ?? false,
        ]);

        $history->update([
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'description' => $validated['description'] ?? $history->description,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        // Handle image removal and upload for image_1
        if ($request->input('remove_history_image_1')) {
            $history->clearMediaCollection('image_1');
        }

        if ($request->hasFile('image_1')) {
            $history->clearMediaCollection('image_1');
            $history->addMediaFromRequest('image_1')->toMediaCollection('image_1');
        }

        // Handle image removal and upload for image_2
        if ($request->input('remove_history_image_2')) {
            $history->clearMediaCollection('image_2');
        }

        if ($request->hasFile('image_2')) {
            $history->clearMediaCollection('image_2');
            $history->addMediaFromRequest('image_2')->toMediaCollection('image_2');
        }

        return back()->with('success', __('system.history_section_updated'));
    }

    public function updateMessage(UpdateMessageRequest $request)
    {
        $validated = $request->validated();

        // Ensure required fields on create for HomeMessage
        $message = HomeMessage::firstOrCreate([
            'branch_id' => $request->input('branch_id'),
            'user_id' => auth()->id(),
        ], [
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'description' => $validated['description'] ?? ['en' => '', 'ckb' => ''],
            'is_active' => $validated['is_active'] ?? false,
        ]);

        $message->update([
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'description' => $validated['description'] ?? $message->description,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        // Handle image removal
        if ($request->input('remove_message_image')) {
            $message->clearMediaCollection('author_image');
        }

        if ($request->hasFile('image')) {
            $message->clearMediaCollection('author_image');
            $message->addMediaFromRequest('image')->toMediaCollection('author_image');
        }

        return back()->with('success', __('system.message_section_updated'));
    }

    public function updateMission(UpdateMissionRequest $request)
    {
        $validated = $request->validated();

        // Ensure required fields on create for HomeMission
        $mission = HomeMission::firstOrCreate([
            'branch_id' => $request->input('branch_id'),
            'user_id' => auth()->id(),
        ], [
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'description' => $validated['description'] ?? ['en' => '', 'ckb' => ''],
            'is_active' => $validated['is_active'] ?? false,
        ]);

        $mission->update([
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'description' => $validated['description'] ?? $mission->description,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        // Handle image removal
        if ($request->input('remove_mission_image')) {
            $mission->clearMediaCollection('images');
        }

        if ($request->hasFile('image')) {
            $mission->clearMediaCollection('images');
            $mission->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return back()->with('success', __('system.mission_section_updated'));
    }

    public function updateSocial(UpdateSocialRequest $request)
    {
        $validated = $request->validated();

        // Ensure required fields on create for HomeKnow (social)
        $social = HomeKnow::firstOrCreate([
            'branch_id' => $request->input('branch_id'),
            'user_id' => auth()->id(),
        ], [
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'metadata' => $validated['metadata'] ?? [],
            'is_active' => $validated['is_active'] ?? false,
        ]);

        $social->update([
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'metadata' => $validated['metadata'] ?? $social->metadata,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        return back()->with('success', __('system.social_section_updated'));
    }
}
