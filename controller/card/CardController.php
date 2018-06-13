<?php
declare(strict_types=1);



//  QUESTION:
//  A-t-on vraiment besoin d'un cardController vu que c'est le heroController qui va faire
//  les discard(), invoke(), selectcard() etc. ?



class CardController
{
    public function __construct()
    {

    }

    //appel l'affichage des cartes dans la main du joueur
    public function showHandCard(){

    }

// appel l'affichage des cartes sur le plateau du joueur
    public function showBordCard(){

    }

    // la carte disparait du board
    public function discard(){

    }

    // le joueur joue sa carte sur le board
    public function invoke(object $card){

    }

    public function selectCard(){
        // on choisit une carte pour agir avec!
    }

    //Methode SORTS

    public function castSpellShield()
    {
        // Transforme une carte en bouclier
    }
}
