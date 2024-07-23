<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use App\Utils\RepositoryHelper;
use Illuminate\Database\Eloquent\Collection;

class CategoryService {
    
    public function __construct
    (
        protected CategoryRepository $categoryRepository, 
        protected RepositoryHelper $repositoryHelper
    )
    {}

    public function getAll(): Collection
    {
        return $this->categoryRepository->getAll();
    }
    
    public function getAllWithFilter(string $name = null): Collection
    {
        $categories = $this->categoryRepository->getAll();

        if (!empty($name)) {
            $categories = $this->categoryRepository->findByName($name);
        }

        return $categories;
    }

    public function getById(int $id): ?Category
    {
        return $this->repositoryHelper->findByIdOrFail($this->categoryRepository, 'Categoria', $id);
    }

    public function create(array $data): Category
    {
        return $this->categoryRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $this->repositoryHelper->findByIdOrFail($this->categoryRepository, 'Categoria', $id);
        return $this->categoryRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        $this->repositoryHelper->findByIdOrFail($this->categoryRepository, 'Categoria', $id);
        return $this->categoryRepository->delete($id);
    }
}
