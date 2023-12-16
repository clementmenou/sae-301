<?php
require_once './app/Routeur.php';
require_once './app/controller/Controller.php';

class Application
{
    private $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->configureRoutes();
    }

    public function run()
    {
        $this->router->processRequest();
    }

    private function configureRoutes()
    {
        // Routes corresponding to Controller methods
        $this->router->get('/', 'Controller->home');
        $this->router->get('/product_page', 'Controller->productPage');
    }
}
