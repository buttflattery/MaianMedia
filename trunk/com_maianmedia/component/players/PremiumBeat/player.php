<?php


class PremiumBeat extends MaianPlayer{

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
		      <div id="playerMini'.$index.'">
           <a href="http://www.adobe.com/go/getflashplayer" onclick="window.open(this);return false"><img src="'.$site.'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/icons/get_flash_player.gif" alt="Get Adobe Flash player" title="Get Adobe Flash player" /></a>
          </div>

          <script type="text/javascript">
            var so = new SWFObject("'.$site .'components/com_maianmedia/players/PremiumBeat/playerMini.swf", "mymovie", "75", "30", "7", "#FFFFFF");
            so.addVariable("autoPlay", "no");
            so.addVariable("wmode", "transparent");
            so.addVariable("overColor","'.$params->color.'");
            so.addVariable("soundPath", "'.$mp3Url.'");
            so.addVariable("playerSkin","'.$params->skin.'");
            so.write("playerMini'.$index.'");
          </script>';

		if(JRequest::getVar('controller_') == 'settings' || JRequest::getVar('controller') == 'settings'){
			$text = '<object type="application/x-shockwave-flash" data="'. $site .'components/com_maianmedia/players/PremiumBeat/playerMini.swf?soundPath='. $mp3Url .'&playerSkin='.$params->skin.'&wmode=opaque&overColor='.$params->color.'" width="240" height="40" style="a:active, a:focus {outline: 0};">
		<param name="movie" value="'. $site .'components/com_maianmedia/players/PremiumBeat/playerMini.swf?soundPath='. $mp3Url .'&wmode=opaque" />
		<param name="WMode" value="transparent"/>
		<embed wmode="transparent" type="application/x-shockwave-flash" src="'. $site .'components/com_maianmedia/players/PremiumBeat/playerMini.swf" allowscriptaccess="always" allowfullscreen="true"></embed>
		</object>
	';
		}
		return $text;
	}
}
?>