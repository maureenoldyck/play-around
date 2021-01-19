<?php

/* 
TODO: The drawn card is shown on the screen (just a number to represent the card is enough for now, special cards can show as 10)
TODO: The dealers hand is always visible
TODO: After the players turn, the dealer can decide to have one more card if the total amount is lower than the player
TODO: Add a basic casino style theme to the page
*/


class Blackjack
{
    public $cards = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
    public $randomCardName;
    public $userCards = array();
    public $dealerCards = array();
    public $alert = "";
    public $cardDrawn = "";
    public $sumUser = "";
    public $cardsUser = "";
    public $hit = '<input type="submit" value="HIT" name="newCard">';
    public $stop = '<input type="submit" value="STOP" name="stopTurn">';
    public $reset = '<input type="submit" value="NEW GAME" name="newGame">';


    public function run()
    {
        if (empty($_SESSION['sum'])) {
            $_SESSION['sum'] = 0;
        }

        if (empty ($_SESSION['sumDealer'])) {
            $_SESSION['sumDealer'] = 0;
        }

        if (empty($_SESSION['cardsPool'])) {
            $_SESSION['cardsPool'] = $this->cards;
        }

        if (empty($_SESSION['cardsPoolDealer'])) {
            $_SESSION['cardsPoolDealer'] = $this->cards;
        }

        if (!empty($_POST['newCard'])) {
            $this->newCard();
        }

        if (!empty($_POST['stopTurn'])) {
            $this->dealerNewCard();
        }

        if (!empty($_POST['newGame'])) {
            session_destroy();
        }
    }

    private function pickCard() 
    {
        $randomCard = array_rand($_SESSION['cardsPool']);
        $this->randomCardName = $_SESSION['cardsPool'][$randomCard];
        array_push($this->userCards, $this->randomCardName);
        \array_splice($_SESSION['cardsPool'], $randomCard, 1);
    }

    private function newCard()
    {
        $this->pickCard();
        $this->cardDrawn = $this->randomCardName;
        $_SESSION['sum'] = $_SESSION['sum'] + $this->randomCardName;
        $this->sumUser = $_SESSION['sum'];
        if ($_SESSION['sum'] > 21) {
            $this->alert = "That is more than 21, you lose!";
            $this->hit = '';
            $this->stop = '';
        } 
        $this->showCards($this->userCards);
    }

    private function dealerNewCard() 
    {
        $randomCard = array_rand($_SESSION['cardsPoolDealer']);
        $this->randomCardName = $_SESSION['cardsPoolDealer'][$randomCard];
        array_push($this->dealerCards, $this->randomCardName);
        \array_splice($_SESSION['cardsPoolDealer'], $randomCard, 1);
        $_SESSION['sumDealer'] = $_SESSION['sumDealer'] + $this->randomCardName;
        $this->dealerTurn();
    }

    private function dealerTurn()
    {
        if ($_SESSION['sum'] == 0 ) { 
            $this->alert = 'Please hit some cards before you press stop, except if you want to lose...';
        } else if ($_SESSION['sumDealer'] < $_SESSION['sum']) {
            $this->dealerNewCard();
        } else if ($_SESSION['sumDealer'] == 21 || $_SESSION['sumDealer'] == $_SESSION['sum'] || $_SESSION['sumDealer'] > $_SESSION['sum'] && $_SESSION['sumDealer'] < 21) {
            $this->alert = "Dealer wins! That means you lose... \nYou had {$_SESSION['sum']}. Dealer had {$_SESSION['sumDealer']}.";
            $this->hit = '';
            $this->stop = '';
        } else {
            $this->alert = "You win! Great job! \nYou had {$_SESSION['sum']}. Dealer had {$_SESSION['sumDealer']}.";
            $this->hit = '';
            $this->stop = '';
        }
    }

    private function showCards($array) 
    {
        foreach ($array as &$card)
        {
        echo $card;
        }
    }

}