<?php

use App\Services\Board\BoardValidator;

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
class BoardValidatorTest extends TestCase
{
    /**
     * Test if the validator will throw an InvalidBoardException for an board
     * with rows quantity that is not 3
     *
     * @return void
     */
    public function testInvalidRowsQuantityInBoardShouldThrowInvalidBoardException()
    {
        $this->expectException(\App\Exceptions\InvalidBoardException::class);

        $boardState = [
            ['X','O',''],
            ['','O','X']
        ];

        $validator = new BoardValidator($boardState);

        $validator->validate();
    }

    /**
     * Test if the validator will throw an InvalidBoardException for an board
     * with columns quantity that is not 3
     *
     * @return void
     */
    public function testInvalidColumnsQuantityInBoardShouldThrowInvalidBoardException()
    {
        $this->expectException(\App\Exceptions\InvalidBoardException::class);

        $boardState = [
            ['X','O',''],
            ['','O','X'],
            ['','X'],
        ];

        $validator = new BoardValidator($boardState);

        $validator->validate();
    }

    /**
     * Test if the validator will throw an InvalidBoardException for an board
     * with content different of X, O or empty value
     *
     * @return void
     */
    public function testInvalidContentInBoardShouldThrowInvalidBoardException()
    {
        $this->expectException(\App\Exceptions\InvalidBoardException::class);

        $boardState = [
            ['X','O','B'],
            ['','O','X'],
            ['','X',''],
        ];

        $validator = new BoardValidator($boardState);

        $validator->validate();
    }

    /**
     * Test if the validator will throw an InvalidBoardException for an board
     * with the difference of turns played between the players more than one
     *
     * @return void
     */
    public function testInvalidTurnBalanceInBoardShouldThrowInvalidBoardException()
    {
        $this->expectException(\App\Exceptions\InvalidBoardException::class);

        $boardState = [
            ['X','O',''],
            ['','O','X'],
            ['','X','X'],
        ];

        $validator = new BoardValidator($boardState);

        $validator->validate();
    }

    /**
     * Test if the validator will return true for a valid board
     *
     * @return void
     */
    public function testValidBoardShouldreturnTrue()
    {
        $boardState = [
            ['X','O',''],
            ['','O','X'],
            ['','X','']
        ];

        $validator = new BoardValidator($boardState);

        $validator->validate();

        $this->assertTrue($validator->validate());
    }
}
