<?php
/*
Plugin Name: HKI BComm
Plugin URI: http://www.benang.co.id
Description: Plugins untuk website pendaftaran HKI oleh PT. Inti Utama Gemilang.
Author: M Teguh A Suandi 
Version: 1.0
Author URI: http://www.nomadentech.net
*/

/*  Copyright 2012  M Teguh A Suandi  (email : teguh@nomadentech.net)

    Free to copy, modified or build for another wordpress plugins.
*/

if(!defined('HKIBCOMM_PLUGIN_DIR')) {
	define('HKIBCOMM_PLUGIN_DIR', plugin_dir_url( __FILE__ ));
	}
if (!defined('HKIBCOMM')) define('HKIBCOMM','HKIBCOMM Admin');
if (!defined('HKIBCOMM_PAGE')) define('HKIBCOMM_PAGE','HKIBCOMM');
define("CC_HKIBCOMM_URL", WP_CONTENT_URL . "/plugins/".CC_HKIBCOMM_PLUGIN."/");
define("CC_HKIBCOMM_VERSION","1.0.0");

// the plugin base directory
global $hkibcomm_base_dir;

$hkibcomm_base_dir = dirname(__FILE__);

$hkibcomm_settings = get_option('hkibcomm_settings');

//load_plugin_textdomain( 'hkibcomm', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

include($hkibcomm_base_dir . '/includes/shortcodes.php');
include($hkibcomm_base_dir . '/includes/forms.php');
include($hkibcomm_base_dir . '/includes/form_haki.php');
include($hkibcomm_base_dir . '/includes/scripts.php');
//include($hkibcomm_base_dir . '/includes/form-widgets.php');
include($hkibcomm_base_dir . '/includes/handle-register-and-login.php');
include($hkibcomm_base_dir . '/includes/http.class.php');
include($hkibcomm_base_dir . '/includes/parser.php');
include($hkibcomm_base_dir . '/includes/shared.inc.php');
include($hkibcomm_base_dir . '/includes/simple_html_dom.php');


//include($hkibcomm_base_dir . '/includes/admin-page.php');
if(is_admin()) {
	include($hkibcomm_base_dir . '/includes/admin-page.php');
    register_activation_hook(__FILE__,'haki_install');
	register_deactivation_hook(__FILE__ , 'haki_uninstall' );
}

/*
	Proses aktivasi plugin:
	1. Create table HAKI dan MEMBER
	2. Create Page
*/
function haki_activate(){
	// null

	
}

