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

$path=realpath($_GET['abs_path']);
$root=array(
array(
		'property' => array(
			'name' => basename($path)
),
		'type' => 'folder',
		'data' => array(
			'abs_path' => $path
)
)
);

echo json_safe_encode($root);
?>