<?php
include_once("model/User.php");

class Controller
{
    public $user;
    public $produit;
    public function __construct()
    {
        $this->user = new User();
        // $this->produits = new Produit();
    }

    public function redirect($name)
    {
        switch ($name) {
        }
    }

    public function invoke()
    {
        $_SESSION['page'] = $this->redirect($_POST['page']);
        switch ($_SESSION['page']) {
            case 'home':
                $title = 'Home';
                $styles = ['navbar.css', 'home.css', 'footer.css'];
                $scripts = ['home.js'];

                include 'head.php';
                include 'navbar.php';
                $this->includeHome();
                include 'footer.php';

                break;
            case 'page_produit':

                break;
        }
    }

    private function includeHome()
    {

        include 'home.php';
    }
}
