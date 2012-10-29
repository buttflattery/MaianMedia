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

$uri =& JURI::getInstance();
$settings = $this->_SETTINGS;
?>
<form id="adminForm" action="index.php" method="post"  name="adminForm">
	<fieldset style="background-color: #FFF">
		<div style="width: 1050px;" class="slickGridContainer">
			<div class="grid-header" style="width: 100%">
				<span style="float: right" class="ui-icon ui-icon-search"
					title="Toggle search panel" onclick="toggleFilterRow()"></span>
			</div>
			<div id="myGrid" style="width: 100%; height: 500px;"></div>
			<div id="pager" style="width: 100%; height: 20px;"></div>
			<div id="inlineFilterPanel"
				style="display: none; background: #dddddd; padding: 3px; color: black;">
				<?php echo MaianText::_(_msg_items41); ?>
				<input class="formBox" type="text" id="name" name="name"
					maxlength="250" size="30" value="">
			</div>
			<script>
    		<?=$this->displayGrid();?>
    	</script>
		</div>
	</fieldset>
	<input type="hidden" name="option" value="com_maianmedia" /> <input
		type="hidden" name="task" value="" /> <input type="hidden"
		name="controller" value="items" /> <input type="hidden"
		name="boxchecked" value="0" /> <input type="hidden" name="view"
		value="items" />
		<?php echo JHTML::_( 'form.token' ); ?>

</form>
