<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\model;

class CardManager
{

    public function getCard(int $idCard) : array
    {
        $sql='SELECT ct_id AS id, ct_name AS name, ct_health_point AS hp, ct_attack AS attack, ct_mana AS mana, ct_shield AS shield, t_id AS type, ct_description AS description, ht_id AS hero, s_id AS status, ic_id AS illustration, l_id AS location FROM card_game1 WHERE ct_id=:idCard';
        $result = DBManager::getInstance()->makeSelect($sql, ['idCard'=>$idCard]);

        return $result[0];
        //Index 0 pour retourner un tableau simple en vue de l'hydratation
    }

    public function getDeckPlayer(int $id_player, int $id_hero) : array
    {

        $sql = '';
        $result = DBManager::getInstance()->makeSelect($sql);

    }



    public function updateCardGame(int $idCard, int $locate)
    {
        $sql='UPDATE card_game1 SET l_id=:locate WHERE ct_id=:idCard';
        DBManager::getInstance()->makeStatement($sql, ['idCard'=> $idCard, 'locate'=>$locate]);
    }




}