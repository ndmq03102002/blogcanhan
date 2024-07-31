<?php

namespace App\Http\Requests;
use App\Models\Category

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => 'required|unique:categories,name,'.$this->id.'', 
            'parent_id' => [
            'nullable',
            'integer',
            'exists:categories,id',
            function ($attribute, $value, $fail) {
                $categoryId = request()->route('id');
                $children = Category::where('parent_id', $categoryId)->pluck('id')->toArray();

                if ($value == $categoryId || in_array($value, $children)) {
                    $fail('Danh mục cha không thể là danh mục hiện tại hoặc danh mục con của nó.');
                }
            }
        ],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Name không được để trống', 
            'name.unique' => 'Category đã tồn tại', 
            
        ];
        
    }
}
