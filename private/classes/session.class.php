<?php
declare(strict_types=1);

class Session {
    private const LOGIN_MAX_DURATION = 60*60*24;
    public $username;

    private $employee_id;
    private $last_login;

    public function __construct() {
        session_start();
        $this->stored_login();
    }

    public function login(object $employee) {
        if($employee)
        {
            session_regenerate_id();
            $this->username = $_SESSION["username"] = $employee->username;
            $this->employee_id = $_SESSION["employee_id"] = $employee->id;
            $this->last_login = $_SESSION["last_login"] = time();
        }
    }

    public function logout(): bool {
        unset($_SESSION["username"]);
        unset($_SESSION["employee_id"]);
        unset($_SESSION["last_login"]);
        unset($this->username);
        unset($this->employee_id);
        unset($this->last_login);
        return true;
    }

    public function is_logged_in(): bool {
        return isset($this->employee_id) && recent_login();
    }

    private function recent_login(): bool {
        if(!isset($this->employee_id)) {
            return false;
        } elseif (($this->last_login + LOGIN_MAX_DURATION) < time()) {
            return false;
        } else {
            return true;
        }
    }

    private function stored_login() {
        if(isset($_SESSION["employee_id"])) {
            $this->username = $_SESSION["username"];
            $this->employee_id = $_SESSION["employee_id"];
            $this->last_login = $_SESSION["last_login"];
        }
    }

    public function compare_id(string $id): bool {
        return $id === (string) $this->employee_id;
    }
}
?>