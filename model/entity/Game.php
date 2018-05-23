<?php
declare(strict_type=1);

namespace dndcompany\galaxseed\model\entity;

class Game
{
    private $id;
    private $dateCreate;
    private $turnPlayer;
    private $roundGame;
    private $idPlayer1;
    private $idPlayer2;
    private $manaPool;


    public function __construct(array $dataGameManager)
    {
        $this->hydrate($dataGameManager);
    }

    public function hydrate($data)
    {
        foreach ($data as $key => $val)
        {
            $key=str_replace('g_', '', $key);
            $key=str_replace('hg_', '', $key);
            $key=str_replace('u_', '', $key);

            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                if(is_numeric($val))
                {
                    $val=(int)$val;
                }
                $this->$method($val);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId() :int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId( int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * @param mixed $dateCreate
     */
    public function setDateCreate($dateCreate): void
    {
        $this->dateCreate = $dateCreate;
    }

    /**
     * @return mixed
     */
    public function getTurnPlayer() : int
    {
        return $this->turnPlayer;
    }

    /**
     * @param mixed $turnPlayer
     */
    public function setTurnPlayer( int $turnPlayer): void
    {
        $this->turnPlayer = $turnPlayer;
    }

    /**
     * @return mixed
     */
    public function getRoundGame() : int
    {
        return $this->roundGame;
    }

    /**
     * @param mixed $roundGame
     */
    public function setRoundGame( int $roundGame): void
    {
        $this->roundGame = $roundGame;
    }

    /**
     * @return mixed
     */
    public function getIdPlayer1() : int
    {
        return $this->idPlayer1;
    }

    /**
     * @param mixed $idPlayer1
     */
    public function setIdPlayer1( int $idPlayer1): void
    {
        $this->idPlayer1 = $idPlayer1;
    }

    /**
     * @return mixed
     */
    public function getIdPlayer2() : int
    {
        return $this->idPlayer2;
    }

    /**
     * @param mixed $idPlayer2
     */
    public function setIdPlayer2( int $idPlayer2): void
    {
        $this->idPlayer2 = $idPlayer2;
    }

    /**
     * @return mixed
     */
    public function getManaPool() : int
    {
        return $this->manaPool;
    }

    /**
     * @param mixed $manaPool
     */
    public function setManaPool( int $manaPool): void
    {
        $this->manaPool = $manaPool;
    }




}