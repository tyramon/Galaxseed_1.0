<?php
declare(strict_types=1);

class Message
{
    protected $date;
    protected $heure;
    protected $nom;
    protected $prenom;
    protected $contenu;
    protected $totalMessage;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }


    public function getTotalMessage()
    {
        return $this->totalMessage;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getHeure()
    {
        return $this->heure;
    }

    public function setHeure($heure): void
    {
        $this->heure = $heure;
    }

    public function getNom()
    {
        return $this->nom;
    }



    public function setTotalMessage( int $totalMessage): void
    {
        $this->totalMessage = $totalMessage;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }


    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): void
    {
        $this->contenu = $contenu;
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $val)
        {
            $key=str_replace('m_', '', $key);
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
}