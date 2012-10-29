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
class MaianViewDefault extends JView
{
	var $_log, $_SETTINGS;
	var $root_url, $root_base, $root_current;
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct($config = array())
	{
		$db = & JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_settings");
		$this->_SETTINGS = $db->loadObject();

		$uri =& JURI::getInstance();
		$this->root_url = $uri->root(); //root url
		$this->root_base = $uri->base(); //base url
		$this->root_current = $uri->current();

		if($this->_SETTINGS->log_errors){
			$this->_log = new MaianLogger(JPATH_COMPONENT_SITE.DS.'log', MaianLogger::DEBUG);
		}else{
			$this->_log = new MaianLogger(JPATH_COMPONENT_SITE.DS.'log', MaianLogger::OFF);
		}
		
		parent::__construct($config);
	}

	/**
	 * display method of settings view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the data
		$settings =& $this->get('Data');
		$this->assignRef('settings', $settings);

		parent::display($tpl);
	}

	function initializeHeader(){

		$document = &JFactory::getDocument();

		$this->_scripts = array();
		$headerstuff = $document->getHeadData();

		$document->setHeadData($headerstuff);

		// get the headdata
		$headerstuff = $document->getHeadData();
		// (part of) the filenames to be removed
		// 'mootools' will find 'mootools.js' and 'mootools-uncompressed.js'
		$search = array('mootools','mootools-core', 'caption.js');

		// remove the js files
		foreach($headerstuff['scripts'] as $key => $script) {
			foreach($search as $findme) {
				if(stristr($script, $findme) !== false) {
					unset($headerstuff['scripts'][$key]);
				}
			}
		}
		// restore
		$document->setHeadData($headerstuff);

		$is15 = strpos(JVERSION, "1.5") === false ? false:true;

		if($is15){
			$document =& JFactory::getDocument();
			unset($document->_scripts[JURI::base() . 'media/system/js/mootools.js']);
			unset($document->_scripts[JURI::base() . 'media/system/js/mootools-uncompressed.js']);
			unset($document->_scripts[JURI::base() . 'media/system/js/validate.js']);
		}

		return $document;
	}

	function initManager($include=true){
		$document = &JFactory::getDocument();

		/*New Uploader http://og5.net*/
		$version = JVERSION;

		$is15 = strpos($version, "1.5") === false ? false:true;

		if($is15){
			$this->initializeHeader();
		}

		$document->addScript(JURI::base().'components/com_maianmedia/js/overlib.js');
		$document->addScript(JURI::base().'components/com_maianmedia/utilities/filemanager/Assets/js/mootools-core-1.3.1.js');
		$document->addScript(JURI::base().'components/com_maianmedia/utilities/filemanager/Assets/js/mootools-more-1.3.1.1.js');

		$document->addCustomTag('<link rel="stylesheet" media="all" type="text/css" href="'.JURI::base().'components/com_maianmedia/utilities/filemanager/Assets/Css/FileManager.css" />');
		$document->addCustomTag('<link rel="stylesheet" media="all" type="text/css" href="'.JURI::base().'components/com_maianmedia/utilities/filemanager/Assets/Css/Additions.css" />');

		if($is15){
			$document->addScript(JURI::root().'includes/js/joomla.javascript.js');
		}else{
			$document->addScript(JURI::root().'media/system/js/core.js');
		}

		$document->addScript(JURI::base().'components/com_maianmedia/js/overlib.js');

		$document->addScript(JURI::base().'components/com_maianmedia/utilities/filemanager/Assets/js/FileManager.js');

		$document->addScript(JURI::base().'components/com_maianmedia/utilities/filemanager/Assets/js/Uploader/Fx.ProgressBar.js');
		$document->addScript(JURI::base().'components/com_maianmedia/utilities/filemanager/Assets/js/Uploader/Swiff.Uploader.js');

		$document->addScript(JURI::current().'?option=com_maianmedia&format=raw&controller=tracks&task=uploaderjs');

		if($include){
			$document->addScript(JURI::base().'components/com_maianmedia/js/request.js');
		}
		$document->addScript(JURI::base().'components/com_maianmedia/utilities/filemanager/Assets/Language/Language.'.$this->getLang().'.js');

		$document->addCustomTag($this->setValuesjs());
	}

	function getFormattedSession(){
		$session = & JFactory::getSession();

		$user =& JFactory::getUser();
		$sessionid = $this->endecrypt(md5($user->password), $session->getId());

		$sessionid = str_replace('%','-per-',$sessionid);
		$sessionid = str_replace('.','-dot-',$sessionid);
		return $sessionid;
	}
}