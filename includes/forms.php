<?php
/*untuk masuk ke database dan sesuaikan dengan path directory masing2 */
require_once(ABSPATH . 'wp-config.php');

/*class2 database dan yg ini jg ya,
sesuaikan dengan path directory masing2  */
require_once(ABSPATH . 'wp-includes/wp-db.php'); 

	// function save(){
		
		// if($_GET['act']=='save'{
			// $html = form();
		// }
	// }
function cobe_fe(){

	if ( is_user_logged_in() ) {
		//echo 'Welcome, registered user!';
		$html .='<form method="post" action="" id="newCustomerForm">
 
				<label for="name">Name:</label>
				<input name="name" type="text" />
				<br/> 
				<label for="email">Email:</label>
				<input name="email" type="text" />
				<br/>
				<label for="phone">Phone:</label>
				<input name="phone" type="text" />
				<br/>
				<label for="address">Address:</label>
				<input name="address" type="text" />
				<br/> 
				<input type="hidden" name="action" value="addCustomer"/>
				<input type="submit">
				</form>
				<br/><br/>
				<div id="feedback"></div>
				<br/><br/>
				';
		echo $html;
		
	} else {
		echo 'Welcome, visitor!';
	}
}
	function form() {
	
	global $wpdb, $hkibcomm_settings, $hkibcomm_base_dir;
	//var dump($wpdb);
	
	if ($_POST['submit'] == 'Simpan'){
		
		
		$name = $_POST['name'];
		$surename = $_POST['surename'];
		$email = $_POST['email'];
		
		//global $wpdb;
		//$wpdb->pesanmasuk="wp_plugin";
		$wpdb->query("INSERT INTO wp_plugin (name, surename, email) values ('$name', '$surename', '$email')");
		// $sql = 	"INSERT INTO " . $wpdb->pesanmasuk .
				// " (name, surename, email) " .
				// "VALUES ('$name','$surename','$email')";
		// $wpdb->query($sql);
		//echo "Huehehehehe";
		
	}else{
	//$asd = site_url();
	//$a = explode("/", $asd);
	
	$html = '<form id="customer" method="post" action="?page=form">
			<input id="name" name="name" value="'.$_POST['name'].'"/><br/>
			<input id="surename" name="surename" value="'.$_POST['surename'].'"/><br/>
			<input id="email" name="email" value="'.$_POST['email'].'"/><br/>
			<input type="submit" name="submit" value="Simpan"/>
			</form>';
			echo $html;
		
	//wp_nonce_field( 'customer' );
		// if (isset($_POST['submit'])) {
		// // ADD SAVE STUFF HRE
			// function plugin_form() {
			

			

			
			// }
		// }
		// else {
		// // ADD FORM HERE
			// function save_data() {
			// global $wpdb;
				// $name = $_POST['name'];
				// $surname = $_POST['surname'];
				// $email = $_POST['email']; 	

				// global $wpdb;
				// $wpdb->query = "INSERT INTO wp_plugin ('name', 'surname', 'email') VALUES ('$name', '$surname', '$email');";
				// echo 'thanks';
			// }
		// }
	}
	}

