<?php

namespace App\Controller;

// Model
use App\Model\DataBase\Category;

// Helpers
use App\Helpers\{
    RedirectHelper as Redirect,
    SessionHelper as Session
};

class ControllerCategory
{
    private $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function homeFilter()
    {
        $fragrances = [
            'button1' => 'hesperides',
            'button2' => 'fleuris',
            'button3' => 'boises',
            'button4' => 'fougeres',
            'button5' => 'chypres',
            'button6' => 'orientaux',
            'button7' => 'aromatiques',
        ];

        // If button clicked
        if (isset($_POST['frangrance']) && isset($fragrances[$_POST['frangrance']])) {
            // Set $_SESSION value
            $_SESSION['fragrance'] = $fragrances[$_POST['frangrance']];
            // Refresh
            Redirect::redirectTo(Redirect::HOME_URL);
        }
    }
}
