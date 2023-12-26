<?php

namespace App\Controller;

// Model
use App\Model\DataBase\Category;

// Helpers
use App\Helpers\{
    FormHelper as Form,
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
            'hesperides',
            'fleuris',
            'boises',
            'fougeres',
            'chypres',
            'orientaux',
            'aromatiques'
        ];

        // If button clicked
        if (Form::validate('fragrance', ['required', 'in_array' => $fragrances])) {
            $fragranceChoice = Form::getValue('fragrance');
            // Set $_SESSION value
            Session::setValue('fragrance', null, $fragranceChoice);
            // Refresh
            Redirect::redirectTo(Redirect::HOME_URL);
        }
    }
}
