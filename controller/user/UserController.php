<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * UserManager: webuser1801
 * Date: 18/04/2018
 * Time: 14:18
 */
namespace dndcompany\galaxseed\controller\user;
use dndcompany\galaxseed\model\UserManager;


class UserController
{

    public function userLogin(){

    }

    /**
     * Adds a new user in database.
     * @param $data
     * @return bool
     */
    public function addNewUser($data){

        // faire un bloc try/catch pour pouvoir revoyer les exceptions
        // vérifier que tous les champs soient remplis sinon -> thow except
        // verifier en db que le login, email, mdp soient unique sinon -> throw except
        // bonus : vérifier que le mdp fasse au moins 8 charact, ait au moins un chiffre et une majuscule (regex)

        $manager = new UserManager();

        if ($manager->add($data) == true)
        {
            return true;
        }


        // checker ce que return un insert. Peut-etre returner affected rows et controller le nombre.
        // ensuite returner true si affected rows > 0 sinon return fals
        return false;
    }

    public function deleteUser(){

    }

    public function UpdateUser(){

    }


}