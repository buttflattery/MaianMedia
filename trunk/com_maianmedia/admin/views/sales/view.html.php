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
/**
 * Settings View
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class MaianViewSales extends MaianViewDefault
{
	/**
	 * display method of settings view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the data
		$sales =& $this->get('Data');

		$db =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_settings");
		$settings = $db->loadObjectList();

		JToolBarHelper::title( MaianText::_(_msg_header7), 'sales.png' );
		//JToolBarHelper::deleteList('delete', _msg_sales14 );
		JToolBarHelper::deleteList(MaianText::_(_msg_javascript33), "delete", MaianText::_(_msg_script8));

		$this->assignRef('settings', $settings[0]);
		$this->assignRef('sales', $sales);

		$document = &JFactory::getDocument();

		$document->addCustomTag('<link href="'.JURI::base().'components/com_maianmedia/utilities/slickgrid/css/slick.grid.css" rel="stylesheet" type="text/css" />');
		$document->addCustomTag('<link href="'.JURI::base().'components/com_maianmedia/utilities/slickgrid/css/slick.grid.custom.css" rel="stylesheet" type="text/css" />');
		$document->addCustomTag('<link href="'.JURI::base().'components/com_maianmedia/utilities/slickgrid/controls/slick.pager.css" rel="stylesheet" type="text/css" />');
		$document->addCustomTag('<link href="'.JURI::base().'components/com_maianmedia/utilities/slickgrid/controls/slick.columnpicker.css" rel="stylesheet" type="text/css" />');
		$document->addCustomTag('<link href="'.JURI::base().'components/com_maianmedia/utilities/slickgrid/css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />');
		$document->addCustomTag('<link href="'.JURI::base().'components/com_maianmedia/stylesheet.css" rel="stylesheet" type="text/css" />');

		$document->addScript(JURI::base().'components/com_maianmedia/utilities/slickgrid/lib/jquery-1.7.min.js');
		$document->addScript(JURI::base().'components/com_maianmedia/utilities/slickgrid/lib/jquery-ui-1.8.16.custom.min.js');
		$document->addScript(JURI::base().'components/com_maianmedia/utilities/slickgrid/lib/jquery.event.drag-2.0.min.js');

		$document->addScript(JURI::base().'components/com_maianmedia/utilities/slickgrid/slick.core.js');
		$document->addScript(JURI::base().'components/com_maianmedia/utilities/slickgrid/plugins/slick.rowselectionmodel.js');
		$document->addScript(JURI::base().'components/com_maianmedia/utilities/slickgrid/slick.grid.js');
		$document->addScript(JURI::base().'components/com_maianmedia/utilities/slickgrid/slick.dataview.js');
		$document->addScript(JURI::base().'components/com_maianmedia/utilities/slickgrid/controls/slick.pager.js');
		$document->addScript(JURI::base().'components/com_maianmedia/utilities/slickgrid/controls/slick.columnpicker.js');

		$document->addCustomTag('<link href="'.JURI::root().'media/system/css/modal.css" rel="stylesheet" type="text/css" />');
		$document->addScript(JURI::root().'media/system/js/modal.js');

		parent::display($tpl);
	}

	function displayGrid(){
		$find       = array('{customer_title}','{items_title}', '{sales_title}', '{sales_details}', '{contact_details}','{email}','{invoice}','{trans}','{pay_date}','{url}');
		$replace    = array(MaianText::_( _msg_sales41), MaianText::_( _msg_public_header4), MaianText::_( _msg_header7), MaianText::_( _msg_sales22),MaianText::_( _msg_sales23),MaianText::_( _msg_sales34),MaianText::_(_msg_sales45), MaianText::_(_msg_sales44), MaianText::_(_msg_sales35), JURI::base());
		$tpl 		= file_get_contents(JPATH_COMPONENT.DS.'views'.DS.'sales'.DS.'tmpl'.DS.'grid.js');

		return str_replace($find,$replace, $tpl);

	}
}