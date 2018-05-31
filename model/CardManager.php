<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\model;

class CardManager
{

    public function getCard(int $id){


    }

    public function getDeckPlayer(int $id_player, int $id_hero) : array
    {

        $sql = '';
        $result = DBManager::getInstance()->makeSelect($sql);


    }

    public function updateCardGame()
    {
        // mise a jour des cartes durant la partie
    }




}