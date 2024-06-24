<?php
include 'config.php';

function getConnection($dbName = DB_NAME) {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, $dbName);

    if ($conn->connect_error) {
        error_log("Database connection failed: " . $conn->connect_error);
        die("Database connection failed: " . $conn->connect_error);
    }

    return $conn;
}
