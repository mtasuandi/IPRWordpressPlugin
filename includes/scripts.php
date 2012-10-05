<?php

// register our form css
function hkibcomm_register_scripts() {
	wp_register_style('hkibcomm-form-css', hkibcomm_PLUGIN_DIR . 'css/forms.css');
	wp_enqueue_script('jquery');
	//wp_enqueue_script('hkibcomm-form-js', hkibcomm_PLUGIN_DIR . 'js/hkibcomm-scripts.js');
}
add_action('init', 'hkibcomm_register_scripts');
 
// load our form css
function hkibcomm_print_css() {
	global $hkibcomm_load_css, $hkibcomm_settings;
 
	// this variable is set to TRUE if the short code is used on a page/post
	if ( ! $hkibcomm_load_css )
		return; // this means that neither short code is present, so we get out of here

	if(!isset($hkibcomm_settings['disable_css'])) {
		wp_print_styles('hkibcomm-form-css');
	}
	
}
add_action('wp_footer', 'hkibcomm_print_css');