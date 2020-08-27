<?php
    // Require constants to use in file paths and database connections.
    require_once "config/config.php";
    require_once "config/db.php";

    // Require auxiliar file to check session timeout.
    session_start();
    require_once LIBS."sessionHelper.php";
    SessionHelper::checkTimeout();

    // Require auxiliar file to manage the database connection.
    require_once LIBS."database.php";

    // Require MVC pattern master classes.
    require_once LIBS."model.php";
    require_once LIBS."view.php";
    require_once LIBS."controller.php";

    // Instantiate new "App" object to handle the web application.
    require_once LIBS."app.php";
    $app = new App();
