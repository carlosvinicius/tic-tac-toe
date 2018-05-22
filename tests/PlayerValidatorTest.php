<?php

use App\Services\Player\PlayerValidator;

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
class PlayerValidatorTest extends TestCase
{
    /**
     * Test if the validator will throw an InvalidPlayerException for an invalid unitPlayer
     *
     * @return void
     */
    public function testInvalidPlayerShouldThrowInvalidPlayerException()
    {
        $this->expectException(\App\Exceptions\InvalidPlayerException::class);

        $unitPlayer = 'B';

        $validator = new PlayerValidator($unitPlayer);

        $validator->validate();
    }

    /**
     * Test if the validator will return true for a valid unitPlayer
     *
     * @return void
     */
    public function testValidPlayerShouldreturnTrue()
    {
        $unitPlayer = 'X';

        $validator = new PlayerValidator($unitPlayer);

        $validator->validate();

        $this->assertTrue($validator->validate());
    }
}
