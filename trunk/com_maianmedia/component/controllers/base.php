<?php
/**
 * @package		Maian Media
 * @subpackage	com_maianmedia
 * @copyright	Copyright (C) Are Times. All rights reserved.
 * @license		GNU/GPL
 * @author 		Arelowo Alao
 * @based on  	Maian Music v1.2 by David Bennet
 * @link		http://www.AreTimes.com
 * @link 		http://www.maianscriptworld.co.uk
 *
 * Maian Media is based on an open source script orginaly written by Maian Script World.
 * This version may have been modified pursuant to the GNU General Public License,
 * and as distributed it includes or is derivative of works licensed under the
 * GNU General Public License or other free or open source software licenses.
 * Changes must attribute the work in the manner specified by the author or licensor
 * (but not in any way that suggests that they endorse you or your use of the work).
 */
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class MaianController extends JController
{
	var $MM_MAIL, $MM_CART, $SETTINGS, $RENDER_LANG;
	var $ItemId, $title, $page,$error_string,$count,$limit,$limitvalue, $menu_link;
	var $params, $extra_params, $breadcrumbs;
	var $skin_path, $skin_name, $is15;
	var $_log;

	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{

		include(JPATH_COMPONENT.DS.'inc'.DS.'functions.php');
		include(JPATH_COMPONENT.DS.'classes'.DS.'class_generic.inc.php');
		include(JPATH_COMPONENT.DS.'classes'.DS.'PaginateIt.php');
		include(JPATH_COMPONENT.DS.'classes'.DS.'class_cart.inc.php');
		include(JPATH_COMPONENT.DS.'classes'.DS.'class_rss.inc.php');

		include(JPATH_COMPONENT.DS.'classes'.DS.'class_mail.inc.php');

		require_once(JApplicationHelper::getPath('html'));

		$db =& JFactory::getDBO();
		$uri =& JURI::getInstance();
		$app =& JFactory::getApplication();

		getSiteLanguage();

		$db->setQuery("SELECT * FROM #__m15_settings LIMIT 1");
		$this->SETTINGS = $db->loadObject();

		$this->skin_path = JPATH_COMPONENT.DS.getTplPath($this->SETTINGS->homepage_url);
		$this->skin_name = $this->SETTINGS->homepage_url;

		$lines = explode("\n", trim($this->SETTINGS->extra_params));

		for ($i=0; $i<count($lines);$i++){
			list($key,$val) = explode("=", $lines[$i]);
			$params [trim(urldecode($key))] = trim(urldecode($val));
		}

		$this->extra_params = $params;

		// Initialise classes..

		$this->MM_MAIL              = new mailClass();
		$this->MM_CART              = new mm_Cart();
		//$this->MM_PAYPAL = new paypalIPN((isset($_POST) ? $_POST : ''),$this->SETTINGS);
		$this->MM_PAYPAL->prefix    = '#__mm_';
		$this->MM_CART->prefix      = '#__mm_';
		$this->MM_MAIL->smtp        = $this->SETTINGS->smtp;
		$this->MM_MAIL->smtp_host   = $this->SETTINGS->smtp_host;
		$this->MM_MAIL->smtp_user   = $this->SETTINGS->smtp_user;
		$this->MM_MAIL->smtp_pass   = $this->SETTINGS->smtp_pass;
		$this->MM_MAIL->smtp_port   = $this->SETTINGS->smtp_port;
		$this->MM_MAIL->addTag('{WEBSITE_NAME}',$this->SETTINGS->website_name);
		$this->MM_MAIL->addTag('{WEBSITE_URL}',$uri->root());
		$this->MM_MAIL->addTag('{WEBSITE_EMAIL}',$this->SETTINGS->email_address);
		// Clear data in cart older than set days thats not been used..
		clearDeadData();

		if($this->SETTINGS->log_errors == '1'){
			$this->_log = new MaianLogger(JPATH_COMPONENT_SITE.DS.'log', MaianLogger::DEBUG);
		}else{
			$this->_log = new MaianLogger(JPATH_COMPONENT_SITE.DS.'log', MaianLogger::OFF);
		}

		$document = &JFactory::getDocument();

		if(JRequest::getVar('format') != 'raw' && JRequest::getVar('task') != 'fetch'){
			//JDocument::setTitle(str_replace("{website}",cleanData($this->SETTINGS->website_name),JText::_( _msg_public_header)));
			$document->setTitle($this->SETTINGS->website_name);
			//$document->addCustomTag( '<script type="text/javascript" src="'.$uri->root().'administrator/components/com_maianmedia/js/request.js"></script>' );
			$document->addCustomTag( '<script type="text/javascript" src="'.$uri->root().'components/com_maianmedia/ajax/js_code.js"></script>' );

			if(genericOptions::get_browser_type() == 'Internet Explorer'){
				$document->addCustomTag( '<link rel="stylesheet" type="text/css" href="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'css').'/mm_stylesheet.css"/>' );
			}else{
				$document->addCustomTag('<link href="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'css').'/mm_stylesheet.css" rel="stylesheet" type="text/css" />');
			}

			$document->addCustomTag('<link rel="alternate" type="application/rss+xml" title="RSS" href="index.php?option=com_maianmedia&format=raw&view=rss" />');
		}

		$this->mm_title         = cleanData($this->SETTINGS->website_name);
		$this->page          = (isset($_GET['page']) ? strip_tags($_GET['page']) : '1');
		$this->error_string  = array();
		$this->count         = 0;
		$this->limit         = 25;
		$this->limitvalue    = $this->page * $this->limit - ($this->limit);
		$this->ItemId = intval(cleanData(JRequest::getVar('Itemid')));
		$this->breadcrumbs = &$app->getPathWay();
		$this->is15 = strpos(JVERSION, "1.5") === false ? false:true;

		parent::__construct();

	}
	function cartMod(){

		jimport( 'joomla.application.module.helper' );
		$module = JModuleHelper::getModule('maiancart');

		if(isset($module)){
			if(JModuleHelper::isEnabled('maiancart')){
				return true;
			}else{
				return false;
			}

		}else{
			return false;
		}

	}


	function create_captcha()
	{
		include(JPATH_COMPONENT.DS.'securimage'.DS.'securimage.php');
		//include(JPATH_COMPONENT.DS.'securimage'.DS.'securimage_show.php');
		//$Test = JPATH_COMPONENT.DS.'securimage'.DS.'securimage.php';
		$img = new securimage();

		$img->show(); // alternate use:  $img->show('/path/to/background.jpg');

	}

	function getLink($id)
	{
		$track_id = intval($id);
		$db =& JFactory::getDBO();
		$uri =& JURI::getInstance();
		$link = '';

		$db->setQuery("SELECT * FROM #__m15_tracks
		WHERE id = '{$track_id}'");
		$track = $db->loadObject();

		if(isset($_GET['album'])){
			$track_album = $track->track_album;
		}else{
			$track_album = '0';
		}

		if($track->track_cost !='0.00'){


			if($this->SETTINGS->ajax == '0'){
				return '<input type="checkbox" name="track[]" value="'.$id.'" />';
			}

			if(isset($_SESSION['track_id'])){
				$track_array = $_SESSION['track_id'];
				if(in_array($track_id, $track_array)){
					$link .= '<span id="update_'.$track_id.'"><img id="update_'.$track_id.'" onclick="updateCart(\''.$uri->root().'index.php?option=com_maianmedia&format=raw&section=cart&task=removeTrack&track='.$track_id.'&code='.$this->getEntryCode($track_id).'\', \'\', \'update_'.$track_id.'\');" src="components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/removeFromCart.png" /></span>';
				}else{
					$link .= '<span id="update_'.$track_id.'"><img onclick="updateCart(\''.$uri->root().'index.php?option=com_maianmedia&format=raw&section=cart&task=addToCart&track='.$track_id.'\', \'\', \'update_'.$track_id.'\');" src="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/addToCart.png" /></span>';
				}

			}else{
				if($track->freebie =='1'){
					$href = $uri->root()."index.php?option=com_maianmedia&section=download&task=freebie&track=$track_id&track_album=$track_album";
					$link .= '<a href="'.$href.'" title="'.JText::_(_msg_free_download).'"><img src="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/free_download.png" alt="'.JText::_(_msg_free_download).'" title="'.JText::_(_msg_free_download).'" /></a>';
				}
				if($track->track_single =='1'){
					$link .= '<span id="update_'.$track_id.'"><img id="update_'.$track_id.'" onclick="updateCart(\''.$uri->root().'index.php?option=com_maianmedia&format=raw&section=cart&task=addToCart&track='.$track_id.'\', \'\', \'update_'.$track_id.'\');" src="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/addToCart.png" /></span>';
				}

			}
		}else{
			JHTML::_('behavior.modal', 'a.modal-button');

			$href = $uri->root()."index.php?option=com_maianmedia&section=download&task=freebie&track=$track_id&track_album=$track_album";
			$link.='<a href="'.$href.'" title="'.JText::_(_msg_free_download).'"><img src="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/free_download.png" alt="'.JText::_(_msg_free_download).'" title="'.JText::_(_msg_free_download).'" /></a>';
		}

		return $link;

	}

	function getEntryCode($id){
		$code = "";
		for ($i=0; $i<count($_SESSION['entry_code']); $i++) {
			if ($id==$_SESSION['track_id'][$i]) {
				$code = $_SESSION['entry_code'][$i];
			}
		}
		return $code;
	}

	function getOrder($param){

		$sql = "";
		switch ($param) {
			case 'name-asc'		:    $sql = " ORDER BY name, artist ASC";      break;
			case 'name-desc'	:     $sql = " ORDER BY name, artist DESC ";   break;
			case 'artist-asc'	:       $sql = " ORDER BY artist,name ASC";  break;
			case 'artist-desc'	:    $sql = " ORDER BY artist,name DESC ";  break;
			case 'date-asc'		:   $sql = " ORDER BY addDate DESC";         break;
			case 'hits'			:    $sql = " ORDER BY hits ";              break;
			case 'track-asc'	:	$sql = "ORDER BY track_name ASC"; break;
			case 'track-desc'	:	$sql = "ORDER BY track_name DESC"; break;
			case 'id'	:	$sql = "ORDER BY id DESC"; break;
		}

		return $sql;

	}

	function isValidEmail($email){
		return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
	}

	function verifyEmail(){

		$name = cleanData(JRequest::getVar('mm_name_'));
		$email = trim(cleanData(JRequest::getVar('mm_email_')));

		if(empty($name)){
			echo JText::_(_msg_require_field);
			exit;
		}

		if(!$this->isValidEmail($email)){
			echo JText::_(_msg_invalid_email);
			exit;
		}

		/*$test = $this->validDomain($email);

		if(!$test){
		echo'Could not validate domain address.  Please try another email';
		exit;
		}*/

		$id = intval(cleanData(JRequest::getVar('item_id_')));

		$db =& JFactory::getDBO();
		$db->setQuery("SELECT params FROM #__menu WHERE id = $id") ;
		$query = $db->loadObject();
		$param = $query->params;

		if(!isset($param)){
			$db->setQuery("SELECT params FROM #__menu WHERE link like '%index.php?option=com_maianmedia&view=freebie%' and type like 'component'");
			$query = $db->loadObject();
			$param = $query->params;
		}


		$lines = explode("\n", trim($param));

		for ($i=0; $i<count($lines);$i++){
			list($key,$val) = explode("=", $lines[$i]);
			$params [trim(urldecode($key))] = trim(urldecode($val));
		}


		switch ($params['system']) {
			case 'acajoom':
				$path = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_acajoom'.DS.'subscribers.acajoom.php';
				if (!file_exists($path)) {
					echo JText::_(_msg_newsletter);
					break;
				}

				include_once($path);
				include_once(JPATH_PLUGINS.DS.'acajoom'.DS.'acajoombot.php');
				include_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_acajoom'.DS.'classes'.DS.'class.erro.php');
				include_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_acajoom'.DS.'classes'.DS.'class.subscribers.php');
				include_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_acajoom'.DS.'classes'.DS.'class.xonfig15.php');
				include_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_acajoom'.DS.'classes'.DS.'class.acajoom.php');
				include_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_acajoom'.DS.'admin.acajoom.html.php');
				include_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_acajoom'.DS.'subscribers.acajoom.html.php');

				$action = 'subscribers';
				$task =  'doNew';
				$userid = '0';
				$listId =  '0';
				$cid;

				JRequest::setVar('name', $name);
				JRequest::setVar('email', $email);
				subscribers( $action, $task, $userid, $listId, $cid );
				$_SESSION['mm_email'] = $email;
				ob_clean();
				echo '<span style="font-size: larger; color: rgb(0, 153, 0); font-weight: bold;">'.JText::_(_msg_download_message2).'</span><br>';
				$this->getTrackAlbum();
				break;

			case 'ccnews':
				$path = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_ccnewsletter'.DS.'models'.DS.'subscriber.php';

				if (!file_exists($path)) {
					echo JText::_(_msg_newsletter);
					break;
				}

				include_once($path);
				include_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_ccnewsletter'.DS.'tables'.DS.'subscriber.php');
				include_once(JPATH_SITE.DS.'components'.DS.'com_ccnewsletter'.DS.'models'.DS.'ccnewsletter.php');

				$Newsletter = new ccNewsletterModelccNewsletter();
				$Newsletter->addSubscriber($name, $email);
				$_SESSION['mm_email'] = $email;
				echo '<span style="font-size: larger; color: rgb(0, 153, 0); font-weight: bold;">'.JText::_(_msg_download_message2).'</span><br>';
				$this->getTrackAlbum();
				break;
		}

	}

	function genPreview($tid){
		$preview_path = "";
		if(isset($this->SETTINGS->append_url) && $this->SETTINGS->append_url == '1'){
			if($path == ''){
				$preview_path = $this->uri->root().'index.php%3Foption%3Dcom_maianmedia%26format%3Draw%26section%3Ddownload%26task%3Dpreview%26mmId%3D'.$tid;
			}else{
				$preview_path = substr($this->uri->root(), 0, strlen($this->uri->root())-1).$path;
			}
		}else{
			if($path == ''){
				$preview_path = $this->uri->root().'index.php%3Foption%3Dcom_maianmedia%26format%3Draw%26section%3Ddownload%26task%3Dpreview%26mmId%3D'.$tid;
			}else{
				$preview_path = $path;
			}
		}

		return $preview_path;
	}

	function getTrackAlbum()
	{
		$album = intval(cleanData(JRequest::getVar('mm_album_')));
		$track = intval(cleanData(JRequest::getVar('mm_track_')));

		if($album !='0'){
			echo '</br><input class="button" type="submit" value="'.JText::_(_msg_return_to).'" onclick="window.location=\'index.php?option=com_maianmedia&view=album&album='.$album.'\'"/>';
		}else{
			echo '</br><input class="button" type="submit" value="'.JText::_(_msg_return_to).'" onclick="window.location=\'index.php?option=com_maianmedia&view=freebie\'"/>';
		}
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_tracks
		WHERE id = '$track'") ;
		$track = $db->loadObject();

		//Protect from people trying to steal other tracks!!!
		if($track->track_cost != '0.00' && $track->freebie != '1'){
			echo '<div id="thief">'.JText::_(_msg_theif).'</div>';
			return;
		}


		$this->MM_CART->forceDownload($this->SETTINGS->mp3_path.DS.$track->mp3_path, JText::_(_msg_paypal27));

	}

	/**
	 Validate an email address.
	 Provide email address (raw input)
	 Returns true if the email address has the email
	 address format and the domain exists.
	 */
	function validDomain($email)
	{
		$isValid = true;
		$atIndex = strrpos($email, "@");
		if (is_bool($atIndex) && !$atIndex)
		{
			$isValid = false;
		}
		else
		{
			$domain = substr($email, $atIndex+1);
			$local = substr($email, 0, $atIndex);
			$localLen = strlen($local);
			$domainLen = strlen($domain);
			if ($localLen < 1 || $localLen > 64)
			{
				// local part length exceeded
				$isValid = false;
			}
			else if ($domainLen < 1 || $domainLen > 255)
			{
				// domain part length exceeded
				$isValid = false;
			}
			else if ($local[0] == '.' || $local[$localLen-1] == '.')
			{
				// local part starts or ends with '.'
				$isValid = false;
			}
			else if (preg_match('/\\.\\./', $local))
			{
				// local part has two consecutive dots
				$isValid = false;
			}
			else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
			{
				// character not valid in domain part
				$isValid = false;
			}
			else if (preg_match('/\\.\\./', $domain))
			{
				// domain part has two consecutive dots
				$isValid = false;
			}
			else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
			str_replace("\\\\","",$local)))
			{
				// character not valid in local part unless
				// local part is quoted
				if (!preg_match('/^"(\\\\"|[^"])+"$/',
				str_replace("\\\\","",$local)))
				{
					$isValid = false;
				}
			}

			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {

				if ($isValid && !($this->checkdnsrr($domain,"MX") || $this->checkdnsrr($domain,"A")))
				{
					// domain not found in DNS
					$isValid = false;
				}
			} else {
				if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
				{
					// domain not found in DNS
					$isValid = false;
				}
			}


		}
		return $isValid;
	}

	/********************
	 Windows checkdnsrr 1.0
	 By Hamish Milne
	 int checkdnsrr ( string $host [, string $type ] )
	 $type can be: A, ANY, CNAME, MX, NS, PTR, SOA, SRV, etc. default is MX

	 A checkdnsrr function compatible with Windows.
	 Exactly the same as the linux version
	 See the PHP documentation for further info:
	 http://www.php.net/checkdnsrr
	 Requires:
	 nslookup - ie. Windows - with access to 4.2.2.3
	 PHP >= 4.0.3
	 shell_exec() enabled - ie. safe mode disabled
	 ********************/

	function checkdnsrr($host, $type='mx'){
		$res=explode("\n",strstr(shell_exec('nslookup -type='.$type.' '.escapeshellarg($host).' 4.2.2.3'),"\n\n"));
		if($res[2]){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function appendParams($html, $params){
		foreach($params as $key=>$value){
			$html[$key] = $value;
			$key = strtoupper($key);
			$html[$key] = $value;
		}

		return $html;
	}

	function getParams($id, $view){

		$db =& JFactory::getDBO();
		$uri =& JURI::getInstance();
		$id = intval(cleanData(JRequest::getVar('Itemid')));

		$db->setQuery("SELECT * FROM #__menu WHERE id = $id") ;
		$query = $db->loadObject();
		$param ='';
		$is15 = strpos(JVERSION, "1.5") === false ? false:true;
			
		if(isset($query)){

			$lines = "";

			if($is15){
				$lines = explode("\n", trim($query->params));
			}else{
				$replace = str_ireplace(':', '=',$query->params);
				$replace = str_ireplace('{', '',$replace);
				$replace = str_ireplace('}', '',$replace);
				$replace = str_ireplace(',', "\n", $replace);
				$replace = str_ireplace('"', "", $replace);
				$lines = explode("\n", trim($replace));
			}

			for ($i=0; $i<count($lines);$i++){
				list($key,$val) = explode("=", $lines[$i]);
				$params [trim(urldecode($key))] = trim(urldecode($val));
			}

		}

		if($param == ''){

			$db->setQuery("SELECT params FROM #__menu WHERE link like '%index.php?option=com_maianmedia&view=$view%' and type like 'component'");
			$query = $db->loadObject();

			if(isset($query)){

				$lines = "";
					
				if($is15){
					$lines = explode("\n", trim($query->params));
				}else{
					$replace = str_ireplace(':', '=',$query->params);
					$replace = str_ireplace('{', '',$replace);
					$replace = str_ireplace('}', '',$replace);
					$replace = str_ireplace(',', "\n", $replace);
					$replace = str_ireplace('"', "", $replace);
					$lines = explode("\n", trim($replace));
				}

				for ($i=0; $i<count($lines);$i++){
					list($key,$val) = explode("=", $lines[$i]);
					$params [trim(urldecode($key))] = trim(urldecode($val));
				}

			}else{
				$db->setQuery("SELECT params FROM #__menu WHERE link like '%index.php?option=com_maianmedia&view=music%' and type like 'component'");
				$query = $db->loadObject();

				if(isset($query)){
					$param = $query->params."\n";
				}
			}

			switch ($view) {
				case 'music':
					$param .= "display_num=5
								orderBy=name-asc
								column=0
								show_page_title=1
								pageclass_sfx=
								menu_image=-1
								secure=0
								f_display=1
								p_display=1
								m_display=1
								c_display=1
								l_display=1";
					break;
				case 'mostpop':
					$param .= "show_track=1
								show_albums=1
								display_albums=5
								show_latest_track=1
								display_latest_track=5
								show_latest_albums=1
								display_latest_albums=5
								page_title=".JText::_(_msg_public_header3)."
								show_page_title=1
								pageclass_sfx=
								menu_image=-1
								secure=0";
					break;
				case 'freebie':
					$param .= "display_num=5
								orderBy=track-desc
								email=0
								accept_users=1
								alt_row=1
								color=#F5F5F5
								system=ccnews
								newslist=1
								page_title=
								show_page_title=1
								pageclass_sfx=
								menu_image=-1
								secure=0
								f_display=1
								p_display=1
								m_display=1
								c_display=1
								l_display=1";
					break;
				case 'album':
					$param .= "display_num=5
								orderBy=name-asc
								column=0
								alt_row=0
								show_page_title=1
								pageclass_sfx=
								menu_image=-1
								secure=0
								f_display=1
								p_display=1
								m_display=1
								c_display=1
								l_display=1";
					break;
				case 'cat':
					$param .= "display_num=5
								orderBy=ordering";
					break;
			}

		}else{
			$param = $query->params;
			$this->menu_link = 'Itemid='.$id;
		}

		$lines = explode("\n", trim($param));

		for ($i=0; $i<count($lines);$i++){
			if($lines[$i] !=''){
				list($key,$val) = explode("=", $lines[$i]);

				if(!isset($params[$key])){
					$params [trim(urldecode($key))] = trim(urldecode($val));
				}
			}
		}

		$db->setQuery("Select music from #__m15_settings WHERE id='1';");
		$query = $db->loadObject();

		$lines = explode("\n", trim($query->music));

		for ($i=0; $i<count($lines);$i++){
			if($lines[$i] !=''){
				list($key,$val) = explode("=", $lines[$i]);

				if(!isset($params[$key])){
					$params [trim(urldecode($key))] = trim(urldecode($val));
				}
			}
		}

		return $params;
	}

	function checkBoxScript(){

		return '<script type="text/javascript">
			//window.onload(\'checkAjax()\');
			
			var browserName=navigator.appName; // Get the Browser Name

			if(browserName=="Microsoft Internet Explorer") // For IE
			{
				window.onload=checkAjax; // Call init function in IE
			}else{
				if (document.addEventListener) // For Firefox
				{
					document.addEventListener("DOMContentLoaded", checkAjax, false); // Call init function in Firefox
				}
			}//end else 
			
			
			
			function checkAjax(){
				if(!isAjaxSupported()){
					activateLegacy();
				}
			}
			
			function activateLegacy(){
				var elem = document.getElementsByTagName(\'span\');        

					for(i = 0; i < elem.length; i++) {          
 						if (elem[i].getAttribute(\'class\') == \'checkbox\') {
							
 							id=elem[i].innerHTML;
 							pos=id.search("value=")
 							id=id.substring(pos+7, id.length);
							pos=id.search(\'"\')
 							id=id.substring(0, pos);							
 							//elem[i].innerHTML = \'<input type="checkbox" name="track[]" value="\'+id+\'" />\';
						}
						
						if (elem[i].getAttribute(\'class\') == \'button_align\') {
							elem[i].style.display="block"
						}
						
					}//end for
			}
		</script>';
	}

	function getCartScript(){
		$is15 = strpos($version, "1.5") === false ? false:true;

		$script = '<script type="text/javascript">
			function MTFade (div,prop,val) {
				new Fx.Style(div, prop, {duration: 250} ).start(val);
 			}
		
 			function removeItem(id, hash)
 			{

				var el = $(\'item_\'+id);
				';
		if($is15){
			$script = $script.'MTFade (el, \'opacity\',0);';
		}else{
			$script = $script."fade('item_'+id);";
		}

		$script = $script.'
				ajaxRequest(\'item_\'+id, \'index.php?option=com_maianmedia&format=raw&section=cart&task=ajax_remove&deleteThis=\'+hash, 0);
				window.setTimeout("refreshCart(\'count\', \'mm_cart\')", 5000);
 				window.setTimeout("ajaxRequest(\'cart_items_total\', \'index.php?option=com_maianmedia&format=raw&section=cart&task=updateCartCount&switch=total\', 0)", 1500);
				window.setTimeout("ajaxRequest(\'shopping_count\', \'index.php?option=com_maianmedia&format=raw&section=cart&task=updateCartCount&switch=count\', 0)", 3500);
				
			}
			
			var TimeToFade = 1600.0;
			
			function fade(eid)
			{
				var element = document.getElementById(eid);
			  	if(element == null)
			    	return;
			   
				if(element.FadeState == null)
			  	{
			    	if(element.style.opacity == null 
			        	|| element.style.opacity == \'\' 
			        	|| element.style.opacity == \'1\')
			    	{
			      		element.FadeState = 2;
			    	}
			    	else
			    	{
			      		element.FadeState = -2;
			    	}
			  	}
			    
				if(element.FadeState == 1 || element.FadeState == -1)
				{
					element.FadeState = element.FadeState == 1 ? -1 : 1;
				    element.FadeTimeLeft = TimeToFade - element.FadeTimeLeft;
				}
				else
				{
					element.FadeState = element.FadeState == 2 ? -1 : 1;
				    element.FadeTimeLeft = TimeToFade;
				    setTimeout("animateFade(" + new Date().getTime() + ",\'" + eid + "\')", 33);
				}  
			}

			function animateFade(lastTick, eid)
			{  
			  var curTick = new Date().getTime();
			  var elapsedTicks = curTick - lastTick;
			  
			  var element = document.getElementById(eid);
			 
			  if(element.FadeTimeLeft <= elapsedTicks)
			  {
			    element.style.opacity = element.FadeState == 1 ? \'1\' : \'0\';
			    element.style.filter = \'alpha(opacity = \' 
			        + (element.FadeState == 1 ? \'100\' : \'0\') + \')\';
			    element.FadeState = element.FadeState == 1 ? 2 : -2;
			    var child = document.getElementById(eid);
          	 var parent = document.getElementById(\'mm_main\');
          	 parent.removeChild(child);
			    return;
			  }
			 
			  element.FadeTimeLeft -= elapsedTicks;
			  var newOpVal = element.FadeTimeLeft/TimeToFade;
			  if(element.FadeState == 1)
			    newOpVal = 1 - newOpVal;
			
			  element.style.opacity = newOpVal;
			  element.style.filter = \'alpha(opacity = \' + (newOpVal*100) + \')\';
			  
			  setTimeout("animateFade(" + curTick + ",\'" + eid + "\')", 33);
			}
			
			
 		</script>';

		return $script;
	}

	function display()
	{
		$view = cleanData(JRequest::getVar('view'));
		$format = cleanData(JRequest::getVar('format'));
		if(isset($view) && $view !=''){
			require_once($this->skin_path.DS.'view.html.php');

			$tplParams = (object) $this->extra_params;
			$skin = new MaianView($tplParams, $this->SETTINGS, $this->skin_name);

			$classMethods = makeArrayLowercase(get_class_methods($skin));
			$args = array();

			// in_array() can only handle being given an array.
			if (!$classMethods) {
				$classMethods = array();
			}
			$view  = strtolower($view);
			if (in_array($view, $classMethods)) {

				include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
				call_user_func_array(array($skin, $view), $args);
				if($format != 'raw'){
					include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
					include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
				}

			}else{
				$tplDisplayData = array();
				$tplDisplayData['ERROR_TEXT'] = JText::_(_msg_paypal5);
				$tplDisplayData['ERROR_MESSAGE'] = JText::_(_msg_paypal6);
				HTML_maiainFront::show_ErrorPage($tplDisplayData);
			}
		}else{
			if($this->SETTINGS->default_page == '0'){
				header("Location: ".JRoute::_('index.php?option=com_maianmedia&view=mostpop&'.$this->menu_link)."");
			}else{
				header("Location: ".JRoute::_('index.php?option=com_maianmedia&view=music&'.$this->menu_link)."");
			}
		}
	}

	function getLangDisplay()
	{
		$data = '';

		$getstring = 'index.php?';

		foreach($_GET as $var => $value)
		{
			$getstring = $getstring.$var . '=' . $value.'&';
		}

		// Load language files..
		$langDir = opendir(JPATH_COMPONENT_SITE.DS.'lang'.DS);
		$uri =& JURI::getInstance();

		$maian_lang = isset($_SESSION['maian_lang']) ? $_SESSION['maian_lang']: $this->SETTINGS->language;

		while ($READ = readdir($langDir))
		{
			if ($READ != "." && $READ != ".." && $READ != "index.html" && $READ != ".svn") {
				$lang = substr($READ, 0, strpos($READ, '.'));

				$location = $uri->root().'components/com_maianmedia/media/flags/'.$lang.'.png';

				$langText = ucfirst(str_replace("_", " ", $lang));

				$data .= '
				<li>
					<a title="'.$langText.'" '.($maian_lang  == $READ ? 'class="activeFlag"':'').' href="'.$getstring .'getlang='.$lang.'">
						<img src="'.$location.'" alt="'.$langText.'" class="regularFlag" height="11" width="16">
					</a>
				</li>';

			}
		}

		closedir($langDir);
		return $data;
	}

}//end MaianControllerDefault