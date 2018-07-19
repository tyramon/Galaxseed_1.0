<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 16/05/2018
 * Time: 10:19
 */

namespace dndcompany\galaxseed\model\entity;


class User
{
    // rajouter sa capacity et ses authorizations
    private $id;
    private $login;
    private $firstname;
    private $lastname;
    private $password;
    private $email;
    private $registration_date;
    private $game_count;
    private $victory_count;
    private $avatar;
    private $capacity;

    /**
     * User constructor.
     * @param array $dataUserManager
     */
    public function __construct(array $dataUserManager)
    {
        $this->hydrate($dataUserManager);
    }

    /**
     * @param $data
     */
    public function hydrate($data)
    {
        foreach ($data as $key => $val){                    // Removes the first two letters to match the method name
                                                            // Other solution would be to put aliases in sql query to clean up the name attributes
            if (strpos($key, 'u_') == 0)
            {
               $key = str_replace('u_', '', $key);
            }

//            if (strpos($key, 'c_') == 0 )                 // creates conflict between u_id and c_id
//            {
//                $key = str_replace('c_', '', $key);
//            }

            // classic hydratation steps
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)){

                if (is_numeric($val))
                {
                    $val = (int)$val;
                }

                $this->$method($val);
            }
        }
    }


    /*
     *       SETTERS & GETTERS
     */


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRegistration_date()
    {
        return $this->registration_date;
    }

    /**
     * @param mixed $registration_date
     */
    public function setRegistration_date($registration_date): void
    {
        $this->registration_date = $registration_date;
    }

    /**
     * @return mixed
     */
    public function getGame_count()
    {
        return $this->game_count;
    }

    /**
     * @param mixed $game_count
     */
    public function setGame_count($game_count): void
    {
        $this->game_count = $game_count;
    }

    /**
     * @return mixed
     */
    public function getVictory_count()
    {
        return $this->victory_count;
    }

    /**
     * @param mixed $victory_count
     */
    public function setVictory_count($victory_count): void
    {
        $this->victory_count = $victory_count;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param mixed $capacity
     */
    public function setCapacity($capacity): void
    {
        $this->capacity = $capacity;
    }
} // End of class