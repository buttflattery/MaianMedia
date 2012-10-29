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

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');
require_once(JPATH_COMPONENT.DS.'controllers'.DS.'template.php');

class MaianControllerDownload extends MaianControllerTemplate
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	var $document, $skin;

	function __construct()
	{
		parent::__construct();
		$this->document = &JFactory::getDocument();

		foreach($this->extra_params as $key=>$value){
			$tplProperties[$key] = $value;
		}

		require_once($this->skin_path.DS.'view.html.php');

		$tplParams = (object) $tplProperties;
		$this->skin = new MaianView($tplParams, $this->SETTINGS, $this->skin_name);

	}

	function display()
	{

		$uri =& JURI::getInstance();
		$this->breadcrumbs->addItem( JText::_(_msg_paypal14), JRoute::_( 'index.php?option=com_maianmedia&view=music'));
		if (!isset($_GET['code']) || (isset($_GET['code']) && !ctype_alnum($_GET['code']))) {

			$tplDisplayData = $this->skin->displayErrorPage();
			HTML_maiainFront::show_ErrorPage($tplDisplayData);
			return;
		}

		// Is code valid...
		if (!$this->MM_CART->getDownloadData($_GET['code'],true)) {

			$tplDisplayData = $this->skin->displayErrorPage();
			HTML_maiainFront::show_ErrorPage($tplDisplayData);

			return;
		}
		// Assign cart data array to var..
		$cartPurchase = $this->MM_CART->getDownloadData($_GET['code']);
		// Has download page expired..
		if ($this->SETTINGS->page_expiry>0 && ($this->SETTINGS->page_expiry==$cartPurchase->visits)) {

			$tplDisplayData = $this->skin->displayErrorPage();
			HTML_maiainFront::show_ErrorPage($tplDisplayData);
			return;
		}
		// Update page visits..
		$this->MM_CART->updateDownloadPageVisits($cartPurchase->download_code);
		// Ok, all checks passed, now display download data on page...
		$albumData  = '';
		$trackData  = '';
		$db =& JFactory::getDBO();

		if($this->SETTINGS->hide_lightbox == '1'){
			JHTML::_('behavior.mootools');
			$item_code = '55798';
		}else{
			JHTML::_('behavior.modal', 'a.modal-button');
			$item_code = '55788';
		}
		// Album data..
		if ($this->MM_CART->albumDownloads($cartPurchase->cart_code,true)) {
			// Assign album data to array..
			$db->setQuery("SELECT * FROM #__m15_purchases
			WHERE cart_code             = '{$cartPurchase->cart_code}'
			AND SUBSTRING(item_id,1,1)  = 'a'
			AND track_id                = '0'") ;	

			$q_album = $db->loadObjectList();

			foreach($q_album as $aD){
				$info = $this->MM_CART->getTrackOrAlbumData(substr($aD->item_id,1),'album');

				if($this->SETTINGS->use_zip == '1'){
					$zip_albums = JRoute::_('index.php?option=com_maianmedia&section=download&format=raw&task=getAlbum&code='.$aD->download_code.'&aid='.substr($aD->item_id,1));
					$file_content = JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'download_item_album_with_zip.html';
				}else{
					$zip_albums = '';
					$file_content = JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'download_item_album.html';
				}

				if($item_code == '55798'){

					$this->getJs($aD->download_code);

					$albumData .= str_replace(array('components/com_maianmedia/media','class="modal-button"', 'id="mm_zip"', '{item_name}','{download_url}','{download_album_url}','{download_this_item}','{artwork}'),
					array($uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img'),'id="a_'.$aD->download_code.'"', 'id="mm_zip_'.$aD->download_code.'"',
					cleanData($info->artist).' - '.cleanData($info->name),
					JRoute::_('index.php?option=com_maianmedia&format=raw&section=download&task=fetch&item=55788&amp;code='.$aD->download_code),
					$zip_albums,
					JText::_(_msg_paypal26),
					($info->artwork && strlen($info->artwork)>7 ? '<a href="'.$info->artwork.'"><img src="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/artwork.gif" alt="'.JText::_(_msg_paypal25).'" title="'.JText::_(_msg_paypal25).'" /></a>' : ''),
					),
					file_get_contents($file_content));

					$albumData .='<div id="album_data_'.$aD->download_code.'"></div>';

				}else{

					$albumData .= str_replace(array('components/com_maianmedia/media','{item_name}','{download_url}','{download_album_url}','{view_this_item}','{download_this_item}','{artwork}'),
					array($uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img'),
					cleanData($info->artist).' - '.cleanData($info->name),
					JRoute::_('index.php?option=com_maianmedia&section=download&format=raw&task=fetch&item=55788&amp;code='.$aD->download_code),
					$zip_albums,
					JText::_(_msg_tracks3),
					JText::_(_msg_paypal26),
					($info->artwork && strlen($info->artwork)>7 ? '<a class="download-button slategray" href="'.$info->artwork.'"><span id="artwork_button">'.JText::_(_msg_paypal25).'</span></a>' : ''),
					),
					file_get_contents($file_content));
				}
			}
		} else {
			$albumData = str_replace("{message}",JText::_(_msg_paypal21),file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'message.html'));
		}
		// Track data..
		if ($this->MM_CART->trackDownloads($cartPurchase->cart_code,true)) {
			$db =& JFactory::getDBO();
			// Assign track data to array..
			$db->setQuery("SELECT * FROM #__m15_purchases
			WHERE cart_code             = '{$cartPurchase->cart_code}'
			AND SUBSTRING(item_id,1,1)  = 't'
			AND track_id                = '0'");	

			$q_track = $db->loadObjectList();

			foreach($q_track as $tD){
				$info   = $this->MM_CART->getTrackOrAlbumData(substr($tD->item_id,1),'track');
				$ainfo  = $this->MM_CART->getTrackOrAlbumData($info->track_album,'album');
				$trackData .= str_replace(array('components/com_maianmedia/media','{item_name}','{download_url}','{download_this_item}','{artwork}'),
				array($uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img'),cleanData($ainfo->artist).' - '.cleanData($info->track_name),
				JRoute::_('index.php?option=com_maianmedia&format=raw&section=download&task=fetch&item='.$item_code.'&amp;code='.$tD->download_code),
				JText::_(_msg_paypal24),''),
				file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'download_item_track.html'));
			}
		} else {
			$trackData = str_replace("{message}",JText::_(_msg_paypal22),file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'message.html'));
		}
		// Set permissions session var..
		// If this isn`t set when the download window opens, terminate..
		// Prevents someone from sending a direct link to the download window..
		$_SESSION['download_permissions'] = '1';
		$tplDisplayData = $this->skin->displayDownloadPage($albumData, $trackData);

		HTML_maiainFront::show_DownloadPage($tplDisplayData);
	}
	function getJs($code){

		$js="
		 <script type=\"text/javascript\">
		/* <![CDATA[ */
		 
		//on dom ready...
window.addEvent('domready', function() {

	/* ajax replace element text */
	$('a_$code').addEvent('click', function(event) {
				//prevent the page from changing
				if(event.preventDefault) event.preventDefault();
				
				$('album_data_$code').innerHTML='<img src=\"components/com_maianmedia/ajax/ajax-loader.gif\"style=\'display:block;margin: 0 auto;\' alt=\'Updating ...\'/>';

				new Ajax(this, {
					method: 'get',
					update: $('album_data_$code')
				}).request();
				
				
				
	});
});
/* ]]> */

</script>

		";
		$this->document->addCustomTag($js);
	}
	function freebie(){

		$track_id = intval(cleanData(JRequest::getVar('track')));
		$track_album = intval(cleanData(JRequest::getVar('track_album')));

		$db =& JFactory::getDBO();

		if(!isset($query)){
			$db->setQuery("SELECT params FROM #__menu WHERE link like '%index.php?option=com_maianmedia&view=freebie%' and type like 'component'");
			$query = $db->loadObject();
			if(!isset($query)){
				$query =   "display_num=5
							orderBy=track-desc
							email=0
							accept_users=1
							color=#F5F5F5
							system=ccnews
							newslist=1
							page_title=
							show_page_title=1
							pageclass_sfx=
							menu_image=-1
							secure=0";
			}
		}

		$lines = explode("\n", trim($query->params));

		for ($i=0; $i<count($lines);$i++){
			list($key,$val) = explode("=", $lines[$i]);
			$params [urldecode($key)] = urldecode($val);
		}

		$db->setQuery("SELECT * FROM #__m15_tracks WHERE id = $track_id") ;
		$track = $db->loadObject();
		$cost = floatval($track->track_cost);

		//Protect from people trying to steal other tracks!!!
		if($track->track_cost != '0.00' && $track->freebie != '1'){
			if($track->freebie != '1'){
				echo '<div id="thief">'.JText::_(_msg_theif).'</div>';
				return;
			}
		}

		$user =& JFactory::getUser();

		if($params ['email'] == '1' ){
			if($params['accept_users'] == '1'){
				if(isset($_SESSION['mm_email']) && $user->guest){
					$this->MM_CART->forceDownload($this->SETTINGS->mp3_path.DS.$track->mp3_path, JText::_(_msg_paypal27));
				}else if(!$user->guest){
					$this->MM_CART->forceDownload($this->SETTINGS->mp3_path.DS.$track->mp3_path, JText::_(_msg_paypal27));
				}else{
					$document = &JFactory::getDocument();
					$document->addScript( 'components/com_maianmedia/ajax/cartajax.js');
					$find       = array('{item_id}','{required_field}','{invalid_address}','{name}','{email}', '{submit}');
					$replace    = array($id, JText::_(_msg_require_field), JText::_(_msg_invalid_email), JText::_(_msg_name), JText::_(_msg_email), JText::_(_msg_submit));
					$sData .= str_replace($find,$replace,
					file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'free_download.html'));
					echo '<div id="no_email">'.JText::_(_msg_must_provide).'</div>';
					echo '<input type="hidden" id="mm_album" name="mm_album" value="'.$track_album.'" />';
					echo '<input type="hidden" id="mm_track" name="mm_track" value="'.$track->id.'" />';
					echo $sData;

				}
			}
		}else{
			$this->MM_CART->forceDownload($this->SETTINGS->mp3_path.DS.$track->mp3_path, JText::_(_msg_paypal27));
		}

	}

	function getZip()
	{
		$code = $_GET['code'];
		$code = $_GET['aid'];
		$cartPurchase = $this->MM_CART->getDownloadData($code);
		$db  =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_purchases
			WHERE cart_code             = '{$cartPurchase->cart_code}'
			AND SUBSTRING(item_id,1,1)  = 'a'
			AND track_id                = '0'") ;	
		$albums = $db->loadObjectList();

		$db  =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_purchases
			WHERE cart_code             = '{$cartPurchase->cart_code}'
			AND SUBSTRING(item_id,1,1)  = 't'
			AND track_id                = '0'");
		$tracks = $db->loadObjectList();
		$zip_files = array();

		foreach($albums as $aD){
			$info = $this->MM_CART->getTrackOrAlbumData(substr($aD->item_id,1),'album');
			$zip_files = $zip_files + $this->MM_CART->getMP3PathForZipFile($info->id,'album', $this->SETTINGS->mp3_path);
		}

		foreach($tracks as $tD){
			$info   = $this->MM_CART->getTrackOrAlbumData(substr($tD->item_id,1),'track');
			$zip_files[] = $this->SETTINGS->mp3_path.'/'.$this->MM_CART->getMP3PathForZipFile($info->id,'track');
		}
		$zipName = $cartPurchase->first_name.' '.$cartPurchase->last_name.' '.JText::_(_msg_cart).'.zip';
		$zipName = cleanData(str_replace(' ', '_',$zipName));
		$archive_file_name = JPATH_ROOT.DS.'tmp'.DS.$zipName;

		if($this->MM_CART->create_zip($zip_files, $archive_file_name, true,$this->SETTINGS->mp3_path.'/')){
				
			jimport('joomla.filesystem.file');
			JPath::setPermissions($archive_file_name, '0755');
				
			$this->MM_CART->forceDownload(JPATH_ROOT.DS.'tmp'.DS.$zipName,JText::_(_msg_paypal27));

			//JFile::delete($archive_file_name);
			exit;
		}


	}

	function getAlbum()
	{
		$code = $_GET['code'];
		$aid = $_GET['aid'];
		$cartPurchase = $this->MM_CART->getDownloadData($code);
		$db  =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_purchases
			WHERE download_code              = '{$code}'
			AND item_id  = 'a$aid'
			AND track_id                = '0'") ;	
		$albums = $db->loadObject();

		$zip_files = array();

		$db->setQuery("SELECT * FROM #__m15_albums
			WHERE id             = '{$aid}'") ;	
		$album = $db->loadObject();

		$info = $this->MM_CART->getTrackOrAlbumData($aid,'album');
		$zip_files = $zip_files + $this->MM_CART->getMP3PathForZipFile($aid,'album', $this->SETTINGS->mp3_path);


		$zipName = JText::_($album->name).'.zip';
		$zipName = cleanData(str_replace(' ', '_',$zipName));
		$archive_file_name = JPATH_ROOT.DS.'tmp'.DS.$zipName;
		if($this->MM_CART->create_zip($zip_files, $archive_file_name, true,$this->SETTINGS->mp3_path.'/')){

			jimport('joomla.filesystem.file');
			JPath::setPermissions($archive_file_name, '0755');
				
			$this->MM_CART->forceDownload($archive_file_name,JText::_(_msg_paypal27));

			//JFile::delete($archive_file_name);
			exit;
		}

	}

	function fetch()
	{
		$task = JRequest::getVar('item');
		$uri =& JURI::getInstance();

		switch($task){
			case '55788':
			case '55798':
			case '55799':
				$data = '';
				$link = '';
				$size = 0;
				$file = $this->MM_CART->getDownloadFile($_GET['code']);
				// Are permissions set..
				if (!isset($_SESSION['download_permissions'])) {
					$data  = JText::_(_msg_downloaditem2);
					$link  = '';
				}
				// Has download expired..
				if ($this->SETTINGS->download_expiry>0 && ($this->SETTINGS->download_expiry==$file->downloads)) {
					$data  = JText::_(_msg_downloaditem);
					$link  = ($task=='55799' ? str_replace(array('{url}','{back_to_previous_page}'),
					array(
					JRoute::_('index.php?option=com_maianmedia&section=download&amp;code='.$this->MM_CART->getDownloadPageCode($_GET['code'])),
					JText::_(_msg_paypal30)
					),
					file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'back_link.html')
					)
					: '');
				}
				// Show download link..
				if ($data=='' && $task=='55788') {
					if (substr($file->item_id,0,1)=='a') {
						$info    = $this->MM_CART->getTrackOrAlbumData(substr($file->item_id,1),'album');
						$cart    = $this->MM_CART->getDownloadFile($_GET['code']);
						$name    = cleanData($info->name);
						$artist  = cleanData($info->artist);
						$size    = $this->MM_CART->downloadSize(substr($file->item_id,1),'album',$this->SETTINGS);
						$tracks  = '';
						$db =& JFactory::getDBO();
						// Get tracks..
						$db->setQuery("SELECT * FROM #__m15_purchases
						WHERE item_id  = '{$file->item_id}'
						AND cart_code  = '{$cart->cart_code}'
						AND track_id   > '0'
						ORDER BY id
                               ") ;
						$q_tracks = $db->loadObjectList();
						foreach($q_tracks as $TRACKS){
							$t        = $this->MM_CART->getTrackOrAlbumData($TRACKS->track_id,'track');
							$find     = array('components/com_maianmedia/media','{url}','{image}','{click_to_download}','{track}','{size}');
							$replace  = array($uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img'), JRoute::_('index.php?option=com_maianmedia&section=download&task=fetch&item=55799&amp;code='.$TRACKS->download_code),
							($this->SETTINGS->download_expiry>0 && ($TRACKS->downloads==$this->SETTINGS->download_expiry) ? 'expired.gif' : 'small_download2.gif'),
							($this->SETTINGS->download_expiry>0 && ($TRACKS->downloads==$this->SETTINGS->download_expiry) ? JText::_(_msg_paypal31) : JText::_(_msg_paypal24)),
							cleanData($t->track_name),
							file_size_conversion($this->MM_CART->downloadSize($TRACKS->track_id,'track',$this->SETTINGS)));
							$tracks .= str_replace($find,$replace,
							file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'album_tracks.html'));
						}
					} else {
						$info    = $this->MM_CART->getTrackOrAlbumData(substr($file->item_id,1),'track');
						$name    = cleanData($info->track_name);
						$size    = $this->MM_CART->downloadSize(substr($file->item_id,1),'track',$this->SETTINGS);
					}
					$data = str_replace(array('components/com_maianmedia/media','{artist}','{name}','{download_url}','{size}','{click_to_download}','{click_to_download2}','{tracks}'),
					array($uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img'),
					(isset($artist) ? $artist : ''),
					$name,
					JRoute::_('index.php?option=com_maianmedia&section=download&task=fetch&item=55798&amp;code='.$file->download_code),
					(isset($artist) ? JText::_(_msg_paypal28).' ' : '').file_size_conversion($size),
					JText::_(_msg_paypal29),
					JText::_(_msg_paypal24),
					(isset($tracks) ? $tracks : '')
					),
					file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.(substr($file->item_id,0,1)=='a' ? 'download_window_album.html' : 'download_window_track.html').'')
					);
				}

				// Download track/album..
				if ($data=='' && ($task=='55798' || $task=='55799')) {
					// Update purchase download count..
					$this->MM_CART->updateFileDownloadCount($file->id);
					// Determine track id..
					$t_id = ($task=='55798' ? substr($file->item_id,1) : $file->track_id);
					// Path to mp3 file..
					$mp3_path = $this->SETTINGS->mp3_path.'/'.$this->MM_CART->getMP3PathForZipFile($t_id,'track');
					// Download..
					$this->MM_CART->forceDownload($mp3_path,JText::_(_msg_paypal27));
					exit;
				}

				$tplDisplayData = $this->skin->displayDownloadItemPage($data, $link);

				HTML_maiainFront::show_DownloadItemPage($tplDisplayData);
				break;
		}
	}

	function preview() {

		$id = $_GET["mmId"];

		$db =& JFactory::getDBO();

		$db->setQuery("SELECT * FROM #__m15_tracks
		WHERE id = '{$id}' Limit 1");

		$track = $db->loadObject();

		if(!isset($track)){
			exit;
		}

		$archiveName = $this->SETTINGS->mp3_path.DS.$track->mp3_path;

		// set headers
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		header("Content-Type: audio/mpeg");
		header("Content-Disposition: attachment; filename=\"".basename($archiveName)."\";" );
		header("Content-Transfer-Encoding: binary");
			
		$file = @fopen($archiveName,"rb");
		$count = ($this->SETTINGS->clip != 0 ? $this->SETTINGS->clip: 15) * 4;
		$index = 1;
		if ($file) {
			//while(!feof($file)) {
			while($index != $count) {
				print(fread($file, 1024*8));
				flush();
				if (connection_status()!=0) {
					@fclose($file);
					die();
				}

				$index ++;
			}
			@fclose($file);
		}

	}

}
?>