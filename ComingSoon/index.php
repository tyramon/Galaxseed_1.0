<?php
declare(strict_types=1);
define('FICHIER', 'email.txt' );


$result = '';

function compare(array $mail, string $emailClient): string
{
    $result = '';
    foreach ($mail as $valeur) {
        if ($valeur === $emailClient) {
            $result = 'Vous êtes déjà inscrit.';
        } else {
            $result = 'Vous êtes bien inscrit.';
        }
    }
    return $result;
}


if (isset($_POST['email'])) {
    if ($_POST['email'] == '') {
        $result = '<div class="retry">Merci de renseigner un email valide.</div>';
    } else {

        $emailClient = htmlentities($_POST['email']);
        if (!file_exists(FICHIER)) {
            $fichierClient = fopen(FICHIER, 'a+');
            fwrite($fichierClient, $emailClient);
            fclose($fichierClient);
        } else {
            $tableauMail = file(FICHIER);
            $result = compare($tableauMail, $emailClient);

            if ($result === 'Vous êtes bien inscrit.') {
                $fichierClient = fopen(FICHIER, 'a');
                $contenu = PHP_EOL . $emailClient;
                fwrite($fichierClient, $contenu);
                fclose($fichierClient);
                $result = '<div class="success">Merci de vous être inscrit et bienvenue.</div>';
            } elseif ($result === 'Vous êtes déjà inscrit.') {
                $result = '<div class="retry">Vous êtes déjà inscrit.</div>';

            }
        }
    }

} else {
    $result = '<div class="retry">Inscription à la Newsletter.</div>';
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GalaxSeed</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="arg">
    <img src="img/LOGO.png"/>
    <div class="horloge">
        <div class="jours_heures">
            <div class="coming" id="days"></div>
            <div class="coming" id="hours"></div>
        </div>
        <div class="min_sec">
            <div class="coming" id="minutes"></div>
            <div class="coming" id="seconds"></div>
        </div>
    </div>
    <div class="form_message"> <?= $result ?> </div>
    <div class="form">
        <form action="" method="post">
            <input class="form_email" type="email" name="email" value="" placeholder="Inscrivez-vous à la newsletter!">
            <input class="form_submit" type="submit" name="submit" value="S'inscrire">
        </form>

    </div>

</div>

<div id="header">
    <div class="header" id="large-header" style="height: 894px;">
        <canvas id="header-canvas" width="1245" height="894"></canvas>
    </div>
</div>

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/index.js"></script>
<script src="js/horloge.js"></script>

</body>
</html>


