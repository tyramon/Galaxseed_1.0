<div class="container">
    <img class="perso-img reine-sadidas-home" src="assets/images/website/reine.png" alt="Sadidas queen image">

    <div class="form-div">
        <div class="message <?= isset($errorClass) ? $errorClass : '' ?> ">
            <?= isset($errorMessage) ? $errorMessage : '' ?>
        </div>
        <form  method="POST" action="?controller=user&action=connexion">
            <input  id="log" type="text" placeholder="Pseudo" name="login" >
            <input id="pass" type="password" placeholder="Mot de passe" name="psw">
            <input class="login-button" type="submit" value="CONNEXION">
        </form>
        <a class="button-link" href="?controller=home&action=default">Retour à l'accueil</a>
    </div>

    <img class="perso-img diskor-home" src="assets/images/website/diskor2.png" alt="diskor image">
</div>






