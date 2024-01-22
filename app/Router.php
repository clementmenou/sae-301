<?php

namespace App;

use App\Controller\ControllerGlobal;
use App\Controller\ControllerPage;

class Router
{
    private $routes = [];

    public function get($path, $controller)
    {
        $this->routes['GET'][$path] = $controller;
    }

    public function post($path, $controller)
    {
        $this->routes['POST'][$path] = $controller;
    }

    public function processRequest()
    {
        $path = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        $controllerGlobal = new ControllerGlobal();
        $controllerGlobal->initializeTheme();

        if (isset($this->routes[$method][$path])) {
            // Split controller and method
            list($controllerClass, $methodName) = explode('->', $this->routes[$method][$path]);
            $controllerClass = 'App\\Controller\\' . $controllerClass;
            
            $controller = new $controllerClass();
            $controller->$methodName();
        } else {
            // If page not found
            $controller = new ControllerPage();
            $controller->error404();
        }
    }
}
