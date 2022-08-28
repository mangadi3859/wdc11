<?php
require_once "..\\php\\conn.php";
require "..\\php\\auth.php";

if (!Auth::isAuthenticate(false)) {
    header("Location: login.php?error=You have to login first");
}

$user = Auth::getAuth();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <script src="../assets/bootstrap.min.js" defer></script>

    <title>Home</title> 
</head>
<body class="bg-info bg-opacity-10 d-flex justify-content-center flex-column align-items-center h-100">
    <h1 class="fw-bold">Welcome
        <span class="text-primary fw-bolder">
            <?php echo $user["username"]; ?>
        </span>
    </h1>
    <form action="api/logout.php" method="POST">
        <button class="btn btn-secondary mt-4" type="submit">LOG OUT</button>
    </form>
</body>
</html>