<?php

class RockPaperScissors
{
    public $computerChoice;
    public $userChoice;
    public $choices = array('cat', 'mouse', 'elephant');
    public $alert;
    public $playAgain;

    public function run()
    {
        // This function functions as your game "engine"
        // Now it's on to you to take the steering wheel and determine how it will work

        if (!empty($_POST['choice'])) {
            $this->userChoice = $_POST['choice'];
            $_SESSION['userChoice'] = $this->userChoice;
            $this->chosenButton();
        }

        if (!empty($_POST['play'])) {
            if (empty($_SESSION['userChoice'])) {
                $this->alert = "Please, choose a weapon!";
            } else {
                $this->computerChoice = ucfirst($this->choices[array_rand($this->choices)]);
                $this->userChoice = $_SESSION['userChoice'];
                $_SESSION['computerChoice'] = $this->computerChoice; 
                $this->winner();   
            }
        }

        if (!empty($_POST['playAgain'])) {
           session_destroy();
        }

    }

    private function winner() 
    {
        if ($_SESSION['computerChoice'] == $_SESSION['userChoice']) {
            $this->alert = "It's a draw!";
        } else if ($_SESSION['computerChoice'] == "Cat" && $_SESSION['userChoice'] == "Elephant" || $_SESSION['computerChoice'] == "Elephant" && $_SESSION['userChoice'] == "Mouse" ||$_SESSION['computerChoice']  == "Mouse" && $_SESSION['userChoice'] == "Cat") {
            $this->alert = "You win, congratulations! You deserve a star!";
        } else {
            $this->alert = "Sadly, the computer wins!";
        }
        
        $this->playAgain = '<input type="submit" name="playAgain" value="Play Again">';
    }


    private function chosenButton()
    {
        
    }

}