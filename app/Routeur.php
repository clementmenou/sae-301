<?php

class Router
{
    private $routes = [];

    public function get($path, $controller)
    {
        $this->routes['GET'][$path] = $controller;
    }

    public function processRequest()
    {
        $path = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$method][$path])) {
            // Split controller and method
            list($controller, $methodName) = explode('->', $this->routes[$method][$path]);

            // Instanciez le contrôleur
            $controller = new $controller();

            // Appelez la méthode
            $controller->$methodName();
        } else {
            // Gestion de la page non trouvée
            header('HTTP/1.1 404 Not Found');
            echo '404 Not Found';
            echo $path;
        }
    }
}
