<?php

class RockPaperScissors
{
    public $computerChoice;
    public $userChoice;
    public $choices = array('rock', 'paper', 'scissors');
    public $alert;

    public function run()
    {
        // This function functions as your game "engine"
        // Now it's on to you to take the steering wheel and determine how it will work


        // TODO: Let userchoice stay when pressing play button -> prob with session
        if (!empty($_POST['choice'])) {
            $this->userChoice = $_POST['choice'];
            $_SESSION['userChoice'] = $this->userChoice;
        }

        if (!empty($_POST['play'])) {
            $this->computerChoice = ucfirst($this->choices[array_rand($this->choices)]);
            $_SESSION['computerChoice'] = $this->computerChoice; 
            $this->winner();
        }

        if (!empty($_POST['playAgain'])) {
           session_destroy();
        }

    }

    private function winner() 
    {
        if ($_SESSION['computerChoice'] == $_SESSION['userChoice']) {
            $this->alert = "It's a draw!";
        } else if ($_SESSION['computerChoice'] == "rock" && $_SESSION['userChoice'] == "paper" || $_SESSION['computerChoice'] == "paper" && $_SESSION['userChoice'] == "scissors" ||$_SESSION['computerChoice']  == "scissors" && $_SESSION['userChoice'] == "rock") {
            $this->alert = "You win, congratulations! You deserve a star!";
        } else if ($_SESSION['userChoice'] == NULL) {
            $this->alert = "Please choose a weapon!";
        } else {
            $this->alert = "Sadly, the computer wins!";
        }
    }

}