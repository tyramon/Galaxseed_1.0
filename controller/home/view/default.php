<?php
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 27/06/2018
 * Time: 11:43
 */
?>

<div class="container">
    <img class="perso-img reine-sadidas" src="assets/images/website/reine.png" alt="Sadidas queen image">

    <div class="register-div">
        <form method="POST" action="?controller=user&action=newUser">
            <h2 class="form-title">Créez votre compte</h2>
            <div class="form-group">
                <input type="text" name="login" id="login" placeholder="Pseudo" value="<?= isset($user['login']) ? $user['login'] : '' ?>">
            </div>
            <div class="form-group">
                <input type="text" name="lastname" id="lastname" placeholder="Nom" value="<?= isset($user['login']) ? $user['lastname'] : '' ?>">
            </div>
            <div class="form-group">
                <input type="text" name="firstname" id="firstname" placeholder="Prénom" value="<?= isset($user['login']) ? $user['firstname'] : '' ?>">
            </div>
            <div class="form-group">
                <input type="text" name="email" id="email" placeholder="E-mail" value="<?= isset($user['login']) ? $user['email'] : '' ?>">
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Mot de passe">
            </div>
            <div class="form-group">
                <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirmation mot de passe">
            </div>
            <div class="form-group">
                <input class="button" type="submit" value="Terminé">
            </div>
        </form>
        <a class="login-link" href="?controller=user&action=default">J'ai déjà un compte</a>
    </div>

    <img class="perso-img diskor" src="assets/images/website/diskor2.png" alt="diskor image">
</div>
