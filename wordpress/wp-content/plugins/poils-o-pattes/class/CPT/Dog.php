<?php

namespace Poils_o_pattes\CPT;

class Dog
{
    public const SLUG = 'dog';
    public const CAPABILITIES = [
        'edit_posts'             => 'edit_dogs',
        'publish_posts'          => 'publish_dogs',
        'edit_post'              => 'edit_dog',
        'read_post'              => 'read_dog',
        'delete_post'            => 'delete_dog',
        'delete_posts'           => 'delete_dogs',
        'edit_others_posts'      => 'edit_others_dogs',
        'delete_others_posts'    => 'delete_others_dogs',
        'delete_published_posts' => 'delete_published_dogs',
        'edit_published_posts'   => 'edit_published_dogs',
    ];
    public static function register()
    {
        register_post_type(
            self::SLUG,
            [
                'label' => "Chiens",
                'description' => "La liste de tous les chiens enregistrés",
                'menu_icon' => 'dashicons-buddicons-activity',
                'capability_type' => self::SLUG,
                'map_meta_cap' => true,
                'capabilities' => self::CAPABILITIES,
                'supports'    => [

                    "title",
                    "author",
                    "excerpt",
                    "thumbnail",
                    "content",
                ],
                'show_in_rest' => true,
                'public'       => true,
            ]
        );
    }

    public static function grantCapsToAdmin()
    {
        //* 1- We recover the admin role
        $adminRole = get_role('administrator');
        //* 2- We add our roles to the admin roles
        foreach (self::CAPABILITIES as $currentCustomCapability) {
            $adminRole -> add_cap($currentCustomCapability, true);
        }
    }

    public static function removeCapsToAdmin()
    {
        //* 1- We recover the admin role
        $adminRole = get_role('administrator');
        //* 2- We add our roles to the admin roles
        foreach (self::CAPABILITIES as $currentCustomCapability) {
            $adminRole -> remove_cap($currentCustomCapability);
        }
    }

    public static function unregister()
    {
        unregister_post_type(self::SLUG);
    }
}