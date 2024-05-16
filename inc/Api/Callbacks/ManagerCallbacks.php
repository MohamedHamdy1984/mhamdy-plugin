<?php
/**
* @package MHamdyPlugin
*/

namespace Inc\Api\Callbacks;
use \Inc\Base\BaseController;


class ManagerCallbacks extends BaseController
{
    public function checkboxSanitize($input)
    {
        $output = [];
        foreach ($this->managers as $key=>$value){
            $output[$key] = isset($input[$key]) ? true : false;
        }
        
        return $output;
    }


    public function adminSectionManager()
    {
        echo 'Manage the section and feature of this Plugin by activating the checkbox from the following list.';
    }


    public function checkboxField($args)
    {
        $name = $args['label_for'];
        $class = $args['class'];
        $option_name = $args['option_name'];


        $checkbox = get_option( $option_name);

        $checkboxName = isset($checkbox[$name]) ? $checkbox[$name] : ''; 
        
        echo '<div class="'.$class.'">
        <input type="checkbox" id="' .$name.'" name="'.$option_name.'['.$name.']" value="1" class="" '. ($checkboxName ? 'checked' : '') .'>
        <label for="' .$name.'"><div></div></label> 
        </div>';
    }
}