<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Galaxseed</title>
</head>
<body>
    <div class="main_adversaire">
        
    </div>
    <div class="plateau_adversaire">

    </div>
    <div class="plateau_joueur">

        <?php
        foreach ($cardBoard as $card) {
            echo '<div>' . $card->getName() . '<br/> mana : ' . $card->getMana() . '<br/> attaque : ' . $card->getAttack() . '
                     <form method="get" action="">
                          <input type="hidden" name="action" value="invoke"/>
                          <input type="hidden" name="card" value="' . $card->getId() . '"/>
                          <input type="submit" value="invoquer"/>
                     </form>
                 </div>';
        }
        ?>


    </div>
    <div class="main_joueur">

        <?php
        foreach ($cardHand as $card) {
            echo '<div>' . $card->getName() . '<br/> mana : ' . $card->getMana() . '<br/> attaque : ' . $card->getAttack() . '
                     <form method="get" action="">
                          <input type="hidden" name="action" value="invoke"/>
                          <input type="hidden" name="card" value="' . $card->getId() . '"/>
                          <input type="submit" value="invoquer"/>
                     </form>
                 </div>';
        }
        ?>
    </div>
</body>
</html>