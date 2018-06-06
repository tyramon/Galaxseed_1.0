<?php
declare(strict_types=1);
session_start();

if (isset($_GET['inscription']))
{
    header("location: espacemembreinscription.php");
    exit;
}

if (!isset($_SESSION['espaceMembre']['utilisateurAutorise']))
{
    $_SESSION['espaceMembre']['utilisateurAutorise'] = array(
        array('identifiant' => 'mel34', 'motDePasse' => 'abc123', 'nom' => 'dupont', 'prenom' => 'melanie', 'role' => 'superadmin'),
        array('identifiant' => 'robin12', 'motDePasse' => 'rob12', 'nom' => 'avezzo', 'prenom' => 'robin', 'role' => 'admin'),
        array('identifiant' => 'becca30', 'motDePasse' => '789', 'nom' => 'coray', 'prenom' => 'rebecca', 'role' => 'invite'),
    );
}


if (!isset($_SESSION['espaceMembre']['clientConnecte']))
{
    $_SESSION['espaceMembre']['clientConnecte'] = array();
}



if (isset($_POST['pseudo']) && isset($_POST['password']))
{
    if (empty($_POST['pseudo']) || empty($_POST['password']))
    {
        echo 'Veuillez renseigner les 2 champs du formulaire.';
    }
    else
    {
        foreach ($_SESSION['espaceMembre']['utilisateurAutorise'] as $ligne)
        {
            if ($ligne['identifiant'] === $_POST['pseudo'] && $ligne['motDePasse'] === $_POST['password'])
            {
                $_SESSION['espaceMembre']['clientConnecte']=$ligne;
                header("location: espacemembrepagecache.php");
                exit;
            }
        }
        echo 'Identifiant et/ou mot de passe invalide';
    }
}


if (isset($_POST['destroyPseudo']) && isset($_POST['destroyPassword']))
{
    if (empty($_POST['destroyPseudo']) || empty($_POST['destroyPassword']))
    {
        echo 'Veuillez renseigner les deux champs.';
    }
    else
    {
        foreach ($_SESSION['espaceMembre']['utilisateurAutorise'] as $cle => $ligne)
        {
            if ($ligne['identifiant'] === $_POST['destroyPseudo'] && $ligne['motDePasse'] === $_POST['destroyPassword'])
            {
                unset($_SESSION['espaceMembre']['utilisateurAutorise'][$cle]);
                echo 'Votre désinscription a bien été prise en compte.';
            }
        }
    }
}



?>

<h1>Page de connexion</h1>

<p>Veuillez renseigner les champs suivants :</p>

<form method="post" action="">
    <label for="pseudo">Votre pseudo : </label><input type="text" name="pseudo" id="pseudo">
    <label for="password">Votre mot de passe : </label><input type="password" name="password" id="password">
    <input type="submit" value="Connexion">
</form>

<p>Pour vous inscrire, <a type="button" href="?inscription">Cliquez ici</a></p>

<p>Se désincrire : </p>

<form method="post" action="">
    <label for="destroyPseudo">Votre pseudo :</label><input type="text" name="destroyPseudo" id="destroyPseudoseudo">
    <label for="destroyPassword">Votre mot de passe : </label><input type="password" name="destroyPassword" id="destroyPassword">
    <input type="submit" value="Désinscription">
</form>


<style>
    a
    {
        text-decoration: none;
        color: burlywood;
        background-color: darkred;
        text-shadow: 1px 1px 1px black;
        border-radius: 5px;
        padding: 3px;
    }
    p
    {
        font-size: 20px;
    }
    label
    {
        color: burlywood;
        background-color: darkred;
        padding: 3px;
        border-radius: 5px;
        text-shadow: 1px 1px 1px black;
    }
</style>
