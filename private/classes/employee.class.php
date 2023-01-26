<?php
declare(strict_types=1);

class Employee extends DatabaseObject {
    protected static $table = "employees";
    public $first_name;
    public $last_name;
    public $email;
    public $birthday;
    public $phone_number;
    public $job_title;
    public $supervisor;
    public $date_started;
    public $time_employed;
    protected $hashed_password;
    protected $username;

    public function full_name(): string {
        if(!$this->first_name || !$this->last_name) {
            exit("Error: User data invalid");
        }
        
        $full_name = $this->first_name . " " . $this->last_name;
        return $full_name;
    }

    public static function select_name(string $value): array {
        $sql = "SELECT * FROM " . static::$table . " ";
        $sql .= "WHERE first_name ";
        $sql .= "LIKE '" . self::$database->escape_string($value) . "%' ";
        $sql .= "OR last_name ";
        $sql .= "LIKE '" . self::$database->escape_string($value) . "%'";
        $result = self::sql_object_array($sql);
        return $result;
    }
}
?>