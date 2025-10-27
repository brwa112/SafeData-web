<?php

namespace App\Http\Requests\System\Settings\Pages\Home;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHistoryRequest extends FormRequest
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
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
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
            'description.en' => __('system.history_description') . ' (' . __('system.en') . ')',
            'description.ckb' => __('system.history_description') . ' (' . __('system.ckb') . ')',
            'description.ar' => __('system.history_description') . ' (' . __('system.ar') . ')',
            'image_1' => __('system.image') . ' 1',
            'image_2' => __('system.image') . ' 2',
        ];
    }
}
