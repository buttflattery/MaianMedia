<?php
/**
 * @version		$Id: maianaio.php 10381 2008-06-01 03:35:53Z alao $
 * @package		Joomla
 * @copyright	All rights reserved.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

class JElementSingle extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Album';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$db =& JFactory::getDBO();

		$query = 'SELECT id, name'
		. ' FROM #__m15_albums'
		. ' WHERE status = \'1\' AND is_album = "1"'
		. ' ORDER BY name'
		;
		$db->setQuery( $query );
		$options = $db->loadObjectList();

		array_unshift($options, JHTML::_('select.option', '0', '- '.JText::_('Select Album').' -', 'name', 'name'));

		return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', 'class="inputbox"', 'name', 'name', $value, $control_name.$name );
	}
}
