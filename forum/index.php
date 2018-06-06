<?php
declare(strict_types=1);
session_start();


if (isset($_GET['deconnexion']))
{
    session_destroy();
    header('Location: index.php');
}

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


$userManager=new UserManager();
$inscription=$userManager->genereFormInscription();
$formulaire=$userManager->genereFormConnexion($userconnect);

$tabAllUser = $userManager->getAllNomPrenom();

if (isset($_POST['nom']) && isset($_POST['prenom']))
{
    if (!empty($_POST['nom']) && !empty($_POST['prenom']))
    {
        $nom=htmlspecialchars($_POST['nom']);
        $prenom=htmlspecialchars($_POST['prenom']);

        foreach ($tabAllUser as $key => $val)
        {
            if ($nom === $val['u_nom'] && $prenom === $val['u_prenom'])
            {
                $infoUser=$userManager->getAllByUserNom($nom);
                $_SESSION['connexion'][]=serialize(new User($infoUser));
                header('Location: index.php');
            }
        }
    }
}

$confirmation='';
if (isset($_POST['login'])&&isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['naissance']))
{
    if (!empty($_POST['login'])&&!empty($_POST['nom'])&&!empty($_POST['prenom'])&&!empty($_POST['naissance']))
    {
        $login=htmlspecialchars($_POST['login']);
        $nomInsc=htmlspecialchars($_POST['nom']);
        $prenomInsc=htmlspecialchars($_POST['prenom']);
        $naissance=$_POST['naissance'];

        $userManager->insertUser($login, $prenomInsc, $nomInsc, $naissance);
        $confirmation='Vous etes bien inscrit.';
    }
}



$conversation = new ConversationManager();
$tableauConv = $conversation->getListConversation();

$listeConv=[];
foreach ($tableauConv as $conv)
{
    $listeConv[] = new Conversation($conv);
}


$ligne = '';
foreach ($listeConv as $cle)
{
    if ($cle->getTermine() > 0)
    {
        $classe='closed';
    }
    elseif($cle->getTermine() < 1)
    {
        $classe='opened';
    }
    $ligne.='<tr class="'.$classe.'"><td>'.$cle->getId().'</td><td>'.$cle->getDate().'</td><td>'.$cle->getHeure().'</td><td>'.$cle->getNbMessage().'</td><td><a type="button" href="page2.php?id='.$cle->getId().'">'.$cle->getId().'</a></td></tr>';
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
    <title>Forum</title>
</head>
<body>

<h1>Base de données Forum</h1>

<?=$confirmation ?>
<?=$inscription?>
<?=$formulaire?>

<table>
    <tr>
        <td>ID de la conversation</td>
        <td>Date de la conversation</td>
        <td>Heure de la conversation</td>
        <td>Nombre de messages</td>
        <td></td>
    </tr>

    <?php echo $ligne ?>

</table>

<br/><a type="button" href="index.php?deconnexion">Déconnexion</a>

</body>
</html>
