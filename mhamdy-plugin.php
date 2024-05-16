<?php
/**
* @package MHamdyPlugin
*/
/*
Plugin Name: MHamdy
Pllugin URI: 
Description: A plugin for test and learning
Version: 1.0.0
Author: Mohamed Hamdy
Author URI: 
License: GPLv2 or later
Text Domain: mhamdy
*/


/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License C
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2023 Automattic, Inc.
*/


// Make sure we don't expose any info if called directly
if( ! defined('ABSPATH')){
    die;
}

if(file_exists(dirname(__FILE__) . '/vendor/autoload.php')){
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}


// Define CONSTANTS ==> this consatnts have been removed and we used BaseControlle class inside inc/Base
// define('PLUGIN_PATH', plugin_dir_path(__FILE__));
// define('PLUGIN_URL', plugin_dir_url(__FILE__));
// define('PLUGIN', plugin_basename(__FILE__));




function activate_mhamdy_plugin(){
    Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_mhamdy_plugin' ); 


function deactivate_mhamdy_plugin(){
    Inc\Base\deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_mhamdy_plugin' ); 

if(class_exists('Inc\\Init')){
    Inc\Init::register_services();
}


// translation
if (!function_exists('mhamdy_load_translation')) {
    function mhamdy_load_translation()
    {
        load_plugin_textdomain('mhamdyourse', false, basename(dirname(__FILE__)) . '/languages/');
    }
    add_action('plugins_loaded', 'mhamdy_load_translation');
}



