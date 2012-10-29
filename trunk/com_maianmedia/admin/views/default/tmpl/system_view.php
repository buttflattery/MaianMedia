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

require_once(JPATH_LIBRARIES.DS.'joomla'.DS.'factory.php');
include_once(JPATH_COMPONENT.DS.'common'.DS.'functions.php');

$db =& JFactory::getDBO();

$db->setQuery("SELECT * FROM #__m15_settings");
$settings = $db->loadObject();

$db->setQuery("SELECT * FROM #__m15_tracks");
$tracks = $db->loadObjectList();

jimport( 'joomla.environment.uri' );
$uri =& JURI::getInstance();

$mp3_path = $settings->mp3_path;
$preview_path = JPATH_ROOT.DS.$settings->preview_path;

$mp3_bool = true;
$preview_bool = true;

$errors = '';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb"
	dir="ltr">
<head>
<link href="components/com_maianmedia/stylesheet.css" rel="stylesheet"
	type="text/css" />
<link rel="stylesheet" href="templates/system/css/system.css"
	type="text/css" />
<link
	href="<?php echo $uri->root() ?>administrator/components/com_maianmedia/utilities/template/css/template.css"
	rel="stylesheet" type="text/css" />
</head>
<body id="minwidth-body">
	<form id="adminForm" enctype="multipart/form-data" action="index.php"
		method="post" name="adminForm">
		<fieldset id="maian_about">

			<table class="admintable">
				<tr>
					<td colspan=2 width="100%" id="check" class="key"><?php echo MaianText::_(_setup30); ?>
					</td>
				</tr>
				<?php

				if (JFolder::exists($settings->mp3_path)){

					foreach($tracks as $track){
						if (!file_exists($settings->mp3_path.DS.$track->mp3_path)) {
							echo "<tr><td>The file $track->mp3_path could not be found</tr></td>";
							$mp3_bool = false;
						}
					}

				}else{
					echo "<tr><td>The MP3 folder $settings->mp3_path could not be found</tr></td>";
				}

				if (JFolder::exists(JPATH_ROOT.DS.$settings->preview_path)){
					$preview_bool = false;
					foreach($tracks as $track){
						if (!file_exists(JPATH_ROOT.DS.$settings->preview_path.DS.$track->preview_path)) {
							echo "<tr><td>The file $track->preview_path could not be found</tr></td>";

						}
					}

				}else{

					echo "<tr><td>The Preview folder $preview_path could not be found</tr></td>";
				}
				if(file_exists($mp3_path) &&  file_exists($preview_path)){
					echo '<tr><td>Mp3 and preview paths appear to be ok</tr></td>';
					echo '<tr><td>Mp3 '.$mp3_path.'</tr></td>';
					echo '<tr><td>Preview '.$preview_path.'</tr></td>';
				}

				?>
			</table>

		</fieldset>
	</form>
</body>
</html>
