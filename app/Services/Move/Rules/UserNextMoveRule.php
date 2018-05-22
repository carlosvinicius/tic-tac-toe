<?php

namespace App\Services\Move\Rules;

use App\Models\Position;
use App\Models\Game;
use App\Services\Move\Rules\MoveRuleInterface;

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
class UserNextMoveRule implements MoveRuleInterface
{
    /**
     * @var MoveRuleInterface
     */
    private $nextMoveRule;

    /**
     * Get the first position available in the board after a user position
     *  in case it's not available invoke the next rule
     *
     * @param array $boardState Current board state
     * @param string $playerUnit Player unit representation
     *
     * @return array
     */
    public function getBestMove(array $boardState, string $playerUnit) : array
    {
        $userFound      = false;

        for ($row = 0; $row < 3; $row++) {
            for ($column = 0; $column < 3; $column++) {
                if ($userFound && empty($boardState[$row][$column])) {
                    return [$row, $column];
                }

                if ($boardState[$row][$column] == $playerUnit) {
                    $userFound = true;
                }
            }
        }

        return $this->nextMoveRule->getBestMove($boardState, $playerUnit);
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
        $this->nextMoveRule = $nextMoveRule;
    }
}
