<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\Board\BoardValidator;
use App\Services\Board\BoardStateChecker;
use App\Services\Player\PlayerValidator;
use App\Services\Move\MoveService;
use Laravel\Lumen\Routing\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @author Carlos Vinicius carlos@cvps.com.br
 */
class MoveController extends Controller
{
    /**
     * @api {post} /
     * @apiName API 1
     * @apiGroup Move
     * @apiVersion 1.0.0
     * @apiDescription Get the next move expected by the robot
     *
     * @apiParam {Array}  boardState board with the current tic-tac-toe game.
     * @apiParam {String} playerUnit identification of user in the game.
     *
     * @apiExample {json} Example usage:
     *     {
     *       "boardState":
     *       [
     *           ["X",    "O",   "O"],
     *           ["",    "O",    ""],
     *           ["X",    "",    "X"]
     *       ],
     *       "playerUnit": "X"
     *     }
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       [
     *          "nextMove"        => [2, 2, "O"],
     *          "isGameOVer"      => true,
     *          "isDraw"          => false,
     *          "winnerID"        => "X",
     *          "winnerPositions" => [[0,0], [1,1], [2,2]]
     *     }
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       'Player must be "X" or "O"'
     *     }
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $boardState = $request->get('boardState');
        $unitPlayer = $request->get('unitPlayer', 'X');

        $playerValidator = new PlayerValidator($unitPlayer);
        $playerValidator->validate();

        $boardValidator = new BoardValidator($boardState);
        $boardValidator->validate();

        $boardStateChecker = new BoardStateChecker($boardState);

        if ($boardStateChecker->hasEnded()) {
            return $this->prepareResponse($boardStateChecker);
        }

        $moveService = new MoveService();
        $move        = $moveService->makeMove($boardState, $unitPlayer);

        $boardStateChecker->setMove($move);

        $boardStateChecker->hasEnded();

        return $this->prepareResponse($boardStateChecker, $move);
    }

    /**
     * Prepare the response with the robot's next move and game status
     *
     * @param  BoardStateChecker $boardStateChecker Checker with the status of the game
     * @param  array $move Contains the robot's next move if applicable
     * @return JsonResponse
     */
    private function prepareResponse(BoardStateChecker $boardStateChecker, array $move = []) : JsonResponse
    {
        $response = [
            'nextMove'        => $move,
            'isGameOver'      => $boardStateChecker->isGameOver(),
            'isDraw'          => $boardStateChecker->isDraw(),
            'winnerID'        => $boardStateChecker->getWinner(),
            'winnerPositions' => $boardStateChecker->getWinnerPositions()
        ];

        return response()->json($response, 200);
    }
}
