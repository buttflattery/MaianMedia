<?php
/**
 * Hello World! Module Entry Point
 *
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:modules/
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

include_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'inc'.DS.'functions.php');

getSiteLanguage();

$db =& JFactory::getDBO();
$db->setQuery("SELECT * FROM #__m15_settings LIMIT 1");
$SETTINGS = $db->loadObject();

$document = &JFactory::getDocument();
$document->addCustomTag('<link href="'.JURI::root().'components/com_maianmedia/'.getTplPath($SETTINGS->homepage_url, 'css').'/mm_stylesheet.css" rel="stylesheet" type="text/css" />');

$HOMEPAGE = JText::_(_msg_public_header3);
$ARTISTS = JText::_(_msg_public_header4);
$CONTACT = JText::_(_msg_public_header5);
$ABOUT = JText::_(_msg_public_header6);
$SEARCH =JText::_(_msg_public_header7);
$LICENCE = JText::_(_msg_public_header12);
$FREE = JText::_(_msg_free_download);

$itemId = intval(JRequest::getVar('Itemid'));

$H_URL = JRoute::_('index.php?option=com_maianmedia&view=mostpop&Itemid='.$itemId);
$A_URL = JRoute::_('index.php?option=com_maianmedia&view=music&Itemid='.$itemId);
$C_URL = JRoute::_('index.php?option=com_maianmedia&view=contact&Itemid='.$itemId);
$P_URL = JRoute::_('index.php?option=com_maianmedia&view=about&Itemid='.$itemId);
$L_URL = JRoute::_('index.php?option=com_maianmedia&view=licence&Itemid='.$itemId);
$F_URL = JRoute::_('index.php?option=com_maianmedia&view=freebie&Itemid='.$itemId);

// Include the syndicate functions only once
require( JModuleHelper::getLayoutPath( 'mod_maianmenu' ) );
?>
