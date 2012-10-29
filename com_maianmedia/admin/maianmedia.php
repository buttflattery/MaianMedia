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

// Load Base Contorller Class
require_once( JPATH_COMPONENT.DS.'controllers'.DS.'defaultController.php' );
require_once( JPATH_COMPONENT.DS.'toolbar.maianmedia.php' );
//set Globals
require_once (JPATH_COMPONENT_SITE.DS.'inc'.DS.'logger.php');
require_once( JPATH_COMPONENT.DS.'common'.DS.'common.php');

// Require specific controller if requested
if($controller = JRequest::getWord('controller')) {

	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'Controller.php';

	if (file_exists($path)) {
		require_once $path;
	}else {
		$controller = 'default';
	}

	$classname    = 'MaianController'.$controller;
	$controller   = new $classname( );

}else{
	$controller   = new MaianControllerDefault( );
}

$db = & JFactory::getDBO();
$db->setQuery("SELECT * FROM #__m15_settings");
$SETTINGS = $db->loadObject();

// Load language file..
if($SETTINGS->language == ""){
	include_once(JPATH_COMPONENT_SITE.DS.'inc'.DS.'language.php');
	MaianText::init(JPATH_COMPONENT_SITE.DS.'lang'.DS.'english.php');
	
}else{
	include_once(JPATH_COMPONENT_SITE.DS.'inc'.DS.'language.php');
	MaianText::init(JPATH_COMPONENT_SITE.DS.'lang'.DS.$SETTINGS->language);
}

if(!JRequest::getVar( 'resend' )){
	include_once(JPATH_COMPONENT.DS.'common'.DS.'functions.php');
}
if((JRequest::getVar( 'view' ) || JRequest::getVar( 'limit' )) && !JRequest::getVar( 'resend' ) && JRequest::getVar( 'format' )!='raw'){
	$document = &JFactory::getDocument();
	$document->addCustomTag('<link href="components/com_maianmedia/stylesheet.css" rel="stylesheet" type="text/css" />');
	//JHTML::_('behavior.modal', 'a.modal-button');
	$uri =& JURI::getInstance();
	$document->addScript( 'components/com_maianmedia/js/overlib.js' );
	$document->addScript( 'components/com_maianmedia/js/swfobject.js' );
	$document->addScript( 'components/com_maianmedia/js/request.js' );
	$document->addScript( 'components/com_maianmedia/js/custom-form-elements.js');
}
// Create the controller

// Perform the Request task
$controller->execute( JRequest::getVar( 'task' ) );

// Redirect if set by the controller
$controller->redirect();
?>