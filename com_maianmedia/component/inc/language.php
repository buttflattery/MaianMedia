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

class MaianText
{
	static $entries = array();
	static $author = '';
	static $website  = '';


	function init($language_file){
		$lang = array();
		$file_contents = file_get_contents($language_file);

		self::$author = self::getAuthor($file_contents);
		self::$website = self::getWebsite($file_contents);
		self::$entries = self::getEntries($file_contents);
	}

	static function _($key){
		
		if(isset(self::$entries [$key]) ){
			$text = self::$entries [$key];
			return JText::_($text);
		}else{
			return JText::_($key);
		}
	}

	static function getAuthor($file_contents){
		$buffer = substr($file_contents, strpos($file_contents, '$_msg_author'));
		$buffer = substr($buffer, 0, strpos($buffer, ';'));
		$buffer = substr($buffer, strpos($buffer, "'")+1);
		$buffer = substr($buffer, 0, strpos($buffer, "'"));
		
		return $buffer;
	}

	static function getWebsite($file_contents){
		$buffer = substr($file_contents, strpos($file_contents, '$_msg_website'));
		$buffer = substr($buffer, 0, strpos($buffer, ';'));
		$buffer = substr($buffer, strpos($buffer, "'")+1);
		$buffer = substr($buffer, 0, strpos($buffer, "'"));
		
		return $buffer;
	}
	
	function getEntries($file_contents){
		$lang = array();
		
		$rawpieces = explode("define",$file_contents);
		$rawpieces = array_slice($rawpieces, 1);

		foreach($rawpieces as $piece){
			preg_match("/'([^']+)'/", $piece, $key);
			$piece = str_replace($key[0], '', $piece);

			preg_match("/'([^']+)'/", $piece, $value);

			$lang[$key[1]] = $value[1];
		}
		return $lang;
	}
	
	function append($language_file){
		$file_contents = file_get_contents($language_file);
		
		$rawpieces = explode("define",$file_contents);
		$rawpieces = array_slice($rawpieces, 1);

		foreach($rawpieces as $piece){
			preg_match("/'([^']+)'/", $piece, $key);
			$piece = str_replace($key[0], '', $piece);

			preg_match("/'([^']+)'/", $piece, $value);

			self::$entries[$key[1]] = $value[1];
		}
	}

}//end MaianText