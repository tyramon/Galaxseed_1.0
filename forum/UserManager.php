<?php
declare(strict_types=1);

class UserManager extends PDOManager
{
    protected $pdo;
    protected $donnees;

    public function __construct()
    {
        $this->pdo = parent::getInstance()->getPDO();
        $this->donnees = array();
    }

    public function genereFormConnexion(array $userconnect) :string
    {
        if (!empty($userconnect))
        {
            $formConnexion='Vous êtes connecté.';
        }
        else
        {
            $formConnexion='<div>
                        <form method="post" action="">
                            <fieldset>
                                <legend>Connectez-vous</legend>
                                    <label for="nom">Votre nom :</label>
                                    <input type="text" name="nom" id="nom">
                                    <label for="prenom">Votre prénom :</label>
                                    <input type="text" name="prenom" id="prenom">
                                    <input type="submit" value="Se connecter">
                            </fieldset>
                        </form>
                        <br/>
                    </div>';
        }
        return $formConnexion;
    }

    public function genereFormInscription()
    {
        $formInscription='<div>
                        <form method="post" action="">
                            <fieldset>
                                <legend>Inscrivez-vous</legend>
                                    <label for="login">Login :</label>
                                    <input type="text" name="login" id="login">
                                    <label for="nom">Votre nom :</label>
                                    <input type="text" name="nom" id="nom">
                                    <label for="prenom">Votre prénom :</label>
                                    <input type="text" name="prenom" id="prenom">
                                    <label for="naissance">Date de naissance :</label>
                                    <input type="date" name="naissance" id="naissance">
                                    <input type="submit" value="S\'inscrire">
                            </fieldset>
                        </form>
                        <br/>
                    </div>';
        return $formInscription;
    }

    public function getAllNomPrenom() : array
    {
        $requete = $this->pdo->query('SELECT u_nom, u_prenom FROM user');
        $donnees = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $donnees;
    }

    public function getAllByUserNom(string $nom) : array
    {
        $requete=$this->pdo->prepare('SELECT u_id, u_login, u_prenom, u_nom, u_date_naissance, u_date_inscription FROM user WHERE u_nom=:nom');
        $requete->bindValue('nom', $nom);
        $requete->execute();
        $donnees=$requete->fetchAll(PDO::FETCH_ASSOC);

        return $donnees;
    }

    public function insertUser(string $login, string $prenom, string $nom, $dateNaissance) : void
    {
        $requete=$this->pdo->prepare('INSERT INTO user (u_login, u_prenom, u_nom, u_date_naissance, u_date_inscription, u_rang_fk) VALUES (:login, :prenom, :nom, :naissance, CURRENT_TIMESTAMP, 3)');
        $requete->bindValue('login', $login);
        $requete->bindValue('prenom', $prenom);
        $requete->bindValue('nom', $nom);
        $requete->bindValue('naissance', $dateNaissance);
        $requete->execute();
    }
}