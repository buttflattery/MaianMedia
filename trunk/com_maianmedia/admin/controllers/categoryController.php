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

jimport('joomla.application.component.controller');

/**
 * Hello World Component Controller
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class MaianControllerCategory extends MaianControllerDefault
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'add'  , 	'edit' );
	}

	/* save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		$model = $this->getModel('category');

		if ($model->store($post)) {
			$msg = MaianText::_( 'Category Added!' );
		} else {
			$msg = MaianText::_( 'There was an error saving this category' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_maianmedia&controller=category&view=category';
		$this->setRedirect($link, $msg);
	}

	function saveOrder(){
		// Initialize variables
		$db =& JFactory::getDBO();

		$cid = JRequest::getVar('cid');
		$total		= count( $cid );
		$order 		= JRequest::getVar( 'order', array(0), 'post', 'array' );


		JArrayHelper::toInteger($order, array(0));
		$row		=& JTable::getInstance('category');
		$groupings = array();

		// update ordering values
		for( $i=0; $i < $total; $i++ ) {
			$row->load( (int) $cid[$i] );
			// track sections
			$groupings[] = $row->section;
			if ($row->ordering != $order[$i]) {
				$row->ordering = $order[$i];
				if (!$row->store()) {
					JError::raiseError(500, $db->getErrorMsg());
				}
			}
		}

		// execute updateOrder for each parent group
		$groupings = array_unique( $groupings );
		foreach ($groupings as $group){
			$row->reorder('section = '.$db->Quote($group));
		}

		$msg 	= MaianText::_( 'New ordering saved' );

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_maianmedia&controller=category&view=category';
		$this->setRedirect($link, $msg);
	}

	function remove()
	{
		$model = $this->getModel('category');
		if(!$model->delete()) {
			$msg = MaianText::_( 'Error: One or More Categories Could not be Deleted' );
		} else {
			$msg = MaianText::_( 'Category(s) Deleted' );
		}

		$link = 'index.php?option=com_maianmedia&controller=category&view=category';
		$this->setRedirect($link, $msg);
	}

	function edit()
	{
		JRequest::setVar( 'view', 'category' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		$document = &JFactory::getDocument();
		$document->addCustomTag('<link href="components/com_maianmedia/stylesheet.css" rel="stylesheet" type="text/css" />');

		$id = JRequest::getVar( 'cid', '0', 'REQUEST');

		$db =& JFactory::getDBO();
		$db->setQuery('SELECT * FROM #__m15_categories where section = \'com_maianmedia\' and id='.$id[0]);

		$cat = $db->loadObject();
		$isNew = false;

		if(isset($cat)){
			$isNew	= ($cat->id < 1);
		}else{
			$isNew = true;
		}


		JRequest::setVar( 'singlecat', $cat );

		$text = $isNew ? MaianText::_('New') : MaianText::_( 'Edit' );
		JToolBarHelper::title(MaianText::_(_msg_categories1 ).': <small><small>[ ' . $text.' ]</small></small>', 'cat.png' );
		JToolBarHelper::save();
		JToolBarHelper::apply();

		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		parent::display();
	}
	function cancel()
	{
		$msg = MaianText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_maianmedia&controller=category&view=category', $msg );
	}

	function unpublish_cat($mode)
	{
		$db =& JFactory::getDBO();
		$id = JRequest::getVar( 'cid', '0', 'POST' );

		$query = 'UPDATE #__m15_categories SET published = "0" WHERE id ='.$id[0];
		$db->setQuery($query);
		$db->query();

		$msg = MaianText::_( 'Category UnPublished' );
		$this->setRedirect( 'index.php?option=com_maianmedia&controller=category&view=category', $msg );
	}

	function publish_cat($mode)
	{
		$db =& JFactory::getDBO();
		$id = JRequest::getVar( 'cid', '0', 'POST' );

		$query = 'UPDATE #__m15_categories SET published = \'1\' WHERE id ='.$id[0];
		$db->setQuery($query);
		$db->query();

		$msg = MaianText::_( 'Category Published' );
		$this->setRedirect( 'index.php?option=com_maianmedia&ccontroller=category&view=category', $msg );
	}

	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display()
	{
		// loading view for this task
		JRequest::setVar( 'view', 'category' );
		parent::display();
	}

}