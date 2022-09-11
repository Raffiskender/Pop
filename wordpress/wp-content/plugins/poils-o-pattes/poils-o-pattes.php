<?php

/**
 * Projet Poils aux pattes for WordPress
 *
 * Plugin Name:  Poils o pattes
 * Description:  Création des CPT / taxos et custom tables pour le site Poils aux pattes.
 * Version:      1.0.0
 * Author:       Hocine & Raffi
 *
 */

use Poils_o_pattes\CPT\Product;

require __DIR__ . '/vendor-poils-o-pattes/autoload.php';

define("POILS_O_PATTES_ENTRY_FILE", __FILE__);
define("POILS_O_PATTES_ENTRY_FOLDER", __DIR__);

add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails');
});

$listeDeCourse = new Poils_o_pattes\Plugin();
