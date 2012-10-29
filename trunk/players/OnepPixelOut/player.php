<?php

class onepixelout extends MaianPlayer{

	function __construct()
	{
		parent::__construct();
		$document = &JFactory::getDocument();
		$uri =& JURI::getInstance();

		$document->addScript('http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js');
		$document->addScript($uri->root().'components/com_maianmedia/players/onepixelout/audio-player.js');
	}

	function getplayer($mp3Url, $id=0, $index=0) {
		$site = $this->uri->root();
		$params = $this->params;

		$text = '
			
		<span class="onepixelout">
			<object type="application/x-shockwave-flash" data="'. $site .'components/com_maianmedia/players/onepixelout/player.swf" id="audioplayer'.$index.'" height="24" width="290">
		<param name="movie" value="'. $site .'components/com_maianmedia/players/onepixelout/player.swf" />
		<param name="FlashVars" value="bg=0x'.$params->bg.'&amp;leftbg=0x'.$params->leftbg.'&amp;lefticon=0x'.$params->lefticon.'&amp;rightbg=0x'.$params->rightbg.'&amp;rightbghover=0x'.$params->rightbghover.'&amp;righticon=0x'.$params->righticon.'&amp;righticonhover=0x'.$params->righticonhover.'&amp;text=0x'.$params->text.'&amp;slider=0x'.$params->slider.'&amp;track=0x'.$params->track.'&amp;border=0x'.$params->border.'&amp;loader=0x'.$params->loader.'&amp;loop='.$params->loop.'&amp;playerID='.$index.'&amp;soundFile='. $mp3Url .'" />
		<param name="quality" value="high" />
		<param name="menu" value="false" />
		<param name="wmode" value="transparent" />
		</object>
</span>
				';
		return $text;
	}
}
?>