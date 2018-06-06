<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\controller\card;

use dndcompany\galaxseed\controller\game;
use dndcompany\galaxseed\model\entity\Card;


class CardController
{

    public function __construct()
    {

    }

    //appel l'affichage des cartes dans la main du joueur
    public function showHandCard(){

    }


    //appel l'affichage des cartes sur le plateau du joueur
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
