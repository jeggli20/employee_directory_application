<?php
declare(strict_types=1);

function db_connect(): object {
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    confirm_connection($connection);
    return $connection;
}

function confirm_connection(object $connection) {
    if($connection->errno) {
        $msg = "Database connection failed: ";
        $msg .= $connection->error . " (";
        $msg .= $connection->errno . ")";
        exit($msg);
    }
}

function db_close(object $connection) {
    $connection->close();
}
?>