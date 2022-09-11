<?php

namespace Poils_o_pattes\Taxonomies;

use Poils_o_pattes\CPT\Dog;
use WP_Privacy_Requests_Table;

class Age
{
  const SLUG = "age";

  static public function register()
  {
    register_taxonomy(
      self::SLUG,
      [Dog::SLUG],
      [
        "label"        => "Âge",
        "hierarchical" => false,
        "public"       => true,
        "show_in_rest" => true,
      ]
    );
    			// TODO : create an array with the list of age and loop over it to add their taxonomies.
		self::addTerms();
  }
	
	static private function addTerms(){
		for ($birthYear = 2022 ; $birthYear >= 2002 ; $birthYear--){
			wp_insert_term($birthYear, self::SLUG);
		}
		wp_insert_term("avant 2002", self::SLUG);
	}
	
	static private function removeTerms(){
		for ($birthYear = 2022 ; $birthYear >= 2002 ; $birthYear--){
			wp_delete_term($birthYear, self::SLUG);
		}
		wp_delete_term("avant 2002", self::SLUG);
	}

	static public function unregister(){
		unregister_taxonomy(self::SLUG);
		self::removeTerms();	
	}
}
