<?php

namespace App\Services\StockMovements;

use App\Models\StockMovementEntry;
use App\Repositories\Product\ProductRepository;
use App\Repositories\StockMovements\StockMovementsEntryRepository;
use App\Utils\RepositoryHelper;
use Illuminate\Database\Eloquent\Collection;

class StockMovementsEntryService {
    
    public function __construct
    (
        protected ProductRepository $productRepository,
        protected RepositoryHelper $repositoryHelper,
        protected StockMovementsEntryRepository $stockMovementsEntryRepository
    )
    {}

    public function getAll(): Collection
    {
        return $this->stockMovementsEntryRepository->getAllOrderedByCreationDate();
    }

    public function create(array $data): StockMovementEntry
    {
        $product = $this->repositoryHelper->findByIdOrFail($this->productRepository, 'Produto', $data['product_id']);

        $data['previous_quantity'] = $product->stock;
        $newStock = $data['quantity'] + $product->stock;
        
        $this->productRepository->update($product->id, ['stock' => $newStock]);

        return $this->stockMovementsEntryRepository->create($data);
    }
    
}
