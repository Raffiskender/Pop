<?php

namespace Poils_o_pattes\Taxonomies;

class MediaTags
{
    public const SLUG = "location";

    public static function register()
    {
        $labels = array(
                'name'              => 'Locations',
                'singular_name'     => 'Location',
                'search_items'      => 'Search Locations',
                'all_items'         => 'All Locations',
                'parent_item'       => 'Parent Location',
                'parent_item_colon' => 'Parent Location:',
                'edit_item'         => 'Edit Location',
                'update_item'       => 'Update Location',
                'add_new_item'      => 'Add New Location',
                'new_item_name'     => 'New Location Name',
                'menu_name'         => 'Location',
        );

        $args = array(
                'labels' => $labels,
                'hierarchical' => true,
                'query_var' => 'true',
                'rewrite' => 'true',
                'show_admin_column' => 'true',
                "public"       => true,
                "show_in_rest" => true,
        );

        register_taxonomy(self::SLUG, 'attachment', $args);
    }
    public static function unregister()
    {
        unregister_taxonomy(self::SLUG);
    }
}
