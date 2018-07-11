<?php
declare(strict_types=1);


namespace dndcompany\galaxseed\controller\FutureGame;
use dndcompany\galaxseed\controller\card\CardController;
use dndcompany\galaxseed\controller\game\GameController;
use dndcompany\galaxseed\controller\hero\HeroController;
use dndcompany\galaxseed\model\CardManager;
use dndcompany\galaxseed\model\entity\Card;
use dndcompany\galaxseed\model\entity\Game;
use dndcompany\galaxseed\model\entity\Hero;
use dndcompany\galaxseed\model\GameManager;
use dndcompany\galaxseed\model\HeroManager;
use dndcompany\galaxseed\model\SRequest;
use Symfony\Component\HttpFoundation\Request;


class  FuturegameController
{
    public function defaultAction()
    {
//teste
//tour 1:
// plateau prêt pour le premier tour du joueur 1
// les cartes sont distribuees
// joueur 1 est actif et joureur 2 est passif
// les deux joueurs ont 1 de mana
// le joueur 1 peut poser une carte
// il peut passer son tour
// puis la meme chose pour le joueur 2
// enfin le round augmante de 1
// le mana augmante de 1
// on pioche une carte en debut du tour du joueur
//        session_start();

        if (SRequest::getInstance()->post('choixHero') !== null)
        {
            $_SESSION['idHeroPlayer1']=(int)SRequest::getInstance()->post('choixHero');


        }

        $idHeroPlayer1=$_SESSION['idHeroPlayer1'];
        if ($idHeroPlayer1 === 1)
        {
            $_SESSION['idHeroPlayer2']=2;

        }
        else
        {
            $_SESSION['idHeroPlayer2']=1;

        }
        $idHeroPlayer2= $_SESSION['idHeroPlayer2'];

        $player1=4;
        $player2=8;

        if (!isset($_SESSION['idGame']))
        {
            $heroManager= new HeroManager();
            $heroManager->initCardGame();

            $gameManager=new GameManager();
            $gameManager->initHeroGame();

            $gameManager->initGame($player1, $idHeroPlayer1, $player2, $idHeroPlayer2);
            $dataGame=$gameManager->startGame($player1);

            $game=new Game($dataGame);
//    var_dump($game);
            $_SESSION['idGame']=$game->getId();

            $gameController= new GameController();
            $hero1=$gameController->initGame($idHeroPlayer1);
            $hero1->pickCardInDeck();
            $hero1->pickCardInDeck();
            $hero1->pickCardInDeck();

            $tabHand=$hero1->getCardsInHand();

            $hero2=$gameController->initGame($idHeroPlayer2);

            $cartemanager = new CardManager();
            if ($idHeroPlayer1 = 1)
            {
                $cartemanager->updateCardGame(8, 3);
                $cartemanager->updateCardGame(10, 3);
            }
            else
            {
                $cartemanager->updateCardGame(22, 3);
                $cartemanager->updateCardGame(24, 3);
            }

        }


        if (SRequest::getInstance()->post('move') === 'reset')
        {
            session_destroy();
            header('Location: index.php');
        }


        $gameController= new GameController();
        $hero1=new Hero($gameController->getHero($idHeroPlayer1));



// Phase d'attaque
        if (!isset($_SESSION['attack']))
        {
            if (SRequest::getInstance()->post('move') === 'attack' && SRequest::getInstance()->post('idCardAttack'))
            {
                $idCardAttack= (int)SRequest::getInstance()->post('idCardAttack');
                $cardManager=new CardManager();
                $cardAttack = new Card($cardManager->getCard($idCardAttack));

                $_SESSION['attack']=$cardAttack;
            }
        }

        if (isset($_SESSION['attack']))
        {
            if (SRequest::getInstance()->post('move') === 'cible' && SRequest::getInstance()->post('idCardCible'))
            {
                $idCardCible = (int)SRequest::getInstance()->post('idCardCible');
                $cardManager=new CardManager();
                $cardTarget= new Card($cardManager->getCard($idCardCible));
                $cardAttack = $_SESSION['attack'];

                $cardController = new CardController();
                $cardController->attack($cardAttack, $cardTarget);

                $cardAttack->setAttackCount(1);
                $cardManager->updateAttackCountCard($cardAttack->getId(), $cardAttack->getAttackCount());

                $cardController->attack($cardTarget, $cardAttack);
                if($cardAttack->getHp() <= 0){
                    $cardAttack->setLocation(4);
                    $cardManager->updateCardGame($cardAttack->getId(), 4);
                }
                if($cardTarget->getHp() <= 0){
                    $cardTarget->setLocation(4);
                    $cardManager->updateCardGame($cardTarget->getId(), 4);
                }
                unset($_SESSION['attack']);
            }
        }

//Phase d'invocation
        if (SRequest::getInstance()->post('move') === 'invoke' && SRequest::getInstance()->post('card'))
        {
            $idCard = (int)SRequest::getInstance()->post('card');

            $heroController= new HeroController();
            $gameController= new GameController();

            $hero1=new Hero($gameController->getHero($idHeroPlayer1));
            $gameController->setAllZone($hero1);

            $heroController->invocation($idCard, $hero1);

            $gameController->setAllZone($hero1);

            $hero2=new Hero($gameController->getHero($idHeroPlayer2));
        }

        $gameController->setAllZone($hero1);
//$gameController->setAllZone($hero2);

        $heroController= new HeroController();
        $cardHand=$heroController->viewHand($idHeroPlayer1);
        $cardBoard=$heroController->viewCardBoard($idHeroPlayer1);

        $cardBoardAdv=$heroController->viewCardBoard($idHeroPlayer2);
//var_dump($hero2);


        require "view/board.php";

        var_dump($hero1);
    }

}



