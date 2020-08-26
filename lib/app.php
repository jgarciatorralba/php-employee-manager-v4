<?php

  class App {
    
    function __construct()
    {
      // echo "<p>New App</p>";

      if (!isset($_GET["controller"])){
        if (activeSession()) {
            include(VIEW . 'dashboard.php');
        } else {
            include(VIEW . 'login.php');
        }
      } else {
        $controller = $_GET["controller"];
        if (!file_exists(CONTROLLER . $controller . ".php")) {
          include(VIEW . "error.php");
        } else {
          include(CONTROLLER . $controller . ".php");
        }
      }
    }
  }