<?php
/**
* @package MHamdyPlugin
*/

namespace Inc\Base;

class Activate
{
    public static function activate()
    {
        flush_rewrite_rules();
        
        $default = [];

        if( ! get_option('mhamdy_plugin')){
            update_option( 'mhamdy_plugin', $default );
        }
        if( ! get_option('mhamdy_plugin_cpt')){
            update_option( 'mhamdy_plugin_cpt', $default );
        }
        if( ! get_option('mhamdy_plugin_tax')){
            update_option( 'mhamdy_plugin_tax', $default );
        }
    }
}