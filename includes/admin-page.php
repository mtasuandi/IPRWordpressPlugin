<?php
/*
//----- create menu start
*/
function hkibcomm_settings_menu() {
	global $hkibcomm_admin_page;
	
	$hkibcomm_admin_page = add_menu_page('Admin HAKI', 'Admin HAKI', 'manage_options', 'haki_member', 'haki_member', plugins_url('hki/images/icon.png'));
	$hkibcomm_admin_page = add_submenu_page('haki_member', 'Member', 'Member', 'manage_options', 'haki_member', 'haki_member');
	$hkibcomm_admin_page = add_submenu_page('haki_member', 'Add Member', 'Add Member',  'manage_options', 'add_member', 'add_member');
	//$hkibcomm_admin_page = add_submenu_page('haki_member', 'Tab', 'Tab',  'manage_options', 'inibuat_tab', 'inibuat_tab');
	$hkibcomm_admin_page = add_submenu_page('haki_member', 'Status Log', 'Status Log',  'manage_options', 'modify_statuslog', 'modify_statuslog');
	$hkibcomm_admin_page = add_submenu_page('haki_member', 'Upload', 'Upload',  'manage_options', 'upload_meneh', 'upload_meneh');
	$hkibcomm_admin_page = add_submenu_page('haki_member', 'Ini Upload', 'Ini Upload',  'manage_options', 'ini_upload', 'ini_upload');
	
	$hkibcomm_admin_page = add_submenu_page('haki_member', 'Setting', 'Setting',  'manage_options', 'haki_setting', 'hkibcomm_admin_page');

}
add_action('admin_menu', 'hkibcomm_settings_menu'); 
//*/
// function menu_admin(){
// global $hkibcomm_admin_page;
// $hkibcomm_admin_page = add_menu_page('Admin HAKI', 'Admin HAKI', 'administrator', 'manage_options_admin', 'haki_admin', 'haki_member', plugins_url('hki/images/icon.png'));
// $hkibcomm_admin_page = add_submenu_page('haki_admin', 'Member', 'Member', 'administrator', 'manage_options_admin', 'haki_member');
// $hkibcomm_admin_page = add_submenu_page('haki_admin', 'Add Member', 'Add Member', 'administrator', 'manage_options_admin', 'add_member');
// $hkibcomm_admin_page = add_submenu_page('haki_admin', 'Status Log', 'Status Log', 'administrator', 'manage_options_admin', 'status_log');
// $hkibcomm_admin_page = add_submenu_page('haki_admin', 'Upload', 'Upload', 'administrator', 'manage_options_admin', 'upload_gan');
// $hkibcomm_admin_page = add_submenu_page('haki_admin', 'Setting', 'Setting', 'administrator', 'manage_options_admin', 'haki_setting');

// }
// add_action('admin_menu', 'menu_admin');


// function menu_user() {
	// add_menu_page('Admin HAKI', 'Admin HAKI', 'subscriber', 'manage_options_user', 'haki_member', plugins_url('hki/images/icon.png'));
	// add_submenu_page( 'custompage', 'My Custom Submenu Page', 'My Custom Submenu Page', 'subscriber','manage_options_user', 'my_custom_submenu_page_callback' ); 
// }
// add_action('admin_menu', 'menu_user');

// function my_custom_submenu_page_callback() {
	// echo '<h3>My Custom Submenu Page</h3>';

// }

//----- create menu end

