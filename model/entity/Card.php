<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\model\entity;




class Card
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
    public function actionAttack(Card $cible): void{

            $degats = $this->getAttack();
            $cible->receiveDamage($degats);

    }

    // la carte recoit des degats
    public function receiveDamage(int $degat){
        $this->setHp($this->getHp() - $degat);
        if($this->getHp() <= 0){
            //defauser la carte
            $this->setLocation(4);
        }
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getHp()
    {
        return $this->hp;
    }

    /**
     * @param mixed $hp
     */
    public function setHp($hp)
    {
        $this->hp = $hp;
    }

    /**
     * @return mixed
     */
    public function getMana()
    {
        return $this->mana;
    }

    /**
     * @param mixed $mana
     */
    public function setMana($mana)
    {
        $this->mana = $mana;
    }

    /**
     * @return mixed
     */
    public function getAttack()
    {
        return $this->attack;
    }

    /**
     * @param mixed $attack
     */
    public function setAttack($attack)
    {
        $this->attack = $attack;
    }

    /**
     * @return mixed
     */
    public function getShield()
    {
        return $this->shield;
    }

    /**
     * @param mixed $shield
     */
    public function setShield($shield)
    {
        $this->shield = $shield;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
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