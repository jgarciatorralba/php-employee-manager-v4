<?php include_once('library/sessionHelper.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../node_modules/jsgrid/dist/jsgrid.min.css">
    <link rel="stylesheet" href="../node_modules/jsgrid/dist/jsgrid-theme.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Dashboard</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include('../assets/header.html') ?>

    <div class="container">
        <div id="jsGrid"></div>
    </div>

    <?php include('../assets/footer.html') ?>

    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../node_modules/jsgrid/dist/jsgrid.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>