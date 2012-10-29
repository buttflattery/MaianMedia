<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

Script: Maian Music v1.2
Written by: David Ian Bennett
E-Mail: support@maianscriptworld.co.uk
Website: http://www.maianscriptworld.co.uk

++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

This File: class_generic.inc.php
Description: Generic Class

++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
// Include logger
include_once (JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'inc'.DS.'logger.php');
include_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'inc'.DS.'functions.php');

class genericOptions {

	function __construct()
	{
		$db = & JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_settings");
		$this->_SETTINGS = $db->loadObject();

		if($this->_SETTINGS->log_errors == '1'){
			$this->_log = new MaianLogger(JPATH_COMPONENT_SITE.DS.'log', MaianLogger::DEBUG);
		}else{
			$this->_log = new MaianLogger(JPATH_COMPONENT_SITE.DS.'log', MaianLogger::OFF);
		}

	}

	// Check if field data is valid..
	function field_check($num,$num2,$data) {
		if ($num2>0) {
			if ($data=="" || $data=="0" || $data=="http://" || strlen($data)<$num || strlen($data)>$num2) {
				return true;
			} else {
				return false;
			}
		} else {
			if ($data=="" || $data=="http://" || $data=="0") {
				return true;
			} else {
				return false;
			}
		}
	}


	// Check if e-mail field is valid..
	function is_email_valid($email) {
		if (!eregi("^([a-z]|[0-9]|\.|-|_)+@([a-z]|[0-9]|\.|-|_)+\.([a-z]|[0-9]){2,4}$", $email)) {
			return true;
		} else {
			return false;
		}
	}

	// Generates random alphanumeric string..
	function random_data($num) {
		$p = substr(md5(uniqid(rand(),1)), 3, $num);

		return strtoupper($p);
	}

	// Strip slashes if magic quotes are on..
	function strip_slashes($data) {
		return (get_magic_quotes_gpc() ? stripslashes($data) : $data);
	}

	// Prepares array data for safe import..
	function safe_import_callback($data) {
		return array_map('mysql_real_escape_string',$data);
	}

	// Converts certain chars to character entities
	function char_entities($data) {
		return htmlspecialchars($data);
	}

	// Prevents SQL injection..
	function add_slashes($data) {
		if (get_magic_quotes_gpc()) {
			$data = stripslashes($data);
		}
		return mysql_real_escape_string($data);
	}


	// Define the client's browser type..
	function get_browser_type() {
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";

		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}
			
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		}
		elseif(preg_match('/Firefox/i',$u_agent))
		{
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		}
		elseif(preg_match('/Chrome/i',$u_agent))
		{
			$bname = 'Google Chrome';
			$ub = "Chrome";
		}
		elseif(preg_match('/Safari/i',$u_agent))
		{
			$bname = 'Apple Safari';
			$ub = "Safari";
		}
		elseif(preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Opera';
			$ub = "Opera";
		}
		elseif(preg_match('/Netscape/i',$u_agent))
		{
			$bname = 'Netscape';
			$ub = "Netscape";
		}
			
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}
			
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
			
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
			
		return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
		);
	}

	function get_mime_type($filename){

		$mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

		// images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

		// archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

		// audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

		// adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

		// ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

		// open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
		);

		$ext = strtolower(array_pop(explode('.',$filename)));
		if (array_key_exists($ext, $mime_types)) {
			return $mime_types[$ext];
		}
		elseif (function_exists('finfo_open')) {
			$finfo = finfo_open(FILEINFO_MIME);
			$mimetype = finfo_file($finfo, $filename);
			finfo_close($finfo);
			return $mimetype;
		}
		else {
			return 'application/octet-stream';
		}
	}

	// Define new line character based on op system..
	function define_newline() {
		$newline = "\r\n";

		if (strstr(strtolower($_SERVER["HTTP_USER_AGENT"]), 'win')) {
			$newline = "\r\n";
		} else if (strstr(strtolower($_SERVER["HTTP_USER_AGENT"]), 'mac')) {
			$newline = "\r";
		} else {
			$newline = "\n";
		}

		return $newline;
	}

}

?>
