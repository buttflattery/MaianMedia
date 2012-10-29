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

/**
 * Hello Table class
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class TableTracks extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;
	var $track_name = null;
	var $track_album = null;
	var $mp3_path = null;
	var $preview_path = null;
	var $track_length = null;
	var $track_cost = null;
	var $tracksAdded = 0;
	var $track_single = null;
	var $addDate = null;
	var $track_order = null;
	var $downloads = null;
	var $free_downloads = null;
	var $freebie = null;
	var $keywords = null;
	var $avatar= null;
	var $count= null;
	var $published= null;
	var $params = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableTracks(& $db) {
		parent::__construct('#__m15_tracks', 'id', $db);
	}

	function update($DATA){
		$db =& JFactory::getDBO();

		$album = JRequest::getVar('cid' );
		$x=0;
		for ($i=0; $i<count($this->track_name); $i++)
		{

			if($this->track_cost[$i] == ''){
				$this->track_cost[$i] = '0.00';
			}

			if($this->track_album[$i] == $album){
				$x=$x+1;
				$db->setQuery("UPDATE #__m15_tracks SET
            	track_name    = '".(isset($this->track_name[$i]) ? $this->add_slashes($this->track_name[$i]) : $DATA['t_name'][$i])."',
				track_album   = '{$this->track_album[$i]}',
				mp3_path      = '".($this->mp3_path[$i] ? $this->mp3_path[$i] : $DATA['t_path'][$i])."',
				preview_path  = '{$this->preview_path[$i]}',
				track_length  = '{$this->track_length[$i]}',
				keywords  = '{$this->keywords[$i]}',
				freebie = '".(isset($_POST['freebie_'.$i]) ? 1 : 0)."',
				track_order = '{$x}',
				track_cost    = '".number_format(($this->track_cost[$i] ? $this->track_cost[$i] : $DATA['t_cost'][$i]),2)."',
            	track_single  = '".(isset($_POST['track_single_'.$i]) ? 1 : 0)."'
				WHERE id      = '{$this->id[$i]}'
				LIMIT 1");
					
				$db->query();
			}else{
				$db->setQuery("SELECT track_order FROM #__m15_tracks
				WHERE track_album = '{$this->track_album[$i]}'
				ORDER BY track_order DESC
				LIMIT 1");

				$ORDER = $db->loadObject();
				$z = $ORDER->track_order + 1;

				$db->setQuery("UPDATE #__m15_tracks SET
            	track_name    = '".(isset($this->track_name[$i]) ? $this->add_slashes($this->track_name[$i]) : $DATA['t_name'][$i])."',
				track_album   = '{$this->track_album[$i]}',
				mp3_path      = '".($this->mp3_path[$i] ? $this->mp3_path[$i] : $DATA['t_path'][$i])."',
				preview_path  = '{$this->preview_path[$i]}',
				track_length  = '{$this->track_length[$i]}',
				keywords  = '{$this->keywords[$i]}',
				freebie = '".(isset($_POST['freebie_'.$i]) ? 1 : 0)."',
				track_order = '{$z}',
				track_cost    = '".number_format(($this->track_cost[$i] ? $this->track_cost[$i] : $DATA['t_cost'][$i]),2)."',
            	track_single  = '".(isset($_POST['track_single_'.$i]) ? 1 : 0)."'
				WHERE id      = '{$this->id[$i]}'
				LIMIT 1");

				$db->query();

			}


		}

		return true;

	}

	function validEntry($track_name, $mp3_path, $track_album)
	{
		if($track_name == null || trim($track_name) == ""){
			return false;
		}

		if($mp3_path == null || trim($mp3_path) == ""){
			return false;
		}

		if($track_album == null || trim($track_album) == ""){
			return false;
		}
		return true;
	}

	function addTracks($data){

		$db =& JFactory::getDBO();

		$this->tracksAdded = count($this->track_name);

		for ($i=0; $i < count($this->track_name); $i++)
		{
			// Only add track if name, path & album were specified..

			if ($this->validEntry($this->track_name[$i], $this->mp3_path[$i], $this->track_album[$i]))
			{
				// Get last order by number...
				$db->setQuery("SELECT track_order FROM #__m15_tracks
				WHERE track_album = '{$this->track_album[$i]}'
				ORDER BY track_order DESC
				LIMIT 1");

				$ORDER = $db->loadObject();

				$db->setQuery("INSERT INTO #__m15_tracks (
                    track_name,
                    track_album,
                    mp3_path,
                    preview_path,
                    track_length,
                    freebie,
                    track_cost,
                    track_single,
                    addDate,
                    track_order
                    ) VALUES (
                    '".$this->add_slashes($_POST['track_name'][$i])."',
                    '".$_POST['track_album'][$i]."',
                    '".$this->add_slashes($_POST['mp3_path'][$i])."',
                    '".$this->add_slashes($_POST['preview_path'][$i])."',
                    '".$_POST['track_length'][$i]."',
                    '".(isset($_POST['freebie_'.$i]) ? 1 : 0)."',
                    '".number_format($this->track_cost[$i],2)."',
                    '".(isset($_POST['track_single_'.$i]) ? 1 : 0)."',
                    '".date("Y-m-d")."',
                    '".($ORDER->track_order+i)."')");

				$db->query();



			}else{
				$this->tracksAdded= $this->tracksAdded -1;
			}

		}

		return true;

	}

	function setTrackAdded($data)
	{
		$this->tracksAdded = $data;
	}

	function add_slashes($inp)
	{
		if(is_array($inp))
		return array_map(__METHOD__, $inp);

		if(!empty($inp) && is_string($inp)) {
			return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
		}

		return $inp;

	}

}