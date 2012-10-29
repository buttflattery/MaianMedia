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
class MaianControllerSales extends MaianControllerDefault
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */

	var $SENT;

	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		//$this->registerTask( 'add'  , 	'edit' );
	}

	function modal()
	{
		//jimport( 'joomla.application.component.view' );
		switch (JRequest::getVar( 'switch')) {
			case 'view':
				require_once(JPATH_COMPONENT.DS.'views'.DS.'sales'.DS.'tmpl'.DS.'view_sale.php');
				break;
					
			case 'contact':
				require_once(JPATH_COMPONENT.DS.'views'.DS.'sales'.DS.'tmpl'.DS.'contact_buyer.php');
				break;
		}
	}

	function sort()
	{
		jimport( 'joomla.environment.uri' );
		$sql = "";
		switch ($_GET['order']) {
			case 'date_desc':    $sql = "ORDER BY pay_date DESC";      break;
			case 'date_asc':     $sql = "ORDER BY pay_date";           break;
			case 'tracks':       $sql = "ORDER BY total_tracks DESC";  break;
			case 'downloads':    $sql = "ORDER BY total_albums DESC";  break;
			case 'gross_desc':   $sql = "ORDER BY gross DESC";         break;
			case 'gross_asc':    $sql = "ORDER BY gross";              break;
			case 'name_asc':     $sql = "ORDER BY first_name";         break;
			case 'name_desc':    $sql = "ORDER BY first_name DESC";    break;
		}

		JRequest::setVar( 'sql', $sql);
	}

	function contact()
	{
		if (isset($_GET['contact']) || isset($_POST['contact']))
		{
			if (isset($_POST['process']))
			{
				include(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'classes'.DS.'class_generic.inc.php');
				include(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'classes'.DS.'class_mail.inc.php');

				// Trim post vars..
				$_POST = array_map('trim',$_POST);

				$db =& JFactory::getDBO();
				$db->setQuery("SELECT * FROM #__m15_settings Limit 1") ;
				$SETTINGS = $db->loadObject();




				// Only process if subject and comments are included..
				if ($_POST['subject'] && $_POST['comments']){

					$MM_MAIL = new mailClass();

					$MM_MAIL->smtp        = $SETTINGS->smtp;
					$MM_MAIL->smtp_host   = $SETTINGS->smtp_host;
					$MM_MAIL->smtp_user   = $SETTINGS->smtp_user;
					$MM_MAIL->smtp_pass   = $SETTINGS->smtp_pass;
					$MM_MAIL->smtp_port   = $SETTINGS->smtp_port;

					// Send mail..
					$MM_MAIL->sendMail($_POST['buyer'],
					$_POST['email'],
					$SETTINGS->website_name,
					$SETTINGS->email_address,
					$_POST['subject'],
					$_POST['comments']);

					$this->SENT = true;
				}

			}

			require_once(JPATH_COMPONENT.DS.'views'.DS.'sales'.DS.'tmpl'.DS.'contact_buyer.php');

		}
	}

	function delete()
	{
		$salesModel = $this->getModel('sales');

		if(!$salesModel->delete()) {
			$msg = MaianText::_(_msg_paypal9);
		} else {
			$msg = MaianText::_(_msg_script8.' '._msg_header7 );
		}

		//$this->setRedirect( 'index.php?option=com_maianmedia&controller=sales&view=sales', $msg );
	}

	function regen(){

		include_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'classes'.DS.'class_generic.inc.php');
		include_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'classes'.DS.'class_cart.inc.php');

		$MM_CART = new mm_Cart();

		$DATA['payer_email'] = JRequest::getVar('email_');
		if($DATA['payer_email'] == ''){
			echo 'No email address found.';
		}
		$DATA['first_name'] = JRequest::getVar('first_name_');
		$DATA['last_name'] = JRequest::getVar('last_name_');
		$DATA['payment_status'] = JRequest::getVar('payment_status_');
		$DATA['mc_fee'] = JRequest::getVar('fee_');
		$DATA['txn_id'] = JRequest::getVar('txn_id_');
		$DATA['invoice'] = JRequest::getVar('invoice_id_');

		$_GET['resend'] = JRequest::getVar('cart_code_');

		$MM_CART->updateCartDatabase(JRequest::getVar('cart_code_'),$DATA, JRequest::getVar('download_code_'));
		$MM_CART->generatePurchasesForDownload(JRequest::getVar('cart_code_'), JRequest::getVar('gross_'));
		$this->resend();
	}

	function resend(){
			
		include_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'classes'.DS.'class_generic.inc.php');
		include_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'classes'.DS.'class_cart.inc.php');
		include_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'classes'.DS.'class_mail.inc.php');
			
		$MM_CART = new mm_Cart();

		$MM_MAIL = new mailClass();

		$uri =& JURI::getInstance();

		$db =& JFactory::getDBO();
		$db->setQuery("Select * from #__m15_settings where id = '1'");
		$SETTINGS = $db->loadObject();
		if($SETTINGS->smtp == '1'){
			$MM_MAIL->smtp        = $SETTINGS->smtp;
			$MM_MAIL->smtp_host   = $SETTINGS->smtp_host;
			$MM_MAIL->smtp_user   = $SETTINGS->smtp_user;
			$MM_MAIL->smtp_pass   = $SETTINGS->smtp_pass;
			$MM_MAIL->smtp_port   = $SETTINGS->smtp_port;
		}
		$MM_MAIL->addTag('{WEBSITE_NAME}',$SETTINGS->website_name);
		$MM_MAIL->addTag('{WEBSITE_URL}',$uri->root());
		$MM_MAIL->addTag('{WEBSITE_EMAIL}',$SETTINGS->email_address);

		// Get paypal data..
		$paypal = $MM_CART->getCartData($_GET['resend']);

		// Assign mail vars..

		$MM_MAIL->addTag('{NAME}',$paypal->first_name.' '.$paypal->last_name);
		$MM_MAIL->addTag('{INVOICE}',$paypal->invoice);
		$MM_MAIL->addTag('{TRANS_ID}',$paypal->txn_id);
		$MM_MAIL->addTag('{TOTAL}',$paypal->gross);
		$MM_MAIL->addTag('{ALBUMS}',$MM_CART->purchasedItems('albums',$_GET['resend'],_msg_cart8));
		$MM_MAIL->addTag('{TRACKS}',$MM_CART->purchasedItems('tracks',$_GET['resend'],_msg_cart8));
		$MM_MAIL->addTag('{DOWNLOAD_LINK}',JRoute::_($uri->root().'index.php?option=com_maianmedia&section=download&code='.$paypal->download_code));

		// Reset downloads..
		$MM_CART->resetCartDownloads($_GET['resend']);

		// Send mail..
		$MM_MAIL->sendMail($paypal->first_name.' '.$paypal->last_name,
		$paypal->email,
		//'alao@aretimes.com',
		$SETTINGS->website_name,
		$SETTINGS->email_address,
                         '['.$SETTINGS->website_name.'] '._msg_ipn10,
		$MM_MAIL->template(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.getTplPath($SETTINGS->homepage_url).DS.'email'.DS.'paypal_thanks.txt'));
		echo ' <span style="letter-spacing:1px"><b>'.MaianText::_( _msg_sales31).'</b></span> (<a href="javascript:ajaxRequest(\'reset\', \'index.php?option=com_maianmedia&format=raw&controller=sales&amp;task=resend&view='.$_GET['view'].'&resend='.$_GET['resend'].'\', \'1\');"  title="'.MaianText::_( _msg_script10).'">'.MaianText::_( _msg_script10).'</a>)<br><span style="width:100px">'.$uri->root().'index.php?option=com_maianmedia&amp;section=download&amp;code='.$paypal->download_code.'</span>';

	}

	function getSales()
	{

		require_once(JPATH_COMPONENT.DS.'views'.DS.'sales'.DS.'tmpl'.DS.'table.php');
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

	function export(){
		$criteria = array_map('trim',$_POST);
		$cr = "\r";
		$sql_string = '';

		$mdate = date('d-m-Y',strtotime('+0 hours').'GMT');

		header("Expires: 0");
		header("Cache-control: private");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Description: File Transfer");
		header("Content-Type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=music-sales-".$mdate.".csv");

		echo "Date,Invoice,Customer,RM Number,UPC,Track Title,Album Name,Artist,Type,Sale,Cart Total,Fee".$cr;

		// Assign data to search array..

		if ($criteria['name']) {
			$search[] = "first_name LIKE '%".mysql_real_escape_string($criteria['name'])."%' OR last_name LIKE '%".mysql_real_escape_string($criteria['name'])."%'";
		}

		if ($criteria['email']) {
			$search[] = "email LIKE '%".mysql_real_escape_string($criteria['email'])."%'";
		}

		if ($criteria['invoice']) {
			$search[] = "invoice = '".mysql_real_escape_string($criteria['invoice'])."'";
		}

		if ($criteria['txn_id']) {
			$search[] = "txn_id = '".mysql_real_escape_string($criteria['txn_id'])."'";
		}

		if ((isset($criteria['start_date']) && $criteria['start_date'] != "") && (isset($criteria['end_date']) && $criteria['end_date'] != "")) {
			$search[] = "pay_date BETWEEN '{$criteria['start_date']}' AND '{$criteria['end_date']}'";
		}else if(isset($criteria['start_date']) || $criteria['start_date'] != ""){
			$search[] = "pay_date >= '{$criteria['start_date']}'";
		}else if(isset($criteria['end_date']) || $criteria['end_date'] != ""){
			$search[] = "pay_date <= '{$criteria['end_date']}'";
		}

		// If the search array is empty, no search terms were entered..

		// So, redirect to search page..
		if (!empty($search)){

			$db =& JFactory::getDBO();

			// Build query string..
			for ($i=0; $i<count($search); $i++){

				$sql_string .= ($i ? 'OR '.$search[$i].' ' : 'WHERE (active_cart = \'1\') AND '.$search[$i].' ');
			}

			// Query database..
			$db->setQuery("SELECT *,DATE_FORMAT(pay_date,'%e %b %Y') AS p_date
				FROM #__m15_paypal
				$sql_string ORDER BY pay_date DESC");

				$q_search = $db->loadObjectList();


				foreach($q_search as $sale){
					$purchases = explode("||",$sale->purchases);
					$pAlbums = explode(",",$purchases[0]);
					$pTracks = explode(",",$purchases[1]);

					foreach($pAlbums as $single){
							
						if($single != '0'){
							$db->setQuery("SELECT * FROM #__m15_albums
                             WHERE id = '".$single."' LIMIT 1") ;
							$ALBUM =$db->loadObject();
							if(isset($ALBUM)){
								$db->setQuery("SELECT SUM(track_cost) AS t_cost
						FROM #__m15_tracks
						WHERE track_album = '{$ALBUM->id}'");
								$SUM = $db->loadObject();

								$discount = $ALBUM->discount;

								if ($discount>0) {
									$discount_price = $SUM->t_cost * $discount / 100;
								}

								$fullAlbumCost = ($discount>0 ? number_format($SUM->t_cost-$discount_price,2) : number_format($SUM->t_cost,2));

								if($single!='0'){
									echo $sale->p_date.','.$sale->invoice.','.$sale->first_name.' '.$sale->last_name.','.$ALBUM->RM.','.$ALBUM->upc.', ,'.$ALBUM->name.','.$ALBUM->artist.', Album,'.$fullAlbumCost.','.$sale->total.','.$sale->fee.$cr;
								}
							}
						}

					}



					foreach($pTracks as $single){
						if($single != '0'){
							$db->setQuery("SELECT * FROM #__m15_tracks
                             WHERE id = '".$single."' LIMIT 1") ;
							$TRACK = $db->loadObject();

							$db->setQuery("SELECT * FROM #__m15_albums
                             WHERE id = '".$TRACK->track_album."' LIMIT 1") ;
							$Album = $db->loadObject();
							if($single!='0'){
								echo $sale->p_date.','.$sale->invoice.','.$sale->first_name.' '.$sale->last_name.','.$Album->RM.','.$Album->upc.','.$TRACK->track_name.','.$Album->name.','.$Album->artist.', Track,'.$TRACK->track_cost.','.$sale->total.','.$sale->fee.$cr;
							}
						}
					}

				}
					
		}
	}


	function getAlbumData($id,$track=false) {
		$db =& JFactory::getDBO();

		if (!$track) {
			$db->setQuery("SELECT track_album FROM #__m15_tracks
                            WHERE id = '{$id}'
                            LIMIT 1
                            ");	
			$TRACK = $db->loadObject();
		}

		$db->setQuery("SELECT * FROM #__m15_albums
                        WHERE id = '".($track ? $id : $TRACK->track_album)."'
                        LIMIT 1");
		$query = $db->loadObject();
		return $query;
	}

	function getData(){
		$sales = array();

		$db =& JFactory::getDBO();
		$db->setQuery(" SELECT *,DATE_FORMAT(pay_date,'%e %b %Y') AS p_date"
		. " FROM #__m15_paypal");

		$data = $db->loadObjectList();

		foreach ($data AS $PAYPAL){
			$sale = new stdClass();

			$sale->id = $PAYPAL->id;
			$sale->customer = '<b>'.cleanData($PAYPAL->first_name.' '.$PAYPAL->last_name).'</b><br>'.$PAYPAL->p_date;

			$items  = MaianText::_( _msg_sales20).': '.($PAYPAL->total_albums>0 ? '<b>'.$PAYPAL->total_albums.'</b>' : '<b>'.$PAYPAL->total_albums.'</b>').'<br>';
			$sale->items  = $items.MaianText::_( _msg_sales21).': '.($PAYPAL->total_tracks>0 ? '<b>'.$PAYPAL->total_tracks.'</b>' : '<b>'.$PAYPAL->total_tracks.'</b>');

			$sale->sales = '<b>'.get_cur_symbol(number_format($PAYPAL->gross-$PAYPAL->fee,2),$this->_SETTINGS->paypal_currency).'</b><br>';
			$sale->sales = $sale->sales.'<span style="font-size:10px;font-weight:normal">'.get_cur_symbol(number_format($PAYPAL->gross,2),$this->_SETTINGS->paypal_currency);
			$sale->sales = $sale->sales.' - '.get_cur_symbol(number_format($PAYPAL->fee,2),$this->_SETTINGS->paypal_currency).'</span>';

			$sale->sales_details = '<div id="mm_view_sale"><a class="modal-button" href="index.php?option=com_maianmedia&controller=sales&format=raw&task=modal&amp;switch=view&id='.$PAYPAL->id.'" rel="{handler: \'iframe\', size: {x: 570, y: 400}}" title="'.MaianText::_( _msg_sales22).' - '.cleanData($PAYPAL->first_name.' '.$PAYPAL->last_name).'"><img src="'.JURI::base().'components/com_maianmedia/images/view_sale.png" alt="'.MaianText::_( _msg_sales22).'" title="'.MaianText::_( _msg_sales22).'" class="image_pad"></a></div>';
			$sale->contact_details = '<div id="mm_contact"><a class="modal-button" href="index.php?option=com_maianmedia&controller=sales&format=raw&task=modal&amp;switch=contact&id='.$PAYPAL->id.'" rel="{handler: \'iframe\', size: {x: 570, y: 400}}" title="'.MaianText::_( _msg_sales23).' - '.cleanData($PAYPAL->first_name.' '.$PAYPAL->last_name).'"><img src="'.JURI::base().'components/com_maianmedia/images/contact_buyer.png" alt="'.MaianText::_( _msg_sales23).'" title="'.MaianText::_( _msg_sales23).'" class="image_pad"></a></div>';

			$sale->remove_record = '<a id="remove_'.$PAYPAL->id.'" class="remove_sale" href="javascript:removeSale(\''.$PAYPAL->id.'\', \''.MaianText::_(_msg_javascript33).'\',\''.MaianText::_(_msg_script2).'\',\''.MaianText::_(_msg_script3).'\')" title="'.MaianText::_(_msg_script8).'"><img src="'.JURI::base().'components/com_maianmedia/images/remove_record.png"/></a>';
			//Hidden fields
			$sale->email = $PAYPAL->email;
			$sale->invoice = $PAYPAL->invoice;
			$sale->trans = $PAYPAL->txn_id;
			$sale->pay_date = $PAYPAL->pay_date;
			$sale->active_cart = $PAYPAL->active_cart;

			$sales[] = $sale;
		}

		echo json_encode($sales);
	}

}