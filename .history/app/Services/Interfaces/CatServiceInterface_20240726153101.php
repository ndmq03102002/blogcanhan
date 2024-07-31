<?php

namespace App\Services\Interfaces;

/**
 * Interfaces UserServiceInterface
 * @package App\Services\Interfaces
 */
interface CatServiceInterface
{
    public function paginate();
    public function filter($keyword, $userCatalogueId, $perPage);
    
}
