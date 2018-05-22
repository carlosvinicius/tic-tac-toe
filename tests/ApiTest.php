<?php

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
class ApiTest extends TestCase
{
    /**
     * Validate that the API receives the call sucessfully
     *
     * @return void
     */
    public function testApishowReturnClientErrorForInvalidMethodRequest()
    {
        $data = [
            'player'     => 'X',
            'boardState' => [
                ['X', '', 'X'],
                ['X', '', 'O'],
                ['', '', 'O'],
            ]
        ];

        $response = $this->call('GET', '/api/v1', $data);

        $this->assertTrue($response->isClientError());
    }

    /**
     * Validate that the API receives the call sucessfully
     *
     * @return void
     */
    public function testApiAcceptDataSuccessfully()
    {
        $data = [
            'player'     => 'X',
            'boardState' => [
                ['X', '', 'X'],
                ['X', '', 'O'],
                ['', '', 'O'],
            ]
        ];

        $response = $this->call('POST', '/api/v1', $data);

        $this->assertTrue($response->isOk());
    }

    /**
     * Validate that the API receives the call sucessfully even with  an ended game
     *
     * @return void
     */
    public function testApiAcceptWithEndedGameDataSuccessfully()
    {
        $data = [
            'unitPlayer' => 'X',
            'boardState' => [
                ['X', '', ''],
                ['X', '', 'O'],
                ['X', '', 'O'],
            ]
        ];

        $response = $this->call('POST', '/api/v1', $data);

        $this->assertTrue($response->isOk());
    }

    /**
     * Validate that the API should return Bad Request for an invalid board data submission
     *
     * @return void
     */
    public function testApiWithInvalidBoardDataShouldReturnClientError()
    {
        $data = [
            'unitPlayer' => 'X',
            'boardState' => [
                ['X', 'U', 'X'],
                ['X', '', 'O'],
                ['X', '', 'O'],
            ]
        ];

        $response = $this->call('POST', '/api/v1', $data);

        $this->assertTrue($response->isClientError());
    }

    /**
     * Validate that the API should return Bad Request for an invalid player data submission
     *
     * @return void
     */
    public function testApiWithInvalidPlayerDataShouldReturnClientError()
    {
        $data = [
            'unitPlayer' => 'U',
            'boardState' => [
                ['X', 'O', 'X'],
                ['X', '', 'O'],
                ['X', '', 'O'],
            ]
        ];

        $response = $this->call('POST', '/api/v1', $data);

        $this->assertTrue($response->isClientError());
    }
}
