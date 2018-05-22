var GameController = {

    player: '',

    init: function () {

        GameController.resetGame();
        GameController.bindButtonActions();
    },

    bindButtonActions: function () {

        $('button.player').click(function() {

            GameController.player = $(this).text();

            GameController.bindActionToEmptyCells();

            GameController.showMessage('Your Turn...');

            GameController.showRestartOptions();
        });

        $('button.restart').click(function() {

            GameController.init();
        });
    },

    resetGame: function() {

        $('#message-area, #restart-option').hide();

        $('#start-option').show();

        $('.cell').attr('player', '').html('').removeClass('winner-cell loser-cell active-cell');

        GameController.unbindActionToCells();
    },

    showRestartOptions: function () {

        $('#start-option').hide();

        $('#restart-option span').html(GameController.player);

        $('#restart-option').show();
    },

    showMessage: function(message) {

        $('#message-area').show().html(message);
    },

    bindActionToEmptyCells: function() {

        $(".cell[player='']").addClass('active-cell').on('click', function () {

            GameController.setUserMoveAndGetRobotMove(this);
        });
    },

    unbindActionToCells: function() {

        $('.cell').off('click').removeClass('active-cell');
    },

    setUserMoveAndGetRobotMove: function(cell) {

        $(cell).attr("player", GameController.player).html(GameController.player);

        GameController.unbindActionToCells();

        GameController.showMessage('Robot will play...');

        GameController.getRobotMove();
    },

    getBoardState: function() {

        let boardState = [];

        for(row = 0; row < 3; row++) {

            boardState[row] = [];

            for(column = 0; column < 3; column++) {

                boardState[row][column] = $(`.board-row[row=${row}] .cell[column=${column}]`).attr("player");
            }
        }

        return boardState;
    },

    getRobotMove: function () {

        let data = {
            boardState : GameController.getBoardState(),
            unitPlayer : GameController.player
        };

        $.ajax({
            url: "api/v1",
            type: "POST",
            data: data,
            dataType: "json",
            success: function(data) {

                let isGameOver  = data['isGameOver'];
                let nextMove    = data['nextMove'];

                if (nextMove.length > 0) {

                    let row         = nextMove[0];
                    let column      = nextMove[1];
                    let robotID     = nextMove[2];

                    $(`.board-row[row=${row}] .cell[column=${column}]`).attr("player", robotID).html(robotID);
                }

                if (! isGameOver) {

                    GameController.bindActionToEmptyCells();
                    GameController.showMessage('Your Turn');
                    return;
                }

                let game = {
                    winner:     data['winnerID'],
                    positions:  data['winnerPositions'],
                    isDraw:     data['isDraw']
                }

                GameController.finishGame(game);
            },
            error: function(data) {

                GameController.showMessage(data.responseJSON);
            }
        });
    },

    finishGame: function (game) {

        let message = '';
        let style   = '';

        if (game.isDraw) {

            message = 'Draw!';

        } else if (game.winner == GameController.player) {

            message = 'You Won!';
            style   = 'winner-cell';

        } else {

            message = 'You Lost!';
            style   = 'loser-cell';
        }

        GameController.showMessage(message);

        game.positions.forEach(position => {
            let row     = position[0];
            let column  = position[1];
            $(`.board-row[row=${row}] .cell[column=${column}]`).addClass(style);
        });
    }
}

$(() => {

    GameController.init();

});