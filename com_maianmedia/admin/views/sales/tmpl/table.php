<?php
$db =& JFactory::getDBO();
$db =& JFactory::getDBO();
$db->setQuery("SELECT * FROM #__m15_settings");
$settings = $db->loadObject();

$uri =& JURI::getInstance();
$root_url = $uri->root(); //root url
$root_base = $uri->base(); //base url
$root_current = $uri->current(); //current url pathj

JHTML::_('behavior.modal', 'a.modal');
JHTML::_('behavior.modal', 'a.modal-button');
// Trim/clean post vars..
$_POST = array_map('trim',$_POST);

$sql_string = '';

// Assign data to search array..

if (!empty($_POST['name_'])) {
	$search[] = "first_name LIKE '%".mysql_real_escape_string($_POST['name_'])."%' OR last_name LIKE '%".mysql_real_escape_string($_POST['name_'])."%'";
}

if ($_POST['email_']) {
	$search[] = "email LIKE '%".mysql_real_escape_string($_POST['email_'])."%'";
}

if ($_POST['invoice_']) {
	$search[] = "invoice like '%".mysql_real_escape_string($_POST['invoice_'])."%'";
}

if ($_POST['txn_id_']) {
	$search[] = "txn_id = '".mysql_real_escape_string($_POST['txn_id_'])."'";
}

if ((isset($_POST['start_date_']) && $_POST['start_date_'] != "") && (isset($_POST['end_date_']) && $_POST['end_date_'] != "")) {
	$search[] = "pay_date BETWEEN '{$_POST['start_date_']}' AND '{$_POST['end_date_']}'";
}else if(isset($_POST['start_date']) || $_POST['start_date_'] != ""){
	$search[] = "pay_date >= '{$_POST['start_date_']}'";
}else if(isset($_POST['end_date']) || $_POST['end_date_'] != ""){
	$search[] = "pay_date <= '{$_POST['end_date_']}'";
}

// If the search array is empty, no search terms were entered..

if($_POST['active_cart_'] == '' ||$_POST['active_cart_'] == '1'){
	$active_cart = '1';
}else{
	$active_cart = '0';
}

// So, redirect to search page..
if (!empty($search)){

	// Build query string..
	for ($i=0; $i<count($search); $i++){

		$sql_string .= ($i ? 'OR '.$search[$i].' ' : 'WHERE (active_cart = \''.$active_cart.'\') AND '.$search[$i].' ');
	}


}else{
	$sql_string = 'WHERE (active_cart = \''.$active_cart.'\') ';
}

// Query database..
$db->setQuery("SELECT *,DATE_FORMAT(pay_date,'%e %b %Y') AS p_date
                               FROM #__m15_paypal 
                               $sql_string ");
                               $q_paypal = $db->loadObjectList();

                               $html_output = '';

                               $html_output = $html_output.'<table class=\'adminlist\'>
	<thead>
    	<tr>
			<th>'.MaianText::_( _msg_sales41).'</th>
			<th>'.MaianText::_( _msg_public_header4).'</th>
			<th>'.MaianText::_( _msg_header7).'</th>
			<th>'.MaianText::_( _msg_sales42).'</th>
    	</tr>
    </thead>';

                               if (count($q_paypal)>0)
                               {
                               	$count = 9;
                               	foreach ($q_paypal AS $PAYPAL){
                               		$count = $count +1;
                               		$purchases = explode("||", $PAYPAL->purchases);
                               		/*
                               		 if($count == 10){
                               		 $html_output =$html_output.'<div class="contentdiv">';

                               		 }*/
                               		$html_output =$html_output.'<tr>
        <td align="left" style="padding:5px" width="40%">
        <b>'.cleanData($PAYPAL->first_name.' '.$PAYPAL->last_name).'</b><br>
        '.$PAYPAL->p_date.'
        </td>
        <td align="center" style="padding:5px" width="20%">
        '.MaianText::_( _msg_sales20.': '.($PAYPAL->total_albums>0 ? '<a href="javascript:toggle_box(\'show_purchases_'.$PAYPAL->id.'\')" title="'._msg_sales32.'"><b>'.$PAYPAL->total_albums.'</b></a>' : '<b>'.$PAYPAL->total_albums.'</b>')).'<br>
        '.MaianText::_( _msg_sales21.': '.($PAYPAL->total_tracks>0 ? '<a href="javascript:toggle_box(\'show_purchases_'.$PAYPAL->id.'\')" title="'._msg_sales32.'"><b>'.$PAYPAL->total_tracks.'</b></a>' : '<b>'.$PAYPAL->total_tracks.'</b>')).'
        </td>
        <td align="center" style="padding:5px;font-size:14px;font-weight:bold" width="15%">'.get_cur_symbol(number_format($PAYPAL->gross-$PAYPAL->fee,2),$settings->paypal_currency).'<br>
        <span style="font-size:10px;font-weight:normal">'.get_cur_symbol(number_format($PAYPAL->gross,2),$settings->paypal_currency).' - '.get_cur_symbol(number_format($PAYPAL->fee,2),$settings->paypal_currency).'</span></td>
        <td align="center" style="padding:5px" width="20%">
        <span id="mm_view_sale"><a class="modal-button"  href="index.php?option=com_maianmedia&controller=sales&format=raw&task=modal&switch=view&id='.$PAYPAL->id.'"  rel="{handler: \'iframe\', size: {x: 570, y: 400}}" title="'.MaianText::_( _msg_sales22).' - '.cleanData($PAYPAL->first_name.' '.$PAYPAL->last_name).'"><img src="'.$uri->root().'/administrator/components/com_maianmedia/images/view_sale.png" alt="'.MaianText::_( _msg_sales22).'" title="'.MaianText::_( _msg_sales22).'" class="image_pad"></a></span> 
        <span id="mm_contact"><a class="modal-button"  href="index.php?option=com_maianmedia&controller=sales&format=raw&task=modal&switch=contact&id='.$PAYPAL->id.'" rel="{handler: \'iframe\', size: {x: 570, y: 400}}" title="'.MaianText::_( _msg_sales23).' - '.cleanData($PAYPAL->first_name.' '.$PAYPAL->last_name).'"><img src="'.$uri->root().'/administrator/components/com_maianmedia/images/contact_buyer.png" alt="'.MaianText::_( _msg_sales23).'" title="'.MaianText::_( _msg_sales23).'" class="image_pad"></a></span>';
                               		if($count == 10){
                               			$html_output =$html_output.'</div>';
                               			$count = 0;
                               		}
                               	}
                               	//$html_output =$html_output.'</table></div>';

                               }
                               else
                               {

                               	$html_output ='<br>
    <table width="100%" cellspacing="0" cellpadding="0" 
    <tr>
        <td align="center" style="padding:5px">'.MaianText::_( _msg_search9).'</td>
    </tr>
    </table></div>';

                               }

                               echo $html_output;
                               ?>