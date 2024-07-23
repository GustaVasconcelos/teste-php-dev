<?php

namespace App\Interfaces\SubCategory;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface SubCategoryRepositoryInterface extends BaseRepositoryInterface 
{
    public function findByCategoryIdAndName(int $categoryId, string $name): Collection;

    public function findByCategoryId(int $id): Collection;

    public function belongsToCategory(int $subCategoryId, int $categoryId): bool;

    public function isUniqueInCategory(string $name, int $categoryId, int $excludeId = null): bool;
}