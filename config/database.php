<?php
require_once 'dbCredentials.php';

// Initializing a database connection
    class Database {
        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",DB_USER,DB_PWD);

            }
            catch(PDOException $exception){
                echo "Database could not be connect: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }
