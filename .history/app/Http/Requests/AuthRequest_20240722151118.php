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
            'password' => 'required',
            'email' => 'required|string|email|unique:user,email', // unique là chỉ là duy nhất email trong bảng user
        ];
    }
    public function messages(): array
    {
        return [
            'username.required' => 'Email không được để trống',
            'password.required' => 'Password không được để trống',
            'username.string' => 'Email phải là chuỗi',
            'username.unique'=> 'Username đã tồn tại',
            'email.required'=> 'Email không được để trống',
            'email.string'=> 'Email phải là chuỗi',
            
        ];
    }
}
