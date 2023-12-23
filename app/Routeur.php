<?php

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

        if (isset($this->routes[$method][$path])) {
            // Split controller and method
            list($controller, $methodName) = explode('->', $this->routes[$method][$path]);

            $controller = new $controller();
            $controller->$methodName();
        } else {
            // If page not found
            $controller = new ControllerPage();
            $controller->error404();
        }
    }
}
