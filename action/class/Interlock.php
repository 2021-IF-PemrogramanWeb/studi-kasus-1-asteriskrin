<?php
    class Interlock {
        public function getReason($id) {
            $reason = "Unknown";
            switch ($id) {
                case 1: $reason = "Interlock Hose Reel Front"; break;
                case 2: $reason = "Interlock Hose Reel Rear"; break;
                case 3: $reason = "Interlock Input Coupler Stow"; break;
                case 4: $reason = "Interlock Input Hose Boom Stow"; break;
                case 5: $reason = "Interlock Platform Stow"; break;
                case 6: $reason = "Interlock Platform Nozzle Left"; break;
                case 7: $reason = "Interlock Platform Nozzle Right"; break;
                case 8: $reason = "Interlock Boom Stow"; break;
                case 9: $reason = "Interlock Bonding Static Reel Front"; break;
                case 10: $reason = "Interlock Bonding Static Reel Rear"; break;
                case 11: $reason = "Interlock Bottom Loading"; break;
                case 12: $reason = "Interlock Handrail"; break;
                case 13: $reason = "PTO"; break;
                case 14: $reason = "Preventive Maintenance"; break;
                case 15: $reason = "Interlock System Fault"; break;
                case 16: $reason = "Breakdown"; break;
            }
            return $reason;
        }
        public function getData() {
            include 'action/conn.php';
            $query = "SELECT i.i_id, i.i_timeon, i.i_timeoff, u.u_name, i.i_reasonid FROM interlocks i, users u WHERE i.i_ack = u.u_id";
    
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                // output data of each row
                $data = [];
                while($row = $result->fetch_assoc()) {
                    array_push($data, $row);
                }
            }
            $conn->close();
            return $data;
        }
        public function countReason($reasonid) {
            include 'action/conn.php';
            $query = "SELECT COUNT(i_id) FROM interlocks WHERE i_reasonid = ".$reasonid;
            $result = $conn->query($query);
            $data = $result->fetch_row();
            $conn->close();
            return $data[0];
        }
        public function getReasonStats() {
            $data = [];
            for ($rid = 1; $rid <= 16; $rid++) {
                array_push($data, $this->countReason($rid));
            }
            return $data;
        }
    }
?>