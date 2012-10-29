<?php
/**
 * @version		$Id: maianaio.php 10381 2008-06-01 03:35:53Z alao $
 * @package		Joomla
 * @copyright	All rights reserved.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.html.html');
jimport('joomla.form.formfield');//import the necessary class definition for formfield

class JFormFieldArtist extends  JFormField
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'MaianAio';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$db =& JFactory::getDBO();

		$query = 'SELECT DISTINCT artist'
		. ' FROM #__m15_albums'
		. ' WHERE status = \'1\''
		. ' ORDER BY artist'
		;
		$db->setQuery( $query );
		$options = $db->loadObjectList();

		array_unshift($options, JHTML::_('select.option', '0', '- '.JText::_('Select Artist').' -', 'artist', 'artist'));

		return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', 'class="inputbox"', 'artist', 'artist', $value, $control_name.$name );
	}
}
