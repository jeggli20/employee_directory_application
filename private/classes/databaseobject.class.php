<?php
declare(strict_types=1);

class DatabaseObject {
    public $errors = [];

    protected static $database;
    protected static $table = "";
    protected static $columns = [];

    public static function setup_database(object $database) {
        self::$database = $database;
    }

    public static function select_all(): array {
        $sql = "SELECT * FROM " . static::$table;
        $result = self::sql_object_array($sql);
        return $result;
    }

    protected static function sql_assoc_array(string $sql): array {
        $result = self::$database->query($sql);
        if(!$result) {
            exit("Database query failed");
        }

        $array = [];
        while($record = $result->fetch_assoc()) {
            $array[] = $record;
        }

        return $array;
    }

    protected static function sql_object_array(string $sql): array {
        $result = self::$database->query($sql);
        if(!$result) {
            exit("Database query failed");
        }

        $object_array = [];
        while($record = $result->fetch_assoc()) {
            $object = self::instantiate($record);
            $object_array[] = $object;
        }

        return $object_array;
    }

    protected static function instantiate(array $assoc): object {
        $object = new static;
        foreach($assoc as $prop => $value) {
            if(property_exists($object, $prop)) {
                $object->$prop = $value;
            }
        }

        return $object;
    } 

    protected function attributes(): array {
        $attributes = [];
        foreach(static::$columns as $column) {
            if($column === "id") {
                continue;
            }
            if($this->$column === "") {
                $attributes[$column] = "NULL";
            } else {
                $attributes[$column] = "'" . self::$database->escape_string($this->$column) . "'";
            }
        }
        return $attributes;
    }

    protected function validate() {
        $this->errors = [];

        return $errors;
    }

    public function merge_attributes($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && $value !== NULL) {
                $this->$key = $value;
            }
        }
    }

    public function insert_into(): bool {
        $this->validate();
        if(!empty($this->errors)) {
            return false;
        }
        $attributes = $this->attributes();
        $sql = "INSERT INTO " . static::$table . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES (";
        $sql .= join(", ", array_values($attributes));
        $sql .= ")";
        $result = self::$database->query($sql);
        if($result) {
            $this->id = self::$database->insert_id;
        }
        return $result;
    }

    public function update(): bool {
        $this->validate();
        if(!empty($this->errors)) {
            return false;
        }

        $attribute_pairs = [];
        $attributes = $this->attributes();
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}={$value}";
        } 
        $sql = "UPDATE " . static::$table . " SET ";
        $sql .= join(", ", array_values($attribute_pairs)) . " ";
        $sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1";
        $result = self::$database->query($sql);
        if(!$result) {
            exit($sql);
        }
        return $result;
    }
}
?>