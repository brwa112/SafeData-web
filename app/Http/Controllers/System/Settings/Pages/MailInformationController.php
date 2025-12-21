<?php

namespace App\Http\Controllers\System\Settings\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MailInformationRequest;
use App\Models\Pages\MailInformation;

class MailInformationController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', MailInformation::class);

        $mail_Information = MailInformation::first();

        return Inertia('System/Settings/Pages/MailInformations/Index', [
            'mail_Information' => $mail_Information,
        ]);
    }

    public function update(MailInformationRequest $request)
    {
        $this->authorize('viewAny', MailInformation::class);

        $data = $request->validated();

        // encrypted password before saving
        $data['password'] = encrypt($data['password']);

        // Call updateOrCreate directly on the model class
        MailInformation::updateOrCreate([], $data);
    }
}
