<?php


class midiplayer extends MaianPlayer{

	function __construct()
	{
		parent::__construct();
		$document = &JFactory::getDocument();
		$uri =& JURI::getInstance();
	}
	
	function getplayer($mp3Url, $id=0, $index=0) {
		$site = $this->uri->root();
		$params = $this->params;

		$text = '
		<object data="'.$mp3Url.'">
		<param name="loop" value="'.$params->loop.'"/>
		If you\'re seeing this, you don\'t have a MIDI player on your computer.';
		return $text;
	}
}
?>