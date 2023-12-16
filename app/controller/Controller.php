<?php
include_once './model/User.php';
include_once './model/Page.php';

class Controller
{
    public $users;
    public $page;

    public function __construct()
    {
        $this->users = new User();
        $this->page = 'home';
    }

    public function invoke()
    {
        switch ($this->page) {
            case 'home':
                $home = new Page(
                    'Home',
                    'home.php',
                    ['header.css', 'home.css', 'footer.css'],
                    ['home.js'],
                    true,
                    true
                );

                $home->render();
                break;
            case 'page_produit':

                break;
        }
    }
}
