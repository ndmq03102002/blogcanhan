<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'username' => 'required|stringunique:users,username',
            'email' => 'required','email', 'unique:users,email',      
            'password' => 'required|min:6',
        ];
    }
    public function messages(): array
    {
        return [
            'username.required' => 'Username không được để trống',
            'username.string' => 'Username phải là chuỗi',
            'username.unique' => 'Username đã tồn tại',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password phải có ít nhất 6 ký tự',
            
        ];
        
    }
}
