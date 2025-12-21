<?php

namespace App\Http\Controllers\System\Settings\Pages;

use Illuminate\Http\Request;
use App\Models\Pages\SocialLink;
use App\Models\Pages\PhoneNumbers;
use App\Http\Controllers\Controller;
use App\Http\Requests\SocialRequest;

class SocialLinkController extends Controller
{
    // Display social links and phone numbers
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

    // Update social links
    public function update(SocialRequest $request)
    {
        $this->authorize('viewAny', SocialLink::class);

        $data = $request->validated();

        $socialLink = SocialLink::first();

        $socialLink->updateOrCreate([], $data);
    }

    // Store a new phone number
    public function storePhone(Request $request)
    {
        $this->authorize('viewAny', SocialLink::class);

        $validated = $request->validate([
            'phone_number' => 'required|string|max:255|unique:phone_numbers,phone_number',
            'user_id' => 'required|exists:users,id',
        ]);

        PhoneNumbers::create($validated);

        return redirect()->back();
    }

    // Update an existing phone number
    public function updatePhone(Request $request, $id)
    {
        $this->authorize('viewAny', SocialLink::class);

        $phoneNumber = PhoneNumbers::findOrFail($id);

        $validated = $request->validate([
            'phone_number' => 'required|string|max:255|unique:phone_numbers,phone_number,' . $id,
            'user_id' => 'required|exists:users,id',
        ]);

        $phoneNumber->update(['phone_number' => $validated['phone_number']]);

        return redirect()->back();
    }

    // Delete a phone number
    public function destroy($id)
    {
        $this->authorize('viewAny', SocialLink::class);

        $phoneNumber = PhoneNumbers::findOrFail($id);
        $phoneNumber->delete();

        return redirect()->back();
    }
}
