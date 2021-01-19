<?php

/* TODO:
You'll need to create a variable containing possible card options (focus on the numbers, we don't really care about the symbols for now)
The drawn card is shown on the screen (just a number to represent the card is enough for now, special cards can show as 10)
If a card is drawn, that one disappears from the pool
What html element can be best used to display a list of the users cards?
Win conditions (21) or lose conditions are checked (22+)
If player has won or lost, the game ends and a message is showing
If not, the player can request a new card
The dealers hand is always visible
The player can stop (with a lower hand than 21), after which the dealer tries to beat him (= have a higher hand)
After the players turn, the dealer can decide to have one more card if the total amount is lower than the player
The dealer wins in the event of a draw
If the player stops, the dealer gets as many turns as needed to either win or go bust
Add a basic casino style theme to the page
*/


class Blackjack
{

    public $cards = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
    public $randomCardName;

    public function run()
    {

        if (empty($_SESSION['sum'])) {
            $_SESSION['sum'] = 0;
        }

        if (!empty($_POST['newCard'])) {
            $this->newCard();
        }

        if (!empty($_POST['newGame'])) {
            session_destroy();
        }
    }

    private function pickCard() 
    {
        $randomCard = array_rand($this->cards);
        $this->randomCardName = $this->cards[$randomCard];
        \array_splice($this->cards, $randomCard, 1);
    }

    private function newCard()
    {
        $this->pickCard();
        echo $this->randomCardName . '<br>';
        $_SESSION['sum'] = $_SESSION['sum'] + $this->randomCardName;
        echo 'Cards total:'. $_SESSION['sum'];
        if ($_SESSION['sum'] > 21) {
            echo "You lose!";
        } else if ($_SESSION['sum'] == 21) {
            echo "You win!";
        }
    }

}