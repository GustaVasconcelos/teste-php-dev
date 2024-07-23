<?php

namespace App\Exceptions;

use Exception;

class AuthenticationException extends Exception
{
    protected $message = 'As credenciais fornecidas são inválidas.';

    public function __construct($message = null)
    {
        if ($message) {
            $this->message = $message;
        }
        parent::__construct($this->message);
    }
}
