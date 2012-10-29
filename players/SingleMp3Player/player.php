<?php


class SingleMp3Player extends MaianPlayer{

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

		$text = '<object type="application/x-shockwave-flash" data="'. $site .'components/com_maianmedia/players/singleMp3Player/singlemp3player.swf?file='. $mp3Url .'&backColor=ffffff&frontColor=1a1a1a&showDownload=false&songVolume=90&wmode=opaque" width="25" height="20" style="a:active, a:focus {outline: 0};">
	<param name="movie" value="'. $site .'components/com_maianmedia/players/singlemp3player.swf?file='. $mp3Url .'&backColor='.$params->backColor.'&frontColor='.$params->frontColor.'&showDownload=false&trueVolume='.$params->trueVolume.'&wmode=opaque" />
	<param name="WMode" value="transparent"/>
	<embed wmode="transparent" type="application/x-shockwave-flash" src="'. $site .'components/com_maianmedia/players/singleMp3Player/singlemp3player.swf?file='. $mp3Url .'" allowscriptaccess="always" allowfullscreen="true"></embed>
	</object>
	';
		return $text;
	}
}
?>