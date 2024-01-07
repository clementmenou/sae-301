<?php

namespace App\Controller;

// Helpers
use App\Helpers\{
    FormHelper as Form,
    RedirectHelper as Redirect,
    SessionHelper as Session
};

class ControllerGlobal
{
    public function initializeTheme()
    {
        Session::setValue('fragrance', null, 'base', true);
    }
}
