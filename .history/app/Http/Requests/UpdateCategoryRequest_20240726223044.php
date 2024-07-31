<?php

namespace App\Http\Requests;
use App\Models\Category;

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
                
                // Kiểm tra nếu parent_id là danh mục hiện tại
                if ($value == $categoryId) {
                    $fail('Danh mục cha không thể là danh mục hiện tại.');
                }
                
                // Kiểm tra nếu parent_id là một trong các danh mục con của danh mục hiện tại
                if ($this->isDescendant($categoryId, $value)) {
                    $fail('Danh mục cha không thể là danh mục hiện tại hoặc danh mục con của nó.');
                }
            },
        ],
        ];
    }
    private function isDescendant($categoryId, $parentId)
{
    // Lấy danh sách tất cả các danh mục con của danh mục hiện tại
    $descendants = Category::descendantsOf($categoryId)->pluck('id')->toArray();
    
    // Kiểm tra nếu parentId nằm trong danh sách danh mục con
    return in_array($parentId, $descendants);
}
    public function messages(): array
    {
        return [
            'name.required' => 'Name không được để trống', 
            'name.unique' => 'Category đã tồn tại', 
            
        ];
        
    }
}
