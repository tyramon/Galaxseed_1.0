<?php
var_dump($_SESSION);

?>

<div class="message">
    <?= empty($_SESSION['msg']['error']) ? '' : $_SESSION['msg']['error']; ?>
</div>


<div class="login-wrap">
    <div class="login-form">
        <form method="POST" action="?controller=user&action=connexion">
            <div class="form-group">
                <label for="login">Login</label>
                <input id="login" type="text" name="login" value="">
            </div>
            <div class="form-group">
                <label for="psw">Password</label>
                <input id="psw" type="password" name="psw" value="">
            </div>
            <div class="form-group">
                <input type="submit" value="connexion">
            </div>
        </form>

        <a class="button" href="index.php">accueil</a>
    </div>
</div>

