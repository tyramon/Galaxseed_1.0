<?php
/**
 * Created by PhpStorm.
 * UserManager: webuser1801
 * Date: 18/04/2018
 * Time: 14:23
 */

class CardController
{


    public function __construct()
    {
    }


    // Attaquer un joueur
    public function attack(object $cible, int $degat){

    }

    // la carte recoit des degats
    public function receiveDamage(int $degat, object $attaquant){

    }

    // la carte passe de la pioche a la main
    public function takeCard()
    {

    }

    // la carte disparais du board
    public function discard(){

    }

    // le joueur joue sa carte sur le board
    public function invoke(object $card){

    }

    public function selectCard(){
        // on choisie une carte pour agir avec!
    }

    //Methode SORTS

    public function castSpellShield()
    {
        // Transforme une carte en bouclier
    }

}
