<?php

namespace App\Http\Requests\System\Settings\Pages\Home;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'metadata' => 'required|array',
            'metadata.youtube' => 'nullable|url',
            'metadata.facebook' => 'nullable|url',
            'metadata.instagram' => 'nullable|url',
            'metadata.twitter' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'metadata.youtube' => __('system.youtube_link'),
            'metadata.facebook' => __('system.facebook_link'),
            'metadata.instagram' => __('system.instagram_link'),
            'metadata.twitter' => __('system.twitter_link'),
        ];
    }
}
