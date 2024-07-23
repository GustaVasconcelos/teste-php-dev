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
}