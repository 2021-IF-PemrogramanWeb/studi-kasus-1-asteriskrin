<?php
    class InterlockDis {
        public $u_id;
        public $i_id;
        public $u_name;

        function __construct($i_id, $u_id, $u_name) {
            $this->i_id = $i_id;
            $this->u_id = $u_id;
            $this->u_name = $u_name;
        }

        public static function getDisses($interlockid) {
            include 'action/conn.php';
            $query = "SELECT u.u_name, u.u_id FROM users u, interlocks_dis i WHERE u.u_id = i.u_id AND i.i_id = ".$interlockid;
            $result = $conn->query($query);
            $res = [];
            while ($data = $result->fetch_row()) {
                array_push($res, new InterlockDis($interlockid, $data[1], $data[0]));
            }
            $conn->close();
            return $res;
        }
    }