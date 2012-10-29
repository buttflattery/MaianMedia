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
?>

<form id="adminForm" action="index.php" method="post" name="adminForm">
	<fieldset style="background-color: #FFF" id="mm_custom"
		class="adminform">
		<legend>
		<?php echo MaianText::_( _msg_header3); ?>
		</legend>
		<div id="basic-accordian">
			<!--Parent of the Accordion-->
		<?php
		$db =& JFactory::getDBO();

		$db->setQuery("SELECT * FROM #__m15_pages") ;
		$pages = $db->loadObjectList();
		$isfirst = true;

		foreach ($pages as $page){
			$view= $this->getPage($page);
			$id = $isfirst? "":$page->id;
			$templateXMLFile = JPATH_COMPONENT_SITE.DS.'views'.DS.$view.DS.'metadata.xml';
			?>
			<div id="maian<?=$id?>-header"
				class="accordion_headings <?php echo $isfirst? 'header_highlight':''; ?>">
				<?=$page->description?>
			</div>
			<div id="maian<?=$page->id?>-content">
				<div class="accordion_child">
				<?php echo $this->renderSettings($templateXMLFile, $this->_SETTINGS->music);?>
				</div>
			</div>
			<?php
			$isfirst = false;
		}?>
		</div>
		<!--End of Parent of the Accordion-->
	</fieldset>
	<input type="hidden" name="id" value="1" /> <input type="hidden"
		name="option" value="com_maianmedia" /> <input type="hidden"
		name="task" value="tools" /> <input type="hidden" name="tool"
		value="menu-edit" /> <input type="hidden" name="controller"
		value="settings" />
</form>
<script type="text/javascript">
	new Accordian('basic-accordian',5,'header_highlight');
</script>
