<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\controller\card;

use dndcompany\galaxseed\model\CardManager;
use dndcompany\galaxseed\model\entity\Card;
use dndcompany\galaxseed\model\entity\Hero;



class CardController
{
    public function __construct()
    {

    }


    public function attack(Card $cardAttack, Card $cardTarget)
    {
        $cardTarget->setHp($cardTarget->getHp() - $cardAttack->getAttack());

        $cardManager=new CardManager();
        $cardManager->updatePvCard($cardTarget->getId(), $cardTarget->getHp());


    }




    /**
     * @param Hero $hero
     * @param $cible
     * @param Card $attaquant
     * @return bool
     * recupere le nom de la class cible et traite en fonction
     * lance la verification d'une carte bouclier presente sur le board adverse par checkBoardAdverse
     * soustrait les point de vies du hero/carte et verifie si toujours en vie
     */
//    public function attack(Hero $hero, $cible, Card $attaquant):bool{
//        $defineClass = get_class($cible);
//        $class = str_replace('dndcompany\galaxseed\model\entity\\','',$defineClass);
//
//        if ($class == 'Card'){
//            if ($this->checkAttack($hero, $cible, $attaquant)){
//                $attaquant->actionAttack($cible);
//                return TRUE;
//            }
//            return FALSE;
//        }elseif ($class == 'Hero'){
//            if (!$this->checkBoardAdverse($cible)){
//
//                $cible->setHealthPoints($cible->getHealthPoints() - $attaquant->getAttack());
//                return TRUE;
//            }
//            return FALSE;
//        }
//
//        return FALSE;
//
//    }


    /**
     * @param Hero $heroadverse
     * @param Card $cible
     * @param Card $attaquant
     * @return bool
     * la carte n'as qu'un point d'action reinitialiser a chaque tour
     */
    public function checkAttack(Hero $hero, $cible, Card $attaquant):bool{


        if ( ($attaquant->getStatus() == '2' ) && ($attaquant->getLocation() == '3') ){
            if ($cible->getShield() == 1 ){
                //go attack
                return TRUE ;
            }elseif($cible->getShield() == 0 && $this->checkBoardAdverse($hero) == TRUE){
                // FALSE  =  carte bouclier adverse a etais trouver
                return FALSE;
            }
        }

        // obliger d'attaque la carte bouclier
        return TRUE ;

    }


    /**
     * False = une carte Shield est presente sur le board
     * True = la carte peux taper en toute impunité
     * @param Hero $heroAdverse
     * @return bool
     */
    public function checkBoardAdverse($hero){
        foreach ($hero->getCardsOnBoard() as $item){
            if ($item->getShield() == 1  ){
                return TRUE;
            }
        }
        return FALSE;
    }

//    //appel l'affichage des cartes dans la main du joueur
//    public function showHandCard(){
//
//    }
//
//// appel l'affichage des cartes sur le plateau du joueur
//    public function showBordCard(){
//
//    }
//
//    // la carte disparait du board
//    public function discard(){
//
//    }
//
//    // le joueur joue sa carte sur le board
//    public function invoke(object $card){
//
//    }
//
//    public function selectCard(){
//        // on choisit une carte pour agir avec!
//    }
//
//    //Methode SORTS
//
//    public function castSpellShield()
//    {
//        // Transforme une carte en bouclier
//    }
}
