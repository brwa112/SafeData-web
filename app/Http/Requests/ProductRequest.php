<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1500',
            'url' => 'nullable|url',

            'user_id' => 'required|exists:users,id',
        ];
    }
}
