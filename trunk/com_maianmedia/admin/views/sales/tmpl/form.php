<?php defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.calendar');

$db =& JFactory::getDBO();

$uri =& JURI::getInstance();
$settings = $this->_SETTINGS;
?>
<fieldset style="background-color: #FFF" class="adminform">
<legend><?php echo MaianText::_(_msg_header7); ?></legend>
<form id="adminForm" action="index.php?option=com_maianmedia&controller=sales&format=raw&task=export" method="post" name="adminForm">
		<p class="form_title"><?php echo MaianText::_(_msg_sales)?></p>
		<div style="width: 1170px;" class="slickGridContainer">
			<div class="grid-header" style="width: 100%">
				 <span style="float: right"
					class="ui-icon ui-icon-search" title="Toggle search panel"
					onclick="toggleFilterRow()"></span>
			</div>
			<div id="myGrid" style="width: 100%; height: 500px;"></div>
			<div id="pager" style="width: 100%; height: 20px;"></div>
			<div id="inlineFilterPanel"
				style="display: none; background: #dddddd; padding: 3px; color: black;">
				<table id="sales_search_top" width="100%">
					<tr>
						<td class="maian_key"><?php echo MaianText::_(_msg_sales41); ?></td>
						<td class="maian_value"><input class="formBox" type="text"
							id="name" name="name" maxlength="250" size="30"
							value="<?php echo (isset($_POST['name']) ? cleanData($_POST['name']) : ''); ?>">
						</td>

						<td class="maian_key"><?php echo MaianText::_( _msg_sales34); ?></td>
						<td class="maian_value"><input class="formBox" type="text"
							id="email" name="email" maxlength="250" size="30"
							value="<?php echo (isset($_POST['email']) ? cleanData($_POST['email']) : ''); ?>">
						</td>

						<td class="maian_key"><?php echo MaianText::_( _msg_sales45); ?></td>
						<td class="maian_value"><input class="formBox" type="text"
							id="invoice" name="invoice" maxlength="250" size="30"
							value="<?php echo (isset($_POST['invoice']) ? cleanData($_POST['invoice']) : ''); ?>">
						</td>

						<td class="maian_key"><?php echo MaianText::_( _msg_sales44); ?></td>
						<td class="maian_value"><input class="formBox" type="text"
							id="txn_id" name="txn_id" maxlength="250" size="30"
							value="<?php echo (isset($_POST['txn_id']) ? cleanData($_POST['txn_id']) : ''); ?>">
						</td>
					</tr>
				</table>
				<table id="sales_search_bottom" width="900px">
					<tr>
						<td class="maian_key"><?php echo MaianText::_( _msg_search7); ?></td>
						<td><input type="text" name="start_date" id="start_date" value="" /><img
							class="calendar" src="templates/system/images/calendar.png"
							alt="calendar" id="start_date_img" /> <input type="text"
							name="end_date" id="end_date" value="" /><img class="calendar"
							src="templates/system/images/calendar.png" alt="calendar"
							id="end_date_img" />
							<fieldset class="radio">
								<label for="active_cart_search_yes"><?php echo MaianText::_( _msg_active);?>
								</label> <input class="styled" id="active_cart_search_yes"
									type="radio" name="active_cart_search" value="1" checked /> <label
									for="active_cart_search_no"><?php echo MaianText::_( _msg_inactive);?>
								</label> <input class="styled" id="active_cart_search_no"
									type="radio" name="active_cart_search" value="0">
							</fieldset>
						</td>
					</tr>
					<tr>
						<td><INPUT class="search" TYPE=SUBMIT
							VALUE="<?php echo MaianText::_(_msg_csv); ?>">
						</td>
					</tr>
				</table>
				<!-- td>
	      		<input type="radio" name="csv" value="0"><?php echo MaianText::_(_msg_csv_album); ?>
	            <input type="radio" name="csv" value="1"><?php echo MaianText::_(_msg_csv_sale); ?>
	      	</td-->
			</div>
			<script>
    		<?=$this->displayGrid();?>
    	</script>
		</div>

	<input type="hidden" name="fnc"
		value="<?php echo JRequest::getVar('fnc'); ?>" /> <input type="hidden"
		name="order" value="<?php echo JRequest::getVar('order'); ?>" /> <input
		type="hidden" name="option" value="com_maianmedia" /> <input
		type="hidden" name="task" value="" /> <input type="hidden"
		name="controller" value="sales" /> <input type="hidden"
		name="boxchecked" value="0" /> <input type="hidden" name="view"
		value="sales" />
	<?php echo JHTML::_( 'form.token' ); ?>

</form>
</fieldset>