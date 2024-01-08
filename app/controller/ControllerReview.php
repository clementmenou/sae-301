<?php

namespace App\Controller;

// Model
use App\Model\DataBase\{
    Review,
    User
};

// Helpers
use App\Helpers\{
    FormHelper as Form,
    RedirectHelper as Redirect,
    SessionHelper as Session
};

class ControllerReview
{
    private $review;
    private $user;
    private $controllerUser;

    public function __construct()
    {
        $this->review = new Review();
        $this->user = new User();
        $this->controllerUser = new ControllerUser();
    }

    public function redirectReview()
    {
        if (Form::validate('redirect_login', ['required' => true])) {
            Session::setValue('return_to_url', null, Redirect::PRODUCT_INFO_URL);
            Redirect::redirectTo(Redirect::LOGIN_URL);
        }
    }

    public function addReview()
    {
        if (Form::validates([
            'product_id' => ['required' => true, 'is_number' => true, 'max_length' => 10],
            'rating' => ['required' => true, 'in_array' => [1, 2, 3, 4, 5], 'max_length' => 10],
            'text' => ['required' => true, 'max_length' => 500]
        ])) {
            $user_id = Session::getValue('user_id');
            $product_id = Form::getValue('product_id');
            $rating = Form::getValue('rating');
            $text = Form::getValue('text');

            $this->review->insert($user_id, $product_id, $rating, $text);

            Redirect::redirectTo(Redirect::PRODUCT_INFO_URL);
        }
    }

    public function supprReview()
    {
        $suppr_pressed = Form::validate('delete_review', ['required' => true]);
        $review_id_valid = Form::validate('review_id', ['required' => true, 'is_number' => true, 'max_length' => 10]);

        if ($suppr_pressed && $review_id_valid) {
            $user_review = $this->review->getUserById(Form::getValue('review_id'));

            $user_match = (Session::getValue('user_id') == $user_review);
            $user_admin = $this->controllerUser->isUserAdmin();

            if ($user_match || $user_admin) {
                $review_id = Form::getValue('review_id');
                $this->review->deleteReview($review_id);
            }
        }

        // Refresh
        if ($suppr_pressed) Redirect::redirectTo(Redirect::PRODUCT_INFO_URL);
    }

    public function displayReviews()
    {
        $data = [];
        $data = $this->review->getAllReviews();
        foreach ($data as $review) {
            $review['user'] = $this->user->getUsernameById($review['user_id']);

            $user_match = (Session::getValue('user_id') == $review['user_id']);
            $user_admin = $this->controllerUser->isUserAdmin();

            $review['display_suppr'] = $user_match || $user_admin;

            $reviews[] = $review;
        }
        return $reviews ?? [];
    }
}
