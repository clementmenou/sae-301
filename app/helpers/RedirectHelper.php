<?php

namespace App\Helpers;

class RedirectHelper
{
    // URL
    public const HOME_URL = '/';
    public const LOGIN_URL = '/connectez_vous';
    public const SIGNUP_URL = '/inscrivez_vous';
    public const PROFILE_URL = '/votre_profil';
    public const PRODUCT_LIST_URL = '/regardez_nos_produits';
    public const PRODUCT_INFO_URL = '/informations_sur_le_produit';
    public const LOGOUT_URL = '/deconnexion';
    public const MANAGE_URL = '/gerez_le_site';
    public const ORDER_URL = '/votre_panier';
    public const ADDRESS_URL = '/votre_lieu_de_livraision';
    public const PAYMENT_URL = '/payer_votre_commande';

    public static function redirectTo($location)
    {
        header("Location: $location");
        exit;
    }
}
