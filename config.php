<?php
/**
 * Created by PhpStorm.
 * UserManager: webuser1801
 * Date: 16/05/2018
 * Time: 09:47
 */
declare(strict_types=1);

define ('VIEW_FOLDER', dirname(__FILE__).'/view/' );

spl_autoload_register(function ($class) {

    if(strpos($class, 'dndcompany\galaxseed\\') === 0) {
        $cheminClass = substr($class, 21);
    } else {
        $cheminClass = $class;
    }

    if(file_exists($cheminClass.'.php')) {
        require_once ($cheminClass.'.php');
    } else {
        throw new \Exception('Class non trouvé : '.$class.'.php');
    }
});

//conf DB
CONST DBUSER = 'root';
CONST DBNAME = 'galaxseed';
CONST DBHOST = 'localhost';
CONST DBPSW = '';

