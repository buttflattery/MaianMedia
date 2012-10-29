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

// No Permission
defined('_JEXEC') or die('Restricted access');
$controller	= JRequest::getCmd('controller', 'maianmedia');

JHTML::_('behavior.switcher');

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

// Load submenus
$controllers = array('&task=about' => MaianText::_(_msg_public_header6),
'&controller=settings&view=settings'=> MaianText::_(_msg_header3),
'&controller=category&view=category'=> MaianText::_(_msg_header10),
'&controller=albums&view=albums'=> MaianText::_(_msg_header4),
'&controller=tracks&view=track&task=add'=> MaianText::_(_msg_add5),
'&controller=items&view=items'=> MaianText::_(_msg_manage_items),
'&controller=sales&view=sales'=> MaianText::_(_msg_header7),
'&controller=stats&view=stats'=> MaianText::_(_msg_header11),
'&task=tools'=> MaianText::_(_msg_tools_title));	


foreach ($controllers as $key => $val) {
	$active	= ($controller == $key);
	
	JSubMenuHelper::addEntry($val, 'index.php?option=com_maianmedia'.$key, $active);
}

$toolbar = JToolBar::getInstance('submenu');

?>