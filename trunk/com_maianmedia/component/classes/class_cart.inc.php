<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
/**
 *
 *
 * @package    Maian Media
 * @subpackage Maian Cart
 * @link http://www.aretimes.com
 * @link http://www.maianscriptworld.com
 * @license		GNU/GPL
 */
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

Script: Maian Music v1.2
Written by: David Ian Bennett
E-Mail: support@maianscriptworld.co.uk
Website: http://www.maianscriptworld.co.uk

++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

This File: class_cart.inc.php
Description: Shopping Cart Class

++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

defined('_JEXEC') or die('Restricted access');

include_once(JPATH_LIBRARIES.DS.'joomla'.DS.'factory.php');
include_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'classes'.DS.'class_generic.inc.php');

class mm_Cart extends genericOptions {

	function __construct(){
		parent::__construct();
	}

	// Adds items to cart..
	function addToCart($full_album=false,$album,$track_id,$lang, $physical=false) {
		$db  =& JFactory::getDBO();

		if ($full_album) {

			$db->setQuery("SELECT * FROM #__m15_albums
			WHERE id = '{$album}'
			LIMIT 1
                            ");
			$ALBUM = $db->loadObject();
		} else {
			$db->setQuery("SELECT * FROM #__m15_tracks
			WHERE id = '{$track_id}'
			LIMIT 1");
			$TRACK = $db->loadObject();
		}

		// Assign session vars if cart is empty..
		if (!isset($_SESSION['cart_count']) || (isset($_SESSION['cart_count']) && $_SESSION['cart_count']==0)) {
			// Clear vars if present..
			if (isset($_SESSION['cart_count'])) {
				$this->clearCart();
			}

			$_SESSION['cart_count']  = '0';
			$_SESSION['album_name']  = array();
			$_SESSION['album_id']    = array();
			$_SESSION['album_cost']  = array();
			$_SESSION['track_name']  = array();
			$_SESSION['track_id']    = array();
			$_SESSION['track_cost']  = array();
			$_SESSION['track_code']  = array();
			$_SESSION['physical_id']    = array();
		}

		// Add data to session vars..
		$_SESSION['cart_count']    = $_SESSION['cart_count']+1;
		if($physical){
			$_SESSION['album_name'][]  = ($full_album ? $this->strip_slashes($ALBUM->artist.' - '.$ALBUM->name).' - '.($ALBUM->dimensions_height>0 ? _msg_physical : '') : '');
			$_SESSION['physical_id'][]    = ($full_album ? $ALBUM->id : '0');
			$_SESSION['album_id'][]    = '0';
		}else{
			$_SESSION['album_id'][]    = ($full_album ? $ALBUM->id : '0');
			$_SESSION['physical_id'][]    = '0';

			if(isset($ALBUM) && $ALBUM->discount_type != '1'){
				$_SESSION['album_name'][]  = ($full_album ? $this->strip_slashes($ALBUM->artist.' - '.$ALBUM->name).($ALBUM->discount>0 ? ' (<b>'.str_replace("{discount}",$ALBUM->discount,$lang).'</b>)' : '') : '');
			}else{
				$_SESSION['album_name'][]  = ($full_album ? $this->strip_slashes($ALBUM->artist.' - '.$ALBUM->name).($ALBUM->discount>0 ? '' : '') : '');
			}


		}

		$_SESSION['album_cost'][]  = ($full_album ? $this->getFullAlbumCost($ALBUM->id,$ALBUM->discount, $physical) : '0');
		$_SESSION['track_name'][]  = ($full_album ? '' : $this->strip_slashes($TRACK->track_name));
		$_SESSION['track_id'][]    = ($full_album ? '0' : $TRACK->id);
		$_SESSION['track_cost'][]  = ($full_album ? '0' : number_format($TRACK->track_cost,2));
		$_SESSION['entry_code'][]  = $this->random_data(50);
	}

	// Delete cart item..
	function deleteCartItem($item) {
		$db  =& JFactory::getDBO();
		// Loop through cart...
		for ($i=0; $i<count($_SESSION['entry_code']); $i++) {
			if ($item==$_SESSION['entry_code'][$i]) {
				$_SESSION['album_name'][$i]  = '0';
				$_SESSION['album_id'][$i]    = '0';
				$_SESSION['album_cost'][$i]  = '0';
				$_SESSION['track_name'][$i]  = '0';
				$_SESSION['track_id'][$i]    = '0';
				$_SESSION['track_cost'][$i]  = '0';
				$_SESSION['entry_code'][$i]  = '0';
				$_SESSION['physical_id'][$i]  = '0';
				$_SESSION['cart_count']      = $_SESSION['cart_count']-1;
			}
		}

		// If cart is now empty, clear vars..
		if ($_SESSION['cart_count']==0) {
			$this->clearCart();
		}
	}

	// Clears all cart items..
	function clearCart() {

		if(isset($_SESSION['cart_count']))
		unset($_SESSION['cart_count']);

		if(isset($_SESSION['album_name']))
		unset($_SESSION['album_name']);
			
		if(isset($_SESSION['album_id']))
		unset($_SESSION['album_id']);
			
		if(isset($_SESSION['album_cost']))
		unset($_SESSION['album_cost']);

		if(isset($_SESSION['track_name']))
		unset($_SESSION['track_name']);
			
		if(isset($_SESSION['track_id']))
		unset($_SESSION['track_id']);

		if(isset($_SESSION['track_cost']))
		unset($_SESSION['track_cost']);

		if(isset($_SESSION['track_code']))
		unset($_SESSION['track_code']);

		if(isset($_SESSION['entry_code']))
		unset($_SESSION['entry_code']);

		if(isset($_SESSION['physical_id']))
		unset($_SESSION['physical_id']);
			
	}

	// Gets cost of cart...
	function cartTotal() {
		$db  =& JFactory::getDBO();
		$cost = '0.00';

		if (isset($_SESSION['cart_count']) && $_SESSION['cart_count']>0) {
			for ($i=0; $i<count($_SESSION['album_cost']); $i++) {
				if ($_SESSION['album_cost'][$i]>0 || $_SESSION['track_cost'][$i]>0) {
					$item = ($_SESSION['album_cost'][$i]>0 ? $_SESSION['album_cost'][$i] : $_SESSION['track_cost'][$i]);
					$cost = $cost+$item;
				}
			}
		}

		return number_format($cost,2);
	}

	// Gets count of items in cart..
	function cartCount() {
		$db  =& JFactory::getDBO();
		return (isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : '0');
	}

	// Get full album cost...totals up all tracks for an album..
	function getFullAlbumCost($id,$discount,$physical=false) {

		$db  =& JFactory::getDBO();
		$db->setQuery("SELECT SUM(track_cost) AS t_cost
		FROM #__m15_tracks
		WHERE track_album = '{$id}'");

		$SUM = $db->loadObject();

		$db  =& JFactory::getDBO();
		$db->setQuery("SELECT *
		FROM #__m15_albums
		WHERE id = '{$id}'");

		$album = $db->loadObject();

		if($physical){
			return number_format($album->dimensions_height,2);
		}

		if($album->discount_type == '1'){
			return number_format($album->discount,2);
		}

		if ($discount>0) {
			$discount_price = $SUM->t_cost * $discount / 100;
		}

		return ($discount>0 ? number_format($SUM->t_cost-$discount_price,2) : number_format($SUM->t_cost,2));
	}

	// Get cart data..
	function getCartData($code) {

		$db  =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_paypal
		WHERE cart_code = '{$code}'
		ORDER BY id DESC
		LIMIT 1 ");
		return $db->loadObject();
	}

	// Get track or album data..
	function getTrackOrAlbumData($id,$type) {
		$db  =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM "."#__m15_".($type=='album' ? 'albums' : 'tracks')."
		WHERE id = '{$id}'
		LIMIT 1");

		return $db->loadObject();
	}

	// Get download file..
	function getDownloadFile($code) {
		$db  =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_purchases
		WHERE download_code = '{$code}'
		LIMIT 1
                        ");
		return $db->loadObject();
	}

	// Get page download code for track..
	function getDownloadPageCode($code) {
		$db  =& JFactory::getDBO();
		$query = $db->setQuery("SELECT * FROM #__m15_purchases
		WHERE download_code = '{$code}'
		LIMIT 1
                        ");
		$code = $db->loadObject();
		$db->setQuery("SELECT * FROM #__m15_purchases
		WHERE item_id  = '{$code->item_id}'
		AND cart_code  = '{$code->cart_code}'
		AND track_id   = '0'
		LIMIT 1
                         ");	 
		$row = $db->loadObject();

		return $row->download_code;
	}

	// Update file download count..
	function updateFileDownloadCount($id,$type='') {
		$db  =& JFactory::getDBO();
		if ($type=='') {
			$db->setQuery("UPDATE #__m15_purchases SET
			downloads  = (downloads+1)
			WHERE id   = '{$id}'
			LIMIT 1
                 ");	$db->query();
		} else {
			$db->setQuery("UPDATE #__m15_".($type=='album' ? 'albums' : 'tracks')." SET
			downloads  = (downloads+1)
			WHERE id   = '{$id}'
			LIMIT 1
                 ");                                                 	
			$db->query();
		}
	}

	// Get download data..
	function getDownloadData($code,$check=false) {
		$db  =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_paypal
	WHERE download_code  = '{$code}'
	AND active_cart      = '1'
	LIMIT 1
                        ");
		$query = $db->loadObject();
		if ($check) {
			return (count($query)>0 ? true : false);
		} else {
			return $query;
		}
	}

	// Album downloads..
	function albumDownloads($code,$check=false) {
		$db  =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_purchases
	WHERE cart_code            = '{$code}'
	AND SUBSTRING(item_id,1,1) = 'a'
                        ");
		$query = $db->loadObjectList();
		if ($check) {
			return (count($query)>0 ? true : false);
		} else {
			$single = $db->loadObject();
			return $single;
		}
	}

	// Track downloads..
	function trackDownloads($code,$check=false) {
		$db  =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_purchases
	WHERE cart_code            = '{$code}'
	AND SUBSTRING(item_id,1,1) = 't'
                        ");
		$query = $db->loadObjectList();
		if ($check) {
			return (count($query)>0 ? true : false);
		} else {
			$single = $db->loadObject();
			return $single;
		}
	}

	// Fetch mp3 paths for zip file..
	function getMP3PathForZipFile($id,$type,$path=false) {
		$album = array();
		$db  =& JFactory::getDBO();

		switch ($type) {
			case 'album':

				$db->setQuery("SELECT * FROM #__m15_tracks
				WHERE track_album = '{$id}'
				ORDER BY track_order
                            ");
				$q_album = $db->loadObjectList();
				foreach($q_album as $ALBUM){
					if(!$path){
						$album[] = $ALBUM->mp3_path;
					}else{
						$album[] = $path.'/'.$ALBUM->mp3_path;
					}

				}
				return $album;
				break;
			case 'track':
				$q_track = $db->setQuery("SELECT * FROM #__m15_tracks
				WHERE id = '{$id}'
				LIMIT 1
                            ");	
				$TRACK = $db->loadObject();
				if(!$path){
					return $TRACK->mp3_path;
				}else{
					return $path.'/'.$TRACK->mp3_path;
				}
				break;
		}
	}

	function create_zip($files = array(),$destination = '',$overwrite = false, $mp3_path) {
		//if the zip file already exists and overwrite is false, return false
		require_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'classes'.DS.'class_zip.inc.php');

		return get_zip($files, $destination, $overwrite, $mp3_path);

	}

	// Add cart data to database..
	function addCartToDatabase($id, $total, $inv) {

		$db  =& JFactory::getDBO();

		if($total !='0.00'){
			$db->setQuery("INSERT INTO #__m15_paypal (
			   invoice,
               pay_date,
               total,
               visits,
               download_code,
               cart_code,
               purchases,
               total_tracks,
               total_albums
               ) VALUES (
               '".$inv."',
               '".date("Y-m-d")."',
               '".$total."',
               '0',
               '".$this->random_data(50)."',
			'{$id}',
			'".(!empty($_SESSION['album_id']) ? implode(",",$_SESSION['album_id']) : '0')."||".(!empty($_SESSION['track_id']) ? implode(",",$_SESSION['track_id']) : '0')."||".(!empty($_SESSION['physical_id']) ? implode(",",$_SESSION['physical_id']) : '0')."',
               '".$this->returnArrayCount($_SESSION['track_id'])."',
               '".$this->returnArrayCount($_SESSION['album_id'])."'
               )");
			$db->query();
		}//end if
	}

	// Returns count of items in each array that are greater than 0..
	// ie: 0,1,2,0 = 2
	function returnArrayCount($array) {
		$count = 0;
		for ($i=0; $i<count($array); $i++) {
			if ($array[$i]>0) {
				$count++;
			}
		}
		return $count;
	}

	// Generate cart purchases for download..
	// We only need do this if the transation was valid..
	function generatePurchasesForDownload($cart) {
		$db  =& JFactory::getDBO();
		// Database information for purchases..
		$data = $this->getCartData($cart);
		// Explode purchases field..then explode again for album and track data..
		$field   = explode("||", $data->purchases);
		$albums  = explode(",", $field[0]);
		$tracks  = explode(",", $field[1]);
		$physical  = explode(",", $field[2]);
		// Add album data..
		for ($i=0; $i<count($albums); $i++) {
			if ($albums[$i]!='0') {
				$random = $this->random_data(50);
				$db->setQuery("INSERT INTO #__m15_purchases (
				cart_code,
				item_id,
				download_code,
				downloads,
				track_id
				) VALUES (
				'{$cart}',
				'a".$albums[$i]."',
				'{$random}',
				'0',
				'0'
				)");
				$db->query();
				// Update download/purchase count for album..
				$this->updateFileDownloadCount($album[$i],'albums');
				// Add download information for each track in album..
				$db->setQuery("SELECT * FROM #__m15_tracks
				WHERE track_album = '{$albums[$i]}'
				ORDER BY track_order");	  

				$q_tracks = $db->loadObjectList();
				foreach($q_tracks as $TRACKS){
					$db->setQuery("INSERT INTO #__m15_purchases (
					cart_code,
					item_id,
					download_code,
					downloads,
					track_id
					) VALUES (
					'{$cart}',
					'a".$albums[$i]."',
                     '".$this->random_data(50)."',
					'0',
					'{$TRACKS->id}'
					)");	$db->query();

					// Update download/purchase count for track..
					$this->updateFileDownloadCount($TRACKS->id,'tracks');
				}
			}
		}

		// Add track data..
		for ($i=0; $i<count($tracks); $i++) {
			if ($tracks[$i]!='0') {
				$db->setQuery("INSERT INTO #__m15_purchases (
				cart_code,
				item_id,
				download_code,
				downloads,
				track_id
				) VALUES (
				'{$cart}',
				't".$tracks[$i]."',
                   '".$this->random_data(50)."',
                   '0',
                   '0'
                   )");
				$db->query();
				// Update download/purchase count for track..
				$this->updateFileDownloadCount($tracks[$i],'tracks');
			}
		}

		// Add physical data just to get count for email won't be able to download..
		for ($i=0; $i<count($physical); $i++) {
			if ($physical[$i]!='0') {
				$db->setQuery("INSERT INTO #__m15_purchases (
				cart_code,
				item_id,
				download_code,
				downloads,
				track_id
				) VALUES (
				'{$cart}',
				'p".$physical[$i]."',
                   '".$this->random_data(50)."',
                   '0',
                   '0'
                   )");
				$db->query();
				// Update download/purchase count for track..
				//$this->updateFileDownloadCount($tracks[$i],'tracks');
			}
		}
	}

	// Update download page visits..
	function updateDownloadPageVisits($code) {	$db  =& JFactory::getDBO();
	$db->setQuery("UPDATE #__m15_paypal SET
	visits               = (visits+1)
	WHERE download_code  = '{$code}'
	LIMIT 1
               ");
	}

	// Update item downloads..
	function updateItemDownloadCount($code) {	$db  =& JFactory::getDBO();
	$db->setQuery("UPDATE #__m15_purchases SET
	downloads            = (downloads+1)
	WHERE download_code  = '{$code}'
	LIMIT 1
               ");	$db->query();
	}

	function purchasedPhysical($type,$code,$lang) {
		$db  =& JFactory::getDBO();
		$string = '';
		$count  = 0;

		$db->setQuery("SELECT * FROM #__m15_purchases
						WHERE cart_code            = '{$code}'
						AND SUBSTRING(item_id,1,1) = '".($type=='albums' ? 'p' : 't')."'
                        ".($type=='albums' ? 'AND track_id = \'0\'' : '')."
                        ");
		$query =  $db->loadObjectList();
		switch($type) {
			case 'albums':
				if (count($query)>0) {
					foreach($query as $DATA ) {
						$db->setQuery("SELECT * FROM #__m15_albums
                                WHERE id = '".substr($DATA->item_id,1)."'
                                LIMIT 1");
						$ALBUM = $db->loadObject();
						if($ALBUM->physical != ""){
							$string .= '['.++$count.'] '.$this->strip_slashes($ALBUM->name).' - '.$this->strip_slashes($ALBUM->artist).' '._msg_physical.$this->define_newline();
						}
					}
				} else {
					$string = 'N/A';
				}

				break;


		}

		return trim($string);
	}

	// Get purchased albums/tracks and return as string for e-mail..
	function purchasedItems($type,$code,$lang) {
		$db  =& JFactory::getDBO();
		$string = '';
		$count  = 0;

		$db->setQuery("SELECT * FROM #__m15_purchases
	WHERE cart_code            = '{$code}'
	AND SUBSTRING(item_id,1,1) = '".($type=='albums' ? 'a' : 't')."'
                        ".($type=='albums' ? 'AND track_id = \'0\'' : '')."
                        ");
		$query =  $db->loadObjectList();
		switch($type) {
			case 'albums':
				if (count($query)>0) {
					foreach($query as $DATA ) {
						$db->setQuery("SELECT * FROM #__m15_albums
                                WHERE id = '".substr($DATA->item_id,1)."'
                                LIMIT 1");
						$ALBUM = $db->loadObject();
						$string .= '['.++$count.'] '.$this->strip_slashes($ALBUM->name).' - '.$this->strip_slashes($ALBUM->artist).$this->define_newline();
					}
				} else {
					$string = 'N/A';
				}

				break;

			case 'tracks':

				if (count($query)>0) {		foreach($query as $DATA){
					$q_track = $db->setQuery("SELECT * FROM #__m15_tracks
                                WHERE id = '".substr($DATA->item_id,1)."'
                                LIMIT 1");
					$TRACK = $db->loadObject();
					$q_album = $db->setQuery("SELECT * FROM #__m15_albums
				WHERE id = '{$TRACK->track_album}'
				LIMIT 1");
					$ALBUM = $db->loadObject();

					$string .= '['.++$count.'] '.$this->strip_slashes($TRACK->track_name).$this->define_newline();
					$string .= $lang.' '.$this->strip_slashes($ALBUM->name).' - '.$this->strip_slashes($ALBUM->artist).$this->define_newline().$this->define_newline();
				}
				} else {
					$string = 'N/A';
				}

				break;
		}

		return trim($string);
	}

	// Update database after valid paypal response..
	function updateCartDatabase($cart,$DATA, $code) {
		$db  =& JFactory::getDBO();
		$user =& JFactory::getUser();

		// Prepare data for safe import..
		$DATA     = $this->safe_import_callback($DATA);
		$address  = '';
		// Address data..
		if ($DATA['address_street']) {
			$address = $DATA['address_street'].$this->define_newline().$DATA['address_city'].$this->define_newline().$DATA['address_state'].$this->define_newline().$DATA['address_zip'].$this->define_newline().$DATA['address_country'];
		}
		// Update..
		$db->setQuery("UPDATE #__m15_paypal SET
		first_name       = '{$DATA['first_name']}',
		last_name        = '{$DATA['last_name']}',
		address          = '{$address}',
		email            = '{$DATA['payer_email']}',
		memo             = '".(isset($DATA['memo']) ? $DATA['memo'] : '')."',
		payment_status   = '{$DATA['payment_status']}',
		pending_reason   = '".(isset($DATA['pending_reason']) ? $DATA['pending_reason'] : '')."',
		gross            = '{$DATA['mc_gross']}',
		fee              = '{$DATA['mc_fee']}',
		txn_id           = '{$DATA['txn_id']}',
		invoice          = '{$DATA['invoice']}',
		active_cart      = '1'
		WHERE cart_code  = '{$cart}' and download_code = '{$code}'
		LIMIT 1 ");	

		$db->query();

		if(!$user->guest){
			$db->setQuery("UPDATE #__m15_paypal SET
			jos_id		= '{$user->id}'
			WHERE cart_code  = '{$cart}' and download_code = '{$code}'
			LIMIT 1");
			$db->query();
		}

	}

	// Get download size of album or track...
	function downloadSize($id,$type,$settings=array()) {
		$db  =& JFactory::getDBO();
		$bytes = 0;

		switch ($type) {
			case 'track':
				$db->setQuery("SELECT * FROM #__m15_tracks
			WHERE id = '{$id}' LIMIT 1");
				$TRACK = $db->loadObject();

				if (file_exists($settings->mp3_path.'/'.$TRACK->mp3_path)) {
					$bytes = filesize($settings->mp3_path.'/'.$TRACK->mp3_path);
				}

				break;

			case 'album':

				$db->setQuery("SELECT * FROM #__m15_tracks
								WHERE track_album = '{$id}'");
				$q_track = $db->loadObjectList();

				foreach($q_track as $TRACK){
					if (file_exists($settings->mp3_path.'/'.$TRACK->mp3_path)) {
						$bytes = $bytes + filesize($settings->mp3_path.'/'.$TRACK->mp3_path);
					}
				}

				break;
		}

		return $bytes;
	}

	// Reset downloads..
	function resetCartDownloads($code) {
		$db  =& JFactory::getDBO();
		$db->setQuery("UPDATE #__m15_purchases SET
		downloads        = '0'
		WHERE cart_code  = '{$code}'
               ") ;	
		$db->query();
		$db->setQuery("UPDATE #__m15_paypal SET
		visits           = '0'
		WHERE cart_code  = '{$code}'
               ");
		$db->query();
	}
	function checkTransaction($code, $download){
		$db  =& JFactory::getDBO();

		$db->setQuery("Select * from #__m15_paypal WHERE cart_code  = '{$code}' AND download_code = '{$download}'");
		$result = $db->loadObject();

		if($result->payment_status == 'Completed'){
			$bool = false;
		}else{
			$bool = true;
		}

		return $bool;

	}
	// Force download of mp3 file..
	function forceDownload($archiveName,$msg) {
		// This can apparently fix some IE problems..
		if(ini_get('zlib.output_compression')) {
			ini_set('zlib.output_compression', 'Off');
		}


		$archiveName = str_replace("\\","/",$archiveName);
		/*
		 if(strpos($archiveName, "\\")){
			$arrStr = explode("\\", $archiveName );
			}else{
			$arrStr = explode("/", $archiveName );
			}
			*/
		$arrStr = explode("/", $archiveName );
		$arrStr = array_reverse($arrStr );

		if (!file_exists($archiveName)) {
			echo $msg;
			exit;
		}

		$bytes = $this->getFileSize($archiveName, "MB");
		@ob_end_clean();
		if($bytes > 2){
			$this->smartReadFile($archiveName, $arrStr[0], $this->get_mime_type($archiveName));
		}else{
			header("Pragma: private");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private",false);
			header("Content-Type: ".$this->get_mime_type($archiveName));
			header("Content-Disposition: attachment; filename=\"".basename($arrStr[0])."\";" );
			//header("Content-Disposition: attachment; filename=".basename($arrStr[0]).";" );
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: ".filesize($archiveName));
			readfile($archiveName);
		}
		exit;
	}

	function smartReadFile($location, $filename, $mimeType='application/octet-stream'){
		if(!file_exists($location)){
			header ("HTTP/1.0 404 Not Found");
			return;
		}

		$size=filesize($location);
		$time=date('r',filemtime($location));

		$fm=@fopen($location,'rb');
		if(!$fm){
			header ("HTTP/1.0 505 Internal server error");
			return;
		}

		$begin=0;
		$end=$size;

		if(isset($_SERVER['HTTP_RANGE'])){
			if(preg_match('/bytes=\h*(\d+)-(\d*)[\D.*]?/i', $_SERVER['HTTP_RANGE'], $matches)){
				$begin=intval($matches[0]);
				if(!empty($matches[1]))
				$end=intval($matches[1]);
			}
		}

		if($begin>0||$end<$size){
			header('HTTP/1.0 206 Partial Content');
		}else{
			header('HTTP/1.0 200 OK');

			header("Content-Type: $mimeType");
			//header('Cache-Control: public, must-revalidate, max-age=0');
			//header('Pragma: no-cache');
			header('Accept-Ranges: bytes');
			header('Content-Length:'.($end-$begin));
			header("Content-Range: bytes $begin-$end/$size");
			header("Content-Disposition: attachment; filename=\"".$filename."\";" );
			//header("Content-Disposition: inline; filename=$filename");
			header("Content-Transfer-Encoding: binary");
			header("Last-Modified: $time");
			//header("Expires: 0");			//header('Connection: close');
			header("Cache-control: private");
			header('Pragma: private');
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

			$cur=$begin;
			fseek($fm,$begin,0);

			while(!feof($fm)&&$cur<$end&&(connection_status()==0)){
				print fread($fm,min(1024*16,$end-$cur));
				$cur+=1024*16;
			}
		}
	}

	function getFileSize($file, $type)
	{
		switch($type){
			case "KB":
				$filesize = filesize($file) * .0009765625; // bytes to KB
				break;
			case "MB":
				$filesize = (filesize($file) * .0009765625) * .0009765625; // bytes to MB
				break;
			case "GB":
				$filesize = ((filesize($file) * .0009765625) * .0009765625) * .0009765625; // bytes to GB
				break;
		}
		if($filesize <= 0){
			return $filesize = 'unknown file size';}
			else{return round($filesize, 2).' '.$type;}
	}

}

?>