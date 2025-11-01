<?php

namespace App\Http\Requests\System\Settings\Pages\Academic;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChooseRequest extends FormRequest
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
            'reasons' => 'required|array',
            'reasons.en' => 'required|array|min:1',
            'reasons.en.*' => 'required|array',
            'reasons.en.*.title' => 'required|string',
            'reasons.en.*.description' => 'required|string',
            'reasons.en.*.icon' => 'nullable|string',
            'reasons.en.*.bgColor' => 'nullable|string',
            'reasons.en.*.borderColor' => 'nullable|string',
            'reasons.ckb' => 'required|array|min:1',
            'reasons.ckb.*' => 'required|array',
            'reasons.ckb.*.title' => 'required|string',
            'reasons.ckb.*.description' => 'required|string',
            'reasons.ckb.*.icon' => 'nullable|string',
            'reasons.ckb.*.bgColor' => 'nullable|string',
            'reasons.ckb.*.borderColor' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'description.en' => __('system.description') . ' (' . __('system.en') . ')',
            'description.ckb' => __('system.description') . ' (' . __('system.ckb') . ')',
            'reasons.en' => __('system.reasons') . ' (' . __('system.en') . ')',
            'reasons.en.*' => __('system.reason') . ' (' . __('system.en') . ')',
            'reasons.en.*.title' => __('system.title') . ' (' . __('system.en') . ')',
            'reasons.en.*.description' => __('system.description') . ' (' . __('system.en') . ')',
            'reasons.ckb' => __('system.reasons') . ' (' . __('system.ckb') . ')',
            'reasons.ckb.*' => __('system.reason') . ' (' . __('system.ckb') . ')',
            'reasons.ckb.*.title' => __('system.title') . ' (' . __('system.ckb') . ')',
            'reasons.ckb.*.description' => __('system.description') . ' (' . __('system.ckb') . ')',
        ];
    }
}
