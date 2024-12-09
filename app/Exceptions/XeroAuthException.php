<?php

namespace App\Exceptions;

use Exception;

class XeroAuthException extends Exception
{
    public function __construct($message = "Xero Authorization Error", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
