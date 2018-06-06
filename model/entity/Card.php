<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\model\entity;

use dndcompany\galaxseed\model\CardManager;

/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 16/05/2018
 * Time: 10:18
 */

class card
{
    private $id;
    private $name;
    private $hp;
    private $mana;
    private $attack;
    private $shield;
    private $location;
    private $status;
    private $hero;
    private $illustration;
    private $type;
    private $description;


    public function __construct(array $cardData)
    {
        $this->hydrate($cardData);
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

    // Attaquer un joueur
    public function attack(object $cible, objet $attaquant){
        $degats = $this->getAttack();
        $cible->receiveDamage($degats, $attaquant);

    }

    // la carte recoit des degats
    public function receiveDamage(int $degat, object $attaquant){
        $this->setHp($this->getHp() - $degat);
        if($this->getHp() <= 0){
            //defauser la carte
            $this->setLocation('discard');
        }
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function setDescription($description): void
    {
        $this->description = $description;
    }


    public function getType()
    {
        return $this->type;
    }


    public function setType($type): void
    {
        $this->type = $type;
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;
    }


    public function getHp()
    {
        return $this->hp;
    }


    public function setHp($hp)
    {
        $this->hp = $hp;
    }


    public function getMana()
    {
        return $this->mana;
    }


    public function setMana($mana)
    {
        $this->mana = $mana;
    }


    public function getAttack()
    {
        return $this->attack;
    }


    public function setAttack($attack)
    {
        $this->attack = $attack;
    }


    public function getShield()
    {
        return $this->shield;
    }


    public function setShield($shield)
    {
        $this->shield = $shield;
    }


    public function getLocation()
    {
        return $this->location;
    }


    public function setLocation(int $idLoc)
    {
        $this->location = $idLoc;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getHero()
    {
        return $this->hero;
    }

    /**
     * @param mixed $hero
     */
    public function setHero($hero)
    {
        $this->hero = $hero;
    }

    /**
     * @return mixed
     */
    public function getIllustration()
    {
        return $this->illustration;
    }

    /**
     * @param mixed $illustration
     */
    public function setIllustration($illustration)
    {
        $this->illustration = $illustration;
    }




}