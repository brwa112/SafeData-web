<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function rules(): array
    {
        $service = $this->route('service') ? $this->route('service')->id : null;

        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'logo' => $service ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_logo' => 'nullable|boolean',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
