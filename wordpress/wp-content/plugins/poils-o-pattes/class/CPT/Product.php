<?php

namespace Poils_o_pattes\CPT;

class Product
{
    public const SLUG = 'product';

    public const CAPABILITIES = [
        'edit_posts'             => 'edit_products',
        'edit_post'              => 'edit_product',
        'publish_posts'          => 'publish_products',
        'publish_post'           => 'publish_product',
        'edit_published_posts'   => 'edit_published_products',
        'edit_published_post'    => 'edit_published_products',
        'read_posts'             => 'read_products',
        'read_post'              => 'read_product',
        'delete_post'            => 'delete_product',
        'delete_posts'           => 'delete_products',
        'edit_others_posts'      => 'edit_others_products',
        'edit_others_post'       => 'edit_others_product',
        'delete_others_posts'    => 'delete_others_products',
        'delete_others_post'     => 'delete_others_product',
        'delete_published_posts' => 'delete_published_products',
    ];

    public static function register()
    {
        register_post_type(
            self::SLUG,
            [
                'label'        => "Produits",
                'description'  => "Liste des produits disponibles",
                'menu_icon'    => 'dashicons-products',
                'map_meta_cap' => true,
                'capabilities' => self::CAPABILITIES,
                'supports'     => [
                    "thumbnail",
                    "title",
                    "excerpt",
                    "author",
                ],
                'show_in_rest' => true,
                'public'       => true,
            ]
        );
    }

    public static function grantCapsToAdmin()
    {
        $adminRole = get_role('administrator');
        foreach (self::CAPABILITIES as $currentCustomCapability) {
            $adminRole -> add_cap($currentCustomCapability, true);
        }
    }

    public static function removeCapsToAdmin()
    {
        $adminRole = get_role('administrator');
        foreach (self::CAPABILITIES as $currentCustomCapability) {
            $adminRole -> remove_cap($currentCustomCapability);
        }
    }

    public static function unregister()
    {
        unregister_post_type(self::SLUG);
    }
}