<?php

function hkibcomm_registration_form(){
	
	if(!is_user_logged_in()){
		
		global $hkibcomm_load_css;
		$hkibcomm_load_css = true;
		
		$registration_enabled = get_option('users_can_register');
		
		if ($registration_enabled) {
		
			$output = hkibcomm_registration_form_fields();
			//$output = __('Asdasdasdasd', 'hkibcomm');

		}else{
		
			$output = __('User registration is not Enabled', 'hkibcomm');
			
		}
	} else {
		$output = __('You are already registered and logged in.', 'hkibcomm');
		
	} 
	return $output;
}
add_shortcode('hkibcomm_register_form', 'hkibcomm_registration_form');

function hkibcomm_login_form($atts, $content = null ) {

	global $post, $hkibcomm_load_css;

	if (is_singular()) :
		$current_page = get_permalink($post->ID);
	else :
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") $pageURL .= "s";
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		else $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$current_page = $pageURL;
	endif;

	extract( shortcode_atts( array(
		'redirect' => $current_page
	), $atts ) );
	
	
	if(!is_user_logged_in()) {
		
		global $hkibcomm_load_css;
		
		// set this to true so the CSS is loaded
		$hkibcomm_load_css = true;
		$output = hkibcomm_login_form_fields($redirect);
		
	} else {
		 $output = '<br/>' . __('You are already logged in.', 'hkibcomm') . ' <a href="' . wp_logout_url(home_url()) . '">' . __('Logout', 'hkibcomm') . '</a>';
	}
	return $output;
}
add_shortcode('hkibcomm_login_form', 'hkibcomm_login_form');

function hkibcomm_reset_password_form() {
	if(is_user_logged_in()) {
		
		return hkibcomm_change_password_form();
	}
}
add_shortcode('hkibcomm_reset_password_form', 'hkibcomm_reset_password_form');

function hkibcomm_get_current_user_info() {
	
	if(is_user_logged_in()) {
	
		return hkibcomm_view_profile();
	}

}
add_shortcode('hkibcomm_user_info', 'hkibcomm_get_current_user_info');

function hkibcomm_fe_registration() {
	 if(is_user_logged_in()) {
	
		return add_member_fe();
	 }
}
add_shortcode('hkibcomm_fe_reg', 'hkibcomm_fe_registration');

function hkibcomm_fe_haki(){
	if(is_user_logged_in){
	
		return register_merek();
	
	}
}
add_shortcode('hkibcomm_fe_haki', 'hkibcomm_fe_haki');

function hkibcomm_editprofile2(){

	if(is_user_logged_in){
		return changeprofile();
	}
	
}
add_shortcode('hkibcomm_editprofile2', 'hkibcomm_editprofile2');

// shortcode front end buat register semua HAKI

function hkibcomm_fe_paten(){
	if(is_user_logged_in){
	
		return register_paten();
	
	}
}
add_shortcode('hkibcomm_fe_paten', 'hkibcomm_fe_paten');


function hkibcomm_fe_hakcipta(){
	if(is_user_logged_in){
	
		return register_hakcipta();
	
	}
}
add_shortcode('hkibcomm_fe_hakcipta', 'hkibcomm_fe_hakcipta');

function hkibcomm_fe_desainindustri(){
	if(is_user_logged_in){
	
		return register_desainindustri();
	
	}
}
add_shortcode('hkibcomm_fe_desainindustri', 'hkibcomm_fe_desainindustri');

function hkibcomm_fe_indikasigeo(){
	if(is_user_logged_in){
	
		return register_indikasigeo();
	
	}
}
add_shortcode('hkibcomm_fe_indikasigeo', 'hkibcomm_fe_indikasigeo');