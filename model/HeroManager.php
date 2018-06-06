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
        $sql='SELECT hg_id AS id, hg_name AS name, hg_health_point AS healthPoints, hg_mana_count AS manaCount, hg_board AS board FROM hero_game WHERE hg_id=:id';
        $dataHero=DBManager::getInstance()->makeSelect($sql, ['id'=>$id]);

        return $dataHero[0];
        //index 0 pour retourner 1 tableau simple pour l'hydratation
    }

    public function updateHeroGame(int $idHero, int $manaHero) : void         // on lui passe l'objet hero avec les nouvelles stats pour les enregistrer en db
    {
        $sql='UPDATE hero_game SET hg_mana_count=:mana WHERE hg_id=:idHero';
        DBManager::getInstance()->makeStatement($sql, ['idHero'=> $idHero, 'mana' => $manaHero]);
    }


    public function GetDeck(int $idHero) : array
    {
        $sql='SELECT * FROM card_game1 WHERE ht_id=:id AND l_id=1';
        $data=DBManager::getInstance()->makeSelect($sql,['id'=>$idHero]);

        $deck=array();
        foreach ($data as $card)
        {
            $deck[]=new Card($card);
        }

        shuffle($deck);

        return $deck;
    }

    public function getHand(int $idHero) : array
    {
        $sql='SELECT * FROM card_game1 WHERE ht_id=:id AND l_id=2';
        $data=DBManager::getInstance()->makeSelect($sql,['id'=>$idHero]);

        $hand=array();
        foreach ($data as $card)
        {
            $hand[]=new Card($card);
        }
        return $hand;
    }

    public function getBoard(int $idHero) : array
    {
        $sql='SELECT ct_id AS id, ct_name AS name, ct_health_point AS hp, ct_attack AS attack, ct_mana AS mana, ct_shield AS shield, t_id AS type, ct_description AS description, ht_id AS hero, s_id AS status, ic_id AS illustration, l_id AS location FROM card_game1 WHERE ht_id=:id AND l_id=3';
        $data=DBManager::getInstance()->makeSelect($sql,['id'=>$idHero]);

        $board=array();
        foreach ($data as $card)
        {
            $board[]=new Card($card);
        }
        return $board;
    }


    public function initCardGame()
    {
        //Creation d'une table copie de card-template
//        DBManager::getInstance()->getPdo()->query('CREATE TABLE card_game1 LIKE card_template');

        DBManager::getInstance()->getPdo()->query('DELETE FROM card_game1');
        DBManager::getInstance()->getPdo()->query('INSERT INTO card_game1 SELECT * FROM card_template');

    }

}