<DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
            <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
            <script type="text/javascript" src="assets/js/jquery.min.js"></script>
            <script type="text/javascript" src="assets/js/script.js"></script>
            <script type="text/javascript" src="assets/js/bootstrap.js"></script>
        </head>

        <body>

            <div id="container">

                <div id="start-option" class="text-center">

                    <p>Choose a side</p>

                    <button type="button" class="btn btn-primary player">X</button>

                    <button type="button" class="btn btn-primary player">O</button>

                </div>

                <div id="restart-option" class="text-center">

                    <p>You're player <span class="player"></span></p>

                    <button type="button" class="btn btn-primary restart">Restart the game</button>

                </div>

                <div id="board">
                    <div row="0" class="board-row">
                        <div column="0" player="" class="cell" ></div>
                        <div column="1" player="" class="cell middle-column"></div>
                        <div column="2" player="" class="cell"></div>
                    </div>
                    <div row="1" class="board-row middle-row">
                        <div column="0" player="" class="cell"></div>
                        <div column="1" player="" class="cell middle-column"></div>
                        <div column="2" player="" class="cell"></div>
                    </div>
                    <div row="2"  class="board-row">
                        <div column="0" player="" class="cell"></div>
                        <div column="1" player="" class="cell middle-column"></div>
                        <div column="2" player="" class="cell"></div>
                    </div>
                </div>

                <div id="message-area" class="alert alert-primary text-center"></div>

            </div>

        </body>
    </html>
