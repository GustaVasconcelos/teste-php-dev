<?php

namespace App\Services\SubCategory;

use App\Models\SubCategory;
use App\Repositories\SubCategory\SubCategoryRepository;
use App\Utils\RepositoryHelper;
use Illuminate\Database\Eloquent\Collection;

class SubCategoryService {

    public function __construct
    (
        protected SubCategoryRepository $subCategoryRepository, 
        protected RepositoryHelper $repositoryHelper
    )
    {}

    public function getAll(): Collection
    {
        return $this->subCategoryRepository->getAll();
    }
    
    public function getAllWithFilter(int $categoryId, string $name = null): Collection
    {
        $categories = $this->subCategoryRepository->findByCategoryId($categoryId);

        if (!empty($name)) {
            $categories = $this->subCategoryRepository->findByCategoryIdAndName($categoryId, $name);
        }

        return $categories;
    }

    public function getByCategoryId(int $id): Collection
    {
        return $this->subCategoryRepository->findByCategoryId($id);
    }

    public function getById(int $id): ?SubCategory
    {
        return $this->repositoryHelper->findByIdOrFail($this->subCategoryRepository, 'Sub categoria', $id);
    }

    public function create(int $categoryId, array $data): SubCategory
    {
        $data['category_id'] = $categoryId;

        return $this->subCategoryRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $this->repositoryHelper->findByIdOrFail($this->subCategoryRepository, 'Sub categoria', $id);
        return $this->subCategoryRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        $this->repositoryHelper->findByIdOrFail($this->subCategoryRepository, 'SubCategoria', $id);
        return $this->subCategoryRepository->delete($id);
    }
}
