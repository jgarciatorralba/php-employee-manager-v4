<?php

require_once "config.php";
require_once LIB."sessionHelper.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/favicon.png" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Employee Managment</title>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php
        if(isset($_GET["logout"])) { 
            include_once CONTROLLER."login.php";
            logOut();
        }

        if (activeSession() && isset($_GET["dashboard"])) include CONTROLLER."dashboard.php";
        else if (activeSession() && isset($_GET["employee"])) include CONTROLLER."employee.php";
        else include CONTROLLER."login.php";
    ?>

    <?php include('assets/footer.html') ?>

    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>