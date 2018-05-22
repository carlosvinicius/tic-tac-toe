<?php

namespace App\Services\Player;

use App\Exceptions\InvalidPlayerException;

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
class PlayerValidator
{
    /**
     * @var string
     */
    private $player;

    public function __construct(string $player)
    {
        $this->player = strtoupper($player);
    }

    /**
     * Validate if the player informed is valid
     *
     * @return bool
     */
    public function validate()
    {
        if (! in_array($this->player, ['X','O'])) {
            throw new InvalidPlayerException();
        }

        return true;
    }
}
