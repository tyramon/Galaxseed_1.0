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
                $error[] = "Ce pseudo n'est pas valide.";
            } elseif ($loginAvailable == false) {
                $error[] = "L'identifiant est déjà utilisé.";
            }

            // lastname validation
            if (!preg_match('/^[a-zA-Z_]+$/', $postData['lastname'])){
                $error[] = "Le format du nom n'est pas un format valide";
            }

            // firstname validation
            if (!preg_match('/^[a-zA-Z_]+$/', $postData['firstname'])) {
                $error[] = "Le format du prénom n'est pas un format valide";
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
     * Checks if the login exists in the database and if the passwords match
     * returns true if the login is good / false if it's not
     * @return bool
     */
    public function validateLogin() : bool
    {
        $manager = new UserManager();

        if ($manager->loginIsAvailable(SRequest::getInstance()->post('login')))
        {
            return false;
        }
        else
        {
            $user = $manager->getUserByLogin(SRequest::getInstance()->post('login'));
            if (password_verify(SRequest::getInstance()->post('psw'),$user->getPassword()))
            {
                return true;
            }
        }

        return false;
    }


    /**
     * Checks if user exists
     * Compares the password entered by the user in the form and the password in the database
     */
    public function connexionAction(){

        if (!empty(SRequest::getInstance()->post('login')) && !empty(SRequest::getInstance()->post('psw')))
        {
            if($this->validateLogin())
            {
                try {
                    $manager = new UserManager();
                    $user = $manager->getUserByLogin(SRequest::getInstance()->post('login'));

                    $_SESSION['token'] = $user;
                    $_SESSION['user'] = $user;

                    $errorMessage = 'Bienvenue ' . $user->getFirstname();
                    $errorClass = 'valid-input';

                    return $this->render($this->getController(),'profile', [
                        'errorMessage' => $errorMessage,
                        'errorClass' => $errorClass
                    ]);

                }
                catch (\Exception $e)
                {
                    $eMessage = 'Message d\'erreur : ' . $e->getMessage();
                    return $this->render('error','404', ['eMessage' => $eMessage]);             // Faire un controller pour les exceptions qui renvoit a une page 404 ou autre
                }
            }
            else
            {
                $errorMessage = 'Login ou mot de passe incorrect';
                $errorClass = 'invalid-input';

                return $this->render($this->getController(),'default', [
                    'errorMessage' => $errorMessage,
                    'errorClass' => $errorClass,
                ]);
            }
        }
        else
        {
            $errorMessage = 'Veuillez entrer un login';
            $errorClass = 'invalid-input';

            return $this->render($this->getController(),'default', [
                'errorMessage' => $errorMessage,
                'errorClass' => $errorClass
            ]);
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
                        $errorMessage = 'Votre profil a été enregistré avec succès!';
                        $errorClass = 'valid-input';
                        return $this->render($this->getController(),'default', [
                            'errorMessage' => $errorMessage,
                            'errorClass' => $errorClass
                        ]);
                    }
                } catch (\Exception $e) {
                    echo 'Une erreur s\'est produite: ' . $e->getMessage(); // echo pour le moment mais il faudra le gerer comme il faut plus tard
                }
            }
            else
            {
                return $this->render($this->getController(),'register', [
                    'user' =>SRequest::getInstance()->post(),
                    'errorMessage' => $error,
                    'errorClass' => 'invalid-input'
                    ]);
            }
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

