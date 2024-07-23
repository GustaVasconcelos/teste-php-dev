<?php

namespace App\Repositories\StockMovements;

use App\Models\StockMovementExit;
use App\Repositories\BaseRepository;
use App\Interfaces\StockMovements\StockMovementsExitRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class StockMovementsExitRepository extends BaseRepository implements StockMovementsExitRepositoryInterface
{
    public function __construct
    (
        StockMovementExit $model
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
        ->join('products', 'stock_movements_exits.product_id', '=', 'products.id')
        ->where('products.name', 'like', $productName . '%')
        ->select('stock_movements_exits.*') 
        ->get();    
    }
}