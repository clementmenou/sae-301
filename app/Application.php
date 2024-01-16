<?php

namespace App;

// Router
use App\Router;

// Helpers
use App\Helpers\{
    RedirectHelper as Redirect
};

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
        $this->router->get(Redirect::HOME_URL, 'ControllerPage->home');
        $this->router->get(Redirect::PRODUCT_LIST_URL, 'ControllerPage->product_list');
        $this->router->get(Redirect::PRODUCT_INFO_URL, 'ControllerPage->product_info');
        $this->router->get(Redirect::MANAGE_URL, 'ControllerPage->manage');
        $this->router->get(Redirect::ORDER_URL, 'ControllerPage->order');
        $this->router->get(Redirect::ADDRESS_URL, 'ControllerPage->address');
        $this->router->get(Redirect::LOGIN_URL, 'ControllerPage->login');
        $this->router->get(Redirect::SIGNUP_URL, 'ControllerPage->signup');
        $this->router->get(Redirect::PROFILE_URL, 'ControllerPage->profile');
    }

    private function configurePostRoutes()
    {
        // Routes corresponding to Controller methods
        $this->router->post(Redirect::HOME_URL, 'ControllerPage->home');
        $this->router->post(Redirect::PRODUCT_LIST_URL, 'ControllerPage->product_list');
        $this->router->post(Redirect::PRODUCT_INFO_URL, 'ControllerPage->product_info');
        $this->router->post(Redirect::MANAGE_URL, 'ControllerPage->manage');
        $this->router->post(Redirect::ORDER_URL, 'ControllerPage->order');
        $this->router->post(Redirect::ADDRESS_URL, 'ControllerPage->address');
        $this->router->post(Redirect::LOGIN_URL, 'ControllerPage->login');
        $this->router->post(Redirect::SIGNUP_URL, 'ControllerPage->signup');
        $this->router->post(Redirect::PROFILE_URL, 'ControllerPage->profile');
        $this->router->post(Redirect::LOGOUT_URL, 'ControllerUser->logout');
    }
}
