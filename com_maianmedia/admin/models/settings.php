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
class MaianModelSettings extends JModel
{
	/**
	 * Hellos data array
	 *
	 * @var array
	 */
	var $_data;

	/**
	 * Returns the query
	 * @return string The query to be used to retrieve the rows from the database
	 */
	function _buildQuery()
	{
		$query = ' SELECT * '
		. ' FROM #__m15_settings limit 1';
		return $query;
	}

	function store()
	{
		$settingsTable =& $this->getTable();

		if(isset($_POST['language'])){
			$_POST['language'] = $_POST['language'].'.php';
		}

		$data = JRequest::get('post');

		$tools = JRequest::getVar( 'tool');
		if(isset($tools) && $tools == "custom"){
			$about = JRequest::getVar('about', '', 'post', 'string', JREQUEST_ALLOWRAW);
			$music = JRequest::getVar('music', '', 'post', 'string', JREQUEST_ALLOWRAW);
			$licence = JRequest::getVar('licence', '', 'post', 'string', JREQUEST_ALLOWRAW);
			$freeText = JRequest::getVar('freeText', '', 'post', 'string', JREQUEST_ALLOWRAW);
				
			$db =& JFactory::getDBO();
			$db->setQuery( "UPDATE #__m15_pages SET text = '$about' WHERE id = '1'" );
			$db->query();
				
			$db->setQuery( "UPDATE #__m15_pages SET text = '$licence' WHERE id = '2'" );
			$db->query();
				
			$db->setQuery( "UPDATE #__m15_pages SET text = '$music' WHERE id = '3'" );
			$db->query();
				
			$db->setQuery( "UPDATE #__m15_pages SET text = '$freeText' WHERE id = '4'" );
			$db->query();
				
			return true;
		}elseif(isset($tools) && $tools == "menu-edit"){
			$params = JRequest::getVar('params');
			$this->updateMenuParams($params);
			return true;
		}

		// Bind the form fields to the settings table
		if (!$settingsTable->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the settings record is valid
		if (!$settingsTable->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the web link table to the database
		if (!$settingsTable->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		return true;
	}

	/**
	 * Retrieves the settings data
	 * @return array Array of objects containing the data from the database
	 */
	function getData()
	{
		// Lets load the data if it doesn't already exist
		if (empty( $this->_data ))
		{
			$query = $this->_buildQuery();
			$this->_db->setQuery( $query );

			//$this->_data = $this->_getList( $query );
			$this->_data = $this->_db->loadObject();

		}

		return $this->_data;
	}

	function updatePlayerParams($params){
		$lines = "";
		$bool = true;

		foreach ($params  as $k => $v)
		{
			if($bool){
				$lines =$k.'='.$v;
				$bool = false;
			}else{
				$lines .="\r\n".$k.'='.$v;
			}

		}

		$db =& JFactory::getDBO();

		$db->setQuery("UPDATE #__m15_settings SET player_params='$lines' WHERE id='1';");
		$db->query();

	}

	function updateMenuParams($params){
		$lines = "";
		$bool = true;

		foreach ($params  as $k => $v)
		{
			if($bool){
				$lines =$k.'='.$v;
				$bool = false;
			}else{
				$lines .="\r\n".$k.'='.$v;
			}

		}

		$db =& JFactory::getDBO();

		$db->setQuery("UPDATE #__m15_settings SET music='$lines' WHERE id='1';");
		$db->query();

	}
}

?>