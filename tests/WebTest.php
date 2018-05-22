<?php

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
class WebTest extends TestCase
{
    /**
     * Validate that the Web accepts the request successfully
     *
     * @return void
     */
    public function testWebAcceptRequestSuccessfully()
    {
        $response = $this->call('GET', '/');

        $this->assertTrue($response->isOk());
    }
}
