<?php

/*++++++++++++++++++++++++++++++++++++++++

Script: Maian Music v1.2
Written by: David Ian Bennett
E-Mail: support@maianscriptworld.co.uk
Website: http://www.maianscriptworld.co.uk

++++++++++++++++++++++++++++++++++++++++

This File: functions.php
Description: Program Functions

++++++++++++++++++++++++++++++++++++++++

TODO This file will eventually be removed and go to common.php*/


function parseObjectToArray($object) {
	$array = array();
	if (is_object($object)) {
		$array = get_object_vars($object);
	}
	return $array;
}

function uploadFile($src){

	$dest = JPATH_BASE.DS.'images'.DS.'maianmedia';

	if(!JFolder::exists($dest)){
		JFolder::create($dest, '0755');

	}

	//Retrieve file details from uploaded file, sent from upload form
	$file = JRequest::getVar('image', null, 'files', 'array');

	//Import filesystem libraries. Perhaps not necessary, but does not hurt
	jimport('joomla.filesystem.file');

	//Clean up filename to get rid of strange characters like spaces etc
	$filename = JFile::makeSafe($file['name']);

	//Set up the source and destination of the file
	$src = $file['tmp_name'];
	$dest = JPATH_COMPONENT . DS . "uploads" . DS . $filename;

	//First check if the file has the right extension, we need jpg only
	if ( strtolower(JFile::getExt($filename) ) == 'jpg') {
		if ( JFile::upload($src, $dest) ) {
			//Redirect to a page of your choice
		} else {
			//Redirect and throw an error message
		}
	} else {
		//Redirect and notify user file is not right extension
	}

}


function getTableRowCount($table,$where='') {
	$db =& JFactory::getDBO();
	$db->setQuery("SELECT count(*) AS t_count FROM #__m15_".$table."
                         ".($where ? $where : '')."");	
	$COUNT = $db->loadObject();

	return $COUNT->t_count;
}

//=================================================
// FUNCTION: cleanData()
// Removes slashes if magic quotes are on
//=================================================
function cleanData($data) {
	return (get_magic_quotes_gpc() ? stripslashes($data) : $data);
}
//==============================
// Render track data for graph
//==============================
function getTrackDataForGraph($id,$name=false)
{
	$db =& JFactory::getDBO();

	$array = array();
	$db->setQuery("SELECT * FROM #__m15_tracks
                           WHERE track_album = '{$id}'
                           ORDER BY track_order") ;  
	$q_tracks = $db->loadObjectList();

	foreach ($q_tracks as $TRACK) {
		if (!$name) {
			$db->setQuery("SELECT count(*) AS t_count FROM #__m15_purchases
                                  WHERE item_id = 't".$TRACK->id."'") ;	  
			$PURCHASES = $db->loadObject();

			$db->setQuery("SELECT count(*) AS a_count FROM #__m15_purchases
                                   WHERE track_id   = '{$TRACK->id}'") ;	  
			$PURCHASES2 = $db->loadObject();
		}
		$array[] = ($name ? cleanData($TRACK->track_name) : $PURCHASES->t_count.';'.$PURCHASES2->a_count);
	}
	return implode(",",$array);
}

//===========================================================
// Get ids for tracks in album and see if purchases exist
//===========================================================

function getTrackPurchasesForAlbum($id)
{
	$db =& JFactory::getDBO();
	$count = 0;
	$db->setQuery("SELECT * FROM #__m15_tracks
                           WHERE track_album = '{$id}'
                           ORDER BY track_order") ;
	$q_tracks = $db->loadObjectList();
	foreach ($q_tracks as $TRACK) {
		//while ($TRACK = mysql_fetch_object($q_tracks)) {
		$db->setQuery("SELECT count(*) AS t_count FROM #__m15_purchases
                                WHERE item_id = 't".$TRACK->id."'") ;
		$PURCHASES= $db->loadObject();
		$count = $count+$PURCHASES->t_count;
	}
	return $count;
}
function encrypt($data) {
	return (function_exists('sha1') ? sha1($data) : md5($data));
}

//=====================
// Get table count
//=====================

function rowCount($table,$where='')
{
	$db =& JFactory::getDBO();
	$db->setQuery("SELECT count(*) AS t_count FROM #__m15_".$table.$where."");
	$COUNT = $db->loadObject();
	return $COUNT->t_count;
}

//------------------------------------------------
// Pagination for pages
//------------------------------------------------

function admin_page_numbers($count,$limit,$page,$stringVar='page')
{
	/*$PaginateIt = new PaginateIt();
	 $PaginateIt->SetCurrentPage($page);
	 $PaginateIt->SetItemCount($count);
	 $PaginateIt->SetItemsPerPage($limit);
	 $PaginateIt->SetLinksToDisplay(50);
	 $PaginateIt->SetQueryStringVar($stringVar);
	 $PaginateIt->SetLinksFormat('&laquo; '._msg_script5,
	 ' &bull; ',
	 _msg_script5.' &raquo;');*/
	//return '<div id="page_numbers">'.$PaginateIt->GetPageLinks().'</div>';
	return '<div id="page_numbers"></div>';
}

//=================================================
// FUNCTION: get_cur_symbol()
// Return cost of payment with cur symbol
//=================================================
/* TODO this should be moved to the xml file as well*/
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

//=================================================
// FUNCTION: toolTip
// Return overlib tooltip
//=================================================

function toolTip($msg,$msg2) {
	return '<span class="mm_tooltip">[<a href="javascript:void(0);" onclick="return overlib(\''.htmlspecialchars($msg2).'\', STICKY, CAPTION,\''.$msg.'\', CENTER);" onmouseout="nd();"><b>?</b></a>]</span>';
}

function getTplPath($template='classic', $type='file'){

	switch($type) {
		case 'file':
			$template = 'templates'.DS.$template;
			return $template;
			break;
	}
}


?>
