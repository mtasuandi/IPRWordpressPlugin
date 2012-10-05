<?php

function hkibcomm_add_new_member() {
  	if (isset( $_POST["hkibcomm_user_login"] ) && wp_verify_nonce($_POST['hkibcomm_register_nonce'], 'hkibcomm-register-nonce')) {
	
		global $hkibcomm_settings, $wpdb;

		$user_login			= $_POST["hkibcomm_user_login"];
		$user_fullname		= $_POST["hkibcomm_user_fullname"];
		$user_address		= $_POST["hkibcomm_user_address"];
		$user_city			= $_POST["hkibcomm_user_city"];
		$user_zipcode		= $_POST["hkibcomm_user_zipcode"];
		$user_country		= $_POST["hkibcomm_user_country"];
		$user_telephone		= $_POST["hkibcomm_user_telephone"];
		$user_fax			= $_POST["hkibcomm_user_fax"];
		$user_email			= $_POST["hkibcomm_user_email"];
		$user_pass			= $_POST["hkibcomm_user_pass"];
		$user_repass		= $_POST["hkibcomm_user_repass"];
		
		// required for check
		require_once(ABSPATH . WPINC . '/registration.php');

		if(username_exists($user_login)) {
			// Username already registered
			hkibcomm_errors()->add('username_unavailable', __('Username already taken', 'hkibcomm'), 'register');
		}
		if(!validate_username($user_login)) {
			// invalid username
			hkibcomm_errors()->add('username_invalid', __('Invalid username', 'hkibcomm'), 'register');
		}
		if($user_login == '') {
			// empty username
			hkibcomm_errors()->add('username_empty', __('Enter a username', 'hkibcomm'), 'register');
		}
		if(!is_email($user_email)) {
			//invalid email
			hkibcomm_errors()->add('email_invalid', __('Invalid email', 'hkibcomm'), 'register');
		}
		if(email_exists($user_email)) {
			//Email address already registered
			hkibcomm_errors()->add('email_used', __('Email already used', 'hkibcomm'), 'register');
		}
		if($user_pass == '') {
			// passwords do not match
			hkibcomm_errors()->add('password_empty', __('Enter a password', 'hkibcomm'), 'register');
		}
		if($user_pass != $user_repass) {
			// passwords do not match
			hkibcomm_errors()->add('password_mismatch', __('Passwords don\'t match', 'hkibcomm'), 'register');
		}
		if($user_fullname == '') {
			hkibcomm_errors()->add('fullname_empty', __('Fullname Empty', 'hkibcomm'), 'register');
		}
		
		if($user_address == '') {
			hkibcomm_errors()->add('address_empty', __('Address Empty', 'hkibcomm'), 'register');
		}
		
		if($user_city == '') {
			hkibcomm_errors()->add('city_empty', __('City Empty', 'hkibcomm'), 'register');
		}
			
		if($user_zipcode == '') {
			hkibcomm_errors()->add('zipcode_empty', __('Zipcode Empty', 'hkibcomm'), 'register');
		}
			
		if($user_country == '') {
			hkibcomm_errors()->add('country_empty', __('Country Empty', 'hkibcomm'), 'register');
		}
		
		if($user_telephone == '') {
			hkibcomm_errors()->add('telephone_empty', __('Telephone Empty', 'hkibcomm'), 'register');
		}
		
		if($user_fax == '') {
			hkibcomm_errors()->add('fax_empty', __('Fax Empty', 'hkibcomm'), 'register');
		}
		
		$errors = hkibcomm_errors()->get_error_messages();
		
		if(empty($errors)) {
			
			$new_user_id 		= wp_insert_user(array(
									'user_login'			=> $user_login,
									'user_fullname'			=> $user_fullname,
									'user_address'			=> $user_address,
									'user_city'				=> $user_city,
									'user_zipcode'			=> $user_zipcode,
									'user_country'			=> $user_country,
									'user_telephone'		=> $user_telephone,
									'user_fax'				=> $user_fax,
									'user_email'			=> $user_email,
									'user_pass'				=> $user_pass,
									'user_registered'		=> date('Y-m-d H:i:s'),
									'role'					=> 'subscriber'
									)
								);
			$sql = "INSERT INTO wp_member
					(created_date,
					username,
					nama_lengkap,
					alamat,
					kota,
					kode_pos,
					negara,
					telepon,
					fax,
					email,
					password					
					) VALUES (now(),
					'$user_login',
					'$user_fullname',
					'$user_address',
					'$user_city',
					'$user_zipcode',
					'$user_country',
					'$user_telephone',
					'$user_fax',
					'$user_email',
					'$user_pass');";
			$wpdb->query($sql);
			
			if($new_user_id) {
				// send email
				wp_new_user_notification($new_user_id);
				
				// login new user
				wp_setcookie($user_login, $user_pass, true);
				wp_set_current_user($new_user_id, $user_login);
				do_action('wp_login', $user_login);
		
				wp_redirect(get_permalink($hkibcomm_settings['redirect'])); exit;
			}
			
		}
	
	}
}
add_action('init', 'hkibcomm_add_new_member');


