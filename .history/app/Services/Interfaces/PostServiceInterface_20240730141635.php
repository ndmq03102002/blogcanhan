<?php

namespace App\Services\Interfaces;

/**
 * Interfaces UserServiceInterface
 * @package App\Services\Interfaces
 */
interface PostServiceInterface
{
    
    public function filter($keyword, $parentid, $perPage);
    
}