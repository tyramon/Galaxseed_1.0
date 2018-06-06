<?php
declare(strict_types=1);
require ('BDD.php');


if (isset($_GET['groupe']))
{
    $groupe=$_GET['groupe'];
}

// Traitement formulaire

if (isset($_POST['tunnel']))
{
    $choixTunnel=$_POST['tunnel'];

    $reqModifTunnel = $connexion->prepare('UPDATE groupe SET g_tunnel_fk=:tunnel WHERE g_id=:groupe');
    $reqModifTunnel->bindValue('tunnel', $choixTunnel);
    $reqModifTunnel->bindValue('groupe', $groupe);
    $reqModifTunnel->execute();
}

if (isset($_POST['debut']) && isset($_POST['fin']))
{
    $choixDebut=$_POST['debut'];
    $choixFin=$_POST['fin'];

    $reqModifHoraire = $connexion ->prepare('UPDATE groupe SET g_debuttravail=:debut, g_fintravail=:fin WHERE g_id=:groupe');
    $reqModifHoraire->bindValue('debut', $choixDebut);
    $reqModifHoraire->bindValue('fin', $choixFin);
    $reqModifHoraire->bindValue('groupe', $groupe);
    $reqModifHoraire->execute();
}

$message='';
if (isset($_POST['taverne']))
{
    $choixTaverne=$_POST['taverne'];

    $reqChambre = $connexion -> prepare('SELECT t_id, t_chambres, (t_chambres - COUNT(n_id)) AS chambresLibres FROM taverne LEFT JOIN groupe ON g_taverne_fk=t_id LEFT JOIN nain ON n_groupe_fk=g_id WHERE t_id=:taverne GROUP BY t_id');
    $reqChambre -> bindValue('taverne', $choixTaverne);
    $reqChambre -> execute();

    $tabChambre = $reqChambre ->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tabChambre as $cle)
    {
        $totalChambre=$cle['t_chambres'];
        $chambresLibres=$cle['chambresLibres'];
    }

    $reqNbNainGroupe = $connexion -> prepare('SELECT COUNT(n_id) AS nbNain FROM nain INNER JOIN groupe ON g_id=n_groupe_fk WHERE g_id=:groupe');
    $reqNbNainGroupe -> bindValue('groupe', $groupe);
    $reqNbNainGroupe -> execute();

    $tabNainGroupe = $reqNbNainGroupe ->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tabNainGroupe as $cle)
    {
        $nbNain=$cle['nbNain'];
    }

    if ($chambresLibres-$nbNain >= 0)
    {
        $reqModifTaverne = $connexion->prepare('UPDATE groupe SET g_taverne_fk=:taverne WHERE g_id=:groupe');
        $reqModifTaverne->bindValue('taverne', $choixTaverne);
        $reqModifTaverne->bindValue('groupe', $groupe);
        $reqModifTaverne->execute();
    }
    else
    {
        $message= 'La taverne n\'a pas assez de place pour le groupe';
    }
}



//Liste nains

$reqNain = $connexion->prepare('SELECT n_nom FROM nain INNER JOIN groupe ON n_groupe_fk=g_id WHERE g_id=:groupe');
$reqNain ->bindValue('groupe', $groupe);
$reqNain -> execute();

$listeNain = $reqNain->fetchAll(PDO::FETCH_ASSOC);

$nListe='';
foreach ($listeNain as $cle)
{
    $nListe .= ' / <a type="button" href="page_nains.php?nain='.$cle['n_nom'].'">' . $cle['n_nom'] . '</a> / ';
}


// Quelle taverne ?

$reqTaverne = $connexion->prepare('SELECT taverne.t_nom FROM taverne INNER JOIN groupe ON taverne.t_id=g_taverne_fk WHERE g_id=:groupe');
$reqTaverne ->bindValue('groupe', $groupe);
$reqTaverne ->execute();

$listeTaverne= $reqTaverne->fetchAll(PDO::FETCH_ASSOC);


foreach ($listeTaverne as $cle)
{
    $taverne='<a type=button href="page_taverne.php?taverne='.$cle['t_nom'].'">'.$cle['t_nom'].'</a>';
}

if (empty($taverne))
{
    $taverne='Aucune';
}


// horaire et ville

$reqTunnel = $connexion->prepare('SELECT g_debuttravail, g_fintravail, v_nom, t_progres, t_id FROM groupe INNER JOIN tunnel ON g_tunnel_fk=tunnel.t_id INNER JOIN ville ON t_villedepart_fk=v_id WHERE g_id=:groupe');
$reqTunnel->bindValue('groupe', $groupe);
$reqTunnel ->execute();

$tunnelDepart = $reqTunnel ->fetchAll(PDO::FETCH_ASSOC);

foreach ($tunnelDepart as $cle)
{
    $debutTravail=$cle['g_debuttravail'];
    $finTravail=$cle['g_fintravail'];
    $villeDepart='<a type="button" href="page_villes.php?ville='.$cle['v_nom'].'">'.$cle['v_nom'].'</a>';
    $progres=$cle['t_progres'];
    $tunnelDefaut=$cle['t_id'];
}

$reqVille = $connexion->prepare('SELECT g_debuttravail, g_fintravail, v_nom FROM groupe INNER JOIN tunnel ON g_tunnel_fk=tunnel.t_id INNER JOIN ville ON t_villearrivee_fk=v_id WHERE g_id=:groupe');
$reqVille->bindValue('groupe', $groupe);
$reqVille ->execute();

