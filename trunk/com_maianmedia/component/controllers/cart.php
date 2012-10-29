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

class MaianControllerCart extends MaianControllerTemplate
{

	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */

	var $MM_PAYPAL, $cartID;

	function __construct()
	{
		parent::__construct();

		include(JPATH_COMPONENT.DS.'classes'.DS.'class_paypal.inc.php');
		$this->MM_PAYPAL  = new paypalIPN((isset($_GET) ? $_GET : ''),$this->SETTINGS);
		$this->cartID = session_id();
	}

	function removeTrack(){

		if (!ctype_alnum($_GET['track'])) {
			exit;
		}
		$uri =& JURI::getInstance();
		$link = '<span id="update_'.$_GET['track'].'"><img onclick="updateCart(\'index.php?option=com_maianmedia&format=raw&section=cart&task=addToCart&track='.$_GET['track'].'\', \'\', \'update_'.$_GET['track'].'\');" src="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/addToCart.png" /></span>';
		$this->MM_CART->deleteCartItem($_GET['code']);
		echo $link;
		exit;
	}

	function updateCart(){
		$task = JRequest::getVar('update');
		$uri =& JURI::getInstance();

		$items= ($this->MM_CART->cartCount()>0 ? '<span class="cart_count"><b>'.$this->MM_CART->cartCount().'</b></span>' : $this->MM_CART->cartCount());
		$total = get_cur_symbol($this->MM_CART->cartTotal(), $this->SETTINGS->paypal_currency);

		require_once($this->skin_path.DS.'view.html.php');

		$tplParams = (object) $this->params;
		$skin = new MaianView($tplParams, $this->SETTINGS, $this->skin_name);

		echo $skin->displayCartIcon($items, $total);

		exit;
	}

	function addPhysical(){
		$uri =& JURI::getInstance();
		if (isset($_GET['album'])) {
			if (!ctype_digit($_GET['album'])) {
				header("Location: ".JRoute::_('index.php?option=com_maianmedia&'.$this->menu_link)."");
				exit;
			}
			// Add album to cart...
			$this->MM_CART->addToCart(true,$_GET['album'],0,JText::_(_msg_cart9), true);
			echo '<span id="album_" >'._msg_albums23.'</span>';
		}
		exit;
	}

	function addToCart(){
		$uri =& JURI::getInstance();
		if (isset($_GET['album'])) {
			if (!ctype_digit($_GET['album'])) {
				header("Location: ".JRoute::_('index.php?option=com_maianmedia&'.$this->menu_link)."");
				exit;
			}
			// Add album to cart...
			$this->MM_CART->addToCart(true,$_GET['album'],0,JText::_(_msg_cart9));
			echo '<span id="album_" >'._msg_albums23.'</span>';
		}

		if (isset($_GET['track'])) {
			if (!ctype_digit($_GET['track'])) {
				header("Location: ".JRoute::_('index.php?option=com_maianmedia&'.$this->menu_link)."");
				exit;
			}
			// Add album to cart...
			$this->MM_CART->addToCart(false,0,$_GET['track'],JText::_(_msg_cart9));

			$link = '<span id="update_'.$_GET['track'].'"><img onclick="updateCart(\'index.php?option=com_maianmedia&format=raw&section=cart&task=removeTrack&track='.$_GET['track'].'&code='.$this->getEntryCode($_GET['track']).'\', \'\', \'update_'.$_GET['track'].'\');" src="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/cart/removeFromCart.png" /></span>';

			echo $link;
		}
		exit;
	}

	/*For thoses browsers that don't have ajax enabled*/
	function add_legacy()
	{
		if (isset($_GET['album'])) {
			if (!ctype_digit($_GET['album'])) {
				header("Location: ".JRoute::_('index.php?option=com_maianmedia&'.$this->menu_link)."");
				exit;
			}
			// Add album to cart...
			$this->MM_CART->addToCart(true,$_GET['album'],0,JText::_(_msg_cart9));
		} else {
			if (!isset($_POST)) {
				header("Location: ".JRoute::_('index.php?option=com_maianmedia&'.$this->menu_link)."");
				exit;
			}
			// Add selected tracks to cart..
			if (isset($_POST['process'])) {
				// If no boxes were checked, do nothing..
				if (!empty($_POST['track'])) {
					// Loop through checkboxes..
					for ($i=0; $i<count($_POST['track']); $i++) {
						// Only assign tracks that were checked..
						if (isset($_POST['track'][$i])) {
							$this->MM_CART->addToCart(false,0,$_POST['track'][$i],JText::_(_msg_cart9));
						}
					}
				}
			}
		}
		// Get album data and refresh page..
		// If invalid id var, go back to homepage..
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_albums
                          WHERE id = '".(int)(isset($_POST['album']) ? $_POST['album'] : $_GET['album'])."' 
                          LIMIT 1") ;
		$q_album = $db->loadObjectList();
		$ALBUM = $db->loadObject();

		if (count($q_album)==0) {
			header("Location: ".JRoute::_('index.php?option=com_maianmedia&'.$this->menu_link)."");
			exit;
		} else {
			header("Location: ".JRoute::_('index.php?option=com_maianmedia&view=album&album='.$ALBUM->id.'&'.$this->menu_link)."");
			//header("Location: ".JRoute::_('mp3-download/'.$ALBUM->id.'/'.addTitleToUrl(cleanData($ALBUM->artist)).'/'.addTitleToUrl(cleanData($ALBUM->name))."");

		}
	}