if (!is_admin()){
function add_haki_fe(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	
	$errmsg = '';
	if (isset($_POST['submit'])){
		
		if ($_POST['nama_pemohon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Nama Lengkap harus diisi.</p></div>'; }
		if ($_POST['alamat_pemohon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Alamat harus diisi.</p></div>'; }
		if ($_POST['kota'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kota harus diisi.</p></div>'; }
		if ($_POST['kode_pos'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kode Pos harus diisi.</p></div>'; }
		if ($_POST['negara'] == ''){ $errmsg = '<div id="message" class="updated"><p>Negara harus diisi.</p></div>'; }
		if ($_POST['telepon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Telepon harus diisi.</p></div>'; }
		if ($_POST['fax'] == ''){ $errmsg = '<div id="message" class="updated"><p>Fax harus diisi.</p></div>'; }
		if ($_POST['nama_merek'] == ''){ $errmsg = '<div id="message" class="updated"><p>Nama Merek harus diisi.</p></div>'; }
		if ($_POST['warna_merek'] == ''){ $errmsg = '<div id="message" class="updated"><p>Warna Merek harus diisi.</p></div>'; }
		if ($_POST['arti_merek'] == ''){ $errmsg = '<div id="message" class="updated"><p>Arti Merek harus diisi.</p></div>'; }
		if ($_POST['barang_registered'] == ''){ $errmsg = '<div id="message" class="updated"><p>Pilih Jenis Barang atau Jasa Yang Diinginkan.</p></div>'; }
		if ($_POST['etiket_merek'] == ''){ $errmsg = '<div id="message" class="updated"><p>Etiket Merek harus diisi.</p></div>'; }
		

		if ($errmsg == ''){
			$sql = "insert into wphaki_haki (created_date, jenis, nama_pemohon, alamat_pemohon, kota, kode_pos, negara, telepon, fax, nama_merek, warna_merek, arti_merek, barang_registered, etiket_merek) 
					values(now(),'".$_POST['jenis']."','".$_POST['nama_pemohon']."','".$_POST['alamat_pemohon']."','".$_POST['kota']."','".$_POST['kode_pos']."','".$_POST['negara']."','".$_POST['telepon']."','".$_POST['fax']."','".$_POST['nama_merek']."','".$_POST['warna_merek']."','".$_POST['arti_merek']."','".$_POST['barang_registered']."','".$_POST['etiket_merek']."');";
   			$wpdb->query($sql);

   			//wp_redirect( get_bloginfo('url').'/wp-admin/admin.php?page=haki_member&act=modify_member');
   			// echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify&username='.$_GET['username'].''.'"</script>' ;
   			// exit;
			//wp_redirect( home_url() ); exit;
		}

	}

	//$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Add HAKI</h2><br />';
	// '.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=add_haki&username='.$_GET['username'].'
	if ($errmsg != '') $html .= $errmsg;
	
	$username = $_GET['username'];

	$html .= '<form method="post" action="">
			
			<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="jenis_haki">Jenis Haki</label></th>
				<td><select name="jenis">
				<option value="merek">Merek</option>
				<option value="paten">Paten</option>
				<option value="hak_cipta">Hak Cipta</option>
				<option value="desain_industri">Desain Industri</option>
				<option value="indikasi_geografis">Indikasi Geografis</option>
				</select>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="nama_pemohon">Nama Pemohon</label></th>
				<td><input name="nama_pemohon" type="text" id="nama_pemohon" value="'.$_POST['nama_pemohon'].'" class="regular-text code" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="alamat_pemohon">Alamat Pemohon</label></th>
				<td><input name="alamat_pemohon" type="text" id="alamat_pemohon" value="'.$_POST['alamat_pemohon'].'" class="regular-text code" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="kota">Kota</label></th>
				<td><input name="kota" type="text" id="kota" value="'.$_POST['kota'].'" class="regular-text code" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="kode_pos">Kode Pos</label></th>
				<td><input name="kode_pos" type="text" id="kode_pos" value="'.$_POST['kode_pos'].'" class="regular-text code" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="negara">Negara</label></th>
				<td><input name="negara" type="text" id="negara" value="'.$_POST['negara'].'" class="regular-text code" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="telepon">Telepon</label></th>
				<td><input name="telepon" type="text" id="telepon"  value="'.$_POST['telepon'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="fax">Faksimili</label></th>
				<td><input name="fax" type="text" id="fax"  value="'.$_POST['fax'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="nama_merek">Nama Merek</label></th>
				<td><input name="nama_merek" type="text" id="nama_merek"  value="'.$_POST['nama_merek'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for=warna_merek">Warna Merek</label></th>
				<td><input name="warna_merek" type="text" id="warna_merek"  value="'.$_POST['warna_merek'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="arti_merek">Arti Merek</label></th>
				<td><input name="arti_merek" type="text" id="arti_merek"  value="'.$_POST['arti_merek'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="barang_registered">Jenis Barang atau Jasa Yang Diinginkan</label></th>
				<td><input name="barang_registered" type="text" id="barang_registered"  value="'.$_POST['barang_registered'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="etiket_merek">Etiket Merek</label></th>
				
				<td><input name="etiket_merek" type="text" id="etiket_merek"  value="'.$_POST['etiket_merek'].'" class="regular-text" />
			</tr>
			</table>
			
			<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"  /></p>
			
			';
	echo $html;
	
}
}
function add_member_fe(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	
	$errmsg = '';
	if ($_POST['submit'] == 'Save Changes'){
		
		if ($_POST['sel_username'] == 'createnew'){ 
			$_POST['sel_username'] = $_POST['new_username'];
			if ($_POST['sel_username'] == ''){ $errmsg = '<div id="message" class="updated"><p>Username baru harus diisi.</p></div>';}
		}
		
		if ($_POST['nama_lengkap'] == ''){ $errmsg = '<div id="message" class="updated"><p>Nama Lengkap harus diisi.</p></div>'; }
		if ($_POST['alamat'] == ''){ $errmsg = '<div id="message" class="updated"><p>Alamat harus diisi.</p></div>'; }
		if ($_POST['kota'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kota harus diisi.</p></div>'; }
		if ($_POST['kode_pos'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kode Pos harus diisi.</p></div>'; }
		if ($_POST['negara'] == ''){ $errmsg = '<div id="message" class="updated"><p>Negara harus diisi.</p></div>'; }
		if ($_POST['telepon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Telepon harus diisi.</p></div>'; }
		if ($_POST['fax'] == ''){ $errmsg = '<div id="message" class="updated"><p>Fax harus diisi.</p></div>'; }
		if ($_POST['email'] == ''){ $errmsg = '<div id="message" class="updated"><p>Email harus diisi.</p></div>';}
		if (!is_email($_POST['email'])) { $errmsg = '<div id="message" class="updated"><p>Email Invalid.</p></div>';}
		if (email_exists($_POST['email'])) { $errmsg = '<div id="message" class="updated"><p>Email sudah terdaftar.</p></div>';}
		if ($_POST['password'] == ''){ $errmsg = '<div id="message" class="updated"><p>Password harus diisi.</p></div>'; }
		if ($_POST['password'] != $_POST['repassword']){ $errmsg = '<div id="message" class="updated"><p>Password tidak sama.</p></div>'; }
		

		if ($errmsg == ''){
			$sql = "insert into wphaki_member (created_date, username, nama_lengkap, alamat, kota, kode_pos, negara, telepon, fax, email, password) 
					values(now(),'".$_POST['sel_username']."','".$_POST['nama_lengkap']."','".$_POST['alamat']."','".$_POST['kota']."','".$_POST['kode_pos']."','".$_POST['negara']."','".$_POST['telepon']."','".$_POST['fax']."','".$_POST['email']."','".$_POST['password']."');";
   			$wpdb->query($sql);

   			//wp_redirect( get_bloginfo('url').'/wp-admin/admin.php?page=haki_member&act=modify_member');
   			
			wp_redirect( 'http://192.168.100.99/haki', 301 ); exit;
			
			// echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify'.'"</script>' ;
   			// exit;
			
		}

	}
	$user = ''; $sel_default = '';
	$res = $wpdb->get_results( 'SELECT username FROM wphaki_users Where username="'.$_GET['username'].'"');
	foreach ($res as $val){
		 if ($_POST['sel_username'] == $val->user_login) {$sel_default = ' selected ';}else{$sel_default = '';}
		 $user .= '<option value="'.$val->user_login.'" '.$sel_default.'>'.$val->user_nicename.'</option>';
	}
	
	if ($errmsg != '') $html .= $errmsg;
	$html .= '<form method="post" action="">
			
			<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="username">Username</label></th>
				<td><select name="sel_username">
				<option value="createnew">Create New &gt;&gt;</option>
				'.$user.'
				</select>
				<input name="new_username" type="text" id="new_username" value="'.$_POST['new_username'].'" class="regular-text"  /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="nama_lengkap">Nama Lengkap</label></th>
				<td><input name="nama_lengkap" type="text" id="nama_lengkap" value="'.$_POST['nama_lengkap'].'" class="regular-text code" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="alamat">Alamat</label></th>
				<td><input name="alamat" type="text" id="alamat" value="'.$_POST['alamat'].'" class="regular-text code" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="kota">Kota</label></th>
				<td><input name="kota" type="text" id="kota" value="'.$_POST['kota'].'" class="regular-text code" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="kode_pos">Kode Pos</label></th>
				<td><input name="kode_pos" type="text" id="kode_pos" value="'.$_POST['kode_pos'].'" class="regular-text code" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="negara">Negara</label></th>
				<td><input name="negara" type="text" id="negara" value="'.$_POST['negara'].'" class="regular-text code" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="telepon">Telepon</label></th>
				<td><input name="telepon" type="text" id="telepon"  value="'.$_POST['telepon'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="fax">Faksimili</label></th>
				<td><input name="fax" type="text" id="fax"  value="'.$_POST['fax'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="email">Email Address</label></th>
				<td><input name="email" type="email" id="email"  value="'.$_POST['email'].'" class="regular-text" />
				<span class="description">Masukkan email address yang valid</span></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="password">Password</label></th>
				<td><input name="password" type="password" id="password" value="'.$_POST['password'].'" class="regular-text code" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="repassword">Repassword</label></th>
				<td><input name="repassword" type="password" id="repassword" value="'.$_POST['repassword'].'" class="regular-text code" /></td>
			</tr>
			</table>

			<p class="submit"><input type="submit" name="submit2" id="submit2" class="button-primary" value="Save Changes"  /></p>

			';
	echo $html;
		
}


// login form
function hkibcomm_login_form_fields($redirect){
	
	global $hkibcomm_settings;
	ob_start(); ?>
		
		<?php 
		// show error messages
		hkibcomm_show_error_messages('login'); ?>
		<div id="stylized" class="myform">
		<form id="hkibcomm_login_form" action="" method="post">
	
			<h1><?php _e('Login to Your Account', 'hkibcomm'); ?></h1>

				<label for="hkibcomm_user_login"><?php _e('Username', 'hkibcomm'); ?>
				<span class="small">Input username here</span>
				</label>
				<input name="hkibcomm_user_login" id="hkibcomm_user_login" type="text" title="<?php _e('Username', 'hkibcomm'); ?>"/>

				<label for="hkibcomm_user_pass"><?php _e('Password', 'hkibcomm'); ?>
				<span class="small">Input valid password</span>
				</label>
				<input name="hkibcomm_user_pass" id="hkibcomm_user_pass" type="password" title="<?php _e('Password', 'hkibcomm'); ?>"/>

				<input type="hidden" name="hkibcomm2_redirect" value="<?php echo $redirect; ?>"/>
				<input type="hidden" name="hkibcomm_login_nonce" value="<?php echo wp_create_nonce('hkibcomm-login-nonce'); ?>"/>
				<button type="submit" id="hkibcomm_login_submit" value="<?php _e('Login', 'hkibcomm'); ?>">Login</button>
				<div class="spacer"></div>

			<p><a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="<?php _e('Lost Password', 'hkibcomm'); ?>"><?php _e('Lost Password?', 'hkibcomm');?></a>

		</form>
		</div>
	<style type="text/css">
	p, h1, form, button,{border:0; margin:0; padding:0;}
	
	.spacer{clear:both; height:1px;}
	
	.myform{
	margin:0 auto;
	width:400px;
	padding:14px;
	}

	
	#stylized{
	border:solid 2px #b7ddf2;
	background:#ebf4fb;
	}
	#stylized h1 {
	font-size:14px;
	font-weight:bold;
	margin-bottom:8px;
	}
	#stylized p{
	font-size:11px;
	color:#666666;
	margin-bottom:20px;
	border-bottom:solid 1px #b7ddf2;
	padding-bottom:10px;
	}
	#stylized label{
	display:block;
	font-weight:bold;
	text-align:right;
	width:140px;
	float:left;
	}
	#stylized .small{
	color:#666666;
	display:block;
	font-size:11px;
	font-weight:normal;
	text-align:right;
	width:140px;
	}
	#stylized input{
	float:left;
	font-size:12px;
	padding:4px 2px;
	border:solid 1px #aacfe4;
	width:200px;
	margin:2px 0 20px 10px;
	}
	#stylized button{
	clear:both;
	margin-left:150px;
	width:96px;
	height:32px;
	border: 0px;
	background:url("http://www.daftarhaki.com/wp-content/uploads/2012/04/button1.png") no-repeat;
	background-color:Transparent;
	text-align:center;
	color:#FFFFFF;
	font-size:11px;
	font-weight:bold;
	}
	</style>
	<?php
	return ob_get_clean();
}
// form registration
function hkibcomm_registration_form_fields() {
	global $hkibcomm_settings;
	ob_start(); ?>
	
	<?php 
	//show error messages
	hkibcomm_show_error_messages('register'); ?>
	<div id="stylized2" class="myform2">
	<form id="hkibcomm_registration_form" class="hkibcomm_form" action="" method="POST">
		
			<h1><?php _e('Register Your Account', 'hkibcomm'); ?></h1>
			
				<label for="hkibcomm_user_login"><?php _e('Username *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_login" id="hkibcomm_user_login" type="text" title="<?php _e('Username', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_fullname"><?php _e('Full Name *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_fullname" id="hkibcomm_user_fullname" type="text" title="<?php _e('Full Name', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_address"><?php _e('Address *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_address" id="hkibcomm_user_address" type="text" title="<?php _e('Address', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_city"><?php _e('City *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_city" id="hkibcomm_user_city" type="text" title="<?php _e('City', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_zipcode"><?php _e('ZIP Code *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_zipcode" id="hkibcomm_user_zipcode" type="text" title="<?php _e('ZIP Code', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_country"><?php _e('Country *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_country" id="hkibcomm_user_country" type="text" title="<?php _e('Country', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_telephone"><?php _e('Telephone *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_telephone" id="hkibcomm_user_telephone" type="text" title="<?php _e('Telephone', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_fax"><?php _e('Facsimile *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_fax" id="hkibcomm_user_fax" type="text" title="<?php _e('Facsimile' ,'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_email"><?php _e('Email *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_email" id="hkibcomm_user_email" type="email" title="<?php _e('email@domain.com', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_pass"><?php _e('Password *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_pass" id="hkibcomm_user_pass" type="password" title="<?php _e('Password', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_repass"><?php _e('Re Enter Password *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_repass" id="hkibcomm_user_repass" type="password" title="<?php _e('Re Enter Password', 'hkibcomm'); ?>"/>
			
				<input type="hidden" name="hkibcomm_register_nonce" value="<?php echo wp_create_nonce('hkibcomm-register-nonce');?>" />
				<button type="submit" id="hkibcomm_login_submit" value="<?php _e('Register', 'hkibcomm'); ?>">Register</button>
	</form>
	</div>
	<style type="text/css">
	p, h1, form, button,{border:0; margin:0; padding:0;}
	
	.spacer{clear:both; height:1px;}
	
	.myform2{
	margin:0 auto;
	width:400px;
	padding:14px;
	}

	
	#stylized2{
	border:solid 2px #b7ddf2;
	background:#ebf4fb;
	}
	#stylized2 h1 {
	font-size:14px;
	font-weight:bold;
	margin-bottom:8px;
	}
	#stylized2 p{
	font-size:11px;
	color:#666666;
	margin-bottom:20px;
	border-bottom:solid 1px #b7ddf2;
	padding-bottom:10px;
	}
	#stylized2 label{
	display:block;
	font-weight:bold;
	text-align:right;
	width:140px;
	float:left;
	}
	#stylized2 .small{
	color:#666666;
	display:block;
	font-size:11px;
	font-weight:normal;
	text-align:right;
	width:140px;
	}
	#stylized2 input{
	float:left;
	font-size:12px;
	padding:4px 2px;
	border:solid 1px #aacfe4;
	width:200px;
	margin:2px 0 20px 10px;
	}
	#stylized2 button{
	clear:both;
	margin-left:150px;
	width:96px;
	height:32px;
	border: 0px;
	background:url("http://www.daftarhaki.com/wp-content/uploads/2012/04/button1.png") no-repeat;
	background-color:Transparent;
	text-align:center;
	color:#FFFFFF;
	font-size:11px;
	font-weight:bold;
	}
	</style>
	<?php
	return ob_get_clean();
	
}

function hkibcomm_change_password_form() {
	global $post, $hkibcomm_settings;
   	if (is_singular()) :
   		$current_url = get_permalink($post->ID);
   	else :
   		$pageURL = 'http';
   		if ($_SERVER["HTTPS"] == "on") $pageURL .= "s";
   		$pageURL .= "://";
   		if ($_SERVER["SERVER_PORT"] != "80") $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
   		else $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
   		$current_url = $pageURL;
   	endif;		
	$redirect = $current_url;

	ob_start();
	
		// show any error messages after form submission
		hkibcomm_show_error_messages('password'); ?>
		
		<?php if(isset($_GET['password-updated']) && $_GET['password-updated'] == 'true') { ?>
			<div class="hkibcomm_message success">
				<span><?php _e('Password changed successfully', 'rcp'); ?></span>
			</div>
		<?php } ?>
		<form id="hkibcomm_password_form" method="POST" action="<?php echo $current_url; ?>">
			<fieldset>
				<legend><?php _e('Change Your Password', 'hkibcomm'); ?></legend>
				<p>
					<label for="hkibcomm_user_pass"><?php _e('New Password', 'rcp'); ?></label>
					<input name="hkibcomm_user_pass" id="hkibcomm_user_pass" class="required" type="password"/> 
				</p>
				<p>
					<label for="hkibcomm_user_repass"><?php _e('Password Confirm', 'rcp'); ?></label>
					<input name="hkibcomm_user_repass" id="hkibcomm_user_repass" class="required" type="password"/>
				</p>
				<p>
					<input type="hidden" name="hkibcomm_action" value="change-password"/>
					<input type="hidden" name="hkibcomm_redirect" value="<?php echo $redirect; ?>"/>
					<input type="hidden" name="hkibcomm_password_nonce" value="<?php echo wp_create_nonce('rcp-password-nonce'); ?>"/>
					<input id="hkibcomm_password_submit" class="hkibcomm_submit" type="submit" value="<?php _e('Change Password', 'hkibcomm'); ?>"/>
				</p>
			</fieldset>
		</form>
		<style type="text/css">
	form {
	border : 1px solid #a6efeb;
	padding : 5px;
	}
	.button {
    background-color:#D0C6A3;
	border:1px solid #D0C6A3;
	color:#000000;
	padding:3px 8px;
	margin:10px 0px;
	font-weight:bold;
	margin-left: 162px;
	width:100px;
	/* memberi efek tumpul pada sudut2 button
	   hanya dapat terlihat di mozilla
	*/
	-moz-border-radius-bottomleft:4px;
	-moz-border-radius-bottomright:4px;
	-moz-border-radius-topleft:4px;
	-moz-border-radius-topright:4px;
	}
	label
	{
	width: 6em;
	float: left;
	text-align: right;
	margin-right: 3em;
	display: block
	}
	input
	{
	color: #000000;
	background: #d5fbf8;
	border: 1px solid #14a098;
	width: 200px
	}
	.submit input
	{
	color: #000;
	background: #ffa20f;
	border: 2px outset #d7b9c9
	} 
	</style>
	<?php
	return ob_get_clean();	
}

function hkibcomm_view_profile(){
	
	global $hkibcomm_settings;
	
	return hkibcomm_get_user_info();
	
}

function edit_profile_fe(){
	
	global $hkibcomm_settings, $wpdb;
	
   	ob_start(); ?>
	
	<?php 
	//show error messages
	hkibcomm_show_error_messages('register'); ?>
	<div id="stylized2" class="myform2">
	<form id="hkibcomm_registration_form" class="hkibcomm_form" action="" method="POST">
		
			<h1><?php _e('Edit Account', 'hkibcomm'); ?></h1>
				
				<label for="hkibcomm_user_login"><?php _e('Username *', 'hkibcomm'); ?></label>
				<input disabled name="hkibcomm_user_login" id="hkibcomm_user_login" type="text" title="<?php _e('Username', 'hkibcomm');?>"/>
			
				<label for="hkibcomm_user_fullname"><?php _e('Full Name *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_fullname" id="hkibcomm_user_fullname" type="text" title="<?php _e('Full Name', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_address"><?php _e('Address *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_address" id="hkibcomm_user_address" type="text" title="<?php _e('Address', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_city"><?php _e('City *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_city" id="hkibcomm_user_city" type="text" title="<?php _e('City', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_zipcode"><?php _e('ZIP Code *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_zipcode" id="hkibcomm_user_zipcode" type="text" title="<?php _e('ZIP Code', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_country"><?php _e('Country *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_country" id="hkibcomm_user_country" type="text" title="<?php _e('Country', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_telephone"><?php _e('Telephone *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_telephone" id="hkibcomm_user_telephone" type="text" title="<?php _e('Telephone', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_fax"><?php _e('Facsimile *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_fax" id="hkibcomm_user_fax" type="text" title="<?php _e('Facsimile' ,'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_email"><?php _e('Email *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_email" id="hkibcomm_user_email" type="email" title="<?php _e('email@domain.com', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_pass"><?php _e('Password *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_pass" id="hkibcomm_user_pass" type="password" title="<?php _e('Password', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_repass"><?php _e('Re Enter Password *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_repass" id="hkibcomm_user_repass" type="password" title="<?php _e('Re Enter Password', 'hkibcomm'); ?>"/>
			
				<input type="hidden" name="hkibcomm_register_nonce" value="<?php echo wp_create_nonce('hkibcomm-register-nonce');?>" />
				<button type="submit" id="hkibcomm_login_submit" value="<?php _e('Update', 'hkibcomm'); ?>">Update</button>
	</form>
	</div>
	<style type="text/css">
	p, h1, form, button,{border:0; margin:0; padding:0;}
	
	.spacer{clear:both; height:1px;}
	
	.myform2{
	margin:0 auto;
	width:400px;
	padding:14px;
	}

	
	#stylized2{
	border:solid 2px #b7ddf2;
	background:#ebf4fb;
	}
	#stylized2 h1 {
	font-size:14px;
	font-weight:bold;
	margin-bottom:8px;
	}
	#stylized2 p{
	font-size:11px;
	color:#666666;
	margin-bottom:20px;
	border-bottom:solid 1px #b7ddf2;
	padding-bottom:10px;
	}
	#stylized2 label{
	display:block;
	font-weight:bold;
	text-align:right;
	width:140px;
	float:left;
	}
	#stylized2 .small{
	color:#666666;
	display:block;
	font-size:11px;
	font-weight:normal;
	text-align:right;
	width:140px;
	}
	#stylized2 input{
	float:left;
	font-size:12px;
	padding:4px 2px;
	border:solid 1px #aacfe4;
	width:200px;
	margin:2px 0 20px 10px;
	}
	#stylized2 button{
	clear:both;
	margin-left:150px;
	width:96px;
	height:32px;
	border: 0px;
	background:url("http://www.daftarhaki.com/wp-content/uploads/2012/04/button1.png") no-repeat;
	background-color:Transparent;
	text-align:center;
	color:#FFFFFF;
	font-size:11px;
	font-weight:bold;
	}
	</style>
	
	<?php
	
	return ob_get_clean();
	
	
	$user_fullname	= $_POST['nama_lengkap'];
			$user_address 	= $_POST['alamat'];
			$user_city		= $_POST['kota'];
			$user_zipcode	= $_POST['kode_pos'];
			$user_country	= $_POST['negara'];
			$user_telephone = $_POST['telepon'];
			$user_fax		= $_POST['fax'];
			$user_email		= $_POST['email'];
			$user_pass		= $_POST['password'];
			
			wp_update_user(array(
									'user_fullname'			=> $user_fullname,
									'user_address'			=> $user_address,
									'user_city'				=> $user_city,
									'user_zipcode'			=> $user_zipcode,
									'user_country'			=> $user_country,
									'user_telephone'		=> $user_telephone,
									'user_fax'				=> $user_fax,
									'user_email'			=> $user_email,
									'user_pass'				=> $user_pass
									)
								);
}

function editprofile2(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	global $user_ID;
	
	if ($_POST['submit'] == 'Save Changes'){
	
	$wpdb->query("
			UPDATE wp_member
			SET nama_lengkap='".$_POST['nama_lengkap']."', 
				alamat='".$_POST['alamat']."', 
				kota='".$_POST['kota']."', 
				kode_pos='".$_POST['kode_pos']."', 
				negara='".$_POST['negara']."', 
				telepon='".$_POST['telepon']."', 
				fax='".$_POST['fax']."', 
				email='".$_POST['email']."', 
				password='".$_POST['password']."'
			WHERE username='".$_GET['username']."'
			");
			
			$user_fullname	= $_POST['nama_lengkap'];
			$user_address 	= $_POST['alamat'];
			$user_city		= $_POST['kota'];
			$user_zipcode	= $_POST['kode_pos'];
			$user_country	= $_POST['negara'];
			$user_telephone = $_POST['telepon'];
			$user_fax		= $_POST['fax'];
			$user_email		= $_POST['email'];
			$user_pass		= $_POST['password'];
			
			wp_update_user(array(
									'user_fullname'			=> $user_fullname,
									'user_address'			=> $user_address,
									'user_city'				=> $user_city,
									'user_zipcode'			=> $user_zipcode,
									'user_country'			=> $user_country,
									'user_telephone'		=> $user_telephone,
									'user_fax'				=> $user_fax,
									'user_email'			=> $user_email,
									'user_pass'				=> $user_pass
									)
								);
								
		//echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify&username="'.$_GET['username'].'"'.'"</script>';
		echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=view_member'.'"</script>' ;
   		exit;
	}
	//$user_info = get_userdata(1);
	//$user = $wpdb->get_results('SELECT * FROM wp_member');

	$userdetails = $wpdb->get_results ('SELECT * from wp_member where username="'.$_GET['username'].'"');
	
	foreach ($userdetails as $userdetail){
		//echo $userdetail->post_title;
	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Modify Member</h2><br />';
	$html .= '<form method="post" action="?page=editprofile2&username='.$_GET['username'].'">
			<table class="form-table" >
			<tr valign="top">
				<th scope="row"><label for="username">Username</label></th>
				<td><input disabled name="username" type="text" id="username" value="'.$userdetail->username.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="nama_lengkap">Nama Lengkap</label></th>
				<td><input name="nama_lengkap" type="text" id="nama_lengkap" value="'.$userdetail->nama_lengkap.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="alamat">Alamat</label></th>
				<td><input name="alamat" type="text" id="alamat" value="'.$userdetail->alamat.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="kota">Kota</label></th>
				<td><input name="kota" type="text" id="kota" value="'.$userdetail->kota.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="kode_pos">Kode Pos</label></th>
				<td><input name="kode_pos" type="text" id="kode_pos" value="'.$userdetail->kode_pos.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="negara">Negara</label></th>
				<td><input name="negara" type="text" id="negara" value="'.$userdetail->negara.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="telepon">Telepon</label></th>
				<td><input name="telepon" type="text" id="telepon" value="'.$userdetail->telepon.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="fax">Fax</label></th>
				<td><input name="fax" type="text" id="fax" value="'.$userdetail->fax.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="email">Email</label></th>
				<td><input name="email" type="text" id="email" value="'.$userdetail->email.'" class="regular-text" />
				<span class="description">Masukkan email address yang valid</span></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="password">Password</label></th>
				<td><input name="password" type="password" id="password" value="'.$userdetail->password.'" class="regular-text" /></td>
			</tr>
			</table>
			
		
			<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"/></p></form>
			';
	}
	$html .= '</div>';
	return $html;
}

function changeprofile(){

	global $post, $hkibcomm_settings;
   	if (is_singular()) :
   		$current_url = get_permalink($post->ID);
   	else :
   		$pageURL = 'http';
   		if ($_SERVER["HTTPS"] == "on") $pageURL .= "s";
   		$pageURL .= "://";
   		if ($_SERVER["SERVER_PORT"] != "80") $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
   		else $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
   		$current_url = $pageURL;
   	endif;		
	$redirect = $current_url;

	ob_start();
	
		// show any error messages after form submission
		hkibcomm_show_error_messages('password'); ?>
		
		<?php if(isset($_GET['password-updated']) && $_GET['password-updated'] == 'true') { ?>
			<div id="stylized3" class="myform3">
				<span><?php _e('Password changed successfully', 'rcp'); ?></span>
			</div>
		<?php } ?>
		<div id="stylized3" class="myform3">
		<form id="hkibcomm_password_form" method="POST" action="<?php echo $current_url; ?>">
			
				<h1><?php _e('Change Your Password', 'hkibcomm'); ?></h1>
					
					<label for="hkibcomm_user_pass"><?php _e('New Password', 'rcp'); ?></label>
					<input name="hkibcomm_user_pass" id="hkibcomm_user_pass" class="required" type="password"/> 
		
					<label for="hkibcomm_user_repass"><?php _e('Password Confirm', 'rcp'); ?></label>
					<input name="hkibcomm_user_repass" id="hkibcomm_user_repass" class="required" type="password"/>
			
					<input type="hidden" name="hkibcomm_action" value="change-password"/>
					<input type="hidden" name="hkibcomm_redirect" value="<?php echo $redirect; ?>"/>
					<input type="hidden" name="hkibcomm_password_nonce" value="<?php echo wp_create_nonce('rcp-password-nonce'); ?>"/>
					<button type="submit" id="hkibcomm_login_submit" value="<?php _e('Update', 'hkibcomm'); ?>">Update</button>
			
		</form>
		</div>
		<style type="text/css">
	p, h1, form, button,{border:0; margin:0; padding:0;}
	
	.spacer{clear:both; height:1px;}
	
	.myform3{
	margin:0 auto;
	width:400px;
	padding:14px;
	}

	
	#stylized3{
	border:solid 2px #b7ddf2;
	background:#ebf4fb;
	}
	#stylized3 h1 {
	font-size:14px;
	font-weight:bold;
	margin-bottom:8px;
	}
	#stylized3 p{
	font-size:11px;
	color:#666666;
	margin-bottom:20px;
	border-bottom:solid 1px #b7ddf2;
	padding-bottom:10px;
	}
	#stylized3 label{
	display:block;
	font-weight:bold;
	text-align:right;
	width:140px;
	float:left;
	}
	#stylized3 .small{
	color:#666666;
	display:block;
	font-size:11px;
	font-weight:normal;
	text-align:right;
	width:140px;
	}
	#stylized3 input{
	float:left;
	font-size:12px;
	padding:4px 2px;
	border:solid 1px #aacfe4;
	width:200px;
	margin:2px 0 20px 10px;
	}
	#stylized3 button{
	clear:both;
	margin-left:150px;
	width:96px;
	height:32px;
	border: 0px;
	background:url("http://www.daftarhaki.com/wp-content/uploads/2012/04/button1.png") no-repeat;
	background-color:Transparent;
	text-align:center;
	color:#FFFFFF;
	font-size:11px;
	font-weight:bold;
	}
	</style>
	<?php
	return ob_get_clean();	
}