<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * UserManager: webuser1801
 * Date: 18/04/2018
 * Time: 14:18
 */
namespace dndcompany\galaxseed\controller\user;
use dndcompany\galaxseed\controller\CoreController;
use dndcompany\galaxseed\model\SRequest;
use dndcompany\galaxseed\model\UserManager;


class UserController extends CoreController
{

    protected $controller;   // controller name is used in the render to build the path


    public function __construct()
    {
        $this->controller = 'user';
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }



    /**
     * return the default homepage when the user isn't logged in
     */
    public function defaultAction()
    {
        if ($this->isAuth()){
            return $this->render($this->getController(),'profile', []);
        }

        return $this->render($this->getController(),'default', []);
    }

    /**
     * redirects user to the login page
     */
    public function loginAction()
    {
        //require('home/login.php');
        $this->render($this->getController(),'login', []);
    }

//
//    /**
//     * Redirects user to his profile page
//     */
//    public function profile()
//    {
//        if ($this->isAuth())
//        {
//            // require('home/profile.php');
//           return $this->render($this->getController(),'profile', []);
//        }
//        else
//        {
//            // require('home/default.php');
//           return $this->render($this->getController(),'default', []);
//        }
//    }


    /**
     * Redirects user to the register page
     */
    public function registerAction()
    {
        // require('home/register.php');
        return $this->render($this->getController(),'register', []);
    }


    /**
     * Checks if the login and email address isn't already taken
     * Validates the inputs from the register form
     * returns an array with the errors
     * @return array
     */
    public function registerValidation($postData) : array
    {
        $error = [];

        if (!empty($postData['login']) &&
            !empty($postData['lastname']) &&
            !empty($postData['firstname']) &&
            !empty($postData['email']) &&
            !empty($postData['password']))
        {
            $manager = new UserManager();
            $loginAvailable = $manager->loginIsAvailable($postData['login']);
            $emailAvailable = $manager->emailIsAvailable($postData['email']);

            // Login validation
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $postData['login'])){
                $error[] = "Ce pseudo n\'est pas valide.";
            } elseif ($loginAvailable == false) {
                $error[] = 'L\'identifiant est déjà utilisé.';
            }

            // lastname validation
            if (!preg_match('/^[a-zA-Z_]+$/', $postData['lastname'])){
                $error[] = "Le format du nom n\'est pas un format valide";
            }

            // firstname validation
            if (!preg_match('/^[a-zA-Z_]+$/', $postData['firstname'])) {
                $error[] = "Le format du prénom n\'est pas un format valide";
            }

            // email validation
            if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
                $error[] = "Le format de votre email est invalide";
            } elseif ($emailAvailable == false) {
                $error[] = 'Cette adresse email est déjà utilisée.';
            }

            // password validation
            if ($postData['password'] !== $postData['password_confirm'] || empty($postData['password'])) {
                $error[] = "Les mots de passe ne correspondent pas.";
            }
        }
        else
        {
            $error[] = "Merci de bien vouloir remplir tout les champs";
        }

        return $error;
    }


    /**
     * Checks if user exists
     * Compares the password entered by the user in the form and the password in the database
     */
    public function connexionAction(){

        if (array_key_exists('login',SRequest::getInstance()->post()) && !empty(SRequest::getInstance()->post('login')))
        {
            try {
                $manager = new UserManager();
                $user = $manager->getUserByLogin(SRequest::getInstance()->post('login'));

            }
            catch (\Exception $e)
            {
                echo 'Message d\'erreur : ' . $e->getMessage();
            }


            if ($user !== false && password_verify(SRequest::getInstance()->post('psw'),$user->getPassword()))
            {
                $_SESSION['token'] = $user;
                $_SESSION['user'] = $user;

                return $this->render($this->getController(),'profile', []);
            }
            else
            {
                $_SESSION['msg']['error'] = 'Login ou mot de passe incorrect';
                return $this->render($this->getController(),'default', []);
            }
        }
        else
        {
            $_SESSION['msg']['error'] = 'Veuillez entrer un login';
            return $this->render($this->getController(),'default', []);
        }
    }


    /**
     *  Adds the new user in the database
     *  1- Validates the form sent by the user
     *  2- if the form is valid -> the new user is added to the database
     *     if the form is not valid -> the user is redirected to the register page
     */
    public function newUserAction()
    {
        if (SRequest::getInstance()->post() )
        {
            $error = $this->registerValidation(SRequest::getInstance()->post());

            if (empty($error))
            {
                try {
                    $manager = new UserManager();

                    if ($manager->addUser(SRequest::getInstance()->post()))
                    {
                        $_SESSION['msg']['succes'] = 'Votre profil a été enregistré avec succès!';
                        // renvoi sur la page du login ou sur profile? si profile, faire login auto
                        return $this->render($this->getController(),'login', []);
                    }
                } catch (\Exception $e) {
                    echo 'Une erreur s\'est produite: ' . $e->getMessage(); // echo pour le moment mais il faudra le gerer comme il faut plus tard
                }
            }
            else
            {
                return $this->render($this->getController(),'register', []);
            }
        }
        else
        {
            return $this->render($this->getController(),'register', []);
        }
    }


    /**
     * User authentification
     * @return bool
     */
    public function isAuth()
    {
        if (array_key_exists('token', $_SESSION) && $_SESSION['token'] !== NULL)
        {
            return true;
        }

        return false;
    }


    /**
     * User logout
     */
    public function logoutAction()
    {
        session_unset();
        session_destroy();
        $this->render($this->getController(),'default', []);
    }




// A terminer (ci-dessous)

    /**
     *
     */
    public function UpdateAction()
    {
        $this->render($this->getController(),'update', []);
    }

    /**
     *
     */
    public function deleteUser()
    {

    }

} // End of class

