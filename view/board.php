<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">

    <title>Galaxseed</title>
</head>
<body>

<div class="plateau">
    <div class="main_adversaire">

    </div>
    <div class="plateau_adversaire">

        <?php
        if (!empty($cardBoardAdv)){
            foreach ($cardBoardAdv as $card) {
                echo '<div class="carte" style="background: url(assets/images/'. $card->getName() .'.png) no-repeat ; background-size: 150px" >' . $card->getName() . '<br/> mana : ' . $card->getMana() . '<br/> attaque : ' . $card->getAttack() . '<br/> PV : ' . $card->getHp();
                if(isset($_GET['move']) && $_GET['move'] === 'attack'){
                    echo '<form method="post" action="?controller=FutureGame&action=default">
                              <input type="hidden" name="move" value="cible"/>
                              <input type="hidden" name="idCardCible" value="' . $card->getId() . '"/>
                              <input type="submit" value="Cible"/>
                          </form>';
                }
                echo '</div>';
            }
        }
        ?>

    </div>
    <div class="plateau_joueur">


        <?php
        if (!empty($cardBoard)){
            foreach ($cardBoard as $card) {
                echo '<div class="carte" style="background: url(assets/images/'. $card->getName() .'.png) no-repeat; background-size: 150px">' . $card->getName() . '<br/> mana : ' . $card->getMana() . '<br/> attaque : ' . $card->getAttack() . '<br/> PV : ' . $card->getHp();
                if ($card->getAttackCount() === 0 ){
                    echo  '<form method="post" action="?controller=FutureGame&action=default">
                          <input type="hidden" name="move" value="attack"/>
                          <input type="hidden" name="idCardAttack" value="' . $card->getId() . '"/>
                          <input type="submit" value="Attaquer"/>
                     </form>';
                }

                echo '</div>';
            }
        }
        ?>


    </div>
    <div class="main_joueur">

        <?php
        if (!empty($cardHand)){
            foreach ($cardHand as $card) {
                echo '<div class="carte" style="background: url(assets/images/'. $card->getName() .'.png) no-repeat; background-size: 150px">' . $card->getName() . '<br/> mana : ' . $card->getMana() . '<br/> attaque : ' . $card->getAttack() . '<br/> PV : ' . $card->getHp();
                if ($hero1->getManaCount() >= $card->getMana()){
                    echo '<form method="post" action="?controller=FutureGame&action=default">
                          <input type="hidden" name="move" value="invoke"/>
                          <input type="hidden" name="card" value="' . $card->getId() . '"/>
                          <input type="submit" value="invoquer"/>
                     </form>';
                }

                echo '</div>';
            }
        }

        ?>

    </div>
</div>
<?php
echo 'Mana dispo : ' . $hero1->getManaCount();
?>
<form method="post" action="?controller=FutureGame&action=default">
    <input name="move" type="submit" value="reset"/>
</form>
<form method="get" action="">
    <input name="action" type="submit" value="finDuTour"/>
</form>

</body>
</html>