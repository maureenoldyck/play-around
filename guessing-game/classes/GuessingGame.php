<?php

class GuessingGame
{
    public $maxGuesses;
    public $secretNumber;
    public $count;
    public $alert;
    public $guessesLeft;
    
    // set a default amount of max guesses
    public function __construct(int $maxGuesses)
    {
        // We ask for the max guesses when someone creates a game
        // Allowing your settings to be chosen like this, will bring a lot of flexibility
        $this->maxGuesses = $maxGuesses;
        if (!empty($_SESSION['count'])){
            $this->count = $_SESSION['count'];
        }
        if (!empty($_SESSION['secretNumber'])){
            $this->secretNumber = $_SESSION['secretNumber'];
        }
    }

    public function run()
    {
        // This function functions as your game "engine"
        // It will run every time, check what needs to happen and run the according functions (or even create other classes)
        // --> if not, generate one and store it in the session (so it can be kept when the user submits the form)

        if(empty($this->secretNumber)) {
            $this->secretNumber = rand(1,10);
            $_SESSION['secretNumber'] = $this->secretNumber;
        }
        if (!empty($_POST['submit'])) {
            if ($_POST['guess'] == $this->secretNumber) {
                $this->playerWins(); 
            } else if (empty($_POST['guess']) || ($_POST['guess'] < 0) || ($_POST['guess'] > 10) ) {
                $this->alert = "Please, make a guess between 1 and 10";
            } else {
                $this->playerLoses();
            }
        }

        if (!empty($_POST['reset'])) {
            $_SESSION['secretNumber'] = "";
            $_SESSION['count'] = 0;
        }

    }
        // --> if so, check if the player won (run the related function) or not (give a hint if the number was higher/lower or run playerLoses if all guesses are used).
        // TODO as an extra: if a reset button was clicked, use the reset function to set up a new game
    
    public function playerWins()
    {// show a winner message (mention how many tries were needed)
        $this->count = $this->count + 1;
        session_destroy();
        return $this->alert = "Yay! You guessed the secret number in {$this->count} guesses, congratulations you deserve a star!";
    }

    public function playerLoses()
    {// show a lost message (mention the secret number)
        $_SESSION['count'] = $this->count + 1;
        $this->guessesLeft = ($this->maxGuesses - $this->count) -1 ;
        if ($this->count == ($this->maxGuesses) -1 ) {
            session_destroy();
            return $this->alert = "Sadly you lose, the secret number was {$this->secretNumber}.";
        } else if ($_POST['guess'] > $this->secretNumber){
            return $this->alert = "Your guess was too high, please try again!! You have {$this->guessesLeft} guesses left.";
        } else {
            return $this->alert = "Your guess was too low, please try again!! You have {$this->guessesLeft} guesses left.";
        }
    }

    public function reset()
    {// TODO: Generate a new secret number and overwrite the previous one
       
    }
}