<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\controller\hero;

use dndcompany\galaxseed\model\CardManager;
use \dndcompany\galaxseed\model\HeroManager;
use \dndcompany\galaxseed\model\entity\Hero;
use \dndcompany\galaxseed\model\entity\Card;

class HeroController
{


    public function killHero()
    {

    }



    /**
     * Recupere toutes les cartes du deck et les mélange
     * @param int $id
     * @return array
     */
    public function initDeck(int $id): array
    {
        $heroManager = new HeroManager();
        $deck = $heroManager->GetDeck($id);
        $deck = shuffle($deck);

        return $deck;
    }


    /**
     * returns an array of cards (objects) (utilisé pour montrer les cartes sur le plateau?)
     * @param int $idHero
     * @return array
     */
    public function viewHand(int $idHero): array
    {
        $heroManager= new heroManager;
        $cardHand=$heroManager->getHand($idHero);

        return $cardHand;
    }

    public function invocation(int $cardId, Hero $hero)
    {
        $cardManager=new CardManager();
        $card=new Card($cardManager->getCard($cardId));
        $result = $hero->checkInvoke($card, $hero);

        if ($result == true) {
            $hero->playCard($card, $hero);
        } else {
            echo 'Invocation impossible : mana insuffisant';
        }
    }

    public function viewCardBoard(int $idHero)
    {
        $heroManager= new heroManager;
        $cardBoard=$heroManager->getBoard($idHero);

        return $cardBoard;
    }

}