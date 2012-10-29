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

class MaianViewSettings extends MaianViewDefault
{
	/**
	 * display method of settings view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the data
		$settings =& $this->get('Data');
		$this->assignRef('settings', $settings);

		JToolBarHelper::title(   MaianText::_(_msg_header3), 'cpanel.png' );
		JToolBarHelper::save();
		JToolBarHelper::apply();

		$document = &JFactory::getDocument();
		$document->addScript( 'components/com_maianmedia/js/swfobject.js' );
		$document->addScript( 'components/com_maianmedia/js/request.js' );
		$document->addCustomTag($this->getScript());

		parent::display($tpl);
	}

	function getPlayers(){
		$players = array();
		$dir = opendir(JPATH_COMPONENT_SITE.DS.'players'.DS);

		while (false !== ($file = readdir($dir))) {
			if ($file != "." && $file != ".." && $file != ".svn") {
				if (is_dir(JPATH_COMPONENT_SITE.DS.'players'.DS.$file)){
					$subdir = opendir(JPATH_COMPONENT_SITE.DS.'players'.DS.$file);
					while (false !== ($subfile = readdir($subdir))) {
						if ($subfile != "." && $subfile != ".." && $subfile != ".svn") {
							if (is_file(JPATH_COMPONENT_SITE.DS.'players'.DS.$file.DS.$subfile) && $subfile == "playerDetails.xml") {
								$objDOM = new DOMDocument();
								$objDOM->load(JPATH_COMPONENT_SITE.DS.'players'.DS.$file.DS.$subfile); //make sure path is correct

								$node = $objDOM->getElementsByTagName("name");
								$name = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

								if($name !=''){
									$players[$file]= $name;
								}

							}
						}
					}

					closedir($subdir);
				}

			}
		}

		closedir($dir);

		return $players;
	}

	function getScript(){
		return '<script type="text/javascript">
		  <!--
		  function toggleLayer( whichLayer ){
			var toggle_object = document.getElementById("site_div")
		    
			if (document.adminForm.append_url.checked){
		          toggle_object.style.display = \'block\'; 
		          display_url();
		    }else{
		
		          toggle_object.style.display = \'none\';
		   }
		  
		
		}
		  	
			function getPreviewPath(){
				var url = document.adminForm.site_url.value;
		    	var preview = document.adminForm.preview_path.value;
				var txt=document.getElementById("site_div")
				
				txt.innerHTML=url+preview;
			
			}
			
			function setTpl(template){
		
				document.getElementById(\'tplParams\').href = \'index.php?option=com_maianmedia&controller=settings&format=raw&task=tplParams&skin=\'+template;
			}
			
			function display_url() {
		    	getPreviewPath();
		    	window.setTimeout("getPreviewPath()", 500);
		   }
		   
		   function change_player(player){
		   
			setOpacity(5);
		   	ajaxRequest(\'flash_player\', \'index.php?option=com_maianmedia&format=raw&&controller=settings&task=display_player&player_type=\'+player, 1);
			window.setTimeout("ajaxRequest(\'player_settings\', \'index.php?option=com_maianmedia&format=raw&&controller=settings&task=renderSettingsAjax\')", 3000);
		   }
		   
		   function refresh_player(player){
		   	ajaxRequest(\'flash_player\', \'index.php?option=com_maianmedia&format=raw&&controller=settings&task=display_player&save=true&player_type=\'+player, 1);
		   } 
		   
		   function setOpacity(value) {
		   	var testObj=document.getElementById(\'settings_player\');
			testObj.style.opacity = value/10;
			testObj.style.filter = \'alpha(opacity=\' + value*10 + \')\';
			}
		   
		   
		  -->
		  </script>';
	}

	function renderSettings($path, $data){
		require_once(JPATH_COMPONENT.DS.'controllers'.DS.'settingsController.php');

		$UI = new MaianControllerSettings();

		return $UI->renderSettings($path, $data, true, 'player-params');

	}

}