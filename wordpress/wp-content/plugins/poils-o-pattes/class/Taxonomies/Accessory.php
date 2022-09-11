<?php

namespace Poils_o_pattes\Taxonomies;

use Poils_o_pattes\CPT\Product;

class Accessory
{
    const SLUG = "accessory";

    static public function register()
    {
        register_taxonomy(
            self::SLUG,
            [Product::SLUG],
            [
                "label"        => "Accessoires",
                "hierarchical" => false,
                "public"       => true,
                "show_in_rest" => true,
            ]
        );
    }
}
