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
        $query->where('title', 'like', '%' . $keyword . '%');
    }

    // Lọc theo danh mục
    if ($parentId !== '' && !empty($parentId)) {
        $query->whereHas('categories', function (Builder $q) use ($parentId) {
            $q->where('id', $parentId);
        });
    }

    // Phân trang kết quả
    return $query->paginate($perpage)->appends([
        'keyword' => $keyword,
        'parent_id' => $parentId,
        'perpage' => $perpage,
    ]);
    }

}

