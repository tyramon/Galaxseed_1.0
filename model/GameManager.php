<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\model;

class GameManager
{
    public function allInfoGameById(int $id) : array
    {
        $data=DBManager::getInstance()->makeSelect('SELECT * FROM game WHERE id=:id', $id);
        return $data;
    }

    // intialiation de la partie dans la db
    public function initGame(int $idPlayer1, int $idHero1, int $idPlayer2, int $idHero2)
    {
        $sql='INSERT INTO game VALUES (NULL, NOW(), 1, :player1, :hero1, :player2, :hero2)';
        DBManager::getInstance()->makeStatement($sql, ['player1'=>$idPlayer1, 'hero1'=>$idHero1, 'player2'=>$idPlayer2, 'hero2'=>$idHero2]);
    }

    public function startGame(int $idPlayer1)
    {
        // A finir bordel

        $sql='Select g_id AS id, g_date AS dateCreate, g_round_count AS roundGame, u_id_p1 AS idPlayer1, hg_id_p1 AS idHeroPlayer1, u_id_p2 AS idPlayer2, hg_id_p2 AS idHeroPlayer2 FROM game WHERE u_id_p1=:idPlayer1';
        $data =DBManager::getInstance()->makeSelect($sql, ['idPlayer1'=>$idPlayer1]);

        return $data[0];
    }

//    public function updateGame(int $idGame)
//    {
//
//        // mise a jour des infos sur le status de la partie
//    }

//    public function deleteGame()
//    {
//        // (a voir)
//    }


    public function initHeroGame()
    {
        //Creation d'une table copie de card-template
//        DBManager::getInstance()->getPdo()->query('CREATE TABLE card_game1 LIKE card_template');

        DBManager::getInstance()->getPdo()->query('DELETE FROM hero_game');
        DBManager::getInstance()->getPdo()->query('INSERT INTO hero_game SELECT * FROM hero_template');
    }




}