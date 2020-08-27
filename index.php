<?php
    // Require constants to use in file paths and database connections.
    require_once "config/config.php";
    require_once "config/db.php";

    // Require auxiliar file to check session timeout.
    session_start();
    require_once LIB."sessionHelper.php";
    SessionHelper::checkTimeout();

    // Require auxiliar file to manage the database connection.
    require_once LIB."database.php";

    // Require MVC pattern master classes.
    require_once LIB."model.php";
    require_once LIB."view.php";
    require_once LIB."controller.php";

    // Instantiate new "App" object to handle the web application.
    require_once LIB."app.php";
    $app = new App();
