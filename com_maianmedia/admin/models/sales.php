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
class MaianModelSales extends JModel
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
		$mainframe = &JFactory::getApplication();
		$limit = $mainframe->getUserStateFromRequest("com_maianmedia.limit", 'limit', 5, 'int');
		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
			
		$query = " SELECT *,DATE_FORMAT(pay_date,'%e %b %Y') AS p_date"
		. " FROM #__m15_paypal where active_cart='1'";

		if(JRequest::getVar('fnc')){

			$query = $query.$this->sortBy();
		}

		if($limit != '0'){
			$query = $query ." LIMIT $limitstart,$limit";
		}

		$db =& JFactory::getDBO();
		$db->setQuery(" SELECT *,DATE_FORMAT(pay_date,'%e %b %Y') AS p_date"
		. " FROM #__m15_paypal where active_cart='1'");
		$count = count($db->loadObjectList());

		JRequest::SetVar('pagnation', $count);
			
		return $query;
	}

	function sortBy()
	{
		$sql=null;
		switch(JRequest::getVar('order')){

			case 'date_desc':    $sql = " ORDER BY pay_date DESC ";      break;
			case 'date_asc':     $sql = " ORDER BY pay_date ";           break;
			case 'tracks':       $sql = " ORDER BY total_tracks DESC ";  break;
			case 'downloads':    $sql = " ORDER BY total_albums DESC ";  break;
			case 'gross_desc':   $sql = " ORDER BY gross DESC ";         break;
			case 'gross_asc':    $sql = " ORDER BY gross ";              break;
			case 'name_asc':     $sql = " ORDER BY first_name ";         break;
			case 'name_desc':    $sql = " ORDER BY first_name DESC ";    break;

		}
			
		return $sql;
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
			$this->_data = $this->_getList( $query );
		}

		return $this->_data;
	}

	function delete()
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$database =& JFactory::getDBO();

		if (count( $cids )) {
			foreach($cids as $cid) {

				$database->setQuery('Select * FROM #__m15_paypal WHERE id='.$cid);
				$PAYPAL = $database->loadObject();

				if (isset($PAYPAL)) {

					$database->setQuery("DELETE FROM #__m15_paypal WHERE id = '{$cid}' LIMIT 1") ;	$database->query();
					$database->setQuery("DELETE FROM #__m15_purchases WHERE cart_code = '{$PAYPAL->cart_code}'") ;	$database->query();

				}else{
					return false;
				}
			}
		}
		return true;
	}

}

?>