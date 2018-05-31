<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\controller\hero;

use \dndcompany\galaxseed\model\HeroManager;
use \dndcompany\galaxseed\model\entity\Hero;

class HeroController
{

<<<<<<< HEAD
    public function initDeck( )
    {
        //Recupere toutes les cartes du deck
        // appeller le cardManager pour aller chercher les cartes dans la db
        // retourne un tableau d'objet Card qui faudra affecter à l'attribut
        // $cardsInDeck dans la class Hero

    }

<<<<<<< HEAD

=======
    public function mixCards()
    {
        // Melange les cartes
        // faire un shuffle de l'array $cardsInDeck
    }
}
>>>>>>> Seb
=======
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



>>>>>>> Celine



// test push 