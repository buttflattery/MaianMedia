<?php

/*++++++++++++++++++++++++++++++++++++++++

Script: Maian Music v1.2
Written by: David Ian Bennett
E-Mail: support@maianscriptworld.co.uk
Website: http://www.maianscriptworld.co.uk

++++++++++++++++++++++++++++++++++++++++

This File: view_sale.php
Description: View Sale

++++++++++++++++++++++++++++++++++++++++*/
$db =& JFactory::getDBO();

$db->setQuery("SELECT * FROM #__m15_settings
                        LIMIT 1
                        ");
$SETTINGS = $db->loadObject();

$db->setQuery("SELECT *,DATE_FORMAT(pay_date,'%e %b %Y') AS p_date
                        FROM #__m15_paypal
                        WHERE id = '{$_GET['id']}'
                        LIMIT 1
                        ");
$BUYER = $db->loadObject();
$purchases = explode("||", $BUYER->purchases);

$uri =& JURI::getInstance();
$root_url = $uri->root(); //root url

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb"
	dir="ltr" id="minwidth">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title></title>
<script type="text/javascript"
	src="components/com_maianmedia/js/js_code.js"></script>
<link
	href="<?php echo $uri->base(); ?>components/com_maianmedia/stylesheet.css"
	rel="stylesheet" type="text/css" />
<script type="text/javascript"
	src="components/com_maianmedia/js/request.js"></script>
</head>

<body>

	<div class="pop">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td id="reset" align="left" style="padding: 5px"><?php if($BUYER->active_cart == '1'){ ?>
					<a
					href="javascript:ajaxRequest('reset', 'index.php?option=com_maianmedia&format=raw&controller=sales&amp;task=resend&view=<?php echo $_GET['id']; ?>&resend=<?php echo $BUYER->cart_code; ?>', '1');"
					onclick="return delete_confirm('<?php echo MaianText::_( _msg_javascript34); ?>')"
					title="<?php echo MaianText::_( _msg_sales29); ?>"><?php echo MaianText::_( _msg_sales29); ?>
				</a> <?php }else{ ?> <a
					href="javascript:ajaxRequest('reset', 'index.php?option=com_maianmedia&format=raw&controller=sales&amp;task=regen&view=<?php echo $_GET['id']; ?>&resend=<?php echo $BUYER->cart_code; ?>', '1');"
					onclick="return delete_confirm('<?php echo MaianText::_( _msg_javascript34); ?>')"
					title="<?php echo MaianText::_( _msg_sales29); ?>"><?php echo MaianText::_( _msg_gen); ?>
				</a> <?php }?>
				</td>
				<td align="right" width="5%" style="padding: 5px"><a
					href="javascript:window.print()"><img
						src="components/com_maianmedia/images/print.gif"
						alt="<?php echo MaianText::_( _msg_script11); ?>"
						title="<?php echo MaianText::_( _msg_script11); ?>" border="0"> </a></td>
			</tr>
		</table>
	</div>

	<div class="pop">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td align="left" style="padding: 5px">
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" width="50%" style="padding: 5px" valign="top"><span
								class="orange">[ <?php echo MaianText::_( _msg_sales30); ?> ]</span><br>
								<br> <?php if($BUYER->active_cart == '1'){ ?> &#8226; <b><?php echo MaianText::_( _msg_sales33); ?>
							</b>: <br> <?php echo cleanData($BUYER->first_name.' '.$BUYER->last_name); ?><br>
								<br> &#8226; <b><?php echo MaianText::_( _msg_sales34); ?> </b>: <br>
								<a href="mailto:<?php echo $BUYER->email; ?>"
								style="color: #40ACC7; text-decoration: none"><?php echo $BUYER->email; ?>
							</a><br> <br> &#8226; <b><?php echo MaianText::_( _msg_sales35); ?> </b>:
								<br> <?php echo $BUYER->p_date; ?><br> <br> &#8226; <b><?php echo MaianText::_( _msg_sales36); ?>
							</b>: <br> <?php echo nl2br(cleanData($BUYER->address)); ?><br> <br>
								&#8226; <b><?php echo MaianText::_( _msg_sales37); ?> </b>: <br> <?php echo ($BUYER->memo ? nl2br(cleanData($BUYER->memo)) : 'N/A'); ?><br>
								<br> &#8226; <b><?php echo MaianText::_( _msg_sales38); ?> </b>: <br>
								<?php echo $BUYER->payment_status; ?><br> <br> &#8226; <b><?php echo MaianText::_( _msg_sales39); ?>
							</b>: <br> <?php echo get_cur_symbol(number_format($BUYER->gross,2),$SETTINGS->paypal_currency); ?>
								/ <?php echo get_cur_symbol(number_format($BUYER->fee,2),$SETTINGS->paypal_currency); ?>
								/ <?php echo get_cur_symbol(number_format($BUYER->gross-$BUYER->fee,2),$SETTINGS->paypal_currency); ?><br>
								<br> &#8226; <b><?php echo MaianText::_( _msg_sales40); ?> </b>: <br>
								<?php echo $BUYER->txn_id; ?><br> <br> <?php }else{ ?> &#8226; <b><?php echo MaianText::_( _msg_sales33); ?>
							</b>: <br> <?php echo MaianText::_(_msg_script5); ?>:<input
								id="first_name" name="first_name"
								value="<?php echo cleanData($BUYER->first_name);?>" /><br> <br>
								<?php echo MaianText::_(_msg_script6); ?>:<input id="last_name"
								name="last_name"
								value="<?php echo cleanData($BUYER->last_name); ?>" /><br> <br>
								&#8226; <b><?php echo MaianText::_( _msg_sales34); ?> </b>: <br> <input
								id="email" name="email" value="<?php echo $BUYER->email; ?>" /><br>
								<br> &#8226; <b><?php echo MaianText::_( _msg_sales35); ?> </b>: <br>
								<?php echo $BUYER->p_date; ?><br> <br> &#8226; <b><?php echo MaianText::_( _msg_sales36); ?>
							</b>: <br> <?php echo nl2br(cleanData($BUYER->address)); ?><br> <br>
								&#8226; <b><?php echo MaianText::_( _msg_sales37); ?> </b>: <br> <?php echo ($BUYER->memo ? nl2br(cleanData($BUYER->memo)) : 'N/A'); ?><br>
								<br> &#8226; <b><?php echo MaianText::_( _msg_sales38); ?> </b>: <br>
								<input id="payment_status" name="payment_status"
								value="<?php echo $BUYER->payment_status; ?>" /><br> <br>
								&#8226; <b><?php echo MaianText::_( _msg_sales39); ?> </b>: <br> <?php echo get_cur_symbol(number_format($BUYER->total,2),$SETTINGS->paypal_currency); ?>
								/ <input id="fee" name="fee" value="<?php echo $BUYER->fee; ?>" /><br>
								<br> &#8226; <b><?php echo MaianText::_( _msg_sales40); ?> </b>: <br>
								<input id="txn_id" name="txn_id"
								value="<?php echo $BUYER->txn_id; ?>" /><br> <br> <input
								type="hidden" id="invoice_id" name="invoice_id"
								value="<?php echo $BUYER->invoice; ?>" /> <input type="hidden"
								id="cart_code" name="cart_code"
								value="<?php echo $BUYER->cart_code; ?>" /> <input type="hidden"
								id="download_code" name="download_code"
								value="<?php echo $BUYER->download_code; ?>" /> <input
								type="hidden" id="gross" name="gross"
								value="<?php echo $BUYER->total; ?>" /> <?php }?> &#8226; <b><?php echo MaianText::_( _msg_sales41); ?>
							</b>: <br> <?php echo $BUYER->invoice; ?><br> <br>
							</td>
							<td align="left" width="50%"
								style="padding: 5px; border-left: 1px solid #40ACC7"
								valign="top"><span class="orange">[ <?php echo MaianText::_( _msg_sales15); ?>
									]</span><br> <br> <?php

									$db->setQuery("SELECT * FROM #__m15_albums
                     WHERE id IN (".$purchases[0].") AND is_album = '1'
                     ORDER BY name");	  
									$q_album  = $db->loadObjectList();

									if (count($q_album)>0)
									{      	 foreach ($q_album as $ALBUM ){
										echo '&#8226; '.cleanData($ALBUM->name).'<br>
                <span class="italics">'.MaianText::_( _msg_sales19).' '.cleanData($ALBUM->artist).'</span><br><br>
                ';
									}
									}
									else
									{
										echo MaianText::_( _msg_sales17).'<br><br>';
									}

									?> <span class="orange">[ <?php echo MaianText::_( _msg_sales16); ?>
									]</span><br> <br> <?php

									$db->setQuery("SELECT * FROM #__m15_tracks
                               WHERE id IN (".$purchases[1].")
                               ORDER BY track_album,track_name
                               ");
									$q_tracks  = $db->loadObjectList();
									if (count($q_tracks)>0)
									{
										foreach ($q_tracks as $TRACKS){
											$ad = $this->getAlbumData($TRACKS->track_album,true);

											echo '&#8226; '.cleanData($TRACKS->track_name).'<br>
                <span class="italics">'.cleanData($ad->name).'/'.cleanData($ad->artist).'</span><br><br>';
										}
									}
									else
									{
        echo MaianText::_( _msg_sales18); 
      }
        
      ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>

</body>
</html>
