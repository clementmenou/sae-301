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
        if (Form::validateField('fragrance', ['required', 'in_array' => $fragrances])) {
            $fragranceChoice = Form::getFieldValue('fragrance');
            // Set $_SESSION value
            Session::setSessionValue('fragrance', $fragranceChoice);
            // Refresh
            Redirect::redirectTo(Redirect::HOME_URL);
        }
    }
}
