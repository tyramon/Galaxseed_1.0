<?php
declare(strict_types=1);

namespace dndcompany\galaxseed;
use dndcompany\galaxseed\controller\game\GameController;
use dndcompany\galaxseed\controller\hero\HeroController;
use dndcompany\galaxseed\model\entity\Hero;

require "config.php";

//teste
//tour 1:
// plateau pres pour le premier tour du joueur 1
// les cartes sont distribuees
// joueur 1 est actif et joureur 2 est passif
// les deux joueurs ont 1 de mana
// le joueur 1 peut poser une carte
// il peut passer son tour
// puis la meme chose pour le joueur 2
// enfin le round augmante de 1
// le mana augmante de 1
// on pioche une carte en debut du tour du joueur

$html='';



if (!isset($hero1))
{
    $gameController= new GameController();
    $hero1=$gameController->initGame(1);
    $hero2=$gameController->initGame(2);
    $hero1->pickCardInDeck();
    // Modifier le setter pour setter la localisation des cartes
//    Sauvegarder dans card_game
    var_dump($hero1);
    $tabHand=$hero1->getCardsInHand();
}

if (isset($_GET['action']) && $_GET['action'] === 'invoke' && isset($_GET['card']))
{
    $heroController= new HeroController();
    $hero1=$gameController->getHero(1);
    $html=$heroController->viewHand($tabHand);
    $heroController->invocation((int)$_GET['card'], $hero1);
    $hero1->checkInvoke((int)$_GET['card']);

var_dump($hero1);
}

$heroController= new HeroController();
$html=$heroController->viewHand($tabHand);



require "view/board.php";