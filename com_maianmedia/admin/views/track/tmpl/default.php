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


$db =& JFactory::getDBO();
include_once(JPATH_COMPONENT.DS.'common'.DS.'functions.php');

$dir = isset($_GET['dir']) ? ($_GET['dir']) : 'tmp';
$db->setQuery("SELECT * FROM #__m15_settings Limit 1");

$uri =& JURI::getInstance();
$SETTINGS = $db->loadObject();
//$assets = str_replace('\\', '//', JPATH_COMPONENT.DS.'utilities'.DS.'filemanager'.DS.'Assets');

$sessionid = $this->getFormattedSession();

$this->initManager();

$db->setQuery("Select * from #__m15_settings Limit 1");

$settings = $db->loadObject();

$mp3 = $settings->mp3_path;

$preview = JPATH_SITE.$settings->preview_path;

$preview = str_replace('\\', '//', $preview);

$mp3 = str_replace('\\', '//', $mp3);

JHTML::_('behavior.formvalidation');
?>

<?php echo MaianText::_(_msg_add); ?>

<form id="adminForm" action="index.php" enctype="multipart/form-data"
	method="post" name="adminForm">
	<div id='props'></div>
	<div></div>

	<div id="mm_tracks">
		<fieldset style="background-color: #FFF" id="ajaxTracks"
			class="adminform">
			<legend>
			<?php echo MaianText::_(_msg_header5); ?>
			</legend>
			<select id="total" name="total"
				onchange="ajaxRequest('tracks', 'index.php?option=com_maianmedia&format=raw&controller=tracks&task=getTracks&num='+this.value, 1,'<?php echo $mp3;?>','<?php echo $preview;?>','<?php echo $sessionid;?>',this.value,'<?php echo $this->getLang();?>');">
				<option value="0">---</option>
				<?php
				for ($i=1; $i<30+1; $i++)
				{
					echo '<option value="'.$i.'" style="padding-left:3px">'.$i.'</option>'."\n";
				}
				?>
			</select>&nbsp;
			<?php echo MaianText::_(_msg_add3); ?>
			<div id="tracks"></div>
		</fieldset>
	</div>

	<input type="hidden" name="option" value="com_maianmedia" /> <input
		type="hidden" name="task" value="" /> <input type="hidden"
		name="boxchecked" value="0" /> <input type="hidden" name="controller"
		value="tracks" />
</form>
