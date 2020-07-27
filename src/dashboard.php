<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../node_modules/jsgrid/dist/jsgrid.min.css">
    <link type="text/css" rel="stylesheet" href="../node_modules/jsgrid/dist/jsgrid-theme.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <title>Dashboard</title>
</head>

<?php
session_start();

if(isset($_POST['userName']) && isset($_POST['password'])){
    $_SESSION['userName'] = $_POST['userName'];
    $_SESSION['password'] = $_POST['password'];
    unset($_POST['userName']);
    unset($_POST['password']);
}

if(isset($_SESSION['userName'])) {

    // if(time() - $_SESSION['time'] > $_SESSION['lifeTime']) {
    //     // logout();
    //     session_destroy();
    //     //unset session variables
    //     unset($_SESSION['userName']);
    //     unset($_SESSION['password']);
    //     unset($_SESSION['user_id']);
    //     //And redirect to index.php (only for other pages)
    //     header('Location: ../index.php');
    // }
    echo "We are inside session";
}
else{
    header('Location: ../index.php');
}

?>

<body>
    <div id="jsGrid"></div>

    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../node_modules/jsgrid/dist/jsgrid.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>