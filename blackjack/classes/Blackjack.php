<?php

/* 
TODO: The drawn card is shown on the screen (just a number to represent the card is enough for now, special cards can show as 10)
TODO: What html element can be best used to display a list of the users cards?
TODO: If player has won or lost, the game ends and a message is showing
TODO: If not, the player can request a new card
TODO: The dealers hand is always visible
TODO: The player can stop (with a lower hand than 21), after which the dealer tries to beat him (= have a higher hand)
TODO: After the players turn, the dealer can decide to have one more card if the total amount is lower than the player
TODO: The dealer wins in the event of a draw
TODO: If the player stops, the dealer gets as many turns as needed to either win or go bust
TODO: Add a basic casino style theme to the page
*/


class Blackjack
{
    public $cards = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
    public $randomCardName;
    public $userCards = array();
    public $dealerCards = array();

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
            $this->dealerTurn();
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
        echo 'Card drawn:' . $this->randomCardName . '<br>';
        $_SESSION['sum'] = $_SESSION['sum'] + $this->randomCardName;
        echo 'Cards total:'. $_SESSION['sum'];
        if ($_SESSION['sum'] > 21) {
            echo "You lose!";
        } else if ($_SESSION['sum'] == 21) {
            echo "You win!";
        }
    }

    private function dealerNewCard() 
    {
        $randomCard = array_rand($_SESSION['cardsPoolDealer']);
        $this->randomCardName = $_SESSION['cardsPoolDealer'][$randomCard];
        array_push($this->dealerCards, $this->randomCardName);
        \array_splice($_SESSION['cardsPoolDealer'], $randomCard, 1);
        $_SESSION['sumDealer'] = $_SESSION['sumDealer'] + $this->randomCardName;
    }

    private function dealerTurn()
    {
        if ($_SESSION['sum'] == 0 ) { 
            echo 'Please hit some cards before you press stand, except if you want to lose...';
        } else if ($_SESSION['sumDealer'] < $_SESSION['sum']) {
            $this->dealerNewCard();
        } else if ($_SESSION['sumDealer'] == 21 || $_SESSION['sumDealer'] == $_SESSION['sum'] || $_SESSION['sumDealer'] > $_SESSION['sum'] && $_SESSION['sumDealer'] < 21) {
            echo "Dealer wins! That means you lose... \nYou had {$_SESSION['sum']} Dealer had {$_SESSION['sumDealer']} .";
        } else {
            echo "You win! Great job! \nYou had {$_SESSION['sum']} Dealer had {$_SESSION['sumDealer']} .";
        }
    }

}