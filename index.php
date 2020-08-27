<?php
    // Require constants to use in file paths and database connections.
    require_once "config/config.php";
    require_once "config/db.php";

    // Require auxiliar file to check session timeout.
    require_once LIB."sessionHelper.php";
    SessionHelper::checkActiveSession();

    // Require MVC pattern master classes.
    require_once LIB."model.php";
    require_once LIB."view.php";
    require_once LIB."controller.php";

    // Instantiate new "App" object to handle the web application.
    require_once LIB."app.php";
    $app = new App();
