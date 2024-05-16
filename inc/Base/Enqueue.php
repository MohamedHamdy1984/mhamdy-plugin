<?php
/**
* @package MHamdyPlugin
*/

namespace Inc\Base;
use \Inc\Base\BaseController;

class Enqueue extends BaseController
{

    public function register()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    function enqueue()
    {
        wp_enqueue_script( 'media-upload' );
		wp_enqueue_media();
        wp_enqueue_style( 'pluginStyle', $this->plugin_url . 'assets/mystyle.min.css' );
        wp_enqueue_style( 'prettifyStyle', $this->plugin_url . 'assets/google-code-prettify/sunburst.css' );
        wp_enqueue_script( 'pluginScript', $this->plugin_url . 'assets/main.js' );
        wp_enqueue_script( 'prettifyScript', $this->plugin_url . 'assets/google-code-prettify/prettify.js' );
    }
}