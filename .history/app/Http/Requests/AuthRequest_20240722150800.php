<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:user,email', //
        ];
    }
    public function messages(): array
    {
        return [
            'username.required' => 'Email không được để trống',
            'password.required' => 'Password không được để trống',
        ];
    }
}