function haki_install() {
   require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
   global $wpdb,$current_user,$wp_rewrite;

   $table_name = $wpdb->prefix . "member";
     
   $sql = "CREATE TABLE if not exists $table_name (
          id mediumint(9) NOT NULL AUTO_INCREMENT,
          created_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          username VARCHAR(55) NOT NULL,
		  nama_lengkap VARCHAR(50) NOT NULL,
		  alamat VARCHAR(100) NOT NULL,
          kota VARCHAR(100) DEFAULT '' NOT NULL,
		  kode_pos VARCHAR(50) DEFAULT '' NOT NULL,
		  negara VARCHAR(50) DEFAULT '' NOT NULL,
		  telepon VARCHAR(50) DEFAULT '' NOT NULL,
		  fax VARCHAR(50) DEFAULT '' NOT NULL,
		  email VARCHAR(100) NOT NULL,
		  password VARCHAR(50) NOT NULL,
          UNIQUE KEY id (id)
          );";
   dbDelta($sql);


   $table_name = $wpdb->prefix . "haki";
   $sql = "CREATE TABLE if not exists $table_name (
          id mediumint(9) NOT NULL AUTO_INCREMENT,
          created_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          jenis VARCHAR(55) NOT NULL,
          nama_pemohon VARCHAR(100) NOT NULL,
		  alamat_pemohon VARCHAR(100) NOT NULL,
          kota VARCHAR(100) DEFAULT '' NOT NULL,
		  kode_pos VARCHAR(50) DEFAULT '' NOT NULL,
		  negara VARCHAR(50) DEFAULT 'Indonesia' NOT NULL,
		  telepon VARCHAR(50) DEFAULT '62' NOT NULL,
		  fax VARCHAR(50) DEFAULT '62' NOT NULL,
		  nama_merek VARCHAR(100) NOT NULL,
		  warna_merek VARCHAR(50) NOT NULL,
		  arti_merek VARCHAR(50) NOT NULL,
		  barang_registered VARCHAR(100) NOT NULL,
		  etiket_merek VARCHAR(100) NOT NULL,
		  username VARCHAR (100) NOT NULL,
          UNIQUE KEY id (id)
          );";
   dbDelta($sql);
   
   $table_name = $wpdb->prefix . "logstatus";
   $sql = "CREATE TABLE if not exists $table_name (
          id mediumint(9) NOT NULL AUTO_INCREMENT,
          created_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          status VARCHAR(200) NOT NULL,
          ket VARCHAR(200) NOT NULL,
		  username VARCHAR (100) NOT NULL,
          UNIQUE KEY id (id)
          );";
   dbDelta($sql);
   
   $table_name = $wpdb->prefix . "lognotif";
   $sql = "CREATE TABLE if not exists $table_name (
          id mediumint(9) NOT NULL AUTO_INCREMENT,
          created_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          status VARCHAR(200) NOT NULL,
          ket VARCHAR(200) NOT NULL,
		  email VARCHAR (100) NOT NULL,
		  username VARCHAR (100) NOT NULL,
          UNIQUE KEY id (id)
          );";
   dbDelta($sql);
   
   // maybe nambah table lagi nanti.. huehehehe.. :mahos
   //-- ini untuk tabel PATEN, field upload(deskripsi paten, gambar paten dan bukti pengajuan)
   $table_name = $wpdb->prefix . "paten";
   $sql = "CREATE TABLE if not exists $table_name (
          id mediumint(9) NOT NULL AUTO_INCREMENT,
		  jenis VARCHAR(50) NOT NULL,
          created_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          nama_pemohon VARCHAR(100) NOT NULL,
		  alamat_pemohon VARCHAR(100) NOT NULL,
          kota VARCHAR(100) DEFAULT '' NOT NULL,
		  kode_pos VARCHAR(50) DEFAULT '' NOT NULL,
		  negara VARCHAR(50) DEFAULT 'Indonesia' NOT NULL,
		  telepon VARCHAR(50) DEFAULT '62' NOT NULL,
		  fax VARCHAR(50) DEFAULT '62' NOT NULL,
		  nama_inventor VARCHAR(100) NOT NULL,
		  alamat_inventor VARCHAR(100) NOT NULL,
		  kota_inventor VARCHAR(50) NOT NULL,
		  kode_pos_inventor VARCHAR(10) NOT NULL,
		  negara_inventor VARCHAR(50) NOT NULL,
		  telepon_inventor VARCHAR(30) DEFAULT '62' NOT NULL,
		  fax_inventor VARCHAR(30) DEFAULT '62' NOT NULL,
		  judul_paten VARCHAR(100) NOT NULL,
		  desc_paten VARCHAR(100) NOT NULL,
		  gambar_paten VARCHAR(100) NOT NULL,
		  negara_pengajuan VARCHAR(100) NOT NULL,
		  tanggal_pengajuan datetime NOT NULL,
		  nomor_ptc VARCHAR(100) NOT NULL,
		  bukti_pengajuan VARCHAR(100) NOT NULL,
		  username VARCHAR (100) NOT NULL,
          UNIQUE KEY id (id)
          );";
   dbDelta($sql);
   
   //--- Ini untuk HAK CIPTA
   
   $table_name = $wpdb->prefix . "hakcipta";
   $sql = "CREATE TABLE if not exists $table_name (
          id mediumint(9) NOT NULL AUTO_INCREMENT,
		  jenis VARCHAR(50) NOT NULL,
          created_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          nama_pemohon VARCHAR(100) NOT NULL,
		  alamat_pemohon VARCHAR(100) NOT NULL,
          kota VARCHAR(100) DEFAULT '' NOT NULL,
		  kode_pos VARCHAR(50) DEFAULT '' NOT NULL,
		  negara VARCHAR(50) DEFAULT 'Indonesia' NOT NULL,
		  telepon VARCHAR(50) DEFAULT '62' NOT NULL,
		  fax VARCHAR(50) DEFAULT '62' NOT NULL,
		  nama_pencipta VARCHAR(100) NOT NULL,
		  alamat_pencipta VARCHAR(100) NOT NULL,
		  kota_pencipta VARCHAR(50) NOT NULL,
		  kode_pos_pencipta VARCHAR(10) NOT NULL,
		  negara_pencipta VARCHAR(50) NOT NULL,
		  telepon_pencipta VARCHAR(30) DEFAULT '62' NOT NULL,
		  fax_pencipta VARCHAR(30) DEFAULT '62' NOT NULL,
		  judul_hakcipta VARCHAR(100) NOT NULL,
		  negara_pengajuan VARCHAR(100) NOT NULL,
		  tanggal_pengajuan datetime NOT NULL,
		  contoh_ciptaan VARCHAR(100) NOT NULL,
		  desc_ciptaan VARCHAR(200) NOT NULL,
		  username VARCHAR (100) NOT NULL,
          UNIQUE KEY id (id)
          );";
   dbDelta($sql);
   
   //--- ini untuk DESAIN INDUSTRI
   
   $table_name = $wpdb->prefix . "desainindustri";
   $sql = "CREATE TABLE if not exists $table_name (
          id mediumint(9) NOT NULL AUTO_INCREMENT,
		  jenis VARCHAR(50) NOT NULL,
          created_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          nama_pemohon VARCHAR(100) NOT NULL,
		  alamat_pemohon VARCHAR(100) NOT NULL,
          kota VARCHAR(100) DEFAULT '' NOT NULL,
		  kode_pos VARCHAR(50) DEFAULT '' NOT NULL,
		  negara VARCHAR(50) DEFAULT 'Indonesia' NOT NULL,
		  telepon VARCHAR(50) DEFAULT '62' NOT NULL,
		  fax VARCHAR(50) DEFAULT '62' NOT NULL,
		  nama_pendesain VARCHAR(100) NOT NULL,
		  alamat_pendesain VARCHAR(100) NOT NULL,
		  kota_pendesain VARCHAR(50) NOT NULL,
		  kode_pos_pendesain VARCHAR(10) NOT NULL,
		  negara_pendesain VARCHAR(50) NOT NULL,
		  telepon_pendesain VARCHAR(30) DEFAULT '62' NOT NULL,
		  fax_pendesain VARCHAR(30) DEFAULT '62' NOT NULL,
		  judul_desainindustri VARCHAR(100) NOT NULL,
		  negara_pengajuan VARCHAR(100) NOT NULL,
		  tanggal_pengajuan datetime NOT NULL,
		  contoh_desainindustri VARCHAR(100) NOT NULL,
		  desc_desainindustri VARCHAR(200) NOT NULL,
		  username VARCHAR (100) NOT NULL,
          UNIQUE KEY id (id)
          );";
   dbDelta($sql);
   
   //-- Ini buat INDIKASI GEOGRAFIS
   
   $table_name = $wpdb->prefix . "indikasigeografis";
   $sql = "CREATE TABLE if not exists $table_name (
          id mediumint(9) NOT NULL AUTO_INCREMENT,
		  jenis VARCHAR(50) NOT NULL,
          created_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          nama_pemohon VARCHAR(100) NOT NULL,
		  alamat_pemohon VARCHAR(100) NOT NULL,
          kota VARCHAR(100) DEFAULT '' NOT NULL,
		  kode_pos VARCHAR(50) DEFAULT '' NOT NULL,
		  negara VARCHAR(50) DEFAULT 'Indonesia' NOT NULL,
		  telepon VARCHAR(50) DEFAULT '62' NOT NULL,
		  fax VARCHAR(50) DEFAULT '62' NOT NULL,
		  nama_indikasigeo VARCHAR(100) NOT NULL,
		  nama_barang VARCHAR(100) NOT NULL,
		  uraian_indikasigeo VARCHAR(100) NOT NULL,
		  etiket_indikasigeo VARCHAR(100) NOT NULL,
		  username VARCHAR (100) NOT NULL,
          UNIQUE KEY id (id)
          );";
   dbDelta($sql);
   
   //----- undefined function Kkkkkk
   ob_start();
   //cc_hkibcomm_log();
   set_error_handler(''); // default diisi dengan cc_hkibcomm_log
   error_reporting(E_ALL & ~E_NOTICE);
   $cc_hkibcomm_version=get_option("cc_hkibcomm_version");
   if (!$cc_hkibcomm_version) {
		//cc_hkibcomm_log(0,'Creating pages');
		$pages=array();
		$pages[]=array(HKIBCOMM_PAGE,HKIBCOMM_PAGE,"*",0);

		$ids="";
		foreach ($pages as $i =>$p)
		{
			$my_post = array();
			$my_post['post_title'] = $p['0'];
			$my_post['post_content'] = '';
			$my_post['post_status'] = 'publish';
			$my_post['post_author'] = 1;
			$my_post['post_type'] = 'page';
			$my_post['menu_order'] = 100+$i;
			$my_post['comment_status'] = 'closed';
			$id=wp_insert_post( $my_post );
			if (empty($ids)) { $ids.=$id; } else { $ids.=",".$id; }
			if (!empty($p[1])) add_post_meta($id,'cc_hkibcomm_page',$p[1]);
		}
		if (get_option("cc_hkibcomm_pages")) update_option("cc_hkibcomm_pages",$ids);
		else add_option("cc_hkibcomm_pages",$ids);
	}
	restore_error_handler();

	$wp_rewrite->flush_rules();
	
	return true;
}

function haki_deactivate(){
	// null
	$ids=get_option("cc_hkibcomm_pages");
	$ida=explode(",",$ids);
	foreach ($ida as $id) {
		wp_delete_post($id);
	}
	
	 $cc_hkibcomm_options=cc_hkibcomm_options();

	// //delete_option('cc_whmcs_bridge_log');
	foreach ($cc_hkibcomm_options as $value) {
		delete_option( $value['id'] );
	}
	delete_option("cc_hkibcomm_pages");
}

// aktifkan kalau mau di delete datanya.. :mahos
function haki_uninstall(){
	
    // global $wpdb;
	
    // $table = $wpdb->prefix . "member";
    // $structure = "drop table if exists $table";
    // $wpdb->query($structure);

	// $table2 = $wpdb->prefix . "haki";
    // $structure2 = "drop table if exists $table2";
    // $wpdb->query($structure2);
}

function cc_hkibcomm_output() {
	global $post;
	global $wpdb;
	global $wordpressPageName;
	global $cc_hkibcomm_loaded,$cc_hkibcomm_to_include;

	$cf=get_post_custom($post->ID);
	if (isset($_REQUEST['ccce'])){
		$cc_hkibcomm_to_include=$_REQUEST['ccce'];
	}elseif (isset($cf['cc_hkibcomm_page']) && $cf['cc_hkibcomm_page'][0]=='HKIBCOMM'){
		$cc_hkibcomm_to_include="index";
	}else{
		$cc_hkibcomm_to_include="index";
	}
	
	if ($wordpressPageName) $p=$wordpressPageName;
	else $p='/';
	$f[]='/.*\/([a-zA-Z\_]*?).php.(.*?)/';
	$r[]=get_option('home').$p.'?ccce=$1&$2';
	$f[]='/([a-zA-Z\_]*?).php.(.*?)/';
	$r[]=get_option('home').$p.'?ccce=$1&$2';
	//echo $output.'<br />';

	$output=preg_replace($f,$r,-1,$count); //$news->location

	//cc_whmcs_log('Notification','Redirect to: '.$output);
	//echo 'Location:'.$output;
	header('Location:'.$output);
	die();

	
	
	
}

