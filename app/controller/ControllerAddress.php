<?php

namespace App\Controller;

// Model
use App\Model\DataBase\Address;

// Helpers
use App\Helpers\{
    FormHelper as Form,
    RedirectHelper as Redirect,
    SessionHelper as Session
};

class ControllerAddress
{
    private $address;

    public function __construct()
    {
        $this->address = new Address();
    }

    public function affAddresses()
    {
        $datas = $this->address->getAddressByUserId(Session::getValue('user_id'));
        return $datas;
    }

    public function addAddress()
    {
        $inputs = ['street', 'city', 'zip_code', 'region', 'country'];
        $refresh = false;

        foreach ($inputs as $input) {
            if (Form::validate($input, ['required' => true])) {
                Session::setValue('insert', $input, Form::getValue($input));
                $refresh = true;
            }
            $datas['insert'][$input] = Session::getValue('insert', $input, '');
        }

        if (Form::validates([
            'insert' => ['required' => true, 'max_length' => 50],
            'street' => ['required' => true, 'max_length' => 50],
            'city' => ['required' => true, 'max_length' => 50],
            'zip_code' => ['required' => true, 'max_length' => 50, 'is_number' => true],
            'region' => ['required' => true, 'max_length' => 50],
            'country' => ['required' => true, 'max_length' => 50]
        ])) {
            foreach ($inputs as $input) {
                $form[$input] = Form::getValue($input);
            }

            $address_id = $this->address->insertAddress($form);

            $this->address->insertUserAddress(Session::getValue('user_id'), $address_id);

            Session::unsetValue('insert');
        }

        if ($refresh) Redirect::redirectTo(Redirect::ADDRESS_URL);

        return $datas;
    }
}
