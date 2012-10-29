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
class MaianModelTracks extends JModel
{
	/**
	 * Hellos data array
	 *
	 * @var array
	 */
	var $_data;
	var $tracksAdded = 0;

	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}

	/**
	 * Returns the query
	 * @return string The query to be used to retrieve the rows from the database
	 */
	function _buildQuery()
	{
		return ' SELECT * '
		. ' FROM #__m15_tracks';
	}

	function _buildAlbumQuery()
	{
		$mainframe = &JFactory::getApplication();
			
		$limit = $mainframe->getUserStateFromRequest("com_maianmedia.limit", 'limit', 5, 'int');
		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
			
		$query = "SELECT * FROM #__m15_albums WHERE is_album = '1'";

		if(JRequest::getVar('fnc')){

			$query = $query.$this->sortBy();
		}
			
		if($limit != '0'){
			$query = $query ." LIMIT $limitstart,$limit";
		}
			
			
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_albums WHERE is_album = '1'");
		$count = count($db->loadObjectList());

		JRequest::SetVar('pagnation', $count);

		return $query;
	}



	function sortBy()
	{
		$sql=null;
		switch(JRequest::getVar('order')){

			case 'artist_desc':   $sql = " ORDER BY artist DESC ";         break;
			case 'artist_asc':    $sql = " ORDER BY artist ";              break;
			case 'name_asc':     $sql = " ORDER BY name  ";         break;
			case 'name_desc':    $sql = " ORDER BY name DESC ";    break;

		}
			
		return $sql;
	}

	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	function store()
	{
		$trackTable =& $this->getTable();

		$data = JRequest::get( 'post' );

		// Bind the form fields to the table
		if (!$trackTable->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the  record is valid
		if (!$trackTable->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the web link table to the database
		if (!$trackTable->addTracks($data)) {
			$this->tracksAdded = $trackTable->tracksAdded;
			$this->setError( $this->_db->getErrorMsg());
			return false;
		}
		$this->tracksAdded = $trackTable->tracksAdded;
		return true;
	}

	function update()
	{
		$trackTable =& $this->getTable();

		$data = JRequest::get( 'post' );

		// Store the web link table to the database

		// Bind the form fields to the table
		if (!$trackTable->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the  record is valid
		if (!$trackTable->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		if (!$trackTable->update($data)) {
			$this->tracksAdded = $trackTable->tracksAdded;
			$this->setError( $this->_db->getErrorMsg());
			return false;
		}
		//$this->tracksAdded = $trackTable->tracksAdded;
		return true;
	}

	function delete()
	{
		//$cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );
		$cid = JRequest::getVar('deleteThis');
		$track =& $this->getTable();
		if (!$track->delete( $cid )) {
			$this->setError( $row->getErrorMsg() );
			return false;
		}

		return true;
	}

	/**
	 * Retrieves album data
	 * @return array Array of objects containing the data from the database
	 */
	function &getAlbums()
	{
		if (empty( $this->_data ))
		{
			$query = $this->_buildAlbumQuery();
			$this->_data = $this->_getList( $query );
		}

		return $this->_data;
	}
}

?>