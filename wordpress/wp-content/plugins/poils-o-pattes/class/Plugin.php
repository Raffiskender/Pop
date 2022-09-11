<?php

namespace Poils_o_pattes;

use Poils_o_pattes\CPT\Dog;
use Poils_o_pattes\CPT\Product;
use Poils_o_pattes\Models\Appointements;
use Poils_o_pattes\Models\Services;
use Poils_o_pattes\Roles\Stakeholder;
use Poils_o_pattes\Taxonomies\Accessory;
use Poils_o_pattes\Taxonomies\Age;
use Poils_o_pattes\Taxonomies\Breed;
use Poils_o_pattes\Taxonomies\Food;
use Poils_o_pattes\Taxonomies\Weight;
use Poils_o_pattes\Roles\Customer;
use Poils_o_pattes\RoutesAPI;
use Poils_o_pattes\Taxonomies\Beauty;
use Poils_o_pattes\ACL;
use Poils_o_pattes\CustomMenus\Calendar;
use Poils_o_pattes\CustomMenus\MenuServices;
use Poils_o_pattes\Taxonomies\MediaTags;

class Plugin
{
    private $appointement;
    private $service;
    private $calendar;

    public function __construct()
    {
        register_activation_hook(POILS_O_PATTES_ENTRY_FILE, [$this, "onActivation"]);
        register_deactivation_hook(POILS_O_PATTES_ENTRY_FILE, [$this, "onDeactivation"]);
        add_action('init', [$this, 'onInit']);
        $this->appointement = new Appointements();
        $this->service = new Services();
        //! Becarefull to call the static function the right way on add_action callback !!!
        add_action('rest_api_init', [RoutesAPI::class, 'create_API_routes']);
        add_action('manage_media_custom_column', 'manage_attachment_topic_column', 10, 2);
    }

    public function onInit()
    {
        add_action('admin_menu', [Calendar::class, 'createMenu']);
        add_action('admin_menu', [MenuServices::class, 'createMenu']);
        //* - CPT (Dogs, products)
        Dog::register();
        Product::register();

        //* Taxonomies (Dogs: Breed, Weight, Sexe, birthday || products: accessories, goodies, food...)
        Breed::register();
        Weight::register();
        Age::register();
        Accessory::register();
        Food::register();
        Beauty::register();
        MediaTags::register();
        ACL::checkUser();
    }

    public function onActivation()
    {
        //* - Roles (worker / customer),
        Stakeholder::register();
        Customer::register();

        //* - Custom tables
        $this->appointement->createTable();
        $this->service->createTable();

        //* - extending Admin capabilities
        Dog::grantCapsToAdmin();
        Product::grantCapsToAdmin();
    }

    public function onDeactivation()
    {
        //* CPT
        Dog::unregister();
        Product::unregister();

        //*Custom Tables
        // $this->appointement->deleteTable();
        // $this->service->deleteTable();
        // $this->MenuServices->createMenu();

        //* Custom Roles
        Stakeholder::unregister();
        Customer::unregister();

        //* Custom taxonomies
        Accessory::register();
        Food::unregister();
        Breed::unregister();
        Weight::unregister();
        Age::unregister();
        Beauty::unregister();
        MediaTags::unregister();

        //*
        Dog::removeCapsToAdmin();
        Product::removeCapsToAdmin();
    }
}
