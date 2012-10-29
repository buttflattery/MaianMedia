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
class MaianControllerAlbums extends MaianControllerDefault
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
		$model = $this->getModel('Album');

		if ($model->store($post)) {
			$test = $model->getDbo();
			$test = $test->getQuery();

			if (strstr($test, "UPDATE")){
				$msg = MaianText::_( _msg_albums10 ).' - '.$_POST['name'];
			}else{
				$msg = MaianText::_( _msg_albums23 );
			}
		} else {
			$msg = MaianText::_( 'There was an error saving this album' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_maianmedia&controller=album&view=albums';
		$this->setRedirect($link, $msg);
	}

	function apply()
	{
		$model = $this->getModel('Album');
		$id = '';
		if ($model->store($post)) {
			$test = $model->getDbo();
			$test = $test->getQuery();

			if (strstr($test, "UPDATE")){
				$msg = MaianText::_( _msg_albums10 ).' - '.$_POST['name'];
				$id = JRequest::getVar('id');
			}else{
				$msg = MaianText::_( _msg_albums23 );

				$is15 = strpos(JVERSION, "1.5") === false ? false:true;

				if($is15 ){
					$id = $model->_db->insertid();
						
				}else{
					$id = $db->insertid();
				}


			}
		} else {
			$msg = MaianText::_( 'There was an error saving this album' );
		}

		$link = 'index.php?option=com_maianmedia&view=album&controller=albums&task=edit&cid[]='.$id;
		$this->setRedirect($link, $msg);
	}


	function edit()
	{
		JRequest::setVar( 'view', 'album' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}
	function cancel()
	{
		$msg = MaianText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_maianmedia&controller=album&view=albums', $msg );
	}

	function unpublish_album($mode)
	{
		$db =& JFactory::getDBO();
		$id = JRequest::getVar( 'cid', '0', 'POST' );

		$query = 'UPDATE #__m15_albums SET status = "0" WHERE id ='.$id[0];
		$db->setQuery($query);
		$db->query();

		$msg = MaianText::_( 'Album UnPublished' );
		$this->setRedirect( 'index.php?option=com_maianmedia&controller=album&view=albums', $msg );
	}

	function unpublish($mode)
	{
		$db =& JFactory::getDBO();
		$id = JRequest::getVar( 'cid', '0', 'POST' );

		$query = 'UPDATE #__m15_albums SET status = "0" WHERE id ='.$id[0];
		$db->setQuery($query);
		$db->query();

		$msg = MaianText::_( 'Album UnPublished' );
		$this->setRedirect( 'index.php?option=com_maianmedia&controller=album&view=albums', $msg );
	}

	function publish_album($mode)
	{
		$db =& JFactory::getDBO();
		$id = JRequest::getVar( 'cid', '0', 'POST' );

		$query = 'UPDATE #__m15_albums SET status = "1" WHERE id ='.$id[0];
		$db->setQuery($query);
		$db->query();

		$msg = MaianText::_(_msg_albums22 );
		$this->setRedirect( 'index.php?option=com_maianmedia&controller=album&view=albums', $msg );
	}

	function publish($mode)
	{
		$db =& JFactory::getDBO();
		$id = JRequest::getVar( 'cid', '0', 'POST' );

		$query = 'UPDATE #__m15_albums SET status = "1" WHERE id ='.$id[0];
		$db->setQuery($query);
		$db->query();

		$msg = MaianText::_(_msg_albums22 );
		$this->setRedirect( 'index.php?option=com_maianmedia&controller=album&view=albums', $msg );
	}

	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display()
	{
		// loading view for this task
		JRequest::setVar( 'view', 'albums' );
		parent::display();
	}

	function delete_albums()
	{
		$albumModel = $this->getModel('album');

		if(!$albumModel->delete()) {
			$msg = MaianText::_(_msg_albums_error);
		} else {
			$msg = MaianText::_( _msg_albums21 );
		}

		$this->setRedirect( 'index.php?option=com_maianmedia&controller=album&view=albums', $msg );
	}

}