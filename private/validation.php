<?php
declare(strict_types=1);

function is_blank(?string $string): bool {
    return !isset($string) || trim($string) === "";
}

function has_length_greater_than(string $value, int $min): bool {
    $length = strlen($value);
    return $length > $min;
}

function has_length_less_than(string $value, int $max): bool {
    $length = strlen($value);
    return $length < $max;
}

function has_length_exactly(string $value, int $exact): bool {
    $length = strlen($value);
    return $length == $exact;
}

function has_length(string $value, array $options): bool {
    if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
        return false;
    } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
        return false;
    } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
        return false;
    } else {
        return true;
    }
}

function has_valid_date(array $date): bool {
    if ($date["year"] > date("Y") || $date["year"] < 1900) {
        return false;
    } elseif($date["month"] > "12" || $date["month"] < "1") {
        return false;
    } elseif($date["day"] > "31" || $date["day"] < "1") {
        return false;
    } else {
        return true;
    }
}

function has_valid_email_format(string $value): bool {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
}

function has_unique_username(string $username, string $current_id="0"): bool {
    $employee = Employee::select_by_username($username);
    if($employee === NULL || $employee->id == $current_id) {
        return true;
    } else {
        return false;
    }
}

?>