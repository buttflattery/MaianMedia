<?php


class MediaPlayer extends MaianPlayer{

	function getplayer($mp3Url, $id=0, $index=0) {
		$site = $this->uri->root();
		$params = $this->params;

		$text = '
	<object type="application/x-shockwave-flash" data="'. $site .'components/com_maianmedia/players/mediaPlayer/player.swf?file='. $mp3Url .'&showdownload=false" width="'.$params->width.'" height="'.$params->height.'" style="'.$params->style.'">  	
	<param name="movie" value="'. $site .'components/com_maianmedia/players/mediaPlayer/player.swf?file='. $mp3Url .'&showdownload=false&wmode=transparent" />
	<param name="WMode" value="transparent"/>
	<embed wmode="transparent" type="application/x-shockwave-flash" src="'. $site .'components/com_maianmedia/players/mediaPlayer/player.swf?file='. $mp3Url .'" allowscriptaccess="always" allowfullscreen="true"></embed>
	</object>
	';
		return $text;
	}
}
?>