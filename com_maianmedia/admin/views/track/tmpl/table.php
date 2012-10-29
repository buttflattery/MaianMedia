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

$count = JRequest::getVar('num');

$uploadText = MaianText::_(_msg_upload);

$header= '
<table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center">'.MaianText::_(_msg_add14).'<select name="album" onchange="Select_Values()">
        <option value="0">---</option>';

$db->setQuery("SELECT * FROM #__m15_albums WHERE is_album = '1' ORDER BY artist");
$q_albums = $db->loadObjectList();
foreach ($q_albums as $ALBUMS){
	$header=$header.'<option value="'.$ALBUMS->id.'"'.(isset($_POST['album']) && $_POST['album']==$ALBUMS->id ? ' selected' : '').'>'.cleanData($ALBUMS->artist).' - '.cleanData($ALBUMS->name).'</option>'."\n";
}

$header=$header.'</select>'.MaianText::_(_msg_add15).'</td></>
      </tr>
      </table><br>';

$body = '';
for ($i=0; $i<$count; $i++)
{
	$k=$i+1;
	 
	$body = $body.'<fieldset  style="background-color: #FFF"  class="adminform"><legend>'.MaianText::_(_msg_publicalbum11).'&nbsp;'.$k.'</legend>';
	 
	$bottom = '</fieldset>';
	 
	$body = $body.'
      <table class="admintable">
     <!--tr>
     	<td width="30%" class="key">Select for Upload</td>
     	<td width="15%" ><input type="radio" name="uploadTrack" value="'.$i.'" '.((isset($_POST['uploadTrack']) && $_POST['uploadTrack']== $i)|| $count==1 ? 'checked' : '').'></td>
     </tr-->
     <tr>   
     	<td width="30%" class="key">'.MaianText::_(_msg_add6).'</td>
        <td align="left" width="70%" style="padding: 5px;"><input id="track_name_'.$i.'" type="text" value="'.(isset($_POST['track_name'][$i]) ? cleanData($_POST['track_name'][$i]) : '').'" size="30" maxlength="250" name="track_name[]" class="formBox"/></td>
      </tr>
      <tr>
        <td class="key">'.MaianText::_(_msg_add7).'</td>
        <td align="left" style="padding: 5px;">
        
        <select id="populate_'.$i.'" name="track_album[]"><option value="0">---</option>';
	foreach ($q_albums as $ALBUMS){
		$body = $body.'<option value="'.$ALBUMS->id.'"'.(isset($_POST['track_album'][$i]) && $_POST['track_album'][$i]==$ALBUMS->id ? ' selected' : '').'>'.cleanData($ALBUMS->artist).' - '.cleanData($ALBUMS->name).'</option>'."\n";
	}
	$body = $body.'</select></td>
      </tr>
      <tr>
        <td class="key">'.MaianText::_(_msg_add8).'</td>
        <td align="left" style="padding: 5px;"><input type="text" id="mp3_path_'.$i.'" value="'.(isset($_POST['mp3_path'][$i]) ? cleanData($_POST['mp3_path'][$i]) : '').'" size="30" maxlength="250" name="mp3_path[]" class="formBox"/> 
        <a id="mp3_manager_'.$i.'" href=""><img src="'.$uri->root().'administrator/components/com_maianmedia/images/upload.png"/></a>
        [<a onmouseout="nd();" onclick="return overlib(\''.MaianText::_(_msg_javascript16).'\', STICKY, CAPTION,\''.MaianText::_(_msg_javascript).'\', CENTER);" href="javascript:void(0);"><b>?</b></a>]</td>
      </tr>
      <tr>
        <td class="key">'.MaianText::_(_msg_add9).'</td>
        <td align="left" style="padding: 5px;"><input type="text" id="preview_path_'.$i.'" value="'.(isset($_POST['preview_path'][$i]) ? cleanData($_POST['preview_path'][$i]) : '').'" size="30" maxlength="250" name="preview_path[]" class="formBox"/> 
        <a id="preview_manager_'.$i.'" href=""><img src="'.$uri->root().'administrator/components/com_maianmedia/images/upload.png"/></a>
        [<a onmouseout="nd();" onclick="return overlib(\''.MaianText::_(_msg_javascript17).'\', STICKY, CAPTION,\''.MaianText::_(_msg_javascript).'\', CENTER);" href="javascript:void(0);"><b>?</b></a>]</td>
      </tr>
      <tr>
        <td colspan="2">
        <table cellspacing="0" cellpadding="0" width="100%" style="border-bottom: 1px solid #E9E9E9;border-right: 1px solid #E9E9E9; background-color: #F6F6F6; color:#666;">
		<tr>
          <th align="left" width="20%" style="padding: 5px; font-weight: bold;">'.MaianText::_(_msg_add10).':</th>
          <th align="left" width="10%" style="padding: 5px;"><input id="track_length_'.$i.'" type="text" style="width: 70%;" value="'.(isset($_POST['track_length'][$i]) ? cleanData($_POST['track_length'][$i]) : '').'" size="30" maxlength="50" name="track_length[]" class="formBox"/> [<a onmouseout="nd();" onclick="return overlib(\''.MaianText::_(_msg_javascript18).'\', STICKY, CAPTION,\''.MaianText::_(_msg_javascript).'\', CENTER);" href="javascript:void(0);"><b>?</b></a>]</th>
          <th align="right" width="10%" style="padding: 5px; font-weight: bold;">'.MaianText::_(_msg_add11).':</th>
          <th align="left" width="10%" style="padding: 5px;"><input id="track_cost_'.$i.'" type="text" style="width: 50%;" value="'.(isset($_POST['track_cost'][$i]) ? cleanData($_POST['track_cost'][$i]) : '').'" size="30" maxlength="5" name="track_cost[]" class="formBox"/> [<a onmouseout="nd();" onclick="return overlib(\''.MaianText::_(_msg_javascript19).'\', STICKY, CAPTION,\''.MaianText::_(_msg_javascript).'\', CENTER);" href="javascript:void(0);"><b>?</b></a>]</th>
          <th align="right" width="10%" style="padding: 5px; font-weight: bold;">'.MaianText::_(_msg_add12).':</th>
          <th align="left" width="10%" style="padding: 5px;"><input type="checkbox" value="1" '.(isset($_POST['track_single_'.$i]) ? ' checked' : '').'" name="track_single_'.$i.'"/> [<a onmouseout="nd();" onclick="return overlib(\''.MaianText::_(_msg_javascript20).'\', STICKY, CAPTION,\''.MaianText::_(_msg_javascript).'\', CENTER);" href="javascript:void(0);"><b>?</b></a>]</th>
          <th align="right" width="10%" style="padding: 5px; font-weight: bold;">'.MaianText::_(_msg_free_download).':</th>
          <th align="left" width="10%" style="padding: 5px;"><input type="checkbox" value="1" '.(isset($_POST['freebie_'.$i]) ? ' checked' : '').'" name="freebie_'.$i.'"/> [<a onmouseout="nd();" onclick="return overlib(\''.MaianText::_(_msg_free_download).'\', STICKY, CAPTION,\''.MaianText::_(_msg_javascript).'\', CENTER);" href="javascript:void(0);"><b>?</b></a>]</th>
          </tr>
		</table>
        </td>      
      </tr>
      </table>';
	$body = $body.$bottom;
}
//$footer = '</fieldset>';

echo $header.$body;

?>