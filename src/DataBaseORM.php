<?php
    namespace Shoyim\ORM;

    use Exception;
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

        public function getData($table, $wheres = [],$columns=[])
        {
            try {
                $sql = "SELECT " . implode(',', $columns);

                $sql .= " FROM $table WHERE ";

                foreach ($wheres as $where) {
                    $sql = $where["column"]."=".$where["value"];
                    if (isset($where["condition"])) {
                        $sql .= " ".$where["condition"]. " ";
                    }
                }

                return mysqli_query($this->conn, $sql);
            }
            catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function insert($table, $columns)
        {
            try {
                $keys = array_keys($columns);
                $values = array_values($columns);
                $sql = "INSERT INTO $table (".implode(',', $keys).") VALUES (".implode(',', $values).")";

                return mysqli_query($this->conn, $sql);
            }
            catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function update($table,$wheres = [],$columns=[])
        {
            try {
                $sql = "UPDATE $table SET ";
                foreach ($columns as $column => $value) {
                    $sql = $column."=".$value. ",";
                }
                foreach ($wheres as $where) {
                    $sql = $where["column"]."=".$where["value"];
                }
                return mysqli_query($this->conn, $sql);
            }
            catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function delete($table,$wheres = [],$columns=[]) {
            try {
                $sql = "DELETE FROM $table WHERE ";
                foreach ($wheres as $where) {
                    $sql = $where["column"]."=".$where["value"]. " " . $where["condition"]. " ";
                }
                return mysqli_query($this->conn, $sql);
            }
            catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function find($table,$id)
        {
            try {
                $sql = "SELECT * FROM $table WHERE id=".$id;
                return mysqli_query($this->conn, $sql);
            }
            catch (Exception $e) {
                echo $e->getMessage();
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