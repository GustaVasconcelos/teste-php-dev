<?php

namespace App\Interfaces\StockMovements;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface StockMovementsExitRepositoryInterface extends BaseRepositoryInterface 
{
    public function getAllOrderedByCreationDate(): Collection;

    public function getByDate(string $date): Collection;

    public function getByProductName(string $productName): Collection;

    public function getByProductId(int $id): Collection;
}