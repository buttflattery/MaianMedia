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
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class TablePaypal extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;
	var $jos_id = null;
	var $first_name = null;
	var $last_name 	= null;
	var $pay_date 	= null;
	var $address 	= null;
	var $email 	= null;
	var $memo 	 = null;
	var $payment_status = null;
	var $pending_reason = null;
	var $total = null;
	var $gross = null;
	var $fee = null;
	var $txn_id = null;
	var $invoice = null;
	var $visits = null;
	var $download_code 	= null;
	var $cart_code 	= null;
	var $purchases 	= null;
	var $active_cart = null;
	var $total_tracks = null;
	var $total_albums = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TablePaypal(& $db) {
		parent::__construct('#__m15_paypal', 'id', $db);
	}
}