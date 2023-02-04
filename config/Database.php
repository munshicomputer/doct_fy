<?php
    class Database{
        //DB Prams 
        // private $dbhost = "localhost";
        // private $dbname = "id18993365_doctorratingapp";
        // private $dbuser = "id18993365_munshisoft";
        // private $dbpass = "0!8%$=2cY2N=dBTZ";
        // private $conn;

        private $dbhost = "localhost";
        private $dbname = "id18993365_doctorratingapp";
        private $dbuser = "root";
        private $dbpass = "";
        private $conn;

        //DB Connect
        public function connect()
        {
            # code...
            $this->conn = null;

            try{
                $this->conn = new PDO('mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname, $this->dbuser, $this->dbpass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo 'Connection Error : ' . $e->getMessage();
            }

            return $this->conn;
        }
    }
?>