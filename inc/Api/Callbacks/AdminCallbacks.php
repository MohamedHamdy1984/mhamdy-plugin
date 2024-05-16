<?php
/**
* @package MHamdyPlugin
*/

namespace Inc\Api\Callbacks;
use \Inc\Base\BaseController;


class AdminCallbacks extends BaseController
{
    /**
     * Admin main page and subpages
     */
    public function adminDashboard()
    {
        return require_once("$this->plugin_path/templates/admin.php");
    }


    public function adminCPT()
    {
        return require_once("$this->plugin_path/templates/cpt.php");
    }


    public function adminTaxonomy()
    {
        return require_once("$this->plugin_path/templates/taxonomy.php");
    }


    public function adminWidget()
    {
        return require_once("$this->plugin_path/templates/widget.php");
    }


    /**
     * Options 
     */
    // public function MhamdyOptionsGroup($input)
    // {
    //     return $input;
    // }
    // public function MhamdyAdminSection($input)
    // {
    //     echo 'Admin Section Here';
    // }
    public function MhamdyTextExample($input)
    {
        $value = esc_attr( get_option('text_example') );
        echo '<input type="text" class="regular-text" name="text_example" value="'. $value .'" placeholder="Write Here!">';
    }
    public function MhamdyFirstName($input)
    {
        $value = esc_attr( get_option('first_name') );
        echo '<input type="text" class="regular-text" name="first_name" value="'. $value .'" placeholder="Write your first name!">';
    }
}