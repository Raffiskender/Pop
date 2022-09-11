<?php

namespace Poils_o_pattes\Roles;

class Customer
{
    public const ROLE_KEY = 'customer';

    public static function register()
    {
        // list of "keys" provided to users with the "Customer" role
        $capabilities = [
                'edit_posts' => true,
                'upload_files' => true,
                //* Commenting this line disallow custom user to go in wp admin.
          			//'read' => true,
          			'edit_customers' => true,
                //* dogs
                'edit_dogs' => true,
                'publish_dog' => true,
                'publish_dogs' => true,
                'edit_dog' => true,
                'read_dog' => true,
                'delete_dog' => true,
                'delete_dogs' => true,
                //'edit_others_dogs' => true,
                //'delete_others_dogs' => true,
                'delete_published_dogs' => true,
                'edit_published_dogs' => true,
        ];

        add_role(self::ROLE_KEY, 'Customer', $capabilities);
    }

    public static function unregister()
    {
        remove_role(self::ROLE_KEY);
    }
}