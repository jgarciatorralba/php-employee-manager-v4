<?php

session_start();

if (isset($_SESSION['username'])) {
    header('Location: src/dashboard.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/favicon.png" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Log in</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include('assets/headerLogin.html') ?>

    <div class="container-sm m-auto">
        <form class="form-signin text-center" action="src/library/loginController.php" method="post">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="inputName" class="sr-only">Username</label>
            <input type="text" id="inputName" class="form-control" name="username" placeholder="Username" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control mb-3" name="password" placeholder="Password" required>
            <?php
            if (isset($_GET['error'])) {
            ?>
                <div class="alert alert-danger" role="alert">Bad username or password</div>
            <?php
            }
            ?>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </div>

    <?php include('assets/footer.html') ?>

    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>