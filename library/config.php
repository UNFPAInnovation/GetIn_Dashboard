<?php

//only one connection is allowed
class Database {

    private $connection;
    //store a single instance
    private static $_instance;

    //get an instance for the database and return database
    //if the instance doesnt exist create it using self
    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    //constructor
    public function __construct() {
//        $this->connection = new mysqli('localhost', 'royalpla_uce_use', 'royalpla123', 'royalpla_uce');
        $this->connection = new mysqli('localhost', 'root', 'root@1', 'root');
        if (mysqli_connect_error()) {
            trigger_error("Failed to connect to MySQL: " . mysqli_error(), E_USER_ERROR);
        }
    }

    //this method is intended to avoid duplication
    private function __clone() {
        
    }

    public function getConnection() {
        return $this->connection;
    }

}

$db = Database::getInstance();
$mysqli = $db->getConnection();

//include 'functions.php';
include 'crypt.php';
?>
