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

        /*
            Create data.
            @param $data Array of data value (map)
        */
        public static function create($data) {
            $key_last = array_key_last($data);
            // Construct query
            $query = "INSERT INTO ".static::$table." (";
            foreach ($data as $key => $value) {
                $query .= $key;
                if ($key_last != $key) $query .= ", ";
            }
            $query .= ") VALUES (";
            foreach ($data as $key => $value) {
                $query .= $value;
                if ($key_last != $key) $query .= ", ";
            }
            $query .= ")";
            
            $db = new DB();
            $instance = NULL;
            if ($db->query($query)) {
                if (!is_null(static::$primary_key)) {
                    $data[static::$primary_key] = $db->lastInsertID();
                }
                $instance = new static($data);
            }
            $db->disconnect();
            return $instance;
        }
    }
?>