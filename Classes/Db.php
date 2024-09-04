<?php
    class Db {
        public $con;

        private $servername;
        private $username;
        private $password;
        private $dbname;


        public function con() {
            $config = require __DIR__ . '/../config.php';
            $server = $_SERVER['SERVER_NAME'];
    
            if($server == 'localhost') {
                $this->servername = $config['DB_SERVER_LOCAL'];
                $this->username = $config['DB_USER_LOCAL'];
                $this->password = $config['DB_PASS_LOCAL'];
                $this->dbname = $config['DB_NAME_LOCAL'];
            } else {
                $this->servername = $config['DB_SERVER_PROD'];
                $this->username = $config['DB_USER_PROD'];
                $this->password = $config['DB_PASS_PROD'];
                $this->dbname = $config['DB_NAME_PROD'];
            }

            $con = new mysqli(
                $this->servername, 
                $this->username, 
                $this->password, 
                $this->dbname
            );


            // Check connection
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }
            return $con;
        }
    }
?>