function cc_hkibcomm_http($page="index") {
	global $wpdb;
	$vars="";
	
	$http=cc_hkibcomm_url().'/includes/'.$page.'.php';
	
	if(substr($page,-1)=='/') $http=cc_hkibcomm_url().'/'.substr($page,0,-1);
	else $http=cc_hkibcomm_url().'/'.$page.'.php';
	
	$and="";
	if (count($_GET) > 0) {
		foreach ($_GET as $n => $v) {
			if ($n!="page_id" && $n!="ccce")
			{
				if (is_array($v)) {
					foreach ($v as $n2 => $v2) {
						$vars.= $and.$n.'['.$n2.']'.'='.urlencode($v2);
					}
				}
				else $vars.= $and.$n.'='.urlencode($v);
				$and="&";
			}
		}
	}

	$vars.=$and.'systpl=portal';
	$and="&";
	
	if ($vars) $http.='?'.$vars;

	return $http;
	
}

function cc_hkibcomm_mainpage() {
	$ids=get_option("cc_hkibcomm_pages");
	$ida=explode(",",$ids);
	return $ida[0];
	
}

function cc_hkibcomm_url() {
	$url=get_option('cc_hkibcomm_url');
	if (substr($url,-1)=='/') $url=substr($url,0,-1);
	return $url;
}
