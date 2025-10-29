<?php

namespace App\Http\Requests\System\Settings\Pages\About;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // About section only uses description (multilingual), a single image, remove flag, is_active and branch
            'description' => 'required|array',
            'description.en' => 'required|string',
            'description.ckb' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'remove_image' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'branch_id' => 'nullable|integer',
        ];
    }

    public function attributes(): array
    {
        return [
            'description.en' => __('system.description') . ' (' . __('system.en') . ')',
            'image' => __('system.image'),
        ];
    }
}
