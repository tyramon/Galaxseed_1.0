<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\controller\game;

use dndcompany\galaxseed\model\entity\Hero;
use dndcompany\galaxseed\model\entity\Game;
use dndcompany\galaxseed\model\HeroManager;

class GameController
{

    /**
     * Initializes the game:
     * 1/ gets the hero template in the database
     * 2/ gets the card associated to the hero
     * 3/ creates the hero and places his cards in the deck
     * @param int $id
     * @return Hero
     */
    public function initGame(int $id)
    {
        $heroManager= new HeroManager();
        $heroData=$heroManager->heroDataTemplate($id);
        $heroDeck=$heroManager->GetDeck($id);
        $hero=new Hero($heroData);
        $hero->setCardsInDeck($heroDeck);


        return $hero;
    }


    /**
     * retuns an array with all the info on the hero during the game.
     * @param int $idHero
     * @return array
     */
    public function getHero(int $idHero) : array
    {
        $heroManager= new HeroManager();
        $heroData=$heroManager->heroDataGame($idHero);
        return $heroData;
    }

    // Set toutes les zones de jeu en une fois dans l'objet Hero
    // Récupere tout le contenu du deck, du plateau et de la main a partir de la base de données
    // A appeler après chaque rechargement de page
    public function setAllZone(Hero $hero)
    {
        $heroManager=new HeroManager();

        $hero->setCardsInDeck($heroManager->getDeck($hero->getId()));
        $hero->setCardsOnBoard($heroManager->getBoard($hero->getId()));
        $hero->setCardsInHand($heroManager->getHand($hero->getId()));

    }


    /**
     * Increases the mana pool of each Hero by one.
     * @param Hero $hero1
     * @param Hero $hero2
     */
    public function manaPoolUp(Hero $hero1, Hero $hero2) : void
    {
        if ($hero1->getManaPool() < 10 && $hero2->getManaPool() < 10)
        {
            $newMana=$hero1->getManaPool()+1;
            $hero1->setManaPool($newMana);
            $hero2->setManaPool($newMana);
        }
    }


    /**
     * @param Game $game
     */
    public function switchPlayerTurn(Game $game) : void
    {
        $actualPlayer=$game->getTurnPlayer();
        if ($actualPlayer === 1)
        {
            $game->setTurnPlayer(2);
        }
        elseif ($actualPlayer === 2)
        {
            $game->setTurnPlayer(1);
        }
    }

//    public function finishRound()
//    {
//
//    }




    public function endGame()
    {
        //Appel d'une vue (hero gagnant)
    }

}