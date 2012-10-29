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
class MaianControllerItems extends MaianControllerDefault
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
			$msg = MaianText::_( 'There was an error saving this item' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_maianmedia&controller=items&view=items';
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
			$msg = MaianText::_( 'There was an error saving this item' );
		}

		$link = 'index.php?option=com_maianmedia&view=item&controller=items&task=edit&cid[]='.$id;
		$this->setRedirect($link, $msg);
	}


	function edit()
	{
		JRequest::setVar( 'view', 'items' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}
	function cancel()
	{
		$msg = MaianText::_(_msg_op_cancel);
		$this->setRedirect( 'index.php?option=com_maianmedia&controller=items&view=items', $msg );
	}

	function change_state(){

		$id = JRequest::getVar( 'item_id' );
		$published = JRequest::getVar( 'published' );

		if($published == '1'){
			$this->unpublish($id);
		}else{
			$this->publish($id);
		}
	}

	function unpublish($id)
	{
		$db =& JFactory::getDBO();

		$query = 'UPDATE #__m15_albums SET status = "0" WHERE id ='.$id;
		$db->setQuery($query);
		$db->query();

		$result= new stdClass();

		$result->link =  '<a id="state_'.$id.'" title="Publish Item" href="#"><img alt="Published" src="'.JURI::base().'components/com_maianmedia/images/publish_x.png"></a>';
		$result->status = '0';
		echo json_encode($result);
	}

	function publish($id)
	{
		$db =& JFactory::getDBO();

		$query = 'UPDATE #__m15_albums SET status = "1" WHERE id ='.$id;
		$db->setQuery($query);
		$db->query();

		$result= new stdClass();

		$result->link=  '<a id="state_'.$id.'" title="UnPublish Item" href="#"><img alt="Published" src="'.JURI::base().'components/com_maianmedia/images/tick.png"></a>';
		$result->status = '1';
		echo json_encode($result);
	}

	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display()
	{
		// loading view for this task
		JRequest::setVar( 'view', 'items' );
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

	function getData(){
		$data = array();

		//get the data
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_albums WHERE is_album = '0'");
		$items = $db->loadObjectList();

		$i=0;
		foreach ($items AS $single){
			$item = new stdClass();

			$item->id = $single->id;

			$db->setQuery('SELECT * FROM #__m15_categories WHERE id='.$single->cat);
			$cat = $db->loadObject();

			$link 		= JRoute::_( 'index.php?option=com_maianmedia&view=item&controller=items&task=edit&cid[]='. $single->id );

			$item->name = '<a href="'.$link.'">'.$single->name.'</a>';

			if($single->status == 1){
				$item->published =  '<a id="state_'.$single->id.'" title="UnPublish Item" href="#"><img alt="Published" src="'.JURI::base().'components/com_maianmedia/images/tick.png"></a>';
			}else{
				$item->published =  '<a id="state_'.$single->id.'" title="Publish Item" href="#"><img alt="Published" src="'.JURI::base().'components/com_maianmedia/images/publish_x.png"></a>';
			}

			$item->categories = $cat->title != ''? $cat->title: MaianText::_(_msg_albums18);
			$item->upc  = $single->upc;
			$item->price  = $single->physical;
			$item->hits  = $single->hits;
			$item->discount  = isset($single->discount) || $single->discount != '' ? $single->discount:'none';
			$item->remove_record  = '<a id="remove_'.$single->id.'" class="remove_sale" href="javascript:removeItem(\''.$single->id.'\', \''.MaianText::_(_msg_javascript33).'\',\''.MaianText::_(_msg_script2).'\',\''.MaianText::_(_msg_script3).'\')" title="'.MaianText::_(_msg_script8).'"><img src="'.JURI::base().'components/com_maianmedia/images/remove_record.png"/></a>';
			$item->status  = $single->status;
			$data[] = $item;
			$i++;

		}

		echo json_encode($data);
	}

	function display_params($xml, $data){

		$xml = JRequest::getVar('type');
		
		if(isset($xml) && $xml != ""){
			$path = JPATH_COMPONENT_SITE.DS.'views'.DS.'items'.DS.$xml;

			return $this->renderSettings($path, '', true, py_slice($xml, -4));
		}


	}

}