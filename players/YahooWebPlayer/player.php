<?php


class YahooWebPlayer extends MaianPlayer{

	function __construct()
	{
		parent::__construct();
		$document = &JFactory::getDocument();
		$uri =& JURI::getInstance();

		$document->addScript('http://webplayer.yahooapis.com/player.js');

	}

	function getplayer($mp3Url, $id=0, $index=0) {
		$site = $this->uri->root();
		$params = $this->params;
		$track = $this->getTrackInfo($id);

		$track_name = isset($track->track_name)? $track->track_name:'No Name Specified';

		if (strpos($_SERVER['HTTP_REFERER'], 'option=com_maianmedia&controller=settings&view=settings') !== false && count($_POST) != 0) {
			$text = 'Save settings to preview player';
		}else{
			$text = '<a href="'. $mp3Url .'" title="'.$track_name.'">&nbsp;</a>';
		}

		return $text;
	}
}
?>