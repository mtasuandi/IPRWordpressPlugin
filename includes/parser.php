<?php
function cc_hkibcomm_home(&$home,&$pid) {
	global $wordpressPageName;

	$pageID = cc_hkibcomm_mainpage();

	if (get_option('permalink_structure')){
		$homePage = get_option('home');
		$wordpressPageName = get_permalink($pageID);
		$wordpressPageName = str_replace($homePage,"",$wordpressPageName);
		$pid="";
		$home=$homePage.$wordpressPageName;
		if (substr($home,-1) != '/') $home.='/';
		$url=$home;
	}else{
		$pid='&page_id='.$pageID;
		$home=get_option('home').'/';
		$url=$home.'?page_id='.$pageID;
	}
	return $url;
}

function cc_hkibcomm_parser() {
	global $cc_hkibcomm_menu;

	cc_hkibcomm_home($home,$pid);
	
	$buffer=cc_hkibcomm_output();
	
	$tmp=explode('://',cc_hkibcomm_url(),2);
	$tmp2=explode('/',$tmp[1],2);
	$sub=str_replace($tmp[0].'://'.$tmp2[0],'',cc_hkibcomm_url()).'/';

	$hki=cc_hkibcomm_url().'/';
	
	$ret['buffer']=$buffer;
	
		$f[]='/action\=\"([a-zA-Z\_]*?).php\?(.*?)\"/';
		$r[]='action="'.$home.'?ccce=$1&$2'.$pid.'"';

		$f[]='/action\=\"([a-zA-Z\_]*?).php\"/';
		$r[]='action="'.$home.'?ccce=$1'.$pid.'"';
		
		$f[]='/action\=\"(.|\/*?)register.php\"/';
		$r[]='action="'.$home.'?ccce=register"';
		
	$buffer=preg_replace($f,$r,$buffer,-1,$count);
	$buffer=str_replace(cc_hkibcomm_url().'/includes/register.php',$home.'?ccce=register',$buffer);
	
	
	
	
	
	
	return $ret;
}