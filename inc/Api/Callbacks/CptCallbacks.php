<?php 
/**
 * @package  MHamdyPlugin
 */
namespace Inc\Api\Callbacks;

class CptCallbacks
{

	public function cptSectionManager()
	{
		echo 'Create as many Custom Post Types as you want.';
	}

	public function cptSanitize( $input )
	{
		$output = get_option('mhamdy_plugin_cpt') ?: [];

		if(isset($_POST['remove'])){
			unset($output[$_POST['remove']]);

			// echo '<pre>';
			// var_dump($_POST);
			// var_dump($output);
			// echo '<pre>';
			// die();
			return $output;
		}


		$output[$input['post_type'] ] = $input;

		return $output;


		// foreach($output as $key =>$value){
		// 	if($input['post_type'] === $key){
		// 		$output[$key] = $input;
		// 	} else {
		// 		$output[$input['post_type'] ] = $input;
		// 	}
		// }
		// echo '<pre>';
		// var_dump($output);
		// echo '<pre>';
		// die();
	}

	public function textField( $args )
	{
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$value = '';
		$readonly = '';
		
		if(isset($_POST['edit_post'])){
			$cpt_option = get_option( $option_name );
			$value = $cpt_option[ $_POST['edit_post'] ] [ $name ];
			$readonly = ($name == 'post_type') ? 'readonly' : '';
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

		if(isset($_POST['edit_post'])){
			$cpt_option = get_option( $option_name );
			$checked = isset($cpt_option[ $_POST['edit_post'] ] [ $name ]) ?: '';
		}

		echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']"
			 value="1" class="" '. ($checked ? 'checked' : '') .'>
			 <label for="' . $name . '">
			 <div></div>
			 </label>
			 </div>';
	}
}