<?php
defined('_JEXEC') or die('Restricted access');
/*++++++++++++++++++++++++++++++++++++++++

Script: Maian Music v1.2
Written by: David Ian Bennett
E-Mail: support@maianscriptworld.co.uk
Website: http://www.maianscriptworld.co.uk

++++++++++++++++++++++++++++++++++++++++

This File: functions.php
Description: Program Functions

++++++++++++++++++++++++++++++++++++++++*/

//==================================================
// FUNCTION: clearDeadData()
// Clears unused data from cart older than x days
//==================================================

function clearDeadData() {
	$db =& JFactory::getDBO();

	$db->setQuery("Select days from #__m15_settings Limit 1");

	$settings = $db->loadObject();
	$date = date("Y-m-d", strtotime("-$settings->days days"));

	$db->setQuery("DELETE FROM #__m15_paypal
               WHERE pay_date <= '{$date}'
               AND active_cart = '0'
               ");
	$db->query();
}

//===============================================
// FUNCTION: addTitleToUrl()
// Parses data into url friendly string
//===============================================

function addTitleToUrl($title) {
	// Convert special characters from European countries into the English alphabetic equivalent..
	$chars = array('&#192;'=>'A','&#193;'=>'A','&#194;'=>'A','&#195;'=>'A','&#196;'=>'Ae','&#197;'=>'A','&#199;'=>'C','&#200;'=>'E','&#201;'=>'E','&#202;'=>'E','&#203;'=>'E','&#204;'=>'I',
                 '&#205;'=>'I','&#206;'=>'I','&#207;'=>'I','&#209;'=>'N','&#210;'=>'O','&#211;'=>'O','&#212;'=>'O','&#213;'=>'O','&#214;'=>'Oe','&#216;'=>'O','&#217;'=>'U','&#218;'=>'U',
                 '&#219;'=>'U','&#220;'=>'Ue','&#221;'=>'Y','&#224;'=>'a','&#225;'=>'a','&#226;'=>'a','&#227;'=>'a','&#228;'=>'ae','&#229;'=>'a','&#231;'=>'c','&#232;'=>'e','&#233;'=>'e',
                 '&#234;'=>'e','&#235;'=>'e','&#236;'=>'i','&#237;'=>'i','&#238;'=>'i','&#239;'=>'i','&#241;'=>'n','&#242;'=>'o','&#243;'=>'o','&#244;'=>'o','&#245;'=>'o','&#246;'=>'oe',
                 '&#248;'=>'o','&#249;'=>'u','&#250;'=>'u','&#251;'=>'u','&#252;'=>'ue','&#253;'=>'y','&#255;'=>'y','&#223;'=>'ss'); 

	// Replace chars in array..
	$title = strtr($title, $chars);

	// Strip none alphabetic and none numeric chars..
	$title = strtolower(preg_replace('`[^\w_-]`', '-', $title));

	// Replace other data that may be passed, such as double hyphens..
	return str_replace(array('--','---','----','-amp-','-039-'),
	array('-','-','-','-and-',''),
	$title
	);
}

//======================================================
// FUNCTION: getTrackCount()
// Gets track count for album
//======================================================

function getTrackCount($id) {
	$db =& JFactory::getDBO();

	$db->setQuery("SELECT count(*) AS t_count FROM #__m15_tracks WHERE track_album = '$id'");
	$q_count = $db->loadObject();
	//$COUNT = mysql_fetch_object($q_count);
	return $q_count->t_count;
}

//======================================================
// FUNCTION: showCaptcha()
// Loads captcha data into string
//======================================================

// Loads captcha data if enabled..
function showCaptcha($lang,$error='', $enable_captcha) {
	$db =& JFactory::getDBO();
	$db->setQuery("SELECT * FROM #__m15_settings LIMIT 1");
	$SETTINGS = $db->loadObject();

	$uri =& JURI::getInstance();
	$find     = array('{sid}','{code}','{code_error}','{refresh_captcha}', '{url}');
	$replace  = array(md5(uniqid(time())),$lang,$error,JText::_( _msg_contact17), $uri->root());
	$captcha  = file_get_contents(JPATH_COMPONENT.DS.getTplPath($SETTINGS->homepage_url).DS.'tpl'.DS.'captcha.html');
	return ($enable_captcha ? str_replace($find,$replace,$captcha) : '');
}
/*
 //=================================================
 // FUNCTION: toolTip
 // Return overlib tooltip
 //=================================================

 function toolTip($msg,$msg2) {
 return '[<a href="javascript:void(0);" onclick="return overlib(\''.htmlspecialchars($msg2).'\', STICKY, CAPTION,\''.$msg.'\', CENTER);" onmouseout="nd();"><b>?</b></a>]';
 }
 */
//=================================================
// FUNCTION: paypal_data()
// DESC: Gets paypal data into array
//=================================================

function paypal_data() {
	$db =& JFactory::getDBO();

	$query = $db->setQuery("SELECT * FROM #__m15_paypal LIMIT 1");
	$query= $db->loadObject();
	return $query;
}

//=================================================
// FUNCTION: get_cur_symbol()
// Return cost of payment with cur symbol
//=================================================

function get_cur_symbol($price,$cur) {
	$symbol = '';

	switch($cur) {
		case 'USD': return 'US&#036;'.$price;   break;
		case 'AUD': return 'AU&#036;'.$price;   break;
		case 'CAD': return 'CA&#036;'.$price;   break;
		case 'GBP': return '&#163;'.$price;   break;
		case 'JPY': return '&#165;'.$price;   break;
		case 'EUR': return '&#8364;'.$price;  break;
		case 'CHF': return '&#067;'.$price;   break;
		case 'CZK': return '&#075;'.$price;   break;
		case 'DKK': return '&#107;'.$price;   break;
		case 'HKD': return '&#22291;'.$price; break;
		case 'HUF': return '&#070;'.$price;   break;
		case 'SGD': return 'S&#036;'.$price;   break;
		case 'NOK': return '&#107;'.$price;   break;
		case 'NZD': return '&#036;'.$price;   break;
		case 'PLN': return '&#122;'.$price;   break;
		case 'SEK': return '&#107;'.$price;   break;
	}
}

//==========================================
// Clean evil tags()
// Removes potential harmful tags
//==========================================

function cleanEvilTags($data,$striptags=false) {
	$data = preg_replace("/javascript/i", "j&#097;v&#097;script",$data);
	$data = preg_replace("/alert/i", "&#097;lert",$data);
	$data = preg_replace("/about:/i", "&#097;bout:",$data);
	$data = preg_replace("/onmouseover/i", "&#111;nmouseover",$data);
	$data = preg_replace("/onclick/i", "&#111;nclick",$data);
	$data = preg_replace("/onload/i", "&#111;nload",$data);
	$data = preg_replace("/onsubmit/i", "&#111;nsubmit",$data);
	$data = preg_replace("/<body/i", "&lt;body",$data);
	$data = preg_replace("/<html/i", "&lt;html",$data);
	$data = preg_replace("/document\./i", "&#100;ocument.",$data);
	return ($striptags ? strip_tags(trim($data)) : trim($data));
}

//=================================================
// FUNCTION: cleanData()
// Removes slashes if magic quotes are on
//=================================================

function cleanData($data) {
	return (get_magic_quotes_gpc() ? stripslashes($data) : $data);
}

//================================================
// FUNCTION: getTableRowCount()
// Gets row count for table
//================================================

function getTableRowCount($table,$where='') {
	$db =& JFactory::getDBO();
	$db->setQuery("SELECT count(*) AS t_count FROM #__m15".$table."
                         ".($where ? $where : '')."");	
	$COUNT =$db->loadObject();

	return $COUNT->t_count;
}

//================================================
// FUNCTION: getAlbumData()
// Gets data for album
//================================================

function getAlbumData($id,$track=false) {
	$db =& JFactory::getDBO();

	if (!$track) {
		$db->setQuery("SELECT track_album FROM #__m15_tracks
                            WHERE id = '{$id}'
                            LIMIT 1
                            ");	
		$TRACK = $db->loadObject();
	}

	$db->setQuery("SELECT * FROM #__m15_albums
                        WHERE id = '".($track ? $id : $TRACK->track_album)."'
                        LIMIT 1");
	$query = $db->loadObject();
	return $query;
}

//================================================
// FUNCTION: page_numbers()
// Shows page numbers
//================================================

function page_numbers($count,$limit,$page,$stringVar='page') {

	$db =& JFactory::getDBO();
	$db->setQuery("SELECT * FROM #__m15_settings LIMIT 1");
	$SETTINGS = $db->loadObject();

	$PaginateIt = new PaginateIt();
	$PaginateIt->SetCurrentPage($page);
	$PaginateIt->SetItemCount($count);
	$PaginateIt->SetItemsPerPage($limit);
	$PaginateIt->SetLinksToDisplay(40);
	$PaginateIt->SetQueryStringVar($stringVar);
	$PaginateIt->SetLinksFormat('&laquo; '.JText::_(_msg_script5),
                              ' &bull; ',
	JText::_(_msg_script6).' &raquo;'
	);
	//$PaginateIt->SetModRewrite($SETTINGS->mod_rewrite);

	return str_replace('{pages}',$PaginateIt->GetPageLinks(),
	file_get_contents(JPATH_COMPONENT.DS.getTplPath($SETTINGS->homepage_url).DS.'tpl'.DS.'page_numbers.html')
	);
}

//================================================
// Function: file_size_conversion
// Converts file size from bytes
//================================================

function file_size_conversion($size=0,$base='1048576') {
	if ($size>0) {
		if ($size>1023987) {
			return number_format($size/$base,1)." MB";
		} else if ($size<1024) {
			return $size." Bytes";
		} else {
			return number_format($size/1024,0)." KB";
		}
	} else {
		return '0';
	}
}

// Recursive way of handling multi dimensional arrays..
// This cleans query string data and prevents code injections..
function multiDimensionalArrayMap($func,$arr) {
	$newArr = array();
	if (!empty($arr)) {
		foreach($arr AS $key => $value) {
			$newArr[$key] = (is_array($value) ? multiDimensionalArrayMap($func,$value) : $func($value));
		}
	}
	return $newArr;
}

if (!empty($_GET)) {
	$_GET  = multiDimensionalArrayMap('htmlspecialchars',$_GET);
}

function myCheckDNSRR($hostName, $recType = '')
{
	if(!empty($hostName)) {
		if( $recType == '' ) $recType = "MX";
		exec("nslookup -type=$recType $hostName", $result);
		// check each line to find the one that starts with the host
		// name. If it exists then the function succeeded.
		foreach ($result as $line) {
			if(eregi("^$hostName",$line)) {
				return true;
			}
		}
		// otherwise there was no mail handler for the domain
		return false;
	}
	return false;
}

function getSiteLanguage(){
	include_once('language.php');
	$db =& JFactory::getDBO();

	$db->setQuery("SELECT * FROM #__m15_settings LIMIT 1");
	$SETTINGS = $db->loadObject();
	
	$custom = JPATH_COMPONENT.DS.getTplPath($SETTINGS->homepage_url);

	if($SETTINGS->select_lang == '1'){

		$changeLang = JRequest::getVar('getlang');

		if(!isset($_SESSION['maian_lang'])){
			$_SESSION['maian_lang']=$SETTINGS->language;
		}

		if (isset($changeLang)){
			$_SESSION['maian_lang']= $changeLang.'.php';
		}

		if($_SESSION['maian_lang'] == ""){
			MaianText::init(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'lang'.DS.'english.php');
			
		}else{
			MaianText::init(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'lang'.DS.$_SESSION['maian_lang']);
		}


	}else{
		if($SETTINGS->language == ""){
			MaianText::init(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'lang'.DS.'english.php');
		}else{
			MaianText::init(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'lang'.DS.$SETTINGS->language);
		}
	}
	
	if( file_exists($custom.DS.'lang.php') !== false){
		MaianText::append($custom.DS.'lang.php');
	}

}

function getTplPath($template='classic', $type='file'){

	if($template == ''){
		$template = 'classic';
	}

	switch($type) {
		case 'file':
			$template = 'templates'.DS.$template;
			return $template;
			break;
		case 'img':
			$template = 'templates/'.$template.'/assets/media';
			return $template;
			break;
		case 'css':
			$template = 'templates/'.$template.'/assets/css';
			return $template;
			break;
	}

	$template = 'templates/'.$template.'/assets/'.$type;
	return $template;

}

function makeArrayLowercase($array, $include_leys=false) {

	if($include_leys) {
		foreach($array as $key => $value) {
			if(is_array($value))
			$array2[strtolower($key)] = arraytolower($value, $include_leys);
			else
			$array2[strtolower($key)] = strtolower($value);
		}
		$array = $array2;
	}
	else {
		foreach($array as $key => $value) {
			if(is_array($value))
			$array[$key] = arraytolower($value, $include_leys);
			else
			$array[$key] = strtolower($value);
		}
	}

	return $array;
}

function getPlayer(){

	$db =& JFactory::getDBO();
	$db->setQuery("Select * from #__m15_settings Limit 1");

	$SETTINGS = $db->loadObject();

	$classname = $SETTINGS->player;
	$XMLFile = JPATH_COMPONENT_SITE.DS.'players'.DS.'dewplayer'.DS.'playerDetails.xml';
	include_once(JPATH_COMPONENT_SITE.DS.'players'.DS.'maianplayer.php');

	if(is_file(JPATH_COMPONENT_SITE.DS.'players'.DS.$SETTINGS->player.DS.'player.php')){
		include_once(JPATH_COMPONENT_SITE.DS.'players'.DS.$SETTINGS->player.DS.'player.php');
		$XMLFile = JPATH_COMPONENT_SITE.DS.'players'.DS.$SETTINGS->player.DS.'playerDetails.xml';
	}else{
		include_once(JPATH_COMPONENT_SITE.DS.'players'.DS.'dewplayer'.DS.'player.php');
		$classname = "dewplayer";
	}

	return new $classname();

}

function genPreview($tid){
	$preview_path = "";
	$db =& JFactory::getDBO();
	$uri =& JURI::getInstance();

	$db->setQuery("Select * from #__m15_settings Limit 1");

	$SETTINGS = $db->loadObject();

	$id = intval($tid);

	$db->setQuery("SELECT * from #__m15_tracks WHERE id=$id");

	$track = $db->loadObject();

	$path = $track->preview_path;

	if(isset($SETTINGS->append_url) && $SETTINGS->append_url == '1'){
		if($path == ''){
			$preview_path = $uri->root().'index.php%3Foption%3Dcom_maianmedia%26format%3Draw%26section%3Ddownload%26task%3Dpreview%26mmId%3D'.$tid;
		}else{
			$preview_path = substr($uri->root(), 0, strlen($uri->root())-1).$SETTINGS->preview_path.'/'.$path;
		}
	}else{
		if($path == ''){
			$preview_path = $uri->root().'index.php%3Foption%3Dcom_maianmedia%26format%3Draw%26section%3Ddownload%26task%3Dpreview%26mmId%3D'.$tid;
		}else{
			$preview_path = $SETTINGS->preview_path.'/'.$path;
		}
	}

	return $preview_path;
}
?>
