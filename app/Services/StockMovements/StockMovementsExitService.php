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

    public function getAll(): Collection
    {
        return $this->stockMovementsExitRepository->getAllOrderedByCreationDate();
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
