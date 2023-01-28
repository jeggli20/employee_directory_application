<?php
declare(strict_types=1);

class DatabaseObject {
    protected static $database;
    protected static $table = "";

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
}
?>