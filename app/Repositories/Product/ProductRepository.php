<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Interfaces\Product\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct
    (
        Product $model
    )
    {
        parent::__construct($model);
    }

    public function findByName(string $name): Collection
    {
        return $this->model->where('name', 'like', $name . '%')->get();
    }

    public function findByCategoryId(int $id): Collection
    {
        return $this->model->where('category_id', $id)->get();
    }

    public function findBySubCategoryId(int $id): Collection
    {
        return $this->model->where('subcategory_id', $id)->get();
    }

    public function findByUserId(int $id): Collection
    {
        return $this->model->where('user_id', $id)->get();
    }
}