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
        if (!empty($parentId && )) {
            $query->where('parent_id', $parentId);
        }

        // Lọc theo từ khóa
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }
    

        // Phân trang kết quả
        return $query->paginate($perpage)->appends([
            'keyword' => $keyword,
            'cat_catalogue_id' => $parentId,
            'perpage' => $perpage,
        ]);
    }

}

