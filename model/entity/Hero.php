<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\model\entity;

// Le hero sert aussi de deck manager, c'est lui a les cartes et leurs emplacements. selon la location de la carte
// (dans la main, sur le plateau, dans la pioche ou dans la défausse) ou met la carte dans le tableau correspondant

use dndcompany\galaxseed\model\CardManager;
use dndcompany\galaxseed\model\HeroManager;

class Hero
{
    const HERO_HIT = 1;
    const HERO_DEAD = 2;


    protected $id;
    protected $healthPoints;
    protected $manaCount;
    protected $name;
    protected $board;
    protected $heroTemplateId;
    protected $gameId;
    protected $cardsInHand; // array -> toutes les cartes (objets) en main
    protected $cardsInDeck; // array -> toutes les cartes dans la pioche
    protected $cardsOnBoard; // array -> toutes les cartes sur le plateau
    protected $cardsInDiscard; // array -> toutes les cartes de la défausse


    public function __construct(array $dataHeroManager)
    {
        $this->hydrate($dataHeroManager);
    }


    public function hydrate(array $data): void
    {
        foreach ($data as $key => $val) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                if (is_numeric($val)) {
                    $val = (int)$val;
                }
                $this->$method($val);
            }
        }
    }


    public function receiveDamage(int $force): int
    {
        $health = $this->getHealthPoints() - $force;
        $this->setHealthPoints($health);
        if ($this->getHealthPoints() <= 0) {
            return self::HERO_DEAD;
        }
        return self::HERO_HIT;
    }

    public function pickCardInDeck()
    {
        // choisir une carte dans la pioche
        // la carte choisie passe de la pioche a la main ( change card $location from l_id=1(deck) to l_id=2(hand)

        $deck = $this->getCardsInDeck();
        $tailleTab = count($deck);

        if ($tailleTab > 0)
        {
            $card = $deck[$tailleTab - 1];
            $card->setLocation(2);
            $cards[]=$card;
            unset($deck[$tailleTab - 1]);
            $this->setCardsInDeck($deck);
            $this->setCardsInHand($cards);

            $cardManager=new CardManager();
            $cardManager->updateCardGame((int)$card->getId(), 2);
        }
    }


    //Verifie si mana suffisant pour invocation
    public function checkInvoke(Card $card, Hero $hero)
    {
        if ($card->getMana() <= $hero->getManaCount())
        {
            return true;
        }

        return false;
    }

    public function discard()
    {
        // la carte disparais du board
        // change card $location to 'discard' (l_id=4)
    }

    public function playCard(Card $card, Hero $hero): void   // method formerly known as invoke()
    {
        // le joueur joue sa carte sur le board
        // Change card $location to 'board' (l_id=3)

        $card->setLocation(3);
        $hero->setCardsOnBoard([$card]);
        $hero->setManaCount($hero->getManaCount()-$card->getMana());

        $heromanager=new HeroManager();
        $heromanager->updateHeroGame($hero->getId(), $hero->getManaCount());

        $cardManager= new CardManager();
        $cardManager->updateCardGame($card->getId(), $card->getLocation());


    }

    public function selectCardToPlay()
    {  // selectCard
        // on choisie une carte pour agir avec!
        // pouvoir choisir une des cartes qui sont dans la main (passer $cardsInHands en param et l'id
        // de la carte qu'on veut choisir)
    }

    public function castSpellShield()  // optional method.
    {
        // Transforme une carte en bouclier
        // besoin de l'id de la carte à modifier en param
        //
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function setHealthPoints($healthPoints)
    {
        $this->healthPoints = $healthPoints;
    }


    public function setManaCount($manaCount)
    {
        $this->manaCount = $manaCount;
    }


    public function setName($name)
    {
        $this->name = $name;
    }


    public function setBoard($illustration)
    {
        $this->illustration = $illustration;
    }

    public function getBoard()
    {
        return $this->board;
    }

    /**
     * @return mixed
     */
    public function getHealthPoints()
    {
        return $this->healthPoints;
    }

    /**
     * @return mixed
     */
    public function getManaCount()
    {
        return $this->manaCount;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getHeroTemplateId()
    {
        return $this->heroTemplateId;
    }

    /**
     * @return mixed
     */
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * @return mixed
     */
    public function getCardsInDiscard()
    {
        return $this->cardsInDiscard;
    }



    public function setHeroTemplateId($heroTemplateId)
    {
        $this->heroTemplateId = $heroTemplateId;
    }


    public function setGameId($gameId)
    {
        $this->gameId = $gameId;
    }

    /**
     * @param mixed $cardsInHand
     */
    public function setCardsInHand($cardsInHand)
    {
        $this->cardsInHand = $cardsInHand;
    }

    public function getCardsInHand()
    {
        return $this->cardsInHand;
    }


    public function setCardsInDeck($cardsInDeck)
    {
        $this->cardsInDeck = $cardsInDeck;
    }

    public function getCardsInDeck()
    {
        return $this->cardsInDeck;
    }


    public function setCardsOnBoard($cardsOnBoard)
    {
        $this->cardsOnBoard = $cardsOnBoard;
    }

    public function getCardsOnBoard()
    {
        return $this->cardsOnBoard;
    }


    public function setCardsInDiscard($cardsInDiscard)
    {
        $this->cardsInDiscard = $cardsInDiscard;
    }

    public function getId()
    {
        return $this->id;
    }


}