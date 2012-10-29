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

$db->setQuery("SELECT * FROM #__m15_settings");
$settings = $db->loadObject();

$db->setQuery("SELECT * FROM #__m15_albums");
$albums = $db->loadObjectList();

$db->setQuery("SELECT * FROM #__m15_tracks");
$tracks = $db->loadObjectList();

$db->setQuery("SELECT * FROM #__m15_purchases");
$purchases = $db->loadObjectList();

$db->setQuery("SELECT * FROM #__m15_paypal");
$paypal = $db->loadObjectList();

$db->setQuery("SELECT * FROM #__m15_pages");
$pages = $db->loadObjectList();

$db->setQuery("SELECT * FROM #__m15_categories");
$categories = $db->loadObjectList();

$db =& JFactory::getDBO();
$db->setQuery("DROP TABLE IF EXISTS  `#__mbak_albums`");
$db->query();

$db->setQuery("DROP TABLE IF EXISTS `#__mbak_paypal`");
$db->query();

$db->setQuery("DROP TABLE IF EXISTS  `#__mbak_purchases`");
$db->query();

$db->setQuery("DROP TABLE IF EXISTS `#__mbak_settings`");
$db->query();

$db->setQuery("DROP TABLE IF EXISTS `#__mbak_tracks`");
$db->query();

$db->setQuery("DROP TABLE IF EXISTS `#__mbak_pages`");
$db->query();

$db->setQuery("DROP TABLE IF EXISTS  `#__mbak_categories`");
$db->query();

$fh = fopen(JPATH_COMPONENT.DS.'install.mysql.sql', 'r');
$sql_file = fread($fh, filesize(JPATH_COMPONENT.DS.'install.mysql.sql'));
fclose($fh);

$sql_file = str_replace('#__m15','#__mbak', trim($sql_file));
$sql_file = str_replace(array("\r", "\r\n", "\n"), '', trim($sql_file));

$queries = explode(";", trim($sql_file));

foreach($queries AS $query){

	if($query != ''){
		$db->setQuery(trim($query));
		$db->query();

		$start = strpos($query,"#");
		$table = substr($query, $start);
		$table = substr($table, 0, strpos($table,"`"));

		$insert = "INSERT INTO ".$table."(";
		switch($table){
			case"#__mbak_settings":
				$insert = $insert." ".$this->getSingleStatement($settings);

				$db->setQuery($insert);
				$db->query();
					
				break;
					
			case"#__mbak_albums":
				$insert = $insert." ".$this->getStatements($albums);

				$db->setQuery($insert);
				$db->query();
					
				break;
					
			case"#__mbak_tracks":

				foreach($tracks AS $track){
					$insert = "INSERT INTO ".$table."(";
					$insert = $insert." ".$this->getSingleStatement($track);
						
					$db->setQuery($insert);
					$db->query();
				}

				break;
					
			case"#__mbak_purchases":
				foreach($purchases AS $purchase){
					$insert = "INSERT INTO ".$table."(";
					$insert = $insert." ".$this->getSingleStatement($purchase);
						
					$db->setQuery($insert);
					$db->query();
				}
					
				break;
					
			case"#__mbak_paypal":

				foreach($paypal AS $trans){
					if($trans->id == 91 || $trans->id == 184){
						$stop = true;
					}
					$insert = "INSERT INTO ".$table."(";
					$insert = $insert." ".$this->getSingleStatement($trans);
						
					$db->setQuery($insert);
					$db->query();
				}
					
				break;
					
			case"#__mbak_pages":
				$insert = $insert." ".$this->getStatements($pages);
					
				$db->setQuery($insert);
				$db->query();
					
				break;
					
			case"#__mbak_categories":
				$insert = $insert." ".$this->getStatements($categories );
					
				$db->setQuery($insert);
				$db->query();
					
				break;
		}


	}

}



if (isset($importError)){
	echo '<font style="color:red; margin-left:150px;"><b>'.MaianText::_(_msg_backup5).'</b></font>';
	$importError = 1;
}else{
	echo '<font style="color:blue; margin-left:150px;"><b>'.MaianText::_(_msg_backup6).'</b></font>';
}

?>
