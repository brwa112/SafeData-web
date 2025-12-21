<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailInformationRequest extends FormRequest
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
        $update = $this->method() === 'PUT' || $this->method() === 'PATCH';
        return [
            'mailer' => 'required|string|max:255',
            'host' => 'required|string|max:255',
            'port' => 'required|integer',
            'username' => 'required|string|max:255',
            'password' => ($update ? 'nullable' : 'required') . '|string|max:255',
            'encryption' => 'nullable|string|max:50',
            'from_address' => 'required|email|max:255',
            'from_name' => 'required|string|max:255',
        ];
    }
}
