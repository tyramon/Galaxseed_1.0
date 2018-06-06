<?php
declare(strict_types=1);
session_start();

if (!isset($_SESSION['connexion']))
{
    $_SESSION['connexion']=array();
}
$userconnect= $_SESSION['connexion'];


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




$verif=new ConversationManager();
$verification = $verif->conversationIdExist($id);

if ($verification === 'bad')
{
    $erreur=$verif->erreur404();
}

$messagesParPage=20;

$message= new MessageManager();
$totalMessage = $message->getNbMessageByConvID($id);
$nbPagePagination = $message->getnombrePagePagination($totalMessage, $messagesParPage);

$ligneLien='';
for ($i=1; $i<=$nbPagePagination; $i++)
{
    $ligneLien.='<a type="button" href="page2.php?id='.$id.'&pagination='.$i.'&tri='.$tri.'">Page '.$i.'</a>   ';
}

$offset=($pageActuelle-1)*$messagesParPage;

$tableauMessage=$message->getListLimitMessage($id, $messagesParPage, $offset, $tri);

$listeMessage = [];
foreach ($tableauMessage as $message)
{
    $listeMessage[]=new Message($message);
}

$msg='';
$ligne='';
if (empty($listeMessage))
{
    $msg='Cette conversation est vide pour le moment. <br/>';
}
else
    {
    foreach ($listeMessage as $key)
    {
        $ligne .= '<tr><td>' . $key->getDate() . '</td><td>' . $key->getHeure() . '</td><td>' . $key->getNom() . ' ' . $key->getPrenom() . '</td><td>' . $key->getContenu() . '</td></tr>';
    }
}

$ajoutMessage='';
if (!empty($userconnect))
{
    $ajoutMessage='<a type="button" href="repondre.php?id='.$id.'">Répondre</a>';
}



?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Page 2</title>
</head>
<body>

<h1>Conversation n° <?= $id ?></h1>

<div class="row">
    <form method="get" action="">
        <input type="hidden" name="id" value="<?=$id?>">
        <input type="hidden" name="pagination" value="<?=$pageActuelle?>"
        <label for="tri">Trier par :</label>
        <select name="tri" id="tri">
            <option value="date">Date</option>
            <option value="id">ID</option>
            <option value="auteur">Auteur</option>
        </select>

        <input type="submit" value="Valider">
    </form>

    <?=$ajoutMessage ?>
</div>


<table>
    <tr>
        <td>Date du message</td>
        <td>Heure du message</td>
        <td>Nom Prénom</td>
        <td>Message</td>
    </tr>
<?=$ligne ?>

</table>

<?=$ligneLien ?>
<br/>
<?=$msg ?>



<a type="button" href="index.php">Retour a la page d'accueil</a>

</body>
</html>
