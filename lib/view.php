<?php

  class View {
    
    function __construct()
    {
      
    }

    public function render(string $viewName)
    {
      require VIEW . $viewName . '.php';
    }

  }