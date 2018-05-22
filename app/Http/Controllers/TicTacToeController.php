<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
class TicTacToeController extends Controller
{
    /**
     * Show the Tic Tac Toe game interface
     */
    public function index()
    {
        return view('tic-tac-toe');
    }
}
