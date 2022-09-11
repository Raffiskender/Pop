<?php

namespace Poils_o_pattes\Taxonomies;

use Poils_o_pattes\CPT\Dog;

class Breed
{
    public const SLUG = "breed";
    private const breedList = ["Basset Hound","Bichon","Bouledogue anglais","Bouledogue français","Boxer","Cairn","Caniche","Carlin","Cavalier King Charles","Chihuahua","Cocker Anglais","Cocker Américain","Coton de Tuléar","Fox Terrier","Golden Retriever","Jack Russel","Jack Russel Parson","Labrador","Lhassa","Scottish","Schnauzer Nain","Shih Tzu","Spitz","Teckel","Westie","YorkShire"];

    public static function register()
    {
        register_taxonomy(
            self::SLUG,
            [Dog::SLUG],
            [
              "label"        => "Race",
              "hierarchical" => false,
              "public"       => true,
              "show_in_rest" => true,
            ]
        );

        self::addTerms();
    }

      private static function addTerms()
      {
          // TODO : create an array with the list of dogs and loop over it to add their taxonomies.
          wp_insert_term('autre', self::SLUG);

          foreach (self::breedList as $currentBreed) {
              wp_insert_term($currentBreed, self::SLUG);
          }
      }

      private static function removeTerms()
      {
          wp_delete_term('autre', self::SLUG);

          foreach (self::breedList as $currentBreed) {
              wp_delete_term($currentBreed, self::SLUG);
          }
      }

      public static function unregister()
      {
          unregister_taxonomy(self::SLUG);
          self::removeTerms();
      }
}
