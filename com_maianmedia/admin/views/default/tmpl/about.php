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
include_once(JPATH_COMPONENT.DS.'common'.DS.'Snoopy.class.php');

jimport( 'joomla.environment.uri' );
$uri =& JURI::getInstance();

$s = new Snoopy();
$s->read_timeout = 90;
$s->referer = $uri->root();

@$s->fetch('http://support.aretimes.com/versions/comprofilerversion.php?getstore=current');
$getStore = $s->results;

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

?>
<fieldset style="background-color: #FFF" id="maian_about">
	<div id="version_check"></div>
	<p>
	<?php echo MaianText::_( _msg_home); ?>
	</p>

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
					border="0" alt="Donate using Paypal" title="Donate using Paypal"> </a><br>
				<br>
			</td>

			<td><a href="http://www.aretimes.com/<?php echo $getStore; ?>"
				alt="Are Store"><img border="0"
					src="<?php echo $uri->root(); ?>administrator/components/com_maianmedia/images/about.png"></img>
			</a></td>
		</tr>
	</table>
	<br> <br>
	<table class="admintable">
		<tr>
			<td COLSPAN=2 width="100%" id="check" class="key"><?php echo MaianText::_( _setup24); ?>
			</td>
		</tr>
		<tr>
			<td width="20%">David Ian Bennett</td>
			<td width="60%"><a href="http://www.maianscriptworld.co.uk"
				title="Maian Script World" target="_blank">Maian Music 1.2</a></td>
		</tr>
		<tr>
			<td width="20%">John Glazebrook</td>
			<td width="60%"><a
				href="http://teethgrinder.co.uk/open-flash-chart-2"
				title="Open Flash Charts" target="_blank">Open Flash Charts 2</a></td>
		</tr>
		<tr>
			<td width="20%">DZ</td>
			<td width="60%"><a href="http://www.ofc2dz.com"
				title="Open Flash Charts - Patch" target="_blank">Open Flash Charts
					2 - Patch</a></td>
		</tr>
		<tr>
			<td width="20%">Erik Bosrup</td>
			<td width="60%"><a href="http://www.bosrup.com/web/overlib"
				title="overLIB 4.17" target="_blank">overLIB 4.17</a></td>
		</tr>
		<tr>
			<td width="20%">Timo Sack</td>
			<td width="60%"><a href="http://enlargeit.timos-welt.de"
				title="Enlarge IT" target="_blank">EnlargeIt! v1.1</a></td>
		</tr>
		<tr>
			<td width="20%">Aucune</td>
			<td width="60%"><a href="http://www.ajaxload.info"
				title="Loader Icons" target="_blank">Loader Icons</a></td>
		</tr>
		<tr>
			<td width="20%">Christoph Pojer</td>
			<td width="60%"><a href="http://cpojer.net"
				title="MooTools based FileManager" target="_blank">MooTools based
					FileManager 1.3.4</a></td>
		</tr>
		<tr>
			<td width="20%">Dezinerfolio</td>
			<td width="60%"><a href="http://www.dezinerfolio.com"
				title="Simple Javascript Accordions" target="_blank">Simple
					Javascript Accordions</a></td>
		</tr>
		<tr>
			<td width="20%">Michael Leibman</td>
			<td width="60%"><a href="https://github.com/mleibman/SlickGrid"
				title="Slick Grid" target="_blank">Slick Grid</a></td>
		</tr>
		<tr>
			<td width="20%">Jan Odvárko</td>
			<td width="60%"><a href="http://jscolor.com" title="JSColor"
				target="_blank">JSColor</a></td>
		</tr>
	</table>
	<br>
	<table class="admintable">
		<tr>
			<td COLSPAN=3 width="100%" id="check" class="key"><?php echo MaianText::_(_setup27); ?>
			</td>
		</tr>
		<?php
		// Load language files..
		$lang = opendir(JPATH_COMPONENT_SITE.DS.'lang'.DS);
		error_reporting (0);
		while ($READ = readdir($lang))
		{
			if ($READ != "." && $READ != ".." && $READ != "index.html" && $READ != ".svn"&&strstr($READ,'php')){
				$file_contents = file_get_contents(JPATH_COMPONENT_SITE.DS.'lang'.DS.$READ);
				echo '<tr><td width="30%">'.substr($READ,0, strrpos($READ, ".")).'</td><td width="30%">'.MaianText::getAuthor($file_contents).'</td><td  width="30%" ><a href="'.MaianText::getWebsite($file_contents).'">'.MaianText::getWebsite($file_contents).'</a></td></tr>';
			}
		}

		closedir($lang);?>
	</table>
	<br> <br>

	<table class="admintable">
		<tr>
			<td COLSPAN=2 width="100%" id="check" class="key"><?php echo MaianText::_(_setup28); ?>
			</td>
		</tr>
		<tr>
			<td width="40%">Fran&ccedil;ois Arbour and Gilles Arbour</td>
			<td width="40%"><a href="http://www.premiumbeat.com"
				title="Premium Beat" target="_blank">Premium Beat</a></td>
		</tr>
		<tr>
			<td width="40%">Alsacreations</td>
			<td width="40%"><a href="http://www.alsacreations.fr"
				title="Dewplayer" target="_blank">Dewplayer</a></td>
		</tr>
		<tr>
			<td width="40%">Eric</td>
			<td width="40%"><a href="http://flash-mp3-player.net/"
				title="Player Mp3" target="_blank">Player Mp3</a></td>
		</tr>
	</table>
	<br> <br>
	<table class="admintable" width="740px">
		<tr>
			<td COLSPAN=3 class="key"><?php echo MaianText::_(_msg_settings14); ?></td>
		</tr>
		<tr>
			<td><?php 
			echo '<p>To use this system you must have a paypal bussiness account<br>';
			echo 'Log in to your Paypal account and click "Profile" from the "My Account" menu tab.<br><br>';
			echo '<b>Click "Selling Preferences --> "Instant Payment Notification Preferences"</b><br>';
			echo '<p>On the next screen, click "Edit" and check the box to enable the IPN system and in the "Notification URL" box, enter the full URL to your notification page.<br><br>';
			echo '<b>'.$uri->root().'/index.php?option=com_maianmedia&amp;section=paypal&amp;view=notify</b><br><br>';
			echo 'From the "Profile" tab, select "Selling Preferences" --> "Website Payment Preferences" the URL for the auto return function is as follows:<br><br>';
			echo '<b>'.$uri->root().'/index.php?option=com_maianmedia&amp;section=paypal&amp;view=thanks</b><br><br>';
	echo 'Be sure to turn on "Auto Return" and "Payment Data Transfer".  Copy your pin for use in the application</p></div>';
?>
			</td>
		</tr>
	</table>
</fieldset>
