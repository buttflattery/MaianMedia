<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once(dirname(__FILE__).DS.'helper.php');

class MaianView extends MaianViewHelper
{
	var $tplDisplayData;

	function __construct($params, $SETTINGS, $skin)
	{
		parent::__construct($params, $SETTINGS, $skin);
		$this->tplDisplayData = array();
		$this->tplDisplayData['RENDER_LANG'] = $this->getLangDisplay();
	}

	function displayAlbums($albums, $text)
	{
		$db =$this->db;
		$params = $this->params;

		//jimport('joomla.html.pagination');
		//$pageNav = new JPagination($params->count, $params->limitstart, $params->limit );

		$this->tplDisplayData['MUSIC_TITLE']=JText::_(_msg_public_header4);
		$this->tplDisplayData['MUSIC_TEXT']=$text;
		$this->tplDisplayData['MUSIC_MESSAGE']=JText::_( _msg_music);
		$this->tplDisplayData['MUSIC_DATA']= $this->mooFlowPage($albums);
		//$this->tplDisplayData['PAGE_NUMBERS']= $pageNav->getPagesLinks();
		return $this->tplDisplayData;
	}

	function displayMostPopular($text){

		$db =$this->db;
		$params = $this->params;

		$this->tplDisplayData['HOME_TEXT'] = cleanData($this->SETTINGS->website_name);
		$this->tplDisplayData['HOME_MESSAGE'] = isset($text) && $text != '' ? $text :str_replace('\"','"',JText::_(_msg_publichome));
		$this->tplDisplayData['PAYPAL_MESSAGE'] = JText::_(_msg_publichome2);
		$this->tplDisplayData['MOST_POPULAR_TRACKS'] = $params->display_track.' '.JText::_(_msg_publichome3);
		$this->tplDisplayData['MOST_POPULAR_ALBUMS'] = $params->display_albums.' '.JText::_(_msg_publichome4);
		$this->tplDisplayData['MOST_POPULAR_TRACKS_LIST'] = $this->getPopularTracks($params->display_track);
		$this->tplDisplayData['MOST_POPULAR_ALBUMS_LIST'] = $this->getPopularAlbums($params->display_albums);
		$this->tplDisplayData['LATEST_TRACKS'] = $params->display_latest_track.' '.JText::_(_msg_publichome6);
		$this->tplDisplayData['LATEST_ALBUMS'] = $params->display_latest_albums.' '.JText::_(_msg_publichome5);
		$this->tplDisplayData['LATEST_TRACKS_LIST'] =$this->getLatestTracks($params->display_track);
		$this->tplDisplayData['LATEST_ALBUMS_LIST'] = $this->getLatestAlbums($params->display_albums);
		return $this->tplDisplayData;
	}

	function displayFreeDownloads($q_tracks, $text){

		$db =$this->db;
		$params = $this->params;

		jimport('joomla.html.pagination');
		$pageNav = new JPagination($params->count, $params->limitstart, $params->limit );

		$this->tplDisplayData['TRACK_TEXT'] = JText::_(_msg_free_download);
		$this->tplDisplayData['TRACK_MESSAGE'] = $text;
		$this->tplDisplayData['TRACK_NAME'] = JText::_( _msg_publicalbum5);
		$this->tplDisplayData['TRACK_OPTIONS'] = JText::_( _msg_publicalbum3);
		$this->tplDisplayData['TRACK_ALBUM'] = JText::_( _msg_albums2);
		$this->tplDisplayData['GET_EMAIL'] = $this->getEmailForm();
		$this->tplDisplayData['TRACK_DATA'] =  $this->getFreeData($q_tracks);
		$this->tplDisplayData['PREVIEW'] = JText::_( _msg_publicalbum10);
		$this->tplDisplayData['URL'] = JRoute::_('index.php?option=com_maianmedia&view=freebie');
		$this->tplDisplayData['PAGE_NUMBERS']= $pageNav->getPagesLinks();

		return $this->tplDisplayData;
	}

