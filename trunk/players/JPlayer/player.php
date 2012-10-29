<?php

class jplayer extends MaianPlayer{

	function __construct()
	{
		parent::__construct();
		$document = &JFactory::getDocument();
		$uri =& JURI::getInstance();

		$document->addScript('http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js');
		$document->addScript(JURI::root().'components/com_maianmedia/players/jplayer/js/jquery.jplayer.min.js');
		$document->addScript(JURI::root().'components/com_maianmedia/players/jplayer/skin/'.$params->skin.'/jplayer.'.$params->skin.'.css');

		$params = $this->params;

		if($params->skin == 'circle.player'){
			$document->addScript(JURI::root().'components/com_maianmedia/players/jplayer/js/jquery.jplayer.min.js');
			$document->addScript(JURI::root().'components/com_maianmedia/players/jplayer/js/jquery.transform.js');
			$document->addScript(JURI::root().'components/com_maianmedia/players/jplayer/js/jquery.grab.js');
			$document->addScript(JURI::root().'components/com_maianmedia/players/jplayer/js/mod.csstransforms.min.js');
			$document->addScript(JURI::root().'components/com_maianmedia/players/jplayer/js/jplayer.circle.player.js');
		}else{
			$document->addScript(JURI::root().'components/com_maianmedia/players/jplayer/js/jplayer.default.player.js');
		}

		if(method_exists($document, 'addCustomTag')){
			$document->addCustomTag('<link href="'.JURI::root().'components/com_maianmedia/players/jplayer/skin/'.$params->skin.'/jplayer.'.$params->skin.'.css" rel="stylesheet" type="text/css" />');
		}else{
			$tpl = file_get_contents(JPATH_COMPONENT_SITE.DS.'players'.DS.'Jplayer'.DS.'skin'.DS.$params->skin.DS.'jplayer.'.$params->skin.'.css');
			echo '<style media="screen" type="text/css">'.$tpl.'</style>';
		}

	}

	function getplayer($mp3Url, $id=0, $index=0) {
		$site = $this->uri->root();
		$params = $this->params;
		$track = $this->getTrackInfo($id);

		$track_name = isset($track->track_name)? $track->track_name:'';
		$m4a = '';
		$mp3 = '';
		$ogg = '';
		$tpl = '';
		//$path = isset($track->preview_path)? $track->preview_path:$mp3Url;

		$ext = pathinfo($mp3Url, PATHINFO_EXTENSION);

		if($ext == 'mp3'){
			$mp3 = $mp3Url;
			$ogg = substr($mp3Url, 0, strlen($mp3Url)-4).'.ogg",';
		}elseif($ext == 'm4a'){
			$m4a = $mp3Url;
			$ogg = substr($mp3Url, 0, strlen($mp3Url)-4).'.ogg",';
		}

		$find       = array('{id}','{mp3}', '{m4a}', '{ogg}','{title}','{url}');
		$replace    = array($id, $mp3, $m4a, $ogg, $track_name, JURI::root());

		if($params->skin == 'circle.player'){
			$tpl 		= file_get_contents(JPATH_COMPONENT_SITE.DS.'players'.DS.'Jplayer'.DS.'circle.html');
		}else{
			$tpl 		= file_get_contents(JPATH_COMPONENT_SITE.DS.'players'.DS.'Jplayer'.DS.'default.html');
		}
		$player 	= str_replace($find,$replace, $tpl);

		return $player;
	}
}
?>