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

/**
 * Hello Table class
 *
 * @package    Maian Music
 * @subpackage Components
 */
class TableSettings extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;
	/**
	 * @var string
	 */
	var $website_name = null;
	/**
	 * @var string
	 */
	var $email_address = null;
	/**
	 * @var string
	 */
	var $homepage_url = null;
	/**
	 * @var string
	 */
	var $install_url = null;
	/**
	 * @var string
	 */
	var $language = null;
	/**
	 * @var string
	 */
	var $about = null;
	/**
	 * @var string
	 */
	var $licence = null;
	/**
	 * @var string
	 */
	var $music = null;
	/**
	 * @var string
	 */
	var $enable_captcha = null;
	/**
	 * @var string
	 */
	var $mod_rewrite = null;
	/**
	 * @var string
	 */
	var $mp3_path = null;
	/**
	 * @var string
	 */
	var $preview_path = null;
	/**
	 * @var string
	 */
	var $rssfeeds = null;
	/**
	 * @var string
	 */
	var $poplinks = null;
	/**
	 * @var string
	 */
	var $page_expiry = null;
	/**
	 * @var string
	 */
	var $download_expiry = null;
	/**
	 * @var string
	 */
	var $paypal_mode = null;
	/**
	 * @var string
	 */
	var $paypal_currency = null;
	/**
	 * @var string
	 */
	var $paypal_email = null;
	/**
	 * @var string
	 */
	var $paypal_email2 = null;
	/**
	 * @var string
	 */
	var $page_style = null;
	/**
	 * @var string
	 */
	var $log_errors = null;
	/**
	 * @var string
	 */
	var $ssl_enabled = null;
	/**
	 * @var string
	 */
	var $smtp = null;
	/**
	 * @var string
	 */
	var $smtp_host = 'localhost';
	/**
	 * @var string
	 */
	var $smtp_user = null;
	/**
	 * @var string
	 */
	var $smtp_pass = null;
	/**
	 * @var string
	 */
	var $smtp_port = '25';
	/**
	 * @var int
	 */
	var $player = '1';
	/**
	 * @var int
	 */
	var $pdt = null;
	/**
	 * @var int
	 */
	var $pdt2 = null;
	/**
	 * @var int
	 */
	var $minpay = null;
	/**
	 * @var int
	 */
	var $default_page = null;
	/**
	 * @var int
	 */
	var $days = null;

	var $ajax = null;
	/**
	 * @var string
	 */
	var $freeText = null;
	/**
	 * @var string
	 */
	var $search = null;

	/**
	 * @var string
	 */
	var $show_download = null;

	/**
	 * @var string
	 */
	var $show_nav = null;

	/**
	 * @var string
	 */
	var $append_url = null;

	/**
	 * @var string
	 */
	var $enlargeit = null;

	/**
	 * @var string
	 */
	var $select_lang = null;

	/**
	 * @var string
	 */
	var $hide_lightbox = null;

	/**
	 * @var string
	 */
	var $use_zip = null;

	/**
	 * @var string
	 */
	var $use_zip_cart = null;

	/**
	 * @var string
	 */
	var $shopbutton = null;
	/**
	 * @var int
	 */

	var $clip = null;
	/**
	 * @var string
	 */
	var $extra_params = null;
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableSettings(& $db) {
		parent::__construct('#__m15_settings', 'id', $db);
	}
}