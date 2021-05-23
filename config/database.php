<?php
require_once 'dbCredentials.php';

// Initializing a database connection
    abstract class DBASE
    {
        /**        public $conn;
         *
         * public function getConnection(){
         * $this->conn = null;
         * try{
         * $this->conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",DB_USER,DB_PWD);
         *
         * }
         * catch(PDOException $exception){
         * echo "Database could not be connect: " . $exception->getMessage();
         * }
         * return $this->conn;
         * }
         * }
         */
        protected $conn;

        public function __construct()
        {
            $this->conn = null;

            try{
            $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PWD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


        }
        catch (PDOException $exception) // error handling for issues in regards to the database itself.
        {
        echo "database could not be connected: " . $exception->getMessage();
        }
        return $this->conn;
        }
    }