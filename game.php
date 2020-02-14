<?php
//enable strict typing
declare(strict_types=1);
require "home.php";

session_start();

//enable errors
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Blackjack
{

    const LOW_CARD = 1;
    const HIGH_CARD = 11;
    private $score = 0;

//constructor for score

    public function __construct(int $score)
    {
        $this->score = $score;
    }
//--
    public function hit() {
        $card = rand(self::LOW_CARD, self::HIGH_CARD);
        $this->score += $card;
    }

    public function getScore(): int
    {
        return $this->score;
    }
//dealer
    public function stand(Blackjack $Dealer, Blackjack $Player) {

        do {
            $Dealer->hit();
            $_SESSION["Dealer"] = $Dealer->getScore();
        }
        while
        ($Dealer->getScore() < 15);

        if ($Dealer->getScore() > 21){
            echo  "You won!";
            session_destroy();
        }

        else if (($Player->getScore()) > ($Dealer->getScore())){
            echo "You won!";
            session_destroy();
        }
        else if (($Player->getScore()) == ($Dealer->getScore())){
            echo  "Tie! Dealer wins!";
            session_destroy();
        }
    }
    public function surrender() {

    }

    }

if (isset($_SESSION["Player"])) {
    $Player = new Blackjack($_SESSION["Player"]);
} else{
    $_SESSION["Player"] = 0;
    $Player = new Blackjack($_SESSION["Player"]);
}

if (isset($_SESSION["Dealer"])) {
    $Dealer = new Blackjack($_SESSION["Dealer"]);
} else {
    $_SESSION["Dealer"] = 0;
    $Dealer = new Blackjack($_SESSION["Dealer"]);
}
//player
if (isset($_REQUEST['btn_submit'])) {
    if ($_REQUEST['btn_submit'] == "HIT") {
        $Player->hit();
        $_SESSION["Player"] = $Player->getScore();

        if ($Player->getScore() > 21){
            echo "You lost";
            session_destroy();
        }
        else if ($Player->getScore() == 21) {
           echo "Blackjack! You won";
            session_destroy();
        }
    }

    if ($_REQUEST['btn_submit'] == "STAND") {
        $Player->stand($Dealer,$Player);
    }

    if ($_REQUEST['btn_submit'] == "SURRENDER") {
        $Player->surrender();
        echo  "You lose";
        session_destroy();
    }
}


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
                You: <?php echo $Player->getScore()?>
            </p>
        </div>
        <div class="col-md-12">
            <h3>DEALER</h3>
            <p class="m-2">
                Dealer: <?php echo $Dealer->getScore()?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <form action="game.php" method="POST" class="mr-3">
                <input type="submit" name="btn_submit" value="HIT">
                <input type="submit" name="btn_submit" value="STAND"/>
                <input type="submit" name="btn_submit" value="SURRENDER">
            </form>
        </div>
    </div>

</div>
</body>
</html>