<?php
    namespace Shoyim\ORM;

    use PDO;

    abstract class DataBaseORM
    {
        private $host;
        private $user;
        private $pass;
        private $dbname;
        private $conn;

        public function __construct($host, $user, $pass, $dbname) {
            $this->host = $host;
            $this->user = $user;
            $this->pass = $pass;
            $this->dbname = $dbname;


        }
        public function connect() {
            $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);

            if (!$this->conn) {
                die("Mysql connection error: ".mysqli_connect_error());
            }
        }

        public function query($query)
        {
            return mysqli_query($this->conn, $query);
        }
        
        public function disconnect() {
            mysqli_close($this->conn);
        }
    }