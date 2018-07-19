<?php
declare(strict_types=1);

namespace dndcompany\galaxseed;  // Project base namespace

use Exception;
use dndcompany\galaxseed\model\SRequest;



require ('config.php');
require ('Autoloader.php');
Autoloader::register();         // autoload
session_start();                // Start autoload after autoload to avoid having to serialize/unserialize

/**
 * --------------------------------------------------
 * ROUTER
 * --------------------------------------------------
 */


try
{
    if( SRequest::getInstance()->get('controller') !==null )            // on si on a le param 'controller' dans le get
    {
        $ctrl = ucwords( strtolower( SRequest::getInstance()->get( 'controller' ) ) ); // on met le nom du ctrler en minuscules et premiere lettre majuscule
    } else
        {
            $ctrl = 'Home';                                        // si pas de param 'controller'-> ctrler par default = Home
        }

    $controller = CONTROLLER_PATH . strtolower($ctrl) . DS . $ctrl . 'Controller';  // nom de la classe

    $controller = str_replace(DS, '\\', $controller); // conversion du chemin du fichier en namespace pour trouver le controller

    if( class_exists( $controller ) )
    {
        $oController = new $controller();           // si classe existe on l'instancie


        if( SRequest::getInstance()->get( 'action' )!==null )           // Si param 'action' dans le Get -> on appel la methode
        {
            $method = SRequest::getInstance()->get( 'action' ) . 'Action';     // methode a appeler
        } else {
          $method = 'defaultAction';                                      // Action par default
        }

        if( method_exists( $oController, $method ) )                    // on check si la methode existe dans le controller
        {

           require ('view/inc/header.php');
           // ob_start();
            $oController->$method();                                   // si la méthode exsiste, on l'appelle
           // $test = ob_end_flush();
           // var_dump($_SESSION);
           require ('view/inc/footer.php');

        } else {
            throw new \Exception("la méthode $method n'existe pas.");
        }

    } else {
        throw new \Exception("Le controlleur $controller n'existe pas.");
    }
}
catch ( Exception $e )
{
    echo $e->getMessage();  // TODO modifier le echo et le traiter correctement
}



