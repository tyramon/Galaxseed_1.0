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
     * return the default user view (could potentially be the index page)
     */
    public function default(){


        $this->render($this->getController(),'default', []);
    }

    /**
     * redirects user to the login page
     */
    public function login()
    {
        //require('view/login.php');
        $this->render($this->getController(),'login', []);
    }


    /**
     * Redirects user to his profile page
     */
    public function profile()
    {
        if ($this->isAuth())
        {
            // require('view/profile.php');
            $this->render($this->getController(),'profile', []);
        }
        else
        {
            // require('view/default.php');
            $this->render($this->getController(),'default', []);
        }
    }


    /**
     * Redirects user to the register page
     */
    public function register()
    {
        // require('view/register.php');
        $this->render($this->getController(),'register', []);
    }


    /**
     * Checks if the login and email address isn't already taken
     * Validates the inputs from the register form
     * returns an array with the errors
     * @return array
     */
    public function registerValidation(): array
    {
        $error = [];
        $request = SRequest::getInstance();

        if (!empty($request->post('identifiant')) &&
            !empty($request->post('nom')) &&
            !empty($request->post('prenom')) &&
            !empty($request->post('email')) &&
            !empty($request->post('passe')))
        {
            $manager = new UserManager();
            $loginTaken = $manager->loginIsAvailable();
            $emailTaken = $manager->emailIsAvailable();

            // Login validation
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $request->post('identifiant'))){
                $error[] = "Ce pseudo n\'est pas valide.";
            } elseif ($loginTaken == true) {
                $error[] = 'L\'identifiant est déjà utilisé.';
            }

            // lastname validation
            if (!preg_match('/^[a-zA-Z_]+$/', $request->post('nom'))){
                $error[] = "Le format du nom n\'est pas un format valide";
            }

            // firstname validation
            if (!preg_match('/^[a-zA-Z_]+$/', $request->post('prenom'))) {
                $error[] = "Le format du prénom n\'est pas un format valide";
            }

            // email validation
            if (!filter_var($request->post('email'), FILTER_VALIDATE_EMAIL)) {
                $error[] = "Le format de votre email est invalide";
            } elseif ($emailTaken == true) {
                $error[] = 'Cette adresse email est déjà utilisée.';
            }

            // password validation
            if ($request->post('passe') !== $request->post('confirm') || empty($request->post('passe'))) {
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
    public function connexion(){

        if (array_key_exists('login',SRequest::getInstance()->post()) && !empty(SRequest::getInstance()->post('login')))
        {
            $manager = new UserManager();

            $user = $manager->getUserByLogin(SRequest::getInstance()->post('login'));

            if ($user !== false && password_verify(SRequest::getInstance()->post('psw'),$user->getPassword()))
            {
                $_SESSION['token'] = $user;
                require('view/default.php');
                // $this->render('default', []);
            }
            else
            {
                $_SESSION['msg']['error'] = 'login/password incorrect';
                require('view/login.php');
                // $this->render('login', []);
            }
        }
        else
        {
            require('view/login.php');
            // $this->render('login', []);
        }
    }

    //      controle l'entré du formulaire en post a la création de l'utilisateur
    //      lance la query ajout database
    //      et redirige en fonction
    /**
     *  Adds the new user in the database
     *  1- Validates the form sent by the user
     *  2- if the form is valid -> the new user is added to the database
     *     if the form is not valid -> the user is redirected to the register page
     */
    public function addNewUser()
    {
        if (SRequest::getInstance()->post() )
        {
            $error= $this->registerValidation();

            if (empty($error))
            {
                $manager = new UserManager();

                if ($manager->addUser())
                {
                    $_SESSION['msg']['succes'] = 'Merci de vous etre inscrit, vous pouvez desormer vous connecter';
                    // require('view/login.php');
                    $this->render($this->getController(),'profile', []);
                }
            }
            else
            {
                // require('view/register.php');
                $this->render($this->getController(),'register', []);
            }
        }
        else
        {
            // require('view/register.php');
            $this->render($this->getController(),'register', []);
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
    public function logout()
    {
        unset($_SESSION['token']);
        $this->render($this->getController(),'default', []);
    }


// A terminer (dessous)
    
//    public function deleteUser()
//    {
//
//    }
//
//    public function UpdateUser()
//    {
//
//    }
} // End of class

