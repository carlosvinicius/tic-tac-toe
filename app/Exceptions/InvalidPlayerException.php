<?php

namespace App\Exceptions;

class InvalidPlayerException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Player must be "X" or "O"');
    }
}
