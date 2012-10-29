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
$q_albums = $this->albums;
$uri =& JURI::getInstance();
$version = JVERSION;

$is15 = strpos($version, "1.5") === false ? false:true;

$mainframe = &JFactory::getApplication();
$lim   = $mainframe->getUserStateFromRequest("com_maianmedia.limit", 'limit', 5, 'int'); //I guess getUserStateFromRequest is for session or different reasons
$lim0  = JRequest::getVar('limitstart', 0, '', 'int');

jimport('joomla.html.pagination');
$pageNav = new JPagination(JRequest::getVar('pagnation'), $lim0, $lim );
$order  = JRequest::getVar('order');

$db =& JFactory::getDBO();
$db->setQuery("SELECT * FROM #__m15_settings Limit 1");
$settings = $db->loadObject();
$is15 = strpos(JVERSION, "1.5") === false ? false:true;
?>
<form id="adminForm" action="index.php" method="post" name="adminForm">
	<div id="editcell">
		<p>
			<b><?php echo MaianText::_( _msg_header4); ?> </b> <br> <br>
			<?php echo MaianText::_( _msg_albums); ?>
		</p>
		<b><?php echo MaianText::_( _msg_statistics2); ?> </b> <select
			onchange="if(this.value!= 0){location=this.options[this.selectedIndex].value}">
			<option style="padding-left: 3px"
				value="index.php?option=com_maianmedia&controller=albums&view=albums&task=manage">
				---</option>
			<option style="padding-left: 3px"
				value="index.php?option=com_maianmedia&controller=albums&view=albums&task=manage&fnc=sort&amp;order=name_asc<?php echo (isset($_GET['show']) ? '&amp;show='.$_GET['show'] : ''); ?>"
				<?php echo (isset($order)  && $order=='name_asc' ? ' selected="selected"' : ''); ?>>
				<?php echo MaianText::_( _msg_albumsnameAZ); ?>
			</option>
			<option style="padding-left: 3px"
				value="index.php?option=com_maianmedia&controller=albums&view=albums&task=manage&fnc=sort&amp;order=name_desc<?php echo (isset($_GET['show']) ? '&amp;show='.$_GET['show'] : ''); ?>"
				<?php echo (isset($order)  && $order=='name_desc' ? ' selected="selected"' : ''); ?>>
				<?php echo MaianText::_( _msg_albumsnameZA); ?>
			</option>
			<option style="padding-left: 3px"
				value="index.php?option=com_maianmedia&controller=albums&view=albums&task=manage&fnc=sort&amp;order=artist_asc<?php echo (isset($_GET['show']) ? '&amp;show='.$_GET['show'] : ''); ?>"
				<?php echo (isset($order)  && $order=='artist_asc' ? ' selected="selected"' : ''); ?>>
				<?php echo MaianText::_( _msg_artistAZ); ?>
			</option>
			<option style="padding-left: 3px"
				value="index.php?option=com_maianmedia&controller=albums&view=albums&task=manage&fnc=sort&amp;order=artist_desc<?php echo (isset($_GET['show']) ? '&amp;show='.$_GET['show'] : ''); ?>"
				<?php echo (isset($order)  && $order=='artist_desc' ? ' selected="selected"' : ''); ?>>
				<?php echo MaianText::_( _msg_artistZA); ?>
			</option>
		</select>

		<table class="adminlist" width="100%" cellspacing="1" cellpadding="0">
			<thead>
				<tr>
					<th>#</th>
					<th width="20"><input type="checkbox"
						onclick="checkAll(<?php echo count( $this->albums); ?>);" value=""
						name="toggle" />
					</th>
					<th>ID</th>
					<th><?php echo MaianText::_( _msg_albums4); ?> (<?php echo count( $this->albums); ?>)</th>
					<th><?php echo MaianText::_(_msg_tableh2); ?></th>
					<th><?php echo MaianText::_(_msg_tracks5); ?></th>
					<th><?php echo MaianText::_(_msg_albums11); ?></th>
					<!-- th><?php echo MaianText::_(_msg_categories1); ?></th-->
					<th><?php echo MaianText::_(_msg_albums15); ?></th>
					<th><?php echo MaianText::_(_msg_discount); ?></th>
					<th><?php echo MaianText::_(_msg_tracks3); ?></th>

				</tr>
			</thead>
			<?php
			if (count($q_albums) > 0)
			{

				$k = 0;
				for ($i=0; $i<count($q_albums); $i++){
					$row = &$q_albums[$i];
					$row->published = $row->status;
					$checked 	= JHTML::_('grid.id',   $i, $row->id );
					$published = JHTML::_('grid.published',$row, $i);

					$db =& JFactory::getDBO();
					$db->setQuery('SELECT * FROM #__m15_categories WHERE id='.$row->cat);
					$cat = $db->loadObject();

					$link 		= JRoute::_( 'index.php?option=com_maianmedia&view=album&controller=albums&task=edit&cid[]='. $row->id );
					?>
			<tr class="<?php echo "row$k"; ?>">
				<td><?php echo $lim0+$i+1; ?>
				</td>
				<td><?php echo $checked; ?>
				</td>
				<td class="track_align"><?php echo $row->id; ?>
				</td>
				<td><a href="<?php echo $link; ?>"><?php echo $row->name; ?> </a>
				</td>
				<td width="10%" class="title" align="center"><?php echo $published ?>
				</td>
				<!-- td width="10%" class="title" align="center"><img height="16" border="0" style="cursor:pointer;" width="16" alt="<?php echo ($row->status == 0) ? MaianText::_('UNPUBLISHED') : MaianText::_('PUBLISHED'); ?>" src="<?php echo $is15 ? 'images':'../images/admin' ?>/<?php echo ($row->status == 1) ? 'tick' : 'publish_x';?>.png" onclick="javascript:$$('.inputs').removeProperty('checked');$('cb<?php echo $i ?>').checked='checked';isChecked($('cb<?php echo $i ?>').checked);submitbutton('<?php echo ($row->status == 1) ? 'un' : '';?>publish_album');" /></td-->
				<td class="track_align"><?php echo str_replace("{count}",rowCount('tracks',' WHERE track_album = \''.$row->id.'\''),MaianText::_( _msg_tracks2)); ?>
				</td>
				<td class="track_align"><?php echo $row->artist; ?>
				</td>
				<!-- td class="track_align">
				<?php echo ($cat->title != '') ? $cat->title: MaianText::_(_msg_albums18); ?> 
			</td -->
				<td class="track_align"><?php echo $row->hits; ?>
				</td>
				<td class="track_align"><?php echo ($row->discount_type == '1') ? get_cur_symbol('',$settings->paypal_currency) : ''?>
				<?php echo ($row->discount != '') ? $row->discount: '0'; ?> <?php echo ($row->discount_type == '' || $row->discount_type == '0') ? '%' : ''?>
				</td>
				<td class="track_align"><?php echo (rowCount('tracks',' WHERE track_album = \''.$row->id.'\'')>0 ? '<a href="index.php?option=com_maianmedia&controller=tracks&amp;task=edit&amp;view=track&amp;cid='.$row->id.'&amp;limitstart='.$lim0.'"><img class="view_tracks" src="'.$uri->root().'/administrator/components/com_maianmedia/images/view.png" alt="'.MaianText::_( _msg_tracks3).'" title="'.MaianText::_( _msg_tracks3).'" border="0"></a>' : '<img class="view_tracks" src="'.$uri->root().'/administrator/components/com_maianmedia/images/view2.png" alt="'.MaianText::_( _msg_tracks4).'" title="'.MaianText::_( _msg_tracks4).'" border="0">'); ?>
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
				<td colspan=9 align="center"
					style="padding: 10px 0 10px 0; border-top: 1px solid #40ABC6"><?php echo MaianText::_( _msg_albums9); ?>
				</td>
			</tr>
			<?php
			}
			?>
		</table>
	</div>
	<?php if(isset($order)){?>
	<input type="hidden" name="fnc"
		value="<?php echo JRequest::getVar('fnc');?>" /> <input type="hidden"
		name="order" value="<?php echo JRequest::getVar('order');?>" />
		<?php }?>
	<input type="hidden" name="option" value="com_maianmedia" /> <input
		type="hidden" name="task" value="" /> <input type="hidden"
		name="boxchecked" value="0" /> <input type="hidden" name="controller"
		value="albums" /> <input type="hidden" name="view" value="default" />
</form>
