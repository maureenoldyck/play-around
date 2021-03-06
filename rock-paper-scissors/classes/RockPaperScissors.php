<?php

class RockPaperScissors
{
    public $computerChoice;
    public $userChoice;
    public $choices = array('cat', 'mouse', 'elephant');
    public $alert;
    public $playAgain;
    public $reset;
    public $cat = '<input type="submit" name="choice" value="Cat">';
    public $mouse = '<input type="submit" name="choice" value="Mouse">';
    public $elephant = '<input type="submit" name="choice" value="Elephant">';

    public function __construct()
    {
        if (empty($_SESSION['round'])) {
            $_SESSION['userScore'] = 0;
            $_SESSION['dealerScore'] = 0;
            $_SESSION['round'] = 0;
            $_SESSION['ties'] = 0;
        }
    }

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
                $_SESSION['round']++;
                $this->computerChoice = ucfirst($this->choices[array_rand($this->choices)]);
                $this->userChoice = $_SESSION['userChoice'];
                $_SESSION['computerChoice'] = $this->computerChoice; 
                $this->winner();   
            }
        }

        if (!empty($_POST['playAgain'])) {
            $_SESSION['computerChoice'] = "";
            $_SESSION['userChoice'] = "";
        }

        if (!empty($_POST['reset'])) {
            $_SESSION['computerChoice'] = "";
            $_SESSION['userChoice'] = "";
            $_SESSION['userScore'] = 0;
            $_SESSION['dealerScore'] = 0;
            $_SESSION['round'] = 0;
            $_SESSION['ties'] = 0;
        }
    }

    private function winner() 
    {
        if ($_SESSION['computerChoice'] == $_SESSION['userChoice']) {
            $this->alert = '<span  style="color:#8BA4B3"> It\'s a draw! </span>';
            $_SESSION['ties']++;
        } else if ($_SESSION['computerChoice'] == "Cat" && $_SESSION['userChoice'] == "Elephant" || $_SESSION['computerChoice'] == "Elephant" && $_SESSION['userChoice'] == "Mouse" ||$_SESSION['computerChoice']  == "Mouse" && $_SESSION['userChoice'] == "Cat") {
            $this->alert = '<span  style="color:#9CB2A5"> You win, congratulations! You deserve a star! </span>';
            $_SESSION['userScore']++;
        } else {
            $this->alert = '<span  style="color:#733236"> Sadly, the computer wins! </span>';
            $_SESSION['dealerScore']++;
        }
        
        $this->playAgain = '<input type="submit" name="playAgain" value="Play Again" style="background-color:#303D38">';
        $this->reset = '<input type="submit" name="reset" value="Reset" style="background-color:#303D38">';
    }


    private function chosenButton()
    {
        switch ($_SESSION['userChoice']) {
            case 'Cat':
                $this->cat = '<input type="submit" name="choice" value="Cat" style="background-color:#303D38">';
                break;
            case 'Mouse':
                $this->mouse = '<input type="submit" name="choice" value="Mouse" style="background-color:#303D38">';
                break;
            case 'Elephant':
                $this->elephant = '<input type="submit" name="choice" value="Elephant" style="background-color:#303D38">';
                break;
        }
    }

}