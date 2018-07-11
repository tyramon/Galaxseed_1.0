<?php
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 20/06/2018
 * Time: 09:48
 */

$user = $_SESSION['user'];

?>

<div class="container">
    <div class="message <?= isset($errorClass) ? $errorClass : '' ?> ">
        <?= isset($errorMessage) ? $errorMessage : '' ?>
    </div>
    <div>Utilisateur: <?= ucfirst($user->getFirstName()) . ' ' . ucfirst($user->getLastName()) ?></div>
    <h2>Choisissez votre personnage</h2>

    <form method="post" action="?controller=FutureGame&action=default">
        <div>
            <div class="diskor">
                <p>Diskor</p>
                <input class="hidden" type="radio" name="choixHero" id="choixHero1" value="1"/>
                <label for="choixHero1">
                    <img src="assets/images/diskor-cadre.png">
                </label>
            </div>

            <div class="reine">
                <p>Reine Sadida</p>
                <input class="hidden" type="radio" name="choixHero" id="choixHero2" value="2"/>
                <label for="choixHero2">
                    <img src="assets/images/reine-cadre.png">
                </label>
            </div>
        </div>

        <div>
            <input type="submit" value="Lancer la partie"/>
        </div>
    </form>


    <a class="button" href="?controller=user&action=update">Modifier mon profil</a>
    <a class="button" href="?controller=user&action=logout">Deconnexion</a>

</div>


