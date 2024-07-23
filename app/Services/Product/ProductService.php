<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepository;
use App\Utils\RepositoryHelper;
use Illuminate\Database\Eloquent\Collection;

class ProductService {

    public function __construct
    (
        protected ProductRepository $productRepository, 
        protected RepositoryHelper $repositoryHelper
    )
    {}

    public function getAll(): Collection
    {
        return $this->productRepository->getAll();
    }
    
    public function getAllWithFilters(array $data): Collection
    {
        $filters = [
            'name' => 'findByName',
            'category_id' => 'findByCategoryId',
            'subcategory_id' => 'findBySubCategoryId',
            'user_id' => 'findByUserId'
        ];

        $products = $this->productRepository->getAll();

        foreach ($filters as $field => $method) {
            if (!empty($data[$field])) {
                $products = $this->productRepository->$method($data[$field]);
                dd($products);
            }
        }

        return $products;
    }

    public function getById(int $id): ?Product
    {
        return $this->repositoryHelper->findByIdOrFail($this->productRepository, 'Produto', $id);
    }

    public function create(array $data): Product
    {
        return $this->productRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $this->repositoryHelper->findByIdOrFail($this->productRepository, 'Produto', $id);
        return $this->productRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        $this->repositoryHelper->findByIdOrFail($this->productRepository, 'Produto', $id);
        return $this->productRepository->delete($id);
    }
}
