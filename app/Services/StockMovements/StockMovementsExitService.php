<?php

namespace App\Services\StockMovements;

use App\Repositories\Product\ProductRepository;
use App\Repositories\StockMovements\StockMovementsExitRepository;
use App\Utils\RepositoryHelper;
use Illuminate\Database\Eloquent\Collection;
use App\Exceptions\InsufficientStockException;
use Illuminate\Support\Facades\DB;
class StockMovementsExitService {
    
    public function __construct
    (
        protected ProductRepository $productRepository,
        protected RepositoryHelper $repositoryHelper,
        protected StockMovementsExitRepository $stockMovementsExitRepository
    )
    {}

    public function getAll(): Collection
    {
        return $this->stockMovementsExitRepository->getAll();
    }

    public function getStockMovementsByProductId(int $id): Collection
    {
        return $this->stockMovementsExitRepository->getByProductId($id);
    }

    public function getAllWithFilters(array $data): Collection
    {
        $filters = [
            'productName' => 'getByProductName',
            'date' => 'getByDate',
        ];

        $stockMovements = $this->stockMovementsExitRepository->getAllOrderedByCreationDate();

        foreach ($filters as $field => $method) {
            if (!empty($data[$field])) {
                $stockMovements = $this->stockMovementsExitRepository->$method($data[$field]);
            }
        }

        return $stockMovements;
    }

    public function create(array $data): void
    {
        $erros = [];
        $success = [];
        
        foreach ($data as $entry) {
            $product = $this->repositoryHelper->findByIdOrFail($this->productRepository, 'Produto', $entry['product_id']);
    
            if ($product->stock < $entry['quantity']) {
                $erros[] = $product->name;

                continue;
            } 
    
            $entry['previous_quantity'] = $product->stock;
            $newStock = $product->stock - $entry['quantity'];
    
            $this->productRepository->update($product->id, ['stock' => $newStock]);
    
            $this->stockMovementsExitRepository->create($entry);

            $success[] = $product->name;

        }

        if (!empty($erros)) {
            throw new InsufficientStockException('Estoque insuficiente para os seguintes produtos: ' . implode(', ', $erros));
        }

    }
}
