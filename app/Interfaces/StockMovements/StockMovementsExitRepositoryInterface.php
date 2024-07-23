<?php

namespace App\Interfaces\StockMovements;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface StockMovementsExitRepositoryInterface extends BaseRepositoryInterface 
{
    public function getAllOrderedByCreationDate(): Collection;
}