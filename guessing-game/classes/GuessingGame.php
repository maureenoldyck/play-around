<?php


class GuessingGame
{
    public $maxGuesses;
    public $secretNumber;

    // TODO: set a default amount of max guesses
    public function __construct(int $maxGuesses)
    {
        // We ask for the max guesses when someone creates a game
        // Allowing your settings to be chosen like this, will bring a lot of flexibility
        $this->maxGuesses = $maxGuesses;
        if (!empty($_SESSION['secretNumber'])) {
            $this->secretNumber = $_SESSION['secretNumber'];
        } 
    }

    public function run()
    {
        // This function functions as your game "engine"
        // It will run every time, check what needs to happen and run the according functions (or even create other classes)
        // TODO: check if a secret number has been generated yet
        if (empty($this->secretNumber)) {
            $this->secretNumber = rand(1,10);
            $_SESSION['secretNumber'] = $this->secretNumber;
        } 
        // --> if not, generate one and store it in the session (so it can be kept when the user submits the form)
        // TODO: check if the player has submitted a guess
        if (!empty($_POST['submit'])) {
            if ($_POST['guess'] == $this->secretNumber) {
                $this->playerWins();
            } else {
                $this->maxGuesses--;
                $this->playerLoses();
            }
        }
        // --> if so, check if the player won (run the related function) or not (give a hint if the number was higher/lower or run playerLoses if all guesses are used).
        // TODO as an extra: if a reset button was clicked, use the reset function to set up a new game
    }

    public function playerWins()
    {
        // TODO: show a winner message (mention how many tries were needed)
        // Don't use an echo here (that one goes in the view), use a return
        // return $this->alert = 'You guessed correct, congratulations you deserve a star!';
        echo 'You guessed correct, congratulations you deserve a star!';
        $_SESSION['secretNumber'] = "";
    }

    public function playerLoses()
    {
        // TODO: show a lost message (mention the secret number)
        if ($this->maxGuesses == 0) {
            echo "Sadly you lose, the secret number was {$this->secretNumber}.";
        //     echo $this->alert;
        } else {
            // return $this->alert = 'Your guess was incorect, please try again!!';
            // echo $this->alert;
            echo "Your guess was incorrect, please try again!! You have {$this->maxGuesses} guesses left!";
        }
        // Don't use an echo here (that one goes in the view), use a return
    }

    public function reset()
    {
        // TODO: Generate a new secret number and overwrite the previous one
    }
}

