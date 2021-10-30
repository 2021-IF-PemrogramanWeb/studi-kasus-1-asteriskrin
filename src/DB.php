<?php
    class DB {
        private static $host = "localhost";
        private static $user = "root";
        private static $pass = "";
        private static $db = "pweb1";
        private $conn;

        function __construct() {
            $this->conn = $this->connect();
        }

        /*
            Connect to DB.
        */
        private function connect() {
            // create connection
            $conn = new mysqli(self::$host, self::$user, self::$pass, self::$db);

            // check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            return $conn;
        }

        /*
            Disconnect from DB.
        */
        public function disconnect() {
            $this->conn->close();
        }

        /*
            Select function
            @param $table   Table name
            @param $data    Array of column name
        */
        public function select($table, $data, $where_clauses = []) {
            $size = count($data);

            $query = "SELECT ";
            for ($i = 0; $i < $size - 1; $i++) $query .= $data[$i].", ";
            $query .= $data[$size - 1];
            $query .= " FROM ".$table." ";

            $where_clause_size = count($where_clauses) / 3;
            if ($where_clause_size > 0) {
                $query .= "WHERE ";
                for ($i = 0; $i < $where_clause_size - 1; $i++) $query .= $where_clauses[$i][0]." ".$where_clauses[$i][1]." ".$where_clauses[$i][2]." AND ";
                $query .= $where_clauses[$where_clause_size - 1][0]." ".$where_clauses[$where_clause_size - 1][1]." ".$where_clauses[$where_clause_size - 1][2];
            }
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            $output = [];
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                array_push($output, $row);
            }
            return $output;
        }

        /*
            Raw select.
            @param $sql Query string
        */
        public function rawSelect($sql) {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $output = [];
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                array_push($output, $row);
            }
            return $output;
        }
    }
?>