<?php
/**
* @package MHamdyPlugin
*/

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;


class Dashboard extends BaseController
{
    public $settings;
    public $Callbacks;
    public $callbacks_mngr;
    public $pages = [];
    // public $subpages = [];


 

    public function register()
    {
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();
        $this->callbacks_mngr = new ManagerCallbacks();

        $this->setPages();

        // $this->setSubpages();

        $this->setSettings();

        $this->setSections();

        $this->setFields();

        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->register();
    }

    public function setpages()
    {
        $this->pages = [
            [
                'page_title' => 'MHamdy Plugin',
                'menu_title' => 'MHamdy',
                'capability' => 'manage_options',
                'menu_slug' => 'mhamdy_plugin',
                'callback' => [$this->callbacks, 'adminDashboard'],
                'icon_url' => 'dashicons-store',
                'position' => 110
            ]
        ];
    }


    // public function setSubpages()
    // {
    //     $this->subpages = [
    //         [
    //             'parent_slug' => 'mhamdy_plugin',
    //             'page_title' => 'Custom Post types',
    //             'menu_title' => 'CPT',
    //             'capability' => 'manage_options',
    //             'menu_slug' => 'mhamdy_cpt',
    //             'callback' => [$this->callbacks, 'adminCPT']
    //         ],
    //         [
    //             'parent_slug' => 'mhamdy_plugin',
    //             'page_title' => 'Custom Taxonomies',
    //             'menu_title' => 'Taxonomies',
    //             'capability' => 'manage_options',
    //             'menu_slug' => 'mhamdy_taxonomies',
    //             'callback' => [$this->callbacks, 'adminTaxonomy']
    //         ],
    //         [
    //             'parent_slug' => 'mhamdy_plugin',
    //             'page_title' => 'Custom Widgets',
    //             'menu_title' => 'Widgets',
    //             'capability' => 'manage_options',
    //             'menu_slug' => 'mhamdy_widgets',
    //             'callback' => [$this->callbacks, 'adminDashboard']
    //         ]
    //         ];
    // }

    public function setSettings()
    {
        $args = [
            [
                'option_group' => 'mhamdy_plugin_settings',
                'option_name' => 'mhamdy_plugin',
                'callback' => [$this->callbacks_mngr, 'checkboxSanitize']
            ]
        ]; 
        
        $this->settings->setSettings($args);
    }


    public function setSections()
    {
        $args = [
            [
                'id' => 'Mhamdy_admin_index',
                'title' => 'Settings Manager',
                'callback' => [$this->callbacks_mngr, 'adminSectionManager'],
                'page' => 'mhamdy_plugin'
            ]
            ];
        $this->settings->setSections($args);
    }



    public function setFields()
    {
        $args = [];

        foreach ($this->managers as $key=>$value){
            $args[] = [
                'id' => $key,
                'title' => $value,
                'callback' => [$this->callbacks_mngr, 'checkboxField'],
                'page' => 'mhamdy_plugin',
                'section' => 'Mhamdy_admin_index',
                'args' => [
                    'option_name' => 'mhamdy_plugin',
                    'label_for' => $key,
                    'class' => 'ui-toggle'
                ]
                ];
        }
        
        $this->settings->setFields($args);
    }
}

