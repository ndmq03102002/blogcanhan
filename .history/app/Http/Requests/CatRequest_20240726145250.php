<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatRequest extends FormRequest
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
            'name' => 'required|unique:category', // unique là chỉ là duy nhất username trong bảng user
            'password' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'username.required' => 'Username không được để trống', 
            'password.required' => 'Password không được để trống',
        ];
        
    }
}
