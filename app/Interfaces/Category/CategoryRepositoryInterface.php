<?php

namespace App\Interfaces\Category;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface extends BaseRepositoryInterface 
{
    public function findByName(string $name): Collection;
}