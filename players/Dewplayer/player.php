<?php


class DewPlayer extends MaianPlayer{

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

		$text = '<object type="application/x-shockwave-flash" data="'. $site .'components/com_maianmedia/players/dewplayer/'.$params->skin.'.swf?mp3='. $mp3Url .'&wmode=opaque" width="'.$params->width.'" height="'.$params->height.'" style="'.$params->style.'">
				<param name="movie" value="'. $site .'components/com_maianmedia/players/dewplayer/dewplayer-mini.swf?mp3='. $mp3Url .'" />
				<param name="WMode" value="transparent"/>
				<embed wmode="transparent" type="application/x-shockwave-flash" src="'. $site .'components/com_maianmedia/players/dewplayer/'.$params->skin.'.swf?mp3='. $mp3Url .'" allowscriptaccess="always" allowfullscreen="true"></embed>
				</object>';
		return $text;
	}
}
?>