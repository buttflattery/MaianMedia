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
class TableAlbum extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;
	var $artist = null;
	var $name = null;
	var $image = null;
	var $dimensions_height = null;
	var $dimensions_width = null;
	var $artwork = null;
	var $comments = null;
	var $status = null;
	var $addDate = null;
	var $keywords = null;
	var $downloads = null;
	var $hits = null;
	var $rss_date = null;
	var $cat = null;
	var $parent = null;
	var $discount = null;
	var $upc = null;
	var $RM = null;
	var $discount_type = null;
	var $zip = null;
	var $label = null;
	var $physical = null;
	var $user = null;
	var $is_album = null;
	var $params = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableAlbum(& $db) {
		parent::__construct('#__m15_albums', 'id', $db);
	}
}