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

        public function filter($var)
        {
            $var = trim($var);
            $var = stripslashes($var);
            return htmlentities($var);
        }

        public function get_client_ip() {
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if(getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if(getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if(getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if(getenv('HTTP_FORWARDED'))
                $ipaddress = getenv('HTTP_FORWARDED');
            else if(getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }

        public function dd()
        {
            array_map(function($x) { var_dump($x); }, func_get_args()); die;
        }
    }