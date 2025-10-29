<?php

namespace App\Http\Controllers\System\Settings\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Settings\Pages\About\UpdateAboutRequest;
use App\Http\Requests\System\Settings\Pages\About\UpdateMediaRequest;
use App\Http\Requests\System\Settings\Pages\About\UpdateMessageRequest;
use App\Http\Requests\System\Settings\Pages\About\UpdateMissionRequest;
use App\Http\Requests\System\Settings\Pages\About\UpdateTouchRequest;
use App\Models\Pages\Branch;
use App\Models\Pages\About\AboutAbout;
use App\Models\Pages\Gallery;
use App\Models\Pages\About\AboutMessage;
use App\Models\Pages\About\AboutMission;
use App\Models\Pages\About\AboutTouch;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(Request $request)
    {
        $branchId = $request->input('branch_id') ?? Branch::active()->ordered()->first()->id;

        $about = AboutAbout::where('branch_id', $branchId)->first();
        $message = AboutMessage::where('branch_id', $branchId)->first();
        $mission = AboutMission::where('branch_id', $branchId)->first();
        $touch = AboutTouch::where('branch_id', $branchId)->first();

        return inertia('System/Settings/Pages/About/Index', [
            'about' => $about ? [
                'id' => $about->id,
                'description' => $about->getTranslations('description'),
                'is_active' => $about->is_active,
                'images' => $about->getMedia('images')->map->getFullUrl(),
            ] : null,
            'message' => $message ? [
                'id' => $message->id,
                'description' => $message->getTranslations('description'),
                'author' => $message->getTranslations('author'),
                'order' => $message->order ?? null,
                'is_active' => $message->is_active,
                'author_image' => $message->getFirstMediaUrl('author_image'),
            ] : null,
            'mission' => $mission ? [
                'id' => $mission->id,
                'description' => $mission->getTranslations('description'),
                'is_active' => $mission->is_active,
                'images' => $mission->getMedia('images')->map->getFullUrl(),
            ] : null,
            'touch' => $touch ? [
                'id' => $touch->id,
                'contact_email' => $touch->contact_email,
                'contact_phone' => $touch->contact_phone,
                'contact_address' => $touch->getTranslations('contact_address'),
                'map_iframe' => $touch->map_iframe ?? null,
                'is_active' => $touch->is_active,
                'images' => $touch->getMedia('images')->map->getFullUrl(),
            ] : null,
        ]);
    }

    public function updateAbout(UpdateAboutRequest $request)
    {
        $validated = $request->validated();

        $about = AboutAbout::firstOrCreate([
            'branch_id' => $request->input('branch_id'),
            'user_id' => auth()->id(),
        ], [
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'description' => $validated['description'] ?? ['en' => '', 'ckb' => ''],
            'is_active' => $validated['is_active'] ?? false,
        ]);

        $about->update([
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'description' => $validated['description'] ?? $about->description,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        // handle images if provided
        // support both legacy multiple 'images' and new single 'image'
        if ($request->input('remove_images') || $request->input('remove_image')) {
            $about->clearMediaCollection('images');
        }

        // single image upload (new behaviour)
        if ($request->hasFile('image')) {
            $about->clearMediaCollection('images');
            // add single uploaded file to the images collection
            $about->addMediaFromRequest('image')->toMediaCollection('images');
        }

        // legacy: multiple images
        if ($request->hasFile('images')) {
            // if multiple images are uploaded, clear then add
            $about->clearMediaCollection('images');
            foreach ($request->file('images') as $file) {
                $about->addMedia($file)->toMediaCollection('images');
            }
        }

    return back()->with('success', __('system.section_updated'));
    }

    public function updateMessage(UpdateMessageRequest $request)
    {
        $validated = $request->validated();

        $message = AboutMessage::firstOrCreate([
            'branch_id' => $request->input('branch_id'),
            'user_id' => auth()->id(),
        ], [
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'description' => $validated['description'] ?? ['en' => '', 'ckb' => ''],
            'author' => $validated['author'] ?? [],
            'order' => $validated['order'] ?? 0,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        $message->update([
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'description' => $validated['description'] ?? $message->description,
            'author' => $validated['author'] ?? $message->author,
            'order' => $validated['order'] ?? $message->order,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        if ($request->input('remove_author_image')) {
            $message->clearMediaCollection('author_image');
        }

        if ($request->hasFile('image')) {
            $message->clearMediaCollection('author_image');
            $message->addMediaFromRequest('image')->toMediaCollection('author_image');
        }

    return back()->with('success', __('system.section_updated'));
    }

    public function updateMission(UpdateMissionRequest $request)
    {
        $validated = $request->validated();

        $mission = AboutMission::firstOrCreate([
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

        // mission section has no images to handle

    return back()->with('success', __('system.section_updated'));
    }

    public function updateTouch(UpdateTouchRequest $request)
    {
        $validated = $request->validated();

        // normalize map_iframe input: extract src from iframe or accept plain URL
        $rawMapInput = $validated['map_iframe'] ?? null;
        $mapUrl = null;
        if (!empty($rawMapInput)) {
            if (stripos($rawMapInput, '<iframe') !== false) {
                if (preg_match('/src=["\']([^"\']+)["\']/i', $rawMapInput, $m)) {
                    $mapUrl = $m[1];
                }
            } else {
                $mapUrl = $rawMapInput;
            }
        }

        // final check: must be a valid URL
        if (empty($mapUrl) || !filter_var($mapUrl, FILTER_VALIDATE_URL)) {
            return back()->withErrors(['map_iframe' => trans('system.invalid_map_iframe')]);
        }

        $touch = AboutTouch::firstOrCreate([
            'branch_id' => $request->input('branch_id'),
            'user_id' => auth()->id(),
        ], [
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'contact_email' => $validated['contact_email'] ?? null,
            'contact_phone' => $validated['contact_phone'] ?? null,
            'contact_address' => $validated['contact_address'] ?? [],
            // store only the normalized URL
            'map_iframe' => $mapUrl,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        $touch->update([
            'user_id' => auth()->id(),
            'branch_id' => $request->input('branch_id'),
            'contact_email' => $validated['contact_email'] ?? $touch->contact_email,
            'contact_phone' => $validated['contact_phone'] ?? $touch->contact_phone,
            'contact_address' => $validated['contact_address'] ?? $touch->contact_address,
            // use normalized URL validated above
            'map_iframe' => $mapUrl,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        // touch/contact section has no images to handle

    return back()->with('success', __('system.section_updated'));
    }
}
