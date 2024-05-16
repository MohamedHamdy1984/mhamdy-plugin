<?php 
/**
 * @package  MHamdyPlugin
 */
namespace Inc\Api\Callbacks;

class TaxonomyCallbacks
{
    public function taxSectionManager()
	{
		echo 'Create as many Custom Taxonomies as you want.';
	}
    
    public function taxSanitize( $input )
	{
		$output = get_option('mhamdy_plugin_tax') ?: [];
        
		if(isset($_POST['remove'])){
			unset($output[$_POST['remove']]);
			return $output;
		}

		$output[$input['taxonomy'] ] = $input;
        
		return $output;
	}

    public function textField( $args )
	{
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$value = '';
		$readonly = '';
        
		
		if(isset($_POST['edit_taxonomy'])){
			$tax_option = get_option( $option_name );
			$value = $tax_option[ $_POST['edit_taxonomy'] ] [ $name ];
			$readonly = ($name == 'taxonomy') ? 'readonly' : '';
			
		}


		echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" 
			value="'.$value.'" placeholder="' . $args['placeholder'] . '" required '.$readonly.'>';

	}

    public function checkboxField( $args )
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checked = '';

		if(isset($_POST['edit_taxonomy'])){
			$tax_option = get_option( $option_name );
			$checked = isset($tax_option[ $_POST['edit_taxonomy'] ] [ $name ]) ?: '';
		}

		echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']"
			 value="1" class="" '. ($checked ? 'checked' : '') .'>
			 <label for="' . $name . '">
			 <div></div>
			 </label>
			 </div>';
	}


    public function checkboxPostTypesField($args)
    {
        $output = '';
        $name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checked = '';

		if(isset($_POST['edit_taxonomy'])){
			$tax_option = get_option( $option_name );
		}

		// echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']"
		// 	 value="1" class="" '. ($checked ? 'checked' : '') .'>
		// 	 <label for="' . $name . '">
		// 	 <div></div>
		// 	 </label>
		// 	 </div>'; 

        $post_types = get_post_types(['show_ui' => true]);
        foreach($post_types as $post){

            if(isset($_POST['edit_taxonomy'])){
                $checked = isset($tax_option[ $_POST['edit_taxonomy'] ] [ $name ] [ $post ]) ?: '';
            }


            $output .= '<div class="' . $classes . ' mb-10"><input type="checkbox" id="' . $post . '" 
            name="' . $option_name . '[' . $name . '][' . $post . ']"
            value="1" class="" '. ($checked ? 'checked' : '') .'>
            <label for="' . $post . '">
            <div></div>
            </label>
            <strong>'.$post.'</strong> 
            </div>';
        }
        echo $output;
    }
}