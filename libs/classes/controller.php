<?php

  class Controller {

    public function __construct()
    {
      $this->view = new View();
    }

    public function loadModel($model)
    {
      $url = MODELS . $model . '.php';

      if(file_exists($url)){
        require $url;

        $modelName = ucfirst($model) . 'Model';
        $this->model = new $modelName;
      }
    }

  }