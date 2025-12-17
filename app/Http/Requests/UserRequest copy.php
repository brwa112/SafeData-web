<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        $userId = $this->route('user') ? $this->route('user')->id : null;

        // dd($this->route('user'));

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'phone' => $userId ? 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11' : 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|unique:users,phone,' . $userId,
            'password' => $userId ? 'nullable|string|min:8' : 'required|string|min:8',
            'is_active' => 'nullable|boolean',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'roles' => 'nullable|array',
            // 'roles.*' => 'exists:roles,id',
            'permissions' => 'nullable|array',
            // 'permissions.*' => 'exists:permissions,id',
        ];
    }
}
