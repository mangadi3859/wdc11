<?php
require_once "..\\..\\php\\conn.php";
require_once "..\\..\\php\\auth.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode([
        "code" => 405,
        "message" => "Method Not Allowed",
    ]);

    exit();
}

$email = $_POST["email"];
$password = $_POST["password"];

if (empty($email) || empty($password)) {
    header("Location: ../login.php?error=Please fill all the field.");
    exit();
}

$result = $conn->query("SELECT * FROM users WHERE email = '$email'");
$result->setFetchMode(PDO::FETCH_ASSOC);
$assoc = $result->fetchAll();

if (empty($assoc)) {
    header("Location: ../login.php?error=The email is incorrect");
    exit();
}

if (!password_verify($password, $assoc[0]["password"])) {
    header("Location: ../login.php?error=Your password is incorrect");
    exit();
}

$hashed_password = $assoc[0]["password"];
$token = Auth::createSession($assoc[0]["id"], time() + 60 * 60 * 12);
// $token = Auth::createSession($assoc[0]["id"]);
Auth::setCookieSession($token, time() + 60 * 60 * 12);

header("Location: ../");
