<?php
declare(strict_types=1);
require ('BDD.php');


if (isset($_GET['ville']))
{
    $ville=$_GET['ville'];
}


// nom, superfie

$reqVille = $connexion->prepare('SELECT v_nom, v_superficie FROM ville WHERE v_nom=:ville');
$reqVille ->bindValue('ville', $ville);
$reqVille -> execute();

$infoVille=$reqVille ->fetchAll(PDO::FETCH_ASSOC);

foreach ($infoVille as $cle)
{
    $nom=$cle['v_nom'];
    $superficie=$cle['v_superficie'];
}


// Liste nains

$reqNain = $connexion->prepare('SELECT n_nom FROM nain INNER JOIN ville ON n_ville_fk=v_id WHERE v_nom=:ville');
$reqNain ->bindValue('ville', $ville);
$reqNain -> execute();

$listeNain = $reqNain->fetchAll(PDO::FETCH_ASSOC);

$nListe='';
foreach ($listeNain as $cle)
{
    $nListe .= ' / <a type="button" href="page_nains.php?nain='.$cle['n_nom'].'">' . $cle['n_nom'] . '</a> / ';
}


// Liste tavernes

$reqTaverne = $connexion->prepare('SELECT taverne.t_nom FROM taverne INNER JOIN ville ON taverne.t_ville_fk=v_id WHERE v_nom=:ville');
$reqTaverne ->bindValue('ville', $ville);
$reqTaverne ->execute();

$listeTaverne= $reqTaverne->fetchAll(PDO::FETCH_ASSOC);

$tavListe='';

foreach ($listeTaverne as $cle)
{
    $tavListe.= ' / <a type="button" href="page_taverne.php?taverne='.$cle['t_nom'].'">' . $cle['t_nom'] . '</a> / ';
}


//Liste tunnels

$reqTunnel = $connexion->prepare('SELECT v_nom, t_progres FROM ville INNER JOIN tunnel ON t_villearrivee_fk=v_id WHERE t_villedepart_fk IN (SELECT v_id FROM ville WHERE v_nom=:ville)');
$reqTunnel-> bindValue('ville', $ville);
$reqTunnel-> execute();

$tabTunnel=$reqTunnel->fetchAll(PDO::FETCH_ASSOC);

$tunnel='';
foreach ($tabTunnel as $cle)
{
    if ($cle['t_progres'] < 100)
    {
        $tunnel .= '<p>Tunnel vers <a type="button" href="page_villes.php?ville='.$cle['v_nom'].'" >' . $cle['v_nom'] . '</a> : ' . $cle['t_progres'] . '%</p>';
    }
    else
    {
        $tunnel .= '<p>Tunnel vers <a type="button" href="page_villes.php?ville='.$cle['v_nom'].'" >' . $cle['v_nom'] . '</a> : Ouvert</p>';
    }
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page Villes</title>
</head>
<body>

<h1>Fiche de <?php echo $ville ?></h1>

<div>
    <p>NOM : <?php echo $nom ?></p>
    <p>Superficie : <?php echo $superficie ?></p>
    <p>Liste des nains originaires d'ici : <?php echo $nListe ?></p>
    <p>Liste des tavernes : <?php echo $tavListe ?></p>
    <p><?php echo $tunnel ?></p>
</div>

<p><a type="button" href="nain_principale.php">Retour à la page d'accueil</a></p>

</body>
</html>
