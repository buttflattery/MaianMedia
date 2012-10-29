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
 * This version may have been modified pursuant to the GNU General Public License,
 * and as distributed it includes or is derivative of works licensed under the
 * GNU General Public License or other free or open source software licenses.
 * Changes must attribute the work in the manner specified by the author or licensor
 * (but not in any way that suggests that they endorse you or your use of the work).
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Set the table directory
JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');

// Include logger
include_once (JPATH_COMPONENT.DS.'inc'.DS.'logger.php');

// Require the base controller
require_once (JPATH_COMPONENT.DS.'controllers'.DS.'base.php');

$front = JRequest::getCmd('view');
$task = JRequest::getCmd('task');
$controller = JRequest::getWord('section');

// Require specific controller if requested
if(isset($controller) && $controller !="") {

	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if (file_exists($path)) {
		require_once $path;
	}
}else if((isset($front) && $front !="") || !isset($controller) || $task=='search'|| $controller =='album'){
	$controller ='template';
	$path = JPATH_COMPONENT.DS.'controllers'.DS.'template.php';
	if (file_exists($path)) {
		require_once $path;
	}
}

if($task == 'thanks' || $task == 'notify' || $front == 'thanks' || $front == 'notify'){
	$controller = 'paypal';
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if (file_exists($path)) {
		require_once $path;
	}
}

// Create the controller
$classname	= 'MaianController'.ucfirst($controller);
$controller = new $classname( );

// Register Extra tasks
$controller->registerTask( 'results', 'display' );

if(isset($task) && $task !=""){
	$controller->execute(JRequest::getCmd('task'));
}elseif(isset($front) && $front !=""){
	$controller->execute(JRequest::getCmd('view'));
}else{
	$controller->execute('display');
}


// Redirect if set by the controller
$controller->redirect();
