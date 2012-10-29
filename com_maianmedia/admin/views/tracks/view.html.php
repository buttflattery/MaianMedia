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

jimport( 'joomla.application.component.view' );
require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'view.html.php');

class MaianViewTracks extends MaianViewDefault
{
	/**
	 * display method of settings view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the data
		$albums =& $this->get('Albums');

		JToolBarHelper::title(   MaianText::_(_msg_header6), 'tracks.png' );
		//JToolBarHelper::addNewX();
		//JToolBarHelper::editListX();
		//JToolBarHelper::deleteList();

		$this->assignRef('albums', $albums);

		parent::display($tpl);
	}
}