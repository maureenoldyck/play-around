<?php

//TODO: Add alert when given number is not valid


class GuessingGame
{
    public $maxGuesses;
    public $secretNumber;
    public $guessesToGo;
    public $alert;

    // set a default amount of max guesses
    public function __construct(int $maxGuesses)
    {
        // We ask for the max guesses when someone creates a game
        // Allowing your settings to be chosen like this, will bring a lot of flexibility
        $this->maxGuesses = $maxGuesses;
        if (!empty($_SESSION['guessesToGo'])) {
            $this->guessesToGo = $_SESSION['guessesToGo'];
        } 
        if (!empty($_SESSION['secretNumber'])) {
            $this->secretNumber = $_SESSION['secretNumber'];
        } 
    }

    public function run()
    {
        // This function functions as your game "engine"
        // It will run every time, check what needs to happen and run the according functions (or even create other classes)
        // check if a secret number has been generated yet
        if (empty($this->secretNumber)) {
            $this->secretNumber = rand(1,10);
            $_SESSION['secretNumber'] = $this->secretNumber;
        } 
        if (empty($this->guessesToGo)) {
            $this->guessesToGo = $this->maxGuesses;
            $_SESSION['guessesToGo'] = $this->guessesToGo;
        } 
        // --> if not, generate one and store it in the session (so it can be kept when the user submits the form)
        // check if the player has submitted a guess
        if (!empty($_POST['submit'])) {
            if ($_POST['guess'] == $this->secretNumber) {
                $this->playerWins();
            } else {
                $this->playerLoses();
            }
        }
        // --> if so, check if the player won (run the related function) or not (give a hint if the number was higher/lower or run playerLoses if all guesses are used).
        // TODO as an extra: if a reset button was clicked, use the reset function to set up a new game
    }

    public function playerWins()
    {
        $guesses = 4 - $_SESSION['guessesToGo'];
        // TODO: show a winner message (mention how many tries were needed)
        // Don't use an echo here (that one goes in the view), use a return
        return $this->alert = "Yay! You guessed the secret number in {$guesses} guesses, congratulations you deserve a star!";
        session_destroy();
    }

    public function playerLoses()
    {
        $_SESSION['guessesToGo'] = $this->guessesToGo - 1;
        //show a lost message (mention the secret number)
        if ($_SESSION['guessesToGo'] == 0) {
            return $this->alert = "Sadly you lose, the secret number was {$this->secretNumber}.";
            session_destroy();
        } else if ($_POST['guess'] > $this->secretNumber){
            return $this->alert = "Your guess was too high, please try again!! You have {$_SESSION['guessesToGo']} guesses left!";
        } else {
            return $this->alert = "Your guess was too low, please try again!! You have {$_SESSION['guessesToGo']} guesses left!";
        }
        // Don't use an echo here (that one goes in the view), use a return
    }

    public function reset()
    {
        // TODO: Generate a new secret number and overwrite the previous one
    }
}

