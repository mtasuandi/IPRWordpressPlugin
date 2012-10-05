<?php

/*untuk masuk ke database dan sesuaikan dengan path directory masing2 */
require_once(ABSPATH . 'wp-config.php');

/*class2 database dan yg ini jg ya,
sesuaikan dengan path directory masing2  */
require_once(ABSPATH . 'wp-includes/wp-db.php'); 

function tambahmerek_fe(){

	global $hkibcomm_settings;
	
	$html = '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>Upload Dokumen Pendukung</h2><br />
			<form method="post" action="?page=upload_meneh" enctype="multipart/form-data">
			
			<label for="nama_pemohon">Nama Pemohon</label>
			<input name="nama_pemohon" type="text" id="nama_pemohon">
			
			<label for="alamat_pemohon">Alamat Pemohon</label>
			<input name="alamat_pemohon" type="text" id="alamat_pemohon">
			
			<label for="kota_pemohon">Kota Pemohon</label>
			<input name="kota_pemohon" type="text" id="ktoa_pemohon">
			
			<label for=""
			<input type="file" name="iu_homepage_banner_upload" />
			<p><input class="button-primary" type="submit" name="submit" value="Upload" /></p>
			</form>
				';
	echo $html;
	
	if(!empty($_FILES['iu_homepage_banner_upload']['tmp_name']))
	{
    // Must be defined for wp_handle_upload(), otherwise the upload will be rejected
    $overrides = array('test_form' => false);
    
    // Stores the results of WordPress managing the file upload
    $banner_image = wp_handle_upload($_FILES['iu_homepage_banner_upload'], $overrides);
	
	echo "<div id='message' class='updated'><p>File Uploaded.</p></div>";
	}else
	{
		echo "<div id='message' class='updated'><p>Empty Files.</p></div>";
	}

}




