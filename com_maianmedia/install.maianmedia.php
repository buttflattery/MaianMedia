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
defined( '_JEXEC' ) or die( 'Restricted access' );

function getStatements($records) {
	$insert = "";
	$first = true;

	$db =& JFactory::getDBO();

	foreach($records as $record){
			
		if($first){
			foreach($record as $key => $value){
				$insert = $insert.$key.",";
			}
			$first = false;

			$len = strlen($insert) - 1;
			$insert = substr($insert, 0, $len).") VALUES (";
		}
		$db->setQuery("SELECT * FROM #__m15_categories WHERE id = '".$record->id."'");
		$cat = $db->loadObjectList();

		if(count($cat) == 0){
			foreach($record as $key => $value){
				if(is_int($value)){
					$insert = $insert.$value.",";
				}else{
					$insert = $insert."'".$value."',";
				}
			}

			$insert = substr($insert, 0, strlen($insert) - 1)."),(";
		}
	}

	$insert = substr($insert, 0, strlen($insert) - 2);

	return trim($insert);
}

function com_install() {

	$db =& JFactory::getDBO();
	$uri =& JURI::getInstance();

	$document = &JFactory::getDocument();
	$document->addScript($uri->current().'?option=com_maianmedia&format=raw&controller=tracks&task=uploaderjs');

	$is15 = strpos(JVERSION, "1.5") === false ? false:true;

	$db->setQuery( "SELECT id FROM #__components WHERE link= 'option=com_maianmedia'" );
	$id = $db->loadResult();

	if(!isset($id)){
		$db->setQuery( "SELECT id FROM #__components WHERE link= 'option=com_maian15'" );
		$id = $db->loadResult();
	}

	//get id
	$db->setQuery( "UPDATE #__menu SET componentid = '$id' WHERE link LIKE '%com_maianmedia%'" );
	$db->query();

	$db->setQuery( "Select * from #__m15_settings WHERE id = 1");
	$settings = $db->loadObject();
	if(!isset($settings->id)){
		//add info for settings
		$db->setQuery( "INSERT INTO `#__m15_settings` (`id`, `website_name`, `email_address`, `homepage_url`, `install_url`, `language`, `about`, `licence`, `music`, `enable_captcha`, `mod_rewrite`, `mp3_path`, `preview_path`, `rssfeeds`, `poplinks`, `page_expiry`, `download_expiry`, `paypal_mode`, `paypal_currency`, `paypal_email`, `page_style`, `log_errors`, `ssl_enabled`, `smtp`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `player`, `pdt`, `default_page`, `days`, `paypal_email2`, `pdt2`, `minpay`, `freeText`, `search`, `ajax`) VALUES
		(1, 'Our Music Download Store', 'example@localhost.com', '', '', 'english.php', 'Thank you for your interest in our music. Use the links above to browse  our collection of albums. You can purchase single tracks or whole albums by using the buttons provided. You can also preview mp3 files before you buy.<br /> <br /> All payments are securely handled by Paypal and you don`t need a Paypal account to<br /> <div id=\"paypal_credit\">  	<img src=\"/components/com_maianmedia/media/thumbs/credit-cards.gif\" alt=\"All Major Credit Cards\" width=\"500\" height=\"45\" /></div> 	', '', '', '1', '0', '//home//user//tracks', '//preview', 50, 5, 10, 10, '0', 'USD', 'example@localhost.com', 'test', '0', '0', '0', 'localhost', '', '', '25', 1, '', '1', 14, '', '', '10.00', '', '0', '1')" );
		$db->query();
	}

	$db->setQuery( "Select * from #__m15_pages WHERE id = 1");
	$pages = $db->loadObject();
	if(!isset($pages->id)){
		//add info for settings
		$db->setQuery("INSERT INTO `#__m15_pages` (`id`, `name`, `description`, `text`) VALUES
					(1, 'about', 'About', '<p>Thank you for your interest in our music. Use the links provided to browse  our collection of albums. You can purchase single tracks or whole albums by using the buttons provided. You can also preview mp3 files before you buy.<br /> <br /> All payments are securely handled by Paypal and you don`t need a Paypal account to</p>\r\n<div id=\"paypal_credit\"><img src=\"components/com_maianmedia/templates/classic/assets/media/icons/credit-cards.gif\" border=\"0\" alt=\"All Major Credit Cards\" width=\"500\" height=\"45\" /></div>');");
		$db->query();
	}else{
		$db->setQuery("UPDATE #__m15_pages SET description = 'About' WHERE id = '1'");
	}

	$db->setQuery( "Select * from #__m15_pages WHERE id = 2");
	$pages = $db->loadObject();
	if(!isset($pages->id)){
		//add info for settings
		$db->setQuery("INSERT INTO `#__m15_pages` (`id`, `name`, `description`, `text`) VALUES
					(2, 'license', 'License', '<p>All information and data contained within this music store are the property of [Your Music Store]., whether or not a copyright notice appears on the screen displaying this information. Users of the [Your Music Store] may save and use information contained therein only for personal use. No other use, including reproduction, retransmission, or editing, of [Your Music Store] information may be made without prior written permission of [Your Music Store]., which may be requested by contacting [Your Music Store].</p>');");
		$db->query();
	}else{
		$db->setQuery("UPDATE #__m15_pages SET description = 'License' WHERE id = '2'");
	}

	$db->setQuery( "Select * from #__m15_pages WHERE id = 3");
	$pages = $db->loadObject();

	if(!isset($pages->id)){
		//add info for settings
		$db->setQuery("INSERT INTO `#__m15_pages` (`id`, `name`, `description`, `text`) VALUES
					(3, 'music', 'Music' , '<p></p>');");
		$db->query();
	}else{
		$db->setQuery("UPDATE #__m15_pages SET description = 'Music' WHERE id = '3'");
	}

	$db->setQuery( "Select * from #__m15_pages WHERE id = 4");
	$pages = $db->loadObject();
	if(!isset($pages->id)){
		//add info for settings
		$db->setQuery("INSERT INTO `#__m15_pages` (`id`, `name`, `description`, `text`) VALUES
					(4, 'free', 'Free Downloads',  '<p>Below is a list of tracks available for free download</p>');");
		$db->query();
	}else{
		$db->setQuery("UPDATE #__m15_pages SET description = 'Free Downloads' WHERE id = '4'");
	}

	$db->setQuery( "Select * from #__m15_pages WHERE name like 'cat'");
	$pages = $db->loadObject();
	if(!isset($pages->id)){
		//add info for settings
		$db->setQuery("INSERT INTO `#__m15_pages` (`id`, `name`, `description`, `text`) VALUES
					(5, 'cat', 'Categories', '<p></p>');");
		$db->query();
	}else{
		$db->setQuery("UPDATE #__m15_pages SET description = 'Categories' WHERE id = '4'");
	}

	if($is15){
		//update old maian15 links
		$db->setQuery( "UPDATE #__menu SET link = 'index.php?option=com_maianmedia&view=music' WHERE link LIKE 'index.php?option=com_maian15&view=music'" );
		$db->query();

		$db->setQuery( "UPDATE #__menu SET link = 'index.php?option=com_maianmedia&view=contact' WHERE link LIKE 'index.php?option=com_maian15&view=contact'" );
		$db->query();

		$db->setQuery( "UPDATE #__menu SET link = 'index.php?option=com_maianmedia&view=freebie' WHERE link LIKE 'index.php?option=com_maian15&view=freebie'" );
		$db->query();

		$db->setQuery( "UPDATE #__menu SET link = 'index.php?option=com_maianmedia&view=mostpop' WHERE link LIKE 'index.php?option=com_maian15&view=mostpop'" );
		$db->query();

		$db->setQuery( "UPDATE #__components SET admin_menu_img = '../components/com_maianmedia/media/thumb/record.png' WHERE id = '$id'" );
		$db->query();
	}
	//add new fields for upgrade
	$fh = fopen(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_maianmedia'.DS.'install.mysql.sql', 'r');
	$sql_file = fread($fh, filesize(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_maianmedia'.DS.'install.mysql.sql'));
	fclose($fh);

	$queries = explode(";", trim($sql_file));

	foreach($queries AS $query){

		if($query != ''){
			$start = strpos($query,"`" );
			$end = strpos($query, "`", $start+1);

			$table_name = substr($query, $start +1, $end - $start -1);

			$start = strpos($query,"(" );
			$end = strrpos($query, "PRIMARY KEY (`id`)");
			$input = substr($query, $start + 1, $end - $start -1);

			$lines = explode("\r\n", trim($input));
			//echo 'Scaning '.$table_name;
			foreach($lines AS $line){
				$start = strpos($line,"`" );
				$end = strpos($line, "`", $start+1);

				$field = substr($line, $start +1, $end - $start -1);

				$db->setQuery("SHOW COLUMNS FROM $table_name LIKE '$field'");
				$search = $db->loadObject();
					
				if(!isset($search)){

					$sql= 'ALTER TABLE '.$table_name.' ADD '.trim(str_replace(array("\r", "\r\n", "\n"), '', trim($line)));
					$sql= substr($sql, 0, strlen($sql) - 1).';';
					//echo 'Adding '.$field.' to '.$table_name.'<br>';
					$db->setQuery($sql);
					$db->query();
				}else{
					if(strpos($line, $search->Type) === false){
						$change  = substr($line, $end+1);
						$sql= 'ALTER TABLE '.$table_name.' MODIFY '.$field.' '.trim($change);
						$sql= substr($sql, 0, strlen($sql) - 1).';';

						$db->setQuery($sql);
						$db->query();
					}
				}
			}
		}

	}

	//migrate categories for Joomla 1.5
	$db->setQuery("UPDATE #__m15_albums SET is_album='1'");
	$db->query();

	if($is15){

		$db->setQuery("UPDATE #__components SET admin_menu_alt = 'Maian Media', name = 'Maian Media' WHERE admin_menu_link = 'option=com_maianmedia'" );
		$db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_alt = 'About', name= 'About' WHERE admin_menu_link = 'option=com_maianmedia&task=about'" );
		$db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_alt = 'Settings', name = 'Settings' WHERE admin_menu_link = 'option=com_maianmedia&controller=settings&view=settings'" );
		$db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_alt = 'Categories', name = 'Categories' WHERE admin_menu_link = 'option=com_maianmedia&controller=category&view=category'" );
		$db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_alt = 'Manage Albums', name = 'Manage Albums' WHERE admin_menu_link = 'option=com_maianmedia&controller=albums&view=albums'" );
		$db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_alt = 'Add New Tracks', name = 'Add New Tracks' WHERE admin_menu_link = 'option=com_maianmedia&controller=tracks&view=track&task=add'" );
		$db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_alt = 'Manage Tracks', name = 'Manage Tracks' WHERE admin_menu_link = 'option=com_maianmedia&controller=tracks&view=tracks&task=manage'" );
		$db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_alt = 'Sales', name = 'Sales' WHERE admin_menu_link = 'option=com_maianmedia&controller=sales&view=sales'" );
		$db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_alt = 'Search Sales', name = 'Search Sales' WHERE admin_menu_link = 'option=com_maianmedia&controller=sales&view=search'" );
		$db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_alt = 'Statistics', name = 'Statistics' WHERE admin_menu_link = 'option=com_maianmedia&controller=stats&view=stats'" );
		$db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_alt = 'Tools', name = 'Tools' WHERE admin_menu_link = 'option=com_maianmedia&task=tools'" );
		$db->query();

		$db->setQuery("SELECT * FROM #__categories WHERE section = 'com_maianmedia'");
		$categories = $db->loadObjectList();

		if(count($categories) > 0){
			$values = getStatements($categories);
			$insert = "INSERT INTO #__m15_categories(".$values;
			$db->setQuery($insert);
			$db->query();
		}
	}

	echo '<div id="maian_content"><img src="'.$uri->root().'/administrator/components/com_maianmedia/images/are_logo.png"></img><br>';
	echo '<p>To use this system you must have a paypal bussiness account<br>';
	echo 'Log in to your Paypal account and click "Profile" from the "My Account" menu tab.<br><br>';
	echo '<b>Click "Selling Preferences --> "Instant Payment Notification Preferences"</b><br>';
	echo '<p>On the next screen, click "Edit" and check the box to enable the IPN system and in the "Notification URL" box, enter the full URL to your notification page.<br><br>';
	echo '<b>'.$uri->root().'index.php?option=com_maianmedia&amp;section=paypal&amp;view=notify</b><br><br>';
	echo 'From the "Profile" tab, select "Selling Preferences" --> "Website Payment Preferences" the URL for the auto return function is as follows:<br><br>';
	echo '<b>'.$uri->root().'index.php?option=com_maianmedia&amp;section=paypal&amp;view=thanks</b><br><br>';
	echo 'Be sure to turn on "Auto Return" and "Payment Data Transfer".  Copy your pin for use in the application</p></div>';

	$flawedFile = JPATH_COMPONENT_ADMINISTRATOR.DS.'utilities'.DS.'charts'.DS.'php-ofc-library'.DS.'ofc_upload_image.php';
	$foundFlaw = false;
	$result = '';
	
	if (is_file($flawedFile)){
		$handle = unlink($fileNameToBeDeleted);
		$foundFlaw = true;
	
	    if (!$handle && $foundFlaw) {
	        $result = "WARNING Could not remove " . $flawedFile. ". You Must Remove It Manually.";
	    }
	
	}
	
	$flawedFile = JPATH_COMPONENT_ADMINISTRATOR.DS.'charts'.DS.'php-ofc-library'.DS.'ofc_upload_image.php';
	

	if (is_file($flawedFile)){
		$handle = unlink($fileNameToBeDeleted);
		$foundFlaw = true;
	
	    if (!$handle && $foundFlaw) {
	        $result = "WARNING Could not remove " . $flawedFile. ". You Must Remove It Manually.";
	    }
	
	}
	
	$db->setQuery( "SELECT * FROM #__mm_settings" );
	$data = $db->loadObjectList();

	if(isset($data)){
		$document->addScript( 'components/com_maianmedia/js/request.js' );
		echo '<div class="button2-right">
<div class="start">
<a href="javascript:ajaxRequest(\'import\', \'index.php?option=com_maianmedia&amp;task=tools&amp;format=raw&amp;tool=run_import\', 1)"
	title="Start" onclick="">Import 1.0 Tables</a></div>
</div><br><br><div style="float:left; text-align:left;" id="import"></div>';
	}

	$db->setQuery( "SELECT * FROM #__mbak_settings" );
	$data = $db->loadObjectList();

	if(isset($data)){

		$document->addScript( 'components/com_maianmedia/js/request.js' );
		echo '<div class="button2-right">
<div class="start">
<a href="javascript:ajaxRequest(\'backup\', \'index.php?option=com_maianmedia&amp;task=tools&amp;format=raw&amp;tool=import_backup\', 1)"
	title="Start" onclick="">Import Table Backup</a></div>
</div><br><br><div style="float:left; text-align:left;" id="backup"></div>';
	}

}
?>