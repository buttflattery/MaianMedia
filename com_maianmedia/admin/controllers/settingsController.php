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
class MaianControllerSettings extends MaianControllerDefault
{

	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		//$this->registerTask( 'save' );
	}

	function save(){

		$tools = JRequest::getVar( 'tool');

		$msg = $this->saveData();

		// Check the table in so it can be edited.... we are done with it anyway
		if(isset($tools)){
			$link = 'index.php?option=com_maianmedia&task=tools';
		}else{
			$link = 'index.php?option=com_maianmedia&controller=settings&view=settings';
		}

		$this->setRedirect($link, $msg);
	}

	function apply(){

		$tools = JRequest::getVar( 'tool');

		$msg = $this->saveData();

		// Check the table in so it can be edited.... we are done with it anyway
		if(isset($tools)){
			if($tools="custom"){
				$link = 'index.php?option=com_maianmedia&task=tools&tool=custom';
			}else{
				$link = 'index.php?option=com_maianmedia&task=tools&tool=menu-edit';
			}

		}else{
			$link = 'index.php?option=com_maianmedia&controller=settings&view=settings';
		}

		$this->setRedirect($link, $msg);
	}
	/* save a record (and redirect to main page)
	 * @return void
	 */
	function saveData()
	{
		$model = $this->getModel('Settings');
		$tools = JRequest::getVar( 'tool');

		if(!isset($tools)){
			$this->updatePlayerParams();
			$this->initSettings();
		}else{

		}


		if ($model->store($_POST)) {
			if(!isset($tools)){
				return MaianText::_( 'Settings Saved!' );
			}else{
				return MaianText::_( 'Custom Page Text Saved!' );
			}

		}else{
			return MaianText::_( 'There was an error saving the settings' );
		}


	}

	function initSettings(){
		$paypal_mode = JRequest::getVar( 'paypal_mode');
		$log_errors = JRequest::getVar( 'log_errors');
		$ssl_enabled = JRequest::getVar( 'ssl_enabled');
		$smtp = JRequest::getVar( 'smtp');
		$enable_captcha = JRequest::getVar( 'enable_captcha');
		$days = JRequest::getVar( 'days');
		$minpay = JRequest::getVar( 'minpay');
		$ajax = JRequest::getVar( 'ajax');
		$search = JRequest::getVar( 'search');
		$tools = JRequest::getVar( 'tool');
		$download= JRequest::getVar('show_download');
		$nav= JRequest::getVar('show_nav');
		$reset= JRequest::getVar('reset');
		$append_url= JRequest::getVar('append_url');
		$enlargeit= JRequest::getVar('enlargeit');
		$select_lang= JRequest::getVar('select_lang');
		$hide_lightbox= JRequest::getVar('hide_lightbox');

		if(!isset($tools)){

			if($reset == '1'){
				$this->resetAllAlbumHits();
			}

			if(!isset($paypal_mode)){
				JRequest::setVar('paypal_mode', '0');
			}

			if(!isset($log_errors)){
				JRequest::setVar('log_errors', '0');
			}

			if(!isset($ssl_enabled)){
				JRequest::setVar('ssl_enabled', '0');
			}

			if(!isset($smtp)){
				JRequest::setVar('smtp', '0');
			}

			if(!isset($ajax)){
				JRequest::setVar('ajax', '0');
			}

			if(!isset($search)){
				JRequest::setVar('search', '0');
			}

			if(!isset($download)){
				JRequest::setVar('show_download', '0');
			}

			if(!isset($append_url)){
				JRequest::setVar('append_url', '0');
			}

			if(!isset($enlargeit)){
				JRequest::setVar('enlargeit', '0');
			}

			if(!isset($nav)){
				JRequest::setVar('show_nav', '0');
			}

			if(!isset($select_lang)){
				JRequest::setVar('select_lang', '0');
			}

			if(!isset($hide_lightbox)){
				JRequest::setVar('hide_lightbox', '0');
			}

			if(!isset($enable_captcha)){
				JRequest::setVar('enable_captcha', '0');
			}

			if($days == '0' || !isset($days)){
				JRequest::setVar('days', '14');
			}

			if($minpay == '0' || !isset($minpay)){
				JRequest::setVar('minpay', '10.00');
			}
		}
	}


	function tplParams(){
		require_once(JPATH_COMPONENT.DS.'views'.DS.'settings'.DS.'tmpl'.DS.'tplParams.php');
	}

	function resetAllAlbumHits()
	{
		$db =& JFactory::getDBO();
		$db->setQuery("UPDATE #__m15_albums SET hits = '0' WHERE is_album = '1'");
		$db->query();
	}

	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display()
	{
		// loading view for this task
		JRequest::setVar( 'layout', 'form'  );

		parent::display();
	}
}