<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\controller\hero;

use \dndcompany\galaxseed\model\HeroManager;
use \dndcompany\galaxseed\model\entity\Hero;

class HeroController
{

    public function killHero()
    {

    }

    //Recupere toutes les cartes du deck et les mélange
    public function initDeck(int $id) : array
    {
        $heroManager= new HeroManager();
        $deck=$heroManager->GetDeck($id);
        $deck=shuffle($deck);

        return $deck;
    }

    public function viewHand(array $tabHand) : string
    {
        $html='';
        foreach ($tabHand as $card)
        {
            $html.='<div>'.$card->getName(). '<br/> mana : '. $card->getMana() . '<br/> attaque : ' . $card->getAttack().'
                        <form method="get" action=""> 
                            <input type="hidden" name="action" value="invoke"/>
                            <input type="hidden" name="card" value="'.$card->getId().'"/>
                            <input type="submit" value="invoquer"/>
                        </form>
                    </div>';

        }
        return $html;
    }

    public function invocation(int $cardId, Hero $hero)
    {

        $result = $hero->checkInvoke($cardId);

        if ($result == true)
        {
            $hero->playCard($cardId);
        } else {
            echo 'Invocation impossible : mana insuffisant';
        }


    }

    public function viewCardBoard()
    {

    }






}
