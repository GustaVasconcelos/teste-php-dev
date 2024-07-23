<?php

namespace App\Exceptions;

use Exception;

class InsufficientStockException extends Exception
{
    public function __construct($message = "Estoque insuficiente", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
