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

class MaianViewStats extends MaianViewDefault
{

	function getChart()
	{

		// generate some random data:

		$sid = JRequest::getVar( 'sid' );

		srand((double)microtime()*1000000);

		$max = 50;
		$data = array();
		for( $i=0; $i<12; $i++ )
		{
			$data[] = rand(0,$max);
		}

		require_once(JPATH_COMPONENT.DS.'utilities'.DS.'charts'.DS.'php-ofc-library'.DS.'open-flash-chart.php');

		// generate some random data
		srand((double)microtime()*1000000);

		$max = 20;
		$tmp = array();
		for( $i=0; $i<9; $i++ )
		{
			$tmp[] = rand(0,$max);
		}

		$title = new title( date("D M d Y") );

		$bar = new bar();
		$bar->set_values( array(1,2,3,4,5,6,7,8,9) );

		$chart = new open_flash_chart();
		$chart->set_title( $sid );
		$chart->add_element( $bar );

		//echo $chart->toPrettyString();
		return $chart->toString();
	}

	/**
	 * display method of settings view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the data
		//$sales =& $this->get('Data');

		$db =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_settings");
		$settings = $db->loadObjectList();

		JToolBarHelper::title(   MaianText::_(_msg_header11), 'stats.png' );
		//JToolBarHelper::deleteList('delete', _msg_sales14 );
		$this->assignRef('settings', $settings[0]);
		//$this->assignRef('sales', $sales);
		$this->assignRef('sales', $this->getChart());
		parent::display($tpl);
	}

}