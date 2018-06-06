<?php
declare(strict_types=1);
require ('BDD.php');


if (isset($_GET['taverne']))
{
    $taverne=$_GET['taverne'];
}

// Ville et taverne

$reqVille = $connexion->prepare('SELECT v_nom, t_blonde, t_brune, t_rousse, t_chambres FROM taverne INNER JOIN ville ON t_ville_fk=v_id WHERE t_nom=:taverne');
$reqVille->bindValue('taverne', $taverne);
$reqVille -> execute();

$tabTaverne=$reqVille->fetchAll(PDO::FETCH_ASSOC);

foreach ($tabTaverne as $cle)
{
    $ville=$cle['v_nom'];
    $blonde=$cle['t_blonde'];
    $brune=$cle['t_brune'];
    $rousse=$cle['t_rousse'];
    $chambres=$cle['t_chambres'];
}

$reqNains = $connexion->prepare('SELECT COUNT(n_id) AS nbNains FROM nain RIGHT JOIN groupe ON g_id=n_groupe_fk RIGHT JOIN taverne ON g_taverne_fk=t_id WHERE t_nom=:taverne');
$reqNains ->bindValue('taverne', $taverne);
$reqNains->execute();

$tabNains=$reqNains->fetchAll(PDO::FETCH_ASSOC);

foreach ($tabNains as $cle)
{
    $nbNain=$cle['nbNains'];
}

$chambresLibres=$chambres-$nbNain;


if ($blonde > 0)
{
    $biereBlonde = ' / blonde /';
}
else
{
    $biereBlonde = '';
}

if ($brune > 0)
{
    $biereBrune = ' / brune /';
}
else
{
    $biereBrune = '';
}

if ($rousse > 0)
{
    $biereRousse = ' / rousse /';
}
else
{
    $biereRousse = '';
}


$biere= 'Possède de la bière ' .$biereBlonde.' ' .$biereBrune. ' ' .$biereRousse;

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page Taverne</title>
</head>
<body>

<h1>Fiche de la taverne : <?php echo $taverne ?></h1>

<div>
    <p>Ville : <?php echo '<a type="button" href="page_villes.php?ville='.$ville.'">'.$ville .'</a>' ?></p>
<p><?php echo $biere ?></p>
<p><?php echo $chambres?> chambres, dont <?php echo $chambresLibres?> libres</p>
</div>

<p><a type="button" href="nain_principale.php">Retour à la page d'accueil</a></p>

</body>
</html>
