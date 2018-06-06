<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\controller\game;

use dndcompany\galaxseed\model\entity\Hero;
use dndcompany\galaxseed\model\entity\Game;
use dndcompany\galaxseed\model\HeroManager;

class GameController
{

    public function initGame(int $id)
    {
        $heroManager= new HeroManager();
        $heroData=$heroManager->heroDataTemplate($id);
        $heroDeck=$heroManager->GetDeck($id);
        $hero=new Hero($heroData);
        $hero->setCardsInDeck($heroDeck);

        return $hero;


//        $heroManager= new HeroManager();
//        $heroData2=$heroManager->heroData(2);
//        $heroDeck2=$heroManager->GetDeck(2);
//        $hero2=new Hero($heroData2);
//        $hero2->setCardsInDeck($heroDeck2);
    }

    public function getHero(int $idHero) : array
    {
        $heroManager= new HeroManager();
        $heroData=$heroManager->heroDataGame($idHero);
        return $heroData;
    }

    public function manaPoolUp( Hero $hero1, Hero $hero2) : void
    {
        if ($hero1->getManaPool() < 10 && $hero2->getManaPool() < 10)
        {
            $newMana=$hero1->getManaPool()+1;
            $hero1->setManaPool($newMana);
            $hero2->setManaPool($newMana);
        }
    }

    public function switchPlayerTurn( Game $game) : void
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