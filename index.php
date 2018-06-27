<?php
declare(strict_types=1);

namespace dndcompany\galaxseed;  // namespace de base du projet

use Exception;
use dndcompany\galaxseed\model\SRequest;

require ('config.php');
require ('Autoloader.php');
Autoloader::register();         // appel l'autoloader


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

    $controller = CONTROLLER_PATH . strtolower($ctrl) . '\\' . $ctrl . 'Controller';  // nom de la classe


    if( class_exists( $controller ) )
    {
        $oController = new $controller();           // si classe existe on l'instancie


        if( SRequest::getInstance()->get( 'action' )!==null )           // Si param 'action' dans le Get -> on appel la methode
        {
            $method = SRequest::getInstance()->get( 'action' ) . 'Action';     // methode a appeler
        } else {
          $method = 'defaultAction';                                      // Action par default
        }

       // var_dump($oController, $method);

        if( method_exists( $oController, $method ) )                    // on check si la methode existe dans le controller
        {
            $oController->$method();                                   // si la méthode exsiste, on l'appelle
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



