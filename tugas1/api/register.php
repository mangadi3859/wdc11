<?php
require_once "..\..\php\conn.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode([
        "code" => 405,
        "message" => "Method Not Allowed",
    ]);

    exit();
}

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

if (empty($username) || empty($email) || empty($password)) {
    header("Location: ../register.php?error=Please fill all the field.");
    exit();
}

$result = $conn->query("SELECT * FROM users WHERE username = '$username' OR email = '$email'");
$result->setFetchMode(PDO::FETCH_ASSOC);
$assoc = $result->fetchAll();

if (sizeof($assoc)) {
    if ($assoc[0]["username"] == $username) {
        header("Location: ../register.php?error=The username is already exist.");
        exit();
    }

    if ($assoc[0]["email"] == $email) {
        header("Location: ../register.php?error=The email is already being used.");
        exit();
    }
}

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$exec = $conn->exec("INSERT INTO users (username, email, password) VALUE ('$username', '$email', '$hashedPassword')");
header("Location: ../login.php");
