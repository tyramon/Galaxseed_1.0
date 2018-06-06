<?php
declare(strict_types=1);
session_start();

if (isset($_GET['deconnexion']))
{
    header("location: espacemembre.php");
    exit;
}


echo '<h1>Bienvenue ' . $_SESSION['espaceMembre']['clientConnecte']['prenom'] . ' ' . $_SESSION['espaceMembre']['clientConnecte']['nom'] . '</h1>';

if ($_SESSION['espaceMembre']['clientConnecte']['role']==='superadmin')
{
    echo '<nav>
<ul>
<li><a href="...">Accès Réservé Super-admin</a></li>
</ul>
</nav>';
}
elseif ($_SESSION['espaceMembre']['clientConnecte']['role']==='admin')
{
    echo '<nav>
<ul>
<li><a href="...">Gérer le compte admin</a></li>
</ul>
</nav>';
}

?>

<nav>
    <ul>
        <li><a href="...">Vos dossiers</a></li>
        <li><a href="...">Vos images</a></li>
        <li><a href="...">Votre compte utilisateur</a></li>
    </ul>
</nav>



<a type="button" href="?deconnexion">Se déconnecter</a>

<style>
    h1
    {
        color: #930004;
        text-shadow: 2px 2px 2px grey;
    }
    li
    {
        list-style-type: none;
        margin: 7px;
    }

    a
    {
        text-decoration: none;
        background-color: lightblue;
        border: 1px solid dodgerblue;
        border-radius: 5px;
        padding: 3px;
    }
</style>