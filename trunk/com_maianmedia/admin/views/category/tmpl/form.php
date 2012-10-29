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

$editor =& JFactory::getEditor();
$row= $this->categories;
$cid = JRequest::getVar( 'cid', '0', 'REQUEST');

$active =  ( $row->image_position ? $row->image_position : 'left' );
$lists['image_position'] 	= JHTML::_('list.positions',  'image_position', $active, NULL, 0, 0 );

$query = 'SELECT ordering AS value, title AS text'
. ' FROM #__m15_categories'
. ' WHERE section =\'com_maianmedia\''
. ' ORDER BY ordering';

if(isset($row->image)){
	if(count($row) == 0){
		if ($row->image == '') {
			$row->image = 'blank.png';
		}
	}
}
JFilterOutput::objectHTMLSafe( $row, ENT_QUOTES, 'description' );
$cparams = JComponentHelper::getParams ('com_media');
?>
<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton, section) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			if ( form.title.value == "" ) {
				alert("<?php echo MaianText::_( 'Category must have a title', true ); ?>");
			} else {
				<?php
				echo $editor->save( 'description' ) ; ?>
				submitform(pressbutton);
			}
		}
		</script>

<form action="index.php" method="post" name="adminForm">

	<div class="col width-60">
		<fieldset class="adminform">
			<legend>
			<?php echo MaianText::_( 'Details' ); ?>
			</legend>

			<table class="admintable">
				<tr>
					<td class="key"><label for="title" width="100"> <?php echo MaianText::_( 'Title' ); ?>:
					</label></td>
					<td colspan="2"><input class="text_area" type="text" name="title"
						id="title" value="<?php echo $row->title; ?>" size="50"
						maxlength="50"
						title="<?php echo MaianText::_( 'A long name to be displayed in headings' ); ?>" />
					</td>
				</tr>
				<tr>
					<td class="key"><label for="alias"> <?php echo MaianText::_( 'Alias' ); ?>:
					</label></td>
					<td colspan="2"><input class="text_area" type="text" name="alias"
						id="alias" value="<?php echo $row->alias; ?>" size="50"
						maxlength="255"
						title="<?php echo MaianText::_( 'A short name to appear in menus' ); ?>" />
					</td>
				</tr>
				<tr>
					<td width="120" class="key"><?php echo MaianText::_( 'Published' ); ?>:</td>
					<td>
						<fieldset class="radio">
						<?php echo JHTML::_('select.booleanlist',  'published', 'class="inputbox"', $row->published ); ?>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td class="key"><label for="ordering"> <?php echo MaianText::_( 'Ordering' ); ?>:
					</label></td>
					<td colspan="2"><?php echo JHTML::_('list.specificordering',  $row->ordering, $cid[0], $query ); ?>
					</td>
				</tr>
				<tr>
					<td class="key"><label for="image"> <?php echo MaianText::_( 'Image' ); ?>:
					</label></td>
					<td><?php echo JHTML::_('list.images',  'image', $row->image ); ?>
					</td>
				</tr>
				<tr>
					<td class="key"><label for="image_position"> <?php echo MaianText::_( 'Image Position' ); ?>:
					</label></td>
					<td><?php echo JHTML::_('list.positions',  'image_position', $active, NULL, 0, 0 );?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><script language="javascript" type="text/javascript">
						if (document.forms.adminForm.image.options.value!=''){
							jsimg='../<?echo $cparams->get('image_path'); ?>/' + getSelectedValue( 'adminForm', 'image' );
						} else {
							jsimg='../images/M_images/blank.png';
						}
						document.write('<img src=' + jsimg + ' name="imagelib" width="80" height="80" border="2" alt="<?php echo MaianText::_( 'Preview', true ); ?>" />');
						</script></td>
				</tr>

			</table>
		</fieldset>

		<fieldset class="adminform">
			<legend>
			<?php echo MaianText::_( 'Description' ); ?>
			</legend>

			<table class="admintable">
				<tr>
					<td valign="top" colspan="3"><?php
					// parameters : areaname, content, width, height, cols, rows, show xtd buttons
					echo $editor->display( 'description',  htmlspecialchars($row->description, ENT_QUOTES), '550', '300', '60', '20', array('pagebreak', 'readmore'));
					?>
					</td>
				</tr>
			</table>
		</fieldset>
	</div>
	<div class="clr"></div>

	<input type="hidden" name="option" value="com_maianmedia" /> <input
		type="hidden" name="oldtitle" value="<?php echo $row->title ; ?>" /> <input
		type="hidden" name="id" value="<?php echo $row->id; ?>" /> <input
		type="hidden" name="task" value="" /> <input type="hidden"
		name="section" value="com_maianmedia" /> <input type="hidden"
		name="controller" value="category" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
