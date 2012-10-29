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

$uri =& JURI::getInstance();
$db =& JFactory::getDBO();

$db->setQuery("SELECT * FROM #__mbak_settings");
$settings = $db->loadObject();

if($db->ErrorNo() ==1146){
	$error = $db->ErrorNo();
}
$db->setQuery("SELECT * FROM #__mbak_albums");
$albums = $db->loadObject();

if($db->ErrorNo() ==1146){
	$error= $db->ErrorNo();
}

$db->setQuery("SELECT * FROM #__mbak_tracks");
$tracks = $db->loadObject();

if($db->ErrorNo() ==1146){
	$error = $db->ErrorNo();
}

$db->setQuery("SELECT * FROM #__mbak_purchases");
$purchases = $db->loadObject();

if($db->ErrorNo() ==1146){
	$error = $db->ErrorNo();
}

$db->setQuery("SELECT * FROM #__mbak_paypal");
$paypal = $db->loadObject();

if($db->ErrorNo() ==1146){
	$error = $db->ErrorNo();
}

$db->setQuery("SELECT * FROM #__mbak_pages");
$pages = $db->loadObject();

if($db->ErrorNo() ==1146){
	$error = $db->ErrorNo();
}

jimport( 'joomla.environment.uri' );
$uri =& JURI::getInstance();

$is15 = strpos(JVERSION, "1.5") === false ? false:true;
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
<script type="text/javascript"
	src="<?php echo $uri->root() ?>administrator/components/com_maianmedia/js/request.js"></script>

</head>
<body id="minwidth-body">
	<form id="adminForm" enctype="multipart/form-data" action="index.php"
		method="post" name="adminForm">
		<fieldset id="maian_backup">

			<div class="button2-right">
				<div class="start">
					<a
						href="javascript:ajaxRequest('run_backup', 'index.php?option=com_maianmedia&amp;task=tools&amp;format=raw&amp;tool=run_backup', 1)"
						title="Start" onclick=""><?php echo MaianText::_(_msg_backup2); ?> </a>
				</div>
			</div>
			<div id="import_backup" class="button2-right">
				<div class="start">
					<a
						href="javascript:ajaxRequest('run_backup', 'index.php?option=com_maianmedia&amp;task=tools&amp;format=raw&amp;tool=import_backup', 1)"
						title="Start" onclick=""><?php echo MaianText::_(_setup29); ?> </a>
				</div>
			</div>
			<?php if(isset($settings)){?>
			<blockquote id="warning">
			<?php echo  MaianText::_(_msg_backup3); ?>
			</blockquote>
			<?php } ?>

			<br><br>
					<table class="admintable">
						<tr>
							<td colspan=2 width="100%" id="check" class="key"><?php echo MaianText::_(_msg_tools); ?>
							</td>
						</tr>
						<tr>
							<td><b><?php echo $db->getPrefix(); ?>mbak_settings</b></td>
							<td><span class="info"><b><?php echo (isset($settings) ? MaianText::_(_msg_tools2) : MaianText::_(_msg_backup4)); ?>
								</b> </span></td>
						</tr>
						<tr>
							<td><b><?php echo $db->getPrefix(); ?>mbak_albums</b></td>
							<td><span class="info"><b><?php echo (isset($albums) ? MaianText::_(_msg_tools2) : MaianText::_(_msg_backup4)); ?>
								</b> </span></td>
						</tr>
						<tr>
							<td><b><?php echo $db->getPrefix(); ?>mbak_tracks</b></td>
							<td><span class="info"><b><?php echo (isset($tracks)? MaianText::_(_msg_tools2) : MaianText::_(_msg_backup4)); ?>
								</b> </span></td>
						</tr>
						<tr>
							<td><b><?php echo $db->getPrefix(); ?>mbak_purchases</b></td>
							<td><span class="info"><b><?php echo (isset($purchases) ? MaianText::_(_msg_tools2) : MaianText::_(_msg_backup4)); ?>
								</b> </span></td>
						</tr>
						<tr>
							<td><b><?php echo $db->getPrefix(); ?>mbak_paypal</b></td>
							<td><span class="info"><b><?php echo (isset($paypal)? MaianText::_(_msg_tools2) : MaianText::_(_msg_backup4)); ?>
								</b> </span></td>
						</tr>
						<tr>
							<td><b><?php echo $db->getPrefix(); ?>mbak_pages</b></td>
							<td><span class="info"><b><?php echo (isset($pages)? MaianText::_(_msg_tools2) : MaianText::_(_msg_backup4)); ?>
								</b> </span></td>
						</tr>
					</table>
					<div id="run_backup"></div>
		
		</fieldset>
	</form>
</body>
</html>
