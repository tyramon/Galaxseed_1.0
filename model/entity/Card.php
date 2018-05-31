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


    public function __construct(array $cardData)
    {
        $this->hydrate($cardData);
    }

    public function hydrate(array $cardData){
//        $card_manager = new CardManager();
//        $cardData = $card_manager->getCard($card_name);

        $this->setId($cardData['ct_id']);
        $this->setName($cardData['ct_name']);
        $this->setHp($cardData['ct_health_point']);
        $this->setMana($cardData['ct_mana']);
        $this->setAttack($cardData['ct_attack']);
        $this->setShield($cardData['ct_shield']);
        $this->setLocation('');
        $this->setStatus('');
        $this->setHero('');
        $this->setIllustration('');
        $this->setType($cardData['t_id']);
        //DB a mettre à jour
//        $this->setIllustration($cardData['l_id']);
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