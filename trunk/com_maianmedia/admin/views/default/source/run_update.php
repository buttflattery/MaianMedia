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

//Import filesystem libraries. Perhaps not necessary, but does not hurt
jimport('joomla.filesystem.file');
jimport('joomla.database.table');

include_once(JPATH_COMPONENT.DS.'tables'.DS.'album.php');
include_once(JPATH_COMPONENT.DS.'tables'.DS.'tracks.php');
include_once(JPATH_COMPONENT.DS.'tables'.DS.'category.php');

include_once(JPATH_COMPONENT.DS.'common'.DS.'common.php');

include_once(JPATH_COMPONENT.DS.'utilities'.DS.'filemanager'.DS.'Assets'.DS.'getid3'.DS.'getid3.php');

$db =& JFactory::getDBO();

$db->setQuery("SELECT * FROM #__m15_settings");
$SETTINGS = $db->loadObject();

$download_path = $SETTINGS->mp3_path;
$preview_path = JPATH_SITE.$SETTINGS->preview_path;

$albumTable =& JTable::getInstance('album', 'Table');
$tracksTable =& JTable::getInstance('tracks', 'Table');
$catTable =& JTable::getInstance('category', 'Table');

$selected_files = JRequest::getVar('selected_files');

$fileArray = array();
$testArray = array();

$bool = true;

foreach ($selected_files as $node){
	if($bool){
		$ext=explode('/',$node);
		$download_path = str_replace(trim($ext[0]), '', $download_path);
		$bool = false;
	}

	$temp_path = $download_path.trim($node);
	$temp_path = str_replace("\\","//",$temp_path);
	if(is_dir($temp_path)){
		$fileArray = $fileArray+ process_dir($temp_path,true);
	}else{
		array_push($fileArray, array('dirpath' => $temp_path));
	}

}

$getid3 = new getID3();
foreach ($fileArray as $file) {
	//if (is_resource($file['handle'])) {
	$src = $file['dirpath'].DS.$file['filename'];

	$src = str_replace("\\","/",$src);
	$src = str_replace("//","/",$src);

	$ext=explode('.',$src);
	$ext_count = count($ext);
	$test = $ext[$ext_count - 1];

	if($src != '.' && $src != '..' && $ext[$ext_count - 1] == 'mp3'){
		JPath::setPermissions($src, '0755');
		@$getid3->Analyze($src);

		$filename = str_replace('/','',strrchr($src, "/"));

		if(isset($getid3->info['comments']['band'][0]) && $getid3->info['comments']['band'][0] != ""){

			$artist =  trim($getid3->info['comments']['band'][0]);
			//$test = $getid3->info['comments']['artist'][0];

			if (strpos($artist, $getid3->info['comments']['artist'][0]) == 0){
				$artist =  trim($getid3->info['comments']['artist'][0]);
			}
		}else{
			$artist = isset($getid3->info['comments']['artist'][0]) ? trim($getid3->info['comments']['artist'][0]):'Unknown Artist';
		}

		$album_name = isset($getid3->info['comments']['album'][0])? trim($getid3->info['comments']['album'][0]): 'Unknown Album';
		$title = isset($getid3->info['comments']['title'][0]) ? trim($getid3->info['comments']['title'][0]): trim($filename);
		$order = isset($getid3->info['comments']['track'][0])? trim($getid3->info['comments']['track'][0]): '9999';
		$genre = trim($getid3->info['comments']['genre'][0]);

		$split = explode('/', $artist);

		$artist = $split[0];

		$db->setQuery("SELECT * FROM #__m15_albums where artist like '$artist' And name like '$album_name' limit 1");
		$album = $db->loadObject();

		$db->setQuery(' SELECT * '
		. ' FROM #__m15_categories where section = \'com_maianmedia\'
			AND  title like \''.$genre.'\'') ;
			
		$cat = $db->loadObject();

		$safefilename = JFile::makeSafe(str_replace(' ','_',$filename));

		$renameDest = str_replace($filename,$safefilename,$src);

		//@todo: add option to use smart copy for albums and tracks
		JFolder::move($src, $renameDest);

		if($src === $renameDest){

		}else{
			JFolder::delete($src);
		}

		if (!isset($cat)){

			$data['title'] = $genre;
			$data['published'] = 1;
			$data['alias'] = str_replace(' ','_',$genre);
			$data['section'] = 'com_maianmedia';
				
			// Bind the form fields to the settings table
			if (!$catTable->bind($data)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}

			// Make sure the settings record is valid
			if (!$catTable->check()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}

			// Store the web link table to the database
			if (!$catTable->store()) {
				$this->setError( $row->getErrorMsg() );
				return false;
			}
		}

		//echo 'new dest '.$renameDest;
		if(!isset($album)){

			$album['name'] = $album_name;
			$album['artist'] = $artist;
			$album['status'] = true;

			if(isset($cat)){
				$album['cat'] = $cat->id;
			}

			if (!$albumTable->bind($album)){
				echo MaianText::_(_msg_error_bind).' Album<br>';
				$importError = 1;
				echo 'problem binding '.$album_name;
			}

			// Make sure the  record is valid
			if (!$albumTable->check()){
				echo MaianText::_(_msg_error_check).' Album<br>';
				$importError = 1;
				echo 'problem checking '.$album_name;
			}

			$albumTable->_tbl_key = 0;
			// Store the web link table to the database
			if (!$albumTable->store()){
				echo MaianText::_(_msg_error_store).' Album<br>';
				$importError = 1;
				echo 'problem storing '.$album_name;
			}

			$albumId = $albumTable->_db->insertid();
		}else{
			$albumId = $album->id;
		}
		//echo 'album ID ='.$albumId ;
		$wtf = str_replace(trim($SETTINGS->mp3_path),'', $renameDest);

		$test = str_replace("\\","/",$SETTINGS->mp3_path).'/';
		$test = str_replace("//","/",$test);

		$renameDest = str_replace('\\','/',$renameDest);
		$renameDest= str_replace('//','/',$renameDest);

		$mp3_path = str_replace($test, '', $renameDest);

		$db->setQuery("SELECT * FROM #__m15_tracks where mp3_path = '$mp3_path' limit 1");
		$track = $db->loadObject();

		if(!isset($track)){
			$tracks['track_album'][0] = $albumId;
			$tracks['track_name'] [0]= $title;
			$tracks['mp3_path'] [0]= str_replace($test, '', $renameDest);
			$tracks['track_length'][0] = $getid3->info['playtime_string'];
			$tracks['track_order'] [0]= $getid3->info['comments']['name'][0];
			$_POST['track_single_0'] = '1';
			$tracks['track_cost'] [0]= '.99';
			//echo 'adding -- >'.$title.' Album id ='.$albumId;
			// Bind the form fields to the table
			if (!$tracksTable->bind($tracks)) {
				$this->setError($this->_db->getErrorMsg());
				//return false;
				echo 'problem binding '.$title;
			}

			// Make sure the  record is valid
			if (!$tracksTable->check()) {
				$this->setError($this->_db->getErrorMsg());
				//return false;
				echo 'problem on error check for '.$title;
			}

			// Store the web link table to the database
			if (!$tracksTable->addTracks()) {
				//$this->tracksAdded = $tracksTable->tracksAdded;
				$this->setError( $this->_db->getErrorMsg());
				//return false;
				echo 'problem adding '.$title;
			}
		}

	}

}



echo 'Update Complete.  Please close the window and refresh the page.';

?>