	function clear_cart()
	{
		$this->MM_CART->clearCart();

		$this->breadcrumbs->addItem( 'Music', JRoute::_( 'index.php?option=com_maianmedia&view=music' ) );
		header("Location: ".JRoute::_('index.php?option=com_maianmedia&section=cart&view=viewcart&'.$this->menu_link)."");
	}

	function delete_item()
	{

		if (!ctype_alnum($_GET['item'])) {
			header("Location: ".JRoute::_('index.php?option=com_maianmedia&'.$this->menu_link)."");
			exit;
		}

		$this->MM_CART->deleteCartItem($_GET['item']);
		header("Location: ".JRoute::_('index.php?option=com_maianmedia&section=cart&view=viewcart&'.$this->menu_link)."");
	}

	function ajax_remove()
	{

		if (!ctype_alnum($_GET['deleteThis'])) {
			header("Location: ".JRoute::_('index.php?option=com_maianmedia&'.$this->menu_link)."");
			exit;
		}

		$this->MM_CART->deleteCartItem($_GET['deleteThis']);
		//echo'';
		//exit;
	}

	function updateCartCount(){

		$task = JRequest::getVar('switch');
		switch($task){
			case 'count':
				$cData = '<span class="cart_count">'.str_replace("{count}",$this->MM_CART->cartCount(),JText::_(_msg_cart4)).'</span>';
				break;
					
			case 'total':
				$cData = JText::_(_msg_cart5).': '.get_cur_symbol($this->MM_CART->cartTotal(),$this->SETTINGS->paypal_currency);
				break;
		}

		echo $cData;
		exit;
	}

	function viewcart(){

		$this->breadcrumbs->addItem( 'View Cart', JRoute::_( 'index.php?option=com_maianmedia&section=cart&view=viewcart' ) );
		JHTML::_('behavior.mootools');

		$document = &JFactory::getDocument();
		$document->setTitle($this->SETTINGS->website_name.' - '.JText::_(_msg_cart));
		$document->addScript( 'components/com_maianmedia/ajax/cartajax.js' );
		$document->addCustomTag($this->getCartScript());

		foreach($this->extra_params as $key=>$value){
			$tplProperties[$key] = $value;
		}

		require_once($this->skin_path.DS.'view.html.php');

		$tplParams = (object) $tplProperties;
		$skin = new MaianView($tplParams, $this->SETTINGS, $this->skin_name);

		$html = $skin->displayCart($this->MM_CART);

		foreach($this->extra_params as $key=>$value){
			$html[$key] = $value;
		}

		HTML_maiainFront::show_CartPage($html);
	}

	// Checkout..
	function checkout()
	{
		$this->breadcrumbs->addItem( 'Checkout', JRoute::_( 'index.php?option=com_maianmedia&view=music' ) );

		// Add paypal fields...
		$this->MM_PAYPAL->add_field('rm','2');
		$this->MM_PAYPAL->add_field('cmd','_xclick');

		if(isset($this->SETTINGS->paypal_email2) && $this->SETTINGS->paypal_email2 != 'example2@localhost.com'){

			if($this->MM_CART->cartTotal() > $this->SETTINGS->minpay && trim($this->SETTINGS->paypal_email2) != ""){
				$this->MM_PAYPAL->add_field('business',$this->SETTINGS->paypal_email2);
			}else{
				$this->MM_PAYPAL->add_field('business',$this->SETTINGS->paypal_email);
			}

		}else{
			$this->MM_PAYPAL->add_field('business',$this->SETTINGS->paypal_email);
		}

		$this->MM_PAYPAL->add_field('item_name',JText::_($this->SETTINGS->website_name));
		$this->MM_PAYPAL->add_field('quantity','1');
		$this->MM_PAYPAL->add_field('no_shipping', '1');
		$this->MM_PAYPAL->add_field('notify_url','http'.($this->SETTINGS->ssl_enabled ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?option=com_maianmedia&section=paypal&view=notify');
		$this->MM_PAYPAL->add_field('cancel_return','http'.($this->SETTINGS->ssl_enabled ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?option=com_maianmedia&section=paypal&view=cancel');
		$this->MM_PAYPAL->add_field('return','http'.($this->SETTINGS->ssl_enabled ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?option=com_maianmedia&section=paypal&view=thanks');
		// Only show page style field if one is set, otherwise paypal throws an error..
		if ($this->SETTINGS->page_style) {
			$this->MM_PAYPAL->add_field('page_style',$this->SETTINGS->page_style);
		}

		$inv = 'INV-'.time().'-'.rand(1111,9999);
		$this->MM_PAYPAL->add_field('invoice',$inv);
		$this->MM_PAYPAL->add_field('amount',$this->MM_CART->cartTotal());
		$this->MM_PAYPAL->add_field('currency_code',$this->SETTINGS->paypal_currency);
		$this->MM_PAYPAL->add_field('custom',$this->cartID.'-mswmusic');
		// Log data in database..
		$this->MM_CART->addCartToDatabase($this->cartID, $this->MM_CART->cartTotal(),$inv);

		// Kill session data..
		$this->MM_CART->clearCart();

		foreach($this->extra_params as $key=>$value){
			$tplProperties[$key] = $value;
		}

		require_once($this->skin_path.DS.'view.html.php');

		$tplParams = (object) $tplProperties;
		$skin = new MaianView($tplParams, $this->SETTINGS, $this->skin_name);

		$html = $skin->displayCheckOut($this->MM_PAYPAL, $this->MM_CART, $this->cartID);

		foreach($this->extra_params as $key=>$value){
			$html[$key] = $value;
		}

		HTML_maiainFront::show_CheckoutPage($html);
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