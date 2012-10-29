<?php


class FlashMp3Player extends MaianPlayer{

	function getplayer($mp3Url, $id=0, $index=0) {
		$site = $this->uri->root();
		$params = $this->params;

		$text = '<object type="application/x-shockwave-flash" data="'. $site .'components/com_maianmedia/players/flashMp3Player/player_mp3.swf?mp3='. $mp3Url .'&amp;showstop=1" width="'.$params->width.'" height="'.$params->height.'" style="'.$params->style.'">
	<param name="movie" value="'. $site .'components/com_maianmedia/players/flashMp3Player/player_mp3.swf?mp3='. $mp3Url .'&amp;showstop=1" />
	<param name="bgcolor" value="'.$params->color.'" />
	<embed wmode="transparent" type="application/x-shockwave-flash" src="'. $site .'components/com_maianmedia/players/flashMp3Player/player_mp3.swf?mp3='. $mp3Url .'&amp;bgcolor1='.$params->bgcolor1.'&amp;bgcolor2='.$params->bgcolor2.'" allowscriptaccess="always" allowfullscreen="true"></embed>
	</object>
	';
		return $text;
	}
}
?>