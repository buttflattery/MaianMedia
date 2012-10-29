<?php
/**
 * Hello World! Module Entry Point
 *
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:modules/
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$moduletype = $params->get('moduletype',0);
$view = $params->get('search_view', 0);
$style = $params->get('buttonclass_sfx','');
$orderby = $params->get('ordering','');

$db =& JFactory::getDBO();
$artist = JRequest::getVar('artist');
$keyword = JRequest::getVar('keyword');
$itemId = JRequest::getVar('Itemid');
$catId = JRequest::getVar('cat');

if($orderby == 'name-asc'){
	if($moduletype =='0'){
		$orderby = 'ORDER BY title';
	}else if($moduletype =='1'){
		$orderby = 'ORDER BY artist';
	}else{
		$orderby = 'ORDER BY keywords';
	}

}else if($orderby == 'name-desc'){
	if($moduletype =='0'){
		$orderby = 'ORDER BY title DESC';
	}else if($moduletype =='1'){
		$orderby = 'ORDER BY artist DESC';
	}else{
		$orderby = 'ORDER BY keywords DESC';
	}
}else{
	$orderby = 'ORDER BY ordering';
}

$output_string = '';

switch ($moduletype) {

	case '0':
		$query = ' SELECT * '
		. ' FROM #__categories where section = \'com_maianmedia\'
			AND  published = \'1\'
			ORDER BY ordering';

		$db->setQuery( $query );
		$categories = $db->loadObjectList();

		foreach($categories as $cat){
			$output_string = $output_string.'<option value="'.$cat->id.'"'.(($catId == $cat->id) ? ' selected' : '').'>'.$cat->title.'</option>'."\n";
		}
		break;
	case '1':

		$query = 'SELECT DISTINCT artist, id'
		. ' FROM #__m15_albums'
		. ' WHERE status = \'1\''
		. ' ORDER BY artist';

		$db->setQuery( $query );
		$albums = $db->loadObjectList();

		foreach($albums as $album){
			if(strpos($output_string, trim($album->artist)) === false){
				$output_string = $output_string.'<option'.(($artist == $album->artist) ? ' selected' : '').'>'.trim($album->artist).'</option>'."\n";
			}
		}
		break;
	case '2':
		$query = 'SELECT DISTINCT keywords, id'
		. ' FROM #__m15_tracks'
		. ' WHERE published = \'1\' AND keywords NOT Like \'\''
		. ' ORDER BY keywords';

		$db->setQuery( $query );
		$tracks = $db->loadObjectList();

		$output_array = array();
		$x = 0;

		foreach($tracks as $track){

			$keys = array_map('trim',explode(",", $track->keywords));
			// Loop through keywords...
			for ($i=0; $i<count($keys); $i++) {

				$output_array[$x] = trim($keys[$i]);
				$x ++;

			}
		}

		foreach(array_unique($output_array) as $item){
			if(strpos($output_string, trim($item)) === false){
				$output_string = $output_string.'<option'.(($$artist == $item) ? ' selected' : '').'>'.$item.'</option>'."\n";

			}
		}
		break;
}

// Include the syndicate functions only once
require( JModuleHelper::getLayoutPath( 'mod_maianfilter' ) );
?>
