<?php

namespace App\Http\Requests\System\Settings\Pages\About;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTouchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            // accept either iframe HTML or a plain URL; controller will extract URL
            'map_iframe' => 'required|string',
            'contact_address' => 'nullable|array',
            'branch_id' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'contact_email' => __('system.email'),
            'contact_phone' => __('system.phone'),
            'contact_address' => __('system.address'),
            'contact_address.en' => __('system.address') . ' (' . __('system.en') . ')',
            'contact_address.ckb' => __('system.address') . ' (' . __('system.ckb') . ')',
            'map_iframe' => __('system.map_iframe'),
        ];
    }
}
