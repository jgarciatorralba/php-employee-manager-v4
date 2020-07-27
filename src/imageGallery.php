<!-- TODO If you are going to add the extra feature implement here the image selection as a gallery or whatever you like -->

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