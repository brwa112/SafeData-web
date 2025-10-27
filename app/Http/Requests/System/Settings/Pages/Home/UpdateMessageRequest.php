<?php

namespace App\Http\Requests\System\Settings\Pages\Home;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessageRequest extends FormRequest
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
            'description' => 'required|array',
            'description.en' => 'required|string',
            'description.ckb' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
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
            'description.en' => __('system.message_description') . ' (' . __('system.en') . ')',
            'description.ckb' => __('system.message_description') . ' (' . __('system.ckb') . ')',
            'description.ar' => __('system.message_description') . ' (' . __('system.ar') . ')',
            'image' => __('system.principal_image'),
        ];
    }
}
