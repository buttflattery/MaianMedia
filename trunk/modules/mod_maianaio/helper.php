<?php

/**
 * Helper class for Maian All-In-One! module
 *
 * @package    Maian.Software
 * @subpackage Modules
 * @link http://www.maianscriptworld.co.uk
 * @link http://www.aretimes.com
 * @license        GNU/GPL, see LICENSE.php
 */
class modMaianAioHelper
{
	var $table_top;
	var $most_pop;
	var $table_bottom;

	function cleanData($data) {
		return (get_magic_quotes_gpc() ? stripslashes($data) : $data);
	}
	/**
	 * Dispalys the message
	 *
	 * @param array $params An object containing the module parameters
	 * @access public
	 */
	function getOutput( $params )
	{
		include_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'inc'.DS.'functions.php');

		$count = intval( $params->get('count', 10) );
		$moduletype = intval( $params->get('moduletype', 2) );
		$width_thumbcb = intval( $params->get('width_thumbcb', 25) );
		$height_thumbcb = intval( $params->get('height_thumbcb', 25) );
		$orientation = intval( $params->get('orientation', 1) );
		$concat = intval( $params->get('concat', 10) );
		$display_pic = intval( $params->get('display_pic', 0) );
		$show_images = intval( $params->get('show_images', 1) );
		$dots = intval( $params->get('dots', 1) );
		//$user = mosGetParam( $_REQUEST, 'user', 0 );
		$user  = JRequest::getVar('user');
		$alt_row = $params->get('alt_rows', '');
		$itemId = intval(cleanData(JRequest::getVar('Itemid')));
		$this->table_top = '';
		$this->table_bottom = '';

		$database =& JFactory::getDBO();
		$uri =& JURI::getInstance();

		if($orientation == 0){
			$this->table_top = '<table><td>&nbsp;</td>';
			$this->table_bottom = '</table>';
		}

		if($dots == 0){
			$entry_suffix = '-dots';
		}else{
			$entry_suffix = '';
		}

		$style_height = ($height_thumbcb/2) + 2 ;

		if($orientation == '1'){
			$styleInfo = ' style="padding: 10px 0 '.$style_height.'px; height:'.($height_thumbcb-($style_height/3)).'px;';
		}else{
			$styleInfo = ' style="padding: 10px 0';
		}

		if(empty($alt_row) == false){
			$styleInfo = $styleInfo.'background: #'.$alt_row.';';
		}

		$styleInfo = $styleInfo.'"';

