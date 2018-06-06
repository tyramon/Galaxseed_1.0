<?php
declare(strict_types=1);
require ('BDD.php');


if (isset($_POST['nain']))
{
    header('Location: page_nains.php?nain='.$_POST['nain']);
    exit();
}

if (isset($_POST['ville']))
{
    header('Location: page_villes.php?ville='.$_POST['ville']);
    exit();
}

if (isset($_POST['groupe']))
{
    header('Location: page_groupe.php?groupe='.$_POST['groupe']);
    exit();
}

if (isset($_POST['taverne']))
{
    header('Location: page_taverne.php?taverne='.$_POST['taverne']);
    exit();
}


//Tous les nains

$reqNain = $connexion->query('SELECT n_nom FROM nain');
$nain = $reqNain->fetchAll(PDO::FETCH_ASSOC);


$optionNain='';
foreach ($nain as $cleNain)
{
    $optionNain .= '<option value="'.$cleNain['n_nom'].'">'.$cleNain['n_nom'].'</option>';
}



//Toutes les villes

$reqVille = $connexion->query('SELECT v_nom FROM ville');
$ville = $reqVille->fetchAll(PDO::FETCH_ASSOC);

$optionVille='';
foreach ($ville as $cleVille)
{
    $optionVille.= '<option value="'.$cleVille['v_nom'].'">'.$cleVille['v_nom'].'</option>';
}


//Tous les groupes

$reqGroupe = $connexion->query('SELECT g_id FROM groupe ORDER BY g_id');
$groupe = $reqGroupe->fetchAll(PDO::FETCH_ASSOC);

$optionGroupe='';
foreach ($groupe as $cleGroupe)
{
    $optionGroupe.= '<option value="'.$cleGroupe['g_id'].'">Groupe n° '.$cleGroupe['g_id'].'</option>';
}


//Toutes les tavernes

$reqTaverne = $connexion->query('SELECT t_nom FROM taverne');
$taverne = $reqTaverne->fetchAll(PDO::FETCH_ASSOC);

$optionTaverne='';
foreach ($taverne as $cleTaverne)
{
    $optionTaverne.= '<option value="'.$cleTaverne['t_nom'].'">'.$cleTaverne['t_nom'].'</option>';
}

?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nains page princapale</title>
</head>
<body>

<h1>Gestion de personnel minier</h1>

<form method="post" action="">
    <label for="nain">Choisir un nain</label><br/>
    <select name="nain" id="nain">
        <?php echo $optionNain ?>
    </select>
    <input type="submit" value="Valider">
</form>


<form method="post" action="">
    <label for="ville">Choisir une ville</label><br/>
    <select name="ville" id="ville">
        <?php echo $optionVille ?>
    </select>
    <input type="submit" value="Valider">
</form>


<form method="post" action="">
    <label for="groupe">Choisir un groupe</label><br/>
    <select name="groupe" id="groupe">
        <?php echo $optionGroupe ?>
    </select>
    <input type="submit" value="Valider">
</form>


<form method="post" action="">
    <label for="taverne">Choisir une taverne</label><br/>
    <select name="taverne" id="taverne">
        <?php echo $optionTaverne ?>
    </select>
    <input type="submit" value="Valider">
</form>

<p>C'était Nain Tense, j'espère ne pas avoir fait Nain Portequoi ...</p>
</body>
</html>
