<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\model;

use dndcompany\galaxseed\model\entity\Hero;
use dndcompany\galaxseed\model\entity\Card;

/**1
 * Created by PhpStorm.
 * UserManager: webuser1801
 * Date: 18/04/2018
 * Time: 14:21
 */

class HeroManager
{

    /**
     * Fetch all the information on the hero in the db and creates an object
     * @param int $id
     * @return Hero
     */
    public function getHeroById(int $id) : Hero
    {
        $sql = 'faire le select une fois que la db aura été mise à jour';

        $data = DBManager::getInstance()->makeSelect($sql);

        return new Hero($data[0]);
    }


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

    public function updateHeroGame(Hero $heroId) : void         // on lui passe l'objet hero avec les nouvelles stats pour les enregistrer en db
    {
        $sql = 'faire le update';
        // mise a jour des stats du hero
        DBManager::getInstance()->makeUpdate($sql);
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