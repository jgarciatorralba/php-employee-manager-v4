<!DOCTYPE html>
<html lang="en">

<?php
session_start();


// if (isset($_SESSION['userName'])) {
//     header('Location: src/dashboard.php');
// }

?>

<?php include('assets/head.html') ?>

<body>
    <?php include('assets/header.html') ?>

    <div class="container">
        <form class="form-signin text-center mt-5" action="src/library/loginController.php" method="post">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="inputName" class="sr-only">Username</label>
            <input type="text" id="inputName" class="form-control" name="username" placeholder="Username" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control mb-3" name="password" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </div>

    <?php include('assets/footer.html') ?>

    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>