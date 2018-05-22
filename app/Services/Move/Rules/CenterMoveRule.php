<?php

namespace App\Services\Move\Rules;

use App\Models\Position;
use App\Models\Game;
use App\Services\Move\Rules\MoveRuleInterface;

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
class CenterMoveRule implements MoveRuleInterface
{
    /**
     * @var MoveRuleInterface
     */
    private $nextMoveRule;

    /**
     * Validate if the center position in the board is available
     *  in case it's not available invoke the next rule
     *
     * @param array $boardState Current board state
     * @param string $playerUnit Player unit representation
     *
     * @return array
     */
    public function getBestMove(array $boardState, string $playerUnit) : array
    {
        if (empty($boardState[1][1])) {
            return [1, 1];
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
