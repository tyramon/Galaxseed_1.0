<?php
/**
 * Created by PhpStorm.
 * UserManager: webuser1801
 * Date: 18/04/2018
 * Time: 14:19
 */
declare(strict_types=1);

namespace dndcompany\galaxseed\model;

use dndcompany\galaxseed\model\entity\User;
use Exception;

class UserManager
{
    /**
     * Gets User object by the id
     * @param int $id
     * @return User
     */
    public function getUserById(int $id)
    {
        $sql = 'SELECT `user`.*, `capacity`.`c_name` 
                FROM `user` 
                JOIN `capacity` ON `user`.`c_id` = `capacity`.`c_id` 
                WHERE `user`.`u_id` = :id';

        $data = DBManager::getInstance()->makeSelect($sql, ['id' => $id]);

        return new User($data[0]);
    }


    /**
     * Gets User object by the email
     * @param int $email
     * @return User
     */
    public function getUserByEmail(int $email)
    {
        $sql = 'SELECT `user`.*, `capacity`.`c_name` 
                FROM `user` 
                JOIN `capacity` ON `user`.`c_id` = `capacity`.`c_id` 
                WHERE `user`.`u_email` = :id';

        $data = DBManager::getInstance()->makeSelect($sql, ['email' => $email]);

        return new User($data[0]);
    }

    /**
     * Gets User object by the login
     * @param int $email
     * @return User
     */
    public function getUserByLogin(string $login)
    {
        $sql = 'SELECT `user`.*, `capacity`.`c_name` 
                FROM `user` 
                JOIN `capacity` ON `user`.`c_id` = `capacity`.`c_id` 
                WHERE `user`.`u_login` = :login';

        $data = DBManager::getInstance()->makeSelect($sql, ['login' => $login]);

        if ($data){
            return new User($data[0]);
        } else {
            throw new Exception('Utilisateur n\'existe pas');
        }
    }

    /**
     * Check if the login isn't already taken
     * returns true if login is available
     * returns false if login is taken
     * @param $login
     * @return bool
     */
    public function loginIsAvailable($login) : bool
    {
        $sql = "SELECT `u_login` FROM `user` WHERE `u_login`=:login";
        $params = ['login' => $login];
        $rows =  DBManager::getInstance()->getRowCount($sql, $params);

        if ($rows<1){ return true; }

        return false;
    }


    /**
     * Check if the email isn't already exists
     * returns true if email doesn't exists
     * returns false if email is exists
     * @param $email
     * @return bool
     */
    public function emailIsAvailable($email): bool
    {
        $sql = "SELECT `u_email` FROM `user` WHERE `u_email`=:email";
        $params = ['email' => $email];
        $rows = DBManager::getInstance()->getRowCount($sql, $params);

        if ($rows<1){ return true; }

        return false;
    }


    /**
     * @param $user
     * @return bool
     */
    public function addUser($user) : bool
    {
        $sql = "INSERT INTO `user` (
                  `u_login`, 
                  `u_lastname`, 
                  `u_firstname`, 
                  `u_password`, 
                  `u_email`, 
                  `u_registration_date`, 
                  `u_game_count`, 
                  `u_victory_count`, 
                  `u_connect`, 
                  `c_id`, 
                  `g_id`, 
                  `s_id`)
                VALUES (:login, :lastname, :firstname, :pwd, :email, :register, :gamecount, :victory, :log, :role, :game, :news)";

        $params = [
            'login' => $user['login'],
            'lastname' => $user['lastname'],
            'firstname' => $user['firstname'],
            'pwd' => password_hash($user['password'], PASSWORD_BCRYPT),
            'email' => $user['email'],
            'register' => date("Y-m-j"),
            'gamecount' => NULL,
            'victory' => NULL,
            'log'=> NULL,
            'role' => 1,
            'game' => NULL,
            'news' => NULL
        ];

        if (DBManager::getInstance()->makeInsert($sql, $params))
        {
            return true;
        }
        return false;
    }

    public function updateUser() : bool
    {
        // Update user info
        // needs : user id, info to update
        // return true/false
    }

    public function deleteUser() : bool
    {
        // delete user account
        // needs user id
        // returns true/false
    }

} // End of class