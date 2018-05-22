<?php

namespace App\Services\Board;

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
class BoardStateChecker
{
    /**
     * @var string
     */
    private $winner;

    /**
     * @var array
     */
    private $winnerPositions;

    /**
     * @var bool
     */
    private $isDraw;

    /**
     * @var bool
     */
    private $isGameOver;

    /**
     * @var array
     */
    private $boardState;

    /**
     *  Set the boardState to be checked and initialize other vars
     *
     *  @var array $boardState
     *  @return void
     */
    public function __construct(array $boardState)
    {
        $this->boardState      = $boardState;
        $this->winner          = '';
        $this->winnerPositions = [];
        $this->isDraw          = false;
        $this->isGameOver      = false;
    }

    /**
     * Check if the game has been terminated.
     * In case the game is over:
     *  In case of a victory, the winner and positions will be set
     *  In case of a tie, isDraw will be set to true
     *
     * @return bool
     */
    public function hasEnded() : bool
    {
        foreach ($this->getWinniningPossibilities() as $winningPossibility) {
            $players = [];

            foreach ($winningPossibility as $winningPosition) {
                $row    = $winningPosition[0];
                $column = $winningPosition[1];
                array_push($players, $this->boardState[$row][$column]);
            }

            $isUniquePlayer   = count(array_unique($players)) == 1;
            $playerOccurrence = count(array_filter($players));

            if ($isUniquePlayer && $playerOccurrence == 3) {
                $this->winner          = array_pop($players);
                $this->winnerPositions = $winningPossibility;
                $this->isGameOver = true;
                break;
            }
        }

        if (! $this->isGameOver) {
            foreach ($this->boardState as $row) {
                foreach ($row as $cell) {
                    if (empty($cell)) {
                        return $this->isGameOver;
                    }
                }
            }

            $this->isGameOver = true;
            $this->isDraw     = true;
        }

        return $this->isGameOver;
    }

    /**
     * Return if the game is over
     *
     * @return bool
     */
    public function isGameOver()
    {
        return $this->isGameOver;
    }

    /**
     * Return if the game result is draw
     *
     * @return bool
     */
    public function isDraw()
    {
        return $this->isDraw;
    }

    /**
     * Return the Winner of the game
     *
     * @return null | Player
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Return the position of the victory
     *
     * @return array
     */
    public function getWinnerPositions() : array
    {
        return $this->winnerPositions;
    }

    /**
     * Return all victory possibilities
     *
     * @return array
     */
    private function getWinniningPossibilities() : array
    {
        $winningPossibilities = [
            // Rows
            [[0, 0], [0, 1], [0, 2]],
            [[1, 0], [1, 1], [1, 2]],
            [[2, 0], [2, 1], [2, 2]],
            // Columns
            [[0, 0], [1, 0], [2, 0]],
            [[0, 1], [1, 1], [2, 1]],
            [[0, 2], [1, 2], [2, 2]],
            // Diagonals
            [[0, 0], [1, 1], [2, 2]],
            [[2, 0], [1, 1], [0, 2]]
        ];

        return $winningPossibilities;
    }

    /**
     * Update the boardState for a new Check
     *
     * @param array $move
     * @return void
     */
    public function setMove(array $move)
    {
        $this->boardState[$move[0]][$move[1]] = $move[2];
    }
}
