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

//I guess getUserStateFromRequest is for session or different reasons
$mainframe = &JFactory::getApplication();
$lim   = $mainframe->getUserStateFromRequest("com_maianmedia.limit", 'limit', 5, 'int');
$lim0  = JRequest::getVar('limitstart', 0, '', 'int');
jimport('joomla.html.pagination');
$pageNav = new JPagination(JRequest::getVar('pagnation'), $lim0, $lim );
$catGroup = $this->categories;

?>
<form action="index.php" method="post" name="adminForm">
	<div id="editcell">
		<p>
			<b><?php echo MaianText::_( _msg_header10); ?> </b> <br> <br>
			<?php echo MaianText::_(_msg_categories_desc); ?>
		</p>
		<table class="adminlist" width="100%" cellspacing="1" cellpadding="0">
			<thead>
				<tr>
					<th>#</th>
					<th width="20"><input type="checkbox"
						onclick="checkAll(<?php echo count($catGroup); ?>);" value=""
						name="toggle" />
					</th>
					<th width="8%" nowrap="nowrap"><?php 	$image = JHTML::_('image.administrator',  'filesave.png', '/components/com_maianmedia/images/', NULL, NULL, MaianText::_( 'Save Order' ) );
					$href = '<a href="javascript:saveorder('.(count( $catGroup ) -1).', \'saveOrder\')" title="'.MaianText::_( 'Save Order' ).'">'.$image.'</a>';
					echo MaianText::_(_msg_tableh4).' '.$href;?>
					</th>
					<th><?php echo MaianText::_(_msg_tableh1); ?></th>
					<th><?php echo MaianText::_(_msg_tableh3); ?></th>
					<th><?php echo MaianText::_(_msg_tableh2); ?></th>
					<th>ID</th>
				</tr>
			</thead>
			<?php
			if (count($catGroup) > 0)
			{

				$k = 0;
				for ($i=0; $i<count($catGroup); $i++){
					$row = &$catGroup[$i];
					$checked 	= JHTML::_('grid.id',   $i, $row->id );
					$link 		= JRoute::_( 'index.php?option=com_maianmedia&view=category&controller=category&task=edit&cid[]='. $row->id );
					$published = JHTML::_('grid.published',$row, $i);
					?>
			<tr class="<?php echo "row$k"; ?>">
				<td width="2%"><?php echo $lim0+$i+1; ?>
				</td>
				<td width="2%"><?php echo $checked; ?>
				</td>
				<td class="order"><input type="text" name="order[]" size="5"
					value="<?php echo $row->ordering; ?>" class="text_area"
					style="text-align: center" />
				</td>
				<td><a href="<?php echo $link; ?>"><?php echo $row->title; ?> </a>
				</td>
				<td><?php echo $row->alias; ?>
				</td>
				<td width="10%" class="title" align="center"><?php echo $published ?>
				</td>
				<!-- td width="10%" class="title" align="center"><img height="16" border="0" style="cursor:pointer;" width="16" alt="<?php echo ($row->status == 0) ? MaianText::_('UNPUBLISHED') : MaianText::_('PUBLISHED'); ?>" src="<?php echo $is15 ? 'images':'../images/admin' ?>/<?php echo ($row->status == 1) ? 'tick' : 'publish_x';?>.png" onclick="javascript:$$('.inputs').removeProperty('checked');$('cb<?php echo $i ?>').checked='checked';isChecked($('cb<?php echo $i ?>').checked);submitbutton('<?php echo ($row->status == 1) ? 'un' : '';?>publish_album');" /></td-->
				<td width="2%"><?php echo $row->id; ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
				}
				?>
			<tfoot>
				<tr>
					<td colspan="15"><?php echo $pageNav->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>

			<?php
			} else {
				?>
			<tr>
				<td colspan=8 align="center"
					style="padding: 10px 0 10px 0; border-top: 1px solid #40ABC6"><?php echo MaianText::_(_msg_categories2); ?>
				</td>
			</tr>
			<?php
			}
			?>
		</table>
	</div>
	<input type="hidden" name="option" value="com_maianmedia" /> <input
		type="hidden" name="task" value="" /> <input type="hidden"
		name="boxchecked" value="1" /> <input type="hidden" name="controller"
		value="category" />
</form>