	function displaySingleAlbum($ALBUM, $MM_CART){

		$db =$this->db;
		$params = $this->params;

		$this->tplDisplayData['ALBUM_TEXT'] = JText::_( _msg_publicalbum);
		$this->tplDisplayData['ALBUM_MESSAGE'] = (isset($ALBUM->comments) ? cleanData($ALBUM->comments) : JText::_( _msg_publicalbum2));
		$this->tplDisplayData['ARTIST'] = cleanData($ALBUM->artist);
		$this->tplDisplayData['TRACK_NAME'] = JText::_( _msg_publicalbum5);
		$this->tplDisplayData['TRACK_COST'] = JText::_( _msg_publicalbum6);
		$this->tplDisplayData['TRACK_OPTIONS'] = JText::_( _msg_publicalbum3);
		$this->tplDisplayData['CHILDREN'] =  $this->getChildAlbums($ALBUM);
		$this->tplDisplayData['NAME'] = cleanData($ALBUM->name);
		$this->tplDisplayData['ADD_ALL'] = JText::_( _msg_publicalbum8);
		$this->tplDisplayData['ADD_PHYSICAL'] = JText::_(_msg_physical);
		$this->tplDisplayData['ADD_PHYSICAL_URL'] = $this->getAddPhysicalURL($ALBUM);

		$this->tplDisplayData['PREV_URL'] =  JRoute::_('index.php?option=com_maianmedia&view=preview_tracks&amp;album='.$ALBUM->id);
		$this->tplDisplayData['CANCEL'] = JText::_( _msg_script9);
		$this->tplDisplayData['PREVIEW'] = JText::_( _msg_publicalbum10);
		$this->tplDisplayData['ALBUM_ID'] =  $ALBUM->id;
		$this->tplDisplayData['TRACKS_RIGHT'] = "";
		//$this->tplDisplayData['TRACKS_RIGHT'] = JText::_( _msg_tracks_right);
		$this->tplDisplayData['FORM_ACTION'] = JRoute::_('index.php?option=com_maianmedia&section=cart&task=add_legacy');
		$this->tplDisplayData['ADD_TO_CART'] = JText::_( _msg_publicalbum9);
		$this->tplDisplayData['URL'] = JRoute::_('index.php?option=com_maianmedia&view=music');
		$this->tplDisplayData['HITS'] = str_replace("{count}",number_format($ALBUM->hits),JText::_( _msg_publicalbum12));


		$this->tplDisplayData['ALBUM_DATA'] =  $this->getTracksInAlbum($ALBUM);
		$this->tplDisplayData['ALBUM_ADDED'] = $this->isAdded($ALBUM->id);
		$this->tplDisplayData['DISCOUNT'] = $this->getAlbumDiscount($ALBUM);
		$this->tplDisplayData['IMG_INLINE_STYLE'] = $this->getAlbumImage($ALBUM);
		$this->tplDisplayData['ADD_URL'] = $this->getAddURL($ALBUM);
		$this->tplDisplayData['PHYSICAL_PRICE'] =  $this->getPhysicalPrice($ALBUM);
		$this->tplDisplayData['ALBUM_COST'] = $MM_CART->getFullAlbumCost($ALBUM->id, 0);

		return $this->tplDisplayData;

	}

