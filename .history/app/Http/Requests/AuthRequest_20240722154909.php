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
            'username' => 'required|string|unique:user,username', // unique là chỉ là duy nhất username trong bảng user
            'password' => 'required|min:6',
            'email' => 'required|string|email|unique:user,email', // unique là chỉ là duy nhất email trong bảng user
        ];
    }
    public function messages(): array
    {
        return [
            'username.required' => 'Username không được để trống',
            'username.string' => 'Username phải là chuỗi',
            
            'email.required' => 'Email không được để trống',
            'email.string' => 'Email phải là chuỗi',
            'email.email' => 'Email không đúng định dạng',
            
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password phải có ít nhất 6 ký tự',
        ];
        
    }
}
