<?php

namespace Poils_o_pattes\Taxonomies;

use Poils_o_pattes\CPT\Dog;

class Weight
{
  const SLUG = "weight";

  static public function register()
  {
    register_taxonomy(
      self::SLUG,
      [Dog::SLUG],
      [
        "label"        => "Poids",
        "hierarchical" => false,
        "public"       => true,
        "show_in_rest"    => true,
      ]
    );
  self::addTerms();
  }
      			// TODO : create an array with the list of weight and loop over it to add their taxonomies.

	static private function addTerms(){
			for ($weight = 1 ; $weight <= 30 ; $weight++) {
					wp_insert_term($weight, self::SLUG);
			}
			wp_insert_term("+ de 30", self::SLUG);
	}
	
	static private function removeTerms(){
					for ($weight = 1 ; $weight <= 30 ; $weight++) {
					wp_delete_term($weight, self::SLUG);
			}
			wp_delete_term("+ de 30", self::SLUG);
		
	}
	
	static public function unregister(){
		unregister_taxonomy(self::SLUG);
		self::removeTerms();
	}
	
}