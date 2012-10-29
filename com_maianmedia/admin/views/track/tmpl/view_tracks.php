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
$mainframe = &JFactory::getApplication();
$lim   = $mainframe->getUserStateFromRequest("com_maianmedia.limit", 'limit', 5, 'int'); //I guess getUserStateFromRequest is for session or different reasons
$lim0  = JRequest::getVar('limitstart', 0, '', 'int');

$uri =& JURI::getInstance();
$root_url = $uri->root(); //root url
$root_base = $uri->base(); //base url
$root_current = $uri->current(); //current url pathj

$list = $this->tracks;

$albumId = $list[0]->track_album;

$db->setQuery("SELECT * FROM #__m15_albums WHERE id= $albumId LIMIT 1");

$Album = $db->loadObject();
$document = &JFactory::getDocument();

$this->initializeHeader();
$document->addCustomTag($this->sortablejs());
$this->initManager(true);
$document->addCustomTag($this->fileManagerjs(count($list)));

$i=0;
$html_output='';
//$html_output = '<div id="manage_top"><a class="manage_tracks" href="javascript:expandAll(\''.count($list).'\')">Expand All</a><a class="manage_tracks" href="javascript:collapseAll(\''.count($list).'\')">Collapse All</a></div>';
foreach ($list AS $TRACKS){

	$html_output.= "<li class=\"ui-state-default\" name=\"item_$TRACKS->id\" id=\"item_$TRACKS->id\"><div name=\"table_$TRACKS->id.\" id=\"table_$TRACKS->id\">";
	$html_output.='<fieldset  style="background-color: #FFF"  class="adminform"><legend id="legend_'.$TRACKS->id.'">Track '.$TRACKS->track_order.' </legend><img onclick="displayRow('.$i.')" class="toggle_track" src="'.$root_base.'components/com_maianmedia/images/expand.png"/>
		<span class="handle"><img class="image-handle" src="'.$root_base.'components/com_maianmedia/images/move.png"/></span>
		<input type="hidden" name="id[]" value="'.$TRACKS->id.'">
		<input type="hidden" name="t_path[]" value="'.$TRACKS->mp3_path.'">
      	<input type="hidden" name="t_name[]" value="'.cleanData($TRACKS->track_name).'">
      	<input type="hidden" name="t_cost[]" value="'.$TRACKS->track_cost.'">
      	
		<table class="admintable" cellspacing="0" cellpadding="0">
        <tr>
          <td class="key" width="30%">'.MaianText::_(_msg_add6).'</td>
          <td align="left" width="70%"><input class="formBox" type="text" name="track_name[]" maxlength="250" size="30" value="'.cleanData($TRACKS->track_name).'"></td>
        </tr>
        <tr id="albumRow_'.$i.'">
          <td class="key">'.MaianText::_(_msg_add7).'</td>
          <td align="left"><select name="track_album[]">';

	$db->setQuery("SELECT * FROM #__m15_albums WHERE is_album = '1' ORDER BY name");
	$q_albums = $db->loadObjectList();
	foreach ($q_albums as $ALBUMS){
		$html_output.='<option value="'.$ALBUMS->id.'"'.($_GET['cid']==$ALBUMS->id ? ' selected' : '').'>'.cleanData($ALBUMS->artist).' - '.cleanData($ALBUMS->name).'</option>'."\n";
	}


	$html_output.='</select></td>
        </tr>
        <tr id="mp3Row_'.$i.'">
          <td class="key">'.MaianText::_(_msg_add8).'</td>
          <td align="left" >
          <div>
          	<input class="formBox" type="text" name="mp3_path[]" maxlength="250" size="30" value="'.cleanData($TRACKS->mp3_path).'"> '.toolTip(MaianText::_(_msg_javascript),MaianText::_(_msg_javascript16)).'
          </div>
          <div class="uploader">
          	<a id="mp3_manager_'.$i.'" href=""><img src="'.$uri->root().'administrator/components/com_maianmedia/images/upload.png"/></a>
          </div>
          </td>
        </tr>
        <tr id="previewRow_'.$i.'">
          <td class="key">'.MaianText::_(_msg_add9).'</td>
          <td align="left" >
          <div>
          	<input class="formBox" type="text" name="preview_path[]" maxlength="250" size="30" value="'.cleanData($TRACKS->preview_path).'"> '.toolTip(MaianText::_(_msg_javascript),MaianText::_(_msg_javascript17)).'
          </div>
          <div class="uploader">
          	<a id="preview_manager_'.$i.'" href=""><img src="'.$uri->root().'administrator/components/com_maianmedia/images/upload.png"/></a>
          </div>
          </td>
        </tr>
        <tr id="keywordRow_'.$i.'">
        	<td class="key">Keywords</td>
            <td align="left"><input class="formBox" type="text" name="keywords[]" maxlength="250" size="80" value="'.cleanData($TRACKS->keywords).'"></td>
        </tr>
        <tr class="otherRow" id="otherRow_'.$i.'">
          <td colspan="2">
          <table width="100%" class="infoTable" cellspacing="0" cellpadding="0" style="border-bottom: 1px solid #E9E9E9;border-right: 1px solid #E9E9E9; background-color: #F6F6F6; color:#666;">
          <tr>
            <td align="left" >'.MaianText::_(_msg_add10).':</td>
            <td align="left" ><input class="formBox" type="text" name="track_length[]" maxlength="50" size="30" value="'.cleanData($TRACKS->track_length).'" style="width:70%"> '.toolTip(MaianText::_(_msg_javascript),MaianText::_(_msg_javascript18)).'</td>
            <td align="right" >'.MaianText::_(_msg_add11).':</td>
            <td align="left"  ><input class="formBox" type="text" name="track_cost[]" maxlength="5" size="30" value="'.cleanData($TRACKS->track_cost).'" style="width:50%"> '.toolTip(MaianText::_(_msg_javascript),MaianText::_(_msg_javascript19)).'</td>
            <td align="right" >'.MaianText::_(_msg_add12).':</td>
            <td align="left" class="box_single"><input type="checkbox" id="track_single" value="1" name="track_single_'.$i.'" '.($TRACKS->track_single ? ' checked' : '').'> '.toolTip(MaianText::_(_msg_javascript),MaianText::_(_msg_javascript20)).'</td>
          	<td align="right" >'.MaianText::_(_msg_free_download).':</td>
            <td align="left" ><input type="checkbox" value="1" '.($TRACKS->freebie == '1' ? ' checked' : '').' id="freebie" name="freebie_'.$i.'"/>'.toolTip(MaianText::_(_msg_free_download),MaianText::_(_msg_javascript)).'</td>
            </tr>
          </table>
          </td>      
        </tr>
        </table><a id="remove_'.$TRACKS->id.'" class="remove_track" href="javascript:removeTrack(\''.$TRACKS->id.'\')" title="'.MaianText::_(_msg_script8).'"><img src="'.$root_base.'components/com_maianmedia/images/remove.png"/></a></fieldset>';
	$html_output.= "</div></li>\n";
	//$html_output.= "<li id=\"item_$record->id\">$record->id<input class='formBox' type='text' name='website_name' maxlength='250' size='30'/></li>\n";
	$i= $i+1;
}

?>
<form id="adminForm" action="index.php" method="post" name="adminForm">
	<div id="album_top">
		<b><?php echo $Album->name; ?> </b>
	</div>
	<?php echo '<div id="manage_top"><a class="manage_tracks" href="javascript:expandAll(\''.count($list).'\')">'.MaianText::_(_msg_expand_all).'</a><a class="manage_tracks" href="javascript:collapseAll(\''.count($list).'\')">'.MaianText::_(_msg_collapse_all).'</a></div>'; ?>
	<ul id="sortable-list">
	<?php echo $html_output; ?>
	</ul>
	<input type="hidden" name="limitstart" value="<?php echo $lim0; ?>" />
	<input type="hidden" name="option" value="com_maianmedia" /> <input
		type="hidden" name="task" value="update" /> <input type="hidden"
		name="boxchecked" value="0" /> <input type="hidden" name="controller"
		value="tracks" /> <input type="hidden" name="cid"
		value="<?php echo $_GET['cid']; ?>" />
</form>
