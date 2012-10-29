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

$db->setQuery("SELECT * FROM #__mm_settings");
$settings = $db->loadObject();

if($db->ErrorNo() ==1146){
	$error = $db->ErrorNo();
}
$db->setQuery("SELECT * FROM #__mm_albums");
$albums = $db->loadObject();

if($db->ErrorNo() ==1146){
	$error= $db->ErrorNo();
}

$db->setQuery("SELECT * FROM #__mm_tracks");
$tracks = $db->loadObject();

if($db->ErrorNo() ==1146){
	$error = $db->ErrorNo();
}

$db->setQuery("SELECT * FROM #__mm_purchases");
$purchases = $db->loadObject();

if($db->ErrorNo() ==1146){
	$error = $db->ErrorNo();
}

$db->setQuery("SELECT * FROM #__mm_paypal");
$paypal = $db->loadObject();

if($db->ErrorNo() ==1146){
	$error = $db->ErrorNo();
}

jimport( 'joomla.environment.uri' );
$uri =& JURI::getInstance();

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
		<fieldset id="maian_about">

		<?php if(!isset($error)){ ?>
			<div class="button2-right">
				<div class="start">
					<a
						href="javascript:ajaxRequest('run_import', 'index.php?option=com_maianmedia&amp;task=tools&amp;format=raw&amp;tool=run_import', 1)"
						title="Start" onclick=""><?php echo MaianText::_( _setup29); ?> </a>
				</div>
			</div>
			<blockquote id="warning">
			<?php echo  MaianText::_(_msg_tools4); ?>
			</blockquote>
			<?php } ?>


			<table class="admintable">
				<tr>
					<td colspan=2 width="100%" id="check" class="key"><?php echo MaianText::_(_msg_tools); ?>
					</td>
				</tr>
				<tr>
					<td><b><?php echo $db->getPrefix(); ?>mm_settings</b></td>
					<td><span class="info"><b><?php echo (isset($settings) ? MaianText::_(_msg_tools2) : MaianText::_(_msg_tools3)); ?>
						</b> </span></td>
				</tr>
				<tr>
					<td><b><?php echo $db->getPrefix(); ?>mm_albums</b></td>
					<td><span class="info"><b><?php echo (isset($albums) ? MaianText::_(_msg_tools2) : MaianText::_(_msg_tools3)); ?>
						</b> </span></td>
				</tr>
				<tr>
					<td><b><?php echo $db->getPrefix(); ?>mm_tracks</b></td>
					<td><span class="info"><b><?php echo (isset($tracks)? MaianText::_(_msg_tools2) : MaianText::_(_msg_tools3)); ?>
						</b> </span></td>
				</tr>
				<tr>
					<td><b><?php echo $db->getPrefix(); ?>mm_purchases</b></td>
					<td><span class="info"><b><?php echo (isset($purchases) ? MaianText::_(_msg_tools2) : MaianText::_(_msg_tools3)); ?>
						</b> </span></td>
				</tr>
				<tr>
					<td><b><?php echo $db->getPrefix(); ?>mm_paypal</b></td>
					<td><span class="info"><b><?php echo (isset($paypal)? MaianText::_(_msg_tools2) : MaianText::_(_msg_tools3)); ?>
						</b> </span></td>
				</tr>
			</table>
			<div id="run_import"></div>
		</fieldset>
	</form>
</body>
</html>
