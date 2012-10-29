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
 * This version may have been modified pursuant to the GNU General Public License,
 * and as distributed it includes or is derivative of works licensed under the
 * GNU General Public License or other free or open source software licenses.
 * Changes must attribute the work in the manner specified by the author or licensor
 * (but not in any way that suggests that they endorse you or your use of the work).
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');
require_once(JPATH_COMPONENT.DS.'controllers'.DS.'template.php');

class MaianControllerPaypal extends MaianControllerTemplate
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	var $MM_PAYPAL;
	function __construct()
	{
		parent::__construct();

		include(JPATH_COMPONENT.DS.'classes'.DS.'class_paypal.inc.php');
		$this->MM_PAYPAL  = new paypalIPN((isset($_GET) ? $_GET : $_POST),$this->SETTINGS);

		$this->breadcrumbs->addItem( 'Music', JRoute::_( 'index.php?option=com_maianmedia&view=music' ) );

	}

	function notify()
	{

		$tx = $this->getTransactionId();
		$secondEmail = trim($this->SETTINGS->paypal_email2);

		if(isset($secondEmail) && $secondEmail !=''){

			if(isset($_POST['mc_gross'])? $_POST['mc_gross']:$_GET['mc_gross'] > $this->SETTINGS->minpay){
				$this->MM_PAYPAL->send_pdt($tx,$this->SETTINGS->pdt2);
			}else{
				$this->MM_PAYPAL->send_pdt($tx,$this->SETTINGS->pdt);
			}

		}else{
			$this->MM_PAYPAL->send_pdt($tx,$this->SETTINGS->pdt);

		}


		$postVars = $this->MM_PAYPAL->paypal_post_vars;

		// Get paypal response..
		$this->MM_PAYPAL->send_response();

		/*Testing Notify*/

		$this->_log->LogInfo("Notify -- Status");
		$this->_log->LogInfo('Payment Status'.$this->MM_PAYPAL->get_payment_status());
		$this->_log->LogInfo('$_POST'.print_r($_POST, true));
		$this->_log->LogInfo('$Paypal'.print_r($this->MM_PAYPAL->paypal_post_vars, true));
		$this->_log->LogInfo('$_GET'.print_r($_GET, true));
		$this->_log->LogInfo('Paypal Response'.$this->MM_PAYPAL->paypal_response);

		// Validate response from Paypal website..
		if(!$this->MM_PAYPAL->is_verified()) {
			if($this->MM_PAYPAL->get_payment_status() !="Completed" && $this->MM_PAYPAL->get_payment_status() !="Refunded" && $this->MM_PAYPAL->get_payment_status() !="Pending"){
				$message = $this->MM_PAYPAL->error_out(JText::_(_msg_ipn),JText::_(_msg_ipn2),JText::_(_msg_ipn3),JText::_(_msg_ipn4),$this->SETTINGS->log_errors);
				/*Testing Notify*/
				$this->_log->LogInfo("Notify -- Payment Not Verified");
				$this->_log->LogError('Payment Status'.$this->MM_PAYPAL->get_payment_status());
				$this->_log->LogError('$_POST'.print_r($_POST, true));
				$this->_log->LogError('$Paypal'.print_r($this->MM_PAYPAL->paypal_post_vars, true));
				$this->_log->LogError('$_GET'.print_r($_GET, true));
				$this->_log->LogError('Paypal Response'.$this->MM_PAYPAL->paypal_response);
				$this->_log->LogError('MM_PAYPAL returned'.$message);
				exit;
			}
		}
		$custom = $this->getCustom();

		$DATA = explode("-", $custom);

		// Get current data..
		$cartData = $this->MM_CART->getCartData($DATA[0]);

		// Check call isn`t coming from a unrelated music transaction.
		if (!isset($custom) || strpos($custom,'mswmusic')==FALSE) {
			$this->_log->LogInfo("Call comming from anoter script");
			$this->_log->LogWarn('Payment Status'.$this->MM_PAYPAL->get_payment_status());
			$this->_log->LogWarn('$_POST'.print_r($_POST, true));
			$this->_log->LogWarn('$Paypal'.print_r($this->MM_PAYPAL->paypal_post_vars, true));
			$this->_log->LogWarn('$_GET'.print_r($_GET, true));
			$this->_log->LogWarn('Paypal Response'.$this->MM_PAYPAL->paypal_response);
			exit;
		}
		// E-mail vars..
		$this->MM_MAIL->addTag('{NAME}',$postVars['first_name'].' '.$postVars['last_name']);
		$this->MM_MAIL->addTag('{INVOICE}',$postVars['invoice']);
		$this->MM_MAIL->addTag('{TRANS_ID}',$postVars['txn_id']);
		$this->MM_MAIL->addTag('{TOTAL}',$postVars['mc_gross']);
		$uri =& JURI::getInstance();
		$this->MM_MAIL->addTag('{DOWNLOAD_LINK}',JRoute::_($uri->root().'index.php?option=com_maianmedia&section=download&code='.$cartData->download_code.(isset($this->ItemId)? '&ItemId='.$this->ItemId : '')));

		// Process based on payment status..
		switch($this->MM_PAYPAL->get_payment_status()) {
			case 'Completed':
				// Firstly, lets make sure this isn`t a fraudulent transaction..
				// If it is, do nothing else..
				if (floatval($postVars['mc_gross'])>=floatval($cartData->total)){

					// Update database info..
					$this->MM_CART->updateCartDatabase($DATA[0],$this->MM_PAYPAL->paypal_post_vars, $cartData->download_code);
					// Log purchase data..
					$this->MM_CART->generatePurchasesForDownload($DATA[0], $postVars['mc_gross']);
					// Additional tags for tracks/albums purchased..
					$this->MM_MAIL->addTag('{ALBUMS}',$this->MM_CART->purchasedPhysical('albums',$DATA[0],JText::_(_msg_cart8)).'
					'.$this->MM_CART->purchasedItems('albums',$DATA[0],JText::_(_msg_cart8)));
					$this->MM_MAIL->addTag('{TRACKS}',$this->MM_CART->purchasedItems('tracks',$DATA[0],JText::_(_msg_cart8)));
					//$this->MM_MAIL->addTag('{PHYSICAL}',$this->MM_CART->purchasedPhysical('albums',$DATA[0],JText::_(_msg_cart8)));
					// Send mail to buyer..
					$this->MM_MAIL->sendMail($postVars['first_name'].' '.$postVars['last_name'],
					$postVars['payer_email'],
					$this->SETTINGS->website_name,
					$this->SETTINGS->email_address,
                           '['.$this->SETTINGS->website_name.'] '.JText::_(_msg_ipn10),
					$this->MM_MAIL->template(JPATH_COMPONENT.DS.getTplPath($this->SETTINGS->homepage_url).DS.'email'.DS.'paypal_thanks.txt'));
					// Send mail to webmaster..
					$this->MM_MAIL->sendMail($this->SETTINGS->website_name,
					$this->SETTINGS->email_address,
					$this->SETTINGS->website_name,
					$this->SETTINGS->email_address,
                           '['.$this->SETTINGS->website_name.'] '.JText::_(_msg_ipn11),
					$this->MM_MAIL->template(JPATH_COMPONENT.DS.getTplPath($this->SETTINGS->homepage_url).DS.'email'.DS.'paypal_notify.txt'));
				}
				exit;
				break;

			case 'Pending':
				// Send mail to buyer..
				$this->MM_MAIL->sendMail($postVars['first_name'].' '.$postVars['last_name'],
				$postVars['payer_email'],
				$this->SETTINGS->website_name,
				$this->SETTINGS->email_address,
                         '['.$this->SETTINGS->website_name.'] '.JText::_(_msg_ipn8),
				$this->MM_MAIL->template(JPATH_COMPONENT.getTplPath($this->SETTINGS->homepage_url).DS.'email'.DS.'paypal_pending_auto.txt'));
				// Send mail to webmaster..
				$this->MM_MAIL->sendMail($this->SETTINGS->website_name,
				$this->SETTINGS->email_address,
				$this->SETTINGS->website_name,
				$this->SETTINGS->email_address,
                         '['.$this->SETTINGS->website_name.'] '.JText::_(_msg_ipn8),
				$this->MM_MAIL->template(JPATH_COMPONENT.DS.getTplPath($this->SETTINGS->homepage_url).DS.'email'.DS.'paypal_pending.txt'));
				break;
			case 'Failed':
				$message = $this->MM_PAYPAL->error_out(JText::_(_msg_ipn5),JText::_(_msg_ipn2),JText::_(_msg_ipn3),JText::_(_msg_ipn4), $this->SETTINGS->log_errors);
				$this->_log->LogError('MM_PAYPAL returned'.$message);
				$invalid = true;
				break;

			case 'Invalid':
				$message = $this->MM_PAYPAL->error_out(JText::_(_msg_ipn5),JText::_(_msg_ipn2),JText::_(_msg_ipn3),JText::_(_msg_ipn4), $this->SETTINGS->log_errors);
				$this->_log->LogError('MM_PAYPAL returned'.$message);
				$invalid = true;
				break;

			case 'Denied':
				$message = $this->MM_PAYPAL->error_out(JText::_(_msg_ipn6),JText::_(_msg_ipn2),JText::_(_msg_ipn3),JText::_(_msg_ipn4), $this->SETTINGS->log_errors);
				$this->_log->LogError('MM_PAYPAL returned'.$message);
				$invalid = true;
				break;
			case 'Refunded':
				break;
			default:
				$message = $this->MM_PAYPAL->error_out(JText::_(_msg_ipn7).': '.$this->MM_PAYPAL->get_payment_status(),JText::_(_msg_ipn2),JText::_(_msg_ipn3),JText::_(_msg_ipn4),$this->SETTINGS->log_errors);
				$this->_log->LogError('MM_PAYPAL returned'.$message);
				$invalid = true;
				break;

		}
		if (isset($invalid)) {

			$pos = strpos($this->MM_PAYPAL->get_payment_status(), 'Not Verified');
			if ($pos === false) {
					
				$this->MM_MAIL->sendMail($this->SETTINGS->website_name,
				$this->SETTINGS->email_address,
				$this->SETTINGS->website_name,
				$this->SETTINGS->email_address,
                         '['.$this->SETTINGS->website_name.'] '.JText::_(_msg_ipn9).' '.$this->MM_PAYPAL->get_payment_status(),
				$this->MM_MAIL->template(JPATH_COMPONENT.DS.getTplPath($this->SETTINGS->homepage_url).DS.'email'.DS.'paypal_invalid.txt'));
			}

		}
	}
	function thanks()
	{

		$this->breadcrumbs->addItem( JText::_(_msg_paypal7), JRoute::_( 'index.php?option=com_maianmedia&section=paypal&view=thanks'));

		$tx = $this->getTransactionId();

		if(isset($this->SETTINGS->paypal_email2)){

			if(floatval($_GET['amt']) > floatval($this->SETTINGS->minpay)){
				$this->MM_PAYPAL->send_pdt($tx,$this->SETTINGS->pdt2);
			}else{
				$this->MM_PAYPAL->send_pdt($tx,$this->SETTINGS->pdt);
			}

		}else{
			$this->MM_PAYPAL->send_pdt($tx,$this->SETTINGS->pdt);
		}


		$postVars = $this->MM_PAYPAL->paypal_post_vars;

		$custom = $this->getCustom();

		$DATA  = explode("-", $custom);

		$cartData = $this->MM_CART->getCartData($DATA[0]);
		$uri =& JURI::getInstance();
			
		// Check trans amount as valid..
		if (floatval($this->MM_PAYPAL->paypal_post_vars['mc_gross']) >=floatval($cartData->total)) {

			// Check call isn`t coming from another script..
			if (!isset($custom) || strpos($custom,'mswmusic')===FALSE) {

				$this->_log->LogWarn("Call comming from anoter script");
				$this->_log->LogWarn("Download Code ".$DATA[0]);
				$this->_log->LogWarn('Payment Status'.$this->MM_PAYPAL->get_payment_status());
				$this->_log->LogWarn('$_POST'.print_r($_POST, true));
				$this->_log->LogWarn('$Paypal'.print_r($this->MM_PAYPAL->paypal_post_vars, true));
				$this->_log->LogWarn('$_GET'.print_r($_GET, true));
				$this->_log->LogWarn('$CartData'.print_r($cartData, true));
				$this->_log->LogWarn('Paypal Response'.$this->MM_PAYPAL->paypal_response);
				$this->_log->LogWarn('Data',$DATA);

			}

			// E-mail vars..
			$this->MM_MAIL->addTag('{NAME}',$this->MM_PAYPAL->paypal_post_vars['first_name'].' '.$this->MM_PAYPAL->paypal_post_vars['last_name']);
			$this->MM_MAIL->addTag('{INVOICE}',$this->MM_PAYPAL->paypal_post_vars['invoice']);
			$this->MM_MAIL->addTag('{TRANS_ID}',$this->MM_PAYPAL->paypal_post_vars['txn_id']);
			$this->MM_MAIL->addTag('{TOTAL}',$this->MM_PAYPAL->paypal_post_vars['mc_gross']);
			$this->MM_MAIL->addTag('{DOWNLOAD_LINK}',JRoute::_($uri->root().'index.php?option=com_maianmedia&section=download&code='.$cartData->download_code.(isset($this->ItemId)? '&ItemId='.$this->ItemId : '')));

			if ($this->MM_CART->checkTransaction($DATA[0], $cartData->download_code)){

				// Update database info..
				$this->MM_CART->updateCartDatabase($DATA[0],$postVars,$cartData->download_code);
				// Log purchase data..
				$this->MM_CART->generatePurchasesForDownload($DATA[0]);
				// Additional tags for tracks/albums purchased..
				$this->MM_MAIL->addTag('{ALBUMS}',$this->MM_CART->purchasedItems('albums',$DATA[0],JText::_(_msg_cart8)));
				$this->MM_MAIL->addTag('{TRACKS}',$this->MM_CART->purchasedItems('tracks',$DATA[0],JText::_(_msg_cart8)));
				//$this->MM_MAIL->addTag('{PHYSICAL}',$this->MM_CART->purchasedPhysical('albums',$DATA[0],JText::_(_msg_cart8)));

				// Send mail to buyer..
				$this->MM_MAIL->sendMail($postVars['first_name'].' '.$postVars['last_name'],
				$postVars['payer_email'],
				$this->SETTINGS->website_name,
				$this->SETTINGS->email_address,
                           '['.$this->SETTINGS->website_name.'] '.JText::_(_msg_ipn10),
				$this->MM_MAIL->template(JPATH_COMPONENT.DS.getTplPath($this->SETTINGS->homepage_url).DS.'email'.DS.'paypal_thanks.txt'));

				// Send mail to webmaster..
				$this->MM_MAIL->sendMail($this->SETTINGS->website_name,
				$this->SETTINGS->email_address,
				$this->SETTINGS->website_name,
				$this->SETTINGS->email_address,
                           '['.$this->SETTINGS->website_name.'] '.JText::_(_msg_ipn11),
				$this->MM_MAIL->template(JPATH_COMPONENT.DS.getTplPath($this->SETTINGS->homepage_url).DS.'email'.DS.'paypal_notify.txt'));
			}

			foreach($this->extra_params as $key=>$value){
				$tplProperties[$key] = $value;
			}

			require_once($this->skin_path.DS.'view.html.php');

			$tplParams = (object) $tplProperties;
			$skin = new MaianView($tplParams, $this->SETTINGS, $this->skin_name);

			$html = $skin->displayThankYou($cartData, $this->MM_PAYPAL);

			foreach($this->extra_params as $key=>$value){
				$html[$key] = $value;
			}

			HTML_maiainFront::show_ThanksPage($html);
		} else {
				
			$this->_log->LogError("Call comming from anoter script");
			$this->_log->LogError('$tx = '.$tx);
			$this->_log->LogError('Gross from paypal = '.$postVars['mc_gross']);
			$this->_log->LogError('Total found in cart = '.$cartData->total);
			$this->_log->LogError('Download code = '.$cartData->download_code);
			$this->_log->LogError('Cart Code = '.$DATA[0]);
			$this->_log->LogError('Custom Var = '.$this->MM_PAYPAL->paypal_post_vars['custom']);

			header("Location: ".JRoute::_('index.php?option=com_maianmedia&view=invalid&Itemid='.$menu_link->id)."");
			exit;
		}
	}

	function cancel()
	{

		$this->breadcrumbs->addItem( 'Cancel', JRoute::_( 'index.php?option=com_maianmedia&section=paypal&view=cancel' ) );


		$tplDisplayData = array();
		$tplDisplayData['CANCEL_TEXT'] = JText::_(_msg_paypal3);
		$tplDisplayData['CANCEL_MESSAGE'] = JText::_(_msg_paypal4);
		HTML_maiainFront::show_CancelPage($tplDisplayData);
	}

	function invalid()
	{
		// Send e-mail to webmaster if problem occured..

		// Send mail to webmaster..
		$this->MM_MAIL->addTag('{IP}',$_SERVER['REMOTE_ADDR']);
		$this->MM_MAIL->sendMail($this->SETTINGS->website_name,
		$this->SETTINGS->email_address,
		$this->SETTINGS->website_name,
		$this->SETTINGS->email_address,
                       '['.$this->SETTINGS->website_name.'] '.JText::_(_msg_paypal5).' Possible Fraud',
		$this->MM_MAIL->template(JPATH_COMPONENT.getTplPath($this->SETTINGS->homepage_url).DS.'email'.DS.'invalid_transaction.txt'));
		$tplDisplayData = array();
		$tplDisplayData['ERROR_TEXT'] = JText::_(_msg_paypal5);
		$tplDisplayData['ERROR_MESSAGE'] = JText::_(_msg_paypal6);

		$this->_log->LogWarn("Possible Fraud from ".$_SERVER['REMOTE_ADDR']);
		$this->_log->LogWarn('$_POST'.print_r($_POST, true));
		$this->_log->LogWarn('$_GET'.print_r($_GET, true));


		HTML_maiainFront::show_InvalidPage($tplDisplayData);

	}

	function getTransactionId(){

		$tx = $_GET['tx'];

		if(!isset($tx) || $tx ==''){

			$tx = $_GET['txn_id'];

			if(!isset($tx) || $tx ==''){

				$tx = $_POST['tx'];
			}
			if(!isset($tx) || $tx ==''){

				$tx = $_POST['txn_id'];
			}

		}

		return $tx;
	}

	function getCustom(){
		$custom = '';

		if(isset($this->MM_PAYPAL->paypal_post_vars['custom'])){
			$custom= $this->MM_PAYPAL->paypal_post_vars['custom'];
		}else if(isset($this->MM_PAYPAL->paypal_post_vars['cm'])){
			$custom  = $this->MM_PAYPAL->paypal_post_vars['cm'];
		}

		if($custom == ''){
			$custom = isset($_POST['custom']) ? $_POST['custom']:$_POST['cm'];
		}

		return $custom;
	}

	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display()
	{
		// loading view for this task

		//parent::display();
	}


}