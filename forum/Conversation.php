<?php
declare(strict_types=1);


class Conversation
{
    protected $id;
    protected $date;
    protected $heure;
    protected $termine;
    protected $nbMessage;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }


    public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getHeure()
    {
        return $this->heure;
    }

    public function getTermine()
    {
        return $this->termine;
    }

    public function getNbMessage()
    {
        return $this->nbMessage;
    }




    public function setID( int $id) : void
    {
        $this->id=$id;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function setHeure($heure): void
    {
        $this->heure = $heure;
    }

    public function setTermine( int $termine): void
    {
        $this->termine = $termine;
    }

    public function setNbMessage( int $nbMessage): void
    {
        $this->nbMessage = $nbMessage;
    }



    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $val)
        {
            $key=str_replace('c_', '', $key);
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

}

