<?php

error_reporting(0);

//session_start();
$GLOBALS['config'] = array(
    
    'mysql' => array(
         'host' => $_SERVER['DB_HOST'],
         'username' => $_SERVER['DB_USER'],
         'password' => $_SERVER['DB_PASS'],
         'db' => $_SERVER['DB_NAME']
     ),
     
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);
//require_once 'classes/config.php';
//require_once 'classes/config.php';
//require_once 'classes/config.php';
spl_autoload_register(function($class) {
    require_once 'classes/' . $class . '.php';
});  //-- To-Do (Josh) -- replace with composer to manage classes -- psr-4
require_once 'functions/functions.php';
?>
