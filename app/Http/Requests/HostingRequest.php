<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HostingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'popular' => 'required|boolean',

            'user_id' => 'required|exists:users,id',
        ];
    }
}
