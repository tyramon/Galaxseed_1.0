<?php
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 20/06/2018
 * Time: 09:50
 */

?>
<div class="message">
    <?= empty($_SESSION['msg']['error']) ? '' : $_SESSION['msg']['error']; ?>
</div>

<h2>Connection au profil:</h2>

<div class="login-wrap">
    <form method="POST" action="?controller=user&action=connexion">
        <label for="log">Login</label>
        <input  id="log" type="text" name="login" >
        <label for="pass">Password</label>
        <input id="pass" type="password" name="psw">
        <input class="button" type="submit" value="Se connecter">
    </form>
</div>

<a class="button" href="?controller=user&action=register">S'inscrire</a>
<a class="button" href="?controller=home&action=default">Retour à l'accueil</a>




