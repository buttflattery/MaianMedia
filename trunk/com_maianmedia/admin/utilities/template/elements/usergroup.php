<?php
/**
 * @version		$Id: usergroup.php 10381 2008-06-01 03:35:53Z pasamio $
 * @package		Joomla.Framework
 * @subpackage	Parameter
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Renders a editors element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JElementUserGroup
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Editors';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$acl	=& JFactory::getACL();
		$gtree	= $acl->get_group_children_tree( null, 'USERS', false );
		$ctrl	= $control_name .'['. $name .']';

		$attribs	= ' ';
		if ($v = $node->attributes('size')) {
			$attribs	.= 'size="'.$v.'"';
		}
		if ($v = $node->attributes('class')) {
			$attribs	.= 'class="'.$v.'"';
		} else {
			$attribs	.= 'class="inputbox"';
		}
		if ($m = $node->attributes('multiple'))
		{
			$attribs	.= 'multiple="multiple"';
			$ctrl		.= '[]';
			//$value		= implode( '|', )
		}
		//array_unshift( $editors, JHTML::_('select.option',  '', '- '. MaianText::_( 'Select Editor' ) .' -' ) );

		return JHTML::_('select.genericlist',   $gtree, $ctrl, $attribs, 'value', 'text', $value, $control_name.$name );
	}
}
