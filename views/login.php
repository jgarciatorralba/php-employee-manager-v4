<?php include "assets/head.php"; ?>
<body class="d-flex flex-column min-vh-100">
    <?php include "assets/headerLogin.php"; ?>

    <div class="container-sm m-auto">
        <form class="form-signin text-center" action="<?php echo constant('URL'); ?>login/validateAccess" method="post" autocomplete="off">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="inputName" class="sr-only">Username</label>
            <input type="text" id="inputName" class="form-control" name="username" placeholder="Username" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control mb-3" name="password" placeholder="Password" required>

            <?php
            if(property_exists($this, 'message') && $this->message != "") {
                echo '<div class="error-login alert alert-danger" role="alert">';
                    echo $this->message;
                echo '</div>';
            };
            ?>
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </div>

    <?php
        include "assets/footer.php";
        include "assets/foot.php";
    ?>
    <script>
        // Animation effect for the success message on submitting form
        $('.error-login')
            .fadeIn(800)
            .delay(4000)
            .fadeOut(800);
    </script>
</body>