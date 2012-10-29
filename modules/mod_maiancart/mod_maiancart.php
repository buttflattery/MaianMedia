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

include_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'classes'.DS.'class_generic.inc.php');
include_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'classes'.DS.'class_cart.inc.php');

$db =& JFactory::getDBO();
$db->setQuery("SELECT * FROM #__m15_settings LIMIT 1");
$SETTINGS = $db->loadObject();

$MM_CART              = new mm_Cart();
$CART_COUNT = ($MM_CART->cartCount()>0 ? '<b style="font-size: large;">'.$MM_CART->cartCount().'</b>' : $MM_CART->cartCount());
$CART_TOTAL = ($MM_CART->cartCount()>0 ? '<i>'.get_cur_symbol($MM_CART->cartTotal(), $SETTINGS->paypal_currency).'</i>':get_cur_symbol($MM_CART->cartTotal(), $SETTINGS->paypal_currency));

// Include the syndicate functions only once
require( JModuleHelper::getLayoutPath( 'mod_maiancart' ) );


?>
