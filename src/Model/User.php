<?php
    namespace Garnet\App\Model;
    class User extends Model {
        protected static $primary_key = "u_id";
        protected static $table = "users";
        protected static $selectable = [
            "u_id",
            "u_username",
            "u_password",
            "u_name"
        ];
        public static function login($username, $password) {
            $user = self::select(["u_username", "u_name"], [
                ["u_username", "=", "'".$username."'"],
                ["u_password", "=", "'".$password."'"]
            ]);
            if ($user != NULL) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user'] = $user;
            }
            return $user;
        }
    }
?>