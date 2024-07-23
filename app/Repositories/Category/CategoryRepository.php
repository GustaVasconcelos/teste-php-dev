<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Interfaces\Category\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct
    (
        Category $model
    )
    {
        parent::__construct($model);
    }

    public function findByName(string $name): Collection
    {
        return $this->model->where('name', 'like', $name . '%')->get();
    }
}