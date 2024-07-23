<?php

namespace App\Services\StockMovements;

use App\Models\StockMovementExit;
use App\Repositories\Product\ProductRepository;
use App\Repositories\StockMovements\StockMovementsExitRepository;
use App\Utils\RepositoryHelper;
use Illuminate\Database\Eloquent\Collection;
use App\Exceptions\InsufficientStockException;

class StockMovementsExitService {
    
    public function __construct
    (
        protected ProductRepository $productRepository,
        protected RepositoryHelper $repositoryHelper,
        protected StockMovementsExitRepository $stockMovementsExitRepository
    )
    {}

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

    public function create(array $data): StockMovementExit
    {
        $product = $this->repositoryHelper->findByIdOrFail($this->productRepository, 'Produto', $data['product_id']);

        if ($product->stock < $data['quantity']) {
            throw new InsufficientStockException('Estoque insuficiente');
        }

        $data['previous_quantity'] = $product->stock;
        $newStock = $product->stock - $data['quantity'];

        $this->productRepository->update($product->id, ['stock' => $newStock]);
        
        return $this->stockMovementsExitRepository->create($data);
    }
    
}
