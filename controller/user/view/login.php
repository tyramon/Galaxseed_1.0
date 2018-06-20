<?php

if (array_key_exists('msg', $_SESSION)){
    foreach ($_SESSION['msg'] as $key => $value){
        echo '<div class="'.$key.'">'.$value.'</div>';
    }
    unset($_SESSION['msg']);
}

?>

<div class="login-wrap">
    <div class="login-form">
        <form method="POST" action="index.php?controller=user&action=connexion">
            <div class="form-group">
                <label for="log">Login</label>
                <input id="log" type="text" name="login" value="">
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input id="pass" type="password" name="psw" value="">
            </div>
            <div class="form-group">
                <input type="submit" value="connexion">
            </div>
        </form>

        <a class="button" href="index.php">accueil</a>
    </div>
</div>



