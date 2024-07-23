<?php

namespace App\Services\StockMovements;

use App\Models\StockMovementEntry;
use App\Repositories\Product\ProductRepository;
use App\Repositories\StockMovements\StockMovementsEntryRepository;
use App\Utils\RepositoryHelper;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
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
        return $this->stockMovementsEntryRepository->getAll();
    }

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

    public function create(array $data): void
    {
        DB::beginTransaction();

        try {
            foreach ($data as $entry) {
                $product = $this->repositoryHelper->findByIdOrFail($this->productRepository, 'Produto', $entry['product_id']);
        
                $newStock = $this->calculateNewStock($product->stock, $entry['quantity']);
        
                $this->productRepository->update($product->id, ['stock' => $newStock]);
        
                $this->stockMovementsEntryRepository->create($entry);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        } 
    }

    protected function calculateNewStock(int $currentStock, int $quantity): int
    {
        return $currentStock + $quantity;
    }
    
}
