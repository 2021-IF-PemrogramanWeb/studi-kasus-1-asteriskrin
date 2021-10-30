<?php
    namespace Garnet\App\Model;
    class Interlock extends Model {
        protected static $primary_key = "i_id";
        protected static $table = "interlocks";
        protected static $selectable = [
            "i_id",
            "i_timeon",
            "i_timeoff",
            "i_ack",
            "i_reasonid"
        ];
        public static function getReason($id) {
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
        public function ack_user() {
            $user = User::find($this->i_ack);
            return $user;
        }
        public function disses() {
            $interlock_disses = InterlockDis::select(["u_id"], [
                ["i_id", "=", $this->i_id]
            ]);
            return $interlock_disses;
        }
        public static function countReason($reasonid) {
            $interlocks = Interlock::select(["COUNT(i_id) as count"], [
                ["i_reasonid", "=", $reasonid]
            ]);
            return $interlocks[0]->count;
        }
        public static function getReasonStats() {
            $data = [];
            for ($rid = 1; $rid <= 16; $rid++) {
                array_push($data, self::countReason($rid));
            }
            return $data;
        }
    }
?>