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

/**
 * Hello Table class
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class TableCategory extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	var $parent_id = null;
	var $title  = null;
	var $name  = null;
	var $alias  = null;
	var $image  = null;
	var $section  = null;
	var $image_position  = null;
	var $description  = null;
	var $published 	 = null;
	var $checked_out  = null;
	var $checked_out_time  = null;
	var $editor  = null;
	var $ordering  = null;
	var $access  = null;
	var $count  = null;
	var $params = null;


	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableCategory(& $db) {
		parent::__construct('#__m15_categories', 'id', $db);
	}
}