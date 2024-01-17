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

    public function modifAddress()
    {
        $inputs = ['street', 'city', 'zip_code', 'country'];
        $refresh = false;

        foreach ($inputs as $input) {
            if (Form::validate($input, ['required' => true])) {
                $refresh = true;
            }
        }

        if (Form::validates([
            'update' => ['required' => true, 'max_length' => 50],
            'address_id' => ['required' => true, 'max_length' => 10, 'is_number' => true],
            'street' => ['required' => true, 'max_length' => 50],
            'city' => ['required' => true, 'max_length' => 50],
            'zip_code' => ['required' => true, 'max_length' => 50, 'is_number' => true],
            'country' => ['required' => true, 'max_length' => 50]
        ])) {
            $form['address_id'] = Form::getValue('address_id');
            foreach ($inputs as $input) {
                $form[$input] = Form::getValue($input);
            }
            $this->address->updateAddress($form);
        }

        if ($refresh) Redirect::redirectTo(Redirect::ADDRESS_URL);
    }

    public function addAddress()
    {
        $inputs = ['street', 'city', 'zip_code', 'country'];
        $refresh = false;

        foreach ($inputs as $input) {
            if (Form::validate('insert_' . $input, ['required' => true])) {
                Session::setValue('insert', $input, Form::getValue($input));
                $refresh = true;
            }
            $datas['insert'][$input] = Session::getValue('insert', $input, '');
        }

        if (Form::validates([
            'insert' => ['required' => true, 'max_length' => 50],
            'insert_street' => ['required' => true, 'max_length' => 50],
            'insert_city' => ['required' => true, 'max_length' => 50],
            'insert_zip_code' => ['required' => true, 'max_length' => 50, 'is_number' => true],
            'insert_country' => ['required' => true, 'max_length' => 50]
        ])) {
            foreach ($inputs as $input) {
                $form[$input] = Form::getValue('insert_' . $input);
            }

            $address_id = $this->address->insertAddress($form);

            $this->address->insertUserAddress(Session::getValue('user_id'), $address_id);

            Session::unsetValue('insert');
        }

        if ($refresh) Redirect::redirectTo(Redirect::ADDRESS_URL);

        return $datas;
    }

    public function supprAddress()
    {
        if (Form::validates([
            'delete' => ['required' => true, 'max_length' => 50],
            'address_id' => ['required' => true, 'max_length' => 10, 'is_number' => true]
        ])) {
            $address_id = Form::getValue('address_id');
            $this->address->deleteAddress($address_id);
            Redirect::redirectTo(Redirect::ADDRESS_URL);
        }
    }
}
