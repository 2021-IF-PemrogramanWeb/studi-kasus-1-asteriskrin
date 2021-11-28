<?php
    class CSRF {
        public static function checkSession() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        }
        public static function start() {
            self::checkSession();
            $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        }
        public static function getToken() {
            self::checkSession();
            return $_SESSION['token'];
        }
    }
?>