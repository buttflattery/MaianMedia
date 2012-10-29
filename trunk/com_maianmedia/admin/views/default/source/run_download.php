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

require_once(JPATH_LIBRARIES.DS.'joomla'.DS.'factory.php');

$url = "http://www.aretimes.com/aretimes/downloads/Joomla%201.5.x/com_maianmedia.zip";
@set_time_limit(0); // Make sure we don't timeout while downloading
$config =& JFactory::getConfig();
$config_tmp_path = rtrim($config->getValue('config.tmp_path'), '/');
//$file_path =$this->downloadRemoteFile($url,$config_tmp_path);

jimport('joomla.filesystem.archive');
//if(JArchive::extract($config_tmp_path.DS.$file_path, $config_tmp_path)){
echo'<span id="update_text">The zip file has been downloaded to your server!!!</span>
			<div class="button2-right">
				<div class="start">
					<a id="getChecked" href="javascript:ajaxRequest(\'run_update\', \'index.php?option=com_maianmedia&amp;task=tools&amp;format=raw&amp;tool=run_update\', 1)"
									title="Start" onclick="">Run Update</a></div>
				</div><div id="run_update"></div>';
/*}else{
 jimport( 'joomla.error.error' );
 echo JError::getErrors();
 }*/
?>

