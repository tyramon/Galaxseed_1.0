<?php
declare(strict_types=1);
require ('BDD.php');


if (isset($_GET['nain']))
{
    $nain=$_GET['nain'];
}

// Traitement formulaire

if (isset($_POST['allgroupe']))
{
    $choixGroupe=$_POST['allgroupe'];

    if ($choixGroupe === 'Aucun')
    {
        $reqModifGroupe = $connexion ->prepare('UPDATE nain SET n_groupe_fk=NULL WHERE n_nom=:nain');
        $reqModifGroupe->bindValue('nain', $nain);
        $reqModifGroupe->execute();
    }
    else
    {
        $reqModifGroupe = $connexion ->prepare('UPDATE nain SET n_groupe_fk=:groupe WHERE n_nom=:nain');
        $reqModifGroupe->bindValue('groupe', $choixGroupe);
        $reqModifGroupe->bindValue('nain', $nain);
        $reqModifGroupe->execute();
    }
}


// Requete Nains

$reqNain = $connexion->prepare('SELECT n_nom, n_barbe, v_nom FROM nain INNER JOIN ville ON n_ville_fk=v_id WHERE n_nom=:nain');
$reqNain -> bindValue('nain', $nain);
$reqNain -> execute();

$infoNain = $reqNain->fetchAll(PDO::FETCH_ASSOC);

foreach ($infoNain as $cle)
{
    $barbe=$cle['n_barbe'];
    $origine=$cle['v_nom'];
}


// Requete groupes

$reqGroupe = $connexion->prepare('SELECT g_id, taverne.t_nom, g_debuttravail, g_fintravail, v_nom FROM groupe INNER JOIN nain ON g_id=n_groupe_fk LEFT JOIN taverne ON g_taverne_fk=taverne.t_id INNER JOIN tunnel ON tunnel.t_id=g_tunnel_fk INNER JOIN ville ON tunnel.t_villedepart_fk=v_id WHERE n_nom=:nain');
$reqGroupe -> bindValue('nain', $nain);
$reqGroupe -> execute();

$infoGroupe = $reqGroupe->fetchAll(PDO::FETCH_ASSOC);

$groupeDefaut='';
foreach ($infoGroupe as $cle)
{
    $groupeDefaut=$cle['g_id'];
    $groupe='<a type="button" href="page_groupe.php?groupe='.$cle['g_id'].'">'.$cle['g_id'].'</a>';
    $taverne=$cle['t_nom'];
    $debutTravail=$cle['g_debuttravail'];
    $finTravail=$cle['g_fintravail'];
    $villeDepart=$cle['v_nom'];
}


// Requete Ville, taverne, travail

$reqVille = $connexion->prepare('SELECT g_id, taverne.t_nom, g_debuttravail, g_fintravail, v_nom FROM groupe INNER JOIN nain ON g_id=n_groupe_fk LEFT JOIN taverne ON g_taverne_fk=taverne.t_id INNER JOIN tunnel ON tunnel.t_id=g_tunnel_fk INNER JOIN ville ON tunnel.t_villearrivee_fk=v_id WHERE n_nom=:nain');
$reqVille -> bindValue('nain', $nain);
$reqVille -> execute();

$infoVille = $reqVille->fetchAll(PDO::FETCH_ASSOC);

foreach ($infoVille as $cle)
{
    $villeArrivee=$cle['v_nom'];
}

if (empty($taverne))
{
    $taverne= 'Boit dans : Aucune';
}
else
{
    $taverne='Boit dans : <a type="button" href="page_taverne.php?taverne='.$taverne.'">'.$taverne.'</a>';
}


$affichageTravail='';
if (!empty($infoGroupe) && !empty($infoVille))
{
    $affichageTravail.= '<p>'.$taverne.'</p>
                        <p>Travaille de : ' . $debutTravail . ' à ' . $finTravail . '</p>
                        <p>Dans le tunnel de : <a type="button" href="page_villes.php?ville='.$villeDepart.'">'.$villeDepart.'</a> à <a type="button" href="page_villes.php?ville='.$villeArrivee.'">'.$villeArrivee.'</a></p>';
}


if (empty($groupe))
{
    $groupe='Aucun groupe';
}


//Liste tous les groupes

$reqAllGroupe = $connexion->query('SELECT g_id FROM groupe ORDER BY g_id');
$allGroupe = $reqAllGroupe->fetchAll(PDO::FETCH_ASSOC);

$optionAllGroupe='';
foreach ($allGroupe as $cleAllGroupe)
{
    if ($cleAllGroupe['g_id'] === $groupeDefaut)
    {
        $optionAllGroupe.= '<option value="'.$cleAllGroupe['g_id'].'" selected="selected">Groupe n° '.$cleAllGroupe['g_id'].'</option>';
    }
    else
    {
        $optionAllGroupe.='<option value="'.$cleAllGroupe['g_id'].'">Groupe n° '.$cleAllGroupe['g_id'].'</option>';
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
    <title>Page nains</title>
</head>
<body>

<h1>Fiche de <?php echo $nain ?></h1>

<div>
    <p>NOM : <?php echo $nain ?></p>
    <p>Longueur Barbe : <?php echo $barbe ?></p>
    <p>Originaire de : <?php echo '<a type="button" href="page_villes.php?ville='.$origine.'">' .$origine. '</a>' ?></p>
    <?php echo $affichageTravail ?>
    <p>Membre du groupe : <?php echo $groupe ?></p>
</div>


<h2>Modification</h2>

<div>
    <form method="post" action="">
        <label for="allgroupe">Affecter à un groupe</label><br/>
        <select name="allgroupe" id="allgroupe">
            <?php echo $optionAllGroupe ?>
            <option value="Aucun">Aucun</option>
        </select>
        <input type="submit" value="Valider">
    </form>
</div>

<p><a type="button" href="nain_principale.php">Retour à la page d'accueil</a></p>

</body>
</html>
