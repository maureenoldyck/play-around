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

        if (!empty($_POST['play'])) {
            $this->computerChoice = $this->choices[array_rand($this->choices)];
            $this->alert = "Computer chose {$this->computerChoice}!";
        }
    }

    function userChoiceFunction()
    {
        switch($_POST['choice']) {
            case 'rock':
                $this->userChoice = "Rock";
                break;
            case 'scissors':
                $this->userChoice = "Scissors";
                break;
            case 'paper':
                $this->userChoice = "Paper";
                break;
        }
    }

}