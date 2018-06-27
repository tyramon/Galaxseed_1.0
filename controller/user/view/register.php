<?php
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 20/06/2018
 * Time: 09:52
 */
?>
<h1>Incription</h1>

    <form method="post" action="index.php?controller=user&action=newUser">

        <label for="identifiant">Votre pseudo : </label>
        <input type="text" name="identifiant" id="identifiant">

        <label for="nom">Votre nom : </label>
        <input type="text" name="nom" id="nom">

        <label for="prenom">Votre prénom</label>
        <input type="text" name="prenom" id="prenom">

        <label for="email">Email</label>
        <input type="text" name="email" id="email">

        <label for="passe">Votre mot de passe : </label>
        <input type="password" name="passe" id="passe">

        <label for="confirm">Confirmer votre mot de passe : </label>
        <input type="password" name="confirm" id="confirm">
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
    <a class="button" href="?controller=home&action=default">Retour à l'accueil</a>

