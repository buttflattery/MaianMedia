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

$flags = '';

$getstring = 'index.php?';

foreach($_GET as $var => $value)
{
	$getstring = $getstring.$var . '=' . $value.'&';
}

// Load language files..

$langDir = opendir(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'lang'.DS);
$uri =& JURI::getInstance();

while ($READ = readdir($langDir))
{
	if ($READ != "." && $READ != ".." && $READ != "index.html" && $READ != ".svn") {
		$lang = substr($READ, 0, strpos($READ, '.'));

		$location = $uri->root().'components/com_maianmedia/media/flags/'.$lang.'.png';

		$langText = ucfirst(str_replace("_", " ", $lang));

		$flags .= '
				<li>
					<a title="'.$langText.'" '.(isset($_SESSION['maian_lang']) && $_SESSION['maian_lang'] == $READ ? 'class="activeFlag"':'').' href="'.$getstring .'getlang='.$lang.'">
						<img src="'.$location.'" alt="'.$langText.'" class="regularFlag" height="11" width="16">
					</a>
				</li>';

	}
}

closedir($langDir);

// Include the syndicate functions only once
require( JModuleHelper::getLayoutPath( 'mod_maianflags' ) );
?>
