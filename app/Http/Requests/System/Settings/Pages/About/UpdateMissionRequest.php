<?php

namespace App\Http\Requests\System\Settings\Pages\About;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => 'nullable|array',
            'branch_id' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function attributes(): array
    {
        return [];
    }
}
