<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'inc'.DS.'helper.php');

class MaianViewHelper extends MaianHelper
{
	function __construct($params, $SETTINGS, $skin)
	{
		parent::__construct($params, $SETTINGS, $skin);
		jimport('joomla.html.pagination');
		$this->tplDisplayData = array();
		$this->tplDisplayData['RENDER_LANG'] = $this->getLangDisplay();
	}

	function mooFlowPage($q_music){
		$params = $this->params;
		$width = $params->moo_width ? $params->moo_width :'632';
		$pageNav = new JPagination($params->count, $params->limitstart, $params->limit );
		$mData ='<div id="content">
			<div id="MooFlow">';
		$mData .= $this->mooView($q_music);
		$mData .='
			</div><div id="mooPagination">'.$this->convert_nav($pageNav->getPagesLinks()).'</div>
			<div style="width:'.$width.'; margin-right: auto; margin-left: auto" id="callback">'.$this->mooData($q_music[0]->id).'</div>
			<div>';
		return $mData;
	}

	function mooAlbums(){

		$mainframe = &JFactory::getApplication();
		$option = JRequest::getCmd('option');;
		$db =& JFactory::getDBO();
		$uri =& JURI::getInstance();
		$id = intval(cleanData(JRequest::getVar('Itemid')));
		$limitstart = intval(cleanData(JRequest::getVar('limitstart')));
		$params = $this->params;

		$limit = $mainframe->getUserStateFromRequest( "limit", 'limit', intval($params->display_num));

		if($limitstart > 0){
			$limitstart = $mainframe->getUserStateFromRequest( "$option.limitstart", 'limitstart', 0 );
		}

		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$mData = '';

		$orderBy = $this->getOrder($params->orderBy);

		if($limit != '0'){

			$query = ' SELECT * '
			. ' FROM #__m15_albums
            	WHERE status = \'1\'
				'.$orderBy.'
            	LIMIT '.$limitstart.','.$limit;
		}else{
			$query = ' SELECT * '
			. ' FROM #__m15_albums
				WHERE status = \'1\'
				'.$orderBy;
		}

		// Get music/album data..
		$db->setQuery("SELECT * FROM #__m15_albums
		WHERE status = '1'") ;
		$q_music = $db->loadObjectList();
		$count = count($q_music);

		$db->setQuery($query) ;
		$q_music = $db->loadObjectList();

		$first = 'mooAlbums';
		$bool = true;
		foreach($q_music as $MUSIC){

			if($MUSIC->image != "" && $MUSIC->image !="http://"){
				$image_link = $MUSIC->image;
				$images_dimensions = 'height=75px width=75px';
			}else{
				$image_link = $uri->root().'components/com_maianmedia/templates/mooflow/assets/media/icons/no_picture.png?rand='.rand(1111,9999);
				//$image_link = $uri->root().'index.php?option=com_maianmedia&format=raw&view=getDefault&rand='.rand(1111,9999);
			}

			$find     = array('{album_image}','{album_title}','{artist}','{id}','{class}');
			$replace  = array($image_link,cleanData($MUSIC->name),cleanData($MUSIC->artist),$MUSIC->id,$first);
			if($bool){
				$mData .= str_replace($find,$replace, file_get_contents(JPATH_COMPONENT.DS.'templates'.DS.'mooflow'.DS.'tpl'.DS.'display.html'));
			}else{
				$mData .= ','.str_replace($find,$replace, file_get_contents(JPATH_COMPONENT.DS.'templates'.DS.'mooflow'.DS.'tpl'.DS.'display.html'));
			}
			$bool = false;
			$first='mooAlbums';
		}

		echo '{"images":[
				'.$mData.']}';
	}

	function mooData($call=null){

		$json = JRequest::getVar('json');

		if(isset($call)){
			$id = $call;
		}else{
			$id = intval($json['id']);
		}
		$aData = '';

		$db =& JFactory::getDBO();
		$uri =& JURI::getInstance();

		// Get album data...
		$db->setQuery("SELECT * FROM #__m15_albums
		WHERE id = '{$id}'
		LIMIT 1") ;
		$ALBUM = $db->loadObject();
		$q_album = $db->loadObjectList();

		// Get tracks..
		$db->setQuery("SELECT * FROM #__m15_tracks
		WHERE track_album = '{$ALBUM->id}'
		ORDER BY track_order") ;
		$q_tracks = $db->loadObjectList();
		$intNumber = 0;

		$mPlayer = getPlayer();

		foreach($q_tracks as $TRACKS) {
			$intNumber = $intNumber + 1;
			$altRow = '';
			if ($intNumber % 2 == 0 )
			{
				$altRow = 'class = "alt_row"';
			}

			if($this->SETTINGS->ajax == '0'){
				$link ='<input type="checkbox" name="track[]" value="'.$id.'" alt="'.JText::_(_msg_no_download).'" title="'.JText::_(_msg_no_download).'" DISABLED/>';
			}else{
				$link = '<img src="components/com_maianmedia/templates/mooflow/assets/media/cart/no_single.png" alt="'.JText::_(_msg_no_download).'" title="'.JText::_(_msg_no_download).'" />';
			}
			// Is single track purchasable?
			if ($TRACKS->track_single || $TRACKS->freebie) {
				$link = $this->getLink($TRACKS->id);
			}

			$find     = array('{id}','{link}');
			$replace = array($TRACKS->id, $link);
			$single = str_replace($find ,$replace,
			file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'tpl'.DS.'add_to_cart.html'));

			$tracklength;
			if($TRACKS->track_length != ""){
				$tracklength = "(".$TRACKS->track_length.")";
			}

			include_once(JPATH_COMPONENT.DS.'players'.DS.'mp3players.php');

			$find     = array('{flash_player}','{title}','{alt_row}','({duration})','{cost}','{add_to_cart}');
			$replace  = array('<!-- Begin Flash Player -->'.$mPlayer->getPlayer(genPreview($TRACKS->id), $TRACKS->id, $intNumber).'<!-- End Flash Player -->',
			cleanData($TRACKS->track_name), $altRow,
			$TRACKS->track_length,get_cur_symbol($TRACKS->track_cost, $this->SETTINGS ->paypal_currency),
			$single);
			$aData .= str_replace($find,$replace,
			file_get_contents(JPATH_COMPONENT.DS.'templates'.DS.'mooflow'.DS.'tpl'.DS.'tracks.html'));

		}
		// Update hits..
		$db->setQuery("UPDATE #__m15_albums SET
		hits      = (hits+1)
		WHERE id  = '{$ALBUM->id}'
		LIMIT 1") ;
		$db->query();

		if($call){
			return '<div id="tracks">
				<table width="100%" cellspacing="0" cellpadding="0">
					<tr id="album_tr">
        				<th align="left" width="35%" ><b>'.JText::_( _msg_publicalbum5).'</b></th>
       					<th align="left" width="15%"><b>'.JText::_( _msg_publicalbum6).'</b></th>
        				<th align="left" width="25%"><b>'.JText::_( _msg_publicalbum3).'</b></th>
      				</tr>
			  		'.$aData.'
			  	</table>
			 </div>';
		}else{
			echo'<div id="tracks">
				<table width="100%" cellspacing="0" cellpadding="0">
					<tr id="album_tr">
        				<th align="left" width="35%" ><b>'.JText::_( _msg_publicalbum5).'</b></th>
       					<th align="left" width="15%"><b>'.JText::_( _msg_publicalbum6).'</b></th>
        				<th align="left" width="25%"><b>'.JText::_( _msg_publicalbum3).'</b></th>
      				</tr>
			  		'.$aData.'
			  	</table>
			 </div>';
			echo '
			<script type="text/javascript">
			// <![CDATA[
			window.addEvent(\'domready\', function() {
			
				SqueezeBox.assign($$(\'a.mvid\'), {
					parse: \'rel\'
				});
			});
			// ]]>
			</script>';
		}

	}

	function mooView($q_music)
	{
		$uri =& JURI::getInstance();
		$document = &JFactory::getDocument();

		//$headerstuff = $document->getHeadData();
		//$headerstuff['scripts'] = array();
		//$document->setHeadData($headerstuff);

		$db =& JFactory::getDBO();

		$db->setQuery("SELECT * FROM #__m15_settings LIMIT 1");
		$SETTINGS = $db->loadObject();

		$params = "";
		$lines = explode("\n", trim($SETTINGS->extra_params));

		for ($i=0; $i<count($lines);$i++){
			list($key,$val) = explode("=", $lines[$i]);
			$params [trim(urldecode($key))] = trim(urldecode($val));
		}


		$document->addStyleSheet($uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'css').'/MooFlowWhite.css');
		//$document->addScript($uri->root().'components/com_maianmedia/html/template/mooflow/js/mootools-compat-111-121.js');
		$document->addScript($uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'js').'/mootools-1.2-core.js');
		$document->addScript($uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'js').'/mootools-1.2-more.js');
		//$document->addScript($uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'js').'/mootools-compat-111-121.js');
		$document->addScript($uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'js').'/SqueezeBox.js');
		$document->addStyleSheet($uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'css').'/SqueezeBox.css');
		$document->addScript($uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'js').'/MooFlow.js');
		$document->addScript($uri->root().'components/com_maianmedia/players/swfobject.js' );
		$document->addScript($uri->root().'components/com_maianmedia/ajax/cartajax.js' );
		$document->addCustomTag($this->mooFlowScript($q_music));
		/*$first = 'mooFirst';
		 foreach($q_music as $MUSIC){
			$image_link = $uri->root().'components/com_maianmedia/media/icons/no_picture.png';
			if($MUSIC->image != "" && $MUSIC->image !="http://"){
			$image_link = $MUSIC->image;
			$images_dimensions = 'height=75px width=75px';
			}

			$find     = array('{album_image}','{album_title}','{artist}','{id}','{class}');
			$replace  = array($image_link,cleanData($MUSIC->name),cleanData($MUSIC->artist),$MUSIC->id,$first);
			$mData .= str_replace($find,$replace, file_get_contents(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'template'.DS.'mooflow'.DS.'display.html'));
			$first='mooOther';
			}*/

		//$mData .= $mData;

		//return $mData;
	}

	function convert_nav($pageNav){

		$start = 0;
		$end = strpos($pageNav,'href="');

		if(!$end){
			return '';
		}
		$navigation = substr($pageNav,0, $end).'class="loadjson" onclick="loadRemote(this);return false" href="';
		$substring = substr($pageNav, $end+6);

		$end = strpos($substring ,'music');

		$navigation .= substr($substring,0, $end).'mooAlbums&format=raw';
		$substring = substr($substring, $end+5);
		$end = strpos($substring,'href="');

		while($end){

			$navigation .= substr($substring,0, $end).'class="loadjson" onclick="loadRemote(this);return false" href="';
			$substring = substr($substring, $end+6);

			$end = strpos($substring ,'music');

			$navigation .= substr($substring,0, $end).'mooAlbums&format=raw';
			$substring = substr($substring, $end+5);

			$end = strpos($substring ,'href="');
		}

		return $navigation.' '.$substring;
	}

	function mooFlowScript($q_music){
		$uri =& JURI::getInstance();
		$params = $this->params;
		$script ='<script type="text/javascript">

		var mf; 
		var myMooFlowPage = {	
			start: function(){
				/* MooFlow instance with the complete UI and dbllick-callback */
				mf = new MooFlow($(\'MooFlow\'), {
					bgColor: \''.($params->bgColor ? $params->bgColor : '#fff').'\',
					heightRatio: '.($params->heightRatio? $params->heightRatio : '0.6').',
					useSlider: '.($params->useSlider == '0' ? 'false' : 'true').',
					useAutoPlay: false,
					useCaption: '.($params->useCaption == '0' ? 'false' : 'true').',
					useResize: false,
					useMouseWheel: '.($params->useMouseWheel == '0' ? 'false' : 'true').',
					useKeyInput: '.($params->useKeyInput == '0' ? 'false': 'true').',
					useViewer: '.($params->useViewer == '0' ? 'false' : 'true').',
					onEmptyinit: function(){
						this.loadJSON(\''.$uri->root().'index.php?option=com_maianmedia&format=raw&view=mooAlbums\');
					},
					\'onClickView\': function(mixedObject){
						//var img = new Element(\'img\',{src:obj.src, title:obj.title, alt:obj.alt, styles:obj.coords}).setStyles({\'position\':\'absolute\',\'border\':\'none\'});
						//document.body.adopt(link.adopt(img));
						myMooFlowPage.album(mixedObject);
					},
					\'onStart\': function(){
						//myMooFlowPage.album({ id: \''.$q_music[0]->id.'\'});
					},
					\'onChancel\': function(error){
						//myMooFlowPage.log(error);
					},
					\'onAutoPlay\': function(){
						//myMooFlowPage.log("AutoPlay started");
					},
					\'onAutoStop\': function(){
						//myMooFlowPage.log("AutoPlay stoped");
					},
					\'onResized\': function(isFull){
						//myMooFlowPage.log("onResized Fullscreen: " + isFull);
					}
				});
				
			},
			album: function(result){
		
				var req = new Request.HTML({
					method: \'get\',
					url: \''.$uri->root().'index.php?option=com_maianmedia&format=raw&view=mooData\',
					data: { \'json\' : result },
					onRequest: function() { $(\'callback\').fade(.3); },
					update: $(\'callback\'),
					onComplete: function(response) {
					$(\'callback\').fade(\'in\');
					
						SqueezeBox.assign($$(\'a.mvid\'), {
							parse: \'rel\'
						});
		
				}
				}).send();
					
			},
			loadRemote:function(des){
			//alert("in remote");	
			mf.loadJSON(des);
					
					var href = des;
					var pos = href.indexOf(\'limitstart\');
					
					var limit = href.substring(pos+11);
					//alert(limit);
					var req = new Request.HTML({
						method: \'get\',
						url: \''.$uri->root().'index.php?option=com_maianmedia&format=raw&view=remote_links\',
						data: { \'limitstart\' : limit },
						update: $(\'mooPagination\'),
						onComplete:  function(response) { 
							
						}
					}).send();
		
					return false;
			}
		
		};
		
		
		
		window.addEvent(\'domready\', function() {
					
					SqueezeBox.assign($$(\'a.mvid\'), {
						parse: \'rel\'
					});
		});
		
		
		
		function loadRemote(element){
		
			myMooFlowPage.loadRemote(element.href);
					
		}
		
		window.addEvent(\'domready\', myMooFlowPage.start);
		
		
		</script>';

		return $script;
	}

	function remote_links(){
		$mainframe = &JFactory::getApplication();
		$option = JRequest::getCmd('option');;
		$db =& JFactory::getDBO();
		$uri =& JURI::getInstance();
		$id = intval(cleanData(JRequest::getVar('Itemid')));
		$limitstart = intval(cleanData(JRequest::getVar('limitstart')));

		$_GET['view'] = $value;
		$_POST['view'] = $value;
		$_REQUEST['view'] = $value;

		$params = $this->params;
		$limit = $mainframe->getUserStateFromRequest( "limit", 'limit', intval($params->display_num));

		if($limitstart > 0){
			$limitstart = $mainframe->getUserStateFromRequest( "$option.limitstart", 'limitstart', 0 );
		}

		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		// Get music/album data..
		$db->setQuery("SELECT * FROM #__m15_albums
		WHERE status = '1'") ;
		$q_music = $db->loadObjectList();
		$count = count($q_music);

		$pageNav = new JPagination($count, $limitstart, $limit );
		echo $this->convert_nav(str_replace('remote_links', 'music', $pageNav->getPagesLinks()));

	}

}