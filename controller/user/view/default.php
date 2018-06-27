<?php
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 20/06/2018
 * Time: 09:50
 */

echo 'Page du login';

?>

<div class="login-wrap">
    <p>Connexion</p>

    <form method="POST" action="?controller=user&action=connexion">
        <label for="log">Login</label>
        <input  id="log" type="text" name="login" >
        <label for="pass">Password</label>
        <input id="pass" type="password" name="psw">
        <input class="button" type="submit" value="connection">
    </form>

    <a class="button" href="?controller=user&action=register">S'inscrire</a>

    <a class="button" href="?controller=home&action=default">Retour à l'accueil</a>
</div>







<!---->
<!--if ($this->isAuth()){-->
<!--    $affiche = "-->
<!---->
<!--                    <p>Bienvenue chez toi  </p>-->
<!---->
<!---->
<!---->
<!--                    <a class='link' href='index.php?controller=user&action=profile' >-->
<!---->
<!--                        <p>Profile</p>-->
<!--                    </a>-->
<!---->
<!--                ";-->
<!---->
<!--}else{-->
<!--    $affiche = '-->
<!---->
<!--                         <p>Login</p>-->
<!---->
<!--                        <form method="POST" action="index.php?controller=user&action=connexion">-->
<!--                            <label for="log">Login</label>-->
<!--                            <input  id="log" type="text" name="login" >-->
<!--                            <label for="pass">Password</label>-->
<!--                            <input id="pass" type="password" name="psw">-->
<!--                            <input type="submit" value="connection">-->
<!--                        </form>-->
<!---->
<!--                        <a href="index.php?controller=user&action=register"><button>S\'inscrire</button></a>-->
<!---->
<!--                ';-->
<!--}-->
<!---->
<!--?>-->
<!---->
<!---->
<?//=$affiche?>




