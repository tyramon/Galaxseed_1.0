<?php
declare(strict_types=1);
session_start();

if (isset($_GET['retour']))
{
    header("location: espacemembre.php");
    exit;
}

if (!isset($_SESSION['espaceMembre']['nouveauInscrit']))
{
    $_SESSION['espaceMembre']['nouveauInscrit']=array();
}


if (isset($_POST['identifiant']) && isset($_POST['passe']) && isset($_POST['confirm']) && isset($_POST['nom']) && isset($_POST['prenom']))
{
    if (empty($_POST['identifiant']) || empty($_POST['passe']) || empty($_POST['confirm']) || empty($_POST['nom']) || empty($_POST['prenom']))
    {
        echo 'Veuiller renseigner tous les champs du formulaire.';
    }
    else
    {
        if ($_POST['passe'] !== $_POST['confirm'])
        {
            echo 'Votre mot de passe et sa confirmation ne sont pas identiques.';
        }
        else
        {
            foreach ($_SESSION['espaceMembre']['utilisateurAutorise'] as $ligne)
            {
                if ($ligne['identifiant'] === $_POST['identifiant'])
                {
                    echo 'Identifiant déjà créé.';
                }
            }
            $_SESSION['espaceMembre']['utilisateurAutorise'][]= array('identifiant'=> $_POST['identifiant'], 'motDePasse'=> $_POST['passe'], 'nom'=> $_POST['nom'], 'prenom'=> $_POST['prenom'], 'role'=>'invite');
            header("location: espacemembre.php");
            exit;
        }
    }
}

?>

<h1>Page d'incription</h1>

<p>Renseigner les champs suivants: </p>

<div>
<form method="post" action="">
    <label for="identifiant">Votre pseudo : </label><input type="text" name="identifiant" id="identifiant"><br/>
    <label for="passe">Votre mot de passe : </label><input type="password" name="passe" id="passe"><br/>
    <label for="confirm">Confirmer votre mot de passe : </label><input type="password" name="confirm" id="confirm"><br/>
    <label for="nom">Votre nom : </label><input type="text" name="nom" id="nom"><br/>
    <label for="prenom">Votre prénom</label><input type="text" name="prenom" id="prenom"><br/>
    <input type="submit" value="S'inscrire">
</form>
</div>

<a type="button" href="?retour">RETOUR à la page de connexion</a>

<style>
    div
    {
        width: 30%;
    }
    form
    {
        display: flex;
        flex-direction: column;
    }
</style>
