<?php


class zplayer extends MaianPlayer{

	function __construct()
	{
		parent::__construct();
		$document = &JFactory::getDocument();
		$uri =& JURI::getInstance();
		$document->addScript($uri->root().'components/com_maianmedia/players/swfobject.js');
	}

	function getplayer($mp3Url, $id=0, $index=0) {
		$site = $this->uri->root();
		$params = $this->params;

		$text = '
	<object type="application/x-shockwave-flash" data="'. $site .'components/com_maianmedia/players/zplayer/zplayer.swf?mp3='. $mp3Url .'&c1='.$params->c1.'&c2='.$params->c2.'&c3='.$params->c3.'" width="'.$params->width.'" height="'.$params->height.'" />
			<param name="movie" value="'. $site .'components/com_maianmedia/players/zplayer/zplayer.swf?mp3='. $mp3Url .'&c1='.$params->c1.'&c2='.$params->c2.'&c3='.$params->c3.'" />
		</object>	
	';
		return $text;
	}
}
?>