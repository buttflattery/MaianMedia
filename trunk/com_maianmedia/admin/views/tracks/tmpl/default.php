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
$q_albums = $this->albums;
$uri =& JURI::getInstance();

$document = &JFactory::getDocument();
//$document->addScript( 'components/com_maianmedia/players/swfobject.js' );
$mainframe = &JFactory::getApplication();
//I guess getUserStateFromRequest is for session or different reasons
$lim   = $mainframe->getUserStateFromRequest("com_maianmedia.limit", 'limit', 5, 'int'); //I guess getUserStateFromRequest is for session or different reasons
$lim0  = JRequest::getVar('limitstart', 0, '', 'int');
jimport('joomla.html.pagination');
$pageNav = new JPagination(JRequest::getVar('pagnation'), $lim0, $lim );
$order  = JRequest::getVar('order');

?>
<form id="adminForm" action="index.php" enctype="multipart/form-data"
	method="post" name="adminForm">

	<fieldset class="adminform">
		<legend>
		<?php echo MaianText::_( _msg_header6); ?>
		</legend>
		<p>
		<?php echo MaianText::_( _msg_tracks); ?>
		</p>

		<b><?php echo MaianText::_( _msg_statistics2); ?> </b> <select
			onchange="if(this.value!= 0){location=this.options[this.selectedIndex].value}">
			<option style="padding-left: 3px"
				value="index.php?option=com_maianmedia&controller=tracks&view=tracks&task=manage">
				---</option>
			<option style="padding-left: 3px"
				value="index.php?option=com_maianmedia&controller=tracks&view=tracks&task=manage&fnc=sort&amp;order=name_asc<?php echo (isset($_GET['show']) ? '&amp;show='.$_GET['show'] : ''); ?>"
				<?php echo (isset($order)  && $order=='name_asc' ? ' selected="selected"' : ''); ?>>
				<?php echo MaianText::_( _msg_albumsnameAZ); ?>
			</option>
			<option style="padding-left: 3px"
				value="index.php?option=com_maianmedia&controller=tracks&view=tracks&task=manage&fnc=sort&amp;order=name_desc<?php echo (isset($_GET['show']) ? '&amp;show='.$_GET['show'] : ''); ?>"
				<?php echo (isset($order)  && $order=='name_desc' ? ' selected="selected"' : ''); ?>>
				<?php echo MaianText::_( _msg_albumsnameZA); ?>
			</option>
			<option style="padding-left: 3px"
				value="index.php?option=com_maianmedia&controller=tracks&view=tracks&task=manage&fnc=sort&amp;order=artist_asc<?php echo (isset($_GET['show']) ? '&amp;show='.$_GET['show'] : ''); ?>"
				<?php echo (isset($order)  && $order=='artist_asc' ? ' selected="selected"' : ''); ?>>
				<?php echo MaianText::_( _msg_artistAZ); ?>
			</option>
			<option style="padding-left: 3px"
				value="index.php?option=com_maianmedia&controller=tracks&view=tracks&task=manage&fnc=sort&amp;order=artist_desc<?php echo (isset($_GET['show']) ? '&amp;show='.$_GET['show'] : ''); ?>"
				<?php echo (isset($order)  && $order=='artist_desc' ? ' selected="selected"' : ''); ?>>
				<?php echo MaianText::_( _msg_artistZA); ?>
			</option>
		</select>

		<table class="adminlist" width="100%" cellspacing="1" cellpadding="0">
			<thead>
				<tr>
					<th>#</th>
					<th><?php echo MaianText::_(_msg_albums20); ?> (<?php echo count( $this->albums); ?>)</th>
					<th><?php echo MaianText::_(_msg_albums11); ?></th>
					<!-- th><?php echo MaianText::_(_msg_categories1); ?></th -->
					<th><?php echo MaianText::_(_msg_tracks5); ?></th>
					<th><?php echo MaianText::_(_msg_tracks3); ?></th>
				</tr>
			</thead>
			<?php
			if (count($q_albums)>0)
			{
					
				$k = 0;
				for ($i=0, $n=count( $q_albums ); $i < $n; $i++)	{
					$row = &$q_albums[$i];
					$checked 	= JHTML::_('grid.id',   $i, $row->id );
					//$link 		= JRoute::_( 'index.php?option=com_maianmedia&controller=tracks&task=edit&cid[]='. $row->id );

					?>
			<tr class="<?php echo "row$k"; ?>">
				<td><?php echo $i+1; ?>
				</td>
				<td><?php echo $row->name; ?>
				</td>
				<td><?php echo $row->artist; ?>
				</td>
				<!-- td></td-->
				<td align="center" width="20%">- <?php echo str_replace("{count}",rowCount('tracks',' WHERE track_album = \''.$row->id.'\''),MaianText::_( _msg_tracks2)); ?>
					-</td>
				<td align="center" width="10%"><?php echo (rowCount('tracks',' WHERE track_album = \''.$row->id.'\'')>0 ? '<a href="index.php?option=com_maianmedia&controller=tracks&amp;task=edit&amp;view=track&amp;cid='.$row->id.'&amp;limitstart='.$lim0.'"><img src="'.$uri->root().'/administrator/components/com_maianmedia/images/view.png" alt="'.MaianText::_( _msg_tracks3).'" title="'.MaianText::_( _msg_tracks3).'" border="0"></a>' : '<img src="'.$uri->root().'/administrator/components/com_maianmedia/images/view2.png" alt="'.MaianText::_( _msg_tracks4).'" title="'.MaianText::_( _msg_tracks4).'" border="0">'); ?>
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
				<td colspan=6 align="center" align="center"
					style="padding: 10px 0 10px 0; border-top: 1px solid #40ABC6"><?php echo MaianText::_( _msg_albums9); ?>
				</td>
			</tr>
			<?php
			}
			?>
		</table>
	</fieldset>
	<?php if(isset($order)){?>
	<input type="hidden" name="fnc"
		value="<?php echo JRequest::getVar('fnc');?>" /> <input type="hidden"
		name="order" value="<?php echo JRequest::getVar('order');?>" />
		<?php }?>
	<input type="hidden" name="option" value="com_maianmedia" /> <input
		type="hidden" name="task" value="manage" /> <input type="hidden"
		name="boxchecked" value="0" /> <input type="hidden" name="controller"
		value="tracks" />
</form>
