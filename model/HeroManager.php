<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\model;

use dndcompany\galaxseed\model\entity\Card;

class HeroManager
{
    public function heroDataTemplate($id)
    {
        // recuperation des infos du hero
        $sql='SELECT ht_id AS id, ht_name AS name, ht_health_point AS healthPoints, ht_mana_count AS manaCount, ht_board AS board, ih_id AS illustration FROM hero_template WHERE ht_id=:id';
        $dataHero=DBManager::getInstance()->makeSelect($sql, ['id'=>$id]);

        return $dataHero[0];
    }

    public function heroDataGame($id)
    {
        // recuperation des infos du hero
        $sql='SELECT hg_id AS id, hg_name AS name, hg_health_point AS healthPoints, hg_mana_count AS manaCount, hg_board AS board, ih_id AS illustration FROM hero_game WHERE hg_id=:id';
        $dataHero=DBManager::getInstance()->makeSelect($sql, ['id'=>$id]);

        return $dataHero[0];
    }

    public function updateHeroGame()
    {
        // mise a jour des stats du hero

    }


    public function GetDeck(int $id) : array
    {
        $sql='SELECT * FROM card_template WHERE ht_id=:id';
        $data=DBManager::getInstance()->makeSelect($sql,['id'=>$id]);

        $deck=array();
        foreach ($data as $card)
        {
            $deck[]=new Card($card);
        }

        shuffle($deck);

        return $deck;
    }


}