<?php

namespace App\Services\Move\Rules;

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
interface MoveRuleInterface
{
    /**
     * Given the current board state and player identification
     * the best position to move is evaluated and returned
     *
     * @param array $boardState Current board state
     * @param string $playerUnit Player unit representation
     *
     * @return array
     */
    public function getBestMove(array $boardState, string $playerUnit) : array;

    /**
     * Indicates a next rule to be invoked in case the current is not satisfied
     *
     * @param MoveRuleInterface $nextMoveRule Next rule to be invoked if current fail
     *
     * @return void
     */
    public function setNext(MoveRuleInterface $nextMoveRule);
}
