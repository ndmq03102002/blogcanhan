<?php

namespace App\Services;

use App\Services\Interfaces\CatServiceInterface;
use App\Models\Category;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
/**
 * Class UserService
 * @package App\Services
 */
class CatService implements CatServiceInterface
{
    

    public function filter($keyword, $parentId, $perpage)
    {
    // Bắt đầu query với model User
        $query = Category::query();

        // Lọc theo danh mục cha
        if ($parentId !== '') {
            $query->where('parent_id', $parentId);
        }

        // Lọc theo từ khóa
        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        // Phân trang kết quả
        $categories = $query->paginate($perpage)->appends([
            'keyword' => $keyword,
            'parent_id' => $parentId,
            'perpage' => $perpage,
        ]);
    }

}

