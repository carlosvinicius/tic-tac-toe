<?php

namespace App\Services\Move\Rules;

use App\Models\Game;
use App\Models\Position;
use App\Services\Move\Rules\WinnerMoveRule;

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
final class UserWinnerMoveRule extends WinnerMoveRule
{
    /**
     * Define the user will be validate as the winner in the WinnerMoveRule
     * @see WinnerMoveRule::getBestMove
     *
     * @param array $boardState Current board state
     * @param string $playerUnit Player unit representation
     *
     * @return array
     */
    public function getBestMove(array $boardState, string $playerUnit) : array
    {
        $this->player = $playerUnit == 'X' ? 'X' : 'O';

        return parent::getBestMove($boardState, $playerUnit);
    }
}
