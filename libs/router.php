<?php

  /*
    This class will handle the routing of the web application, 
    switching between controllers, allowing views ("login", "dashboard" or "error" 
    if none or an invalid controller is set), or executing controller actions.
  */

  class Router {

    function __construct()
    {
      $url = isset($_GET['url']) ? $_GET['url'] : null;
      $url = rtrim($url, '/');
      $url = explode('/', $url);

      if (empty($url[0])){
        $controller = new Controller();
        
        if (SessionHelper::activeSession()) {
          $controller->view->render('dashboard');
        } else {
          $controller->view->render('login');
        }
      } else {

        $controllerFile = CONTROLLERS . $url[0] . '.php';

        if(!file_exists($controllerFile)){
          $controller = new Controller();
          $controller->view->render('error');
        } else {
          require_once $controllerFile;

          $className = $url[0] . "Controller";
          $controller = new $className;
          $controller->loadModel($url[0]);

          $action;
          if(isset($url[1])){
            $action = $url[1];
          } else {
            if ($url[0] == "login"){
              $action = "goToLogin";
            } else if ($url[0] == "employee"){
              $action = "showEmployees";
            }
          }

          if (method_exists($controller, $action)) {
            $controller->{$action}();
          }
        }
      }
    }

    // function __construct()
    // {
    //   if (!isset($_GET["controller"])){
    //     $controller = new Controller();     // parent class (generic Controller)
    //     if (SessionHelper::activeSession()) {
    //       $controller->view->render('dashboard');
    //     } else {
    //       $controller->view->render('login');
    //     }
    //   } else {
    //     $controllerName = $_GET["controller"];
    //     if (!file_exists(CONTROLLERS . $controllerName . ".php")) {
    //       $controller = new Controller();
    //       $controller->view->render('error');
    //     } else {
    //       include(CONTROLLERS . $controllerName . ".php");
    //       $className = $controllerName . "Controller";
    //       $controller = new $className;
    //       $controller->loadModel($controllerName);

    //       $action;
    //       if (isset($_REQUEST["action"])) {
    //         $action = $_REQUEST["action"];
    //       } else {
    //         if ($controllerName == "login"){
    //           $action = "goToLogin";
    //         } else if ($controllerName == "employee"){
    //           $action = "showEmployees";
    //         }
    //       }

    //       if (method_exists($controller, $action)) {
    //         $controller->{$action}();
    //       }
    //     }
    //   }
    // }

  }