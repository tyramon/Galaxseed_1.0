<?php
declare(strict_type=1);

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





}