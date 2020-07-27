<!-- TODO If you are going to add the extra feature implement here the image selection as a gallery or whatever you like -->

<?php
session_start();

if (isset($_SESSION['userName'])) {

    if (time() - $_SESSION['time'] > $_SESSION['lifeTime']) {
        // logout();
        session_destroy();
        //unset session variables
        unset($_SESSION['userName']);
        unset($_SESSION['password']);
        //And redirect to index.php (only for other pages)
        header('Location: ../index.php');
    }
    echo "We are inside session";
} else {
    header('Location: ../index.php');
}
