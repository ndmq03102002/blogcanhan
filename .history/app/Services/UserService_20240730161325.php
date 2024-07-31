<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface ;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
   
    public function paginate(){
        $users = $this->paginate();
        return $users;
    }

    public function filter($keyword, $userCatalogueId, $perPage)
    {
    // Bắt đầu query với model User
    $query = User::query();

    // Filter theo keyword
    if (!empty($keyword)) {
        $query->where(function ($q) use ($keyword) {
            $q->where('username', 'like', '%' . $keyword . '%')
              ->orWhere('email', 'like', '%' . $keyword . '%');
        });
    }

    // Filter theo user catalogue id (role)
    if (!empty($userCatalogueId) && $userCatalogueId != '0') {
        $query->where('role', $userCatalogueId);
    }

    // Paginate kết quả
    return $query->paginate($perPage)->appends([
        'keyword' => $keyword,
        'user_catalogue_id' => $userCatalogueId,
        'perpage' => $perPage,
    ]);
    }

}

