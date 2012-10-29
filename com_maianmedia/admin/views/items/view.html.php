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
class MaianViewItems extends MaianViewDefault
{

	function getProduct(){

		$data = new stdClass();
		$id = JRequest::getVar('cid');

		if (!empty( $id )) {
			$query = ' SELECT * FROM #__m15_albums '.
					'  WHERE id = '.$id[0];
			$db =& JFactory::getDBO();
			$db->setQuery( $query );
			$data= $db->loadObject();
		}

		return $data;
	}

	function selectItemTypes(){

		$data = new stdClass();
		$id = JRequest::getVar('cid');

		if (!empty( $id )) {
			$query = ' SELECT * FROM #__m15_albums '.
					'  WHERE id = '.$id[0];
			$db =& JFactory::getDBO();
			$db->setQuery( $query );
			$data= $db->loadObject();
		}

		$itemTypes = opendir(JPATH_COMPONENT_SITE.DS.'views'.DS.'items');
		$items = array();
		while ($READ = readdir($itemTypes))
		{
			if ($READ != "." && $READ != ".." && $READ != "index.html" && $READ != ".svn" && $READ != "metadata.xml" && endswith($READ, ".xml")) {
				$items[$READ]= $READ;
			}
		}

		closedir($itemTypes);

		$html = '<select name="label" onChange="change_types(this.value)"><option value="">'.MaianText::_(_msg_product_type_default).'</option>';
		foreach ($items as $item){
			$objDOM = new DOMDocument();
			$objDOM->load(JPATH_COMPONENT_SITE.DS.'views'.DS.'items'.DS.$item);

			$node = $objDOM->getElementsByTagName("name");
			$name = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

			if(isset($data->label) && $item == $data->label){
				$html = $html.'<option value="'.$item.'" selected="selected" >';
				$html = $name.'</option>';
			}else{
				$html = $html.'<option value="'.$item.'">'.cleanData($name).'</option>';
			}

		}

		return $html.'</select>';
		/*
		 $objDOM = new DOMDocument();
		 $objDOM->load($templateXMLFile); //make sure path is correct

		 $node = $objDOM->getElementsByTagName("name");
		 $name = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

		 $node = $objDOM->getElementsByTagName("creationDate");
		 $creationDate = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

		 $node = $objDOM->getElementsByTagName("author");
		 $author = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

		 $node = $objDOM->getElementsByTagName("authorUrl");
		 $authorUrl = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

		 $node = $objDOM->getElementsByTagName("copyright");
		 $copyright = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

		 $node = $objDOM->getElementsByTagName("license");
		 $license = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

		 $node = $objDOM->getElementsByTagName("version");
		 $version = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

		 $node = $objDOM->getElementsByTagName("description");
		 $description = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

		 $description = explode("\n", $description);

		 $XMLFile = JPATH_COMPONENT_SITE.DS.'players'.DS.'dewplayer'.DS.'playerDetails.xml';
		 include_once(JPATH_COMPONENT_SITE.DS.'players'.DS.'maianplayer.php');

		 if(is_file(JPATH_COMPONENT_SITE.DS.'players'.DS.$SETTINGS->player.DS.'player.php')){
			include_once(JPATH_COMPONENT_SITE.DS.'players'.DS.$SETTINGS->player.DS.'player.php');
			$XMLFile = JPATH_COMPONENT_SITE.DS.'players'.DS.$SETTINGS->player.DS.'playerDetails.xml';
			}else{
			include_once(JPATH_COMPONENT_SITE.DS.'players'.DS.'dewplayer'.DS.'player.php');
			$classname = "dewplayer";
			}



			require_once(JPATH_COMPONENT.DS.'controllers'.DS.'settingsController.php');

			$UI = new MaianControllerSettings();

			return $UI->renderSettings($path, $data, true, 'player-params');*/


	}

