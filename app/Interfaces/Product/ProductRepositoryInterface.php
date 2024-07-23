<?php

namespace App\Interfaces\Product;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface extends BaseRepositoryInterface 
{
    public function findByName(string $name): Collection;

    public function findByCategoryId(int $id): Collection;

    public function findBySubCategoryId(int $id): Collection;

    public function findByUserId(int $id): Collection;
}