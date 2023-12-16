<?php
include_once './model/User.php';
include_once './model/Page.php';


class Controller
{
    public $user;
    public $page;

    public function __construct()
    {
        $this->user = new User();
        $this->page = 'home';
    }

    public function invoke()
    {
        switch ($this->page) {
            case 'home':
                $page = new Page(
                    'Home',
                    'home.php',
                    ['header.css', 'home.css', 'footer.css'],
                    ['home.js'],
                    true,
                    false
                );

                $page->render();
                break;
            case 'page_produit':

                break;
        }
    }
}
