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

include_once(JPATH_COMPONENT.DS.'common'.DS.'functions.php');
$editor =& JFactory::getEditor();

$product = $this->getProduct();

JHTML::_('behavior.modal', 'a.modal-button');

?>
<form enctype="multipart/form-data" action="index.php" method="post"
	id="adminForm" name="adminForm">
	<input type="hidden" name="process" value="1">
	<fieldset style="background-color: #FFF" class="adminform">
		<legend>
		<?php echo MaianText::_( _msg_product_default); ?>
		</legend>
		<table class="admintable" width="100%" cellspacing="1" cellpadding="0">
			<tr>
				<td align="left">
					<table cellspacing="0" cellpadding="0">
						<tr>
							<td class="key"><?php echo MaianText::_(_msg_product_name); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="name" maxlength="250" size="30"
								value="<?php echo (isset($product->name) ? cleanData($product->name) : ''); ?>">
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_albums16); ?></td>
							<td align="left" style="padding: 5px">
							<?php echo $this->selectCategories();?>
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_(_msg_product_image); ?></td>
							<td class="uploadBox" align="left" style="padding: 5px"><input
								id="artwork" class="formBox" type="text" name="artwork"
								maxlength="250" size="30"
								value="<?php echo (isset($product->artwork) ? cleanData($product->artwork) : 'http://'); ?>">
								<a class="modal-button" title="Image"
								href="index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;e_name=artwork&amp;image_target=1"
								rel="{handler: 'iframe', size: {x: 570, y: 400}}"><img
									src="<? echo JURI::root(); ?>administrator/components/com_maianmedia/images/upload.png" />
							</a>&nbsp;<?php echo MaianText::_(toolTip( _msg_javascript, _msg_javascript13)); ?>
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_product_height); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="dimensions_height" maxlength="250" size="30"
								value="<?php echo (isset($product->dimensions_height) ? cleanData($product->dimensions_height) : ''); ?>">
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_product_width); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="dimensions_width" maxlength="250" size="30"
								value="<?php echo (isset($product->dimensions_width) ? cleanData($product->dimensions_width) : ''); ?>">
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_(_msg_add11); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="physical" maxlength="250" size="30"
								value="<?php echo (isset($product->physical) ? cleanData($product->physical) : ''); ?>">
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_(_msg_product_discount); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="discount" size="30" style="width: 20%"
								value="<?php echo (isset($product->discount) ? cleanData($product->discount) : ''); ?>">
								<fieldset class="radio">
									<input class="styled" id="discount_type_percent" type="radio"
										name="discount_type" value="0"
										<?php echo (isset($product->discount_type) && !$product->discount_type ? ' checked' : (!isset($product->discount_type) ? ' checked' : '')); ?>>
									<label for="discount_type_percent">%</label> <input
										class="styled" id="discount_type_currency" type="radio"
										name="discount_type" value="1"
										<?php echo (isset($product->discount_type) && $product->discount_type ? ' checked' : (!isset($product->discount_type) ? ' checked' : '')); ?>>
									<label for="discount_type_currency"><?php echo get_cur_symbol('',$settings->paypal_currency); ?>
									</label>
									<?php echo MaianText::_(toolTip( _msg_javascript, _msg_javascript23)); ?>
								</fieldset>
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_UPC); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="upc" maxlength="250" size="30"
								value="<?php echo (isset($product->upc) ? cleanData($product->upc) : ''); ?>">
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_RM); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="RM" maxlength="250" size="30"
								value="<?php echo (isset($product->RM) ? cleanData($product->RM) : ''); ?>">
							</td>
						</tr>

						<tr>
							<td class="key"><?php echo MaianText::_( _msg_albums12); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="keywords" maxlength="250" size="30"
								value="<?php echo (isset($product->keywords) ? cleanData($product->keywords) : ''); ?>">
								<?php echo MaianText::_(toolTip( _msg_javascript, _msg_javascript22)); ?>
							</td>
						</tr>
						<?php
						if (isset($product))
						{
							?>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_albums15); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="hits" size="30" style="width: 10%"
								value="<?php echo (isset($product->hits) ? cleanData($product->hits) : ''); ?>">
							</td>
						</tr>
						<?php
						}
						?>
						<tr>
							<td class="key"><?php echo MaianText::_(_msg_product_enable); ?></td>
							<td>
								<fieldset class="radio">
									<input class="styled" id="status_yes" type="radio"
										name="status" value="1"
										<?php echo (isset($product->status) && $product->status ? ' checked' : (!isset($product->status) ? ' checked' : '')); ?>>
									<label for="status_yes"><?php echo MaianText::_( _msg_script2); ?>
									</label> <input class="styled" id="status_no" type="radio"
										name="status" value="0"
										<?php echo (isset($product->status) && !$product->status ? ' checked' : ''); ?>>
									<label for="status_no"><?php echo MaianText::_( _msg_script3); ?> </label>
									<?php echo MaianText::_(toolTip( _msg_javascript, _msg_javascript14)); ?>
								</fieldset> 
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset style="background-color: #FFF" class="adminform">
		<legend>
		<?php echo MaianText::_( _msg_product_type); ?>
		</legend>
		<table class="admintable" width="100%" cellspacing="1" cellpadding="0">
			<tr>
				<td align="left">
					<table cellspacing="0" cellpadding="0">
						<tr>
							<td class="key"><?php echo MaianText::_(_msg_product_type); ?></td>
							<td align="left" style="padding: 5px">
							<?php echo $this->selectItemTypes();?>
							</td>
						</tr>
					</table>
					<div id="type-preview">
					<?php echo$this->renderTypes($product->label, '')?>
					</div>
				</td>
			</tr>
		</table>
		<div id="item_types">
			<div id="item_params">
			</div>
		</div>
	</fieldset>
	<fieldset style="background-color: #FFF" class="adminform">
		<legend>
		<?php echo MaianText::_(_msg_product_description); ?>
			&nbsp;<i>(<?php echo MaianText::_( _msg_script4); ?>)</i>
		</legend>
		<?php echo $editor->display('comments', isset($product->comments)? cleanData($product->comments):'', '550', '400', '60', '20', true);?>
	</fieldset>
	<input type="hidden" name="option" value="com_maianmedia" /> <input
		type="hidden" name="task" value="" /> <input type="hidden"
		name="is_album" value="1" /> <input type="hidden" name="controller"
		value="items" /> <input type="hidden" name="id"
		value="<?php echo (isset($product->id) ? cleanData($product->id) : ''); ?>" />
</form>
