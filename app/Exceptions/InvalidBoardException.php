<?php

namespace App\Exceptions;

class InvalidBoardException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Player must be "X" or "O"');
    }
}
