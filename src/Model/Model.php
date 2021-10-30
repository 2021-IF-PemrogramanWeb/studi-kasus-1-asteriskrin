<?php
    namespace Garnet\App\Model;
    use DB;
    abstract class Model {
        protected static $primary_key;
        protected static $table;
        protected static $selectable;

        public function __construct($properties) {
            foreach ($properties as $key => $value) {
                $this->{$key} = $value;
            }
        }
        
        public static function find($id) {
            $db = new DB();
            $result = $db->select(static::$table, static::$selectable, [
                [static::$primary_key, "=", $id]
            ]);
            $db->disconnect();
            return new static($result[0]);
        }

        public static function select($columns, $where = []) {
            $db = new DB();
            $result = $db->select(static::$table, $columns, $where);

            $instances = [];
            foreach ($result as $r) {
                array_push($instances, new static($r));
            }

            $db->disconnect();
            return $instances;
        }

        public static function all() {
            $db = new DB();
            $result = $db->select(static::$table, static::$selectable);

            $instances = [];
            foreach ($result as $r) {
                array_push($instances, new static($r));
            }

            $db->disconnect();
            return $instances;
        }
    }
?>