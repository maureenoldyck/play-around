<?php

class Blackjack
{
    public $cards = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
    public $randomCardName;
    public $alert = "";
    public $resetScore = "";
    public $sumUser = 'Cards total sum:';
    public $sumDealer = 'Cards total sum dealer:';
    public $hit = '<input type="submit" value="HIT" name="newCard">';
    public $stop = '<input type="submit" value="STOP" name="stopTurn">';
    public $reset = '<input type="submit" value="NEW GAME" name="newGame">';


    public function __construct()
    {
        if (empty($_SESSION['sum'])) {
            $_SESSION['sum'] = 0;
            $_SESSION['sumDealer'] = 0;
            $_SESSION['userCards'] = array();
            $_SESSION['dealerCards'] = array();
            $_SESSION['cardsPool'] = $this->cards;
            $_SESSION['cardsPoolDealer'] = $this->cards;
            $this->startCards();
        }

        if (empty($_SESSION['round'])) {
            $_SESSION['userScore'] = 0;
            $_SESSION['dealerScore'] = 0;
            $_SESSION['round'] = 0;
        }

        $this->showSums();

    } 

    public function run()
    {
        if (!empty($_POST['newCard'])) {
            $this->newCard();
        }

        if (!empty($_POST['stopTurn'])) {
            $this->dealerNewCard();
            $_SESSION['round']++;
        }

        if (!empty($_POST['newGame'])) {
            $_SESSION['sum'] = 0;
            $_SESSION['sumDealer'] = 0;
            $_SESSION['userCards'] = array();
            $_SESSION['dealerCards'] = array();
            $_SESSION['cardsPool'] = $this->cards;
            $_SESSION['cardsPoolDealer'] = $this->cards;
            $this->startCards();
        }

        if (!empty($_POST['resetScore'])) {
            $_SESSION['sum'] = 0;
            $_SESSION['sumDealer'] = 0;
            $_SESSION['userCards'] = array();
            $_SESSION['dealerCards'] = array();
            $_SESSION['cardsPool'] = $this->cards;
            $_SESSION['cardsPoolDealer'] = $this->cards;
            $_SESSION['userScore'] = 0;
            $_SESSION['dealerScore'] = 0;
            $_SESSION['round'] = 0;
            $this->startCards();
        }
    }

    private function pickCard() 
    {
        $randomCard = array_rand($_SESSION['cardsPool']);
        $this->randomCardName = $_SESSION['cardsPool'][$randomCard];
        array_push($_SESSION['userCards'], $this->randomCardName);
        \array_splice($_SESSION['cardsPool'], $randomCard, 1);
    }

    private function newCard()
    {
        $this->pickCard();
        $_SESSION['sum'] = $_SESSION['sum'] + $this->randomCardName;
        $this->showSums();
        if ($_SESSION['sum'] > 21) {
            $_SESSION['round']++;
            $_SESSION['dealerScore']++;
            $this->alert = "That is more than 21, you lose!";
            $this->deleteButtonsAndAddReset();
        } 
    }

    private function dealerNewCard() 
    {
        $this->dealerCards();
        $this->dealerTurn();
    }

    private function dealerTurn()
    {
        if ($_SESSION['sum'] == 0 ) { 
            $this->alert = 'Please hit some cards before you press stop, except if you want to lose...';
        } else if ($_SESSION['sumDealer'] < $_SESSION['sum']) {
            $this->dealerNewCard();
        } else if ($_SESSION['sumDealer'] == 21 || $_SESSION['sumDealer'] == $_SESSION['sum'] || $_SESSION['sumDealer'] > $_SESSION['sum'] && $_SESSION['sumDealer'] < 21) {
            $_SESSION['dealerScore']++;
            $this->showSums();
            $this->alert = "Dealer wins! That means you lose... \nYou had {$_SESSION['sum']}. Dealer had {$_SESSION['sumDealer']}.";
            $this->deleteButtonsAndAddReset();
        } else {
            $_SESSION['userScore']++;
            $this->showSums();
            $this->alert = "You win! Great job! \nYou had {$_SESSION['sum']}. Dealer had {$_SESSION['sumDealer']}.";
            $this->deleteButtonsAndAddReset();
        }
    }

    private function deleteButtonsAndAddReset()
    {
        $this->hit = '';
        $this->stop = '';
        $this->resetScore = '<input type="submit" value="RESET" name="resetScore">';
    }

    private function startCards()
    {
        $this->newCard();
        $this->newCard();
        $this->dealerCards();
        $this->dealerCards();
    }

    private function dealerCards()
    {
        $randomCard = array_rand($_SESSION['cardsPoolDealer']);
        $this->randomCardName = $_SESSION['cardsPoolDealer'][$randomCard];
        array_push($_SESSION['dealerCards'], $this->randomCardName);
        \array_splice($_SESSION['cardsPoolDealer'], $randomCard, 1);
        $_SESSION['sumDealer'] = $_SESSION['sumDealer'] + $this->randomCardName;
    }

    private function showSums()
    {
        $this->sumUser = 'Cards total sum: '. $_SESSION['sum'];
        $this->sumDealer = 'Cards total sum dealer: '. $_SESSION['sumDealer'];
    }

}