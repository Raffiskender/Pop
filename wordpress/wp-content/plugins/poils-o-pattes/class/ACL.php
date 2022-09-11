<?php

namespace Poils_o_pattes;

use Poils_o_pattes\Roles\Customer;
use Poils_o_pattes\Roles\Stakeholder;

//use Poils_o_pattes\Roles\Customer;

class ACL
{
    public static function checkUser()
    {
        //Récupération du user connecté
        $user = wp_get_current_user();
        $role = $user->roles[0];

        // user veux savoir si
        //* user veut seconnecter à l'admin
        //* user est connecté
        //* user's role est dans le tableau des forbiddens
        if (is_user_logged_in() && $role == Customer::ROLE_KEY) {
            show_admin_bar(false);

            //* if is_admin means : if current displayed page is dasboard
            if (is_admin()) {
                wp_redirect("https://poilsopattes.raffiskender.com/");
                exit();
            }
        }
    }
}