// login
function hkibcomm_login_member() {
		
	if(isset($_POST['hkibcomm_user_login']) && wp_verify_nonce($_POST['hkibcomm_login_nonce'], 'hkibcomm-login-nonce')) {
				
		
		$user = get_userdatabylogin($_POST['hkibcomm_user_login']);
		
		if(!$user) {
			
			hkibcomm_errors()->add('empty_username', __('Invalid username', 'hkibcomm'), 'login');
		}
		
		if(!isset($_POST['hkibcomm_user_pass']) || $_POST['hkibcomm_user_pass'] == '') {
			// if no password was entered
			hkibcomm_errors()->add('empty_password', __('Enter a password', 'hkibcomm'), 'login');
		}
				
		// check the user's login with their password
		if(!wp_check_password($_POST['hkibcomm_user_pass'], $user->user_pass, $user->ID)) {
			// if the password is incorrect for the specified user
			hkibcomm_errors()->add('empty_password', __('Incorrect password', 'hkibcomm'), 'login');
		}
		
		// retrieve all error messages
		$errors = hkibcomm_errors()->get_error_messages();
		
		// only log the user in if there are no errors
		if(empty($errors)) {
			
			wp_setcookie($_POST['hkibcomm_user_login'], $_POST['hkibcomm_user_pass'], true);
			wp_set_current_user($user->ID, $_POST['hkibcomm_user_login']);	
			do_action('wp_login', $_POST['hkibcomm_user_login']);
			
			wp_redirect($_POST['hkibcomm2_redirect']); exit;
		}
	}
}
add_action('init', 'hkibcomm_login_member');


function hkibcomm_change_password() {
	// reset a users password
	if(isset($_POST['hkibcomm_action']) && $_POST['hkibcomm_action'] == 'change-password') {
		
		global $user_ID;
		
		if(!is_user_logged_in())
			return;
			
		if(wp_verify_nonce($_POST['hkibcomm_password_nonce'], 'rcp-password-nonce')) {
			
			if($_POST['hkibcomm_user_pass'] == '' || $_POST['hkibcomm_user_repass'] == '') {
				// password(s) field empty
				hkibcomm_errors()->add('password_empty', __('Enter a password', 'hkibcomm'), 'password');
			}
			if($_POST['hkibcomm_user_pass'] != $_POST['hkibcomm_user_repass']) {
				// passwords do not match
				hkibcomm_errors()->add('password_mismatch', __('Passwords don\'t match', 'hkibcomm'), 'password');
			}
			
			// retrieve all error messages, if any
			$errors = hkibcomm_errors()->get_error_messages();
			
			if(empty($errors)) {
				// change the password here
				$user_data = array(
					'ID' => $user_ID,
					'user_pass' => $_POST['hkibcomm_user_pass']
				);
				wp_update_user($user_data);
				// send password change email here (if WP doesn't)
				wp_redirect(add_query_arg('password-updated', 'true', $_POST['hkibcomm_redirect']));
				exit;
			}
		}
	}	
}
add_action('init', 'hkibcomm_change_password');


function hkibcomm_errors(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
} 

function hkibcomm_show_error_messages($data = '') {
	if($codes = hkibcomm_errors()->get_error_codes()) {
		echo '<div>';
		    // Loop error codes and display errors
		   foreach($codes as $code){
				if(hkibcomm_errors()->get_error_data($code) == $data) {
			        $message = hkibcomm_errors()->get_error_message($code);
			        echo '<p><span>' . $message . '</span></p>';
				}
		    }
		echo '</div>';
	}	
}


//--------------------------


function hkibcomm_get_user_info(){
 
 
 
	if(is_user_logged_in()){
	
		wp_get_current_user();
		$current_user = wp_get_current_user();
		
		echo 	'<table border=1px solid black>';
		echo	'<tr>';
		echo	'<th border=1px solid black>Username</th>';
		echo	'<th border=1px solid black>User Email</th>';
		echo 	'<th border=1px solid black>Register Time</th>';
		echo	'</tr>';
		echo	'<tr>';
		echo	'<td>'.$current_user->user_login.'</td>';
		echo 	'<td>'.$current_user->user_email.'</td>';
		echo	'<td>'.$current_user->user_registered.'</td>';
		echo	'</tr>';
		echo	'</table>';
		// echo 'Username: ' . $current_user->user_login . '<br />';
		// echo 'User email: ' . $current_user->user_email . '<br />';
		// echo 'User ID: ' . $current_user->ID . '<br />';
	}
	else{
		$output = __('You are not Logged in.', 'hkibcomm');
	}
	return $output;
	
}
//add_action('init', 'hkibcomm_get_user_info');

/*

function hkibcomm_getcurrent_user_info(){
	
	  global $hkibcomm_settings;
      get_currentuserinfo();

      echo 'Username: ' . $hkibcomm_settings->user_login . "\n";
      echo 'User email: ' . $hkibcomm_settings->user_email . "\n";
      echo 'User ID: ' . $hkibcomm_settings->ID . "\n";
	  
	  $my_post = array(
     'post_title' => 'Auto Post',
     'post_content' => $hkibcomm_settings->user_login,
     'post_status' => 'publish',
     'post_author' => 1,
     'post_category' => array(8,39)
	);

	// Insert the post into the database
	wp_insert_post( $my_post );
}
add_action('init', 'hkibcomm_getcurrent_user_info');
*/
/*
function hkibcomm_add_post(){
	
	// Create post object
	$my_post = array(
     'post_title' => 'Auto Post',
     'post_content' => 'This is my post.',
     'post_status' => 'publish',
     'post_author' => 1,
     'post_category' => array(8,39)
	);

	// Insert the post into the database
	wp_insert_post( $my_post );
}

add_action('init', 'hkibcomm_add_post');
