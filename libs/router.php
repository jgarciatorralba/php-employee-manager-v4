<?php

  /*
    This class will handle the routing of the web application, 
    switching between controllers, allowing views ("login", "dashboard" or "error" 
    if none or an invalid controller is set), or executing controller actions, 
    with or without passed parameters.
  */

  class Router {

    function __construct()
    {
      // Get parameters passed in the URL using "/"
      $url = isset($_GET['url']) ? $_GET['url'] : null;
      $url = rtrim($url, '/');
      $url = explode('/', $url);

      /*
        If no controller is passed in the URL, instantiate new generic controller 
        to render a view depending on whether or not there is an active session.
      */
      if (empty($url[0])){
        $controller = new Controller();
        
        if (SessionHelper::activeSession()) {
          $controller->view->render('dashboard');
        } else {
          $controller->view->render('login');
        }
      /*
        If a controller is passed, check if it exists.
      */
      } else {
        $controllerFile = CONTROLLERS . $url[0] . '.php';
        // If it doesn't exist, instantiate generic controller to render error view.
        if(!file_exists($controllerFile)){
          $controller = new Controller();
          $controller->view->render('error');
        // Otherwise, require controller file, then instantiate it and load model.
        } else {
          require_once $controllerFile;
          $className = $url[0] . "Controller";
          $controller = new $className;
          $controller->loadModel($url[0]);

          /*
            If an action is passed in the URL, store it in a variable. 
            Otherwise store a default action for each controller.
          */
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

          /*
            Check if the associated method exists in the given controller. 
            If additional parameters are passed in the URL, then store them in an array and call the method with the passed parameters, otherwise 
            call the method without any parameter.
          */
          if (method_exists($controller, $action)) {
            $nParam = sizeof($url);
            if ($nParam > 2){
              $param = [];
              for ($i = 2; $i<$nParam; $i++) {
                array_push($param, $url[$i]);
              }
              $controller->{$action}($param);
            } else {
              $controller->{$action}();
            }
          }
        }
      }
    }

  }