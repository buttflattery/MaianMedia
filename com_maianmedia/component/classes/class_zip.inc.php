<?php
/**
 * @package		Joomla
 * @subpackage	com_maianmedia
 * @copyright	Copyright (C) Are Times & Maian Script World. All rights reserved.
 * @license		GNU/GPL
 * @author 		Arelowo Alao (aretimes.com) & David Bennet (maianscriptworld.co.uk)
 * Joomla! and Maian Music are free software. You must attribute the work in the manner
 * specified by the author or licensor (but not in any way that suggests that they endorse you or your use of the work).
 */
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
function get_zip($files = array(),$destination = '',$overwrite = false, $mp3_path) {
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$local_file = str_replace($mp3_path,'', $file);
			$zip->addFile($file,$local_file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

		//close the zip -- done!
		$zip->close();

		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}