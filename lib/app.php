<?php

  /*
    This class will handle the routing of the web application, 
    switching between controllers, allowing views ("login", "dashboard" or "error" 
    if none or an invalid controller is set), or executing controller actions.
  */

  class App {

    function __construct()
    {
      if (!isset($_GET["controller"])){
        if (SessionHelper::activeSession()) {
            include(VIEW . 'dashboard.php');
        } else {
            include(VIEW . 'login.php');
        }
      } else {
        $controllerName = $_GET["controller"];
        if (!file_exists(CONTROLLER . $controllerName . ".php")) {
          include(VIEW . "error.php");
        } else {
          include(CONTROLLER . $controllerName . ".php");
          $className = $controllerName . "Controller";
          $controller = new $className;

          $action;
          if (isset($_REQUEST["action"])) {
            $action = $_REQUEST["action"];
          } else {
            if ($controllerName == "login"){
              $action = "goToLogin";
            } else if ($controllerName == "employee"){
              $action = "showEmployees";
            }
          }

          if (method_exists($controller, $action)) {
            $controller->{$action}();
          }
        }
      }
    }

  }