	function displayContactForm($SENT){

		$this->tplDisplayData['CONTACT_MESSAGE'] = ($SENT ? JText::_( _msg_contact8) : JText::_( _msg_contact));
		$this->tplDisplayData['FORM_TEXT'] = ($SENT ? JText::_( _msg_contact13) : JText::_( _msg_contact2));
		$this->tplDisplayData['FORM_DISPLAY'] = ($SENT ? ' style="display:none"' : '');
		$this->tplDisplayData['NAME_TEXT'] = JText::_( _msg_contact9);
		$this->tplDisplayData['EMAIL_TEXT'] = JText::_( _msg_contact10);
		$this->tplDisplayData['SUBJECT_TEXT'] = JText::_( _msg_contact3);
		$this->tplDisplayData['C_URL'] = JRoute::_('index.php?option=com_maianmedia&view=contact');
		$this->tplDisplayData['COMMENT_TEXT'] = JText::_( _msg_contact4);
		$this->tplDisplayData['NAME_VALUE'] = (isset($_POST['name']) ? cleanData($_POST['name']) : '');
		$this->tplDisplayData['EMAIL_VALUE'] = (isset($_POST['email']) ? cleanData($_POST['email']) : '');
		$this->tplDisplayData['SUBJECT_VALUE'] = (isset($_POST['subject']) ? cleanData($_POST['subject']) : '');
		$this->tplDisplayData['COMMENT_VALUE'] = (isset($_POST['comments']) ? cleanData($_POST['comments']) : '');

		if(!$SENT){
			$this->tplDisplayData['CAPTCHA'] =showCaptcha(JText::_( _msg_contact11),(isset($params->SUM_ERROR) ? '<br /><span class="mm_error">'.JText::_( _msg_contact12).'</span>' : ''), $this->SETTINGS->enable_captcha);
		}else{
			$this->tplDisplayData['CAPTCHA'] = '';
		}

		$this->tplDisplayData['N_ERROR'] = ($this->params->N_ERROR ? '<br /><span class="mm_error">'.JText::_( _msg_contact15).'</span>' : '');
		$this->tplDisplayData['E_ERROR'] = ($this->params->E_ERROR ? '<br /><span class="mm_error">'.JText::_( _msg_contact16).'</span>' : '');
		$this->tplDisplayData['S_ERROR'] = ($this->params->S_ERROR ? '<br /><span class="mm_error">'.JText::_( _msg_contact6).'</span>' : '');
		$this->tplDisplayData['C_ERROR'] = ($this->params->C_ERROR ? '<br /><span class="mm_error">'.JText::_( _msg_contact7).'</span>' : '');
		$this->tplDisplayData['SEND_TEXT'] = JText::_( _msg_contact5);

		return $this->tplDisplayData;

	}

	function displayLicense($text){

		$this->tplDisplayData['LICENCE_TEXT'] = JText::_( _msg_public_header12);
		$this->tplDisplayData['LICENCE'] = nl2br(cleanData($text));

		return $this->tplDisplayData;
	}

	function displayAbout($text){

		$this->tplDisplayData['ABOUT_TEXT'] = JText::_( _msg_public_header12);
		$this->tplDisplayData['ABOUT'] = nl2br(cleanData($text));

		return $this->tplDisplayData;
	}

	function displayCategories($cats, $text){

		$db =$this->db;
		$params = $this->params;

		jimport('joomla.html.pagination');
		$pageNav = new JPagination($params->count, $params->limitstart, $params->limit );

		$this->tplDisplayData['CAT_TITLE']=JText::_(_msg_header10);
		$this->tplDisplayData['CAT_TEXT']=$text;
		$this->tplDisplayData['CAT_DATA']= $this->getCatData($cats);
		$this->tplDisplayData['PAGE_NUMBERS']= $pageNav->getPagesLinks();
		return $this->tplDisplayData;
	}

	function displayTracks($tracks, $text){

		$db =$this->db;
		$params = $this->params;

		jimport('joomla.html.pagination');
		$pageNav = new JPagination($params->count, $params->limitstart, $params->limit );

		$this->tplDisplayData['TRACK_TEXT'] = "";
		$this->tplDisplayData['TRACK_MESSAGE'] = $pages->text;
		$this->tplDisplayData['TRACK_NAME'] = JText::_( _msg_publicalbum5);
		$this->tplDisplayData['TRACK_OPTIONS'] = JText::_( _msg_publicalbum3);
		$this->tplDisplayData['TRACK_ALBUM'] = JText::_('Cost');
		$this->tplDisplayData['TRACK_DATA'] =  $this->getSingleTrackData($tracks);
		$this->tplDisplayData['PREVIEW'] = JText::_( _msg_publicalbum10);
		$this->tplDisplayData['URL'] = JRoute::_('index.php?option=com_maianmedia&view=freebie');
		$this->tplDisplayData['PAGE_NUMBERS']= $pageNav->getPagesLinks();

		return $this->tplDisplayData;
	}

	function displaySearchResults(){

		jimport('joomla.html.pagination');
		$pageNav = new JPagination($params->count, $params->limitstart, $params->limit );

		$this->tplDisplayData['SEARCH_TEXT'] =  JText::_( _msg_publicsearch);
		$this->tplDisplayData['SEARCH_MESSAGE'] =  str_replace("{keywords}",cleanEvilTags($_GET['keywords']),JText::_( _msg_publicsearch2));
		$this->tplDisplayData['SEARCH_DATA'] =  $this->getSearchData($q_music);

		$this->tplDisplayData['PAGE_NUMBERS']= $pageNav->getPagesLinks();

		return $this->tplDisplayData;

	}

