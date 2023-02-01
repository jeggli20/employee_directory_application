<?php
class Job extends DatabaseObject {
    protected static $table = "jobs";

    public $id;
    public $job_title;

    // public static function select_by_title(string $title): object {
    //     $sql = "SELECT * FROM " . self::$table . " ";
    //     $sql .= "WHERE job_title='" . self::$database->escape_string($title) . "'";
    //     $result = self::sql_object_array($sql);
    //     return array_shift($result);
    // } 
}
?>