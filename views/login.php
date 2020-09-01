<?php include "assets/head.html"; ?>
<body class="d-flex flex-column min-vh-100">
<?php include "assets/headerLogin.html"; ?>

<div class="container-sm m-auto">
    <!-- <form class="form-signin text-center" action="index.php?controller=login&action=validateAccess" method="post"> -->
    <form class="form-signin text-center" action="login/validateAccess" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputName" class="sr-only">Username</label>
        <input type="text" id="inputName" class="form-control" name="username" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control mb-3" name="password" placeholder="Password" required>
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">Bad username or password</div>
        <?php } ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
</div>

<?php 
    include "assets/footer.html";
    include "assets/foot.html";
?>
</body>