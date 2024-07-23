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
}