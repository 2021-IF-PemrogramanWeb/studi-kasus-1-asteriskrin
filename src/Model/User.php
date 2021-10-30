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
    }
?>