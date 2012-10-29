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
 * You must attribute the work in the manner specified by the author or licensor
 * (but not in any way that suggests that they endorse you or your use of the work).
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once(JPATH_LIBRARIES.DS.'joomla'.DS.'factory.php');
include_once(JPATH_COMPONENT.DS.'common'.DS.'functions.php');


include_once(JPATH_COMPONENT.DS.'tables'.DS.'album.php');
include_once(JPATH_COMPONENT.DS.'tables'.DS.'paypal.php');
include_once(JPATH_COMPONENT.DS.'tables'.DS.'tracks.php');
include_once(JPATH_COMPONENT.DS.'tables'.DS.'settings.php');
include_once(JPATH_COMPONENT.DS.'tables'.DS.'purchases.php');

$db =& JFactory::getDBO();

$db->setQuery("SELECT * FROM #__mm_settings");
$settings = $db->loadObject();

$db->setQuery("SELECT * FROM #__mm_albums");
$albums = $db->loadObjectList();

$db->setQuery("SELECT * FROM #__mm_tracks");
$tracks = $db->loadObjectList();

$db->setQuery("SELECT * FROM #__mm_purchases");
$purchases = $db->loadObjectList();

$db->setQuery("SELECT * FROM #__mm_paypal");
$paypal = $db->loadObjectList();

$settingsTable =& JTable::getInstance('settings', 'Table');
$albumTable =& JTable::getInstance('album', 'Table');
$purchasesTable =& JTable::getInstance('purchases', 'Table');
$paypalTable =& JTable::getInstance('paypal', 'Table');
$tracksTable =& JTable::getInstance('tracks', 'Table');

unset($tracksTable->tracksAdded);
$pagesTable =& JTable::getInstance('bakpages', 'Table');
$pagesTable->_tbl = '#__m15_pages';

// Bind the form fields to the settings table
if (!$settingsTable->bind(parseObjectToArray($settings))) {
	echo MaianText::_(_msg_error_bind).' Settings<br>';
	$importError = 1;
}

// Make sure the settings record is valid
if (!$settingsTable->check()) {
	echo MaianText::_(_msg_error_check).' Settings<br>';
	$importError = 1;
}

// Store the web link table to the database
if (!$settingsTable->store()) {
	echo MaianText::_(_msg_error_store).' Settings<br>';
	$importError = 1;
}

foreach($purchases as $single){

	if (!$purchasesTable->bind($single)){
		echo MaianText::_(_msg_error_bind).' Purchases<br>';
		$importError = 1;
	}

	// Make sure the  record is valid
	if (!$purchasesTable->check()){
		echo MaianText::_(_msg_error_check).' Purchaces<br>';
		$importError = 1;
	}

	$purchasesTable->_tbl_key = 0;

	// Store the web link table to the database
	if (!$purchasesTable->store()){
		echo MaianText::_(_msg_error_store).' Purchaces<br>';
		$importError = 1;
	}

}


foreach($paypal as $single){

	if (!$paypalTable->bind($single)){
		echo MaianText::_(_msg_error_bind).' Paypal<br>';
		$importError = 1;
	}

	// Make sure the  record is valid
	if (!$paypalTable->check()){
		echo MaianText::_(_msg_error_check).' Paypal<br>';
		$importError = 1;
	}
	$paypalTable->_tbl_key = 0;
	// Store the web link table to the database
	if (!$paypalTable->store()){
		echo MaianText::_(_msg_error_store).' Paypal<br>';
		$importError = 1;
	}

}

foreach($albums as $album){

	if (!$albumTable->bind($album)){
		echo MaianText::_(_msg_error_bind).' Album<br>';
		$importError = 1;
	}

	// Make sure the  record is valid
	if (!$albumTable->check()){
		echo MaianText::_(_msg_error_check).' Album<br>';
		$importError = 1;
	}
	$albumTable->_tbl_key = 0;
	// Store the web link table to the database
	if (!$albumTable->store()){
		echo MaianText::_(_msg_error_store).' Album<br>';
		$importError = 1;
	}

}

foreach($tracks as $track){

	if (!$tracksTable->bind($track)){
		echo MaianText::_(_msg_error_bind).' Track<br>';
		$importError = 1;
	}
	$tracksTable->setTrackAdded(null);
	// Make sure the  record is valid
	if (!$tracksTable->check()){
		echo MaianText::_(_msg_error_check).' Track<br>';
		$importError = 1;
	}

	$tracksTable->_tbl_key = 0;

	// Store the web link table to the database
	if (!$tracksTable->store()){

		echo MaianText::_(_msg_error_store).' Track<br>';
		$importError = 1;
	}

}

foreach($pages as $page){

	if (!$pagesTable->bind($page)){
		echo MaianText::_(_msg_error_bind).' Pages<br>';
		$importError = 1;
	}

	// Make sure the  record is valid
	if (!$pagesTable->check()){
		echo MaianText::_(_msg_error_check).' Pages<br>';
		$importError = 1;
	}

	$pagesTable->_tbl_key = 0;

	// Store the web link table to the database
	if (!$pagesTable->store()){

		echo MaianText::_(_msg_error_store).' Pages<br>';
		$importError = 1;
	}

}

if (isset($importError)){
	echo '<font style="color:red; margin-left:150px;"><b>'.MaianText::_( _msg_import).'</b></font>';
	$importError = 1;
}else{
	echo '<font style="color:green; margin-left:150px;"><b>'.MaianText::_( _msg_import2).'</b></font>';
}

?>
