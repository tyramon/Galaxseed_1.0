<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 16/05/2018
 * Time: 10:19
 */

class User
{
    // rajouter sa capacity et ses authorizations
    private $id;
    private $login;
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
        // Removes the first two letters to match the method name
        foreach ($data as $key => $val){

            if (strpos($key, 'u_'))
            {
                $key = str_replace('u_', '', $key);
            }
            elseif (strpos($key, 'c_'))
            {
                $key = str_replace('c_', '', $key);
            }

            // classic hydration steps
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
     *       METHODS
     */



    // methods here if needed



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
    public function getRegistrationDate()
    {
        return $this->registration_date;
    }

    /**
     * @param mixed $registration_date
     */
    public function setRegistrationDate($registration_date): void
    {
        $this->registration_date = $registration_date;
    }

    /**
     * @return mixed
     */
    public function getGameCount()
    {
        return $this->game_count;
    }

    /**
     * @param mixed $game_count
     */
    public function setGameCount($game_count): void
    {
        $this->game_count = $game_count;
    }

    /**
     * @return mixed
     */
    public function getVictoryCount()
    {
        return $this->victory_count;
    }

    /**
     * @param mixed $victory_count
     */
    public function setVictoryCount($victory_count): void
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