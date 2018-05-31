<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\model\entity;

class Hero
{
    const HERO_HIT = 1;
    const HERO_DEAD = 2;
    protected $id;
    protected $healthPoints;
    protected $manaCount;
    protected $name;
    protected $illustration;
//    protected $heroTemplateId;
//    protected $gameId;
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
        foreach ($data as $key => $val)
        {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method))
            {
                if (is_numeric($val))
                {
                    $val = (int)$val;
                }
                $this->$method($val);
            }
        }
    }

    //
    //
    //        METHODS
    //
    //
    /**
     * @param int $force
     * @return int
     */

    public function receiveDamage(int $force): int
    {
        $health = $this->getHealthPoints() - $force;
        $this->setHealthPoints($health);
        if ($this->getHealthPoints() <= 0) {
            return self::HERO_DEAD;
        }
        return self::HERO_HIT;
    }

    public function pickCardInDeck() // method formerly known as takeCard()
    {
        // choisir une carte dans la pioche
        // la carte choisie passe de la pioche a la main ( change card $location from l_id=1(deck) to l_id=2(hand)

        $deck=$this->getCardsInDeck();
        $tailleTab=count($deck);

        if ($tailleTab > 0)
        {
            $cards[]=$deck[$tailleTab-1];
            $this->setCardsInHand($cards);
            unset($deck[$tailleTab-1]);
            $this->setCardsInDeck($deck);
        }
    }

    public function checkInvoke(int $id)
    {
        $tabHand = $this->getCardsInHand();

        foreach ($tabHand as $key => $val)
        {
            if ((int)$val->getId() == $id)
            {
                $mana = (int)$val->getMana();

                if ($this->getManaCount() >= $mana)
                {
                    return true;
                }
            }
        }
        return false;
    }

    public function discard()
    {
        // la carte disparais du board
        // change card $location to 'discard' (l_id=4)
    }

    public function playCard(int $cardId) :void   // method formerly known as invoke()
    {
        // le joueur joue sa carte sur le board
        // Change card $location to 'board' (l_id=3)

        $hand=$this->getCardsInHand();


        foreach ($hand as $key => $val)
        {
            if ((int)$val->getId() == $cardId)
            {
                $this->setCardsOnBoard($val);
                unset($hand[$key]);
            }
        }

        $this->setCardsInHand($hand);
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


    //
    //
    //        SETTERS
    //
    //
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $healthPoints
     */
    public function setHealthPoints($healthPoints)
    {
        $this->healthPoints = $healthPoints;
    }

    /**
     * @param mixed $manaCount
     */
    public function setManaCount($manaCount)
    {
        $this->manaCount = $manaCount;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $illustration
     */
    public function setIllustration($illustration)
    {
        $this->illustration = $illustration;
    }

    /**
     * @param mixed $heroTemplateId
     */
    public function setHeroTemplateId($heroTemplateId)
    {
        $this->heroTemplateId = $heroTemplateId;
    }

    /**
     * @param mixed $gameId
     */
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

    /**
     * @param mixed $cardsInDeck
     */
    public function setCardsInDeck($cardsInDeck)
    {
        $this->cardsInDeck = $cardsInDeck;
    }

    /**
     * @param mixed $cardsOnBoard
     */
    public function setCardsOnBoard($cardsOnBoard)
    {
        $this->cardsOnBoard = $cardsOnBoard;
    }

    /**
     * @param mixed $cardsInDiscard
     */
    public function setCardsInDiscard($cardsInDiscard)
    {
        $this->cardsInDiscard = $cardsInDiscard;
    }
    //
    //
    //        GETTERS
    //
    //
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getIllustration()
    {
        return $this->illustration;
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
    public function getCardsInHand()
    {
        return $this->cardsInHand;
    }

    /**
     * @return mixed
     */
    public function getCardsInDeck()
    {
        return $this->cardsInDeck;
    }

    /**
     * @return mixed
     */
    public function getCardsOnBoard()
    {
        return $this->cardsOnBoard;
    }

    /**
     * @return mixed
     */
    public function getCardsInDiscard()
    {
        return $this->cardsInDiscard;
    }

}
