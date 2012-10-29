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

class MaianControllerTemplate extends MaianController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */

	function __construct()
	{
		parent::__construct();

	}

	function mostpop()
	{
		$mainframe = &JFactory::getApplication();

		$p_tracks  = '';
		$p_albums  = '';
		$db =& JFactory::getDBO();

		$id = intval(cleanData(JRequest::getVar('Itemid')));

		$params = $this->getParams($id, 'mostpop');
		$this->params = $params;

		$this->breadcrumbs->addItem( JText::_(_msg_public_header4), JRoute::_( 'index.php?option=com_maianmedia&view=music'));

		// Get most popular albums params..
		$popAlbums = isset($params['display_albums']) ? $params['display_albums']:$this->SETTINGS->poplinks;

		// Get most popular tracks params..
		$popTracks = isset($params['display_track']) ? $params['display_track']:$this->SETTINGS->poplinks;

		// Get most latest albums params..
		$lateAlbums = isset($params['display_latest_albums']) ? $params['display_latest_albums']:$this->SETTINGS->poplinks;

		// Get latest tracks params..
		$lateTracks = isset($params['display_latest_track']) ? $params['display_latest_track']:$this->SETTINGS->poplinks;

		$params['display_albums']=$popAlbums;
		$params['display_track']=$popTracks;
		$params['display_latest_albums']=$lateAlbums;
		$params['display_latest_track']=$lateTracks;

		$db->setQuery("SELECT * FROM #__m15_pages WHERE name LIKE 'about'") ;
		$pages = $db->loadObject();

		JPluginHelper::importPlugin( 'content' );
		$dispatcher =& JDispatcher::getInstance();

		$text = isset($pages) ? JHtml::_('content.prepare', $pages->text) : '';
		require_once($this->skin_path.DS.'view.html.php');

		$tplParams = (object) $params;
		$skin = new MaianView($tplParams, $this->SETTINGS, $this->skin_name);

		$html = $skin->displayMostPopular($text);

		$html = $this->appendParams($params, $html);
		$html = $this->appendParams($this->extra_params , $html);
		$html = $this->appendParams($this->getParams($id, 'mostpop'), $html);

		HTML_maiainFront::show_MainPage($html);
	}

	function freebie()
	{
		$mainframe = &JFactory::getApplication();
		$option = JRequest::getCmd('option');;
		$db =& JFactory::getDBO();
		$uri =& JURI::getInstance();
		$id = intval(cleanData(JRequest::getVar('Itemid')));
		$limitstart = intval(cleanData(JRequest::getVar('limitstart')));

		$params = $this->getParams($id, 'freebie');
		$this->params = $params;

		$document = &JFactory::getDocument();
		$document->addScript($uri->root().'components/com_maianmedia/ajax/cartajax.js');

		$params['orderBy'] = $this->getOrder($params['orderBy']);

		$params['limit'] = $mainframe->getUserStateFromRequest( "limit", 'limit', intval($params['display_num']));

		if($limitstart > 0){
			$limitstart = $mainframe->getUserStateFromRequest( "$option.limitstart", 'limitstart', 0 );
		}

		$params['limitstart'] = ($params['limit'] != 0 ? (floor($limitstart / $params['limit']) * $params['limit']) : 0);

		$aData = '';

		// Get album data...
		$db->setQuery("SELECT #__m15_tracks.*, #__m15_albums.name AS album_name
						FROM #__m15_tracks 
						INNER JOIN #__m15_albums
						ON #__m15_tracks.track_album=#__m15_albums.id 
						WHERE #__m15_albums.status='1' AND is_album = '1'
						AND (track_cost = '0.00' OR freebie = '1')") ;
		$q_tracks= $db->loadObjectList();

		$params['count'] = count($q_tracks);

		// Get album data...
		$db->setQuery("SELECT #__m15_tracks.*, #__m15_albums.name AS album_name
						FROM #__m15_tracks 
						INNER JOIN #__m15_albums
						ON #__m15_tracks.track_album=#__m15_albums.id 
						WHERE #__m15_albums.status='1' AND is_album = '1'
						AND (track_cost = '0.00' OR freebie = '1') ".
		$params['orderBy']."
						Limit ".$params['limitstart'].", ".$params['limit']) ;
		$q_tracks= $db->loadObjectList();

		require_once($this->skin_path.DS.'view.html.php');

		$db->setQuery("SELECT * FROM #__m15_pages WHERE name LIKE 'free'");
		$pages = $db->loadObject();

		JPluginHelper::importPlugin( 'content' );
		$dispatcher =& JDispatcher::getInstance();

		$text = isset($pages) ? JHtml::_('content.prepare', $pages->text) : '';

		$tplParams = (object) $params;
		$skin = new MaianView($tplParams, $this->SETTINGS, $this->skin_name);

		$html = $skin->displayFreeDownloads($q_tracks, $text);

		$html = $this->appendParams($this->extra_params , $html);
		$html = $this->appendParams($this->getParams($id, 'music'), $html);

		HTML_maiainFront::show_FreePage($html);

	}

	// Music..
	function music()
	{
		$mainframe = &JFactory::getApplication();
		$option = JRequest::getCmd('option');;
		$db =& JFactory::getDBO();
		$uri =& JURI::getInstance();
		$id = intval(cleanData(JRequest::getVar('Itemid')));
		$limitstart = intval(cleanData(JRequest::getVar('limitstart')));

		$params = $this->getParams($id, 'music');
		$this->params = $params;

		foreach($this->extra_params as $key=>$value){
			$params[$key] = $value;
		}

		$limit = $mainframe->getUserStateFromRequest( "limit", 'limit', intval($params['display_num']));

		if($limitstart > 0){
			$limitstart = $mainframe->getUserStateFromRequest( "$option.limitstart", 'limitstart', 0 );
		}

		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$orderBy = $this->getOrder($params['orderBy']);

		$cat = intval(cleanData(JRequest::getVar('cat')));

		$artist = cleanData(JRequest::getVar('artist'));

		if (isset($cat)&& $cat != 0) {

			$db->setQuery("SELECT * FROM #__m15_categories where id = ".$cat) ;
			$catStd = $db->loadObject();

			$this->breadcrumbs->addItem($catStd->title, JRoute::_('index.php?option=com_maianmedia&view=music&amp;cat='.$catStd->id));

			$cat = " AND cat=".$catStd->id." ";
		}else{
			$cat="";
		}

		if(isset($artist) && $artist !=""){
			$artist = " AND artist=".$artist." ";
		}

		if($limit != '0'){

			$query = ' SELECT * '
			. ' FROM #__m15_albums
            	WHERE is_album = "1" AND status = \'1\' '.$cat.$artist.'
				'.$orderBy.'
            	LIMIT '.$limitstart.','.$limit;
		}else{
			$query = ' SELECT * '
			. ' FROM #__m15_albums
				WHERE is_album = "1" AND status = \'1\' '.$cat.$artist.'
				'.$orderBy;
		}

		// Get music/album data..
		$db->setQuery("SELECT * FROM #__m15_albums
		WHERE is_album = '1'AND status = '1' ".$cat.$artist) ;
		$q_music = $db->loadObjectList();
		$count = count($q_music);

		$db->setQuery($query) ;
		$q_music = $db->loadObjectList();

		$tplProperties = array('limit'=>$limit, 'limitstart'=>$limitstart,
								'orderBy'=>$orderBy, 'limitstart'=>$limitstart,
								'count'=>$count, 'more_info'=>$params['more_info']);

		foreach($this->extra_params as $key=>$value){
			$tplProperties[$key] = $value;
		}

		require_once($this->skin_path.DS.'view.html.php');

		$tplParams = (object) $tplProperties;
		$skin = new MaianView($tplParams, $this->SETTINGS, $this->skin_name);

		$db->setQuery("SELECT * FROM #__m15_pages WHERE name LIKE 'music'") ;
		$pages = $db->loadObject();

		JPluginHelper::importPlugin( 'content' );
		$dispatcher =& JDispatcher::getInstance();

		$text = isset($pages) ? JHtml::_('content.prepare', $pages->text) : '';

		$html = $skin->displayAlbums($q_music, $text);
		$this->title = $this->title.' - '.$html['MUSIC_TITLE'];

		$html = $this->appendParams($this->extra_params , $html);
		$html = $this->appendParams($this->getParams($id, 'music'), $html);

		HTML_maiainFront::show_MusicPage($html);
	}

	function album()
	{

		$app =& JFactory::getApplication();
		$db =& JFactory::getDBO();
		$uri =& JURI::getInstance();
		$id = intval(cleanData(JRequest::getVar('Itemid')));
		$limitstart = intval(cleanData(JRequest::getVar('limitstart')));

		$params = $this->getParams($id, 'music');
		$this->params = $params;

		// Set keywords..
		$document =& JFactory::getDocument();

		if($this->SETTINGS->enlargeit == '1'){
			$document->addScript( 'components/com_maianmedia/ajax/enlargeit.js' );
		}
		//$document->addScript( 'components/com_maianmedia/players/swfobject.js' );
		$document->addScript( 'components/com_maianmedia/ajax/cartajax.js' );
		$document->addCustomTag($this->checkBoxScript());

		if($this->SETTINGS->ajax == '0'){
			$document->addCustomTag('<script type="text/javascript">window.onload=activateLegacy;</script>');
		}

		// Assign id based on url...
		$aid = (isset($_GET['album']) ? strip_tags($_GET['album']) : '');

		// Security check..
		if (!ctype_digit($aid)) {
			header("Location: ".JRoute::_('index.php?option=com_maianmedia&'.$this->menu_link)."");
			exit;
		}

		$db->setQuery("SELECT * FROM #__m15_albums WHERE id = '{$aid}' LIMIT 1") ;
		$ALBUM = $db->loadObject();

		$q_album = $db->loadObjectList();

		// Row check..
		if (count($q_album)==0) {
			header("Location: ".JRoute::_('index.php?option=com_maianmedia&'.$this->menu_link)."");
			exit;
		}

		$this->title = $this->title.' - '.cleanData($ALBUM->artist).' - '.cleanData($ALBUM->name);

		$document->setTitle($this->SETTINGS->website_name.' '._msg_albums2.' - '.$ALBUM->name);
		$document->setMetaData( cleanData($ALBUM->name), cleanData($ALBUM->keywords), true );

		$this->breadcrumbs->addItem($ALBUM->name, 'index.php?option=com_maianmedia&view=album');

		require_once($this->skin_path.DS.'view.html.php');

		$tplParams = (object) $params;
		$skin = new MaianView($tplParams, $this->SETTINGS, $this->skin_name);

		$ALBUM->comments = isset($ALBUM->comments) ? JHtml::_('content.prepare', $ALBUM->comments) : '';

		$html = $skin->displaySingleAlbum($ALBUM, $this->MM_CART);

		$html = $this->appendParams($this->extra_params , $html);
		$html = $this->appendParams($this->getParams($id, 'music'), $html);
		HTML_maiainFront::show_AlbumPage($html);
			
	}

	function contact()
	{
		$id = intval(cleanData(JRequest::getVar('Itemid')));
		$N_ERROR = false;
		$E_ERROR = false;
		$S_ERROR = false;
		$C_ERROR = false;
		$SUM_ERROR = false;
		$SENT = false;
		$count = 0;

		if (isset($_POST['process'])) {
			// Apply call back element to trim post vars..
			$_POST = array_map('trim',$_POST);
			if (isset($_POST['send'])) {
				if ($_POST['name']=='') {
					$N_ERROR = true;
					$count++;
				}
				if (!eregi("^([a-z]|[0-9]|\.|-|_)+@([a-z]|[0-9]|\.|-|_)+\.([a-z]|[0-9]){2,4}$", $_POST['email'])) {
					$E_ERROR = true;
					$count++;
				}
				if ($_POST['subject']=='') {
					$S_ERROR = true;
					$count++;
				}
				if ($_POST['comments']=='') {
					$C_ERROR = true;
					$count++;
				}
				if ($this->SETTINGS ->enable_captcha && isset($_POST['code'])) {
					include(JPATH_COMPONENT.DS.'securimage'.DS.'securimage.php');
					$img    = new Securimage();
					$valid  = $img->check($_POST['code']);
					if($valid == false) {
						$SUM_ERROR = true;
						$count++;
					}
				}
					
				if ($count==0) {
					$this->MM_MAIL->addTag('{NAME}',cleanEvilTags($_POST['name'],true));
					$this->MM_MAIL->addTag('{EMAIL}',$_POST['email']);
					$this->MM_MAIL->addTag('{COMMENTS}',cleanEvilTags($_POST['comments'],true));
					$this->MM_MAIL->addTag('{IP}',$_SERVER['REMOTE_ADDR']);
					// Send to webmaster..
					$this->MM_MAIL->sendMail($this->SETTINGS ->website_name,
					$this->SETTINGS->email_address,
					$_POST['name'],
					$_POST['email'],
                           '['.$this->SETTINGS->website_name.'] '.cleanEvilTags($_POST['subject'],true),
					$this->MM_MAIL->template(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'email'.DS.'contact_message.txt'));
					// Send auto responder..
					$this->MM_MAIL->sendMail($_POST['name'],
					$_POST['email'],
					$this->SETTINGS->website_name,
					$this->SETTINGS->email_address,
                           '['.$this->SETTINGS->website_name.'] re:'.cleanEvilTags($_POST['subject'],true),
					$this->MM_MAIL->template(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'email'.DS.'contact_auto.txt'));
					$SENT = true;
				}
			}
		}

		$this->title = $this->title.' - '.JText::_( _msg_contact2);

		$tplProperties = array('N_ERROR'=>$N_ERROR, 'E_ERROR'=>$E_ERROR,
								'S_ERROR'=>$S_ERROR, 'C_ERROR'=>$C_ERROR,
								'SUM_ERROR'=>$SUM_ERROR);


		require_once($this->skin_path.DS.'view.html.php');

		$tplParams = (object) $tplProperties;
		$skin = new MaianView($tplParams, $this->SETTINGS, $this->skin_name);

		$html = $skin->displayContactForm($SENT);

		$html = $this->appendParams($this->extra_params , $html);
		$html = $this->appendParams($this->getParams($id, 'contact'), $html);

		HTML_maiainFront::show_ContactPage($html);
	}

	function rss()
	{
		$db =& JFactory::getDBO();
		$rss_feed       = '';
		$build_date     = date('D, j M Y H:i:s').' GMT';
		$MM_FEED              = new rss_Feed();
		// Open channel..
		$rss_feed = $MM_FEED->open_channel();
		// Feed info..
		$title=str_replace("{website_name}",$this->SETTINGS->website_name,JText::_( _msg_rss));

		$rss_feed .= $MM_FEED->feed_info($title,JRoute::_('index.php'), $build_date,
		$this->SETTINGS->website_name);
			
		// Get latest posts..
		$db->setQuery("SELECT * FROM #__m15_albums WHERE is_album = '1'
                        ORDER BY id DESC 
                        LIMIT ".$this->SETTINGS->rssfeeds."
                        ") ;
		$query = $db->loadObjectList();
		foreach($query as $RSS){
			$rss_feed .= $MM_FEED->add_item(JText::_( _msg_rss3).$RSS->artist.' - '.$RSS->name,
			JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$RSS->id),
			($RSS->rss_date ? $RSS->rss_date : $build_date),
			$RSS->comments);
		}
		// Close channel..
		$rss_feed .= $MM_FEED->close_channel();
		// Display RSS feed..
		header('Content-Type: text/xml');

		HTML_maiainFront::show_RSS($rss_feed);
	}

	function licence()
	{
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_pages WHERE name LIKE 'license'") ;
		$pages = $db->loadObject();

		JPluginHelper::importPlugin( 'content' );
		$dispatcher =& JDispatcher::getInstance();

		$results = $dispatcher->trigger('onPrepareContent', array (&$pages, array(), 0));

		$this->title = $this->title.' - '.JText::_( _msg_public_header12);

		require_once($this->skin_path.DS.'view.html.php');

		$skin = new MaianView($html, $this->SETTINGS, $this->skin_name);

		$text = isset($pages) ? JHtml::_('content.prepare', $pages->text) : '';

		$html = $skin->displayContactForm($text);

		$html = $this->appendParams($this->extra_params , $html);
		$html = $this->appendParams($this->getParams($id, 'license'), $html);

		HTML_maiainFront::show_LicencePage($html);
	}

	function about()
	{
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_pages WHERE name LIKE 'about'") ;
		$pages = $db->loadObject();

		$this->title = $this->title.' - '.JText::_( _msg_public_header6);

		require_once($this->skin_path.DS.'view.html.php');

		//$tplParams = (object) $tplProperties;
		foreach($this->getParams($id, 'about') as $key=>$value){
			$html[$key] = $value;
		}

		$skin = new MaianView($html, $this->SETTINGS, $this->skin_name);

		$text = isset($pages) ? JHtml::_('content.prepare', $pages->text) : '';

		$html = $skin->displayAbout($text);

		$html = $this->appendParams($this->extra_params , $html);
		$html = $this->appendParams($this->getParams($id, 'about'), $html);

		HTML_maiainFront::show_AboutPage($tplDisplayData);
	}

	function search()
	{

		$option = JRequest::getCmd('option');
		$mainframe = &JFactory::getApplication();
		$app =& JFactory::getApplication();

		$this->breadcrumbs->addItem(JText::_( _msg_public_header7), 'index.php?option=com_maianmedia&view=search');
		$id = intval(cleanData(JRequest::getVar('Itemid')));
		$limitstart = intval(cleanData(JRequest::getVar('limitstart')));

		$db =& JFactory::getDBO();

		$params = $this->getParams($id, 'music');
		$this->params = $params;

		$this->title  = $this->title.' - '.JText::_( _msg_public_header7);
		$sql    = '';
		$sData  = '';
		$db =& JFactory::getDBO();
		$uri =& JURI::getInstance();
		// Search database..
		if (!isset($_GET['keywords'])) {
			header("Location: ".JRoute::_('index.php?option=com_maianmedia'.$this->menu_link)."");
			exit;
		}

		// Split keywords and trim whitespace..
		$keys = array_map('trim',explode(" ", cleanEvilTags($_GET['keywords'])));
		// Loop through keywords...
		for ($i=0; $i<count($keys); $i++) {
			$sArtist = "(#__m15_albums.artist LIKE '%".mysql_real_escape_string($keys[$i])."%'";
			$sTrackName = " OR #__m15_tracks.track_name LIKE '%".mysql_real_escape_string($keys[$i])."%'";
			$sName = " OR #__m15_albums.name LIKE '%".mysql_real_escape_string($keys[$i])."%'";
			$sKeywords = " OR #__m15_albums.keywords LIKE '%".mysql_real_escape_string($keys[$i])."%'";
			$sCat = " OR #__m15_categories.title LIKE '%".mysql_real_escape_string($keys[$i])."%') and #__m15_albums.status='1'";

			$sql .= ($i ? 'OR ' : 'WHERE ').$sArtist.$sTrackName.$sName.$sKeywords.$sCat;
		}

		$limit = $mainframe->getUserStateFromRequest( "limit", 'limit', intval($params['display_num']));

		if($limitstart > 0){
			$limitstart = $mainframe->getUserStateFromRequest( "$option.limitstart", 'limitstart', 0 );
		}

		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$artist = JRequest::getCmd('artist_filter');
		if(isset($artist) && $artist !=''){
			$name = mysql_real_escape_string('%'.cleanData(str_replace('+',' ',$_GET['keywords'])).'%');
			$this->_log->logInfo("Artist Input".$name);
			$sql="WHERE #__m15_albums.artist LIKE ".$name."";
		}

		$fullQuery = "SELECT DISTINCT #__m15_albums.id AS id FROM #__m15_albums LEFT OUTER JOIN #__m15_categories ON #__m15_albums.cat= #__m15_categories.id LEFT OUTER JOIN #__m15_tracks ON #__m15_tracks.track_album=#__m15_albums.id $sql";
		$this->_log->logInfo($fullQuery);

		// Get Count.
		$db->setQuery($fullQuery) ;

		$musicList =  $db->loadObjectList();
		$count = count($musicList);

		$db->setQuery("$fullQuery LIMIT $limitstart,$limit") ;

		$musicList =  $db->loadObjectList();
		$i = 0;

		foreach($musicList as $aId){
			$query = $db->setQuery("SELECT * FROM  #__m15_albums WHERE id=$aId->id");
			$aObject = $db->loadObject();

			$q_music[$i] = $aObject;
			$i++;
		}

		$tplProperties = array('limit'=>$limit, 'limitstart'=>$limitstart,
								'orderBy'=>$orderBy, 'limitstart'=>$limitstart,
								'count'=>$count, 'more_info'=>$params['more_info']);

		require_once($this->skin_path.DS.'view.html.php');

		foreach($this->getParams($id, 'music') as $key=>$value){
			$tplProperties[$key] = $value;
		}

		$tplParams = (object) $tplProperties;

		$skin = new MaianView($html, $this->SETTINGS, $this->skin_name);

		$html = $skin->displaySearchResults($q_music);

		$html = $this->appendParams($this->extra_params , $html);

		HTML_maiainFront::show_SearchPage($html);

	}

	function categories(){
		$mainframe = &JFactory::getApplication();
		$option = JRequest::getCmd('option');;
		$db =& JFactory::getDBO();
		$uri =& JURI::getInstance();
		$id = intval(cleanData(JRequest::getVar('Itemid')));
		$limitstart = intval(cleanData(JRequest::getVar('limitstart')));

		$params = $this->getParams($id, 'categories');
		$params = $params + $this->getParams($id, 'music');
		$this->params = $params;

		$limit = $mainframe->getUserStateFromRequest( "limit", 'limit', intval($params['display_num']));

		if($limitstart > 0){
			$limitstart = $mainframe->getUserStateFromRequest( "$option.limitstart", 'limitstart', 0 );
		}

		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$mData = '';

		$orderBy = $this->getOrder($params['orderBy']);

		$orderBy = str_replace("artist,", "", $orderBy);
		$orderBy = str_replace(", artist", "", $orderBy);

		if($limit != '0'){

			$query = ' SELECT * '
			. ' FROM #__m15_categories where section = \'com_maianmedia\'
			AND published = \'1\'
				'.$orderBy.'
            	LIMIT '.$limitstart.','.$limit;
		}else{
			$query = ' SELECT * '
			. ' FROM #__m15_categories where section = \'com_maianmedia\'
			AND  published = \'1\'
				'.$orderBy;
		}

		// Get data..
		$db->setQuery(' SELECT * '
		. ' FROM #__m15_categories where section = \'com_maianmedia\'
			AND  published = \'1\'') ;
		$cats = $db->loadObjectList();
		$count = count($cats);

		$db->setQuery($query) ;
		$cats = $db->loadObjectList();

		$this->title = $this->title.' - '.JText::_( _msg_public_header4);

		$db->setQuery("SELECT * FROM #__m15_pages WHERE name LIKE 'cat'") ;
		$pages = $db->loadObject();

		$tplProperties = array('limit'=>$limit, 'limitstart'=>$limitstart,
								'orderBy'=>$orderBy, 'limitstart'=>$limitstart,
								'count'=>$count, 'more_info'=>$params['more_info']);

		require_once($this->skin_path.DS.'view.html.php');

		$tplParams = (object) $tplProperties;
		$skin = new MaianView($tplParams, $this->SETTINGS, $this->skin_name);

		JPluginHelper::importPlugin( 'content' );
		$dispatcher =& JDispatcher::getInstance();

		$text = isset($pages) ? JHtml::_('content.prepare', $pages->text) : '';

		$html = $skin->displayCategories($cats, $text);

		$html = $this->appendParams($this->getParams($id, 'music'), $html);

		HTML_maiainFront::show_CatPage($html);
	}

	function singles()
	{
		$mainframe = &JFactory::getApplication();
		$option = JRequest::getCmd('option');
		$keyword = JRequest::getCmd('keywords');
		$db =& JFactory::getDBO();
		$uri =& JURI::getInstance();
		$id = intval(cleanData(JRequest::getVar('Itemid')));
		$limitstart = intval(cleanData(JRequest::getVar('limitstart')));

		$params = $this->getParams($id, 'freebie');
		$this->params = $params;

		$document = &JFactory::getDocument();
		$document->addScript('components/com_maianmedia/ajax/cartajax.js');

		$orderBy = $this->getOrder($params['orderBy']);

		$limit = $mainframe->getUserStateFromRequest( "limit", 'limit', intval($params['display_num']));

		if($limitstart > 0){
			$limitstart = $mainframe->getUserStateFromRequest( "$option.limitstart", 'limitstart', 0 );
		}

		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$aData = '';
		$sData = '';
		$filter = '';
		if(isset($keyword) && $keyword != ''){
			$filter = " AND keywords='".$keyword."'";
		}
		// Get track data...
		$db->setQuery("SELECT * FROM #__m15_tracks
		WHERE published = '1' $filter") ;
		$q_tracks= $db->loadObjectList();

		$count = count($q_tracks);

		// Get track data...
		$db->setQuery("SELECT * FROM #__m15_tracks
		WHERE published = '1' $filter $orderBy Limit $limitstart, $limit") ;
		$q_tracks= $db->loadObjectList();

		$db->setQuery("SELECT * FROM #__m15_pages WHERE name LIKE 'singles'");
		$pages = $db->loadObject();

		$tplProperties = array('limit'=>$limit, 'limitstart'=>$limitstart,
								'orderBy'=>$orderBy, 'limitstart'=>$limitstart,
								'count'=>$count, 'more_info'=>$params['more_info']);

		require_once($this->skin_path.DS.'view.html.php');

		$tplParams = (object) $tplProperties;
		$skin = new MaianView($tplParams, $this->SETTINGS, $this->skin_name);

		JPluginHelper::importPlugin( 'content' );
		$dispatcher =& JDispatcher::getInstance();

		$text = isset($pages) ? JHtml::_('content.prepare', $pages->text) : '';

		$html = $skin->displayTracks($q_tracks, $text);
		$this->title = $this->title.' - '.$html['MUSIC_TITLE'];

		$html = $this->appendParams($this->extra_params , $html);
		$html = $this->appendParams($this->getParams($id, 'music'), $html);
		$html = $this->appendParams($this->getParams($id, 'singles'), $html);

		HTML_maiainFront::show_SinglePage($html);

	}

}