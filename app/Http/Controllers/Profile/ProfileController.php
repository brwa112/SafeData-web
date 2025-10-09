<?php

namespace App\Http\Controllers\Profile;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\System\Settings\Settings\Theme;
use App\Models\System\Users\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function Index()
    {
        return Inertia::render('Profile/Index', [
            'theme' => Theme::query()->select('id', 'name', 'slug')->get(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'font_scale' => 'required',
            'font_weight' => 'required',
            'theme' => 'required',
            'language_id' => 'required',
        ]);

        // Handle different data structures
        $updateData = [
            'language_id' => is_array($data['language_id']) ? $data['language_id']['id'] : $data['language_id'],
            'font_scale' => is_array($data['font_scale']) ? $data['font_scale']['value'] : $data['font_scale'],
            'font_weight' => is_array($data['font_weight']) ? $data['font_weight']['value'] : $data['font_weight'],
            'theme' => is_array($data['theme']) ? $data['theme']['name'] : $data['theme'],
        ];

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
                'remove_avatar' => 'boolean'
            ]);
        }

        if ($request->boolean('remove_avatar')) {
            // Remove existing avatar
            $user->clearMediaCollection('avatar'); // Changed from 'avatars' to 'avatar'
        } elseif ($request->hasFile('avatar')) {
            // Clear existing avatars first
            $user->clearMediaCollection('avatar'); // Changed from 'avatars' to 'avatar'
            // Add new avatar
            $user->addMediaFromRequest('avatar')
                ->toMediaCollection('avatar'); // Changed from 'avatars' to 'avatar'
        }

        $user->settings->update($updateData);

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
