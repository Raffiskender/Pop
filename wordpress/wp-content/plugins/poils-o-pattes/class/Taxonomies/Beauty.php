<?php

namespace Poils_o_pattes\Taxonomies;

use Poils_o_pattes\CPT\Product;

class Beauty
{
	const SLUG = "beauty-products";

	static public function register()
	{
		register_taxonomy(
			self::SLUG,
			[Product::SLUG],
			[
				"label"        => "Produits de beauté",
				"hierarchical" => false,
				"public"       => true,
				"show_in_rest" => true,
			]
		);
	}
			
	public static function unregister(){
		unregister_taxonomy(self::SLUG);
	}
}