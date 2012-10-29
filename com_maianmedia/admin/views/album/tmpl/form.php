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

$db =& JFactory::getDBO();
include_once(JPATH_COMPONENT.DS.'common'.DS.'functions.php');
$editor =& JFactory::getEditor();

$document = &JFactory::getDocument();
$uri =& JURI::getInstance();

$db->setQuery("SELECT * FROM #__m15_settings Limit 1");
$settings = $db->loadObject();

$album = $this->album;

JHTML::_('behavior.modal', 'a.modal-button');

$document->addCustomTag('
<script type="text/javascript">
function jInsertEditorText(value, tag)
{
	
	if(tag != \'comments\'){

    	value = value.substring(value.indexOf("\"")+1,value.length);
		value = value.substring(0,value.indexOf("\""));
		var x = document.getElementById(tag);
		x.value = "'.$uri->root().'/"+value;
	}else{
		tinyMCE.execInstanceCommand(tag, \'mceInsertContent\',false,value);
	}
	
}
	
</script>
');

//$document->addScript( $uri->root().'components/com_maianmedia/ajax/request.js' );
// Are we in edit mode?

?>
<form enctype="multipart/form-data" action="index.php" method="post"
	id="adminForm" name="adminForm">
	<input type="hidden" name="process" value="1">
	<fieldset style="background-color: #FFF" class="adminform">
		<legend>
		<?php echo (isset($EDIT) ? MaianText::_( _msg_albums10) : MaianText::_( _msg_albums2)); ?>
		</legend>
		<table class="admintable" width="100%" cellspacing="1" cellpadding="0">
			<tr>
				<td align="left">
					<table cellspacing="0" cellpadding="0">
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_albums11); ?></td>
							<td align="left" style="padding: 5px" width="70%"><input
								class="formBox" type="text" name="artist" maxlength="250"
								size="30"
								value="<?php echo (isset($this->album->artist) ? cleanData($this->album->artist) : ''); ?>">
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_(_msg_label); ?></td>
							<td align="left" style="padding: 5px" width="70%"><input
								class="formBox" type="text" name="label" maxlength="250"
								size="30"
								value="<?php echo (isset($this->album->label) ? cleanData($this->album->label) : ''); ?>">
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_albums3); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="name" maxlength="250" size="30"
								value="<?php echo (isset($this->album->name) ? cleanData($this->album->name) : ''); ?>">
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_albums16); ?></td>
							<td align="left" style="padding: 5px"><select name="cat">
									<option value="0">
									<?php echo MaianText::_( _msg_albums18); ?>
									</option>
									<?php
									$db->setQuery("SELECT * FROM #__m15_categories WHERE section = 'com_maianmedia'
                                 ORDER BY ordering");		
									$q_cat = $db->loadObjectList();
									if (count($q_cat) > 0) {

										foreach ($q_cat as $CAT) {
											if(isset($this->album->cat)){?>
									<option value="<?php echo $CAT->id; ?>"
									<?php echo ($this->album->cat==$CAT->id ? ' selected="selected"' : ''); ?>>
										<?php echo cleanData($CAT->title); ?>
									</option>
									<?php }else{ ?>
									<option value="<?php echo $CAT->id; ?>">
									<?php echo cleanData($CAT->title); ?>
									</option>
									<?php }
										}
									}
									?>
							</select>
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_albums5); ?></td>
							<td class="uploadBox" align="left" style="padding: 5px"><input
								id="image" class="formBox" type="text" name="image"
								maxlength="250" size="30"
								value="<?php echo (isset($this->album->image) ? cleanData($this->album->image) : 'http://'); ?>">
								<a class="modal-button" title="Image"
								href="index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;e_name=image&amp;image_target=1"
								rel="{handler: 'iframe', size: {x: 570, y: 400}}"><img
									src="<? echo $uri->root(); ?>administrator/components/com_maianmedia/images/upload.png" />
							</a>&nbsp;<?php echo MaianText::_(toolTip( _msg_javascript, _msg_javascript12)); ?>
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_albums6); ?></td>
							<td class="uploadBox" align="left" style="padding: 5px"><input
								id="artwork" class="formBox" type="text" name="artwork"
								maxlength="250" size="30"
								value="<?php echo (isset($this->album->artwork) ? cleanData($this->album->artwork) : 'http://'); ?>">
								<a class="modal-button" title="Image"
								href="index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;e_name=artwork&amp;image_target=1"
								rel="{handler: 'iframe', size: {x: 570, y: 400}}"><img
									src="<? echo $uri->root(); ?>administrator/components/com_maianmedia/images/upload.png" />
							</a>&nbsp;<?php echo MaianText::_(toolTip( _msg_javascript, _msg_javascript13)); ?>
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_albums12); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="keywords" maxlength="250" size="30"
								value="<?php echo (isset($this->album->keywords) ? cleanData($this->album->keywords) : ''); ?>">
								<?php echo MaianText::_(toolTip( _msg_javascript, _msg_javascript22)); ?>
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_UPC); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="upc" maxlength="250" size="30"
								value="<?php echo (isset($this->album->upc) ? cleanData($this->album->upc) : ''); ?>">
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_RM); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="RM" maxlength="250" size="30"
								value="<?php echo (isset($this->album->RM) ? cleanData($this->album->RM) : ''); ?>">
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_albums19); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="discount" size="30" style="width: 20%"
								value="<?php echo (isset($this->album->discount) ? cleanData($this->album->discount) : ''); ?>">
								<fieldset class="radio">
									<input class="styled" id="discount_type_percent" type="radio"
										name="discount_type" value="0"
										<?php echo (isset($this->album->discount_type) && !$this->album->discount_type ? ' checked' : (!isset($this->album->discount_type) ? ' checked' : '')); ?>>
									<label for="discount_type_percent">%</label> <input
										class="styled" id="discount_type_currency" type="radio"
										name="discount_type" value="1"
										<?php echo (isset($this->album->discount_type) && $this->album->discount_type ? ' checked' : (!isset($this->album->discount_type) ? ' checked' : '')); ?>>
									<label for="discount_type_currency"><?php echo get_cur_symbol('',$settings->paypal_currency); ?>
									</label>
								</fieldset> <?php echo MaianText::_(toolTip( _msg_javascript, _msg_javascript23)); ?>
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo MaianText::_(_msg_physical); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="dimensions_height" maxlength="250" size="30"
								value="<?php echo (isset($this->album->dimensions_height) ? cleanData($this->album->dimensions_height) : ''); ?>">
							</td>
						</tr>
						<?php
						if (isset($this->album))
						{
							?>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_albums15); ?></td>
							<td align="left" style="padding: 5px"><input class="formBox"
								type="text" name="hits" size="30" style="width: 10%"
								value="<?php echo (isset($this->album->hits) ? cleanData($this->album->hits) : ''); ?>">
							</td>
						</tr>
						<?php
						}
						?>
						<tr>
							<td class="key"><?php echo MaianText::_( _msg_albums8); ?></td>
							<td>
								<fieldset class="radio">
									<input class="styled" id="status_yes" type="radio"
										name="status" value="1"
										<?php echo (isset($this->album->status) && $this->album->status ? ' checked' : (!isset($this->album->status) ? ' checked' : '')); ?>>
									<label for="status_yes"><?php echo MaianText::_( _msg_script2); ?>
									</label> <input class="styled" id="status_no" type="radio"
										name="status" value="0"
										<?php echo (isset($this->album->status) && !$this->album->status ? ' checked' : ''); ?>>
									<label for="status_no"><?php echo MaianText::_( _msg_script3); ?> </label>
								</fieldset> <?php echo MaianText::_(toolTip( _msg_javascript, _msg_javascript14)); ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset style="background-color: #FFF" class="adminform">
		<legend>
		<?php echo MaianText::_( _msg_albums7); ?>
			&nbsp;<i>(<?php echo MaianText::_( _msg_script4); ?>)</i>
		</legend>
		<?php echo $editor->display('comments', isset($this->album->comments)? cleanData($this->album->comments):'', '550', '400', '60', '20', true);?>
	</fieldset>
	<input type="hidden" name="option" value="com_maianmedia" /> <input
		type="hidden" name="task" value="" /> <input type="hidden"
		name="is_album" value="1" /> <input type="hidden" name="controller"
		value="albums" /> <input type="hidden" name="id"
		value="<?php echo (isset($this->album->id) ? cleanData($this->album->id) : ''); ?>" />
</form>
