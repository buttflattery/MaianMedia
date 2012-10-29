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

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

/**
 * Hello Model
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class MaianModelCategory extends JModel
{
	/**
	 * Hellos data array
	 *
	 * @var array
	 */
	var $_data;

	function __construct()
	{
		parent::__construct();

		$mainframe = &JFactory::getApplication();

		// Get pagination request variables
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');

		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}


	/**
	 * Returns the query
	 * @return string The query to be used to retrieve the rows from the database
	 */
	function _buildQuery()
	{
		$mainframe = &JFactory::getApplication();
		$limit = $mainframe->getUserStateFromRequest("com_maianmedia.limit", 'limit', 5, 'int');
		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
		 
		if($limit != '0'){
			$query = ' SELECT * '
			. ' FROM #__m15_categories where section = \'com_maianmedia\' ORDER BY ordering
            			LIMIT '.$limitstart.','.$limit;
		}else{
			$query = ' SELECT * '
			. ' FROM #__m15_categories where section = \'com_maianmedia\' ORDER By ordering';
		}
		 
		 
		$db =& JFactory::getDBO();
		$db->setQuery('SELECT * FROM #__m15_categories where section = \'com_maianmedia\'');
		$count = count($db->loadObjectList());

		JRequest::SetVar('pagnation', $count);

		return $query;
	}

	function store()
	{
		$catTable =& $this->getTable();

		$data = JRequest::get( 'post' );

		if(!isset($_POST['alias'])){
			$_POST['alias'] = str_replace( ' ', '_', $_POST['title']);
		}else{
			$_POST['alias'] = str_replace( ' ', '_', $_POST['alias']);
		}

		if(!isset($_POST['ordering'])){
				
			$db =& JFactory::getDBO();
				
			$db->setQuery('SELECT * FROM #__m15_categories where section = \'com_maianmedia\'');
			$categories = $db->loadObjectList();
				
			$_POST['ordering'] = count($categories) + 1;
		}

		// Bind the form fields to the settings table
		if (!$catTable->bind($_POST)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the settings record is valid
		if (!$catTable->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the web link table to the database
		if (!$catTable->store()) {
			$this->setError( $this->_db->getErrorMsg());
			return false;
		}

		return true;
	}

	/**
	 * Retrieves the hello data
	 * @return array Array of objects containing the data from the database
	 */
	function getData()
	{
		// Lets load the data if it doesn't already exist
		if (empty( $this->_data ))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList( $query );
		}

		return $this->_data;
	}

	function delete()
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$row =& $this->getTable();

		if (count( $cids )) {
			foreach($cids as $cid) {
				if (!$row->delete( $cid )) {
					$this->setError( $row->getErrorMsg() );
					return false;
				}
			}
		}
		return true;
	}

}

?>