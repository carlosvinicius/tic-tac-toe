<?php

namespace App\Services\Move\Rules;

use App\Services\Board\BoardStateChecker;
use App\Services\Move\Rules\MoveRuleInterface;

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
abstract class WinnerMoveRule implements MoveRuleInterface
{
    /**
     * @var MoveRuleInterface
     */
    private $nextMoveRule;

    /**
     * @var string
     */
    protected $player;

    /**
     * Verify the position where the player can win the match and end the game
     *  in case it's not available invoke the next rule
     *
     * @param array $boardState Current board state
     * @param string $playerUnit Player unit representation
     *
     * @return array
     */
    public function getBestMove(array $boardState, string $playerUnit) : array
    {
        for ($row = 0; $row < 3; $row++) {
            for ($column = 0; $column < 3; $column++) {
                if (!empty($boardState[$row][$column])) {
                    continue;
                }

                $newBoardState = $boardState;
                $newBoardState[$row][$column] = $this->player;

                $boardStateChecker = new BoardStateChecker($newBoardState);

                if ($boardStateChecker->hasEnded()) {
                    return [$row, $column];
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
