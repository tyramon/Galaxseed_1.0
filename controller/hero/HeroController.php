<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\controller\hero;

use \dndcompany\galaxseed\model\HeroManager;
use \dndcompany\galaxseed\model\entity\Hero;
use \dndcompany\galaxseed\model\entity\Card;

class HeroController
{

    public function killHero()
    {

    }

    //Recupere toutes les cartes du deck et les mélange
    public function initDeck(int $id): array
    {
        $heroManager = new HeroManager();
        $deck = $heroManager->GetDeck($id);
        $deck = shuffle($deck);

        return $deck;
    }

    public function viewHand(array $tabHand): string
    {
        $html = '';
        foreach ($tabHand as $card) {
            $html .= '<div>hp : ' . $card->getHp() . '<br/> mana : ' . $card->getMana() . '<br/> attaque : ' . $card->getAttack() . '
                        <form method="get" action=""> 
                            <input type="hidden" name="action" value="invoke"/>
                            <input type="hidden" name="card" value="' . $card->getId() . '"/>
                            <input type="submit" value="invoquer"/>
                        </form>
                    </div>';

        }
        return $html;
    }

    public function invocation(int $cardId, Hero $hero)
    {
        $result = $hero->checkInvoke($cardId);

        if ($result == true) {
            $hero->playCard($cardId);
        } else {
            echo 'Invocation impossible : mana insuffisant';
        }
    }

    public function viewCardBoard()
    {

    }

    public function attack(Hero $hero, Card $cible, Card $attaquant){
        if ($this->checkAttack($hero, $cible, $attaquant) === TRUE){
            $attaquant->actionAttack($cible);
            return TRUE;
        }

        return FALSE;

    }


    /**
     * @param Hero $heroadverse
     * @param Card $cible
     * @param Card $attaquant
     * @return bool
     * la carte n'as qu'un point d'action reinitialiser a chaque tour
     */
    public function checkAttack(Hero $hero, Card $cible, Card $attaquant){


        if ( ($attaquant->getStatus() == '2' ) && ($attaquant->getLocation() == '3') ){
            if ($cible->getShield() == 1 ){
                //go attack
                return TRUE ;
            }elseif($cible->getShield() == 0 && $this->checkBoardAdverse($hero) == TRUE){
                // FALSE  =  carte bouclier adverse presente
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
    public function checkBoardAdverse(Hero $hero){

        foreach ($hero->getCardsOnBoard() as $item){
            if ($item->getShield() == 1  ){
                return TRUE;
            }
        }

        return FALSE;

    }

}