<?php

  class View {
    
    function __construct()
    {
      
    }

    public function render(string $viewName)
    {
      require VIEWS . $viewName . '.php';
    }

  }