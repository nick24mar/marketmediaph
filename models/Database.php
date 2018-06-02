<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', 'mypassword');
define('DB_NAME', 'market');

class Database {

    protected $connection;

    function __construct() {
        $this->connect();
    }

    private function connect() {
        
        try {
            $this->connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {

            echo "Something went wrong.. Cause: $e";

        }
    }
}