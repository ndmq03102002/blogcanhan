<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|unique:users,username', // unique là chỉ là duy nhất username trong bảng user
            'password' => 'required|min:6',
            'email' => 'required|string|email|unique:users,email,'.$this->id.'', // unique là chỉ là duy nhất email trong bảng user, $this là trừ cái id hiện tại ra
            'role' => 'required',
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
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password phải có ít nhất 6 ký tự',
            'role.required' => 'Nhóm thành viên không được để trống',
        ];
        
    }
}