		switch ($moduletype) {

			case '0':
				$database->setQuery("SELECT * FROM #__m15_albums WHERE status ='1'
                               ORDER BY downloads DESC
                               LIMIT $count ");
					
				$q_pop_albums = $database->loadObjectList();
				$i = 0;
				if (count($q_pop_albums)>0) {

					$this->most_pop = '';

					foreach($q_pop_albums as $P_ALBUMS){

						if($P_ALBUMS->image != '' && $P_ALBUMS->image != 'http://' && $display_pic == 0){
							$list_image = '<img class="mm_image" width="'.$width_thumbcb.'" height="'.$height_thumbcb.'" src="'.$P_ALBUMS->image.'" alt="'.$P_ALBUMS->name.'" border="1" align="left"/>';
						}else{
							$list_image = '<img width="'.$width_thumbcb.'" height="'.$height_thumbcb.'" src="'.$uri->root().'/components/com_maianmedia/images/bullet_static.png" alt="'.$P_ALBUMS->name.'" border="0" align="left"/>';
						}

						if($show_images == 1){
							$list_image = '';
						}


						if ($i % 2 == 0){
							$alt = 'class="maian_odd'.$entry_suffix.'"'.$styleInfo;
						}else{
							$alt = 'class="maian_even'.$entry_suffix.'"'.$styleInfo;
						}

						if($orientation == 1){
							$this->most_pop .= '<div '.$alt.'>
      			                  '.$list_image.'<a href="'.JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$P_ALBUMS->id).'&Itemid='.$itemId.'" title="'.$P_ALBUMS->name.'">'.$P_ALBUMS->name.'</a><br />
      			                  <span class="mm_artist">'.$P_ALBUMS->artist.'</span>
      			                  </div>';
						}else{
							$this->most_pop .= '<td '.$alt.'>
      			                  '.$list_image.'<a href="'.JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$P_ALBUMS->id).'&Itemid='.$itemId.'" title="'.$P_ALBUMS->name.'">'.$P_ALBUMS->name.'</a><br />
      			                  <span class="mm_artist">'.$P_ALBUMS->artist.'</span>
      			                  </td>';
						}

						$i = $i + 1;
					}
				}
				break;

			case '1':
				$database->setQuery("SELECT *,#__m15_albums.id AS i_id
                               FROM #__m15_tracks
                               LEFT JOIN #__m15_albums
                               ON #__m15_tracks.track_album = #__m15_albums.id
                               ORDER BY #__m15_tracks.downloads DESC
                               LIMIT $count
                               ");
				$q_pop_tracks = $database->loadObjectList();
				$i = 0;
				if (count($q_pop_tracks)>0) {

					foreach($q_pop_tracks as $P_TRACKS){

						if($P_TRACKS->image != '' && $P_TRACKS->image != 'http://' && $display_pic == 0){
							$list_image = ' <img class="mm_image" width="'.$width_thumbcb.'" height="'.$height_thumbcb.'" src="'.$P_TRACKS->image.'" alt="'.$P_TRACKS->track_name.'" border="1" align="left"/>';
						}else{
							$list_image = ' <img width="'.$width_thumbcb.'" height="'.$height_thumbcb.'" src="'.$uri->root().'/components/com_maianmedia/images/bullet_static.png" alt="'.$P_TRACKS->track_name.'" border="0" align="left"/>';
						}

						if($show_images == 1){
							$list_image = '';
						}

						if ($i % 2 == 0){
							$alt = 'class="maian_odd'.$entry_suffix.'"'.$styleInfo;
						}else{
							$alt = 'class="maian_even'.$entry_suffix.'"'.$styleInfo;
						}

						if($orientation == 1){
							$this->most_pop .= '<div '.$alt.'>
      			                  '.$list_image.'<a href="'.JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$P_TRACKS->i_id).'&Itemid='.$itemId.'" title="'.cleanData($P_TRACKS->track_name).'">'.cleanData($P_TRACKS->track_name).'</a><br />
      			                  <span class="mm_artist">'.cleanData($P_TRACKS->artist).'</span>
      			                  </div>';
						}else{
							$this->most_pop .= '<td '.$alt.'>
      			                  '.$list_image.'<a href="'.JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$P_TRACKS->i_id).'&Itemid='.$itemId.'" title="'.cleanData($P_TRACKS->track_name).'">'.cleanData($P_TRACKS->track_name).'</a><br />
      			                  <span class="mm_artist">'.cleanData($P_TRACKS->artist).'</span>
      			                  </td>';
						}

						$i = $i + 1;
					}
				}
				break;
			case '2':
					
				$artist = $params->get('artist_name', '');
				$database->setQuery("SELECT * FROM #__m15_albums WHERE artist ='$artist'
                               ORDER BY downloads DESC
                               LIMIT $count ");
					
				$q_pop_albums = $database->loadObjectList();
				$i = 0;
				if (count($q_pop_albums)>0) {

					$this->most_pop = '';

					foreach($q_pop_albums as $P_ALBUMS){

						if($P_ALBUMS->image != '' && $P_ALBUMS->image != 'http://' && $display_pic == 0){
							$list_image = '<img class="mm_image" width="'.$width_thumbcb.'" height="'.$height_thumbcb.'" src="'.$P_ALBUMS->image.'" alt="'.$P_ALBUMS->name.'" border="1" align="left"/>';
						}else{
							$list_image = '<img width="'.$width_thumbcb.'" height="'.$height_thumbcb.'" src="'.$uri->root().'/components/com_maianmedia/images/bullet_static.png" alt="'.$P_ALBUMS->name.'" border="0" align="left"/>';
						}

						if($show_images == 1){
							$list_image = '';
						}


						if ($i % 2 == 0){
							$alt = 'class="maian_odd'.$entry_suffix.'"'.$styleInfo;
						}else{
							$alt = 'class="maian_even'.$entry_suffix.'"'.$styleInfo;
						}

						if($orientation == 1){
							$this->most_pop .= '<div '.$alt.'>
      			                  '.$list_image.'<a href="'.JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$P_ALBUMS->id).'&Itemid='.$itemId.'" title="'.$P_ALBUMS->name.'">'.$P_ALBUMS->name.'</a><br />
      			                  <span class="mm_artist">'.$P_ALBUMS->artist.'</span>
      			                  </div>';
						}else{
							$this->most_pop .= '<td '.$alt.'>
      			                  '.$list_image.'<a href="'.JRoute::_('index.php?option=com_maianmedia&view=album&amp;album='.$P_ALBUMS->id).'&Itemid='.$itemId.'" title="'.$P_ALBUMS->name.'">'.$P_ALBUMS->name.'</a><br />
      			                  <span class="mm_artist">'.$P_ALBUMS->artist.'</span>
      			                  </td>';
						}

						$i = $i + 1;
					}
				}
				break;
		}


	}

}
?>