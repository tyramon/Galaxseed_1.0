<?php
declare(strict_types=1);
session_start();

if (!isset($_SESSION['connexion']))
{
    $_SESSION['connexion']=array();
}
$userconnect = $_SESSION['connexion'];


function autoload(string $nomFichier) : void
{
    $url = $nomFichier.'.php';

    if(file_exists($url)) {
        require ($url);
    }
}

spl_autoload_register('autoload');


if (isset($_GET['id']))
{
    $id=(int)$_GET['id'];
}


if (!isset($_GET['pagination']))
{
    $pageActuelle=1;
}
elseif (isset($_GET['pagination']))
{
    $pageActuelle=(int)$_GET['pagination'];
}


if (!isset($_GET['tri']))
{
    $tri='date';
}
elseif (isset($_GET['tri']))
{
    $tri=htmlspecialchars((string)$_GET['tri']);
}


$userconnect=unserialize($userconnect[0]);
$idUser=$userconnect->getId();

$confirmation='';
if (isset($_POST['message']))
{
    $message=htmlspecialchars($_POST['message']);
    $nouveauMessage= new MessageManager();
    $nouveauMessage->insertMessage($message, $idUser, $id);
    $confirmation='Votre message a bien été envoyé.';
}



?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Poster un message</title>
</head>
<body>

<h1>Ajouter un post à la conversation <?=$id?></h1>

<form method="post" action="">
    <fieldset>
        <legend>Votre message :</legend>
        <textarea name="message" rows="20" cols="70"></textarea>
        <input type="submit" value="Poster">
    </fieldset>

</form>

<?=$confirmation?>

<a type="button" href="page2.php?id=<?=$id?>">Retour</a>
</body>
</html>
