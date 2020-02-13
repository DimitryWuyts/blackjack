<?php
require "home.php";

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
</head>
<body>

<div class="container m-5">
    <div class="col-md-12 text-center mb-5">
        <h1>Lets play some blackjack!</h1>
    </div>
    <div class="row ">
        <div class="col-md-12">
            <h3>PLAYER</h3>
            <p class="m-2">
                You:
            </p>
        </div>
        <div class="col-md-12">
            <h3>DEALER</h3>
            <p class="m-2">
                Dealer:
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <form action="game.php" method="POST" class="mr-3">
                <input type="submit" name="btn_submit" value="one more">
                <input type="submit" name="btn_submit" value="i stop"/>
                <input type="submit" name="btn_submit" value="i give up">
            </form>
        </div>
    </div>

</div>
</body>
</html>