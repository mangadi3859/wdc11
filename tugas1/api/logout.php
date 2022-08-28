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

if (Auth::isAuthenticate(true)) {
    header("Location: ../");
    exit();
}

$token = Auth::getCookie();
Auth::deleteSession($token);

header("Location: ../");
