<?php
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 20/06/2018
 * Time: 09:52
 */
?>
<div class="message <?= isset($errorClass) ? $errorClass : '' ?> ">
    <?php if(isset($errorMessage))
    {
        if (is_array($errorMessage)){
            foreach ($errorMessage as $error){
                echo '<p>' . $error . '</p>';
            }
        } else {
            echo $errorMessage;
        }
    }
?>
</div>
<div class="container">
    <h1>Formulaire d'inscription</h1>

    <form method="POST" action="?controller=user&action=newUser">
        <div class="form-group">
            <label for="login">Votre pseudo : </label>
            <input type="text" name="login" id="login" value="<?= isset($user['login']) ? $user['login'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="lastname">Votre nom : </label>
            <input type="text" name="lastname" id="lastname" value="<?= isset($user['login']) ? $user['lastname'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="firstname">Votre prénom</label>
            <input type="text" name="firstname" id="firstname" value="<?= isset($user['login']) ? $user['firstname'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?= isset($user['login']) ? $user['email'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="password">Votre mot de passe : </label>
            <input type="password" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="password_confirm">Confirmer votre mot de passe : </label>
            <input type="password" name="password_confirm" id="password_confirm">
        </div>
        <div class="form-group">
            <input class="button" type="submit" value="valider">
        </div>
    </form>
    <a class="button" href="?controller=user&action=default">Retour</a>

</div>



