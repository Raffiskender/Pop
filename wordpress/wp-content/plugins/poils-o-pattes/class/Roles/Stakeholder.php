<?php

namespace Poils_o_pattes\Roles;

class Stakeholder
{
    public const ROLE_KEY = 'stakeholder';

    public const CAPABILITIES = [
            'read' =>true,
            'edit_dashboard' => true,
            //* products
            'upload_files' => true,
            'view_admin_dashboard' => true,
            'edit_posts' => true,
            'edit_products' => true,
            'edit_product' => true,
            'publish_products' => true,
            'publish_product' => true,
            'edit_published_products' => true,
            'edit_published_product' => true,
            'read_products' => true,
            'read_product' => true,
            'delete_product' => true,
            'delete_products' => true,
            'edit_others_products' => true,
            'edit_others_product' => true,
            'delete_others_products' => true,
            'delete_published_products' => true,
            'manage_categories'       => true,
            //* dogs
            'edit_dogs' => true,
            'publish_dogs' => true,
            'edit_dog' => true,
            'read_dog' => true,
            'delete_dog' => true,
            'delete_dogs' => true,
            'edit_others_dogs' => true,
            'delete_others_dogs' => true,
            'delete_published_dogs' => true,
            'edit_published_dogs' => true,

        ];

    public static function register()
    {
        // list of "keys" provided to users with the "stakeholder" role
        add_role(self::ROLE_KEY, 'Stakeholder', self::CAPABILITIES);
    }

    public static function unregister()
    {
        remove_role(self::ROLE_KEY);
    }
}