<?php

use App\Services\Board\BoardStateChecker;

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
class BoardStateCheckerTest extends TestCase
{
    /**
     * Validate if a boardState has ended
     *
     * @return void
     */
    public function testBoardStateShoulBeEnded()
    {
        $boardState = [
            ['X',   'O',    ''],
            ['X',   '',    'O'],
            ['X',   '' ,    ''],
        ];

        $boardStateChecker = new BoardStateChecker($boardState);

        $this->assertTrue($boardStateChecker->hasEnded());
    }

    /**
     * Validate if a ended boardState will return X as the winner
     *
     * @return void
     */
    public function testEndedBoardStateShoulReturnXAsWinner()
    {
        $boardState = [
            ['X',   'O',    ''],
            ['X',   '',    'O'],
            ['X',   '' ,    ''],
        ];

        $boardStateChecker = new BoardStateChecker($boardState);
        $boardStateChecker->hasEnded();

        $this->assertEquals('X', $boardStateChecker->getWinner());
    }

    /**
     * Validate if a ended boardState will return the following positions
     *  as the Winner Positions
     *   [[0,0],[1,0],[2,0]]
     *
     * @return void
     */
    public function testEndedBoardStateShoulReturnWinnerPosition()
    {
        $boardState = [
            ['X',   'O',    ''],
            ['X',   '',    'O'],
            ['X',   '' ,    ''],
        ];

        $boardStateChecker = new BoardStateChecker($boardState);
        $boardStateChecker->hasEnded();

        $this->assertEquals([[0,0],[1,0],[2,0]], $boardStateChecker->getWinnerPositions());
    }


    /**
     * Validate if a ended boardState will return true for isGameOver verification
     *
     * @return void
     */
    public function testEndedBoardStateShoulReturnTrueForIsGameOverVerification()
    {
        $boardState = [
            ['X',   'O',    ''],
            ['X',   '',    'O'],
            ['X',   '' ,    ''],
        ];

        $boardStateChecker = new BoardStateChecker($boardState);
        $boardStateChecker->hasEnded();

        $this->assertTrue($boardStateChecker->isGameOver());
    }


    /**
     * Validate if a on going boardState will return false for isGameOver verification
     *
     * @return void
     */
    public function testEndedBoardStateShoulReturnFalseForIsGameOverVerification()
    {
        $boardState = [
            ['X',   'O',    ''],
            ['X',   '',    ''],
            ['',   'O' ,    ''],
        ];

        $boardStateChecker = new BoardStateChecker($boardState);
        $boardStateChecker->hasEnded();

        $this->assertEquals(false, $boardStateChecker->isGameOver());
    }

    /**
     * Validate if a ended boardState will return as true for isGameOver verification
     *
     * @return void
     */
    public function testEndedBoardStateShoulReturnFalseForIsDrawVerification()
    {
        $boardState = [
            ['X',   'O',    ''],
            ['X',   '',    ''],
            ['X',   '' ,    ''],
        ];

        $boardStateChecker = new BoardStateChecker($boardState);
        $boardStateChecker->hasEnded();

        $this->assertEquals(false, $boardStateChecker->isDraw());
    }

    /**
     * Validate if a ended boardState will return as true for isDraw verification
     *
     * @return void
     */
    public function testEndedBoardStateShoulReturnTrueForIsDrawVerification()
    {
        $boardState = [
            ['X',   'O',    'X'],
            ['X',   'O',    'O'],
            ['O',   'X' ,   'X'],
        ];

        $boardStateChecker = new BoardStateChecker($boardState);
        $boardStateChecker->hasEnded();

        $this->assertTrue($boardStateChecker->isDraw());
    }
}
