<?
/**
 * @package		Joomla
 * @subpackage	com_maianmedia
 * @copyright	Copyright (C) Vamba & Matthew Thomson. All rights reserved.
 * @license		GNU/GPL
 * @author 		Arelowo Alao (aretimes.com) & David Bennet (maianscriptworld.co.uk)
 * @based on  	com_ignitegallery
 * @author 		Matthew Thomson (ignitejoomlaextensions.com)
 * Joomla! and Maian Music are free software. You must attribute the work in the manner
 * specified by the author or licensor (but not in any way that suggests that they endorse you or your use of the work).
 */
$config =& JFactory::getConfig();
$root  = rtrim($config->getValue('config.tmp_path'), '/').DS.'com_maianmedia';


define('DEFAULT_CHARSET', 'cp1251');

function json_safe_encode($var)
{
	return json_encode(json_fix_cyr($var));
}

function json_fix_cyr($var)
{
	if (is_array($var)) {
		$new = array();
		foreach ($var as $k => $v) {
			$new[json_fix_cyr($k)] = json_fix_cyr($v);
		}
		$var = $new;
	} elseif (is_object($var)) {
		$vars = get_class_vars(get_class($var));
		foreach ($vars as $m => $v) {
			$var->$m = json_fix_cyr($v);
		}
	} elseif (is_string($var)) {
		$var = iconv(DEFAULT_CHARSET, 'utf-8', $var);
	}
	return $var;
}

/**
 * Create a new directory, and the whole path.
 *
 * If  the  parent  directory  does  not exists, we will create it,
 * etc.
 * @todo
 *     - PHP5 mkdir functoin supports recursive, it should be used
 * @author baldurien at club-internet dot fr
 * @param string the directory to create
 * @param int the mode to apply on the directory
 * @return bool return true on success, false else
 * @previousNames mkdirs
 */

function makeAll($dir, $mode = 0777, $recursive = true) {
	if( is_null($dir) || $dir === "" ){
		return FALSE;
	}

	if( is_dir($dir) || $dir === "/" ){
		return TRUE;
	}
	if( makeAll(dirname($dir), $mode, $recursive) ){
		return mkdir($dir, $mode);
	}
	return FALSE;
}

/**
 * Copies file or folder from source to destination, it can also do
 * recursive copy by recursively creating the dest file or directory path if it wasn't exist
 * Use cases:
 * - Src:/home/test/file.txt ,Dst:/home/test/b ,Result:/home/test/b -> If source was file copy file.txt name with b as name to destination
 * - Src:/home/test/file.txt ,Dst:/home/test/b/ ,Result:/home/test/b/file.txt -> If source was file Creates b directory if does not exsits and copy file.txt into it
 * - Src:/home/test ,Dst:/home/ ,Result:/home/test/** -> If source was directory copy test directory and all of its content into dest
 * - Src:/home/test/ ,Dst:/home/ ,Result:/home/**-> if source was direcotry copy its content to dest
 * - Src:/home/test ,Dst:/home/test2 ,Result:/home/test2/** -> if source was directoy copy it and its content to dest with test2 as name
 * - Src:/home/test/ ,Dst:/home/test2 ,Result:->/home/test2/** if source was directoy copy it and its content to dest with test2 as name
 * @todo
 *  - Should have rollback so it can undo the copy when it wasn't completely successful
 *  - It should be possible to turn off auto path creation feature f
 *  - Supporting callback function
 *  - May prevent some issues on shared enviroments : <a href="http://us3.php.net/umask" title="http://us3.php.net/umask">http://us3.php.net/umask</a>
 * @param $source //file or folder
 * @param $dest ///file or folder
 * @param $options //folderPermission,filePermission
 * @return boolean
 */
