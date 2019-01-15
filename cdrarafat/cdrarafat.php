<?php
/*
Plugin Name: cdr arafat skill test

Plugin URI: https://arafat.bd.education/

Description: used for  <i>exam</i> purpose.

Version: 1.0

Author: cdrarafat

Author URI: https://arafat.bd.education/

License: GPLv2 or later

Text Domain: cdrarafat

*/


add_action( 'admin_menu', 'cdr_menu_call' );

function cdr_menu_call(){

	add_options_page(
		'coder setting',	// page title
		'coder setting',	// menu title
		'manage_options',	// capabilty
		'coder_settings',	// menu slug
		'cdr_my_user_cal'	// function
	);
}

function cdr_my_user_cal() {
	?>
	
	<div class="wrap">
		<form action="options.php" method="POST">
			<!-- register setting group name -->
			<?php settings_fields( 'cdr_setting_group' ); ?>

			<!-- add setting section page name here . this retrive all -->
			<?php do_settings_sections( 'cdr_my_setting_page' ); ?>

			<input type="submit" name="submit" value="save">
		</form>
	</div>

	<?php
}


add_action( 'admin_init', 'cdr_all_setting' );

function cdr_all_setting() {

	register_setting(
		'cdr_setting_group',		// setting group name
		'cdr_setting_name',		// setting name 
		'cdr_save_setting'		// callback for validation
	);


	add_settings_section(
		'cdr_section_id',		// id
		'Set up the Coder Section',	// title
		'cdr_section_cal_name',		// callback
		'cdr_my_setting_page'		// page
	);

	add_settings_field(
		'cdr_set_field_id',		// id
		'Setting Field start here',	// title
		'cdr_main_cal_start',		// callback
		'cdr_my_setting_page',		// page
		'cdr_section_id'		// section id
	);
}

function cdr_section_cal_name(){
	echo "<hr/>";
}

function cdr_main_cal_start($input){

	// retrive the setting from database for showing it
	// in the value of input field
	// we need to retrive using register name

	$main 		= get_option('cdr_setting_name');

	$set_one 	= $main['set_one']; 
	$set_two 	= $main['set_two']; 
	$set_three 	= $main['set_three'];

	echo "<span for='set_one'> setting one </span>";
	echo "<input id='set_one' type='text' name='cdr_setting_name[set_one]' value='$set_one'>";

	echo "<br/>";

	echo "<span for='set_two'> setting Two </span>";
	echo "<input id='set_two' type='text' name='cdr_setting_name[set_two]' value='$set_two'>";
	echo "<br/>";

	echo "<span for='set_three'> setting three </span>";
	echo "<input id='set_three' type='text' name='cdr_setting_name[set_three]' value='$set_three'>";
	echo "<br/>";


}


function cdr_save_setting($input){

	// here we will do the validation 
	// WP will auto save it 

	/*echo "<pre>";
	print_r($input);
	echo "</pre>";
	die();
	*/

	if(
		empty($input['set_one']) || 
		empty($input['set_two']) ||
		empty($input['set_three'])
	){

		add_settings_error(
			'cdr_set_field_id',				// field id
			'error_id',					// code
			'Please fill all the Field Correctly !',	// msg
			'error'  					// msg name
		);

	}

	return $input;
}
