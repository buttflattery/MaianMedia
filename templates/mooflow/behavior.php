<?php
/**
 * MY Behavior
 *
 * @author Marco Solazzi <hello@dwightjack.com>
 * @version 0.1a
 * @copyright Copyright (c) 2008 - 2009 Marco Solazzi
 * @license GNU GENERAL PUBLIC LICENSE 2
 * @package MY_Behavior
 *
 */
class MY_Behavior
{
	/**
	 * Replaces Mootools v1.11 with v1.2.x where possible. Works only in Frontend
	 *
	 * @param bool $debug Set to boolean false to prevent loading Mootools 1.2.x
	 * @param array $exclude Components to exclude ( example: array("com_docman","com_comprofiler") )
	 */
	function mootoolsFix($fix = true, $exclude=array())
	{
		$mainframe = &JFactory::getApplication();
		$document = JFactory::getDocument();
		// load only in frontend.
		// Virtuemart uses its own libraries and logics to load JS scripts so there's no way to load 1.2.x on it, excluding it by default
		$excludeComponents = array_merge($exclude,array('com_virtuemart'));
		if ($mainframe->isSite() && $fix===true && !in_array(JRequest::getCmd( 'option' ),$excludeComponents)) {
			$mootools = JURI::base()."media/system/js/mootools.js";
			$mootoolsNostr = "/media/system/js/mootools.js";
			$scripts = array();

			$search = array('/media/system/js/mootools.js',
					'/components/com_jcomments/libraries/joomlatune/ajax.js',
					'/components/com_jcomments/js/jcomments-v2.1.js?v=2',
                   '/media/system/js/modal.js');
			// remove the js files
			foreach($this->_scripts as $key => $script) {
				foreach($search as $findme) {
					if(stristr($key, $findme) !== false) {
						unset($this->_scripts[$key]);
					}
				}
			}

			foreach ($document->_scripts as $script=>$type) {

				// Check if mootools is already loaded in the Joomla header and replaces it with 1.2.x files
				if ($script == $mootools || $script == $mootoolsNostr) {
					//$scripts['media/system/js/mootools-1.2.1-core.js'] = 'text/javascript';
					//$scripts['media/system/js/mootools-1.2-more.js'] = 'text/javascript';
					//$scripts['media/system/js/mootools-compat-111-121.js'] = 'text/javascript';
				} else if (strpos($script,'modal.js') !== false){

					// If modal behavior is loaded it will be replaced with 1.2.x compatible version
					//$scripts['media/system/js/modal-1.2.js'] = 'text/javascript';
				} else {

					// other scripts won't be replaced
					$scripts[$script] = $type;
				}
			}

			// If Mootools isn't loaded (as in some legacy components) inject v1.2.x
			if (!array_key_exists('media/system/js/mootools-1.2.1-core.js',$scripts)) {
				//$scripts['media/system/js/mootools-1.2.1-core.js'] = 'text/javascript';
				//$scripts['media/system/js/mootools-1.2-more.js'] = 'text/javascript';
				//$scripts['media/system/js/mootools-compat-111-121.js'] = 'text/javascript';
			}

			// Replace Joomla header scripts' array with fixed one
			$document->_scripts = $scripts;
		}
	}
}
?>
