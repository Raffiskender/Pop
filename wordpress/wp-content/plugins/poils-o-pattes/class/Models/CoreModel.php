<?php

namespace Poils_o_pattes\Models;

class CoreModel
{
    protected $wpdb;
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }
}