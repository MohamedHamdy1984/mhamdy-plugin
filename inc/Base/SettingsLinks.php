<?php
/**
* @package MHamdyPlugin
*/

namespace Inc\Base;
use \Inc\Base\BaseController;

class SettingsLinks extends BaseController
{
    public function register(){
        add_filter('plugin_action_links_' . $this->plugin, [$this, 'settings_link']);
    }

    public function settings_link($links){
    $settings_link = '<a href="admin.php?page=mhamdy_plugin">Settings</a>';
    $links[] = $settings_link;
    return $links;
    }
}