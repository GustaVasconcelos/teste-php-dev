<?php

namespace App\Repositories\SubCategory;

use App\Models\SubCategory;
use App\Repositories\BaseRepository;
use App\Interfaces\SubCategory\SubCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SubCategoryRepository extends BaseRepository implements SubCategoryRepositoryInterface
{
    public function __construct
    (
        SubCategory $model
    )
    {
        parent::__construct($model);
    }

    public function findByCategoryIdAndName(int $categoryId, string $name): Collection
    {
        return $this->model->where('category_id', $categoryId)
                           ->where('name', 'like', $name . '%')
                           ->get();
    }

    public function findByCategoryId(int $id): Collection
    {
        return $this->model->where('category_id', $id)->get();
    }
}