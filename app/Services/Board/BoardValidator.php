<?php

namespace App\Services\Board;

use App\Exceptions\InvalidBoardException;

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
class BoardValidator
{
    /**
     * @var array
     */
    private $boardState;

    /**
     *  Set the boardState to be validated
     *
     *  @var array $boardState
     *  @return void
     */
    public function __construct(array $boardState)
    {
        $this->boardState = $boardState;
    }

    /**
     *  Validate the boardState
     *
     *  @see    $this->validateRows()
     *  @see    $this->validateColumns()
     *  @see    $this->validateContent()
     *  @see    $this->validateTurnEquality()
     *  @return bool
     */
    public function validate()
    {
        $this->validateRows();
        $this->validateColumns();
        $this->validateContent();
        $this->validateTurnBalance();

        return true;
    }

    /**
     *  Validate if the boardState has a valid rows quantity
     *
     *  @return void
     */
    private function validateRows()
    {
        if (count($this->boardState) != 3) {
            throw new InvalidBoardException('Board must have 3 rows');
        }
    }

    /**
     *  Validate if the boardState has a valid columns quantity
     *
     *  @return void
     */
    private function validateColumns()
    {
        for ($row = 0; $row < 3; $row++) {
            if (count($this->boardState[$row]) != 3) {
                throw new InvalidBoardException('Board must have 3 columns in each row');
            }
        }
    }

    /**
     *  Validate if the boardState has a valid content
     *
     *  @return void
     */
    private function validateContent()
    {
        for ($row = 0; $row < 3; $row++) {
            for ($column = 0; $column < 3; $column++) {
                if (! in_array(strtoupper($this->boardState[$row][$column]), ['X', 'O', ''])) {
                    throw new InvalidBoardException('Board must contains "X", "O" or an empty value');
                }
            }
        }
    }

    /**
     *  Validate if the boardState has a number of turns compatible between the players
     *
     *  @return void
     */
    private function validateTurnBalance()
    {
        $playerX = 0;
        $playerY = 0;

        for ($row = 0; $row < 3; $row++) {
            for ($column = 0; $column < 3; $column++) {
                switch (strtoupper($this->boardState[$row][$column])) {
                    case 'X':
                        $playerX++;
                        break;
                    case 'O':
                        $playerY++;
                        break;
                }
            }
        }

        if (abs($playerX - $playerY) > 1) {
            throw new InvalidBoardException('Board have invalid turn difference between players');
        }
    }
}
