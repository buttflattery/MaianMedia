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
		<?php echo MaianText::_( _msg_settings23); ?>
		</legend>
		<?php
		// instantiate new tab system
		//$tabs = new mosTabs(1);
		jimport('joomla.html.pane');
		$editor =& JFactory::getEditor();
		$tabs =& JPane::getInstance('tabs', array('startOffset'=>0));

		// start tab pane
		echo $tabs->startPane("TabPaneOne");

		$db =& JFactory::getDBO();

		$db->setQuery("SELECT * FROM #__m15_pages") ;
		$pages = $db->loadObjectList();

		foreach ($pages as $page){
			//First tab

			echo $tabs->startPanel(MaianText::_($page->description),$page->name."-page");
			echo $editor->display($page->name, cleanData($page->text), '550', '400', '60', '20', true);
			echo $tabs->endPanel();
		}

		// end tab pane
		echo $tabs->endPane("TabPaneOne");
		echo '<br>';
		?>
	</fieldset>
	<input type="hidden" name="id" value="1" /> <input type="hidden"
		name="option" value="com_maianmedia" /> <input type="hidden"
		name="task" value="tools" /> <input type="hidden" name="tool"
		value="custom" /> <input type="hidden" name="controller"
		value="settings" />
</form>
