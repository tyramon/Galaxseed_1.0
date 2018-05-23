<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * UserManager: webuser1801
 * Date: 18/04/2018
 * Time: 14:23
 */
namespace dndcompany\galaxseed\model;

class CardManager
{

    public function getCard(string $card_name){


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