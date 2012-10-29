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

$db =& JFactory::getDBO();

$db->setQuery("SELECT * FROM #__mbak_settings");
$settings = $db->loadObject();

$db->setQuery("SELECT * FROM #__mbak_albums");
$albums = $db->loadObjectList();

$db->setQuery("SELECT * FROM #__mbak_tracks");
$tracks = $db->loadObjectList();

$db->setQuery("SELECT * FROM #__mbak_purchases");
$purchases = $db->loadObjectList();

$db->setQuery("SELECT * FROM #__mbak_paypal");
$paypal = $db->loadObjectList();

$db->setQuery("SELECT * FROM #__mbak_pages");
$pages = $db->loadObjectList();

$db->setQuery("SELECT * FROM #__mbak_categories");
$categories = $db->loadObjectList();

$fh = fopen(JPATH_COMPONENT.DS.'install.mysql.sql', 'r');
$sql_file = fread($fh, filesize(JPATH_COMPONENT.DS.'install.mysql.sql'));
fclose($fh);

$sql_file = str_replace(array("\r", "\r\n", "\n"), '', trim($sql_file));

$queries = explode(";", trim($sql_file));

foreach($queries AS $query){

	if($query != ''){
		$db->setQuery(trim($query));
		$db->query();

		$start = strpos($query,"#");
		$table = substr($query, $start);
		$table = substr($table, 0, strpos($table,"`"));

		switch($table){
			case"#__m15_settings":
				$this->updateInsertStatement($table, $settings);
					
				break;
					
			case"#__m15_albums":
				foreach($albums AS $album){
					$this->updateInsertStatement($table, $album);
				}
					
				break;
					
			case"#__m15_tracks":
				foreach($tracks AS $track){
					$this->updateInsertStatement($table, $track);
				}
					
				break;
					
			case"#__m15_purchases":
				foreach($purchases AS $purchase){
					$this->updateInsertStatement($table, $purchase);
				}
					
				break;
					
			case"#__m15_paypal":
				foreach($paypal AS $trans){
					$this->updateInsertStatement($table, $trans);
				}
					
				break;
					
			case"#__m15_pages":
				foreach($pages AS $page){
					$this->updateInsertStatement($table, $page);
				}
					
				break;
					
			case"#__mbak_categories":
				foreach($pages AS $page){
					$this->updateInsertStatement($table, $categories);
				}
					
				break;
		}


	}

}

if (isset($importError)){
	echo '<font style="color:red; margin-left:150px;"><b>There was a problem importing your backup tables</b></font>';
	$importError = 1;
}else{
	$db->setQuery("SELECT id FROM #__components WHERE name= 'Maian Music 1.3'");
	$com_id = $db->loadObject();

	if(isset($com_id->id)){
		$db->setQuery('UPDATE #__menu SET componentid = '.$com_id->id.' WHERE link LIKE \'%option=com_maianmedia%\' and type =\'component\'');
		$db->query();
	}

	echo '<font style="color:green; margin-left:150px;"><b>Backup tables were detected and imported successfully</b></font>';
}
?>