function smartCopy($source, $dest, $options=array('folderPermission'=>0755,'filePermission'=>0755))
{
	$result=false;

	//For Cross Platform Compatibility
	if (!isset($options['noTheFirstRun'])) {
		$source=str_replace('\\','/',$source);
		$dest=str_replace('\\','/',$dest);
		$options['noTheFirstRun']=true;
	}

	if (is_file($source)) {
		if ($dest[strlen($dest)-1]=='/') {
			if (!file_exists($dest)) {
				makeAll($dest,$options['folderPermission'],true);
			}
			$__dest=$dest."/".basename($source);
		} else {
			$__dest=$dest;
		}
		$result=copy($source, $__dest);
		chmod($__dest,$options['filePermission']);

	} elseif(is_dir($source)) {
		if ($dest[strlen($dest)-1]=='/') {
			if ($source[strlen($source)-1]=='/') {
				//Copy only contents
			} else {
				//Change parent itself and its contents
				$dest=$dest.basename($source);
				@mkdir($dest);
				chmod($dest,$options['filePermission']);
			}
		} else {
			if ($source[strlen($source)-1]=='/') {
				//Copy parent directory with new name and all its content
				@mkdir($dest,$options['folderPermission']);
				chmod($dest,$options['filePermission']);
			} else {
				//Copy parent directory with new name and all its content
				@mkdir($dest,$options['folderPermission']);
				chmod($dest,$options['filePermission']);
			}
		}

		$dirHandle=opendir($source);
		while($file=readdir($dirHandle))
		{
			if($file!="." && $file!="..")
			{
				$__dest=$dest."/".$file;
				$__source=$source."/".$file;
				//echo "$__source ||| $__dest<br />";
				if ($__source!=$dest) {
					$result=smartCopy($__source, $__dest, $options);
				}
			}
		}
		closedir($dirHandle);

	} else {
		$result=false;
	}
	return $result;
}
function process_dir($dir,$recursive = FALSE) {
	if (is_dir($dir)) {
		for ($list = array(),$handle = opendir($dir); (FALSE !== ($file = readdir($handle)));) {
			if (($file != '.' && $file != '..') && (file_exists($path = $dir.'/'.$file))) {
				if (is_dir($path) && ($recursive)) {
					$list = array_merge($list, process_dir($path, TRUE));
				} else {
					$entry = array('filename' => $file, 'dirpath' => $dir);

					//---------------------------------------------------------//
					//                     - SECTION 1 -                       //
					//          Actions to be performed on ALL ITEMS           //
					//-----------------    Begin Editable    ------------------//

					$entry['modtime'] = filemtime($path);

					//-----------------     End Editable     ------------------//
					do if (!is_dir($path)) {
						//---------------------------------------------------------//
						//                     - SECTION 2 -                       //
						//         Actions to be performed on FILES ONLY           //
						//-----------------    Begin Editable    ------------------//

						$entry['size'] = filesize($path);
						if (strstr(pathinfo($path,PATHINFO_BASENAME),'log')) {
							if (!$entry['handle'] = fopen($path,r)) $entry['handle'] = "FAIL";
						}

						//-----------------     End Editable     ------------------//
						break;
					} else {
						//---------------------------------------------------------//
						//                     - SECTION 3 -                       //
						//       Actions to be performed on DIRECTORIES ONLY       //
						//-----------------    Begin Editable    ------------------//

						//-----------------     End Editable     ------------------//
						break;
					} while (FALSE);
					$list[] = $entry;
				}
			}
		}
		closedir($handle);
		return $list;
	} else return FALSE;
}

function endswith($string, $test) {
    $strlen = strlen($string);
    $testlen = strlen($test);
    if ($testlen > $strlen) return false;
    return substr_compare($string, $test, -$testlen) === 0;
}

function py_slice($input, $slice) {
    $arg = explode(':', $slice);
    $start = intval($arg[0]);
    if ($start < 0) {
        $start += strlen($input);
    }
    if (count($arg) === 1) {
        return substr($input, $start, 1);
    }
    if (trim($arg[1]) === '') {
        return substr($input, $start);
    }
    $end = intval($arg[1]);
    if ($end < 0) {
        $end += strlen($input);
    }
    return substr($input, $start, $end - $start);
}

?>