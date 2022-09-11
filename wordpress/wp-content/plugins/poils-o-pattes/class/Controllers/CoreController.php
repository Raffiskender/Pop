<?php

namespace Poils_o_pattes\Controllers;

class CoreController
{
    // On stocke la connexion à la BDD de WP dans une propriété
    protected $wpdb;

    public function __construct()
    {
        // On récupère la connexion a la BDD de WP
        // DOC : https://developer.wordpress.org/reference/classes/wpdb/
        global $wpdb;

        $this->wpdb = $wpdb;
    }
}