	function displayCart($MM_CART){

		$this->tplDisplayData['CART_TEXT'] = JText::_(_msg_cart);
		$this->tplDisplayData['CART_MESSAGE'] = JText::_(_msg_cart2);
		$this->tplDisplayData['CART_DATA'] = $this->getCartDataView($MM_CART);//$cData;
		$this->tplDisplayData['CART_BUTTONS'] = $this->getCartButtons($MM_CART);//$cButtons;

		return $this->tplDisplayData;
	}

	function displayCheckOut($GATEWAY, $MM_CART, $cartID){

		$shipping = $MM_CART->purchasedPhysical('albums',$cartID,JText::_(_msg_cart8));

		/*if($shipping == 'N/A'){
			$this->MM_PAYPAL->add_field('no_shipping','1');
			}else{
			$this->MM_PAYPAL->add_field('no_shipping','2');

			}*/


		$this->tplDisplayData['CONNECTING'] =  JText::_(_msg_paypal);
		$this->tplDisplayData['PAYPAL_FORM_FIELDS'] =  $GATEWAY->loadHiddenFields();

		return $this->tplDisplayData;
	}

	function displayThankYou($cartData, $MM_PAYPAL ){
		$uri =& JURI::getInstance();

		$this->tplDisplayData['THANKS_TEXT'] = JText::_(_msg_paypal7);
		$this->tplDisplayData['THANKS_MESSAGE'] = str_replace(array('{email}','{store}'),array($MM_PAYPAL->paypal_post_vars['payer_email'],cleanData($this->SETTINGS->website_name)),JText::_(_msg_paypal8));

		if($this->SETTINGS->show_download == '1'){
			$link = JRoute::_('index.php?option=com_maianmedia&section=download&code='.$cartData->download_code);
			$href = '<a href="'.$link.'" title="'.JText::_(_msg_go_to_download).'" ><img src="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/free_download.png" alt="'.JText::_(_msg_go_to_download).'" title="'.JText::_(_msg_go_to_download).'" /></a>';
			$this->tplDisplayData['DOWNLOAD_MESSAGE'] = '<div id="go_to_download">'.JText::_(_msg_download_message).'<br>'.$href.'</div>';
		}

		return $this->tplDisplayData;
	}

	function displayDownloadPage($albumData, $trackData){
		$this->tplDisplayData['DOWNLOAD_TEXT'] =  JText::_(_msg_paypal14);
		$this->tplDisplayData['DOWNLOAD_MESSAGE'] =  str_replace("{duration}",($this->SETTINGS->download_expiry=='1' ? '<b>'.JText::_(_msg_paypal16).'</b>' : ($this->SETTINGS->download_expiry=='2' ? '<b>'.JText::_(_msg_paypal17).'</b>' : '<b>'.($this->SETTINGS->download_expiry==0 ? JText::_(_msg_script12) : $this->SETTINGS->download_expiry).'</b> '.JText::_(_msg_paypal18))),JText::_(_msg_paypal15));
		$this->tplDisplayData['ALBUMS'] = JText::_(_msg_paypal19);
		$this->tplDisplayData['TRACKS'] = JText::_(_msg_paypal20);
		$this->tplDisplayData['ENJOY_MUSIC'] =  JText::_(_msg_paypal23);
		$this->tplDisplayData['ALBUM_DATA'] = $albumData;
		$this->tplDisplayData['TRACK_DATA'] = $trackData;

		return $this->tplDisplayData;
	}

	function displayItemPage($data, $link){
		$this->tplDisplayData['DATA'] =  $data;
		$this->tplDisplayData['LINK'] =  $link;

		return $this->tplDisplayData;
	}

	function displayErrorPage(){
		$this->tplDisplayData['ERROR_TEXT'] = JText::_(_msg_paypal9);
		$this->tplDisplayData['ERROR_MESSAGE'] = JText::_(_msg_paypal10);

		return $this->tplDisplayData;
	}

}