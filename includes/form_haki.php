<?php

require_once(ABSPATH . 'wp-config.php');
require_once(ABSPATH . 'wp-includes/wp-db.php'); 

function register_merek() {
	global $hkibcomm_settings;
	ob_start(); ?>
	
	<?php 
	//show error messages
	hkibcomm_show_error_messages('register'); ?>
	<div id="stylized2" class="myform2">
	<form id="hkibcomm_registration_form" class="hkibcomm_form" action="" method="POST">
		
			<h1><?php _e('Daftar Merek', 'hkibcomm'); ?></h1>
			
				<label for="hkibcomm_user_nama"><?php _e('Nama Pemohon *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_nama" id="hkibcomm_user_nama" type="text" title="<?php _e('Nama Pemohon', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_alamat"><?php _e('Alamat Pemohon *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_alamat" id="hkibcomm_user_alamat" type="text" title="<?php _e('Alamat Pemohon', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kota"><?php _e('Kota *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kota" id="hkibcomm_user_kota" type="text" title="<?php _e('Kota', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kodepos"><?php _e('Kode Pos *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kodepos" id="hkibcomm_user_kodepos" type="text" title="<?php _e('Kode Pos', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_negara"><?php _e('Negara *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_negara" id="hkibcomm_user_negara" type="text" title="<?php _e('Negara', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_telp"><?php _e('Telepon *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_telp" id="hkibcomm_user_telp" type="text" title="<?php _e('Telepon', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_fax"><?php _e('Fax *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_fax" id="hkibcomm_user_fax" type="text" title="<?php _e('Fax', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_namamerek"><?php _e('Nama Merek *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_namamerek" id="hkibcomm_user_namamerek" type="text" title="<?php _e('Nama Merek' ,'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_warnamerek"><?php _e('Warna Merek *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_warnamerek" id="hkibcomm_user_warnamerek" type="text" title="<?php _e('Warna Merek', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_artimerek"><?php _e('Arti Merek *', 'hkibcomm'); ?></label>
				<textarea name="hkibcomm_user_artimerek" id="hkibcomm_user_artimerek" onfocus="this.value=''; setbg('#e5fff3');" onblur="setbg('white')" ></textarea>
				
				<label for="hkibcomm_user_jenisjasa"><?php _e('Jenis Barang / Jasa yang diinginkan *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_jenisjasa" id="hkibcomm_user_jenisjasa" type="text" title="<?php _e('Jenis Barang / Jasa yang diinginkan', 'hkibcomm'); ?>"/>
				
				<label for="hkibcomm_user_etiket"><?php _e('Etiket Merek *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_etiket" id="hkibcomm_user_etiket" type="file" title="<?php _e('Etiket Merek', 'hkibcomm'); ?>"/>

				<input type="hidden" name="hkibcomm_register_nonce" value="<?php echo wp_create_nonce('hkibcomm-registermerek-nonce');?>" />
				<button type="submit" id="hkibcomm_login_submit" value="<?php _e('Daftar Merek', 'hkibcomm'); ?>">Daftar Merek</button>
	</form>
	</div>
	<script type="text/javascript">
	function setbg(color)
	{
	document.getElementById("hkibcomm_user_artimerek").style.background=color
	}
	</script>
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
	#stylized2 textarea{
	float:left;
	font-size:12px;
	padding:4px 2px;
	border:solid 1px #aacfe4;
	width:200px;
	height:80px; 
	margin:2px 0 20px 10px;
	}
	#stylized2 button{
	clear:both;
	margin-left:150px;
	width:96px;
	height:32px;
	border: 0px;
	background:url("http://www.daftarhaki.com/images/button.png") no-repeat;
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

function register_paten() {
	global $hkibcomm_settings;
	ob_start(); ?>
	
	<?php 
	//show error messages
	hkibcomm_show_error_messages('register'); ?>
	<div id="stylized2" class="myform2">
	<form id="hkibcomm_registration_form" class="hkibcomm_form" action="" method="POST" enctype="multipart/form-data">
		
			<h1><?php _e('Daftar Paten', 'hkibcomm'); ?></h1>
			
				<label for="hkibcomm_user_nama"><?php _e('Nama Pemohon *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_nama" id="hkibcomm_user_nama" type="text" title="<?php _e('Nama Pemohon', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_alamat"><?php _e('Alamat Pemohon *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_alamat" id="hkibcomm_user_alamat" type="text" title="<?php _e('Alamat Pemohon', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kota"><?php _e('Kota *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kota" id="hkibcomm_user_kota" type="text" title="<?php _e('Kota', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kodepos"><?php _e('Kode Pos *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kodepos" id="hkibcomm_user_kodepos" type="text" title="<?php _e('Kode Pos', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_negara"><?php _e('Negara *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_negara" id="hkibcomm_user_negara" type="text" title="<?php _e('Negara', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_telp"><?php _e('Telepon *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_telp" id="hkibcomm_user_telp" type="text" title="<?php _e('Telepon', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_fax"><?php _e('Fax *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_fax" id="hkibcomm_user_fax" type="text" title="<?php _e('Fax', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_namainventor"><?php _e('Nama Inventor *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_namainventor" id="hkibcomm_user_namainventor" type="text" title="<?php _e('Nama Inventor' ,'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_alamatinventor"><?php _e('Alamat Inventor *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_alamatinventor" id="hkibcomm_user_alamatinventor" type="text" title="<?php _e('Alamat Inventor', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kotainventor"><?php _e('Kota Inventor *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kotainventor" id="hkibcomm_user_kotainventor" type="text" title="<?php _e('Kota Inventor', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kodeposinventor"><?php _e('Kode Pos Inventor *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kodeposinventor" id="hkibcomm_user_kodeposinventor" type="text" title="<?php _e('Kode Pos Inventor', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_negarainventor"><?php _e('Negara Inventor *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_negarainventor" id="hkibcomm_user_negarainventor" type="text" title="<?php _e('Negara Inventor', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_telpinventor"><?php _e('Telepon Inventor *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_telpinventor" id="hkibcomm_user_telpinventor" type="text" title="<?php _e('Telepon Inventor', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_faxinventor"><?php _e('Fax Inventor *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_faxinventor" id="hkibcomm_user_faxinventor" type="text" title="<?php _e('Fax Inventor', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_judulpaten"><?php _e('Judul Paten *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_judulpaten" id="hkibcomm_user_judulpaten" type="text" title="<?php _e('Judul Paten', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_gambarpaten"><?php _e('Gambar Paten *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_gambarpaten" id="hkibcomm_user_gambarpaten" type="file" title="<?php _e('Gambar Paten', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_deskripsipaten"><?php _e('Deskripsi Paten *', 'hkibcomm'); ?></label>
				<textarea name="hkibcomm_user_deskripsipaten" id="hkibcomm_user_deskripsipaten" onfocus="this.value=''; setbg('#e5fff3');" onblur="setbg('white')" ></textarea>
				
				<label for="hkibcomm_user_negaradiumumkan"><?php _e('Negara Pertama Kali Paten Diumumkan *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_negaradiumumkan" id="hkibcomm_user_negaradiumumkan" type="text" title="<?php _e('Negara Pertama Kali Ciptaan Diumumkan', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_tanggaldiumumkan"><?php _e('Tanggal Pertama Kali Paten Diumumkan *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_tanggaldiumumkan" id="hkibcomm_user_tanggaldiumumkan" type="text" title="<?php _e('Tanggal Pertama Kali Ciptaan Diumumkan', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_nomorptc"><?php _e('Nomor PTC *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_nomorptc" id="hkibcomm_user_nomorptc" type="text" title="<?php _e('Nomor PTC', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_buktiptc"><?php _e('Bukti Pengajuan PTC *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_buktiptc" id="hkibcomm_user_buktiptc" type="file" title="<?php _e('Bukti Pengajuan PTC', 'hkibcomm'); ?>"/>
			
				<input type="hidden" name="hkibcomm_register_nonce" value="<?php echo wp_create_nonce('hkibcomm-registerpaten-nonce');?>" />
				<button type="submit" id="hkibcomm_login_submit" value="<?php _e('Daftar Paten', 'hkibcomm'); ?>">Daftar Paten</button>
	</form>
	</div>
	<script type="text/javascript">
	function setbg(color)
	{
	document.getElementById("hkibcomm_user_artimerek").style.background=color
	}
	</script>
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
	#stylized2 textarea{
	float:left;
	font-size:12px;
	padding:4px 2px;
	border:solid 1px #aacfe4;
	width:200px;
	height:80px; 
	margin:2px 0 20px 10px;
	}
	#stylized2 button{
	clear:both;
	margin-left:150px;
	width:96px;
	height:32px;
	border: 0px;
	background:url("http://www.daftarhaki.com/images/button.png") no-repeat;
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

function register_hakcipta() {
	global $hkibcomm_settings;
	ob_start(); ?>
	
	<?php 
	//show error messages
	hkibcomm_show_error_messages('register'); ?>
	<div id="stylized2" class="myform2">
	<form id="hkibcomm_registration_form" class="hkibcomm_form" action="" method="POST" enctype="multipart/form-data">
		
			<h1><?php _e('Daftar Hak Cipta', 'hkibcomm'); ?></h1>
			
				<label for="hkibcomm_user_nama"><?php _e('Nama Pemohon *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_nama" id="hkibcomm_user_nama" type="text" title="<?php _e('Nama Pemohon', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_alamat"><?php _e('Alamat Pemohon *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_alamat" id="hkibcomm_user_alamat" type="text" title="<?php _e('Alamat Pemohon', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kota"><?php _e('Kota *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kota" id="hkibcomm_user_kota" type="text" title="<?php _e('Kota', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kodepos"><?php _e('Kode Pos *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kodepos" id="hkibcomm_user_kodepos" type="text" title="<?php _e('Kode Pos', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_negara"><?php _e('Negara *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_negara" id="hkibcomm_user_negara" type="text" title="<?php _e('Negara', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_telp"><?php _e('Telepon *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_telp" id="hkibcomm_user_telp" type="text" title="<?php _e('Telepon', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_fax"><?php _e('Fax *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_fax" id="hkibcomm_user_fax" type="text" title="<?php _e('Fax', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_namapencipta"><?php _e('Nama Pencipta *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_namapencipta" id="hkibcomm_user_namapencipta" type="text" title="<?php _e('Nama Pencipta' ,'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_alamatpencipta"><?php _e('Alamat Pencipta *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_alamatpencipta" id="hkibcomm_user_alamatpencipta" type="text" title="<?php _e('Alamat Pencipta', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kotapencipta"><?php _e('Kota Pencipta *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kotapencipta" id="hkibcomm_user_kotapencipta" type="text" title="<?php _e('Kota Pencipta', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kodepospencipta"><?php _e('Kode Pos Pencipta *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kodepospencipta" id="hkibcomm_user_kodepospencipta" type="text" title="<?php _e('Kode Pos Pencipta', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_negarapencipta"><?php _e('Negara Pencipta *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_negarapencipta" id="hkibcomm_user_negarapencipta" type="text" title="<?php _e('Negara Pencipta', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_telppencipta"><?php _e('Telepon Pencipta *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_telppencipta" id="hkibcomm_user_telppencipta" type="text" title="<?php _e('Telepon Pencipta', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_faxpencipta"><?php _e('Fax Pencipta *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_faxpencipta" id="hkibcomm_user_faxpencipta" type="text" title="<?php _e('Fax Pencipta', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_judulhakcipta"><?php _e('Judul Hak Cipta *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_judulhakcipta" id="hkibcomm_user_judulhakcipta" type="text" title="<?php _e('Judul Hak Cipta', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_negaradiumumkan"><?php _e('Negara Pertama Kali Ciptaan Diumumkan *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_negaradiumumkan" id="hkibcomm_user_negaradiumumkan" type="text" title="<?php _e('Negara Pertama Kali Ciptaan Diumumkan', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_tanggaldiumumkan"><?php _e('Tanggal Pertama Kali Ciptaan Diumumkan *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_tanggaldiumumkan" id="hkibcomm_user_tanggaldiumumkan" type="text" title="<?php _e('Tanggal Pertama Kali Ciptaan Diumumkan', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_contohciptaan"><?php _e('Contoh Ciptaan *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_contohciptaan" id="hkibcomm_user_contohciptaan" type="file" title="<?php _e('Contoh Ciptaan', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_deskripsiciptaan"><?php _e('Deskripsi Ciptaan *', 'hkibcomm'); ?></label>
				<textarea name="hkibcomm_user_deskripsiciptaan" id="hkibcomm_user_deskripsiciptaan" onfocus="this.value=''; setbg('#e5fff3');" onblur="setbg('white')" ></textarea>
				
				<input type="hidden" name="hkibcomm_register_nonce" value="<?php echo wp_create_nonce('hkibcomm-registerhakcipta-nonce');?>" />
				<button type="submit" id="hkibcomm_login_submit" value="<?php _e('Daftar Hak Cipta', 'hkibcomm'); ?>">Daftar Hak Cipta</button>
	</form>
	</div>
	<script type="text/javascript">
	function setbg(color)
	{
	document.getElementById("hkibcomm_user_artimerek").style.background=color
	}
	</script>
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
	#stylized2 textarea{
	float:left;
	font-size:12px;
	padding:4px 2px;
	border:solid 1px #aacfe4;
	width:200px;
	height:80px; 
	margin:2px 0 20px 10px;
	}
	#stylized2 button{
	clear:both;
	margin-left:150px;
	width:96px;
	height:32px;
	border: 0px;
	background:url("http://www.daftarhaki.com/images/button.png") no-repeat;
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

function register_desainindustri() {
	global $hkibcomm_settings;
	ob_start(); ?>
	
	<?php 
	//show error messages
	hkibcomm_show_error_messages('register'); ?>
	<div id="stylized2" class="myform2">
	<form id="hkibcomm_registration_form" class="hkibcomm_form" action="" method="POST" enctype="multipart/form-data">
		
			<h1><?php _e('Daftar Desain Industri', 'hkibcomm'); ?></h1>
			
				<label for="hkibcomm_user_nama"><?php _e('Nama Pemohon *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_nama" id="hkibcomm_user_nama" type="text" title="<?php _e('Nama Pemohon', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_alamat"><?php _e('Alamat Pemohon *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_alamat" id="hkibcomm_user_alamat" type="text" title="<?php _e('Alamat Pemohon', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kota"><?php _e('Kota *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kota" id="hkibcomm_user_kota" type="text" title="<?php _e('Kota', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kodepos"><?php _e('Kode Pos *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kodepos" id="hkibcomm_user_kodepos" type="text" title="<?php _e('Kode Pos', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_negara"><?php _e('Negara *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_negara" id="hkibcomm_user_negara" type="text" title="<?php _e('Negara', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_telp"><?php _e('Telepon *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_telp" id="hkibcomm_user_telp" type="text" title="<?php _e('Telepon', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_fax"><?php _e('Fax *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_fax" id="hkibcomm_user_fax" type="text" title="<?php _e('Fax', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_namapendesain"><?php _e('Nama Pendesain *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_namapendesain" id="hkibcomm_user_namapendesain" type="text" title="<?php _e('Nama Pendesain' ,'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_alamatpendesain"><?php _e('Alamat Pendesain *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_alamatpendesain" id="hkibcomm_user_alamatpendesain" type="text" title="<?php _e('Alamat Pendesain', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kotapendesain"><?php _e('Kota Pendesain *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kotapendesain" id="hkibcomm_user_kotapendesain" type="text" title="<?php _e('Kota Pendesain', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kodepospendesain"><?php _e('Kode Pos Pendesain *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kodepospendesain" id="hkibcomm_user_kodepospendesain" type="text" title="<?php _e('Kode Pos Pendesain', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_negarapendesain"><?php _e('Negara Pendesain *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_negarapendesain" id="hkibcomm_user_negarapendesain" type="text" title="<?php _e('Negara Pendesain', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_telppendesain"><?php _e('Telepon Pendesain *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_telppendesain" id="hkibcomm_user_telppendesain" type="text" title="<?php _e('Telepon Pendesain', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_faxpendesain"><?php _e('Fax Pendesain *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_faxpendesain" id="hkibcomm_user_faxpendesain" type="text" title="<?php _e('Fax Pendesain', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_juduldesainindustri"><?php _e('Judul Desain Industri *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_juduldesainindustri" id="hkibcomm_user_juduldesainindustri" type="text" title="<?php _e('Judul Desain Industri', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_negaradiumumkan"><?php _e('Negara Pertama Kali Desain Diumumkan *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_negaradiumumkan" id="hkibcomm_user_negaradiumumkan" type="text" title="<?php _e('Negara Pertama Kali Desain Diumumkan', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_tanggaldiumumkan"><?php _e('Tanggal Pertama Kali Desain Diumumkan *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_tanggaldiumumkan" id="hkibcomm_user_tanggaldiumumkan" type="text" title="<?php _e('Tanggal Pertama Kali Desain Diumumkan', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_contohdesain"><?php _e('Contoh Desain *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_contohdesain" id="hkibcomm_user_contohdesain" type="file" title="<?php _e('Contoh Desain', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_deskripsidesain"><?php _e('Deskripsi Desain *', 'hkibcomm'); ?></label>
				<textarea name="hkibcomm_user_deskripsidesain" id="hkibcomm_user_deskripsidesain" onfocus="this.value=''; setbg('#e5fff3');" onblur="setbg('white')" ></textarea>
				
				<input type="hidden" name="hkibcomm_register_nonce" value="<?php echo wp_create_nonce('hkibcomm-registerdesain-nonce');?>" />
				<button type="submit" id="hkibcomm_login_submit" value="<?php _e('Daftar Desain Industri', 'hkibcomm'); ?>">Daftar Desain Industri</button>
	</form>
	</div>
	<script type="text/javascript">
	function setbg(color)
	{
	document.getElementById("hkibcomm_user_artimerek").style.background=color
	}
	</script>
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
	#stylized2 textarea{
	float:left;
	font-size:12px;
	padding:4px 2px;
	border:solid 1px #aacfe4;
	width:200px;
	height:80px; 
	margin:2px 0 20px 10px;
	}
	#stylized2 button{
	clear:both;
	margin-left:150px;
	width:96px;
	height:32px;
	border: 0px;
	background:url("http://www.daftarhaki.com/images/button.png") no-repeat;
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

function register_indikasigeo() {
	global $hkibcomm_settings;
	ob_start(); ?>
	
	<?php 
	//show error messages
	hkibcomm_show_error_messages('register'); ?>
	<div id="stylized2" class="myform2">
	<form id="hkibcomm_registration_form" class="hkibcomm_form" action="" method="POST" enctype="multipart/form-data">
		
			<h1><?php _e('Daftar Indikasi Geografis', 'hkibcomm'); ?></h1>
			
				<label for="hkibcomm_user_nama"><?php _e('Nama Pemohon *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_nama" id="hkibcomm_user_nama" type="text" title="<?php _e('Nama Pemohon', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_alamat"><?php _e('Alamat Pemohon *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_alamat" id="hkibcomm_user_alamat" type="text" title="<?php _e('Alamat Pemohon', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kota"><?php _e('Kota *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kota" id="hkibcomm_user_kota" type="text" title="<?php _e('Kota', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_kodepos"><?php _e('Kode Pos *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_kodepos" id="hkibcomm_user_kodepos" type="text" title="<?php _e('Kode Pos', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_negara"><?php _e('Negara *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_negara" id="hkibcomm_user_negara" type="text" title="<?php _e('Negara', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_telp"><?php _e('Telepon *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_telp" id="hkibcomm_user_telp" type="text" title="<?php _e('Telepon', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_fax"><?php _e('Fax *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_fax" id="hkibcomm_user_fax" type="text" title="<?php _e('Fax', 'hkibcomm'); ?>"/>
			
				<label for="hkibcomm_user_namaindikasi"><?php _e('Nama Indikasi Geografis *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_namaindikasi" id="hkibcomm_user_namaindikasi" type="text" title="<?php _e('Nama Indikasi Geografis' ,'hkibcomm'); ?>"/>
		
				<label for="hkibcomm_user_uraianindikasi"><?php _e('Uraian Indikasi Geografis *', 'hkibcomm'); ?></label>
				<textarea name="hkibcomm_user_uraianindikasi" id="hkibcomm_user_uraianindikasi" onfocus="this.value=''; setbg('#e5fff3');" onblur="setbg('white')" ></textarea>
				
				<label for="hkibcomm_user_etiketindikasi"><?php _e('Etiket Indikasi Geografis *', 'hkibcomm'); ?></label>
				<input name="hkibcomm_user_etiketindikasi" id="hkibcomm_user_etiketindikasi" type="file" title="<?php _e('Etiket Indikasi Geografis', 'hkibcomm'); ?>"/>
			
				<input type="hidden" name="hkibcomm_register_nonce" value="<?php echo wp_create_nonce('hkibcomm-registerindikasigeo-nonce');?>" />
				<button type="submit" id="hkibcomm_login_submit" value="<?php _e('Daftar Indikasi Geografis', 'hkibcomm'); ?>">Daftar Indikasi Geografis</button>
	</form>
	</div>
	<script type="text/javascript">
	function setbg(color)
	{
	document.getElementById("hkibcomm_user_artimerek").style.background=color
	}
	</script>
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
	#stylized2 textarea{
	float:left;
	font-size:12px;
	padding:4px 2px;
	border:solid 1px #aacfe4;
	width:200px;
	height:80px; 
	margin:2px 0 20px 10px;
	}
	#stylized2 button{
	clear:both;
	margin-left:150px;
	width:96px;
	height:32px;
	border: 0px;
	background:url("http://www.daftarhaki.com/images/button.png") no-repeat;
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