$ville = $reqVille ->fetchAll(PDO::FETCH_ASSOC);

foreach ($ville as $cle)
{
    $villeArrivee='<a type="button" href="page_villes.php?ville='.$cle['v_nom'].'">'.$cle['v_nom'].'</a>';
}


// creusent ou entretiennent

if ($progres < 100)
{
    $creuse = '<p>Creusent de ' . $debutTravail . ' à ' . $finTravail . ' le tunnel de ' . $villeDepart . ' à ' . $villeArrivee . ' (' . $progres . '% )</p>';
}
elseif (empty($progres))
{
    $creuse ='';
}
else
{
    $creuse = '<p>Entretiennent de ' . $debutTravail . ' à ' . $finTravail . ' le tunnel de ' . $villeDepart . ' à ' . $villeArrivee . ' (' . $progres . '% )</p>';
}


//tous les tunnels

$reqAllTunnel = $connexion ->query('SELECT t_id FROM tunnel ORDER BY t_id');
$allTunnel = $reqAllTunnel->fetchAll(PDO::FETCH_ASSOC);

$optionTunnel='';
foreach ($allTunnel as $cle)
{
    if ( $cle['t_id'] === $tunnelDefaut)
    {
        $optionTunnel .= '<option value="'.$cle['t_id'].'" selected="selected">'.$cle['t_id'].'</option>';
    }
    else
    {
        $optionTunnel .= '<option value="'.$cle['t_id'].'">'.$cle['t_id'].'</option>';
    }
}



//toutes les tavernes

$reqAllTaverne = $connexion ->query('SELECT t_id, t_nom FROM taverne');
$allTaverne = $reqAllTaverne ->fetchAll(PDO::FETCH_ASSOC);

$optionTaverne='';
foreach ($allTaverne as $cle)
{
    $optionTaverne.= '<option value="'.$cle['t_id'].'">'.$cle['t_id']. ' - ' . $cle['t_nom'].'</option>';
}


//tavernes recommandées

$taverneRecommande = '';

if ($taverne === 'Aucune')
{
    $reqTaverneVilleDepart = $connexion->prepare('SELECT taverne.t_nom FROM taverne WHERE t_ville_fk IN ( SELECT t_villedepart_fk FROM tunnel INNER JOIN groupe ON tunnel.t_id=g_tunnel_fk WHERE g_id=:groupe)');
    $reqTaverneVilleDepart->bindValue('groupe', $groupe);
    $reqTaverneVilleDepart->execute();

    $tabTaverneVilleDepart = $reqTaverneVilleDepart->fetchAll(PDO::FETCH_ASSOC);

    $taverneRecommande='Tavernes recommandées : ';
    foreach ($tabTaverneVilleDepart as $cle)
    {
        $taverneRecommande .= ' / <a type="button" href="page_taverne.php?taverne='.$cle['t_nom'].'">' . $cle['t_nom'] . '</a> / ';
    }

    $reqTaverneVilleArrivee = $connexion->prepare('SELECT taverne.t_nom FROM taverne WHERE t_ville_fk IN ( SELECT t_villearrivee_fk FROM tunnel INNER JOIN groupe ON tunnel.t_id=g_tunnel_fk WHERE g_id=:groupe)');
    $reqTaverneVilleArrivee->bindValue('groupe', $groupe);
    $reqTaverneVilleArrivee->execute();

    $tabTaverneVilleArrivee = $reqTaverneVilleArrivee->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tabTaverneVilleArrivee as $cle)
    {
        $taverneRecommande .= ' / <a type="button" href="page_taverne.php?taverne='.$cle['t_nom'].'">' . $cle['t_nom'] . '</a> / ';
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
    <title>Page Groupes</title>
</head>
<body>

<h1>Fiche du groupe n° <?php echo $groupe ?></h1>

<div>
<p>Liste des nains du groupe : <?php echo $nListe ?></p>
<p>Boivent dans : <?php echo $taverne ?></p>
<?php echo $creuse;
echo '<p>' .$taverneRecommande.'</p>'?>
</div>

<h2>Modification</h2>

<div>
<form method="post" action="">
    <label for="tunnel">Affecter un tunnel :</label><br/>
    <select name="tunnel" id="tunnel">
        <?php echo $optionTunnel; ?>
    </select>
    <input type="submit" value="Valider">
</form>
</div>

<div>
<p>Changer les horaires :</p>
<form method="post" action="">
    <label for="debut">Horaire de début :</label><br/>
    <input type="time" name="debut" id="debut" value="<?php echo $debutTravail?>"><br/><br/>
    <label for="fin">Horaire de fin :</label><br/>
    <input type="time" name="fin" id="fin" value="<?php echo $finTravail ?>">
    <input type="submit" value="Valider">
</form>
</div>

<br/>

<div>
<form method="post" action="">
    <label for="taverne">Changer de taverne :</label><br/>
    <select name="taverne" id="taverne">
        <?php echo $optionTaverne;?>
    </select>
    <input type="submit" value="Valider">
</form>
<?php echo $message; ?>
</div>


<p><a type="button" href="nain_principale.php">Retour à la page d'accueil</a></p>

</body>
</html>
