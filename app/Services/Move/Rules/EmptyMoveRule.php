<?php

namespace App\Services\Move\Rules;

use App\Models\Game;
use App\Models\Position;
use App\Services\Move\Rules\MoveRuleInterface;

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
class EmptyMoveRule implements MoveRuleInterface
{
    /**
     * Get the first position in the board that is available
     *
     * @param array $boardState Current board state
     * @param string $playerUnit Player unit representation
     *
     * @return array
     */
    public function getBestMove(array $boardState, string $playerUnit) : array
    {
        $bestMove = [];

        for ($row = 0; $row < 3; $row++) {
            for ($column = 0; $column < 3; $column++) {
                if (empty($boardState[$row][$column])) {
                    return [$row, $column];
                }
            }
        }

        return $bestMove;
    }

    /**
     * Indicates a next rule to be invoked in case the current is not satisfied
     *
     * @param MoveRuleInterface $nextMoveRule Next rule to be invoked if current fail
     *
     * @return void
     */
    public function setNext(MoveRuleInterface $nextMoveRule)
    {
        // There is no following rule to be invoked
    }
}
