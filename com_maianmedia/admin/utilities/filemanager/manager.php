<?php

include('FileManager.php');
include_once('logger.php');

function endecrypt ($pwd, $data, $case='') {
	if ($case == 'de') {
		$data = urldecode($data);
	}

	$key[] = "";
	$box[] = "";
	$temp_swap = "";
	$pwd_length = 0;

	$pwd_length = strlen($pwd);

	for ($i = 0; $i <= 255; $i++) {
		$key[$i] = ord(substr($pwd, ($i % $pwd_length), 1));
		$box[$i] = $i;
	}

	$x = 0;

	for ($i = 0; $i <= 255; $i++) {
		$x = ($x + $box[$i] + $key[$i]) % 256;
		$temp_swap = $box[$i];

		$box[$i] = $box[$x];
		$box[$x] = $temp_swap;
	}

	$temp = "";
	$k = "";

	$cipherby = "";
	$cipher = "";

	$a = 0;
	$j = 0;

	for ($i = 0; $i < strlen($data); $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;

		$temp = $box[$a];
		$box[$a] = $box[$j];

		$box[$j] = $temp;

		$k = $box[(($box[$a] + $box[$j]) % 256)];
		$cipherby = ord(substr($data, $i, 1)) ^ $k;

		$cipher .= chr($cipherby);
	}

	if ($case == 'de') {
		$cipher = urldecode(urlencode($cipher));

	} else {
		$cipher = urlencode($cipher);
	}

	return $cipher;
}

function UploadIsAuthenticated($get){
	/*debuging code since flash creates a new session
	 $log = new MaianLogger('C:\xampp\htdocs\demo\components\com_maianmedia\log', MaianLogger::DEBUG);

	 $log->log("---------------------------upload start-----------------------\r\n", 7, null);
	 $log->log(print_r($_SERVER, true), 7, null);
	 $log->log(print_r($_GET, true), 7, null);
	 $log->log(print_r($_POST, true), 7, null);
	 $log->log(print_r($_REQUEST, true), 7, null);*/


	//manpulate encrypted string
	$sessionid = $_GET['sessionid'];
	$sessionid = str_replace('-per-','%',$sessionid);
	$sessionid = trim(str_replace('-dot-','.',$sessionid));

	$auth = file_get_contents('auth.php');

	$md5loc = strpos($auth, '$md5=');
	$md5 = trim(substr($auth,$md5loc+6, -4));

	$key = endecrypt($md5,$sessionid,'de');

	if(strrpos($_REQUEST['auth'],$key)===false){
		return false;
	}else{
		return true;
	}

}


//this hack sucks but flash destroys the admin session so I have to improvise
/*
 $log = new MaianLogger('C:\xampp\htdocs\demo\components\com_maianmedia\log', MaianLogger::DEBUG);

 $log->log("---------------------------main start-----------------------\r\n", 7, null);
 $log->log(print_r($_SERVER, true), 7, null);
 $log->log(print_r($_GET, true), 7, null);
 $log->log(print_r($_POST, true), 7, null);
 $log->log(print_r($_REQUEST, true), 7, null);
 $log->log("---------------------------main end-----------------------\r\n", 7, null);
 */
//manpulate encrypted string
$sessionid = $_GET['sessionid'];
$sessionid = str_replace('-per-','%',$sessionid);
$sessionid = trim(str_replace('-dot-','.',$sessionid));

$auth = file_get_contents('auth.php');

$md5loc = strpos($auth, '$md5=\'');
$md5 = trim(substr($auth,$md5loc+6, -4));

$key = endecrypt($md5,$sessionid,'de');

//prevent bastards from trying to exploit this file

if(strrpos($_SERVER['HTTP_COOKIE'],$key)===false){
	if(!isset($_POST['Upload'])){
		die();
	}
}

$browser = new FileManager(array(
	'directory' => $_GET['path'],
	'absolutePath' => $_GET['path'],
	'assetBasePath' => './Assets/',
  	'chmod' => 0777,
	'destroy' => false));

$browser->fireEvent(!empty($_GET['event']) ? $_GET['event'] : null);