<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\controller\hero;

use dndcompany\galaxseed\model\CardManager;
use \dndcompany\galaxseed\model\HeroManager;
use \dndcompany\galaxseed\model\entity\Hero;
use \dndcompany\galaxseed\model\entity\Card;

class HeroController
{
    public function mixCards()
    {
        // Melange les cartes
        // faire un shuffle de l'array $cardsInDeck
    }

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