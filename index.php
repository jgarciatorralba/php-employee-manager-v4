<?php
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/favicon.png" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/jsgrid/dist/jsgrid.min.css">
    <link rel="stylesheet" href="node_modules/jsgrid/dist/jsgrid-theme.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Employee Managment</title>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php
        if (!isset($_GET["controller"])){

            session_start();
            if (isset($_SESSION['username'])) {
                include(VIEW . 'dashboard.php');
            } else {
                include(VIEW . 'login.php');
            }

        } else {
            
            $controller = $_GET["controller"];
            if (file_exists(CONTROLLER . $controller)) {
                include(CONTROLLER . $controller);
            } else {
                include(VIEW . "error.php");
            }

        }
    ?>

    <?php include('assets/footer.html') ?>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/jsgrid/dist/jsgrid.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
</body>

</html>