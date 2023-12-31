<?php

namespace App;

// Router
use App\Router;

class Application
{
    private $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->configureGetRoutes();
        $this->configurePostRoutes();
    }

    public function run()
    {
        $this->router->processRequest();
    }

    private function configureGetRoutes()
    {
        // Routes corresponding to Controller methods
        $this->router->get('/', 'ControllerPage->home');
        $this->router->get('/regardez_nos_produits', 'ControllerPage->product_list');
        $this->router->get('/connectez_vous', 'ControllerPage->login');
        $this->router->get('/inscrivez_vous', 'ControllerPage->signup');
    }

    private function configurePostRoutes()
    {
        // Routes corresponding to Controller methods
        $this->router->post('/', 'ControllerPage->home');
        $this->router->post('/connectez_vous', 'ControllerPage->login');
        $this->router->post('/inscrivez_vous', 'ControllerPage->signup');
        $this->router->post('/deconnexion', 'ControllerUser->logout');
    }
}
