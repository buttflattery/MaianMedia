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

include_once(JPATH_COMPONENT.DS.'common'.DS.'common.php');
include_once(JPATH_COMPONENT.DS.'common'.DS.'URL.php');
$root_path=realpath($_GET['abs_path']);
$abs_path=$_GET['abs_path'];

if(substr($root_path,0,strlen($root_path))!=substr(realpath($_GET['abs_path']),0,strlen($root_path))){
	exit();
}

if(in_array('.',URL::A($abs_path))||in_array('..',URL::A($abs_path))){
	exit();
}

$d = @opendir($_GET['abs_path']);
if (!$d) return;
chdir($_GET['abs_path']);
$children=array();
while (($e=readdir($d)) !== false) {
	if ($e=='.' || $e=='..') continue;
	if (!@is_dir($e)){
		$children[]=array(
			'property' => array(
				'name' => $e
		),
			'type' => 'file'
			);
	}else{
		$children[]=array(
			'property' => array(
				'name' => $e
		),
			'type' => 'folder',
			'data' => array(
				'abs_path' => realpath($e)
		)
		);
	}
}
closedir($d);
echo json_safe_encode($children);
?>