<?php

namespace App\Repositories\StockMovements;

use App\Models\StockMovementEntry;
use App\Repositories\BaseRepository;
use App\Interfaces\StockMovements\StockMovementsEntryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class StockMovementsEntryRepository extends BaseRepository implements StockMovementsEntryRepositoryInterface
{
    public function __construct
    (
        StockMovementEntry $model
    )
    {
        parent::__construct($model);
    }

    public function getAllOrderedByCreationDate(): Collection
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    public function getByDate(string $date): Collection
    {
        return $this->model
            ->whereDate('created_at', $date)
            ->orderBy('created_at', 'desc')
            ->get();    
    }

    public function getByProductName(string $productName): Collection
    {
        return $this->model
            ->join('products', 'stock_movements_entries.product_id', '=', 'products.id')
            ->where('products.name', 'like', $productName . '%')
            ->select('stock_movements_entries.*')
            ->get();
    }

    public function getByProductId(int $id): Collection
    {
        return $this->model->where('product_id', $id)->orderBy('created_at', 'desc')->get();
    }
}