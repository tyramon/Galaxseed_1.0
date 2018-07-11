<div class="container">
    <div class="message <?= isset($errorClass) ? $errorClass : '' ?> ">
        <?= isset($errorMessage) ? $errorMessage : '' ?>
    </div>

    <h2>Connection au profil:</h2>

    <form method="POST" action="?controller=user&action=connexion">
        <div class="form-group">
            <label for="log">Login</label>
            <input  id="log" type="text" name="login" >
        </div>
        <div class="form-group">
            <label for="pass">Password</label>
            <input id="pass" type="password" name="psw">
        </div>
        <div class="form-group">
            <input class="button" type="submit" value="Se connecter">
            <a class="button" href="?controller=user&action=register">S'inscrire</a>
            <a class="button" href="?controller=home&action=default">Retour à l'accueil</a>
        </div>
    </form>

</div>






