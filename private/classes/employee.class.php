<?php
declare(strict_types=1);

class Employee extends DatabaseObject {
    protected static $table = "employees";
    protected static $columns = ["id", "first_name", "last_name", "username", "hashed_password", "email", "birthday", "phone_number", "job_id", "supervisor_id", "date_started", "time_employed_days"];

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
    public $password;
    public $c_password;
    protected $hashed_password;

    private $password_required = true;

    public function __construct($args = []) {
        $this->first_name = $args["first_name"] ?? "";
        $this->last_name = $args["last_name"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->birthday = $args["birthday"] ?? "";
        $this->phone_number = $args["phone_number"] ?? "";
        $this->job_id = $args["job_id"] ?? "";
        $this->supervisor_id = $args["supervisor_id"] ?? "";
        $this->date_started = $args["date_started"] ?? "";
        $this->time_employed_days = $args["time_employed_days"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->c_password = $args["c_password"] ?? "";
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

    public function verify_password(string $password): bool {
        return password_verify($password, $this->hashed_password);
    }

    protected function set_hashed_password() {
        $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
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

    public function phone_number_formatter(): array {
        $exclusions = ["(", ")", "-", " "];
        $numbers = str_replace($exclusions, "", $this->phone_number); 
        $set1 = substr($numbers, 0, 3);
        $set2 = substr($numbers, 3, 3);
        $set3 = substr($numbers, 6);
        $display = "({$set1}) {$set2} - {$set3}";
        return ["numbers" => $numbers, "display" => $display];
    }

    protected function date_array(string $date): array {
        //$date is of the format YYYY-MM-DD
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);
        $date = "{$year}-{$month}-{$day}";
        return ["year"=>$year, "month"=>$month, "day"=>$day, "date"=>$date];
    }

    private function days_worked(): ?string {
        if($this->date_started){
            $now = time();
            $your_date = strtotime($this->date_started);
            $datediff = $now - $your_date;
    
            return (string) floor($datediff / (60 * 60 * 24));
        } else {
            return NULL;
        }
    }

    public function date_formatter(string $option): string {
        if($option === "time_employed") {
            if($this->time_employed_days === NULL) {
                return "N/A";
            }
            $time_employed = $this->time_employed_days;
            $years = floor($time_employed / 365);
            $months = floor(($time_employed % 365) / 12);
            $days = (($time_employed % 365) % 12) + 1;
            return "{$years} years {$months} months {$days} days";
        } elseif ($option === "birthday") {
            if($this->birthday === NULL) {
                return "N/A";
            }
            $date_object = date_create($this->birthday);
            return date_format($date_object, "M j");
        } elseif ($option === "date_started") {
            if($this->date_started === NULL) {
                return "N/A";
            }
            $date_object = date_create($this->date_started);
            return date_format($date_object, "M j, Y");
        }
    }

    protected function validate() {
        $this->errors = [];

        if(is_blank($this->first_name)) {
            $this->errors["first_name"] = "First name cannot be blank";
        } elseif(has_length_greater_than($this->first_name, 255)) {
            $this->errors["first_name"] = "First name cannot exceed 255 characters";
        }

        if(is_blank($this->last_name)) {
            $this->errors["last_name"] = "Last name cannot be blank";
        } elseif(has_length_greater_than($this->last_name, 255)) {
            $this->errors["last_name"] = "Last name cannot exceed 255 characters";
        }

        if(is_blank($this->username)) {
            $this->errors["username"] = "Username cannot be blank";
        } elseif(has_length_greater_than($this->username, 255)) {
            $this->errors["username"] = "Username cannot exceed 255 characters";
        } elseif(!has_unique_username($this->username, $this->id ?? "0")) {
            $this->errors["username"] = "Username already taken";
        }

        if($this->password_required) {
            if(is_blank($this->password)) {
                $this->errors["password"] = "Password cannot be blank";
            } elseif(!has_length($this->password, ["min"=>12])) {
                $this->errors["password"] = "Password must be at least 12 characters long";
            } elseif (!preg_match('/[A-Z]/', $this->password)) {
                $this->errors["password"] = "Password must contain at least 1 uppercase letter";
            } elseif (!preg_match('/[a-z]/', $this->password)) {
                $this->errors["password"] = "Password must contain at least 1 lowercase letter";
            } elseif (!preg_match('/[0-9]/', $this->password)) {
                $this->errors["password"] = "Password must contain at least 1 number";
            } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
                $this->errors["password"] = "Password must contain at least 1 special character";
            }
    
            if(is_blank($this->c_password)) {
                $this->errors["c_password"] = "Confirm Password cannot be blank";
            } elseif($this->password !== $this->c_password) {
                $this->errors["c_password"] = "Password and Confirm Password must match";
            }
        }

        if(is_blank($this->email)) {
            $this->errors["email"] = "Email cannot be blank.";
        } elseif (has_length_greater_than($this->email, 255)) {
            $this->errors["email"] = "Last name must be less than 255 characters.";
        } elseif (!has_valid_email_format($this->email)) {
            $this->errors["email"] = "Email must be a valid format.";
        }
        
        $phone_number = $this->phone_number_formatter()["numbers"];
        if(is_blank($phone_number)) {
            $this->errors["phone_number"] = "Phone number cannot be blank";
        } elseif (!has_length_exactly($phone_number, 10)) {
            $this-> errors["phone_number"] = "Phone number should be 10 digits long (###-###-####)";
        }

        $birthday = $this->date_array($this->birthday);
        if(!is_blank($this->birthday)) {
            if(!has_valid_date($birthday)) {
                $this->errors["birthday"] = "Please enter in a valid birthday";
            }
        }

        $started = $this->date_array($this->date_started);
        if(!is_blank($this->date_started)) {
            if(!has_valid_date($started)) {
                $this->errors["date_started"] = "Please enter in a valid start date";
            }
        }
    }

    public function insert_into(): bool {
        $this->set_hashed_password();
        $this->time_employed_days = $this->days_worked();
        return parent::insert_into();
    }

    public function update(): bool {
        if($this->password !== "") {
        $this->set_hashed_password();
        } else {
        $this->password_required = false;
        }
        $this->time_employed_days = $this->days_worked();
        return parent::update();
    }
}
?>