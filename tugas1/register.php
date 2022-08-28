<?php
require "..\\php\\auth.php";

if (Auth::isAuthenticate(false)) {
    header("Location: ./");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <script src="../assets/bootstrap.min.js" defer></script>

    <title>Register</title>

    <link rel="stylesheet" href="styles/login.css">
    <script src="scripts/login.js" defer></script>

</head>
<body class="d-flex vh-100 align-items-center justify-content-center">
    <div class="container-fluid">
        <div class="form-container content d-flex flex-column col-5 mx-auto justify-content-center align-items-center border border-4 rounded-2 border-dark border-opacity-75 p-4">
            <h1 class="text-center md-4">Sign Up</h1>
            <hr class="border-dark w-75 mb-5">
            <form class="w-100" id="form" action="api/register.php" method="POST">
                <div class="mb-3">
                    <label for="username-input" class="form-label fs-5">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><span class="fas fa-at p-2"></span></span>
                        <input name="username" autocomplete="off" required type="text" class="form-control p-2" id="username-input" placeholder="Your Username">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email-input" class="form-label fs-5">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><span class="fas fa-envelope p-2"></span></span>
                        <input name="email" required type="email" class="form-control p-2" id="email-input" aria-describedby="emailHelp" placeholder="Your Email">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password-input" class="form-label fs-5">Password</label>
                    <div class="input-group">
                        <input name="password" required type="password" class="form-control p-2" id="password-input" placeholder="Enter your password">
                        <span class="input-group-text"><i class="fas fa-lock p-2"></i></span>
                    </div>
                </div>
                <div class="w-100 d-flex justify-content-center align-items-center mt-5 flex-column">
                    <button type="submit" class="btn btn-primary m-0">Sign Up</button>
                    <a href="login.php" class="link mt-3 fw-normal fs-6">Have an account?</a>
                </div>
            </form>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="auth-error-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger bg-opacity-50">
            <div class="rounded me-2 fas fa-warning text-danger"></div>
            <strong class="me-auto text-dark">Authentication Error</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body bg-danger bg-opacity-25">
            <?php if (isset($_GET["error"])) {
                echo $_GET["error"];
            } ?>
            </div>
        </div>
    </div>
</body>
</html>