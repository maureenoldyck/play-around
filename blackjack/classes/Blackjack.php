<?php

class Blackjack
{

    public $cards = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);


    public function run()
    {

    $this->pickCard();

    }

    private function pickCard() 
    {
        $randomCard = array_rand($this->cards);
        $randomCardName = $this->cards[$randomCard];
        \array_splice($this->cards, $randomCard, 1);
    }

}