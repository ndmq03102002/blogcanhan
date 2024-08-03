<?php

namespace App\Services;

use App\Services\Interfaces\PostServiceInterface;
use App\Models\Post;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Database\Eloquent\Builder;
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

    if ($parentId !== '' && !empty($parentId)) {
        $query->whereHas('categories', function (Builder $q) use ($parentId) {
            $q->where('categories.id', $parentId); // Chỉ định rõ bảng
        });
    }

    // Phân trang kết quả
    return $query->paginate($perpage)->appends([
        'keyword' => $keyword,
        'parent_id' => $parentId,
        'perpage' => $perpage,
    ]);
    }
    public function filters($parentId)
    {
    // Bắt đầu query với model User
    $query = Post::query();
        
    // Lọc theo từ khóa
   

    if ($parentId !== '' && !empty($parentId)) {
        $query->whereHas('categories', function (Builder $q) use ($parentId) {
            $q->where('categories.id', $parentId); // Chỉ định rõ bảng
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

