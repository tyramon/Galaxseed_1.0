<?php
/**
 * Created by PhpStorm.
 * UserManager: webuser1801
 * Date: 18/04/2018
 * Time: 14:19
 */
declare(strict_types=1);

namespace dndcompany\galaxseed\model;

use User;

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
    public function getUserByLogin(int $login)
    {
        $sql = 'SELECT `user`.*, `capacity`.`c_name` 
                FROM `user` 
                JOIN `capacity` ON `user`.`c_id` = `capacity`.`c_id` 
                WHERE `user`.`u_login` = :login';

        $data = DBManager::getInstance()->makeSelect($sql, ['login' => $login]);

        return new User($data[0]);
    }

    /**
     * Check if the login isn't already taken
     * returns true if login is available
     * returns false if login is taken
     * @return bool
     */
    public function loginIsAvailable() : bool
    {
        $sql = "SELECT `u_login` FROM `user` WHERE `u_login`=:login";
        $params = ['login' => SRequest::getInstance()->post('identifiant')];
        $rows =  DBManager::getInstance()->getRowCount($sql, $params);

        if ($rows<1){ return true; }

        return false;
    }


    /**
     * Check if the email isn't already exists
     * returns true if email doesn't exists
     * returns false if email is exists
     * @return bool
     */
    public function emailIsAvailable(): bool
    {
        $sql = "SELECT `u_email` FROM `user` WHERE `u_email`=:email";
        $params = ['email' => SRequest::getInstance()->post('email')];
        $rows = DBManager::getInstance()->getRowCount($sql, $params);

        if ($rows<1){ return true; }

        return false;
    }


    /**
     *
     */
    public function addUser()
    {
        $sRequest = SRequest::getInstance();  // gets the user info for the Get/Post Request


        $sql = "INSERT INTO `user` (
                  `u_login`, 
                  `u_nom`, 
                  `u_prenom`, 
                  `u_password`, 
                  `u_email`, 
                  `u_registration_date`, 
                  `u_game_count`, 
                  `u_victory_count`, 
                  `u_connect`, 
                  `c_id`, 
                  `g_id`, 
                  `s_id`)
                VALUES (:login, :nom, :prenom, :psw, :email, :register, :gamecount, :victory, :log, :role, :game, :news)";

        $params = [
            'login' => $sRequest->post('identifiant'),
            'nom' => $sRequest->post('nom'),
            'prenom' => $sRequest->post('prenom'),
            'psw' => password_hash($sRequest->post('passe'), PASSWORD_BCRYPT),
            'email' => $sRequest->post('email'),
            'register' => date("Y-m-j"),
            'gamecount' => NULL,
            'victory' => NULL,
            'log'=> NULL,
            'role' => 1,
            'game' => NULL,
            'news' => NULL
        ];

        DBManager::getInstance()->makeInsert($sql, $params);
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