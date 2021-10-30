<?php
    namespace Garnet\App\Model;
    class InterlockDis extends Model {
        protected static $primary_key = "i_id";
        protected static $table = "interlocks_dis";
        protected static $selectable = [
            "i_id",
            "u_id"
        ];
        public function interlock() {
            $interlock = Interlock::find($this->i_id);
            return $interlock;
        }
        public function user() {
            $user = User::find($this->u_id);
            return $user;
        }
    }
?>