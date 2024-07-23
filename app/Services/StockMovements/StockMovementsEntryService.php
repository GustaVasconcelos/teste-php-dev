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

    public function getAllWithFilters(array $data): Collection
    {
        $filters = [
            'productName' => 'getByProductName',
            'date' => 'getByDate',
        ];

        $stockMovements = $this->stockMovementsEntryRepository->getAllOrderedByCreationDate();

        foreach ($filters as $field => $method) {
            if (!empty($data[$field])) {
                $stockMovements = $this->stockMovementsEntryRepository->$method($data[$field]);
            }
        }

        return $stockMovements;
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
