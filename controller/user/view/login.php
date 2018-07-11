<div class="container">
    <div class="message <?= isset($errorClass) ? $errorClass : '' ?> ">
        <?= isset($errorMessage) ? $errorMessage : '' ?>
    </div>

    <form method="POST" action="?controller=user&action=connexion">
        <div class="form-group">
            <label for="login">Login</label>
            <input id="login" type="text" name="login" value="">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="psw" value="">
        </div>
        <div class="form-group">
            <input type="submit" value="connexion">
        </div>
    </form>

    <a class="button" href="index.php">accueil</a>
</div>

