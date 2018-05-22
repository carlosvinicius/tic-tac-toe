<?php

use App\Services\Move\MoveService;
use App\Services\Move\Rules\RobotWinnerMoveRule;
use App\Services\Move\Rules\UserWinnerMoveRule;
use App\Services\Move\Rules\CenterMoveRule;
use App\Services\Move\Rules\EmptyMoveRule;
use App\Services\Move\Rules\UserNextMoveRule;

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
class MoveServiceTest extends TestCase
{
    /**
     * Test that Center Move Rule will return center position
     *
     * @return void
     */
    public function testCenterMoveRuleShouldReturnCenterPosition()
    {
        $unitPlayer = 'X';
        $boardState = [
            ['X',   'O',    ''],
            ['X',   '',    'O'],
            ['',   '' ,    ''],
        ];

        $rule = new CenterMoveRule();

        $this->assertEquals([1,1], $rule->getBestMove($boardState, $unitPlayer));
    }

    /**
     * Test that Robot Winner Move Rule will return winner position
     *
     * @return void
     */
    public function testRobotWinnerMoveRuleShouldReturnWinnerPosition()
    {
        $unitPlayer = 'X';
        $boardState = [
            ['X',   'O',    ''],
            ['X',   'O',    ''],
            ['',   '' ,    ''],
        ];

        $rule = new RobotWinnerMoveRule();

        $this->assertEquals([2,1], $rule->getBestMove($boardState, $unitPlayer));
    }

    /**
     * Test that User Winner Move Rule will return winner position
     *
     * @return void
     */
    public function testUserWinnerMoveRuleShouldReturnWinnerPosition()
    {
        $unitPlayer = 'X';
        $boardState = [
            ['X',   'O',    ''],
            ['X',   'O',    ''],
            ['',   '' ,    ''],
        ];

        $rule = new UserWinnerMoveRule();

        $this->assertEquals([2,0], $rule->getBestMove($boardState, $unitPlayer));
    }

    /**
     * Test that User Next Move Rule will return an user adjacent position
     *
     * @return void
     */
    public function testUserNextMoveRuleShouldReturnAdjacentPosition()
    {
        $unitPlayer = 'X';
        $boardState = [
            ['X',   '',    ''],
            ['',   'O',    'X'],
            ['',   '' ,    'O'],
        ];

        $rule = new UserNextMoveRule();

        $this->assertEquals([0,1], $rule->getBestMove($boardState, $unitPlayer));
    }

    /**
     * Test that Empty Move Rule will return the first empty position
     *
     * @return void
     */
    public function testEmptyMoveRuleShouldReturnTheFirstEmptyPosition()
    {
        $unitPlayer = 'X';
        $boardState = [
            ['',   '',    'X'],
            ['',   '',    ''],
            ['',   '' ,    ''],
        ];

        $rule = new EmptyMoveRule();

        $this->assertEquals([0,0], $rule->getBestMove($boardState, $unitPlayer));
    }

    /**
     * Test that Move Service will return an empty position with the robot unit
     *
     * @return void
     */
    public function testMoveServiceShouldReturnTheFirstEmptyPosition()
    {
        $unitPlayer = 'X';
        $boardState = [
            ['',   'X',    'X'],
            ['X',   'O',    'O'],
            ['O',   'X' ,    ''],
        ];

        $moveService = new MoveService();

        $this->assertEquals([0,0, 'O'], $moveService->makeMove($boardState, $unitPlayer));
    }
}
