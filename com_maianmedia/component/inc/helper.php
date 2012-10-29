<?php defined( '_JEXEC' ) or die( 'Restricted access' );

class MaianHelper
{
	var $params, $SETTINGS, $db, $skin_name, $skin_path, $_log;

	function __construct($params, $SETTINGS, $skin='classic')
	{
		$this->params = $params;
		$this->SETTINGS = $SETTINGS;
		$this->db = &JFactory::getDBO();
		$this->skin_name = $skin;
		$this->skin_path = JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.getTplPath($this->skin_name);

		if($SETTINGS->log_errors == '1'){
			$this->_log = new MaianLogger(JPATH_COMPONENT_SITE.DS.'log', MaianLogger::DEBUG);
		}else{
			$this->_log = new MaianLogger(JPATH_COMPONENT_SITE.DS.'log', MaianLogger::OFF);
		}
	}

	function getCatalog($albums){
		$uri =& JURI::getInstance();
		$params = $this->params;
		$mData ="";
		foreach($albums as $MUSIC){
			$image_link = $uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/icons/no_picture.png';
			$more_info_image = $uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/icons/more_info.png';

			if($params->more_info == '0'){
				$style = 'display: none;';
			}else{
				$style = '';
			}

			$images_dimensions = '';

			if($MUSIC->image != "" && $MUSIC->image !="http://"){
				$image_link = $MUSIC->image;
				$images_dimensions = 'height=75px width=75px';
			}

			$find     = array('{url}','{more_info_image}','{label}','{dimensions}','{album_image}','{more_info}','{artist}','{album_title}','{tracks}','{style}');
			$replace  = array(JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$MUSIC->id),$more_info_image,$MUSIC->label,$images_dimensions,
			$image_link,JText::_( _msg_music2),cleanData($MUSIC->artist),cleanData($MUSIC->name),str_replace("{count}",getTrackCount($MUSIC->id),JText::_( _msg_music3)), $style);
			$mData .= str_replace($find,$replace,
			file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'album_data.html'));
		}

		return $mData;
	}

	function getSearchData($q_music){

		$sData = '';
		$params = $this-params;
		$uri =& JURI::getInstance();

		if($params->more_info == '0'){
			$style = 'display: none;';
		}else{
			$style = '';
		}

		if (count($q_music) > 0) {

			foreach($q_music as $MUSIC){
					
				$image_link = $uri->root().'components/com_maianmedia/'.getTplPath($this->skin, 'img').'/icons/no_picture.png';
				$more_info_image = $uri->root().'components/com_maianmedia/'.getTplPath($this->skin, 'img').'/icons/more_info.png';
				$images_dimensions = '';
					
				if($MUSIC->image != ""){
					$image_link = $MUSIC->image;
					$images_dimensions = 'height=75px width=75px';
				}
				//$find     = array('{url}','{more_info}','{artist}','{album_title}','{tracks}');
				//$replace  = array(JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$MUSIC->id),JText::_( _msg_music2,cleanData($MUSIC->artist),cleanData($MUSIC->name),str_replace("{count}",getTrackCount($MUSIC->id),JText::_( _msg_music3));
				$find     = array('{url}','{more_info_image}','{label}','{dimensions}','{album_image}','{more_info}','{artist}','{album_title}','{tracks}');
				$replace  = array(JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$MUSIC->id),
				$more_info_image,$MUSIC->label,$images_dimensions, $image_link,JText::_( _msg_music2),cleanData($MUSIC->artist),cleanData($MUSIC->name),str_replace("{count}",getTrackCount($MUSIC->id),JText::_( _msg_music3)));
				$sData .= str_replace($find,$replace,

				file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'album_data.html')

				);
			}
		} else {

			$sData = str_replace("{message}",JText::_( _msg_publicsearch3),file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin).DS.'tpl'.DS.'message.html'));

		}

		return $sData;

	}

	function getEmailForm(){

		$sData = '';
		//$params = $this-params;
		if($this->params->email == '1'){
			if(!$_SESSION['mm_email']){
				$find       = array('{item_id}','{required_field}','{invalid_address}','{name}','{email}', '{submit}');
				$replace    = array($id, JText::_(_msg_require_field), JText::_(_msg_invalid_email), JText::_(_msg_name), JText::_(_msg_email), JText::_(_msg_submit));
				$tpl = file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'free_download.html');
				$sData = str_replace($find,$replace, $tpl);
			}
		}

		return $sData;
	}

	function getCartDataView($MM_CART){
		$cData = '';

		if ($MM_CART->cartCount()>0) {
			// Cart header..
			$cData = str_replace('{item_name}',str_replace("{count}",$MM_CART->cartCount(),JText::_(_msg_cart4)),file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'cart_items_header.html'));
			// Cart data..
			for ($i=0; $i<count($_SESSION['album_name']); $i++) {

				// Assign album data if track..
				if (isset($_SESSION['track_id'][$i]) && $_SESSION['track_id'][$i]>0) {
					$ADATA = $this->getSingleAlbumData($_SESSION['track_id'][$i]);
				}
				// Check key exists..prevents offset errors..
				// None should exist. but good practice to check..
				if (isset($_SESSION['track_id'][$i])) {
					// If track and album id are empty, this is a deleted item, so don`t show it..
					if ($_SESSION['track_id'][$i]>0 || $_SESSION['album_id'][$i]>0 || $_SESSION['physical_id'][$i]>0) {

						if($this->SETTINGS->ajax == '0'){
							$delete_link = JRoute::_('index.php?option=com_maianmedia&section=cart&view=delete_item&item='.$_SESSION['entry_code'][$i]);
						}else{
							$delete_link = 'javascript:removeItem('.$i.',\''.$_SESSION['entry_code'][$i].'\');';
						}

						$cData .= str_replace(array('{id}','{item_name}','{cost}','{delete_url}','{delete_this_item}','{are_you_sure}'),
						array($i,
						cleanData(($_SESSION['album_name'][$i] ? $_SESSION['album_name'][$i] : $_SESSION['track_name'][$i])).($_SESSION['track_name'][$i] ? '<br /><span class="from_album">'.JText::_(_msg_cart8).' <a href="'.JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$ADATA->id).'" title="'.cleanData($ADATA->artist).' - '.cleanData($ADATA->name).'">'.cleanData($ADATA->artist).' - '.cleanData($ADATA->name).'</a></span>' : ''),
						get_cur_symbol(($_SESSION['track_cost'][$i] ? $_SESSION['track_cost'][$i] : $_SESSION['album_cost'][$i]),$this->SETTINGS->paypal_currency),
						$delete_link,
						JText::_(_msg_javascript26),
						JText::_(_msg_javascript26)
						),
						file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'cart_item.html')
						);
					}
				}
			}

			$cData .= str_replace("{cart_total}",JText::_(_msg_cart5).': '.get_cur_symbol($MM_CART->cartTotal(),$this->SETTINGS->paypal_currency),
			file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'cart_total.html'));

		} else {
			$cData = str_replace('{text}',JText::_(_msg_cart3),file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'empty_cart.html'));
		}

		return $cData;
	}

	function getCartButtons($MM_CART){
		$cButtons = '';

		if ($MM_CART->cartCount()>0) {
				
			if($this->SETTINGS->shopbutton == '1'){

				// Cart buttons..
				$cButtons = str_replace(array('{continue_url}','{continue}','{clear_url}','{are_you_sure}','{clear}','{checkout_url}','{checkout}'),
				array(
				JRoute::_('index.php?option=com_maianmedia&view=music'),
				JText::_(_msg_continue),
				JRoute::_('index.php?option=com_maianmedia&section=cart&view=clear_cart'),
				JText::_(_msg_javascript25),
				JText::_(_msg_cart6),
				JRoute::_('index.php?option=com_maianmedia&section=cart&view=checkout'),
				JText::_(_msg_cart7)),
				file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'cart_buttons.html'));
			}else{

				$remove_continue='<a href="{checkout_url}">
						         <div class="mm_button2-right">
									<div class="mm_checkout">
						         	<font>{checkout}</font>
						         	</div>
						         </div></a>';

				$cButtons = str_replace(array($remove_continue,'{continue}','{clear_url}','{are_you_sure}','{clear}','{checkout_url}','{checkout}'),
				array(
				JRoute::_('index.php?option=com_maianmedia&view=music'),
				JText::_(_msg_continue),
				JRoute::_('index.php?option=com_maianmedia&section=cart&view=clear_cart'),
				JText::_(_msg_javascript25),
				JText::_(_msg_cart6),
				JRoute::_('index.php?option=com_maianmedia&section=cart&view=checkout'),
				JText::_(_msg_cart7)
				),
				file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'cart_buttons.html')
				);
			}
		}

		return $cButtons;
	}

	function getFreeData($q_tracks){

		$aData = '';
		$intNumber = 0;
		$count = 0;

		$mPlayer = getPlayer();

		foreach($q_tracks as $TRACKS) {
			$intNumber = $intNumber + 1;
			$altRow = '';

			if(isset($this->params->alt_row) && $this->params->alt_row == '1'){
				if ($intNumber % 2 == 0 )
				{
					if($this->params->color != 'none' ||$this->params->color != ''){
						$altRow = 'style="background-color:'.$this->params->color.'"';
					}
				}
			}

			$link = '<img src="components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/no_single.png" alt="'.JText::_(_msg_no_download).'" title="'.JText::_(_msg_no_download).'" />';
			// Is single track purchasable?
			$link = $this->getLink($TRACKS->id);

			$find     = array('{id}','{link}');
			$replace = array($TRACKS->id, $link);
			$tpl = file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'add_to_cart.html');

			$single = str_replace($find ,$replace, $tpl);

			$tracklength;
			if($TRACKS->track_length != ""){
				$tracklength = "(".$TRACKS->track_length.")";
			}
				
			$album_link = '<a href="'.JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$TRACKS->track_album).'">'.$TRACKS->album_name.'</a>';
			$player = '<!-- Begin Maian Player -->'
			.$mPlayer->getPlayer(genPreview($TRACKS->id), $TRACKS->id, $intNumber)
			.'<!-- End Maian Player -->';
			$title = cleanData($TRACKS->track_name);

			$find     = array('{flash_player}','{title}','{alt_row}','({duration})','{cost}','{add_to_cart}');
			$replace  = array($mPlayer->getPlayer(genPreview($TRACKS->id), $TRACKS->id), $title, $altRow, $tracklength,$album_link ,$single);

			$tpl = "";
			if(file_exists(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'free_tracks.html')){
				$tpl = file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'free_tracks.html');
			}else{
				$tpl = file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'tracks.html');
			}


			$aData .= str_replace($find,$replace, $tpl);
		}

		return $aData;

	}

	function getPopularAlbums($poplinks){

		$uri =& JURI::getInstance();
		$db =&JFactory::getDBO();
		$params = $this->params;

		$db->setQuery("SELECT * FROM #__m15_albums WHERE is_album = '1' AND status='1'
						ORDER BY downloads 
						DESC LIMIT $poplinks") ;

		$q_pop_albums = $db->loadObjectList();

		if (count($q_pop_albums) == 0) {
			return '';
		}

		return $this->getAlbumsData($q_pop_albums);
	}


	function getPopularTracks($poplinks){

		$uri =& JURI::getInstance();
		$db =&JFactory::getDBO();
		$params = $this->params;

		$db->setQuery("SELECT *,#__m15_albums.id AS i_id
						FROM #__m15_tracks 
						LEFT JOIN #__m15_albums	
						ON #__m15_tracks.track_album = #__m15_albums.id
						ORDER BY #__m15_tracks.downloads 
						DESC LIMIT $poplinks");

		$q_pop_tracks = $db->loadObjectList();

		if (count($q_pop_tracks) == 0) {
			return '';
		}

		return $this->getTracksData($q_pop_tracks);
	}

	function getLatestAlbums($poplinks){
		$uri =& JURI::getInstance();
		$db =&JFactory::getDBO();
		$params = $this->params;

		$db->setQuery("SELECT * FROM #__m15_albums
                  		WHERE status = '1' AND is_album = '1' ORDER BY id DESC  
                  		LIMIT $poplinks");

		$q_latest_albums = $db->loadObjectList();

		if (count($q_latest_albums) == 0) {
			return '';
		}

		return $this->getAlbumsData($q_latest_albums);
	}

	function getLatestTracks($poplinks){
		$uri =& JURI::getInstance();
		$db =&JFactory::getDBO();
		$params = $this->params;

		$db->setQuery("SELECT *,#__m15_albums.id AS i_id
		FROM #__m15_tracks
		LEFT JOIN #__m15_albums
		ON #__m15_tracks.track_album = #__m15_albums.id
		ORDER BY #__m15_tracks.id DESC
		LIMIT $poplinks");

		$q_latest_tracks = $db->loadObjectList();

		if (count($q_latest_tracks) == 0) {
			return '';
		}

		return $this->getTracksData($q_latest_tracks);

	}

	function getTracksInAlbum($ALBUM){

		$uri =& JURI::getInstance();
		$db =&JFactory::getDBO();
		$params = $this->params;

		// Get tracks..
		$db->setQuery("SELECT * FROM #__m15_tracks
		WHERE track_album = '{$ALBUM->id}'
		ORDER BY track_order") ;

		$q_tracks = $db->loadObjectList();
		$intNumber = 0;
		$count = 0;
		$aData = '';

		$mPlayer = getPlayer();

		foreach($q_tracks as $TRACKS) {
			$intNumber = $intNumber + 1;
			$altRow = '';

			if($params->alt_row == '1'){
				if ($intNumber % 2 == 0 )
				{
					$altRow = 'class = "alt_row"';
				}
			}

			if($this->SETTINGS->ajax == '0'){
				$link ='<input type="checkbox" name="track[]" value="'.$id.'" alt="'.JText::_(_msg_no_download).'" title="'.JText::_(_msg_no_download).'" DISABLED/>';
			}else{
				$link = '<img src="components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/no_single.png" alt="'.JText::_(_msg_no_download).'" title="'.JText::_(_msg_no_download).'" />';
			}
			// Is single track purchasable?
			if ($TRACKS->track_single || $TRACKS->freebie) {
				$link = $this->getLink($TRACKS->id);
			}

			$find     = array('{id}','{link}');
			$replace = array($TRACKS->id, $link);
			$single = str_replace($find ,$replace,
			file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'add_to_cart.html'));

			$tracklength;
			if($TRACKS->track_length != ""){
				$tracklength = "(".$TRACKS->track_length.")";
			}

			$find     = array('{id}','{flash_player}','{title}','{alt_row}','({duration})','{cost}','{add_to_cart}');
			$replace  = array($intNumber,'<!-- Begin Maian Player -->'.$mPlayer->getPlayer(genPreview($TRACKS->id), $TRACKS->id, $intNumber).'<!-- End Flash Player -->',
			cleanData($TRACKS->track_name), $altRow,
			$TRACKS->track_length,get_cur_symbol($TRACKS->track_cost, $this->SETTINGS ->paypal_currency),
			$single);
			$aData .= str_replace($find,$replace,
			file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'tracks.html'));

		}
		// Update hits..
		$db->setQuery("UPDATE #__m15_albums SET
		hits      = (hits+1)
		WHERE id  = '{$ALBUM->id}'
		LIMIT 1") ;
		$db->query();

		return $aData;
	}

	function getAlbumImage($ALBUM){
		if($this->SETTINGS->enlargeit == '1'){
			return  (strlen($ALBUM->image)>7 ? '<img id="enlargeit" src="'.$ALBUM->image.'" alt="'.JText::_(_msg_enlarge).'" title="'.JText::_(_msg_enlarge).'" onclick="enlarge(this);" longdesc="'.$ALBUM->image.'" /><span class="hover">'.JText::_(_msg_enlarge).'</span>' : '');
		}else{
			return  (strlen($ALBUM->image)>7 ? '<img src="'.$ALBUM->image.'" alt="'.JText::_($ALBUM->name).'" title="'.JText::_($ALBUM->name).'" longdesc="'.$ALBUM->image.'" />' : '');
		}
	}

	function getAddURL($ALBUM){
		$uri =& JURI::getInstance();
		if($this->SETTINGS->ajax == '0'){
			return JRoute::_( $uri->root().'index.php?option=com_maianmedia&task=add_legacy&section=cart&amp;album='.$ALBUM->id);
		}else{
			return 'javascript:updateCart(\'index.php?option=com_maianmedia&format=raw&section=cart&task=addToCart&album='.$ALBUM->id.'\', \'\', \'ploading\');';
		}
	}

	function getAddPhysicalURL($ALBUM){
		$uri =& JURI::getInstance();
		if($this->SETTINGS->ajax == '0' && trim($ALBUM->dimensions_height) != ""){
			return  JRoute::_( $uri->root().'index.php?option=com_maianmedia&physical=yes&task=add_legacy&section=cart&amp;album='.$ALBUM->id);
		}else if(trim($ALBUM->dimensions_height) != ""){
			return 'javascript:updateCart(\'index.php?option=com_maianmedia&format=raw&section=cart&task=addPhysical&album='.$ALBUM->id.'\', \'\', \'ploading\');';

		}

		return '';
	}

	function getPhysicalPrice($ALBUM){
		if(trim($ALBUM->dimensions_height) != ""){
			return ' <b>'.JText::_(_msg_publicalbum6).'</b> '.get_cur_symbol($ALBUM->dimensions_height,$this->SETTINGS->paypal_currency);
		}

		return '';
	}

	function getChildAlbums($ALBUM){
		$db =&JFactory::getDBO();
		// Children..
		// New in v1.2..
		$children = '';
		$links    = '';
		$db->setQuery("SELECT * FROM #__m15_albums
                             ".($ALBUM->parent > 0 ? '
                             WHERE parent = \'0\' AND is_album = "1"
                             AND child    = \''.$ALBUM->id.'\'
                             ' : '
                             WHERE parent = \''.$ALBUM->child.'\'
                             OR child     = \''.$ALBUM->child.'\'
                             AND id       != \''.$ALBUM->id.'\'
                             ')." ORDER BY artist,name
                             ") ;  
		$q_children = $db->loadObjectList();

		if (count($q_children)>0) {
			foreach($q_children as $CHILD){
				$links .= '<span class="child"><a href="'.JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$CHILD->id).'" title="'.cleanData($CHILD->artist).' - '.cleanData($CHILD->name).'">'.cleanData($CHILD->artist).' - '.cleanData($CHILD->name).'</a></span>';
			}
			$find     = array('{related_albums}','{children}');
			$replace  = array(JText::_( _msg_publicalbum14),$links);
			$children .= str_replace($find,$replace,
			file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'children.html'));

		}

		return $children;
	}

	function getAlbumDiscount($ALBUM){
		if($ALBUM->discount_type == '1'){
			return  ' <b>'.JText::_(_msg_publicalbum6).'</b> '.get_cur_symbol($ALBUM->discount,$this->SETTINGS->paypal_currency);
		}else{
			return ($ALBUM->discount>0 ? ' - '.str_replace("{amount}",$ALBUM->discount,JText::_( _msg_publicalbum13)) : '');
		}
	}

	function getAlbumsData($q_pop_albums){

		$aData = '';

		foreach($q_pop_albums as $P_ALBUMS){
			$link = '<div class="goto_left">
						<div onclick="location.href=\''.JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$P_ALBUMS->id).'\';" class="goto">
							<a title="'.cleanData($P_ALBUMS->name).'" href="'.JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$P_ALBUMS->id).'"></a>
						</div>
					</div>';

			$url = JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$P_ALBUMS->id);
			$name = empty($P_ALBUMS->name) ? '&nbsp;':cleanData($P_ALBUMS->name);
			$artist = empty($P_ALBUMS->artist) ? '&nbsp;':cleanData($P_ALBUMS->artist);

			$tpl = file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'li_tag.html');

			$find = array('{url}','{name}','{artist}','{MP3}');
			$replace = array($url, $name, $artist, $link);

			$aData .= str_replace($find, $replace, $tpl);
		}

		return $aData;
	}

	function getTracksData($q_pop_tracks){

		$tData = '';
		$count = 0;
		$mPlayer = getPlayer();

		foreach($q_pop_tracks as $P_TRACKS){
			$getflash = '<a href="http://www.adobe.com/go/getflashplayer" onclick="window.open(this);return false"><img src="media/icons/get_flash_player.gif" alt="Get Adobe Flash player" title="Get Adobe Flash player" /></a>';
			$mp3 = '<!-- Begin Maian Player -->'.$mPlayer->getPlayer(genPreview($TRACKS->id), $TRACKS->id, $intNumber).'<!-- End Flash Player -->';

			$url = JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$P_TRACKS->i_id);
			$name = empty($P_TRACKS->track_name) ? '&nbsp;':cleanData($P_TRACKS->track_name);
			$artist = empty($P_TRACKS->artist) ? '&nbsp;':cleanData($P_TRACKS->artist);

			$find = array('{url}','{name}','{artist}','{MP3}');
			$replace = array($url, $name, $artist, $mp3);
			$tpl = file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'li_tag.html');

			$tData .= str_replace($find, $replace, $tpl);
		}

		return $tData;
	}

	function getSingleTrackData($tracks){
		$params = $this->params;

		$aData = '';
		$intNumber = 0;

		$mPlayer = getPlayer();
		foreach($tracks as $TRACKS) {
			$intNumber = $intNumber + 1;
			$altRow = '';

			$this->db->setQuery('SELECT * FROM #__m15_albums
			WHERE id = \''.$TRACKS->track_album.'\' Limit 1') ;
			$ALBUM= $this->db->loadObject();

			if(isset($params->alt_row)&&$params->alt_row == '1'){
				if ($intNumber % 2 == 0 )
				{
					if(isset($params->color) && $params->color != 'none'){
						$altRow = 'style="background-color:'.$params->color.'"';
					}
				}
			}

			$link = '<img src="components/com_maianmedia/media/'.getTplPath($this->skin_name, 'img').'/cart/no_single.png" alt="'.JText::_(_msg_no_download).'" title="'.JText::_(_msg_no_download).'" />';
			// Is single track purchasable?

			$link = $this->getLink($TRACKS->id);

			$find     = array('{id}','{link}');
			$replace = array($TRACKS->id, $link);
			$single = str_replace($find ,$replace,
			file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'add_to_cart.html'));

			$tracklength;
			if($TRACKS->track_length != ""){
				$tracklength = "(".$TRACKS->track_length.")";
			}

			$album_link = '<a href="'.JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$TRACKS->track_album).'">'.$ALBUM->name.'</a>';

			$find     = array('{flash_player}','{title}','{alt_row}','({duration})','{cost}','{add_to_cart}');
			$replace  = array('<!-- Begin Maian Player -->'.$mPlayer->getPlayer(genPreview($TRACKS->id), $TRACKS->id, $intNumber).'<!-- End Flash Player -->',
			cleanData($TRACKS->track_name), $altRow,
			$TRACKS->track_length,$TRACKS->track_cost,
			$single);
			$aData .= str_replace($find,$replace,
			file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'tracks.html'));

		}

		return $aData;
	}

	function getSingleAlbumData($id,$track=false) {
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

	function getLink($id)
	{
		$track_id = intval($id);
		$db = &JFactory::getDBO();
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
					$link .= '<span id="update_'.$track_id.'"><img id="update_'.$track_id.'" onclick="updateCart(\''.$uri->root().'index.php?option=com_maianmedia&amp;format=raw&amp;section=cart&amp;task=removeTrack&amp;track='.$track_id.'&amp;code='.MaianController::getEntryCode($track_id).'\', \'\', \'update_'.$track_id.'\');" src="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/removeFromCart.png" /></span>';
				}else{
					$link .= '<span id="update_'.$track_id.'"><img onclick="updateCart(\''.$uri->root().'index.php?option=com_maianmedia&amp;format=raw&amp;section=cart&amp;task=addToCart&amp;track='.$track_id.'\', \'\', \'update_'.$track_id.'\');" src="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/addToCart.png" /></span>';
				}

			}else{
				if($track->freebie =='1'){
					$href = $uri->root()."index.php?option=com_maianmedia&amp;section=download&amp;task=freebie&amp;track=$track_id&amp;track_album=$track_album";
					$link .= '<a href="'.$href.'" title="'.JText::_(_msg_free_download).'"><img src="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/free_download.png" alt="'.JText::_(_msg_free_download).'" title="'.JText::_(_msg_free_download).'" /></a>';
				}
				if($track->track_single =='1'){
					$link .= '<span id="update_'.$track_id.'"><img id="update_'.$track_id.'" onclick="updateCart(\''.$uri->root().'index.php?option=com_maianmedia&amp;format=raw&amp;section=cart&amp;task=addToCart&amp;track='.$track_id.'\', \'\', \'update_'.$track_id.'\');" src="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/addToCart.png" /></span>';
				}else{
					$link .= '<img src="components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/no_single.png" alt="'.JText::_(_msg_no_download).'" title="'.JText::_(_msg_no_download).'" />';
				}

			}
		}else{
			JHTML::_('behavior.modal', 'a.modal-button');

			$href = $uri->root()."index.php?option=com_maianmedia&amp;section=download&amp;task=freebie&amp;track=$track_id&amp;track_album=$track_album";
			$link.='<a href="'.$href.'" title="'.JText::_(_msg_free_download).'"><img src="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/free_download.png" alt="'.JText::_(_msg_free_download).'" title="'.JText::_(_msg_free_download).'" /></a>';
		}

		return $link;

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

	function isAdded($id)
	{

		if(isset($_SESSION['album_id'])){

			if(in_array($id, $_SESSION['album_id'])){
				return '<div id="album_">'._msg_albums23.'</div>';
			}
		}
	}

	function getCatData($cats){
		$uri =& JURI::getInstance();
		$mData = '';
		foreach($cats as $SINGLE){

			$images_dimensions = '';
			$image_link = '';
			if($SINGLE->image != "" && $SINGLE->image !="http://"){
				$image_link = $SINGLE->image;
				$images_dimensions = 'height=75px width=75px';
			}

			$find     = array('{url}','{title}','{description}','{image}');
			$replace  = array(JRoute::_('index.php?option=com_maianmedia&view=music&amp;cat='.$SINGLE->id),$SINGLE->title,$SINGLE->description, $image_link);
			$mData .= str_replace($find,$replace,
			file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'cat_data.html'));
		}
		return $mData;
	}

	function displayCartIcon($items, $total){
		$uri =& JURI::getInstance();

		return '<span id="for_dummies">'.JText::_(_msg_cart7).'</span>
				<img src="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/icons/shopping_cart.png" /> 
					'.JText::_(_msg_public_header2).'&nbsp;
					<font id="cart_count">'.$items.'</font>&nbsp;(<i id="cart_total">'.$total.'</i>)';

	}

	function getOrder($param){

		$sql = "";
		switch ($param) {
			case 'name-asc'		:    $sql = " ORDER BY name, artist ASC";      break;
			case 'name-desc'	:     $sql = " ORDER BY name, artist DESC ";           break;
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
}
?>