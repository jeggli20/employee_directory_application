<?php
declare(strict_types=1);

class Employee extends DatabaseObject {
    protected static $table = "employees";
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $birthday;
    public $phone_number;
    public $job_id;
    public $supervisor_id;
    public $date_started;
    public $time_employed_days;
    public $username;
    protected $hashed_password;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? "";
        $this->first_name = $args["first_name"] ?? "";
        $this->last_name = $args["last_name"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->birthday = $args["birthday"] ?? "";
        $this->phone_number = $args["phone_number"] ?? "";
        $this->job_id = $args["job_id"] ?? "";
        $this->supervisor_id = $args["supervisor_id"] ?? "";
        $this->date_started = $args["date_started"] ?? "";
        $this->time_employed_days = $args["time_employed_days"] ?? "";
        $this->hashed_password = $args["hashed_password"] ?? "";
        $this->username = $args["username"] ?? "";
    }

    public function full_name(): string {
        if(!$this->first_name || !$this->last_name) {
            exit("Error: User data invalid");
        }
        
        $full_name = $this->first_name . " " . $this->last_name;
        return $full_name;
    }

    public static function select_by_username(string $username): ?object {
        $sql = "SELECT * FROM " . self::$table . " ";
        $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
        $result = self::sql_object_array($sql);
        if(!empty($result)) {
            return array_shift($result);
        } else {
            return NULL;
        }
    }

    public static function select_by_id(string $id): object {
        $sql = "SELECT * FROM " . self::$table . " ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
        $result = self::sql_object_array($sql);
        return array_shift($result);
    }

    public function id_to_string(string $id_type): string {
        if($id_type === "job") {
            $sql = "SELECT job_title FROM jobs ";
            $sql .= "WHERE id=" . $this->job_id;
            $result = self::sql_assoc_array($sql);
            return array_shift($result)["job_title"];
        } elseif($id_type === "supervisor") {
            if($this->supervisor_id === NULL) {
                return "N/A";
            }
            $supervisor = $this->select_by_id($this->supervisor_id);
            return $supervisor->full_name();
        } else {
            exit("Database query failed");
        }
    }
}
?>