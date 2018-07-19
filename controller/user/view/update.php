<?php
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 04/07/2018
 * Time: 14:00
 */
$user = $_SESSION['user'];
?>

<div class="message <?= isset($msgClass) ? $msgClass : '' ?> ">
    <?php if(isset($message))
    {
        if (is_array($message)){
            foreach ($message as $error){
                echo '<p>' . $error . '</p>';
            }
        } else {
            echo $message;
        }
    }
    ?>
</div>
<div class="container">
    <h1>Modifier mon profil</h1>

    <form method="POST" action="?controller=user&action=makeUpdateProfile">
        <div class="form-group">
            <label for="login">Votre pseudo : </label>
            <input type="text" name="login" id="login" value="<?= $user->getLogin() ?>">
        </div>
        <div class="form-group">
            <label for="firstname">Votre prénom : </label>
            <input type="text" name="firstname" id="firstname" value="<?= $user->getFirstname() ?>">
        </div>
        <div class="form-group">
            <label for="lastname">Votre nom : </label>
            <input type="text" name="lastname" id="lastname" value="<?= $user->getLastname() ?>">
        </div>
        <div class="form-group">
            <label for="email">Votre email : </label>
            <input type="text" name="email" id="email" value="<?= $user->getEmail() ?>">
        </div>

        <input type="hidden" name="user" value="<?= $user->getId() ?>">

        <div class="form-group">
            <input class="button" type="submit" value="valider">
        </div>
    </form>

    <!-- Password change -->
    <div class="change-password">
        <button class="button" id="password-change-btn">Changer mon mot de passe</button>
        <form method="POST" action="?controller=user&action=UpdatePassword" id="update-password-form">
            <div class="form-group">
                <label for="password-update">Nouveau mot de passe : </label>
                <input type="password" name="password-update" id="password-update" value="">
            </div>
            <div class="form-group">
                <label for="password-update-confirm">Confirmez le mot de passe : </label>
                <input type="password" name="password-update-confirm" id="password-update-confirm" value="">
            </div>
            <div class="form-group">
                <input class="button" type="submit" value="valider">
            </div>
        </form>
    </div>

    <a class="button" href="?controller=user&action=default">Retour au profil</a>
</div>

<!-- script to reveal password update form -->
<script>
    document.getElementById('password-change-btn').addEventListener('click', ()=>{

        let form = document.getElementById('update-password-form');

        if (form.style.display === 'block'){
            form.style.display = 'none';
        } else {
            form.style.display = 'block';
        }
    })
</script>