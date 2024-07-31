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
            'name' => 'required|unique:categories,name', // unique là chỉ là duy nhất cat trong bảng categories
            
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
