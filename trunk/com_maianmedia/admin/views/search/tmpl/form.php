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

//TODO From the orginal script, need to change this to read from xml and be customized by users.
require_once(JPATH_COMPONENT.DS.'common'.DS.'cal_array.inc.php'); ?>

<?php

$document = &JFactory::getDocument();
$document->addScript( 'components/com_maianmedia/js/js_code.js' );
JHTML::_('behavior.calendar');
?>

<fieldset style="background-color: #FFF" class="adminform">
	<legend>
	<?php echo MaianText::_( _msg_search2); ?>
	</legend>
	<table class="admintable">
		<tr>
			<td>
				<form method=POST
					action="index.php?option=com_maianmedia&controller=sales&format=raw&task=export">
					<table id="sales_search">

						<tr>
							<td class="key"><?php echo MaianText::_( _msg_search3); ?></td>
							<td><input class="formBox" type="text" name="name"
								maxlength="250" size="30"
								value="<?php echo (isset($_POST['name']) ? cleanData($_POST['name']) : ''); ?>">
							</td>

							<td class="key"><?php echo MaianText::_( _msg_search4); ?></td>
							<td><input class="formBox" type="text" name="email"
								maxlength="250" size="30"
								value="<?php echo (isset($_POST['email']) ? cleanData($_POST['email']) : ''); ?>">
							</td>

							<td class="key"><?php echo MaianText::_( _msg_search5); ?></td>
							<td><input class="formBox" type="text" name="invoice"
								maxlength="250" size="30"
								value="<?php echo (isset($_POST['invoice']) ? cleanData($_POST['invoice']) : ''); ?>">
							</td>

							<td class="key"><?php echo MaianText::_( _msg_search6); ?></td>
							<td><input class="formBox" type="text" name="txn_id"
								maxlength="250" size="30"
								value="<?php echo (isset($_POST['txn_id']) ? cleanData($_POST['txn_id']) : ''); ?>">
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td class="key" valign="top"><?php echo MaianText::_( _msg_search7); ?>
							</td>
							<td colspan=3><input type="text" name="start_date"
								id="start_date" value="" /><img class="calendar"
								src="templates/system/images/calendar.png" alt="calendar"
								id="start_date_img" /> <script type="text/javascript">
        Calendar.setup(
          {
            inputField  : "start_date",         // ID of the input field
            ifFormat    : "%Y-%m-%d",    // the date format
            button      : "start_date_img"       // ID of the button
          }
        );
      </script> <input type="text" name="end_date" id="end_date"
								value="" /><img class="calendar"
								src="templates/system/images/calendar.png" alt="calendar"
								id="end_date_img" /> <script type="text/javascript">
        Calendar.setup(
          {
            inputField  : "end_date",         // ID of the input field
            ifFormat    : "%Y-%m-%d",    // the date format
            button      : "end_date_img"       // ID of the button
          }
        );
      </script>
							</td>
							<td>
								<fieldset class="radio">
									<input id="active_cart_search_yes" type="radio"
										name="active_cart_search" value="1" checked /> <label
										for="active_cart_search_yes"><?php echo MaianText::_( _msg_active);?>
									</label> <input id="active_cart_search_no" type="radio"
										name="active_cart_search" value="0"> <label
										for="active_cart_search_no"><?php echo MaianText::_( _msg_inactive);?>
									</label>
								</fieldset>
							</td>
						</tr>

						<tr>
							<td><INPUT class="search" TYPE=SUBMIT
								VALUE="<?php echo MaianText::_(_msg_csv); ?>"> <!-- a href="index.php?option=com_maianmedia&controller=sales&format=raw&task=export"><?php echo MaianText::_(_msg_csv); ?></a-->
							</td>
							<!-- td>
      		<input type="radio" name="csv" value="0"><?php echo MaianText::_(_msg_csv_album); ?>
            <input type="radio" name="csv" value="1"><?php echo MaianText::_(_msg_csv_sale); ?>
      	</td-->
						</tr>
					</table>
				</form>
			</td>
		</tr>
		<tr>
			<td><input id="search_sales"
				onclick="ajaxRequest('sales', 'index.php?option=com_maianmedia&controller=sales&format=raw&task=getSales', '1');"
				class="search" type="submit"
				value="<?php echo MaianText::_( _msg_search8); ?>"
				title="<?php echo MaianText::_( _msg_search8); ?>"></input></td>
		</tr>
	</table>
</fieldset>
<span id="mm_contact"> <input type="hidden" name="runModal" value="true" />
	<fieldset style="background-color: #FFF" id="sales" class="adminform">

	</fieldset>