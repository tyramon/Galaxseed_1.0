<?php
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 20/06/2018
 * Time: 09:52
 */
?>
<div class="message">
    <?= empty($_SESSION['msg']['error']) ? '' : $_SESSION['msg']['error']; ?>
</div>

<h1>Incription</h1>

<form method="POST" action="?controller=user&action=newUser">

    <label for="login">Votre pseudo : </label>
    <input type="text" name="login" id="login">

    <label for="lastname">Votre nom : </label>
    <input type="text" name="lastname" id="lastname">

    <label for="firstname">Votre prénom</label>
    <input type="text" name="firstname" id="firstname">

    <label for="email">Email</label>
    <input type="text" name="email" id="email">

    <label for="password">Votre mot de passe : </label>
    <input type="password" name="password" id="password">

    <label for="password_confirm">Confirmer votre mot de passe : </label>
    <input type="password" name="password_confirm" id="password_confirm">
    <?php
    if (!empty($error)){
        echo '<div class="error"><ul>';
        foreach ($error as $key){
            echo "<li>". $key."</li>";
        }
        echo "</ul></div>";
    }
    ?>
    <input class="button" type="submit" value="valider">
</form>
<a class="button" href="?controller=user&action=default">Retour</a>

