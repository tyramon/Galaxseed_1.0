<?php
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 20/06/2018
 * Time: 09:48
 */

$user = $_SESSION['user'];

?>
<h2>Bienvenu <?=$user->getFirstname()?> !</h2>


<a class="button" href="?controller=user&action=update">Modifier mon profil</a>
<a class="button" href="?controller=user&action=logout">se deconnecter</a>

