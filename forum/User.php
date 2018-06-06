<?php
declare(strict_types=1);

class User implements Serializable
{
    protected $id;
    protected $login;
    protected $prenom;
    protected $nom;
    protected $naissance;
    protected $inscription;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function serialize() {
        return serialize([
            $this->id,
            $this->login,
            $this->prenom,
            $this->nom,
            $this->naissance,
            $this->inscription]);
    }
    public function unserialize($data) {
        list(
            $this->id,
            $this->login,
            $this->prenom,
            $this->nom,
            $this->naissance,
            $this->inscription)=unserialize($data);
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId( int $id): void
    {
        $this->id = $id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin( string $login): void
    {
        $this->login = $login;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getNaissance()
    {
        return $this->naissance;
    }

    public function setNaissance($naissance): void
    {
        $this->naissance = $naissance;
    }

    public function getInscription()
    {
        return $this->inscription;
    }

    public function setInscription($inscription): void
    {
        $this->inscription = $inscription;
    }



    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key)
        {
            foreach ($key as $item => $val)
            {
                $item = str_replace('u_', '', $item);
                $item = str_replace('date_', '', $item);
                $method = 'set' . ucfirst($item);

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
    }
}