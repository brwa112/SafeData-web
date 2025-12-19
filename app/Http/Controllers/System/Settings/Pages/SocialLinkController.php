<?php

namespace App\Http\Controllers\System\Settings\Pages;

use Illuminate\Http\Request;
use App\Models\Pages\SocialLink;
use App\Models\Pages\PhoneNumbers;
use App\Http\Controllers\Controller;

class SocialLinkController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', SocialLink::class);

        $links = SocialLink::first();
        $phone_numbers = PhoneNumbers::select('id', 'phone_number')->get();
        return Inertia('System/Settings/Pages/SocialLinks/Index', [
            'links' => $links,
            'phone_numbers' => $phone_numbers,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('viewAny', SocialLink::class);

        $phone_number = $request->validate([
            'phone_number' => 'required|unique:phone_numbers,phone_number',
            'user_id' => 'required|exists:users,id',
        ]);
        PhoneNumbers::create($phone_number);
    }

    public function update(Request $request)
    {
        $this->authorize('viewAny', SocialLink::class);

        $data = $request->validate([
            'facebook'      => 'required|url|max:255',
            'instagram'       => 'required|url|max:1024',
            'telegram'      => 'nullable|url|max:255',
            'email' => 'email|max:255',
        ]);


        $socialLink = SocialLink::first();
        $socialLink->updateOrCreate([], $data);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->authorize('viewAny', SocialLink::class);
        
        $phoneNumber = PhoneNumbers::findOrFail($id);

        $phoneNumber->delete();

        return redirect()->back();
    }
}
