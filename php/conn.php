<?php

require_once "database.php";

$DB_SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "wdc_php";

$conn = new Database($DB_NAME, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD);

$conn->exec("CREATE DATABASE IF NOT EXISTS `$DB_NAME`");
$conn->exec("CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)");
$conn->exec("CREATE TABLE IF NOT EXISTS auth_session (
    user_id INT NOT NULL,
    token VARCHAR(255) NOT NULL UNIQUE,
    expires INT DEFAULT NULL
)");
?>
