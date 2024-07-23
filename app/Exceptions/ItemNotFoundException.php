<?php

namespace App\Exceptions;

use Exception;

class ItemNotFoundException extends Exception
{
    protected $message = 'Item não encontrado';

    public function __construct(string $message = null)
    {
        parent::__construct($message ?? $this->message);
    }
}
