<?php
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 27/06/2018
 * Time: 11:43
 */
?>

<div class="container">

    <img class="perso-img reine-sadidas-home" src="assets/images/website/reine.png" alt="Sadidas queen image">

    <div class="form-div">
        <form method="POST" action="?controller=user&action=newUser">
            <h2 class="form-title">CRÉEZ VOTRE COMPTE</h2>
            <input type="text" name="login" id="login" placeholder="Pseudo" value="<?= isset($user['login']) ? $user['login'] : '' ?>">
            <input type="text" name="lastname" id="lastname" placeholder="Nom" value="<?= isset($user['login']) ? $user['lastname'] : '' ?>">
            <input type="text" name="firstname" id="firstname" placeholder="Prénom" value="<?= isset($user['login']) ? $user['firstname'] : '' ?>">
            <input type="text" name="email" id="email" placeholder="E-mail" value="<?= isset($user['login']) ? $user['email'] : '' ?>">
            <input type="password" name="password" id="password" placeholder="Mot de passe">
            <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirmation mot de passe">
            <input class="register-button" type="submit" value="TERMINÉ">
        </form>
        <a class="button-link" href="?controller=user&action=default">J'ai déjà un compte</a>
    </div>

    <img class="perso-img diskor-home" src="assets/images/website/diskor2.png" alt="diskor image">

</div>

