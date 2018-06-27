<?php
/**
 * Created by PhpStorm.
 * UserManager: webuser1801
 * Date: 16/05/2018
 * Time: 09:47
 */

declare(strict_types=1);
error_reporting( E_ALL & ~E_NOTICE ); // Sets which PHP errors are reported (http://php.net/manual/fr/function.error-reporting.php)
define( 'DEBUG', true );


/**
 * --------------------------------------------------
 * DATABASE  (needs to be in a separate file)
 * --------------------------------------------------
 */

CONST DBUSER = 'root';
CONST DBNAME = 'galaxseed';
CONST DBHOST = 'localhost';
CONST DBPSW = '';


/**
 * --------------------------------------------------
 * CORE PREDEFINED CONSTANTS
 * http://php.net/manual/fr/reserved.constants.php
 * --------------------------------------------------
 */
if( strtoupper( substr( PHP_OS, 0, 3 ) )=='WIN' ) : // If the version of the operating system (provided by the pre-defined constants PHP_OS) corresponds to a Windows kernel,
    if( !defined( 'PHP_EOL') ) :
        define( 'PHP_EOL', "\r\n" );
    endif;

    if( !defined( 'DIRECTORY_SEPARATOR') ) :
        define( 'DIRECTORY_SEPARATOR', "\\" );
    endif;
else :
    if( !defined( 'PHP_EOL') ) :
        define( 'PHP_EOL', "\n" );
    endif;

    if( !defined( 'DIRECTORY_SEPARATOR') ) :
        define( 'DIRECTORY_SEPARATOR', "/" );
    endif;
endif;

if( !defined( 'DS' ) )
    define( 'DS', DIRECTORY_SEPARATOR ); // Defines the folders separator according to the system




/**
 * --------------------------------------------------
 * PATHS TO FOLDERS
 * --------------------------------------------------
 */

if( !defined( 'ABS_PATH' ) ){
    define( 'ABS_PATH', __DIR__ . DS ); // Absolute path to the root folder
}

if( !defined( 'APP_PATH' ) ){
    define( 'APP_PATH', ABS_PATH . 'dndcompany\galaxseed'.DS ); // Path with the project name
}

if( !defined( 'CONTROLLER_PATH' ) ){
    define('CONTROLLER_PATH','dndcompany\galaxseed\controller' .DS); // Absolute path to the root folder
}

// define ('VIEW_FOLDER', dirname(__FILE__).'/home/' );




