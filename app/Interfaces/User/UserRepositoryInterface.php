<?php

namespace App\Interfaces\User;

use App\Models\User;
use App\Interfaces\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface 
{
    public function findByEmail(string $email): ?User;
}