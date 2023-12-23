<?php
require_once './app/Routeur.php';
require_once './app/controller/ControllerPage.php';

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
        session_start();
        $this->router->processRequest();
    }

    private function configureRoutes()
    {
        // Routes corresponding to Controller methods
        $this->router->get('/', 'ControllerPage->home');
        $this->router->get('/regardez_nos_produits', 'ControllerPage->products');
        $this->router->get('/connectez_vous', 'ControllerPage->login');
        $this->router->post('/connectez_vous', 'ControllerPage->login');
        $this->router->get('/inscrivez_vous', 'ControllerPage->signup');
        $this->router->post('/inscrivez_vous', 'ControllerPage->signup');
    }
}
