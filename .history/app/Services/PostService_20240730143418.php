<?php

namespace App\Services;

use App\Services\Interfaces\PostServiceInterface;
use App\Models\Post;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
/**
 * Class UserService
 * @package App\Services
 */
class PostService implements PostServiceInterface
{
    

    public function filter($keyword, $parentId, $perpage)
    {
    // Bắt đầu query với model User
        $query = Post::query();
        

        // Lọc theo từ khóa
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                 ;
            });
        } 
        // Lọc theo danh mục cha
        if ($parentId !== '' && !empty($parentId)) {
            $query->where('parent_id', $parentId);
        }
    

        // Phân trang kết quả
        return $query->paginate($perpage)->appends([
            'keyword' => $keyword,
            'cat_catalogue_id' => $parentId,
            'perpage' => $perpage,
        ]);
    }

}

