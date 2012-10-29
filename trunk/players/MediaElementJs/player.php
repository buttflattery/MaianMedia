<?php


class MediaElementJs extends MaianPlayer{

	function __construct()
	{
		parent::__construct();
		$document = &JFactory::getDocument();

		$uri =& JURI::getInstance();
		$params = $this->params;

		$document->addScript($uri->root().'components/com_maianmedia/players/mediaelementjs/jquery.js');
		$document->addScript($uri->root().'components/com_maianmedia/players/mediaelementjs/mediaelement-and-player.js');

		$document->addStyleSheet($uri->root().'components/com_maianmedia/players/mediaelementjs/mediaelementplayer.min.css');

		$find     = array('{width}','{height}', '{startVolume}');
		$replace  = array($params->width, $params->height, $params->startVolume);
		$html =  file_get_contents(JPATH_COMPONENT_SITE.DS.'players'.DS.'mediaelementjs'.DS.'script.html');

		$html = str_replace($find, $replace, $html);

		if(method_exists($document, 'addCustomTag')){
			$document->addCustomTag($html);
		}else{
			echo $html;
		}

	}

	function getplayer($mp3Url, $id=0, $index=0) {
		$site = $this->uri->root();

		if (strpos($_SERVER['HTTP_REFERER'], 'option=com_maianmedia&controller=settings&view=settings') !== false && count($_POST) != 0) {
			$text = 'Save settings to preview player';
		}else{
			$text = '<audio id="player'.$index.'" src="'.$mp3Url.'" type="audio/mp3" controls="controls"></audio>';
		}
		return $text;
	}
}
?>