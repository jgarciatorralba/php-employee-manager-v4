<?php

  class Controller {

    public function __construct()
    {
      $this->view = new View();
    }

    public function loadModel($model)
    {
      $url = MODEL . $model . '.php';
      // echo $url;

      if(file_exists($url)){
        require $url;

        $modelName = ucfirst($model) . 'Model';
        // echo $modelName;
        $this->model = new $modelName;
      }
    }

  }