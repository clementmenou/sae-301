<?php

namespace App\Controller;

// Helpers
use App\Helpers\{
    FormHelper as Form,
    RedirectHelper as Redirect,
    SessionHelper as Session
};

// Model
use App\Model\DataBase\{
    Promotion
};


class ControllerPromotion
{
    private $promotion;

    public function __construct()
    {
        $this->promotion = new Promotion();
    }

    public function addPromotion()
    {
        if (Form::validates([
            'insert_promo_name' => ['required' => true, 'max_length' => 50],
            'insert_promo_discount' => ['required' => true, 'is_number' => true, 'max_length' => 2],
            'insert_promo_start_day' => ['required' => true, 'is_number' => true, 'max_length' => 2],
            'insert_promo_start_month' => ['required' => true, 'is_number' => true, 'max_length' => 2],
            'insert_promo_start_year' => ['required' => true, 'is_number' => true, 'max_length' => 2],
            'insert_promo_end_day' => ['required' => true, 'is_number' => true, 'max_length' => 2],
            'insert_promo_end_month' => ['required' => true, 'is_number' => true, 'max_length' => 2],
            'insert_promo_end_year' => ['required' => true, 'is_number' => true, 'max_length' => 2]
        ])) {
            $product_id = Form::getValue('insert_promo_name');
            $discount_percent = Form::getValue('insert_promo_discount');

            $anneeStart = Form::getValue('insert_promo_start_day');
            $moisStart = Form::getValue('insert_promo_start_month');
            $jourStart = Form::getValue('insert_promo_start_year');
            $anneeEnd = Form::getValue('insert_promo_end_day');
            $moisEnd = Form::getValue('insert_promo_end_month');
            $jourEnd = Form::getValue('insert_promo_end_year');

            $dateStart = '20' . $anneeStart . '-' . str_pad($moisStart, 2, '0', STR_PAD_LEFT) . '-' . str_pad($jourStart, 2, '0', STR_PAD_LEFT);
            $dateEnd = '20' . $anneeEnd . '-' . str_pad($moisEnd, 2, '0', STR_PAD_LEFT) . '-' . str_pad($jourEnd, 2, '0', STR_PAD_LEFT);

            $this->promotion->insertPromotion($product_id, $discount_percent, $dateStart, $dateEnd);
        }
    }
}
