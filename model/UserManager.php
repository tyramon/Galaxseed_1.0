<?php
declare(strict_types=1);
namespace dndcompany\galaxseed\model;
/**
 * Created by PhpStorm.
 * UserManager: webuser1801
 * Date: 18/04/2018
 * Time: 14:19
 */
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
     * adds a user in the database
     * @param $data
     */
    public function add($data)
    {
        $sql = 'INSERT INTO `user` VALUES ';

        DBManager::getInstance()->getPdo()->query($sql);

        return //affected rows
    }

}