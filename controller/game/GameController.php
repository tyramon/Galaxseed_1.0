<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\controller\game;

use dndcompany\galaxseed\model\entity\Hero;
use dndcompany\galaxseed\model\entity\Game;


class GameController
{
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