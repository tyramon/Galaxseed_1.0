<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\model;
use dndcompany\galaxseed\model\entity\Hero;

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

    /**
     * Updates the Hero information after each turn
     * @param array $newStats
     */
    public function updateHeroGame(Hero $heroId) : void         // on lui passe l'objet hero avec les nouvelles stats pour les enregistrer en db
    {
        $sql = 'faire le update';

        DBManager::getInstance()->makeUpdate($sql);
    }

    public function killHero(int $id)
    {

    }

}