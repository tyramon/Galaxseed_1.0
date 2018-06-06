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

    public function initGameRecord()
    {
        // intialiation de la partie dans la db
    }

    public function updateGameRecord(int $id)
    {
        // mise a jour des infos sur le status de la partie
    }

    public function deleteGameRecord()
    {
        // (a voir)
    }


    public function initHeroGame()
    {
        //Creation d'une table copie de card-template
//        DBManager::getInstance()->getPdo()->query('CREATE TABLE card_game1 LIKE card_template');

        DBManager::getInstance()->getPdo()->query('DELETE FROM hero_game');
        DBManager::getInstance()->getPdo()->query('INSERT INTO hero_game SELECT * FROM hero_template');
    }




}