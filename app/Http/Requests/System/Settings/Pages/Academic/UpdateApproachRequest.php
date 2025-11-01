<?php

namespace App\Http\Requests\System\Settings\Pages\Academic;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApproachRequest extends FormRequest
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
            'branch_id' => 'required|exists:branches,id',
            'description' => 'required|array',
            'description.en' => 'required|string',
            'description.ckb' => 'required|string',
            'features' => 'required|array',
            'features.en' => 'required|array|min:1',
            'features.en.*' => 'required|string',
            'features.ckb' => 'required|array|min:1',
            'features.ckb.*' => 'required|string',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'description.en' => __('system.description') . ' (' . __('system.en') . ')',
            'description.ckb' => __('system.description') . ' (' . __('system.ckb') . ')',
            'features.en' => __('system.features') . ' (' . __('system.en') . ')',
            'features.en.*' => __('system.feature') . ' (' . __('system.en') . ')',
            'features.ckb' => __('system.features') . ' (' . __('system.ckb') . ')',
            'features.ckb.*' => __('system.feature') . ' (' . __('system.ckb') . ')',
        ];
    }
}