//LOG STATUS START
function status_log(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	$username = $_GET['username'];
	$res = $wpdb->get_results('select * from wp_logstatus where username="$username"');
	$restab = '';$tabbol = 0;

	foreach ($res as $val){
		$restab .= '<tr '.(($tabbol & 1)?'class="alternate"':'').'>
				<td><input type="checkbox"/></td>
				<td>'.$val->dtm.'</td>
				<td>'.$val->status.'</td>
				<td>'.$val->descr.'</td>
				<td>'.$val->other.'</td>
			</tr>';
		$tabbol++;
	}

	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Status Log</h2><br />';
	$html .='
			<table rel="" id="" cellspacing="0" class="widefat">
			<thead>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column" scope="col">Date Time</th>
				<th class="manage-column" scope="col">Status</th>
				<th class="manage-column" scope="col">Desc</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column" scope="col">Date Time</th>
				<th class="manage-column" scope="col">Status</th>
				<th class="manage-column" scope="col">Desc</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</tfoot>
			<tbody>
			'.$restab.'
			</tbody>
			</table>
			';
	
	echo $html;
	echo "Ini Status Log lho... :mahos";
}
function Log2(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;

	$query = "INSERT INTO wp_statuslog (created_date, status, ket)
			VALUE (date('D, j M Y G:i:s'), '2', 'Menunggu Kelengkapan Dokumen'
			WHERE
			username = '".$_GET['username']."'
			";
	$wpdb=($query);
}

function Log3(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;

	$query = "INSERT INTO wp_statuslog (created_date, status, ket)
			VALUE (date('D, j M Y G:i:s'), '3', 'Proses Pendaftaran HAKI'
			WHERE
			username = '".$_GET['username']."'
			";
	$wpdb=($query);
}

// LOG STATUS END
function add_member(){
	
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
		
			$sql = "insert into wp_member (created_date, username, nama_lengkap, alamat, kota, kode_pos, negara, telepon, fax, email, password) 
					values(now(),'".$_POST['sel_username']."','".$_POST['nama_lengkap']."','".$_POST['alamat']."','".$_POST['kota']."','".$_POST['kode_pos']."','".$_POST['negara']."','".$_POST['telepon']."','".$_POST['fax']."','".$_POST['email']."','".$_POST['password']."');";
   			$wpdb->query($sql);
			
			$user_login 	= $_POST['new_username']; 
			$user_fullname	= $_POST['nama_lengkap'];
			$user_address 	= $_POST['alamat'];
			$user_city		= $_POST['kota'];
			$user_zipcode	= $_POST['kode_pos'];
			$user_country	= $_POST['negara'];
			$user_telephone = $_POST['telepon'];
			$user_fax		= $_POST['fax'];
			$user_email		= $_POST['email'];
			$user_pass		= $_POST['password'];
			
			wp_insert_user(array(
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
			
			echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify'.'"</script>' ;
   			exit;	
		}
	}

	$user = '';$sel_default = '';
	$res = $wpdb->get_results( "SELECT * FROM wp_users" );
	foreach ($res as $val){
		if ($_POST['sel_username'] == $val->user_login) {$sel_default = ' selected ';}else{$sel_default = '';}
		$user .= '<option value="'.$val->user_login.'" '.$sel_default.'>'.$val->user_nicename.'</option>';
	}

	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Add Member HAKI</h2><br />';

	if ($errmsg != '') $html .= $errmsg;

	$html .= '<form method="post" action="?page=add_member">
			
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

			<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"  /></p>

			';
	echo $html;

} 
// <td><strong><a href="?page=haki_member&act=modify&username='.$val->username.'">'.$val->username.'</a></strong></td>
function haki_member(){
	
	global $hkibcomm_settings, $wpdb;

	$res = $wpdb->get_results('select * from wp_member');
	$restab = '';$tabbol = 0;

	foreach ($res as $val){
		$restab .= '<tr '.(($tabbol & 1)?'class="alternate"':'').'>
				<td><input type="checkbox"/></td>
				<td><strong><a href="?page=haki_member&act=view_member&username='.$val->username.'">'.$val->username.'</a></strong></td>
				<td>'.$val->nama_lengkap.'</td>
				<td>'.$val->email.'</td>
				<td>'.$val->telepon.'</td>
			</tr>';
		$tabbol++;
	}

	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Member<a href="?page=add_member" class="add-new-h2">Add Member</a></h2><br />';
	$html .= '<div class="tablenav">
		<div class="alignleft actions">
			<select name="groupAction">
				<option value="-1">Username</option>
				<option value="-1">Register Date</option>
			</select>
			<input type="submit" class="button-secondary action" id="doaction" name="doaction" value="Short"/>
		</div>
		<div class="tablenav-pages">
			<input type="text" value="" />
			<input type="submit" class="button-secondary action" id="searchusername" name="searchusername" value="Search Username"/>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>';

	$html .= '<table rel="" id="" cellspacing="0" class="widefat">
			<thead>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column" scope="col">Username</th>
				<th class="manage-column" scope="col">Nama Lengkap</th>
				<th class="manage-column column-image" scope="col">Email</th>
				<th class="manage-column" scope="col">Telepon</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column" scope="col">Username</th>
				<th class="manage-column" scope="col">Nama Lengkap</th>
				<th class="manage-column column-image" scope="col">Email</th>
				<th class="manage-column" scope="col">Telepon</th>
			</tr>
			</tfoot>
			<tbody>
			'.$restab.'
			</tbody>
		</table>';

		$html .= '<div class="tablenav">
					<div class="alignleft actions">
					</div>
					<div class="tablenav-pages">
						<span class="displaying-num">Showing 1-10 of 2</span>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>';
		$html .= '</div>';
		
		//$html .= '<a href="?page=add_member" class="add-new-h2">Add Member</a>';

		if ($_GET['act']=='modify_member'){
			$html = modify_member();	
		} else if($_GET['act']=='add_haki'){
			$html = add_haki();
		} else if($_GET['act']=='modify_haki'){
			$html = modify_haki();
		} else if($_GET['act']=='delete_haki'){
			return delete_haki();
		} else if($_GET['act']=='delete_member'){
			return delete_member();
		} else if($_GET['act']=='view_member'){
			$html = view_member_haki();
		} else if($_GET['act']=='add_paten'){
			$html = add_paten();
		} else if($_GET['act']=='modify_paten'){
			$html = modify_paten();
		} else if($_GET['act']=='add_hakcipta'){
			$html = add_hakcipta();
		} else if($_GET['act']=='modify_hakcipta'){
			$html = modify_hakcipta();
		} else if($_GET['act']=='add_desainindustri'){
			$html = add_desainindustri();
		} else if($_GET['act']=='modify_desainindustri'){
			$html = modify_desainindustri();
		} else if($_GET['act']=='add_indikasigeo'){
			$html = add_indikasigeo();
		} else if($_GET['act']=='modify_indikasigeo'){
			$html = modify_indikasigeo();
		} else if($_GET['act']=='view_merek'){
			$html = view_merek();
		} else if($_GET['act']=='view_paten'){
			$html = view_paten();
		} else if($_GET['act']=='view_hakcipta'){
			$html = view_hakcipta();
		} else if($_GET['act']=='view_desainindustri'){
			$html = view_desainindustri();
		} else if($_GET['act']=='view_indikasigeo'){
			$html = view_indikasigeo();
		} else if($_GET['act']=='view_list_haki'){
			$html = view_list_haki();
		}
		
		echo $html;	
}

function delete_haki(){
	
	global $wpdb, $hkibcomm_settings;
	$wpdb->query(
	"
	DELETE FROM wp_haki 
	WHERE id ='".$_GET['id']."'
	"
	);
	// echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify'.'"</script>' ;
   	// exit;
}

function delete_member(){
	global $wpdb, $hkibcomm_settings;
	// ".$_GET['username']."
	$wpdb->query("DELETE FROM wp_member WHERE username ='".$_GET['username']."'");
	echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify'.'"</script>' ;
   	exit;
}

function view_member_haki(){
	
	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	// 
	$userdetails = $wpdb->get_results ('SELECT * from wp_member where username="'.$_GET['username'].'"');
	
	foreach ( $userdetails as $userdetail ){
	
	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Member<p/>
	<a href="?page=haki_member&act=modify_member&username='.$_GET['username'].'" class="add-new-h2">Modify Member</a></h2><br />';

	$html .= '<form method="post" action="?page=haki_member&act=modify&username='.$_GET['username'].'">
			
			<table class="form-table" >
			<tr valign="top">
				<th scope="row"><label for="username">Username</label></th>
				<td><input disabled name="username" type="text" id="username" value="'.$userdetail->username.'" class="regular-text" /></td>
				
				<th scope="row"><label for="telepon">Telepon</label></th>
				<td><input disabled name="telepon" type="text" id="telepon" value="'.$userdetail->telepon.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="nama_lengkap">Nama Lengkap</label></th>
				<td><input disabled name="nama_lengkap" type="text" id="nama_lengkap" value="'.$userdetail->nama_lengkap.'" class="regular-text" /></td>
				
				<th scope="row"><label for="email">Email Address</label></th>
				<td><input disabled name="email" type="text" id="email"  value="'.$userdetail->email.'" class="regular-text" />
				</td>
			</tr>
			</table>
			</form>
			';
	}
	// $html .= '<p><p><p><a href="?page=haki_member&act=add_haki&username='.$_GET['username'].'" class="add-new-h2">Add Merek</a>
	// <a href="?page=haki_member&act=add_paten&username='.$_GET['username'].'" class="add-new-h2">Add Paten</a>
	// <a href="?page=haki_member&act=add_hakcipta&username='.$_GET['username'].'" class="add-new-h2">Add Hak Cipta</a>  
	// <a href="?page=haki_member&act=add_desainindustri&username='.$_GET['username'].'" class="add-new-h2">Add Desain Industri</a>  
	// <a href="?page=haki_member&act=add_indikasigeo&username='.$_GET['username'].'" class="add-new-h2">Add Indikasi Geografis</a>';
	
	// $html .= view_merek();
	// $html .= view_paten();
	// $html .= view_hakcipta();
	// $html .= view_desainindustri();
	// $html .= view_indikasigeo();
	$html .= view_list_haki();

	$html .= '</div>';

	return $html;
	
}
/*
SELECT p.nama_pemohon, pk.nama_pemohon
FROM wp_haki p
INNER JOIN wp_hakcipta pk ON p.username = pk.username

*/
function view_list_haki(){

	global $hkibcomm_settings, $wpdb;
			
			$quer = "SELECT *
					 FROM wp_haki a INNER JOIN wp_hakcipta b
					 ON a.username = b.username
					";
			$username = $_GET['username'];	
			$que = "(
					SELECT id, jenis, nama_pemohon, kota, nama_merek as ket
					FROM wp_haki
					WHERE username = '$username'
					)
					UNION ( 
					SELECT id, jenis, nama_pemohon, kota, judul_hakcipta as ket
					FROM wp_hakcipta 
					WHERE username='$username'
					)
					UNION ( 
					SELECT id, jenis, nama_pemohon, kota, judul_paten as ket
					FROM wp_paten
					WHERE username='$username'
					)
					UNION (
					SELECT id, jenis, nama_pemohon, kota, judul_desainindustri as ket
					FROM wp_desainindustri
					WHERE username='$username'
					)
					UNION (
					SELECT id, jenis, nama_pemohon, kota, nama_indikasigeo as ket
					FROM wp_indikasigeografis
					WHERE username='$username'
					)";
			$query = $wpdb->get_results($que);

			$asd = $wpdb->get_results('SELECT status from wp_logstatus where username="'.$_GET['username'].'"');
			$restab = '';$tabbol = 0;
			// <strong><a href="?page=haki_member&act=modify_haki&id='.$val->id.'">Modify</a></strong>
			foreach ($query as $val){
				
				$restab .= '<tr '.(($tabbol & 1)?'class="alternate"':'').'>
						<td><input type="checkbox"/></td>
						<td><strong><a href="?page=haki_member&act=modify_haki&id='.$val->id.'">'.$val->jenis.'</a></strong></td>
						<td>'.$val->nama_pemohon.'</td>
						<td>'.$val->ket.'</td>';
						$restab .='<td>'.$val->status.'</td>';
						$restab .='</tr>';
						
				$tabbol++;
				
			}
	
	//$html = '<div id="icon-options-general" class="icon32"><br /></div><h2>List HAKI</h2><br />';
	// <a href="?page=haki_member&act=add_haki&username='.$_GET['username'].'" class="add-new-h2">Add HAKI</a>
	
	// link buat modify
	/*
	  <a href="?page=haki_member&act=modify_haki&id='.$_GET['id'].'" class="add-new-h2">Modify HAKI</a>
	  <a href="?page=haki_member&act=modify_paten&id='.$_GET['id'].'" class="add-new-h2">Modify Paten</a>
	  <a href="?page=haki_member&act=modify_hakcipta&id='.$_GET['id'].'" class="add-new-h2">Modify Hak Cipta</a>
	  <a href="?page=haki_member&act=modify_desainindustri&id='.$_GET['id'].'" class="add-new-h2">Modify Desain Industri</a>
	  <a href="?page=haki_member&act=modify_indikasigeo&id='.$_GET['id'].'" class="add-new-h2">Modify Indikasi Geografis</a></h2><p />
	*/
	
	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Daftar HAKI<p />
	<a href="?page=haki_member&act=add_haki&username='.$_GET['username'].'" class="add-new-h2">Add Merek</a>
	<a href="?page=haki_member&act=add_paten&username='.$_GET['username'].'" class="add-new-h2">Add Paten</a>
	<a href="?page=haki_member&act=add_hakcipta&username='.$_GET['username'].'" class="add-new-h2">Add Hak Cipta</a>  
	<a href="?page=haki_member&act=add_desainindustri&username='.$_GET['username'].'" class="add-new-h2">Add Desain Industri</a>  
	<a href="?page=haki_member&act=add_indikasigeo&username='.$_GET['username'].'" class="add-new-h2">Add Indikasi Geografis</a> 
<a href="?page=haki_member&act=view_merek&username='.$_GET['username'].'" class="add-new-h2">View Merek</a> 	
	';
	
	$html .= '<table rel="" id="" cellspacing="0" class="widefat">
			<thead>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column" scope="col">Jenis</th>
				<th class="manage-column column-image" scope="col">Nama Pemohon</th>
				<th class="manage-column" scope="col">Keterangan</th>
				<th class="manage-column" scope="col">Status Log</th>
				
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column" scope="col">Jenis</th>
				<th class="manage-column column-image" scope="col">Nama Pemohon</th>
				<th class="manage-column" scope="col">Keterangan</th>
				<th class="manage-column" scope="col">Status Log</th>
				
			</tr>
			</tfoot>
			<tbody>
			'.$restab.'
			</tbody>
			</table>
			</p>
			';

	return $html;
}

function modify_haki(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	
	if ($_POST['submit'] == 'Save Changes'){
	
		$wpdb->query("
			UPDATE wp_haki
			SET nama_pemohon='".$_POST['nama_pemohon']."', alamat_pemohon='".$_POST['alamat_pemohon']."', 
				kota='".$_POST['kota']."', kode_pos='".$_POST['kode_pos']."', negara='".$_POST['negara']."', 
				telepon='".$_POST['telepon']."', fax='".$_POST['fax']."', nama_merek='".$_POST['nama_merek']."', 
				warna_merek='".$_POST['warna_merek']."', arti_merek='".$_POST['arti_merek']."', 
				barang_registered='".$_POST['barang_registered']."', etiket_merek='".$_POST['etiket_merek']."'
			WHERE id='".$_GET['id']."'
			");
		
		// start upload files
			if(!empty($_FILES['etiket_merek']['tmp_name']))
			{			
			$overrides = array('test_form' => false);
    		wp_handle_upload($_FILES['etiket_merek'], $overrides);
			}
			// end upload files
			
		//echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify'.'"</script>';
		//echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify'.'"</script>' ;
		echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=view_member'.'"</script>' ;
   		//echo "saved";
		exit;
	}
	
	$userdata = $wpdb->get_results ('SELECT * from wp_haki WHERE id="'.$_GET['id'].'"');
	foreach ($userdata as $users){
	
		$html  = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Modify HAKI</h2><br />';
		$html .= '<form method="post" action="?page=haki_member&act=modify_haki&id='.$_GET['id'].'" enctype="multipart/form-data">
				  <table class="form-table">
				  <tr valign="top">
				  <th scope="row"><label for="nama_pemohon">Nama Pemohon</label></th>
				  <td><input name="nama_pemohon" type="text" id="nama_pemohon" value="'.$users->nama_pemohon.'" class="regular-text" /></td>
			      </tr>
					<tr valign="top">
					<th scope="row"><label for="alamat_pemohon">Alamat Pemohon</label></th>
					<td><input name="alamat_pemohon" type="text" id="alamat_pemohon" value="'.$users->alamat_pemohon.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kota">Kota</label></th>
					<td><input name="kota" type="text" id="kota" value="'.$users->kota.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kode_pos">Kode Pos</label></th>
					<td><input name="kode_pos" type="text" id="kode_pos" value="'.$users->kode_pos.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="negara">Negara</label></th>
					<td><input name="negara" type="text" id="negara" value="'.$users->negara.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="telepon">Telepon</label></th>
					<td><input name="telepon" type="text" id="telepon" value="'.$users->telepon.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="fax">Fax</label></th>
					<td><input name="fax" type="text" id="fax" value="'.$users->fax.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="nama_merek">Nama Merek</label></th>
					<td><input name="nama_merek" type="text" id="nama_merek" value="'.$users->nama_merek.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="warna_merek">Warna Merek</label></th>
					<td><input name="warna_merek" type="text" id="warna_merek" value="'.$users->warna_merek.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="arti_merek">Arti Merek</label></th>
					<td><input name="arti_merek" type="text" id="arti_merek" value="'.$users->arti_merek.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="barang_registered">Jenis Barang</label></th>
					<td><input name="barang_registered" type="text" id="barang_registered" value="'.$users->barang_registered.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="etiket_merek">Etiket Merek</label></th>
					<td><input name="etiket_merek" type="file" id="etiket_merek" value="'.$users->etiket_merek.'" /><small>Allowed type: pdf, doc, png, jpg and jpeg.</small></td>
					</tr>
					</table>
					<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes" /> <a href="'.$_SERVER['HTTP_REFERER'].'" class="add-new-h2">Go back</a></p>
		';
	}
	$html .= '</div>';
	return $html;
	
}
function modify_member(){

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
	$html .= '<form method="post" action="?page=haki_member&act=modify_member&username='.$_GET['username'].'">
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
// <a href="'.$_SERVER['HTTP_REFERER'].'" class="add-new-h2">Go back</a> back button
}


function modify_haki2(){
	
	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	
	if ($_POST['submit'] == 'Save Changes'){
	$sql = "UPDATE wp_haki
			SET nama_pemohon='".$_POST['nama_pemohon']."', alamat_pemohon='".$_POST['alamat_pemohon']."', kota='".$_POST['kota']."', kode_pos='".$_POST['kode_pos'].", negara='".$_POST['negara']."', telepon='".$_POST['telepon']."', fax='".$_POST['fax']."', nama_merek='".$_POST['nama_merek']."', warna_merek='".$_POST['warna_merek']."', arti_merek='".$_POST['arti_merek']."', barang_registered='".$_POST['barang_registered']."', etiket_merek='".$_POST['etiket_merek']."'
			WHERE username='".$_GET['username']."'
			";
			
   			$wpdb->query($sql);
	}
	//$user_info = get_userdata(1);
	//$id = $wpdb->get_results('SELECT id FROM wp_member');
	$abc = $wpdb->get_results ('SELECT * from wp_haki WHERE username="'.$_GET['username'].'"');

	foreach ( $abc as $abcd ) 
	{
		//echo $userdetail->post_title;
	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br/>
			 </div><h2>Modify HAKI</h2><br/>';

	$html .= '<form method="post" action="?page=haki_member&act=modify_haki&username='.$_GET['username'].'">
			
			<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="username">Username</label></th>
				<td><input disabled name="username" type="text" id="username" value="'.$abcd->nama_pemohon.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="nama_lengkap">Nama Lengkap</label></th>
				<td><input name="nama_lengkap" type="text" id="nama_lengkap" value="'.$abcd->alamat_pemohon.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="kota">Kota</label></th>
				<td><input name="kota" type="text" id="kota" value="'.$abcd->kota.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="kode_pos">Kode Pos</label></th>
				<td><input name="kode_pos" type="text" id="kode_pos" value="'.$abcd->kode_pos.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="negara">Negara</label></th>
				<td><input name="negara" type="text" id="negara" value="'.$abcd->negara.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="telepon">Telepon</label></th>
				<td><input name="telepon" type="text" id="telepon" value="'.$abcd->telepon.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="fax">Faksimili</label></th>
				<td><input name="fax" type="text" id="fax" value="'.$abcd->fax.'" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="nama_merek">Nama Merek</label></th>
				<td><input name="nama_merek" type="text" id="nama_merek"  value="'.$abcd->nama_merek.'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="warna_merek">Warna Merek</label></th>
				<td><input name="warna_merek" type="text" id="warna_merek"  value="'.$abcd->warna_merek.'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="arti_merek">Arti Merek</label></th>
				<td><input name="arti_merek" type="text" id="arti_merek"  value="'.$abcd->arti_merek.'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="barang_registered">Jenis Barang / Jasa yang Diinginkan</label></th>
				<td><input name="barang_registered" type="text" id="barang_registered"  value="'.$abcd->barang_registered.'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="etiket_merek">Etiket Merek</label></th>
				<td><input name="etiket_merek" type="text" id="etiket_merek"  value="'.$abcd->etiket_merek.'" class="regular-text" />
			</tr>
			</table>
			<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes" /></p>';
	}
	$html .= '</div>';
	return $html;
}


function list_haki() {

	global $hkibcomm_settings, $wpdb;

			$res = $wpdb->get_results('select * from wp_haki where username="'.$_GET['username'].'"');
			//$res2 = $wpdb->get_results('select * from wp_member where username="'.$_GET['username'].'"');
			$res2 = $wpdb->get_results('SELECT * from wp_member where username="'.$_GET['username'].'"');
			$asd = $wpdb->get_results('SELECT status from wp_logstatus');
			$restab = '';$tabbol = 0;

			foreach ($res as $val){
				$restab .= '<tr '.(($tabbol & 1)?'class="alternate"':'').'>
						<td><input type="checkbox"/></td>
						<td>'.$val->jenis.'</td>
						<td>'.$val->nama_pemohon.'</td>
						<td>'.$val->nama_merek.'</td>
						<td>'.$val->status.'</td>
						<td><strong><a href="?page=haki_member&act=modify_haki&id='.$val->id.'">Modify</a></strong></td>
						</tr>';
				$tabbol++;
				
			}
	
	//$html = '<div id="icon-options-general" class="icon32"><br /></div><h2>List HAKI</h2><br />';
	// <a href="?page=haki_member&act=add_haki&username='.$_GET['username'].'" class="add-new-h2">Add HAKI</a>
	
	// link buat modify
	/*
	  <a href="?page=haki_member&act=modify_haki&id='.$_GET['id'].'" class="add-new-h2">Modify HAKI</a>
	  <a href="?page=haki_member&act=modify_paten&id='.$_GET['id'].'" class="add-new-h2">Modify Paten</a>
	  <a href="?page=haki_member&act=modify_hakcipta&id='.$_GET['id'].'" class="add-new-h2">Modify Hak Cipta</a>
	  <a href="?page=haki_member&act=modify_desainindustri&id='.$_GET['id'].'" class="add-new-h2">Modify Desain Industri</a>
	  <a href="?page=haki_member&act=modify_indikasigeo&id='.$_GET['id'].'" class="add-new-h2">Modify Indikasi Geografis</a></h2><p />
	*/
	
	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>List HAKI<p />
	<a href="?page=haki_member&act=add_haki&username='.$_GET['username'].'" class="add-new-h2">Add HAKI</a>
	<a href="?page=haki_member&act=add_paten&username='.$_GET['username'].'" class="add-new-h2">Add Paten</a>
	<a href="?page=haki_member&act=add_hakcipta&username='.$_GET['username'].'" class="add-new-h2">Add Hak Cipta</a>  
	<a href="?page=haki_member&act=add_desainindustri&username='.$_GET['username'].'" class="add-new-h2">Add Desain Industri</a>  
	<a href="?page=haki_member&act=add_indikasigeo&username='.$_GET['username'].'" class="add-new-h2">Add Indikasi Geografis</a>  
	
	';
	$html .= '<table rel="" id="" cellspacing="0" class="widefat">
			<thead>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column" scope="col">Jenis Hak</th>
				<th class="manage-column column-image" scope="col">Nama Pemohon</th>
				<th class="manage-column" scope="col">Nama Merek</th>
				<th class="manage-column" scope="col">Status Log</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</thead>

			<tfoot>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column" scope="col">Jenis Hak</th>
				<th class="manage-column column-image" scope="col">Nama Pemohon</th>
				<th class="manage-column" scope="col">Nama Merek</th>
				<th class="manage-column" scope="col">Status Log</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</tfoot>
			<tbody>
			'.$restab.'
			</tbody>
			</table>
			</p>
			';

	return $html;	
}


//--------------------------------------------

function add_haki(){
	
	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	
	$errmsg = '';
	
	if ($_POST['submit'] == 'Save Changes'){
		
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
		//if ($_POST['etiket_merek'] == ''){ $errmsg = '<div id="message" class="updated"><p>Etiket Merek harus diisi.</p></div>'; }
		

		if ($errmsg == ''){
			$sql = "insert into wp_haki (created_date, 
											jenis, 
											nama_pemohon, 
											alamat_pemohon, 
											kota, 
											kode_pos, 
											negara, 
											telepon, 
											fax, 
											nama_merek, 
											warna_merek, 
											arti_merek, 
											barang_registered, 
											etiket_merek,
											username) 
					values(
					now(),
					'Merek',
					'".$_POST['nama_pemohon']."',
					'".$_POST['alamat_pemohon']."',
					'".$_POST['kota']."',
					'".$_POST['kode_pos']."',
					'".$_POST['negara']."',
					'".$_POST['telepon']."',
					'".$_POST['fax']."',
					'".$_POST['nama_merek']."',
					'".$_POST['warna_merek']."',
					'".$_POST['arti_merek']."',
					'".$_POST['barang_registered']."',
					'".$_POST['etiket_merek']."',
					'".$_GET['username']."'
					)";
   			
			$wpdb->query($sql);
			
			$sql2 = "INSERT INTO wp_logstatus (created_date, status, ket, username) VALUES (now(), '1', 'Menunggu Pembayaran', '".$_GET['username']."');";
			$wpdb->query($sql2);
			
			// start upload files
			if(!empty($_FILES['etiket_merek']['tmp_name']))
			{			
			$overrides = array('test_form' => false, 'mimes' => array('pdf' => 'application/pdf' , 'jpg' => 'image/jpeg' , 'png' => 'image/png' , 'jpeg' => 'image/jpeg' , 'doc' => 'application/msword'));
    
    		wp_handle_upload($_FILES['etiket_merek'], $overrides);
			}
			// end upload files
			
			// start function send email
			   $attachments = array(WP_CONTENT_DIR . '/uploads/document/SURAT-KUASA-SURAT-PERNYATAAN-MEREK-2012.doc');
			   $qq = $wpdb->get_results('SELECT email from wp_member WHERE username="'.$_GET['username'].'"');
			   $headers = 'From: DaftarHaki.com <info@daftarhaki.com>' . "\r\n";
			   foreach($qq as $val){
			   $to = array($val->email,'teguh@nomadentech.net');
			   }
			   $subject = 'Pendaftaran HAKI';
			   $message = 'Ini test email :mahos';
			   wp_mail($to, $subject, $message, $headers, $attachments);
		    // end function send email
			
   			//wp_redirect( get_bloginfo('url').'/wp-admin/admin.php?page=haki_member&act=modify_member'); ".$_GET['username']."
   			echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify&username='.$_GET['username'].''.'"</script>' ;
   			exit;
		}
	}

	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Tambah Merek</h2><br />';

	if ($errmsg != '') $html .= $errmsg;

	$html .= '<form method="post" action="?page=haki_member&act=add_haki&username='.$_GET['username'].'" enctype="multipart/form-data">
			
			<table class="form-table">
			
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
				
				<td><input name="etiket_merek" type="file" id="etiket_merek"  value="'.$_POST['etiket_merek'].'"/><small> Allowed type: pdf, doc, png, jpg and jpeg.</small>
			</tr>
			</table>

			<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"  /></p>

			';
	echo $html;

}

//--------------------------------------------
function hkibcomm_admin_page(){

	global $hkibcomm_settings;
	ob_start(); ?>
	<div>
		<h1>Administrator HKI BComm</h1>
		<br>
		Untuk menambahkan pada pages:</br>
		<ol>
		<li><b>[hkibcomm_register_form]</b> Untuk menambahkan Form Register pada Pages.</li>
		<li><b>[hkibcomm_login_form]</b> Untuk menambahkan Form Login pada Pages.</li>
		<li><b>[hkibcomm_reset_password_form]</b> Untuk menambahkan Form Reset Password pada Pages.</li>
		</ol>
		
	</div>
	
	<div>
		<form method="post" action="options.php">
		
			<?php settings_fields('hkibcomm_settings_group'); ?>
		
			<?php $pages = get_pages(array('post_status' => array('publish', 'private'))); ?>
			
			<h4><?php _e('Redirect', 'hkibcomm'); ?></h4>
			<p>
				<select id="hkibcomm_settings[redirect]" name="hkibcomm_settings[redirect]">
					<?php
					if($pages) :
						foreach ( $pages as $page ) {
						  	$option = '<option value="' . $page->ID . '" ' . selected($page->ID, $hkibcomm_settings['redirect'], false) . '>';
							$option .= $page->post_title;
							$option .= '</option>';
							echo $option;
						}
					else :
						echo '<option>' . __('No pages found', 'hkibcomm') . '</option>';
					endif;
					?>
				</select>
				<div class="description"><?php _e('Pages untuk redirect setelah register', 'hkibcomm'); ?></div>
			</p>
		
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Options', 'hkibcomm'); ?>" />
			</p>
		
		</form>
		
	</div>
	<?php
	echo ob_get_clean();
}

function document_upload() {
    global $post, $hkibcomm_settings;

    $custom         = get_post_custom($post->ID);
    $download_id    = get_post_meta($post->ID, 'document_file_id', true);
	
	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Upload</h2><br />';
    echo $html;
	$act = admin_url('media-upload.php?inline=&amp;upload-page-form=');
	echo '<p><label for="document_file">Upload document:</label><br />';
	echo '<form method="post" action="">';
    echo '<input type="file" name="document_file" id="document_file" /></p>';
	echo '<input id="document_file_button" type="submit" value="Upload" />';
    echo '</form></p>';

    if(!empty($download_id) && $download_id != '0') {
        echo '<p><a href="' . wp_get_attachment_url($download_id) . '">
            View document</a></p>';
    }
	
	if($_POST['submit']=='Upload') {
	
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');
        $file   = $_FILES['document_file'];
        $upload = wp_handle_upload($file, array('test_form' => true), null);
        if(!isset($upload['error']) && isset($upload['file'])) {
            $filetype   = wp_check_filetype(basename($upload['file']), null);
            $title      = $file['name'];
            $ext        = strrchr($title, '.');
            $title      = ($ext !== false) ? substr($title, 0, -strlen($ext)) : $title;
            $attachment = array(
                'post_mime_type'    => $wp_filetype['type'],
                'post_title'        => addslashes($title),
                'post_content'      => '',
                'post_status'       => 'inherit',
                'post_parent'       => $post->ID
            );

            $attach_key = 'document_file_id';
            $attach_id  = wp_insert_attachment($attachment, $upload['file']);
	update_post_meta($post->ID, $attach_key, $attach_id);
	}
	}
}
/*
function upload_gan(){

	if($_POST['submit']== 'Upload') {
	
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	
        $file   = $_FILES['document_file'];
        $upload = wp_handle_upload($file, array('test_form' => false));
        if(!isset($upload['error']) && isset($upload['file'])) {
            $filetype   = wp_check_filetype(basename($upload['file']), null);
            $title      = $file['name'];
            $ext        = strrchr($title, '.');
            $title      = ($ext !== false) ? substr($title, 0, -strlen($ext)) : $title;
            $attachment = array(
                'post_mime_type'    => $wp_filetype['type'],
                'post_title'        => addslashes($title),
                'post_content'      => '',
                'post_status'       => 'inherit',
                'post_parent'       => $post->ID
            );

            $attach_key = 'document_file_id';
            $attach_id  = wp_insert_attachment($attachment, $upload['file'], );
            $existing_download = (int) get_post_meta($post->ID, $attach_key, true);

            if(is_numeric($existing_download)) {
                wp_delete_attachment($existing_download);
            }

            update_post_meta($post->ID, $attach_key, $attach_id);
        }
    }
				
	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Upload Document</h2><br />';
	
	$html .= '	<form method="post" action="">
				<tr valign="top">
				<th scope="row">Upload</th>
				<td><label for="document_file">
				<input id="document_file" type="file" size="36" name="document_file" value="" />
				<input id="document_file_button" type="submit" value="Upload" />
				</label></td>
				</tr>
				</form>
			';
	echo $html;
	
	
	
}
*/
//------------------------------------------ end uploading file

//--coding @28-march-2012 -- for register other fields :semangka semangat kaka...

function add_paten(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	
	$errmsg = '';
	if ($_POST['submit'] == 'Save Changes'){
		
		if ($_POST['nama_pemohon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Nama Lengkap harus diisi.</p></div>'; }
		if ($_POST['alamat_pemohon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Alamat harus diisi.</p></div>'; }
		if ($_POST['kota'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kota harus diisi.</p></div>'; }
		if ($_POST['kode_pos'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kode Pos harus diisi.</p></div>'; }
		if ($_POST['negara'] == ''){ $errmsg = '<div id="message" class="updated"><p>Negara harus diisi.</p></div>'; }
		if ($_POST['telepon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Telepon harus diisi.</p></div>'; }
		if ($_POST['fax'] == ''){ $errmsg = '<div id="message" class="updated"><p>Fax harus diisi.</p></div>'; }
		if ($_POST['nama_inventor'] == ''){ $errmsg = '<div id="message" class="updated"><p>Nama Inventor harus diisi.</p></div>'; }
		if ($_POST['alamat_inventor'] == ''){ $errmsg = '<div id="message" class="updated"><p>Alamat Inventor harus diisi.</p></div>'; }
		if ($_POST['kota_inventor'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kota Inventor harus diisi.</p></div>'; }
		if ($_POST['kode_pos_inventor'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kode pos Inventor harus diisi.</p></div>'; }
		if ($_POST['negara_inventor'] == ''){ $errmsg = '<div id="message" class="updated"><p>Negara Inventor harus diisi.</p></div>'; }
		if ($_POST['telepon_inventor'] == ''){ $errmsg = '<div id="message" class="updated"><p>Telepon Inventor harus diisi.</p></div>'; }
		if ($_POST['fax_inventor'] == ''){ $errmsg = '<div id="message" class="updated"><p>Fax Inventor harus diisi.</p></div>'; }
		if ($_POST['judul_paten'] == ''){ $errmsg = '<div id="message" class="updated"><p>Judul Paten harus diisi.</p></div>'; }
		if ($_POST['desc_paten'] == ''){ $errmsg = '<div id="message" class="updated"><p>Deskripsi Paten harus diisi.</p></div>'; }
		if ($_POST['gambar_paten'] == ''){ $errmsg = '<div id="message" class="updated"><p>Gambar Paten harus diisi.</p></div>'; }
		if ($_POST['negara_pengajuan'] == ''){ $errmsg = '<div id="message" class="updated"><p>Negara pengajuan harus diisi.</p></div>'; }
		if ($_POST['tanggal_pengajuan'] == ''){ $errmsg = '<div id="message" class="updated"><p>Tanggal pengajuan harus diisi.</p></div>'; }
		if ($_POST['nomor_ptc'] == ''){ $errmsg = '<div id="message" class="updated"><p>Nomor PTC harus diisi.</p></div>'; }
		if ($_POST['bukti_pengajuan'] == ''){ $errmsg = '<div id="message" class="updated"><p>Bukti pengajuan harus diisi.</p></div>'; }
		
		if ($errmsg == ''){
			$sql = "INSERT INTO wp_paten (jenis,
											created_date, 
											nama_pemohon, 
											alamat_pemohon, 
											kota, 
											kode_pos, 
											negara, 
											telepon, 
											fax, 
											nama_inventor, 
											alamat_inventor, 
											kota_inventor, 
											kode_pos_inventor, 
											negara_inventor,
											telepon_inventor,
											fax_inventor,
											judul_paten,
											desc_paten,
											gambar_paten,
											negara_pengajuan,
											tanggal_pengajuan,
											nomor_ptc,
											bukti_pengajuan,
											username) 
					values('Paten',
					now(),
					'".$_POST['nama_pemohon']."',
					'".$_POST['alamat_pemohon']."',
					'".$_POST['kota']."',
					'".$_POST['kode_pos']."',
					'".$_POST['negara']."',
					'".$_POST['telepon']."',
					'".$_POST['fax']."',
					'".$_POST['nama_inventor']."',
					'".$_POST['alamat_inventor']."',
					'".$_POST['kota_inventor']."',
					'".$_POST['kode_pos_inventor']."',
					'".$_POST['negara_inventor']."',
					'".$_POST['telepon_inventor']."',
					'".$_POST['fax_inventor']."',
					'".$_POST['judul_paten']."',
					'".$_POST['desc_paten']."',
					'".$_POST['gambar_paten']."',
					'".$_POST['negara_pengajuan']."',
					'".$_POST['tanggal_pengajuan']."',
					'".$_POST['nomor_ptc']."',
					'".$_POST['bukti_pengajuan']."',
					'".$_GET['username']."'
					);";
   			$wpdb->query($sql);
			
			// start upload files
			if(!empty($_FILES['gambar_paten']['tmp_name']))
			{			
			$overrides = array('test_form' => false, 'mimes' => array('pdf' => 'application/pdf' , 'jpg' => 'image/jpeg' , 'png' => 'image/png' , 'jpeg' => 'image/jpeg' , 'doc' => 'application/msword'));
    
    		wp_handle_upload($_FILES['gambar_paten'], $overrides);
			}
			// end upload files
			
			
			// start function send email
			   $attachments = array(WP_CONTENT_DIR . '/uploads/document/SURAT-KUASA-SURAT-PERNYATAAN-PATEN-2012.doc');
			   $qq = $wpdb->get_results('SELECT email from wp_member WHERE username="'.$_GET['username'].'"');
			   $headers = 'From: DaftarHaki.com <info@daftarhaki.com>' . "\r\n";
			   foreach($qq as $val){
			   $to = array($val->email,'teguh@nomadentech.net','adekurniawan@benang.co.id');
			   }
			   $subject = 'Pendaftaran HAKI';
			   $message = 'Ini test email :mahos';
			   wp_mail($to, $subject, $message, $headers, $attachments);
		    // end function send email
			
			// $sql2 = "INSERT INTO wp_logstatus (dtm, status, descr, other) VALUES (now(), '1', 'Waiting List', 'hki');";
			// $wpdb->query($sql2);
			
   			//wp_redirect( get_bloginfo('url').'/wp-admin/admin.php?page=haki_member&act=modify_member'); ".$_GET['username']."
   			echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify&username='.$_GET['username'].''.'"</script>' ;
   			exit;
		}
	}

	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Add PATEN</h2><br />';

	if ($errmsg != '') $html .= $errmsg;

	$html .= '<form method="post" action="?page=haki_member&act=add_paten&username='.$_GET['username'].'" enctype="multipart/form-data">
			
			<table class="form-table">
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
				<th scope="row"><label for="nama_inventor">Nama Inventor</label></th>
				<td><input name="nama_inventor" type="text" id="nama_inventor"  value="'.$_POST['nama_inventor'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="alamat_inventor">Alamat Inventor</label></th>
				<td><input name="alamat_inventor" type="text" id="alamat_inventor"  value="'.$_POST['alamat_inventor'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="kota_inventor">Kota Inventor</label></th>
				<td><input name="kota_inventor" type="text" id="kota_inventor"  value="'.$_POST['kota_inventor'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="kode_pos_inventor">Kode Pos Inventor</label></th>
				<td><input name="kode_pos_inventor" type="text" id="kode_pos_inventor"  value="'.$_POST['kode_pos_inventor'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="negara_inventor">Negara Inventor</label></th>
				<td><input name="negara_inventor" type="text" id="negara_inventor"  value="'.$_POST['negara_inventor'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="telepon_inventor">Telepon Inventor</label></th>
				<td><input name="telepon_inventor" type="text" id="telepon_inventor"  value="'.$_POST['telepon_inventor'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="fax_inventor">Faksimili Inventor</label></th>
				<td><input name="fax_inventor" type="text" id="fax_inventor"  value="'.$_POST['fax_inventor'].'" class="regular-text" />
			</tr>
						
			<tr valign="top">
				<th scope="row"><label for="judul_paten">Judul Paten</label></th>
				<td><input name="judul_paten" type="text" id="judul_paten"  value="'.$_POST['judul_paten'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for=desc_paten">Deskripsi Paten</label></th>
				<td><input name="desc_paten" type="text" id="desc_paten"  value="'.$_POST['desc_paten'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="gambar_paten">Gambar Paten</label></th>
				<td><input name="gambar_paten" type="file" id="gambar_paten"  value="'.$_POST['gambar_paten'].'"/><small> Allowed type: png, jpg and jpeg.</small>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="negara_pengajuan">Negara Pertama Kali Paten Diajukan Pendaftaran</label></th>
				<td><input name="negara_pengajuan" type="text" id="negara_pengajuan"  value="'.$_POST['negara_pengajuan'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="tanggal_pengajuan">Tanggal Pertama Kali Paten Diajukan Pendaftaran</label></th>
				<td><input name="tanggal_pengajuan" type="text" id="tanggal_pengajuan"  value="'.$_POST['tanggal_pengajuan'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="nomor_ptc">Nomor PTC</label></th>
				<td><input name="nomor_ptc" type="text" id="nomor_ptc"  value="'.$_POST['nomor_ptc'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="bukti_pengajuan">Bukti Pengajuan PTC</label></th>
				<td><input name="bukti_pengajuan" type="text" id="bukti_pengajuan"  value="'.$_POST['bukti_pengajuan'].'" class="regular-text" />
			</tr>
			</table>

			<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"  /></p>

			';
	echo $html;
}

function add_hakcipta(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	
	$errmsg = '';
	if ($_POST['submit'] == 'Save Changes'){
		
		if ($_POST['nama_pemohon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Nama Lengkap harus diisi.</p></div>'; }
		if ($_POST['alamat_pemohon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Alamat harus diisi.</p></div>'; }
		if ($_POST['kota'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kota harus diisi.</p></div>'; }
		if ($_POST['kode_pos'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kode Pos harus diisi.</p></div>'; }
		if ($_POST['negara'] == ''){ $errmsg = '<div id="message" class="updated"><p>Negara harus diisi.</p></div>'; }
		if ($_POST['telepon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Telepon harus diisi.</p></div>'; }
		if ($_POST['fax'] == ''){ $errmsg = '<div id="message" class="updated"><p>Fax harus diisi.</p></div>'; }
		if ($_POST['nama_pencipta'] == ''){ $errmsg = '<div id="message" class="updated"><p>Nama Pencipta harus diisi.</p></div>'; }
		if ($_POST['alamat_pencipta'] == ''){ $errmsg = '<div id="message" class="updated"><p>Alamat Pencipta harus diisi.</p></div>'; }
		if ($_POST['kota_pencipta'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kota Pencipta harus diisi.</p></div>'; }
		if ($_POST['kode_pos_pencipta'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kode pos Pencipta harus diisi.</p></div>'; }
		if ($_POST['negara_pencipta'] == ''){ $errmsg = '<div id="message" class="updated"><p>Negara Pencipta harus diisi.</p></div>'; }
		if ($_POST['telepon_pencipta'] == ''){ $errmsg = '<div id="message" class="updated"><p>Telepon Pencipta harus diisi.</p></div>'; }
		if ($_POST['fax_pencipta'] == ''){ $errmsg = '<div id="message" class="updated"><p>Fax Pencipta harus diisi.</p></div>'; }
		if ($_POST['judul_hakcipta'] == ''){ $errmsg = '<div id="message" class="updated"><p>Judul Hakcipta harus diisi.</p></div>'; }
		if ($_POST['negara_pengajuan'] == ''){ $errmsg = '<div id="message" class="updated"><p>Negara pengajuan harus diisi.</p></div>'; }
		if ($_POST['tanggal_pengajuan'] == ''){ $errmsg = '<div id="message" class="updated"><p>Tanggal pengajuan harus diisi.</p></div>'; }
		if ($_POST['contoh_ciptaan'] == ''){ $errmsg = '<div id="message" class="updated"><p>Contoh Ciptaan harus diisi.</p></div>'; }
		if ($_POST['desc_ciptaan'] == ''){ $errmsg = '<div id="message" class="updated"><p>Deskripsi Ciptaan harus diisi.</p></div>'; }
		
		if ($errmsg == ''){
			$sql = "INSERT INTO wp_hakcipta (jenis,
											created_date, 
											nama_pemohon, 
											alamat_pemohon, 
											kota, 
											kode_pos, 
											negara, 
											telepon, 
											fax, 
											nama_pencipta, 
											alamat_pencipta, 
											kota_pencipta, 
											kode_pos_pencipta, 
											negara_pencipta,
											telepon_pencipta,
											fax_pencipta,
											judul_hakcipta,
											negara_pengajuan,
											tanggal_pengajuan,
											contoh_ciptaan,
											desc_ciptaan,
											username) 
					values('Hak Cipta',
					now(),
					'".$_POST['nama_pemohon']."',
					'".$_POST['alamat_pemohon']."',
					'".$_POST['kota']."',
					'".$_POST['kode_pos']."',
					'".$_POST['negara']."',
					'".$_POST['telepon']."',
					'".$_POST['fax']."',
					'".$_POST['nama_pencipta']."',
					'".$_POST['alamat_pencipta']."',
					'".$_POST['kota_pencipta']."',
					'".$_POST['kode_pos_pencipta']."',
					'".$_POST['negara_pencipta']."',
					'".$_POST['telepon_pencipta']."',
					'".$_POST['fax_pencipta']."',
					'".$_POST['judul_hakcipta']."',
					'".$_POST['negara_pengajuan']."',
					'".$_POST['tanggal_pengajuan']."',
					'".$_POST['contoh_ciptaan']."',
					'".$_POST['desc_ciptaan']."',
					'".$_GET['username']."'
					);";
   			$wpdb->query($sql);
			
			
				
			// start upload files
			if(!empty($_FILES['contoh_ciptaan']['tmp_name']))
			{			
			$overrides = array('test_form' => false, 'mimes' => array('pdf' => 'application/pdf' , 'jpg' => 'image/jpeg' , 'png' => 'image/png' , 'jpeg' => 'image/jpeg' , 'doc' => 'application/msword'));
    
    		wp_handle_upload($_FILES['contoh_ciptaan'], $overrides);
			}
			// end upload files
			
			// start function send email
			   $attachments = array(WP_CONTENT_DIR . '/uploads/document/SURAT-KUASA-SURAT-PERNYATAAN-HAK-CIPTA-2012.doc');
			   $qq = $wpdb->get_results('SELECT email from wp_member WHERE username="'.$_GET['username'].'"');
			   $headers = 'From: DaftarHaki.com <info@daftarhaki.com>' . "\r\n";
			   foreach($qq as $val){
			   $to = array($val->email,'teguh@nomadentech.net','adekurniawan@benang.co.id');
			   }
			   $subject = 'Pendaftaran HAKI';
			   $message = 'Ini test email :mahos';
			   wp_mail($to, $subject, $message, $headers, $attachments);
		    // end function send email
			
			// $sql2 = "INSERT INTO wp_logstatus (dtm, status, descr, other) VALUES (now(), '1', 'Waiting List', 'hki');";
			// $wpdb->query($sql2);
			
   			//wp_redirect( get_bloginfo('url').'/wp-admin/admin.php?page=haki_member&act=modify_member'); ".$_GET['username']."
   			echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify&username='.$_GET['username'].''.'"</script>' ;
   			exit;
		}
	}

	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Add HAK CIPTA</h2><br />';

	if ($errmsg != '') $html .= $errmsg;

	$html .= '<form method="post" action="?page=haki_member&act=add_hakcipta&username='.$_GET['username'].'" enctype="multipart/form-data">
			
			<table class="form-table">
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
				<th scope="row"><label for="nama_pencipta">Nama Pencipta</label></th>
				<td><input name="nama_pencipta" type="text" id="nama_pencipta"  value="'.$_POST['nama_pencipta'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="alamat_pencipta">Alamat Pencipta</label></th>
				<td><input name="alamat_pencipta" type="text" id="alamat_pencipta"  value="'.$_POST['alamat_pencipta'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="kota_pencipta">Kota Pencipta</label></th>
				<td><input name="kota_pencipta" type="text" id="kota_pencipta"  value="'.$_POST['kota_pencipta'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="kode_pos_pencipta">Kode Pos Pencipta</label></th>
				<td><input name="kode_pos_pencipta" type="text" id="kode_pos_pencipta"  value="'.$_POST['kode_pos_pencipta'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="negara_pencipta">Negara Pencipta</label></th>
				<td><input name="negara_pencipta" type="text" id="negara_pencipta"  value="'.$_POST['negara_pencipta'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="telepon_pencipta">Telepon Pencipta</label></th>
				<td><input name="telepon_pencipta" type="text" id="telepon_pencipta"  value="'.$_POST['telepon_pencipta'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="fax_pencipta">Faksimili Pencipta</label></th>
				<td><input name="fax_pencipta" type="text" id="fax_pencipta"  value="'.$_POST['fax_pencipta'].'" class="regular-text" />
			</tr>
						
			<tr valign="top">
				<th scope="row"><label for="judul_hakcipta">Judul Hak Cipta</label></th>
				<td><input name="judul_hakcipta" type="text" id="judul_hakcipta"  value="'.$_POST['judul_hakcipta'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="negara_pengajuan">Negara Pertama Kali Paten Diajukan Pendaftaran</label></th>
				<td><input name="negara_pengajuan" type="text" id="negara_pengajuan"  value="'.$_POST['negara_pengajuan'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="tanggal_pengajuan">Tanggal Pertama Kali Paten Diajukan Pendaftaran</label></th>
				<td><input name="tanggal_pengajuan" type="text" id="tanggal_pengajuan"  value="'.$_POST['tanggal_pengajuan'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="contoh_ciptaan">Contoh Ciptaan</label></th>
				<td><input name="contoh_ciptaan" type="file" id="contoh_ciptaan"  value="'.$_POST['contoh_ciptaan'].'"/><small>Allowed type: pdf, doc, png, jpg and jpeg.</small>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="desc_ciptaan">Deskripsi Ciptaan</label></th>
				<td><input name="desc_ciptaan" type="text" id="desc_ciptaan"  value="'.$_POST['desc_ciptaan'].'" class="regular-text" />
			</tr>
			</table>

			<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"  /></p>

			';
	echo $html;
}

function add_desainindustri(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	
	$errmsg = '';
	if ($_POST['submit'] == 'Save Changes'){
		
		if ($_POST['nama_pemohon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Nama Lengkap harus diisi.</p></div>'; }
		if ($_POST['alamat_pemohon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Alamat harus diisi.</p></div>'; }
		if ($_POST['kota'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kota harus diisi.</p></div>'; }
		if ($_POST['kode_pos'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kode Pos harus diisi.</p></div>'; }
		if ($_POST['negara'] == ''){ $errmsg = '<div id="message" class="updated"><p>Negara harus diisi.</p></div>'; }
		if ($_POST['telepon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Telepon harus diisi.</p></div>'; }
		if ($_POST['fax'] == ''){ $errmsg = '<div id="message" class="updated"><p>Fax harus diisi.</p></div>'; }
		if ($_POST['nama_pendesain'] == ''){ $errmsg = '<div id="message" class="updated"><p>Nama pendesain harus diisi.</p></div>'; }
		if ($_POST['alamat_pendesain'] == ''){ $errmsg = '<div id="message" class="updated"><p>Alamat pendesain harus diisi.</p></div>'; }
		if ($_POST['kota_pendesain'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kota pendesain harus diisi.</p></div>'; }
		if ($_POST['kode_pos_pendesain'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kode pos pendesain harus diisi.</p></div>'; }
		if ($_POST['negara_pendesain'] == ''){ $errmsg = '<div id="message" class="updated"><p>Negara pendesain harus diisi.</p></div>'; }
		if ($_POST['telepon_pendesain'] == ''){ $errmsg = '<div id="message" class="updated"><p>Telepon pendesain harus diisi.</p></div>'; }
		if ($_POST['fax_pendesain'] == ''){ $errmsg = '<div id="message" class="updated"><p>Fax pendesain harus diisi.</p></div>'; }
		if ($_POST['judul_desainindustri'] == ''){ $errmsg = '<div id="message" class="updated"><p>Judul Desain Industri harus diisi.</p></div>'; }
		if ($_POST['negara_pengajuan'] == ''){ $errmsg = '<div id="message" class="updated"><p>Negara pengajuan harus diisi.</p></div>'; }
		if ($_POST['tanggal_pengajuan'] == ''){ $errmsg = '<div id="message" class="updated"><p>Tanggal pengajuan harus diisi.</p></div>'; }
		if ($_POST['contoh_desainindustri'] == ''){ $errmsg = '<div id="message" class="updated"><p>Contoh Desain Industri harus diisi.</p></div>'; }
		if ($_POST['desc_desainindustri'] == ''){ $errmsg = '<div id="message" class="updated"><p>Deskripsi Desain Industri harus diisi.</p></div>'; }
		
		if ($errmsg == ''){
			$sql = "INSERT INTO wp_desainindustri (jenis,
											created_date, 
											nama_pemohon, 
											alamat_pemohon, 
											kota, 
											kode_pos, 
											negara, 
											telepon, 
											fax, 
											nama_pendesain, 
											alamat_pendesain, 
											kota_pendesain, 
											kode_pos_pendesain, 
											negara_pendesain,
											telepon_pendesain,
											fax_pendesain,
											judul_desainindustri,
											negara_pengajuan,
											tanggal_pengajuan,
											contoh_desainindustri,
											desc_desainindustri,
											username) 
					values('Desain Industri',
					now(),
					'".$_POST['nama_pemohon']."',
					'".$_POST['alamat_pemohon']."',
					'".$_POST['kota']."',
					'".$_POST['kode_pos']."',
					'".$_POST['negara']."',
					'".$_POST['telepon']."',
					'".$_POST['fax']."',
					'".$_POST['nama_pendesain']."',
					'".$_POST['alamat_pendesain']."',
					'".$_POST['kota_pendesain']."',
					'".$_POST['kode_pos_pendesain']."',
					'".$_POST['negara_pendesain']."',
					'".$_POST['telepon_pendesain']."',
					'".$_POST['fax_pendesain']."',
					'".$_POST['judul_pendesain']."',
					'".$_POST['negara_pengajuan']."',
					'".$_POST['tanggal_pengajuan']."',
					'".$_POST['contoh_desainindustri']."',
					'".$_POST['desc_desainindustri']."',
					'".$_GET['username']."'
					);";
   			$wpdb->query($sql);
			
			// start upload files
			if(!empty($_FILES['contoh_desainindustri']['tmp_name']))
			{			
			$overrides = array('test_form' => false, 'mimes' => array('pdf' => 'application/pdf' , 'jpg' => 'image/jpeg' , 'png' => 'image/png' , 'jpeg' => 'image/jpeg' , 'doc' => 'application/msword'));
    
    		wp_handle_upload($_FILES['contoh_desainindustri'], $overrides);
			}
			// end upload files
			
			// start function send email
			   $attachments = array(WP_CONTENT_DIR . '/uploads/document/SURAT-KUASA-SURAT-PERNYATAAN-DESAIN-INDUSTRI-2012.doc');
			   $qq = $wpdb->get_results('SELECT email from wp_member WHERE username="'.$_GET['username'].'"');
			   $headers = 'From: DaftarHaki.com <info@daftarhaki.com>' . "\r\n";
			   foreach($qq as $val){
			   $to = array($val->email,'teguh@nomadentech.net','adekurniawan@benang.co.id');
			   }
			   $subject = 'Pendaftaran HAKI';
			   $message = 'Ini test email :mahos';
			   wp_mail($to, $subject, $message, $headers, $attachments);
		    // end function send email
			
			// $sql2 = "INSERT INTO wp_logstatus (dtm, status, descr, other) VALUES (now(), '1', 'Waiting List', 'hki');";
			// $wpdb->query($sql2);
			
   			//wp_redirect( get_bloginfo('url').'/wp-admin/admin.php?page=haki_member&act=modify_member'); ".$_GET['username']."
   			echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify&username='.$_GET['username'].''.'"</script>' ;
   			exit;
		}
	}

	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Add Desain Industri</h2><br />';

	if ($errmsg != '') $html .= $errmsg;

	$html .= '<form method="post" action="?page=haki_member&act=add_hakcipta&username='.$_GET['username'].'" enctype="multipart/form-data">
			
			<table class="form-table">
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
				<th scope="row"><label for="nama_desain">Nama Pendesain</label></th>
				<td><input name="nama_desain" type="text" id="nama_desain"  value="'.$_POST['nama_desain'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="alamat_pendesain">Alamat Pendesain</label></th>
				<td><input name="alamat_pendesain" type="text" id="alamat_pendesain"  value="'.$_POST['alamat_pendesain'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="kota_pendesain">Kota Pendesain</label></th>
				<td><input name="kota_pendesain" type="text" id="kota_pendesain"  value="'.$_POST['kota_pendesain'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="kode_pos_pendesain">Kode Pos Pendesain</label></th>
				<td><input name="kode_pos_pendesain" type="text" id="kode_pos_pendesain"  value="'.$_POST['kode_pos_pendesain'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="negara_pendesain">Negara Pendesain</label></th>
				<td><input name="negara_pendesain" type="text" id="negara_pendesain"  value="'.$_POST['negara_pendesain'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="telepon_pendesain">Telepon Pendesain</label></th>
				<td><input name="telepon_pendesain" type="text" id="telepon_pendesain"  value="'.$_POST['telepon_pendesain'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="fax_pendesain">Faksimili Pendesain</label></th>
				<td><input name="fax_pendesain" type="text" id="fax_pendesain"  value="'.$_POST['fax_pendesain'].'" class="regular-text" />
			</tr>
						
			<tr valign="top">
				<th scope="row"><label for="judul_desainindustri">Judul Desain Industri</label></th>
				<td><input name="judul_desainindustri" type="text" id="judul_desainindustri"  value="'.$_POST['judul_desainindustri'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="negara_pengajuan">Negara Pertama Kali Paten Diajukan Pendaftaran</label></th>
				<td><input name="negara_pengajuan" type="text" id="negara_pengajuan"  value="'.$_POST['negara_pengajuan'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="tanggal_pengajuan">Tanggal Pertama Kali Paten Diajukan Pendaftaran</label></th>
				<td><input name="tanggal_pengajuan" type="text" id="tanggal_pengajuan"  value="'.$_POST['tanggal_pengajuan'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="contoh_desainindustri">Contoh Desain Industri</label></th>
				<td><input name="contoh_desainindustri" type="file" id="contoh_desainindustri"  value="'.$_POST['contoh_desainindustri'].'"/><small>Allowed type: pdf, doc, png, jpg and jpeg.</small>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="desc_desainindustri">Deskripsi Desain Industri</label></th>
				<td><input name="desc_desainindustri" type="text" id="desc_desainindustri"  value="'.$_POST['desc_desainindustri'].'" class="regular-text" />
			</tr>
			</table>

			<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"  /></p>

			';
	echo $html;
}


function add_indikasigeo(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	
	$errmsg = '';
	if ($_POST['submit'] == 'Save Changes'){
		
		if ($_POST['nama_pemohon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Nama Lengkap harus diisi.</p></div>'; }
		if ($_POST['alamat_pemohon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Alamat harus diisi.</p></div>'; }
		if ($_POST['kota'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kota harus diisi.</p></div>'; }
		if ($_POST['kode_pos'] == ''){ $errmsg = '<div id="message" class="updated"><p>Kode Pos harus diisi.</p></div>'; }
		if ($_POST['negara'] == ''){ $errmsg = '<div id="message" class="updated"><p>Negara harus diisi.</p></div>'; }
		if ($_POST['telepon'] == ''){ $errmsg = '<div id="message" class="updated"><p>Telepon harus diisi.</p></div>'; }
		if ($_POST['fax'] == ''){ $errmsg = '<div id="message" class="updated"><p>Fax harus diisi.</p></div>'; }
		if ($_POST['nama_indikasigeo'] == ''){ $errmsg = '<div id="message" class="updated"><p>Nama Indikasi Geografis harus diisi.</p></div>'; }
		if ($_POST['nama_barang'] == ''){ $errmsg = '<div id="message" class="updated"><p>Nama Barang harus diisi.</p></div>'; }
		if ($_POST['uraian_indikasigeo'] == ''){ $errmsg = '<div id="message" class="updated"><p>Uraian Indikasi Geografis harus diisi.</p></div>'; }
		if ($_POST['etiket_indikasigeo'] == ''){ $errmsg = '<div id="message" class="updated"><p>Etiket Indikasi Geografis harus diisi.</p></div>'; }
		
		if ($errmsg == ''){
			$sql = "INSERT INTO wp_indikasigeografis (jenis,
											created_date, 
											nama_pemohon, 
											alamat_pemohon, 
											kota, 
											kode_pos, 
											negara, 
											telepon, 
											fax, 
											nama_indikasigeo, 
											nama_barang, 
											uraian_indikasigeo, 
											etiket_indikasigeo,
											username
											) 
					values('Indikasi Geografis',
					now(),
					'".$_POST['nama_pemohon']."',
					'".$_POST['alamat_pemohon']."',
					'".$_POST['kota']."',
					'".$_POST['kode_pos']."',
					'".$_POST['negara']."',
					'".$_POST['telepon']."',
					'".$_POST['fax']."',
					'".$_POST['nama_indikasigeo']."',
					'".$_POST['nama_barang']."',
					'".$_POST['uraian_indikasigeo']."',
					'".$_POST['etiket_indikasigeo']."',
					'".$_GET['username']."'
					);";
   			$wpdb->query($sql);
			
			// start upload files
			if(!empty($_FILES['etiket_indikasigeo']['tmp_name']))
			{			
			$overrides = array('test_form' => false, 'mimes' => array('pdf' => 'application/pdf' , 'jpg' => 'image/jpeg' , 'png' => 'image/png' , 'jpeg' => 'image/jpeg' , 'doc' => 'application/msword'));
    
    		wp_handle_upload($_FILES['etiket_indikasigeo'], $overrides);
			}
			// end upload files
			
			
			// start function send email
			   $attachments = array(WP_CONTENT_DIR . '/uploads/DaftarRiwayatHidup.pdf', WP_CONTENT_DIR . '/uploads/TranskipNilai.pdf');
			   $qq = $wpdb->get_results('SELECT email from wp_member WHERE username="'.$_GET['username'].'"');
			   $headers = 'From: DaftarHaki.com <info@daftarhaki.com>' . "\r\n";
			   foreach($qq as $val){
			   $to = array($val->email,'teguh@nomadentech.net');
			   }
			   $subject = 'Pendaftaran HAKI';
			   $message = 'Ini test email :mahos';
			   wp_mail($to, $subject, $message, $headers, $attachments);
		    // end function send email
			
			// $sql2 = "INSERT INTO wp_logstatus (dtm, status, descr, other) VALUES (now(), '1', 'Waiting List', 'hki');";
			// $wpdb->query($sql2);
			
   			//wp_redirect( get_bloginfo('url').'/wp-admin/admin.php?page=haki_member&act=modify_member'); ".$_GET['username']."
   			echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify&username='.$_GET['username'].''.'"</script>' ;
   			exit;
		}
	}

	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Add Indikasi Geografis</h2><br />';

	if ($errmsg != '') $html .= $errmsg;

	$html .= '<form method="post" action="?page=haki_member&act=add_hakcipta&username='.$_GET['username'].'" enctype="multipart/form-data">
			
			<table class="form-table">
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
				<th scope="row"><label for="nama_indikasigeo">Nama Indikasi Geografis</label></th>
				<td><input name="nama_indikasigeo" type="text" id="nama_indikasigeo"  value="'.$_POST['nama_indikasigeo'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="nama_barang">Nama Barang</label></th>
				<td><input name="nama_barang" type="text" id="nama_barang"  value="'.$_POST['nama_barang'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="uraian_indikasigeo">Uraian Indikasi Geografis</label></th>
				<td><input name="uraian_indikasigeo" type="text" id="uraian_indikasigeo"  value="'.$_POST['uraian_indikasigeo'].'" class="regular-text" />
			</tr>
			<tr valign="top">
				<th scope="row"><label for="etiket_indikasigeo">Etiket Indikasi Geografis</label></th>
				<td><input name="etiket_indikasigeo" type="file" id="etiket_indikasigeo"  value="'.$_POST['etiket_indikasigeo'].'"/><small>Allowed type: pdf, doc, png, jpg and jpeg.</small>
			</tr>
			</table>

			<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"  /></p>

			';
	echo $html;
}


//------- ini buat modify

function modify_paten(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	
	if ($_POST['submit'] == 'Save Changes'){
	
		$wpdb->query("
			UPDATE wp_paten
			SET nama_pemohon='".$_POST['nama_pemohon']."', 
				alamat_pemohon='".$_POST['alamat_pemohon']."', 
				kota='".$_POST['kota']."', 
				kode_pos='".$_POST['kode_pos']."', 
				negara='".$_POST['negara']."', 
				telepon='".$_POST['telepon']."',
				fax='".$_POST['fax']."',
				nama_inventor='".$_POST['nama_inventor']."', 
				alamat_inventor='".$_POST['alamat_inventor']."', 
				kota_inventor='".$_POST['kota_inventor']."', 
				kode_pos_inventor='".$_POST['kode_pos_inventor']."', 
				negara_inventor='".$_POST['negara_inventor']."', 
				telepon_inventor='".$_POST['telepon_inventor']."',
				fax_inventor='".$_POST['fax_inventor']."',
				judul_paten='".$_POST['judul_paten']."',
				desc_paten='".$_POST['desc_paten']."',
				gambar_paten='".$_POST['gambar_paten']."',
				negara_pengajuan='".$_POST['negara_pengajuan']."',
				tanggal_pengajuan='".$_POST['tanggal_pengajuan']."',
				nomor_ptc='".$_POST['nomor_ptc']."',
				bukti_pengajuan='".$_POST['bukti_pengajuan']."'	
			WHERE id='".$_GET['id']."'
			");
			
		// start upload files
			if(!empty($_FILES['gambar_paten']['tmp_name']))
			{			
			$overrides = array('test_form' => false, 'mimes' => array('pdf' => 'application/pdf' , 'jpg' => 'image/jpeg' , 'png' => 'image/png' , 'jpeg' => 'image/jpeg' , 'doc' => 'application/msword'));
    
    		wp_handle_upload($_FILES['gambar_paten'], $overrides);
			}
			// end upload files
			
			
			
		//echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify'.'"</script>';
		//echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify'.'"</script>' ;
		echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=view_member'.'"</script>' ;
   		//echo "saved";
		exit;
	}
	
	$userdata = $wpdb->get_results ('SELECT * from wp_paten WHERE id="'.$_GET['id'].'"');
	foreach ($userdata as $users){
	
		$html  = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Modify Paten</h2><br />';
		$html .= '<form method="post" action="?page=haki_member&act=modify_paten&id='.$_GET['id'].'" enctype="multipart/form-data">
				  <table class="form-table">
				  <tr valign="top">
				  <th scope="row"><label for="nama_pemohon">Nama Pemohon</label></th>
				  <td><input name="nama_pemohon" type="text" id="nama_pemohon" value="'.$users->nama_pemohon.'" class="regular-text" /></td>
			      </tr>
					<tr valign="top">
					<th scope="row"><label for="alamat_pemohon">Alamat Pemohon</label></th>
					<td><input name="alamat_pemohon" type="text" id="alamat_pemohon" value="'.$users->alamat_pemohon.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kota">Kota</label></th>
					<td><input name="kota" type="text" id="kota" value="'.$users->kota.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kode_pos">Kode Pos</label></th>
					<td><input name="kode_pos" type="text" id="kode_pos" value="'.$users->kode_pos.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="negara">Negara</label></th>
					<td><input name="negara" type="text" id="negara" value="'.$users->negara.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="telepon">Telepon</label></th>
					<td><input name="telepon" type="text" id="telepon" value="'.$users->telepon.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="fax">Fax</label></th>
					<td><input name="fax" type="text" id="fax" value="'.$users->fax.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="nama_inventor">Nama Inventor</label></th>
					<td><input name="nama_inventor" type="text" id="nama_inventor" value="'.$users->nama_inventor.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="alamat_inventor">Alamat Inventor</label></th>
					<td><input name="alamat_inventor" type="text" id="alamat_inventor" value="'.$users->alamat_inventor.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kota_inventor">Kota Inventor</label></th>
					<td><input name="kota_inventor" type="text" id="kota_inventor" value="'.$users->kota_inventor.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kode_pos_inventor">Kode Pos Inventor</label></th>
					<td><input name="kode_pos_inventor" type="text" id="kode_pos_inventor" value="'.$users->kode_pos_inventor.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="negara_inventor">Negara Inventor</label></th>
					<td><input name="negara_inventor" type="text" id="negara_inventor" value="'.$users->negara_inventor.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="telepon_inventor">Telepon Inventor</label></th>
					<td><input name="telepon_inventor" type="text" id="telepon_inventor" value="'.$users->telepon_inventor.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="fax_inventor">Fax Inventor</label></th>
					<td><input name="fax_inventor" type="text" id="fax_inventor" value="'.$users->fax_inventor.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="judul_paten">Judul Paten</label></th>
					<td><input name="judul_paten" type="text" id="judul_paten" value="'.$users->judul_paten.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="desc_paten">Deskripsi Paten</label></th>
					<td><input name="desc_paten" type="text" id="desc_paten" value="'.$users->desc_paten.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="gambar_paten">Gambar Paten</label></th>
					<td><input name="gambar_paten" type="file" id="gambar_paten" value="'.$users->gambar_paten.'" /><small>Allowed type: png, jpg and jpeg.</small></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="negara_pengajuan">Negara Pengajuan</label></th>
					<td><input name="negara_pengajuan" type="text" id="negara_pengajuan" value="'.$users->negara_pengajuan.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="tanggal_pengajuan">Tanggal Pengajuan</label></th>
					<td><input name="tanggal_pengajuan" type="text" id="tanggal_pengajuan" value="'.$users->tanggal_pengajuan.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="nomor_ptc">Nomor PTC</label></th>
					<td><input name="nomor_ptc" type="text" id="nomor_ptc" value="'.$users->nomor_ptc.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="bukti_pengajuan">Bukti Pengajuan</label></th>
					<td><input name="bukti_pengajuan" type="text" id="bukti_pengajuan" value="'.$users->bukti_pengajuan.'" class="regular-text" /></td>
					</tr>
					</table>
					<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes" /> <a href="'.$_SERVER['HTTP_REFERER'].'" class="add-new-h2">Go back</a></p>
		';
	}
	$html .= '</div>';
	return $html;
	
}


function modify_hakcipta(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	
	if ($_POST['submit'] == 'Save Changes'){
	
		$wpdb->query("
			UPDATE wp_hakcipta
			SET nama_pemohon='".$_POST['nama_pemohon']."', 
				alamat_pemohon='".$_POST['alamat_pemohon']."', 
				kota='".$_POST['kota']."', 
				kode_pos='".$_POST['kode_pos']."', 
				negara='".$_POST['negara']."', 
				telepon='".$_POST['telepon']."',
				fax='".$_POST['fax']."',
				nama_pencipta='".$_POST['nama_inventor']."', 
				alamat_pencipta='".$_POST['alamat_inventor']."', 
				kota_pencipta='".$_POST['kota_inventor']."', 
				kode_pos_pencipta='".$_POST['kode_pos_inventor']."', 
				negara_pencipta='".$_POST['negara_inventor']."', 
				telepon_pencipta='".$_POST['telepon_inventor']."',
				fax_pencipta='".$_POST['fax_inventor']."',
				judul_hakcipta='".$_POST['judul_paten']."',
				negara_pengajuan='".$_POST['negara_pengajuan']."',
				tanggal_pengajuan='".$_POST['tanggal_pengajuan']."',
				contoh_ciptaan='".$_POST['contoh_ciptaan']."',
				desc_ciptaan='".$_POST['desc_ciptaan']."'	
			WHERE id='".$_GET['id']."'
			");
			
		// start upload files
			if(!empty($_FILES['contoh_ciptaan']['tmp_name']))
			{			
			$overrides = array('test_form' => false, 'mimes' => array('pdf' => 'application/pdf' , 'jpg' => 'image/jpeg' , 'png' => 'image/png' , 'jpeg' => 'image/jpeg' , 'doc' => 'application/msword'));
    
    		wp_handle_upload($_FILES['contoh_ciptaan'], $overrides);
			}
			// end upload files
			
			
		//echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify'.'"</script>';
		//echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify'.'"</script>' ;
		echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=view_member'.'"</script>' ;
   		//echo "saved";
		exit;
	}
	
	$userdata = $wpdb->get_results ('SELECT * from wp_hakcipta WHERE id="'.$_GET['id'].'"');
	foreach ($userdata as $users){
	
		$html  = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Modify Hak Cipta</h2><br />';
		$html .= '<form method="post" action="?page=haki_member&act=modify_hakcipta&id='.$_GET['id'].'" enctype="multipart/form-data">
				  <table class="form-table">
				  <tr valign="top">
				  <th scope="row"><label for="nama_pemohon">Nama Pemohon</label></th>
				  <td><input name="nama_pemohon" type="text" id="nama_pemohon" value="'.$users->nama_pemohon.'" class="regular-text" /></td>
			      </tr>
					<tr valign="top">
					<th scope="row"><label for="alamat_pemohon">Alamat Pemohon</label></th>
					<td><input name="alamat_pemohon" type="text" id="alamat_pemohon" value="'.$users->alamat_pemohon.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kota">Kota</label></th>
					<td><input name="kota" type="text" id="kota" value="'.$users->kota.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kode_pos">Kode Pos</label></th>
					<td><input name="kode_pos" type="text" id="kode_pos" value="'.$users->kode_pos.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="negara">Negara</label></th>
					<td><input name="negara" type="text" id="negara" value="'.$users->negara.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="telepon">Telepon</label></th>
					<td><input name="telepon" type="text" id="telepon" value="'.$users->telepon.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="fax">Fax</label></th>
					<td><input name="fax" type="text" id="fax" value="'.$users->fax.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="nama_pencipta">Nama Pencipta</label></th>
					<td><input name="nama_pencipta" type="text" id="nama_pencipta" value="'.$users->nama_pencipta.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="alamat_pencipta">Alamat Pencipta</label></th>
					<td><input name="alamat_pencipta" type="text" id="alamat_pencipta" value="'.$users->alamat_pencipta.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kota_pencipta">Kota Pencipta</label></th>
					<td><input name="kota_pencipta" type="text" id="kota_pencipta" value="'.$users->kota_pencipta.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kode_pos_pencipta">Kode Pos Pencipta</label></th>
					<td><input name="kode_pos_pencipta" type="text" id="kode_pos_pencipta" value="'.$users->kode_pos_pencipta.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="negara_pencipta">Negara Pencipta</label></th>
					<td><input name="negara_pencipta" type="text" id="negara_pencipta" value="'.$users->negara_pencipta.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="telepon_pencipta">Telepon Pencipta</label></th>
					<td><input name="telepon_pencipta" type="text" id="telepon_pencipta" value="'.$users->telepon_pencipta.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="fax_pencipta">Fax Pencipta</label></th>
					<td><input name="fax_pencipta" type="text" id="fax_pencipta" value="'.$users->fax_pencipta.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="judul_hakcipta">Judul Hak Cipta</label></th>
					<td><input name="judul_hakcipta" type="text" id="judul_hakcipta" value="'.$users->judul_hakcipta.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="negara_pengajuan">Negara Pengajuan</label></th>
					<td><input name="negara_pengajuan" type="text" id="negara_pengajuan" value="'.$users->negara_pengajuan.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="tanggal_pengajuan">Tanggal Pengajuan</label></th>
					<td><input name="tanggal_pengajuan" type="text" id="tanggal_pengajuan" value="'.$users->tanggal_pengajuan.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="contoh_ciptaan">Contoh Ciptaan</label></th>
					<td><input name="contoh_ciptaan" type="file" id="contoh_ciptaan" value="'.$users->contoh_ciptaan.'" /><small>Allowed type: pdf, doc, png, jpg, jpeg.</small></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="desc_ciptaan">Deskripsi Ciptaan</label></th>
					<td><input name="desc_ciptaan" type="text" id="desc_ciptaan" value="'.$users->desc_ciptaan.'" class="regular-text" /></td>
					</tr>
					</table>
					<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes" /> <a href="'.$_SERVER['HTTP_REFERER'].'" class="add-new-h2">Go back</a></p>
		';
	}
	$html .= '</div>';
	return $html;
	
}


function modify_desainindustri(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	
	if ($_POST['submit'] == 'Save Changes'){
	
		$wpdb->query("
			UPDATE wp_desainindustri
			SET nama_pemohon='".$_POST['nama_pemohon']."', 
				alamat_pemohon='".$_POST['alamat_pemohon']."', 
				kota='".$_POST['kota']."', 
				kode_pos='".$_POST['kode_pos']."', 
				negara='".$_POST['negara']."', 
				telepon='".$_POST['telepon']."',
				fax='".$_POST['fax']."',
				nama_pendesain='".$_POST['nama_pendesain']."', 
				alamat_pendesain='".$_POST['alamat_pendesain']."', 
				kota_pendesain='".$_POST['kota_pendesain']."', 
				kode_pos_pendesain='".$_POST['kode_pos_pendesain']."', 
				negara_pendesain='".$_POST['negara_pendesain']."', 
				telepon_pendesain='".$_POST['telepon_pendesain']."',
				fax_pendesain='".$_POST['fax_pendesain']."',
				judul_desainindustri='".$_POST['judul_desainindustri']."',
				negara_pengajuan='".$_POST['negara_pengajuan']."',
				tanggal_pengajuan='".$_POST['tanggal_pengajuan']."',
				contoh_desainindustri='".$_POST['contoh_desainindustri']."',
				desc_desainindustri='".$_POST['desc_desainindustri']."'	
			WHERE id='".$_GET['id']."'
			");
			
			// start upload files
			if(!empty($_FILES['contoh_desainindustri']['tmp_name']))
			{			
			$overrides = array('test_form' => false, 'mimes' => array('pdf' => 'application/pdf' , 'jpg' => 'image/jpeg' , 'png' => 'image/png' , 'jpeg' => 'image/jpeg' , 'doc' => 'application/msword'));
    
    		wp_handle_upload($_FILES['contoh_desainindustri'], $overrides);
			}
			// end upload files
			
		//echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify'.'"</script>';
		//echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify'.'"</script>' ;
		echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=view_member'.'"</script>' ;
   		//echo "saved";
		exit;
	}
	
	$userdata = $wpdb->get_results ('SELECT * from wp_desainindustri WHERE id="'.$_GET['id'].'"');
	foreach ($userdata as $users){
	
		$html  = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Modify Desain Industri</h2><br />';
		$html .= '<form method="post" action="?page=haki_member&act=modify_desainindustri&id='.$_GET['id'].'" enctype="multipart/form-data">
				  <table class="form-table">
				  <tr valign="top">
				  <th scope="row"><label for="nama_pemohon">Nama Pemohon</label></th>
				  <td><input name="nama_pemohon" type="text" id="nama_pemohon" value="'.$users->nama_pemohon.'" class="regular-text" /></td>
			      </tr>
					<tr valign="top">
					<th scope="row"><label for="alamat_pemohon">Alamat Pemohon</label></th>
					<td><input name="alamat_pemohon" type="text" id="alamat_pemohon" value="'.$users->alamat_pemohon.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kota">Kota</label></th>
					<td><input name="kota" type="text" id="kota" value="'.$users->kota.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kode_pos">Kode Pos</label></th>
					<td><input name="kode_pos" type="text" id="kode_pos" value="'.$users->kode_pos.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="negara">Negara</label></th>
					<td><input name="negara" type="text" id="negara" value="'.$users->negara.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="telepon">Telepon</label></th>
					<td><input name="telepon" type="text" id="telepon" value="'.$users->telepon.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="fax">Fax</label></th>
					<td><input name="fax" type="text" id="fax" value="'.$users->fax.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="nama_pendesain">Nama Pendesain</label></th>
					<td><input name="nama_pendesain" type="text" id="nama_pendesain" value="'.$users->nama_pendesain.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="alamat_pendesain">Alamat Pendesain</label></th>
					<td><input name="alamat_pendesain" type="text" id="alamat_pendesain" value="'.$users->alamat_pendesain.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kota_pendesain">Kota Pendesain</label></th>
					<td><input name="kota_pendesain" type="text" id="kota_pendesain" value="'.$users->kota_pendesain.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kode_pos_pendesain">Kode Pos Pendesain</label></th>
					<td><input name="kode_pos_pendesain" type="text" id="kode_pos_pendesain" value="'.$users->kode_pos_pendesain.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="negara_pendesain">Negara Pendesain</label></th>
					<td><input name="negara_pendesain" type="text" id="negara_pendesain" value="'.$users->negara_pendesain.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="telepon_pendesain">Telepon Pendesain</label></th>
					<td><input name="telepon_pendesain" type="text" id="telepon_pendesain" value="'.$users->telepon_pendesain.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="fax_pendesain">Fax Pendesain</label></th>
					<td><input name="fax_pendesain" type="text" id="fax_pendesain" value="'.$users->fax_pendesain.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="judul_desainindustri">Judul Desain Industri</label></th>
					<td><input name="judul_desainindustri" type="text" id="judul_desainindustri" value="'.$users->judul_desainindustri.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="negara_pengajuan">Negara Pengajuan</label></th>
					<td><input name="negara_pengajuan" type="text" id="negara_pengajuan" value="'.$users->negara_pengajuan.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="tanggal_pengajuan">Tanggal Pengajuan</label></th>
					<td><input name="tanggal_pengajuan" type="text" id="tanggal_pengajuan" value="'.$users->tanggal_pengajuan.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="contoh_desainindustri">Contoh Desain Industri</label></th>
					<td><input name="contoh_desainindustri" type="file" id="contoh_desainindustri" value="'.$users->contoh_desainindustri.'" /><small>Allowed type: pdf, doc, png, jpg and jpeg.</small></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="desc_desainindustri">Deskripsi Desain Industri</label></th>
					<td><input name="desc_desainindustri" type="text" id="desc_desainindustri" value="'.$users->desc_desainindustri.'" class="regular-text" /></td>
					</tr>
					</table>
					<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes" /> <a href="'.$_SERVER['HTTP_REFERER'].'" class="add-new-h2">Go back</a></p>
		';
	}
	$html .= '</div>';
	return $html;
	
}

function modify_indikasigeo(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	
	if ($_POST['submit'] == 'Save Changes'){
	
		$wpdb->query("
			UPDATE wp_indikasigeo
			SET nama_pemohon='".$_POST['nama_pemohon']."', 
				alamat_pemohon='".$_POST['alamat_pemohon']."', 
				kota='".$_POST['kota']."', 
				kode_pos='".$_POST['kode_pos']."', 
				negara='".$_POST['negara']."', 
				telepon='".$_POST['telepon']."',
				fax='".$_POST['fax']."',
				nama_indikasigeo='".$_POST['nama_indikasigeo']."', 
				nama_barang='".$_POST['nama_barang']."', 
				uraian_indikasigeo='".$_POST['uraian_indikasigeo']."', 
				etiket_indikasigeo='".$_POST['etiket_indikasigeo']."'	
			WHERE id='".$_GET['id']."'
			");
			
			// start upload files
			if(!empty($_FILES['etiket_indikasigeo']['tmp_name']))
			{			
			$overrides = array('test_form' => false, 'mimes' => array('pdf' => 'application/pdf' , 'jpg' => 'image/jpeg' , 'png' => 'image/png' , 'jpeg' => 'image/jpeg' , 'doc' => 'application/msword'));
    
    		wp_handle_upload($_FILES['etiket_indikasigeo'], $overrides);
			}
			// end upload files
			
			
		//echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify'.'"</script>';
		//echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=modify'.'"</script>' ;
		echo '<script>location="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=haki_member&act=view_member'.'"</script>' ;
   		//echo "saved";
		exit;
	}
	
	$userdata = $wpdb->get_results ('SELECT * from wp_indikasigeo WHERE id="'.$_GET['id'].'"');
	foreach ($userdata as $users){
	
		$html  = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Modify Indikasi Geografis</h2><br />';
		$html .= '<form method="post" action="?page=haki_member&act=modify_indikasigeo&id='.$_GET['id'].'" enctype="multipart/form-data">
				  <table class="form-table">
				  <tr valign="top">
				  <th scope="row"><label for="nama_pemohon">Nama Pemohon</label></th>
				  <td><input name="nama_pemohon" type="text" id="nama_pemohon" value="'.$users->nama_pemohon.'" class="regular-text" /></td>
			      </tr>
					<tr valign="top">
					<th scope="row"><label for="alamat_pemohon">Alamat Pemohon</label></th>
					<td><input name="alamat_pemohon" type="text" id="alamat_pemohon" value="'.$users->alamat_pemohon.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kota">Kota</label></th>
					<td><input name="kota" type="text" id="kota" value="'.$users->kota.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="kode_pos">Kode Pos</label></th>
					<td><input name="kode_pos" type="text" id="kode_pos" value="'.$users->kode_pos.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="negara">Negara</label></th>
					<td><input name="negara" type="text" id="negara" value="'.$users->negara.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="telepon">Telepon</label></th>
					<td><input name="telepon" type="text" id="telepon" value="'.$users->telepon.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="fax">Fax</label></th>
					<td><input name="fax" type="text" id="fax" value="'.$users->fax.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="indikasigeo">Nama Indikasi Geografis</label></th>
					<td><input name="indikasigeo" type="text" id="indikasigeo" value="'.$users->nama-indikasigeo.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="nama_barang">Nama Barang</label></th>
					<td><input name="nama_barang" type="text" id="nama_barang" value="'.$users->nama_barang.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="uraian_indikasigeo">Uraian Indikasi Geografis</label></th>
					<td><input name="uraian_indikasigeo" type="text" id="uraian_indikasigeo" value="'.$users->uraian_indikasigeo.'" class="regular-text" /></td>
					</tr>
					<tr valign="top">
					<th scope="row"><label for="etiket_indikasigeo">Etiket Indikasi Geografis</label></th>
					<td><input name="etiket_indikasigeo" type="file" id="etiket_indikasigeo" value="'.$users->etiket_indikasigeo.'" /><small>Allowed type: pdf, doc, png, jpg and jpeg.</small></td>
					</tr>
					</table>
					<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes" /> <a href="'.$_SERVER['HTTP_REFERER'].'" class="add-new-h2">Go back</a></p>
		';
	}
	$html .= '</div>';
	
	return $html;
	
}
// function buat kirim email beserta attachment
function send_email(){
	
	/*
	move_uploaded_file($_FILES["attachment"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment']['name']));
	$attachments = array(WP_CONTENT_DIR ."/uploads/".$_FILES["attachment"]["name"]);
	
	*/
   $attachments = array(WP_CONTENT_DIR . '/uploads/DaftarRiwayatHidup.pdf');
   $qq = $wpdb->get_results('SELECT email from wp_member WHERE username="'.$_GET['username'].'"');
   $headers = 'From: DaftarHaki.com <haki@DaftarHaki.com>' . "\r\n";
   foreach ($qq as $email){
   $to = $email->email;
   }
   $subject = 'Pendaftaran HAKI';
   $message = '<h1>Ini test email :mahos</h1>';
   wp_mail($to, $subject, $message, $headers, $attachments);
   
}


//------ add @ 02-march-2012

function view_merek() {

	global $hkibcomm_settings, $wpdb;

			$res = $wpdb->get_results('select * from wp_haki where username="'.$_GET['username'].'"');
			//$res2 = $wpdb->get_results('SELECT * from wp_member where username="'.$_GET['username'].'"');
			$asd = $wpdb->get_results('SELECT status from wp_logstatus where username="'.$_GET['username'].'"');
			$restab = '';$tabbol = 0;

			foreach ($res as $val){
				//foreach ($asd as $val2) {
				$restab .= '<tr '.(($tabbol & 1)?'class="alternate"':'').'>
						<td><input type="checkbox"/></td>
						<td>'.$val->nama_pemohon.'</td>
						<td>'.$val->nama_merek.'</td>';
						foreach ($asd as $val2){
						$restab .='<td><strong>'.$val2->status.'</strong></td>';
						}
						$restab .='<td><strong><a href="?page=haki_member&act=modify_haki&id='.$val->id.'">Modify</a></strong></td>
						</tr>';
				$tabbol++;
				//}
			}
	
	/*
	
	----- ini buat modify... :genits
	
	<a href="?page=haki_member&act=modify_haki&id='.$_GET['id'].'" class="add-new-h2">Modify HAKI</a>
	<a href="?page=haki_member&act=modify_paten&id='.$_GET['id'].'" class="add-new-h2">Modify Paten</a>
	<a href="?page=haki_member&act=modify_hakcipta&id='.$_GET['id'].'" class="add-new-h2">Modify Hak Cipta</a>
	<a href="?page=haki_member&act=modify_desainindustri&id='.$_GET['id'].'" class="add-new-h2">Modify Desain Industri</a>
	<a href="?page=haki_member&act=modify_indikasigeo&id='.$_GET['id'].'" class="add-new-h2">Modify Indikasi Geografis</a></h2><p />
	 
	----- ini buat add... :mahos
	
	<a href="?page=haki_member&act=add_haki&username='.$_GET['username'].'" class="add-new-h2">Add HAKI</a>
	<a href="?page=haki_member&act=add_paten&username='.$_GET['username'].'" class="add-new-h2">Add Paten</a>
	<a href="?page=haki_member&act=add_hakcipta&username='.$_GET['username'].'" class="add-new-h2">Add Hak Cipta</a>  
	<a href="?page=haki_member&act=add_desainindustri&username='.$_GET['username'].'" class="add-new-h2">Add Desain Industri</a>  
	<a href="?page=haki_member&act=add_indikasigeo&username='.$_GET['username'].'" class="add-new-h2">Add Indikasi Geografis</a>  
	
	*/
	
	$html  = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Daftar Merek<p />';
	$html .= '<table rel="" id="" cellspacing="0" class="widefat">
			<thead>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column column-image" scope="col">Nama Pemohon</th>
				<th class="manage-column" scope="col">Nama Merek</th>
				<th class="manage-column" scope="col">Status Log</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</thead>

			<tfoot>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column column-image" scope="col">Nama Pemohon</th>
				<th class="manage-column" scope="col">Nama Merek</th>
				<th class="manage-column" scope="col">Status Log</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</tfoot>
			<tbody>
			'.$restab.'
			</tbody>
			</table>
			';

	return $html;	
}


function view_paten() {

	global $hkibcomm_settings, $wpdb;

			$res = $wpdb->get_results('select * from wp_paten where username="'.$_GET['username'].'"');
			//$res2 = $wpdb->get_results('SELECT * from wp_member where username="'.$_GET['username'].'"');
			$asd = $wpdb->get_results('SELECT status from wp_logstatus where username="'.$_GET['username'].'"');
			$restab = '';$tabbol = 0;

			foreach ($res as $val){
				//foreach ($asd as $val2) {
				$restab .= '<tr '.(($tabbol & 1)?'class="alternate"':'').'>
						<td><input type="checkbox"/></td>
						<td>'.$val->nama_pemohon.'</td>
						<td>'.$val->judul_paten.'</td>
						<td>'.$val->status.'</td>
						<td><strong><a href="?page=haki_member&act=modify_paten&id='.$val->id.'">Modify</a></strong></td>
						</tr>';
				$tabbol++;
				//}
			}
	
	/*
	
	----- ini buat modify... :genits
	
	<a href="?page=haki_member&act=modify_haki&id='.$_GET['id'].'" class="add-new-h2">Modify HAKI</a>
	<a href="?page=haki_member&act=modify_paten&id='.$_GET['id'].'" class="add-new-h2">Modify Paten</a>
	<a href="?page=haki_member&act=modify_hakcipta&id='.$_GET['id'].'" class="add-new-h2">Modify Hak Cipta</a>
	<a href="?page=haki_member&act=modify_desainindustri&id='.$_GET['id'].'" class="add-new-h2">Modify Desain Industri</a>
	<a href="?page=haki_member&act=modify_indikasigeo&id='.$_GET['id'].'" class="add-new-h2">Modify Indikasi Geografis</a></h2><p />
	 
	----- ini buat add... :mahos
	
	<a href="?page=haki_member&act=add_haki&username='.$_GET['username'].'" class="add-new-h2">Add HAKI</a>
	<a href="?page=haki_member&act=add_paten&username='.$_GET['username'].'" class="add-new-h2">Add Paten</a>
	<a href="?page=haki_member&act=add_hakcipta&username='.$_GET['username'].'" class="add-new-h2">Add Hak Cipta</a>  
	<a href="?page=haki_member&act=add_desainindustri&username='.$_GET['username'].'" class="add-new-h2">Add Desain Industri</a>  
	<a href="?page=haki_member&act=add_indikasigeo&username='.$_GET['username'].'" class="add-new-h2">Add Indikasi Geografis</a>  
	
	*/
	
	$html  = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Daftar Paten<p />';
	$html .= '<table rel="" id="" cellspacing="0" class="widefat">
			<thead>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column column-image" scope="col">Nama Pemohon</th>
				<th class="manage-column" scope="col">Judul Paten</th>
				<th class="manage-column" scope="col">Status Log</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</thead>

			<tfoot>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column column-image" scope="col">Nama Pemohon</th>
				<th class="manage-column" scope="col">Judul Paten</th>
				<th class="manage-column" scope="col">Status Log</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</tfoot>
			<tbody>
			'.$restab.'
			</tbody>
			</table>
			';

	return $html;	
}

function view_hakcipta() {

	global $hkibcomm_settings, $wpdb;

			$res = $wpdb->get_results('SELECT * from wp_hakcipta where username="'.$_GET['username'].'"');
			//$res2 = $wpdb->get_results('SELECT * from wp_member where username="'.$_GET['username'].'"');
			$asd = $wpdb->get_results('SELECT status from wp_logstatus where username="'.$$_GET['username'].'"');
			$restab = '';$tabbol = 0;

			foreach ($res as $val){
				//foreach ($asd as $val2) {
				$restab .= '<tr '.(($tabbol & 1)?'class="alternate"':'').'>
						<td><input type="checkbox"/></td>
						<td>'.$val->nama_pemohon.'</td>
						<td>'.$val->judul_hakcipta.'</td>
						<td>'.$val->status.'</td>
						<td><strong><a href="?page=haki_member&act=modify_hakcipta&id='.$val->id.'">Modify</a></strong></td>
						</tr>';
				$tabbol++;
				//}
			}
	

	
	$html  = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Daftar Hak Cipta<p />';
	$html .= '<table rel="" id="" cellspacing="0" class="widefat">
			<thead>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column column-image" scope="col">Nama Pemohon</th>
				<th class="manage-column" scope="col">Judul Hak Cipta</th>
				<th class="manage-column" scope="col">Status Log</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</thead>

			<tfoot>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column column-image" scope="col">Nama Pemohon</th>
				<th class="manage-column" scope="col">Judul Hak Cipta</th>
				<th class="manage-column" scope="col">Status Log</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</tfoot>
			<tbody>
			'.$restab.'
			</tbody>
			</table>
			';

	return $html;	
}

function view_desainindustri() {

	global $hkibcomm_settings, $wpdb;

			$res = $wpdb->get_results('select * from wp_desainindustri where username="'.$_GET['username'].'"');
			//$res2 = $wpdb->get_results('SELECT * from wp_member where username="'.$_GET['username'].'"');
			$asd = $wpdb->get_results('SELECT status from wp_logstatus where username="'.$_GET['username'].'"');
			$restab = '';$tabbol = 0;

			foreach ($res as $val){
				//foreach ($asd as $val2) {
				$restab .= '<tr '.(($tabbol & 1)?'class="alternate"':'').'>
						<td><input type="checkbox"/></td>
						<td>'.$val->nama_pemohon.'</td>
						<td>'.$val->judul_desainindustri.'</td>
						<td>'.$val->status.'</td>
						<td><strong><a href="?page=haki_member&act=modify_desainindustri&id='.$val->id.'">Modify</a></strong></td>
						</tr>';
				$tabbol++;
				//}
			}
	
	$html  = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Daftar Desain Industri<p />';
	$html .= '<table rel="" id="" cellspacing="0" class="widefat">
			<thead>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column column-image" scope="col">Nama Pemohon</th>
				<th class="manage-column" scope="col">Judul Desain Industri</th>
				<th class="manage-column" scope="col">Status Log</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</thead>

			<tfoot>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column column-image" scope="col">Nama Pemohon</th>
				<th class="manage-column" scope="col">Judul Desain Industri</th>
				<th class="manage-column" scope="col">Status Log</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</tfoot>
			<tbody>
			'.$restab.'
			</tbody>
			</table>
			';

	return $html;	
}

function view_indikasigeo() {

	global $hkibcomm_settings, $wpdb;

			$res = $wpdb->get_results('select * from wp_indikasigeo where username="'.$_GET['username'].'"');
			//$res2 = $wpdb->get_results('SELECT * from wp_member where username="'.$_GET['username'].'"');
			$asd = $wpdb->get_results('SELECT status from wp_logstatus where username="'.$_GET['username'].'"');
			$restab = '';$tabbol = 0;

			foreach ($res as $val){
				//foreach ($asd as $val2) {
				$restab .= '<tr '.(($tabbol & 1)?'class="alternate"':'').'>
						<td><input type="checkbox"/></td>
						<td>'.$val->nama_pemohon.'</td>
						<td>'.$val->nama_indikasigeo.'</td>
						<td>'.$val->status.'</td>
						<td><strong><a href="?page=haki_member&act=modify_indikasigeo&id='.$val->id.'">Modify</a></strong></td>
						</tr>';
				$tabbol++;
				//}
			}
	
	
	$html  = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Daftar Indikasi Geografis<p />';
	$html .= '<table rel="" id="" cellspacing="0" class="widefat">
			<thead>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column column-image" scope="col">Nama Pemohon</th>
				<th class="manage-column" scope="col">Nama Indikasi Geografis</th>
				<th class="manage-column" scope="col">Status Log</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</thead>

			<tfoot>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column column-image" scope="col">Nama Pemohon</th>
				<th class="manage-column" scope="col">Nama Indikasi Geografis</th>
				<th class="manage-column" scope="col">Status Log</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</tfoot>
			<tbody>
			'.$restab.'
			</tbody>
			</table>
			';

	return $html;	
}


function inibuat_tab() {

	$html = '<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
	</script>



<div class="demo">

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Nunc tincidunt</a></li>
		<li><a href="#tabs-2">Proin dolor</a></li>
		<li><a href="#tabs-3">Aenean lacinia</a></li>
	</ul>
	<div id="tabs-1">
		<p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
	</div>
	<div id="tabs-2">
		<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
	</div>
	<div id="tabs-3">
		<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
		<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
	</div>
</div>

</div><!-- End demo -->



<div class="demo-description" style="display: none; ">
<p>Click tabs to swap between content that is broken into logical sections.</p>
</div><!-- End demo-description -->';
echo $html;
}

function modify_statuslog(){

	global $hkibcomm_settings, $wpdb, $hkibcomm_base_dir;
	$username = $_GET['username'];
	$res = $wpdb->get_results('select * from wp_logstatus where username="nomadentech"');
	$restab = '';$tabbol = 0;

	foreach ($res as $val){
		$restab .= '<tr '.(($tabbol & 1)?'class="alternate"':'').'>
				<td><input type="checkbox"/></td>
				<td>'.$val->created_date.'</td>
				<td><select> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> </select></td>
				<td>'.$val->ket.'</td>
				<td>'.$val->other.'</td>
			</tr>';
		$tabbol++;
	}

	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Status Log</h2><br />';
	$html .='
			<table rel="" id="" cellspacing="0" class="widefat">
			<thead>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column" scope="col">Date Time</th>
				<th class="manage-column" scope="col">Status</th>
				<th class="manage-column" scope="col">Desc</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</thead>

			<tfoot>
			<tr>
				<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
				<th class="manage-column" scope="col">Date Time</th>
				<th class="manage-column" scope="col">Status</th>
				<th class="manage-column" scope="col">Desc</th>
				<th class="manage-column" scope="col">Manage</th>
			</tr>
			</tfoot>
			<tbody>
			'.$restab.'
			</tbody>
			</table>
			';
	
	echo $html;
}
function insert_attachment($file_handler,$post_id,$setthumb='false') {

  
}

function upploadsss(){

	$html = '<p>Upload Image <label for="upload_image">
			<input id="upload_image" name="upload_image" size="36" type="text" />
			<input id="upload_image_button" name="upload_image" type="button" value="Upload Image" />
			Enter an URL or upload an image for the banner.
			</label>
			';
	echo $html;
	
	
}

function fileuploadas( $label ) { 

}

function fileupload() {

	if($_POST['submit']=='upload') {
		$files = $_FILES['uploadfiles'];
		wp_upload_handle($files, $overrides, null);
	}
	
	$html = '<form enctype="multipart/form-data" action="?page=fileupload" method="post" id="uploadfile_form">
			 <input type="file" id="uploadfiles" name="uploadfiles" id="uploadfiles">
			 <input type="submit" name="uploadfile" id="uploadfile_btn" value="upload">
			 </form>';
	echo $html;
	
}

function modify_log(){

	
}

if ( !class_exists( 'WPEasyUploader' ) ) {
	class WPEasyUploader {
		var $_var = "wp-easy-uploader";
		var $_name = "WP Easy Uploader";
		var $_class = '';
		var $_initialized = false;
		var $_options = array();
		var $_userID = 0;
		var $_usedInputs = array();
		var $_selectedVars = array();
		var $_pluginPath = '';
		var $_pluginRelativePath = '';
		var $_pluginURL = '';
	
		
		
		function WPEasyUploader() {
			add_action( 'plugins_loaded', array( $this, 'init' ), -10 );
		}
		
		function init() {
			if ( current_user_can('manage_options') ) {
				if( ! $this->_initialized ) {
					$this->_setVars();
					$this->load();
					
					load_plugin_textdomain( $this->_var, $this->_pluginRelativePath . '/lang' );
					
					add_action( 'admin_menu', array( $this, 'addPages' ) );
					
					$this->_initialized = true;
				}
			}
		}
		
		function addPages() {
			if ( function_exists( 'add_management_page' ) )
				
				add_menu_page (__('WP Easy Uploader', $this->_var ), __('Upload Files', $this->_var), 'manage_options', __FILE__, array($this, 'uploadsPage'));
				//add_management_page( __( 'WP Easy Uploader', $this->_var ), __( 'Upload Files', $this->_var ), 'manage_options', __FILE__, array( $this, 'uploadsPage' ) );
		}
		
		function _setVars() {
			$this->_class = get_class( $this );
			
			$user = wp_get_current_user();
			$this->_userID = $user->ID;
			
			
			// Thanks Ozh
			// http://planetozh.com/blog/2008/07/what-plugin-coders-must-know-about-wordpress-26/
			if ( !defined( 'WP_CONTENT_URL' ) )
				define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content');
			if ( !defined( 'WP_CONTENT_DIR' ) )
				define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
			
			$this->_pluginPath = WP_CONTENT_DIR . '/plugins/' . plugin_basename( dirname( __FILE__ ) );
			$this->_pluginRelativePath = str_replace( ABSPATH, '', $this->_pluginPath );
			
			$this->_pluginURL = WP_CONTENT_URL . '/plugins/' . plugin_basename( dirname( __FILE__ ) );
		}
		
		
		// Options Storage ////////////////////////////
		
		function initializeOptions() {
			$this->_options['placeholder'] = 1;
			
			$this->save();
		}
		
		function save() {
			$data = @get_option( $this->_var );
			
			if ( isset( $data ) && ( $data === $this->_options ) )
				return true;
			
			$data = $this->_options;
			
			return update_option( $this->_var, $data );
		}
		
		function load() {
			$data = @get_option( $this->_var );
			
			if ( is_array( $data ) )
				$this->_options = $data;
			else
				$this->initializeOptions();
		}
		
		
		// Pages //////////////////////////////////////
		
		function uploadsPage() {
			$error = false;
			
			if ( ! empty( $_POST['upload'] ) ) {
				check_admin_referer( $this->_var . '-nonce' );
				
				
				$uploads = array();
				$file = array();
				
				if ( 'plugin' == $_POST[$this->_var]['destinationSelection'] )
					$uploads = array( 'path' => trailingslashit( WP_CONTENT_DIR ) . '/plugins/', 'url' => trailingslashit( WP_CONTENT_URL ) . 'plugins/', 'subdir' => '', 'error' => false );
				elseif ( 'theme' == $_POST[$this->_var]['destinationSelection'] )
					$uploads = array( 'path' => get_theme_root(), 'url' => get_theme_root_uri(), 'subdir' => '', 'error' => false );
				elseif ( 'manual' == $_POST[$this->_var]['destinationSelection'] ) {
					if ( preg_match( '/^[\/\\\\]/', $_POST[$this->_var]['destinationPath'] ) )
						$file['error'] = __( 'The Manual Path must be relative (cannot begin with \ or /).', $this->_var );
					elseif ( preg_match( '/\.\./', $_POST[$this->_var]['destinationPath'] ) )
						$file['error'] = __( 'Previous directory paths (..) are not permitted in the Manual Path.', $this->_var );
					else {
						if ( empty( $_POST[$this->_var]['destinationPath'] ) ) {
							$path = ABSPATH;
							$url = get_option( 'siteurl' );
						}
						else {
							$path = path_join( ABSPATH, $_POST[$this->_var]['destinationPath'] );
							$url = trailingslashit( get_option( 'siteurl' ) ) . $_POST[$this->_var]['destinationPath'];
						}
						
						if ( ! wp_mkdir_p( $path ) )
							$file['error'] = sprintf( __( 'Unable to create path %s. Ensure that the web server has permission to write to the parent of this folder.', $this->_var ), $path );
						else 
							$uploads = array( 'path' => $path, 'url' => $url, 'subdir' => '', 'error' => false );
					}
				}
				
				$overwriteFile = ( ! empty( $_POST[$this->_var]['overwriteFile'] ) ) ? true : false;
				$renameIfExists = ( ! empty( $_POST[$this->_var]['renameIfExists'] ) ) ? true : false;
				
				if ( empty( $file['error'] ) ) {
					if ( ! empty( $_POST[$this->_var]['uploadURL'] ) )
						$file = $this->getFileFromURL( $_POST[$this->_var]['uploadURL'], $uploads, $overwriteFile, $renameIfExists );
					elseif ( ! empty( $_FILES['uploadFile']['name'] ) )
						$file = $this->getFileFromPost( 'uploadFile', $uploads, $overwriteFile, $renameIfExists );
					else
						$file['error'] = __( 'You must either provide a URL or a system file to upload.', $this->_var );
				}
				
				
				if ( false === $file['error'] ) {
					$this->showStatusMessage( __( 'File successfully uploaded', $this->_var ) );
					
					$extracted = false;
					
					if ( ! empty( $_POST[$this->_var]['extract'] ) ) {
						$forceExtractionFolder = ( ! empty( $_POST[$this->_var]['forceExtractionFolder'] ) ) ? true : false;
						
						$result = $this->extractArchive( $file, $forceExtractionFolder );
						
						if ( true === $result['extracted'] ) {
							$path = str_replace( '/', '\\/', ABSPATH );
							$destination = preg_replace( '/^' . $path . '/', '', $result['destination'] );
							
							$this->showStatusMessage( sprintf( __( 'Archive successfully extracted to %s', $this->_var ), $destination ) );
							
							$extracted = true;
							
							if ( ! empty( $_POST[$this->_var]['removeArchive'] ) ) {
								if ( unlink( $file['path'] ) )
									$this->showStatusMessage( __( 'Archive removed', $this->_var ) );
								else {
									$this->showErrorMessage( __( 'Unable to remove archive', $this->_var ) );
									$error = true;
								}
							}
						}
						elseif ( false !== $result['error'] ) {
							$this->showErrorMessage( $result['error'] );
							$error = true;
						}
					}
					
					if ( ! $extracted ) {
						ini_set( 'display_errors', '1' );
						error_reporting( E_ALL );
						
						$path = ABSPATH;
						$path = str_replace( '\\', '\\\\', $path );
						$path = str_replace( '/', '\\/', $path );
						
						$destination = preg_replace( '/^' . $path . '/', '', $file['path'] );
						
						$message = '<p>' . sprintf( __( 'Path: %s', $this->_var ), $destination ) . '</p>';
						$message .= '<p>' . sprintf( __( 'URL: <a href="%s" target="newUpload">%s</a>', $this->_var ), $file['url'], $file['url'] ) . '</p>';
						
						$this->showStatusMessage( $message );
					}
				}
				else {
					$this->showErrorMessage( $file['error'] );
					$error = true;
				}
			}
			
			
?>
	<div class="wrap">
		<h2><?php _e( 'Upload Files', $this->_var ); ?></h2>
		
		<form enctype="multipart/form-data" method="post" action="<?php echo $this->getBackLink() ?>">
			<?php wp_nonce_field( $this->_var . '-nonce' ); ?>
			<table class="form-table">
				<tr><th scope="row"><?php _e( 'Upload File', $this->_var ); ?></th>
					<td>
						<label for="uploadFile">
							<?php _e( 'Select From System:', $this->_var ); ?> <input type="file" name="uploadFile" id="uploadFile" />
						</label>
					</td>
				</tr>
				
			</table>
			
			<?php $this->addSubmitButton( 'upload', __( 'Upload', $this->_var ) ); ?>
			<?php $this->addHidden( 'action', 'wp_handle_upload' ); ?>
		</form>
	</div>
<?php
		}
		
		
		// Form Handling Functions //////////////////
		
		function addHidden( $name, $value ) {
			if ( is_array( $value ) )
				$value = implode( ',', $value );
			
			echo '<input type="hidden" name="' . $name . '" value="' . $value . '" />';
		}
		
		function addSubmitButton( $name, $value, $disabled = false ) {
			echo '<p class="submit"><input type="submit" name="' . $name . '" value="' . $value . '" /></p>';
		}
	
		function addUsedInputs() {
			$usedInputs = '';
			
			foreach ( (array) $this->_usedInputs as $input ) {
				if ( ! empty( $usedInputs ) )
					$usedInputs .= ',';
				
				$usedInputs .= $input;
			}
			
			if ( ! empty( $usedInputs ) )
				echo '<input type="hidden" name="used-inputs" value="' . $usedInputs . '" />' . "\n";
		}
		
		function addShowHideLink( $elementID, $message, $hidden, $alterText = true ) {
			echo $this->getShowHideLink( $elementID, $message, $hidden, $alterText );
		}
		
		function getShowHideLink( $elementID, $message, $hidden, $alterText = true ) {
			if($hidden)
				$text = __( 'Show', $this->_var );
			else
				$text = __( 'Hide', $this->_var );
			
			if ( $alterText )
				return "<a id=\"$elementID-toggle\" href=\"javascript:{}\" onclick=\"if(document.getElementById('$elementID').style.display == 'none') { document.getElementById('$elementID').style.display = 'block'; document.getElementById('$elementID-toggle').innerHTML = 'Hide $message'; } else { document.getElementById('$elementID').style.display = 'none'; document.getElementById('$elementID-toggle').innerHTML = 'Show $message'; } return false;\">$text $message</a>";
			else
				return "<a id=\"$elementID-toggle\" href=\"javascript:{}\" onclick=\"if(document.getElementById('$elementID').style.display == 'none') { document.getElementById('$elementID').style.display = 'block'; document.getElementById('$elementID-toggle').innerHTML = '$message'; } else { document.getElementById('$elementID').style.display = 'none'; document.getElementById('$elementID-toggle').innerHTML = '$message'; } return false;\">$message</a>";
		}
		
		function addRadio( $base, $variable, $value, $message, $disabled = false ) {
			$selected = '';
			
			if ( isset( $_POST[$base][$variable] ) ) {
				if ( $value == $_POST[$base][$variable] )
					$selected = ' checked="checked"';
			}
			elseif ( empty( $this->_selectedVars[$variable] ) ) {
				$this->_selectedVars[$variable] = true;
				$selected = ' checked="checked"';
			}
	
?>
				<label for="<?php echo $base ?>-<?php echo $variable; ?>-<?php echo $value; ?>">
					<input name="<?php echo $base ?>[<?php echo $variable; ?>]" type="radio" id="<?php echo $base ?>-<?php echo $variable; ?>-<?php echo $value; ?>" value="<?php echo $value; ?>"<?php echo $selected ?><?php if ( $disabled ) echo ' disabled'; ?> />
					<?php echo $message; ?>
				</label>
<?php
			
			$this->_usedInputs[] = $variable;
		}

		function addCheckBox( $base, $variable, $value, $message, $disabled = false, $selected = false ) {
?>
						<label for="<?php echo $base ?>-<?php echo $variable; ?>">
							<input name="<?php echo $base ?>[<?php echo $variable; ?>]" type="checkbox" id="<?php echo $base ?>-<?php echo $variable; ?>" value="<?php echo $value; ?>"<?php if ( ( ! empty( $_POST[$base][$variable] ) && ( $value == $_POST[$base][$variable] ) ) || $selected ) echo ' checked="checked"'; ?><?php if ( $disabled ) echo ' disabled'; ?> />
							<?php echo $message; ?>
						</label>
<?php
		
			$this->_usedInputs[] = $variable;
		}
		
		function saveFormOptions() {
			if ( isset( $_POST['save'] ) && isset( $_POST[$this->_var] ) && is_array( $_POST[$this->_var] ) )
			{
				if ( function_exists( 'current_user_can' ) && ! current_user_can( 'manage_options' ) )
					die( __( 'Cheatin uh?' ) );
				
				check_admin_referer( $this->_var . '-nonce' );
				
				if ( ! empty( $_POST['used-inputs'] ) ) {
					$usedInputs = explode( ',', $_POST['used-inputs'] );
					
					foreach ( (array) $usedInputs as $input ) {
						if ( isset( $_POST[$this->_var][$input] ) )
							$this->_options[$input] = $_POST[$this->_var][$input];
						elseif ( isset( $this->_options[$input] ) )
							unset( $this->_options[$input] );
					}
				}
				else
					foreach ( $_POST[$this->_var] as $key => $val )
						$this->_options[$key] = $val;
				
				
				if ( $this->save() )
					$this->showStatusMessage( __( 'Configuration updated', $this->_var ) );
				else {
					$this->showErrorMessage( __( 'Error while saving options', $this->_var ) );
					return false;
				}
			}
			
			return true;
		}
		
		// Plugin Functions ///////////////////////////
		
		// This is based off of code from the Google Sitemap Generator.
		// It was modified to support WordPress Mu.
		// Thanks Arne Brachhold :)
		function getBackLink() {
			return $_SERVER['REQUEST_URI'];
			
//			$page = basename( __FILE__ );
//			if ( isset( $_GET['page'] ) && ! empty( $_GET['page'] ) )
//				$page = preg_replace( '[^a-zA-Z0-9\.\_\-]', '', $_GET['page'] );
//			
//			return $_SERVER['PHP_SELF'] . '?page=' .  $page;
		}
		
		function showStatusMessage( $message ) {
			
?>
	<div id="message" class="updated fade"><p><strong><?php echo $message; ?></strong></p></div>
<?php
			
		}
		
		function showErrorMessage( $message ) {
			
?>
	<div id="message" class="error"><p><strong><?php echo $message; ?></strong></p></div>
<?php
			
		}
		function getFileFromPost( $var, $uploads, $overwriteFile = false, $renameIfExists = true ) {
			$file = array();
			
			$overrides['overwriteFile'] = $overwriteFile;
			$overrides['renameIfExists'] = $renameIfExists;
			if ( ! empty( $uploads ) )
				$overrides['uploads'] = $uploads;
			
			$results = $this->handle_upload( $_FILES[$var], $overrides, $overwriteFile, $renameIfExists );
			
			if ( empty( $results['error'] ) ) {
				$file['path'] = $results['file'];
				$file['url'] = $results['url'];
				$file['originalName'] = preg_replace( '/\s+/', '_', $_FILES[$var]['name'] );
				$file['error'] = false;
			}
			else {
				$file['error'] = $results['error'];
			}
			
			return $file;
		}
		// I got this function from PlugInstaller (http://henning.imaginemore.de/pluginstaller/)
		// Thanks Henning Schaefer
		function getFileFromURL( $url, $uploads, $overwriteFile = false, $renameIfExists = true ) {
			$file = array();
			
			if ( preg_match( '/([^\/]+)$/', $url, $matches ) ) {
				$file['originalName'] = preg_replace( '/\s+/', '_', $matches[1] );
			}
			
			if ( false === ( $data = @file_get_contents( $url ) ) ) {
				$curl = curl_init( $url );
				curl_setopt( $curl, CURLOPT_HEADER, 0 );  // ignore any headers
				ob_start();  // use output buffering so the contents don't get sent directly to the browser
				curl_exec( $curl );  // get the file
				curl_close( $curl );
				$data = ob_get_contents();  // save the contents of the file into $file
				ob_end_clean();  // turn output buffering back off
			}
			
			$error = '';
			$message = '';
			
			if ( empty( $uploads ) )
				$uploads = wp_upload_dir();
			
			if ( false === $uploads['error'] ) {
				$filename = $this->unique_filename( $uploads['path'], $file['originalName'] );
				
				if ( file_exists( $uploads['path'] . '/' . $file['originalName'] ) ) {
					if ( $overwriteFile )
						$filename = $file['originalName'];
					elseif ( ! $renameIfExists )
						$error = __( 'The file already exists. Since overwriting and renaming are not permitted, the file was not added.', $this->_var );
				}
				
				
				if ( '' === $error ) {
					if ( false === $this->writeFile( $uploads['path'] . '/' . $filename, $data ) ) {
						if ( $renameIfExists ) {
							$filename = $this->unique_filename( $uploads['path'], $file['originalName'] );
							
							if ( false === $this->writeFile( $uploads['path'] . '/' . $filename, $data ) )
								$error = sprintf( __( 'The uploaded file could not be moved to %s. Please check the folder and file permissions.', $this->_var ), $uploads['path'] . '/' . $filename );
							else
								$message = __( 'Unable to overwrite existing file. Since renaming is permitted, the file was saved with a new name.', $this->_var );
						}
						else
							$error = sprintf( __( 'The uploaded file could not be moved to %s. Please check the folder and file permissions.', $this->_var ), $uploads['path'] . '/' . $filename );
					}
					else
						$message = __( 'Original file overwritten.', $this->_var );
				}
				
				$stat = stat( dirname( $uploads['path'] . '/' . $filename ) );
				$perms = $stat['mode'] & 0000666;
				@ chmod( $uploads['path'] . '/' . $filename, $perms );
				
				if ( ! empty( $error ) )
					$file['error'] = $error;
				else {
					$uploads['path'] = preg_replace( '/\/+/', '/', $uploads['path'] );
					
					$file['path'] = $uploads['path'] . '/' . $filename;
					$file['url'] = $uploads['url'] . '/' . $filename;
					$file['error'] = false;
					$file['message'] = '';
				}
			}
			
			
			return $file;
		}
		
		function writeFile( $path, $data ) {
			if ( false !== ( $destination = @fopen( $path, 'w' ) ) ) {
				if ( fwrite( $destination, $data ) ) {
					@fclose( $destination );
					
					return true;
				}
				
				@fclose( $destination );
			}
			
			return false;
		}
		
		// Customized version of wp_unique_filename from v2.5.1 wp-includes/functions.php
		// This version doesn't sanitize the file name
		function unique_filename( $dir, $filename ) {
			$ext = $this->getExtension( $filename );
			$name = basename( $filename, ".{$ext}" );
			
			// edge case: if file is named '.ext', treat as an empty name
			if( $name === ".$ext" )
				$name = '';
			
			$number = '';
			
			if ( empty( $ext ) )
				$ext = '';
			else
				$ext = strtolower( ".$ext" );
			
			$filename = str_replace( '%', '', $filename );
			$filename = preg_replace( '/\s+/', '_', $filename );
			
			while ( file_exists( $dir . '/' . $filename ) ) {
				if ( ! isset( $number ) ) {
					$number = 1;
					$filename = str_replace( $ext, $number . $ext, $filename );
				}
				else
					$filename = str_replace( $number . $ext, ++$number . $ext, $filename );
			}
			
			return $filename;
		}
		
		function getExtension( $filename ) {
			if ( preg_match( '/\.(tar\.\w+)$/' , $filename, $matches ) )
				return $matches[1];
			
			if ( preg_match( '/\.(\w+)$/', $filename, $matches ) )
				return $matches[1];
			
			return '';
		}
		
		// Customized version of wp_handle_upload from v2.5.1 wp-admin/includes/file.php
		function handle_upload( &$file, $overrides = false ) {
			// The default error handler.
			if (! function_exists( 'wp_handle_upload_error' ) ) {
				function wp_handle_upload_error( &$file, $message ) {
					return array( 'error'=>$message );
				}
			}
			
			// You may define your own function and pass the name in $overrides['upload_error_handler']
			$upload_error_handler = 'wp_handle_upload_error';
			
			// $_POST['action'] must be set and its value must equal $overrides['action'] or this:
			$action = 'wp_handle_upload';
			
			// Courtesy of php.net, the strings that describe the error indicated in $_FILES[{form field}]['error'].
			$upload_error_strings = array( false,
				__( "The uploaded file exceeds the <code>upload_max_filesize</code> directive in <code>php.ini</code>.", $this->_var ),
				__( "The uploaded file exceeds the <em>MAX_FILE_SIZE</em> directive that was specified in the HTML form.", $this->_var ),
				__( "The uploaded file was only partially uploaded.", $this->_var ),
				__( "No file was uploaded.", $this->_var ),
				__( "Missing a temporary folder.", $this->_var ),
				__( "Failed to write file to disk.", $this->_var ) );
			
			// All tests are on by default. Most can be turned off by $override[{test_name}] = false;
			$test_form = true;
			$test_size = true;
			
			// If you override this, you must provide $ext and $type!!!!
			$test_type = true;
			$mimes = false;
			
			// Customizable overrides
			$uploads = wp_upload_dir();
			$overwriteFile = false;
			$renameIfExists = true;
			
			$message = '';
			
			// Install user overrides. Did we mention that this voids your warranty?
			if ( is_array( $overrides ) )
				extract( $overrides, EXTR_OVERWRITE );
			
			// A correct form post will pass this test.
			if ( $test_form && (!isset( $_POST['action'] ) || ($_POST['action'] != $action ) ) )
				return $upload_error_handler( $file, __( 'Invalid form submission.', $this->_var ) );
			
			// A successful upload will pass this test. It makes no sense to override this one.
			if ( $file['error'] > 0 )
				return $upload_error_handler( $file, $upload_error_strings[$file['error']] );
			
			// A non-empty file will pass this test.
			if ( $test_size && !($file['size'] > 0 ) )
				return $upload_error_handler( $file, __( 'File is empty. Please upload something more substantial. This error could also be caused by uploads being disabled in your php.ini.', $this->_var ) );
			
			// A properly uploaded file will pass this test. There should be no reason to override this one.
			if (! @ is_uploaded_file( $file['tmp_name'] ) )
				return $upload_error_handler( $file, __( 'Specified file failed upload test.', $this->_var ) );
			
			// A correct MIME type will pass this test. Override $mimes or use the upload_mimes filter.
			if ( $test_type ) {
				$wp_filetype = wp_check_filetype( $file['name'], $mimes );
				
				extract( $wp_filetype );
				
				if ( ( !$type || !$ext ) && !current_user_can( 'unfiltered_upload' ) )
					return $upload_error_handler( $file, __( 'File type does not meet security guidelines. Try another.', $this->_var ) );
				
				if ( !$ext )
					$ext = ltrim(strrchr($file['name'], '.'), '.');
				
				if ( !$type )
					$type = $file['type'];
			}
			
			// A writable uploads dir will pass this test. Again, there's no point overriding this one.
			if ( false !== $uploads['error'] )
				return $upload_error_handler( $file, $uploads['error'] );
			
			$uploads['path'] = untrailingslashit( $uploads['path'] );
			$uploads['path'] = preg_replace( '/\/+/', '/', $uploads['path'] );
			$uploads['url'] = untrailingslashit( $uploads['url'] );
			
			$file['name'] = preg_replace( '/\s+/', '_', $file['name'] );
			
			
			$filename = $this->unique_filename( $uploads['path'], $file['name'] );
			
			if ( file_exists( $uploads['path'] . '/' . $file['name'] ) ) {
				if ( $overwriteFile )
					$filename = $file['name'];
				elseif ( ! $renameIfExists )
					return $upload_error_handler( $file, __( 'The file already exists. Since overwriting and renaming are not permitted, the file was not added.', $this->_var ) );
			}
			
			if ( false === @ move_uploaded_file( $file['tmp_name'], $uploads['path'] . '/' . $filename ) ) {
				if ( $overwriteFile ) {
					$filename = $this->unique_filename( $uploads['path'], $file['name'] );
					
					if ( false === @ move_uploaded_file( $file['tmp_name'], $uploads['path'] . '/' . $filename ) )
						return $upload_error_handler( $file, sprintf( __( 'The uploaded file could not be moved to %s. Please check the folder and file permissions.', $this->_var ), $uploads['path'] ) );
					else
						$message = __( 'Unable to overwrite existing file. Since renaming is permitted, the file was saved with a new name.', $this->_var );
				}
				else
					return $upload_error_handler( $file, sprintf( __( 'The uploaded file could not be moved to %s. Please check the folder and file permissions.', $this->_var ), $uploads['path'] ) );
			}
			
			$stat = stat( dirname( $uploads['path'] . '/' . $filename ) );
			$perms = $stat['mode'] & 0000666;
			@ chmod( $uploads['path'] . '/' . $filename, $perms );
			
			// Compute the URL
			$url = $uploads['url'] . '/' . $filename;
			
			$return = apply_filters( 'wp_handle_upload', array( 'file' => $uploads['path'] . '/' . $filename, 'url' => $url, 'message' => $message, 'error' => false ) );
			
			return $return;
		}
		
		function extractArchive( $file, $forceExtractionFolder = true ) {
			$extensions = array( 'zip', 'tar', 'gz', 'tar.gz', 'tgz', 'tar.bz2', 'tbz' );
			$extension = $this->getExtension( $file['path'] );
			
			$originalIncludePath = ini_get( 'include_path' );
			
			ini_set( 'include_path', dirname(__FILE__) . '/pear' );
			
			if ( ! function_exists( 'file_archive_cleancache' ) )
				require_once( 'File/Archive.php' );
			
			$retval = array();
			
			if ( in_array( $extension, (array) $extensions ) ) {
				if ( is_callable( array( 'File_Archive', 'extract' ) ) && is_callable( array( 'File_Archive', 'read' ) ) ) {
					$backupCWD = getcwd();
					
					$path = dirname( $file['path'] );
					
					chdir( $path );
					
					$source = basename( $file['path'] ) . '/';
					
					if ( $forceExtractionFolder )
						$destination = basename( $file['path'], ".{$extension}" );
					else
						$destination = $path;
	
					$error = File_Archive::extract( $source, $destination );
					
					chdir( $backupCWD );
					
					if ( PEAR::isError( $error ) )
						$retval = array( 'extracted' => false, 'error' => sprintf( __( 'Extraction failed: %s', $this->_var ), $error->getMessage() ) );
					else
						$retval = array( 'destination' => path_join( $path, $destination ), 'extracted' => true, 'error' => false );
				}
				else
					$retval = array( 'extracted' => false, 'error' => __( 'Unable to execute File_Archive::extract', $this->_var ) );
			}
			else
				$retval = array( 'extracted' => false, 'error' => false );
			
			ini_set( 'include_path', $originalIncludePath );
			
			return $retval;
		}
	}
}

if ( class_exists( 'WPEasyUploader' ) ) {
	$wpeasyuploader = new WPEasyUploader();
}

function upload_meneh(){
	
	global $hkibcomm_settings;
	
	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Upload Dokumen Pendukung</h2><br />
			<form method="post" action="?page=upload_meneh" enctype="multipart/form-data">
			<input type="file" name="files_haki" /> <small>Allowed type: pdf, doc, png, jpg, jpeg.</small>
			<p><input class="button-primary" type="submit" name="submit" value="Upload" /></p>
			</form>
				';
	echo $html;
	
	if(!empty($_FILES['files_haki']['tmp_name']))
	{ 
    $overrides = array('test_form' => false, 'mimes' => array('pdf' => 'application/pdf' , 'jpg' => 'image/jpeg' , 'png' => 'image/png' , 'jpeg' => 'image/jpeg' , 'doc' => 'application/msword'));
    wp_handle_upload($_FILES['files_haki'], $overrides);
	echo "<div id='message' class='updated'><p>File Uploaded.</p></div>";
	}else
	{
		echo "<div id='message' class='updated'><p>Empty Files.</p></div>";
	}
}

function ini_upload(){

	global $hkibcomm_settings;
	
	$html = '	<p><table width="500" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
				<tr>
				<form action="?page=ini_upload" method="post" enctype="multipart/form-data" name="form1" id="form1">
				<td>
				<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
				<tr>
				<td><strong>Single File Upload </strong></td>
				</tr>
				<tr>
				<td>Select file 
				<input name="ufile" type="file" id="ufile" size="50" /></td>
				</tr>
				<tr>
				<td align="center"><input type="submit" name="Submit" value="Upload" /></td>
				</tr>
				</table>
				</td>
				</form>
				</tr>
				</table>';
	echo $html;
	
	if(!empty($_FILES['ufile']))
	{
	$file_name = $HTTP_POST_FILES['ufile']['name'];
	$dtm = date("Ymd-H.i.s");
	
	$new_file_name=$dtm.$file_name;
	
	$path= wp_upload_dir().$new_file_name;
	if($ufile !=none)
	{
	if(copy($HTTP_POST_FILES['ufile']['tmp_name'], $path))
	{
	echo "Successful<BR/>";
	echo "File Name :".$new_file_name."<BR/>"; 
	echo "File Size :".$HTTP_POST_FILES['ufile']['size']."<BR/>"; 
	echo "File Type :".$HTTP_POST_FILES['ufile']['type']."<BR/>"; 
	}
	else
	{
	echo "Error";
	}
	}
	}else
	{
		echo "<div id='message' class='updated'><p>Empty Files.</p></div>";
	}
}





?>