	function renderTypes($xml, $data){

		if(isset($xml) && $xml != ""){
			JRequest::setVar('type', $xml);
			require_once(JPATH_COMPONENT.DS.'controllers'.DS.'itemsController.php');

			$UI = new MaianControllerItems();

			$path = JPATH_COMPONENT_SITE.DS.'views'.DS.'items'.DS.$xml;
			return $UI->renderSettings($path, $data, true, py_slice($xml, -4));
		}


	}

	/**
	 * display method of settings view
	 * @return void
	 **/
	function display($tpl = null)
	{

		$task = JRequest::getVar('task' );

		if(isset($task) && ($task=='edit' || $task=='add')){
			$this->displayItem($tpl);
		}else{
			$this->displayItems($tpl);
		}

	}

	function displayItem($tpl = null){
		$task = JRequest::getVar( 'task' );

		$document = &JFactory::getDocument();
		$document->addCustomTag('
		<script type="text/javascript">
			function jInsertEditorText(value, tag)
			{
				if(tag != \'comments\'){
			
			    	value = value.substring(value.indexOf("\"")+1,value.length);
					value = value.substring(0,value.indexOf("\""));
					var x = document.getElementById(tag);
					x.value = "'.JURI::root().'/"+value;
				}else{
					tinyMCE.execInstanceCommand(tag, \'mceInsertContent\',false,value);
				}
			}
			
			function change_types(xml){
		   
				setOpacity(5);
			   	ajaxRequest(\'flash_player\', \'index.php?option=com_maianmedia&format=raw&&controller=items&task=display_params&type=\'+xml, 1);
			}
			
			function setOpacity(value) {
			   	var testObj=document.getElementById(\'type-preview\');
				testObj.style.opacity = value/10;
				testObj.style.filter = \'alpha(opacity=\' + value*10 + \')\';
			}
			
		</script>');

		JToolBarHelper::save();
		JToolBarHelper::apply();

		if ($task == 'edit'){
			JToolBarHelper::cancel();
			$text =  MaianText::_( 'Edit' );
		} else {
			// for existing items the button is renamed `close`
			$text = MaianText::_('New');
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		JToolBarHelper::title(MaianText::_(_msg_items ).': <small><small>[ ' . $text.' ]</small></small>', 'items.png' );

		parent::display($tpl);
	}

	function selectCategories(){

		$db =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_categories WHERE section = 'com_maianmedia' ORDER BY ordering");
		$q_cat = $db->loadObjectList();

		$html = '<select name="cat"><option value="0">'.MaianText::_( _msg_albums18).'</option>';

		if (count($q_cat) > 0) {
			foreach ($q_cat as $CAT) {
				if(isset($this->album->cat)){
					$html = $html.'<option value="'.$CAT->id.'" ';
					$html = $html.($this->album->cat==$CAT->id ? ' selected="selected"' : '');
					$html = $html.cleanData($CAT->title).'</option>';
				}else{
					$html = $html.'<option value="'.$CAT->id.'">'.cleanData($CAT->title).'</option>';
				}
			}


		}
		return $html.'</select>';
	}

	function displayItems($tpl = null){

		JToolBarHelper::addNewX();
		JToolBarHelper::title(MaianText::_(_msg_items ), 'items.png' );

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

		parent::display($tpl);
	}

	function displayGrid(){
		$find       = array('{name}','{published}', '{categories}','{upc}','{price}', '{hits}', '{discount}','{url}');
		$replace    = array(MaianText::_( _msg_name), MaianText::_(_msg_tableh2), MaianText::_(_msg_categories1), MaianText::_(_msg_UPC), MaianText::_( _msg_add11),  MaianText::_( _msg_albums15), MaianText::_(_msg_discount), JURI::base());
		$tpl 		= file_get_contents(JPATH_COMPONENT.DS.'views'.DS.'items'.DS.'tmpl'.DS.'grid.js');

		return str_replace($find,$replace, $tpl);

	}


}