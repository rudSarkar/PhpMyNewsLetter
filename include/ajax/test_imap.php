<?php
header('Access-Control-Allow-Origin: *');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: text/plain'); 
if(!file_exists("../config.php")) {
	header("Location:../../install.php");
	exit;
} else {
	include("../../_loader.php");
	$token=(empty($_POST['token'])?"":$_POST['token']);
	if(!isset($token) || $token=="")$token=(empty($_GET['token'])?"":$_GET['token']);
	if(!tok_val($token)){
		header("Location:../../login.php?error=2");
		exit;
	}
}

$bounce_host=$_POST['bounce_host'];
$bounce_user=$_POST['bounce_user'];
$bounce_pass=$_POST['bounce_pass'];
$bounce_port=$_POST['bounce_port'];
$bounce_service='/'.$_POST['bounce_service'];
$mail_folder='';
$_POST['bounce_option'] !=''	? $bounce_option='/'.$_POST['bounce_option'] : '';
$_POST['bounce_service']=='pop3'? $mail_folder='INBOX' : '';
$_POST['bounce_service']=='imap'? $option=OP_READONLY	: '';
if(!imap_open("{".$bounce_host.":".$bounce_port.$bounce_service.$bounce_option."}".$mail_folder,$bounce_user,$bounce_pass,1)){
	echo '<span style="color:red;font-weight:bold">'.tr("IMAP_DOWN").' : {'.$bounce_host.':'.$bounce_port.$bounce_service.$bounce_option.'}'
		.$mail_folder.','.$bounce_user.',********* : '.imap_last_error().'</span>';
}else{
	echo '<span style="color:green;font-weight:bold">'.tr("IMAP_OK").' : {'.$bounce_host.':'.$bounce_port.$bounce_service.$bounce_option.'}'
		.$mail_folder.','.$bounce_user.',*********</span>';
}












