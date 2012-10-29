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
/* TODO Snoppy should move to the utilities folder */
require_once(JPATH_COMPONENT.DS.'common'.DS.'Snoopy.class.php');

jimport( 'joomla.environment.uri' );
$uri =& JURI::getInstance();

$s = new Snoopy();
$s->read_timeout = 90;
$s->referer = $uri->root();

@$s->fetch('http://support.aretimes.com/versions/comprofilerversion.php?getstore=current');
$getStore = $s->results;

JToolBarHelper::title(   MaianText::_('Tools'), 'tools.png' );

$db =& JFactory::getDBO();
$db->setQuery("SELECT * FROM #__m15_settings");
$SETTINGS = $db->loadObject();

$document = &JFactory::getDocument();
$document->addCustomTag('<link href="components/com_maianmedia/stylesheet.css" rel="stylesheet" type="text/css" />');
$document->addScript( 'components/com_maianmedia/js/request.js' );
$document->addCustomTag('
<script type="text/javascript">
	function versionCheck(){
		ajaxRequest(\'version_check\', \'index.php?option=com_maianmedia&task=getVersion&format=raw\', 0);
	}
	
	window.setTimeout(\'versionCheck()\', 1000);
</script>


');

JHTML::_('behavior.modal', 'a.modal');

$db->setQuery("SELECT * FROM #__mm_settings");
$settings = $db->loadObject();

?>
<form style="background-color: #FFF" id="adminForm"
	enctype="multipart/form-data" action="index.php" method="post"
	name="adminForm">
	<fieldset id="maian_about">

		<div id="choices" style="float: left;">
			<div class="icon">
				<a
					href="index.php?option=com_maianmedia&amp;task=tools&amp;tool=custom">

					<img
					src="<?php echo $uri->root(); ?>/administrator/components/com_maianmedia/images/template.png"
					alt="<?php echo MaianText::_( _setup25); ?>" /> <span><?php echo MaianText::_( _setup25); ?>
				</span> </a>
			</div>
			<div class="icon">
				<a
					href="index.php?option=com_maianmedia&amp;task=tools&amp;tool=menu-edit">

					<img
					src="<?php echo $uri->root(); ?>/administrator/components/com_maianmedia/images/menu-edit.png"
					alt="<?php echo MaianText::_(_msg_backup); ?>" /> <span><?php echo MaianText::_(_msg_header9); ?>
				</span> </a>
			</div>
			<div class="icon">
				<a class="modal"
					href="index.php?option=com_maianmedia&amp;task=tools&amp;format=raw&amp;tool=system_view"
					rel="{handler: 'iframe', size: {x: 570, y: 400}}"> <img
					src="<?php echo $uri->root(); ?>/administrator/components/com_maianmedia/images/systemsettings.png"
					alt="<?php echo MaianText::_( _setup26); ?>" /> <span><?php echo MaianText::_( _setup26); ?>
				</span> </a>
			</div>

			<div class="icon">
				<a class="modal"
					href="index.php?option=com_maianmedia&amp;task=tools&amp;format=raw&amp;tool=backup_view"
					rel="{handler: 'iframe', size: {x: 570, y: 400}}"> <img
					src="<?php echo $uri->root(); ?>/administrator/components/com_maianmedia/images/backup.png"
					alt="<?php echo MaianText::_(_msg_backup); ?>" /> <span><?php echo MaianText::_(_msg_backup); ?>
				</span> </a>
			</div>
			<?php if(isset($settings)){ ?>
			<div class="icon">

				<a class="modal"
					href="index.php?option=com_maianmedia&amp;task=tools&amp;format=raw&amp;tool=import_view"
					rel="{handler: 'iframe', size: {x: 570, y: 400}}"> <img
					src="<?php echo $uri->root(); ?>/administrator/components/com_maianmedia/images/insert_table.png"
					alt="<?php echo MaianText::_( _setup23); ?>" /> <span><?php echo MaianText::_( _setup23); ?>
				</span> </a>

			</div>
			<?php }?>
			<!-- div class="icon">
				<a class="modal" href="index.php?option=com_maianmedia&amp;task=tools&amp;format=raw&amp;tool=update_view" rel="{handler: 'iframe', size: {x: 620, y: 425}}" >

					<img src="<?php echo $uri->root(); ?>/administrator/components/com_maianmedia/images/update.png" alt="<?php echo MaianText::_(_msg_update); ?>"  />					
					<span><?php echo MaianText::_(_msg_update); ?></span></a>
		</div-->
		</div>

		<div id="mm_check">
			<table class="admintable">
				<tr>
					<td COLSPAN=2 width="100%" id="check" class="key"><?php echo MaianText::_( _setup17); ?>
					</td>
				</tr>
				<tr>
					<td><b><?php echo MaianText::_( _setup16); ?> </b> v<?php echo phpversion(); ?>
					</td>
					<td><span class="info"><b><?php echo (phpversion()>'4.3.0' ? MaianText::_(_setup19) : MaianText::_(_setup22)); ?>
						</b> </span></td>
				</tr>
				<tr>
					<td><b><?php echo MaianText::_( _setup15); ?> </b></td>
					<td><span class="info"><b><?php echo (function_exists('curl_setopt') ? MaianText::_(_setup19) : MaianText::_(_setup20)); ?>
						</b> </span></td>
				</tr>
				<tr>
					<td><b><?php echo MaianText::_( _setup18); ?> </b></td>
					<td><span class="info"><b><?php echo (function_exists('imagecreatetruecolor') ? MaianText::_(_setup19) : MaianText::_(_setup20)); ?>
						</b> </span></td>
				</tr>
				<tr>
					<td><b><?php echo MaianText::_('PHP: max_input_time'); ?> </b></td>
					<td><span class="info"><b><?php echo ini_get("max_input_time"); ?>
						</b> </span></td>
				</tr>
				<tr>
					<td><b><?php echo MaianText::_('PHP: memory_limit'); ?> </b></td>
					<td><span class="info"><b><?php echo ini_get("memory_limit"); ?> </b>
					</span></td>
				</tr>
				<tr>
					<td><b><?php echo MaianText::_('PHP: file_uploads'); ?> </b></td>
					<td><span class="info"><b><?php echo ini_get("file_uploads")== 1?'<font style="color:green">On</font>':'<font style="color:red">Off</font>'; ?>
						</b> </span></td>
				</tr>
				<tr>
					<td><b><?php echo MaianText::_('PHP: upload_max_filesize'); ?> </b></td>
					<td><span class="info"><b><?php echo ini_get("upload_max_filesize"); ?>
						</b> </span></td>
				</tr>
			</table>
			<br>


			<table class="admintable" width="50%">
				<tr>
					<td class="key"><?php echo MaianText::_( _msg_home5); ?>
						<div id="version_check"></div>
					</td>
				</tr>
				<tr>
					<td align="left"><?php 

					$db->setQuery("SELECT SUM(fee) AS p_fee,SUM(gross) AS p_gross
                            FROM #__m15_paypal
                            WHERE active_cart = '1'");	  
					$PP = $db->loadObject();
					$find     = array('{tracks}','{albums}','{fees}','{profit}','{a_purchases}','{t_purchases}');
					$replace  = array(number_format(getTableRowCount('tracks')),
					number_format(getTableRowCount('albums')),
					get_cur_symbol(number_format($PP->p_fee,2),$SETTINGS->paypal_currency),
					get_cur_symbol(number_format($PP->p_gross-$PP->p_fee,2),$SETTINGS->paypal_currency),
					number_format(getTableRowCount('purchases',' WHERE SUBSTRING(item_id,1,1)=\'a\' AND track_id = \'0\'')),
					number_format(getTableRowCount('purchases',' WHERE SUBSTRING(item_id,1,1)=\'t\''))
					);
					$text = str_replace($find,$replace, _msg_home6);
					echo MaianText::_($text);

					?>
					</td>
				</tr>
			</table>
			<br>
			<table class="admintable">
				<tr>
					<td COLSPAN=2 class="key"><?php echo MaianText::_( _msg_home2); ?></td>
				</tr>
				<tr>
					<td><?php echo MaianText::_( _msg_home3); ?><br> <br> <a
						href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=alaoa%40sbcglobal%2enet&item_name=Are%20Times&item_number=AreDonation-<?php echo date("Y"); ?>&no_shipping=0&no_note=1&tax=0&currency_code=USD&lc=US&bn=PP%2dDonationsBF&charset=UTF%2d8"
						target="_blank"><img
							src="<?php echo $uri->root(); ?>administrator/components/com_maianmedia/images/donation.gif"
							border="0" alt="Donate using Paypal" title="Donate using Paypal">
					</a><br> <br>
					</td>
					<td><a href="http://www.aretimes.com/<?php echo $getStore; ?>"
						alt="Are Store"><img border="0"
							src="<?php echo $uri->root(); ?>administrator/components/com_maianmedia/images/about.png"></img>
					</a></td>
				</tr>
			</table>
		</div>
	</fieldset>
</form>
