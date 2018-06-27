<?php
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 27/06/2018
 * Time: 13:50
 */

namespace dndcompany\galaxseed;


class Autoloader
{
    static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    static function autoload($className){

        $className = str_replace(__NAMESPACE__.'\\','', $className);
        $className = str_replace('\\', '/', $className);

        $class = $className . '.php';

        if(file_exists($class)){
            require($class);
        } else {
            echo 'le fichier '.$class.' n\'existe pas<br>';
        }
    }
} // End of class
