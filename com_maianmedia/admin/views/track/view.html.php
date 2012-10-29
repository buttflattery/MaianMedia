<?php
/**
 * @package		Maian Media
 * @subpackage	com_maianmedia
 * @copyright	Copyright (C) Are Times. All rights reserved.
 * @license		GNU/GPL
 * @author 		Arelowo Alao
 * @based on  	Maian Music v1.2 by David Bennet
 * @link		http://www.AreTimes.com
 * @link 		http://www.maianscriptworld.co.uk
 *
 * Maian Media is based on an open source script orginaly written by Maian Script World.
 * You must attribute the work in the manner specified by the author or licensor
 * (but not in any way that suggests that they endorse you or your use of the work).
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view' );
require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'view.html.php');
/**
 * Settings View
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class MaianViewTrack extends MaianViewDefault
{
	/**
	 * display method of settings view
	 * @return void
	 **/
	function display($tpl = null)
	{

		$db =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_settings Limit 1");
		$settings = $db->loadObject();

		if(JRequest::getVar('task') == 'edit'){
			JToolBarHelper::save('update_tracks'  , 'save' );
		}else{
			JToolBarHelper::save();
		}

		if(JRequest::getVar('task') == 'add'){
			JToolBarHelper::title(   MaianText::_(_msg_header5), 'add.png' );
		}else{
			JToolBarHelper::title(   MaianText::_(_msg_header6), 'tracks.png' );
		}

		JToolBarHelper::cancel();

		if(JRequest::getVar('cid')) {
			$id = JRequest::getVar('cid');

			// Query database for paypal information..
			$db->setQuery("SELECT * FROM #__m15_tracks
                             WHERE track_album = '".$id."'
                             ORDER BY track_order");

			$tracks = $db->loadObjectList();
			$this->assignRef('tracks', $tracks);
			$this->assignRef('settings', $settings);
		}

		jimport('joomla.filesystem.file');
		$authFile = JPATH_COMPONENT.DS.'utilities'.DS.'filemanager'.DS.'auth.php';
		$data = JFile::read($authFile);

		JPath::setPermissions($authFile, '0755');

		if($data === false){
			JError::raiseNotice( 100, 'Warning: '.JPATH_COMPONENT.DS.'utilities'.DS.'filemanager'.DS.'auth.php must be readable for the uploader to work' );
		}else{
			$ret = file_put_contents($authFile, $data);

			if($ret === false){
				JError::raiseNotice( 100, 'Warning: '.JPATH_COMPONENT.DS.'utilities'.DS.'filemanager'.DS.'auth.php must be writable for the uploader to work' );
			}
		}

		if(!JFolder::exists($settings->mp3_path)){
			JError::raiseNotice( 100, 'Warning: '.str_replace  ('{PATH}',$settings->mp3_path,_msg_tracks11));
		}

		if(!JFolder::exists(JPATH_SITE.$settings->preview_path)){
			JError::raiseNotice( 100, 'Warning: '.str_replace  ('{PATH}',JPATH_SITE.$settings->preview_path,_msg_tracks11));
		}

		if($settings->mp3_path == ''){
			JError::raiseNotice( 100, 'Warning: '.str_replace  ('{PATH}',JPATH_SITE.$settings->mp3_path,_msg_tracks11));
		}
		if($settings->preview_path == ''){
			JError::raiseNotice( 100, 'Warning: '.str_replace  ('{PATH}',JPATH_SITE.$settings->preview_path,_msg_tracks11));
		}

		parent::display($tpl);
	}

	function getLang(){
		//$lang =& JFactory::getLanguage();
		//$joomlaLang = $lang->get('tag');


		$db =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_settings Limit 1");

		$settings = $db->loadObject();

		switch ($settings->language) {
			case 'english.php':
				return 'en';
				break;
			case 'spanish.php':
				return 'es';
				break;
			case 'french.php':
				return 'fr';
				break;
			case 'german.php':
				return 'de';
				break;
			case 'swedish.php':
				return 'se';
				break;
			case 'finnish.php':
				return 'fi';
				break;
			case 'czech.php':
				return 'cs';
				break;
			case 'danish.php':
				return 'da';
				break;
			default:
				return 'en';
		}
	}

	function endecrypt ($pwd, $data, $case='') {
		if ($case == 'de') {
			$data = urldecode($data);
		}

		$key[] = "";
		$box[] = "";
		$temp_swap = "";
		$pwd_length = 0;

		$pwd_length = strlen($pwd);

		for ($i = 0; $i <= 255; $i++) {
			$key[$i] = ord(substr($pwd, ($i % $pwd_length), 1));
			$box[$i] = $i;
		}

		$x = 0;

		for ($i = 0; $i <= 255; $i++) {
			$x = ($x + $box[$i] + $key[$i]) % 256;
			$temp_swap = $box[$i];

			$box[$i] = $box[$x];
			$box[$x] = $temp_swap;
		}

		$temp = "";
		$k = "";

		$cipherby = "";
		$cipher = "";

		$a = 0;
		$j = 0;

		for ($i = 0; $i < strlen($data); $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;

			$temp = $box[$a];
			$box[$a] = $box[$j];

			$box[$j] = $temp;

			$k = $box[(($box[$a] + $box[$j]) % 256)];
			$cipherby = ord(substr($data, $i, 1)) ^ $k;

			$cipher .= chr($cipherby);
		}

		if ($case == 'de') {
			$cipher = urldecode(urlencode($cipher));

		} else {
			$cipher = urlencode($cipher);
		}

		return $cipher;
	}

	function fileManagerjs($count){

		$sessionid = $this->getFormattedSession();
		$lang = $this->getLang();

		$mp3Path = $this->_SETTINGS->mp3_path;
		$mp3Path = str_replace('\\', '//', $mp3Path);

		$previewPath = JPATH_SITE.$this->_SETTINGS->preview_path;
		$previewPath = str_replace('\\', '//', $previewPath);

		echo "
		<script type=\"text/javascript\">
		
		function setGlobal(el, count){
			global_id = el.substring(count, el.length);
		}
		function loadManager() {
			window.addEvent('domready', function() {
	
			var i = 0;
			var el;
	
			for (id = 0; id < $count; id++) {
				
				var complete_mp3 = function(path, file) {
					
					var el = $('mp3_path_'+global_id);
	
					var el_n = $('track_name_'+global_id);
					var el_l = $('track_length_'+global_id);
	
					el.set('value', '');
					el.set('value', path.substring(path.indexOf('/')+1));
					
					if(file.mime == \"audio/mpeg\"){
						el_l.set('value', file.mp3_length);
						el_n.set('value', file.mp3_title);
					}
					
				};
				
				var complete_preview = function(path, file) {
	
					var el_p = $('preview_path_'+global_id);
					
					el_p.set('value', '');
					el_p.set('value', path.substring(path.indexOf('/')+1));
	
				};
	
				var downloadmanager = new FileManager( {
					url : 'components/com_maianmedia/utilities/filemanager/manager.php?path=$mp3Path&sessionid=$sessionid',
					assetBasePath : 'components/com_maianmedia/utilities/filemanager/Assets',
					language : '$lang',
					uploadAuthData : {
						session : '$sessionid'
					},
					absolutePath: '$mp3Path',
					selectable : true,
					onComplete : complete_mp3
				});
	
				var previewmanager = new FileManager( {
					url : 'components/com_maianmedia/utilities/filemanager/manager.php?path=$previewPath&sessionid=$sessionid',
					assetBasePath : 'components/com_maianmedia/utilities/filemanager/Assets',
					language : '$lang',
					uploadAuthData : {
						session : '$sessionid'
					},
					absolutePath: '$previewPath',
					selectable : true,
					onComplete : complete_preview
				});
	
				var mp3_manager = document.id('mp3_manager_'+id);
				mp3_manager.addEvents({
					'click':downloadmanager.show.bind(downloadmanager),
					 'mouseenter':function() {setGlobal(this.id, 12);}
				});
				
				var preview_manager = document.id('preview_manager_'+id)
				preview_manager.addEvents({
					'click':previewmanager.show.bind(previewmanager),
					 'mouseenter':function() {setGlobal(this.id, 16);}
				});
	
			}
		});
	}
	var global_id = '';
	loadManager();
	</script>";
	}

	function setValuesjs(){
		echo '
		<script type="text/javascript">
			
			function Select_Value_Set(SelectName, Value) {
		  		eval(\'SelectObject = document.\' +     SelectName + \';\');
		  		for(index = 0; index < SelectObject.length; index++) {
		   			if(SelectObject[index].value == Value){
		     			SelectObject.selectedIndex = index;
		     		}
		   		}
		   }
		
		 	function setText(field_ID, myValue){	
		 		eval(\'SelectObject = document.\' +field_ID + \';\');
		 		SelectObject.value = myValue.split(\' \').join(\'_\');
		 	}
		 	      
		   
		   function Select_Values() {
		
		  		for(i = 0; i < document.adminForm.total.value; i++) {
		  			//alert(\'adminForm.populate_\'+index+" "+document.adminForm.total.value);
		   			Select_Value_Set(\'adminForm.populate_\'+i, document.adminForm.album.value);
		   		}   
			}
			
		</script>


';
	}

	function sortable16js(){
		$uri =& JURI::getInstance();
		$script ='
		<script type="text/javascript">
		
				function MTFade (div,prop,val) {
					div.tween(prop, val);
			 	}
		
				/* when the DOM is ready */
				window.addEvent(\'domready\', function() {
				
					var d = $(\'sortable-list\');
					
					d.getElements("FIELDSET").addEvents({
					    click: function(E) {
					        E.stopPropagation();
					    }
					});
					
					var s = new Sortables(d, {
					/* set options */
			clone:true,
			revert: true,
						opacity: \'0.6\',

					    onStart: function(el) {
					        el.setStyles({
					            \'background\': \'#f0f0f0\',
					            \'opacity\': 1
					        });
					    },
					    onComplete: function(el) {
					        //el.setStyle(\'background\', \'none\');
					        //var arr = document.getElementsByTagName("legend");
							//var singleArr = getInputsById("track_single");
							//var freeArr = getInputsById("freebie");
			
							//for (i=0; i<arr.length;i++) {
							//	x= i+1;
							//	arr[i].innerHTML="Track "+x;
							//	singleArr[i].setAttribute("name","track_single_"+i);
							//	freeArr[i].setAttribute("name","freebie_"+i);
							//}//end for
					    }
					});
				});
				
			 
			 
		</script>';

		return $script;
	}

	function sortScript(){
		$script = '
		<script type="text/javascript">
		jQuery.noConflict();

			jQuery(function() {
				jQuery("#sortable-list").sortable({
   					update: function(event, ui) { runChange(); }
				});
				
			});
			
		</script>';
		return $script;
	}


	function sortable15js(){
		$uri =& JURI::getInstance();
		$script = '
			<script type="text/javascript">
			
				function MTFade (div,prop,val) {
						new Fx.Style(div, prop, {duration: 250} ).start(val);
			 	}
			
				/* when the DOM is ready */
				window.addEvent(\'domready\', function() {
				
					/* create sortables */
					var sb = new Sortables(\'sortable-list\', {
						/* set options */
			
						clone: true,
						opacity: \'0\',
						handles: \'.handle\',
			
						revert: {
				    		//accepts Fx options
							duration: 500, transition: \'elastic:out\'
						},
						/* initialization stuff here */
						initialize: function() { 
							
						},
						
						onSort: function(el) {
							//passes element you are dragging
							//el.highlight(\'#FFFFFF\');
						},
						
						/* once an item is selected */
						onStart: function(el) { 
							//passes element you are dragging
							//el.highlight(\'#FFFFFF\');
						
						},
						/* when a drag is complete */
						onComplete: function(el) {
							var arr = document.getElementsByTagName("legend");
							var singleArr = getInputsById("track_single");
							var freeArr = getInputsById("freebie");
			
							for (i=0; i<arr.length;i++) {
								x= i+1;
								arr[i].innerHTML="Track "+x;
								singleArr[i].setAttribute("name","track_single_"+i);
								freeArr[i].setAttribute("name","freebie_"+i);
							}//end for
						}
					});
				});
			
				</script>';
		return $script;
	}

	function sortablejs(){
		$uri =& JURI::getInstance();

		$document = &JFactory::getDocument();
		/* TODO need to move JQuery UI to google */
		$document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
		$document->addScript(JURI::base().'components/com_maianmedia/js/jquery/jquery.ui.core.js');
		$document->addScript(JURI::base().'components/com_maianmedia/js/jquery/jquery.ui.widget.js');
		$document->addScript(JURI::base().'components/com_maianmedia/js/jquery/jquery.ui.mouse.js');
		$document->addScript(JURI::base().'components/com_maianmedia/js/jquery/jquery.ui.sortable.js');

		$css = '<style type = "text/css">
                
                  
                  #sortable-list { list-style-type: none; margin: 0; padding: 0; width: 60%; }
	
					#sortable-list li span { position: absolute; }
              </style>';

		$script = '
			<script type="text/javascript">
			
			function getInputsById(tag) {
				var elem = document.getElementsByTagName("input");
				var arr = new Array();
				for (i = 0, iarr = 0; i < elem.length; i++) {
					att = elem[i].getAttribute("id");
					if(att == tag) {
						arr[iarr] = elem[i];
						iarr++;
					}
				}
				return arr;
			}
			
			 function removeTrack(id)
			 {
					var answer = confirm("'.MaianText::_(_msg_javascript21).'","'.MaianText::_(_msg_script2).'","'.MaianText::_(_msg_script3).'");
			 		if (answer){
			 		';
		//if($is15){
		//	$script = $script.'var el = $(\'item_\'+id);
		//				MTFade (el, \'opacity\',0);';
		//}else{
		$script = $script.'fade(\'item_\'+id);';
		//}
		$script = $script.'
						ajaxRequest(\'item_\'+id, \'index.php?option=com_maianmedia&format=raw&controller=tracks&task=removeTrack&deleteThis=\'+id, 0);
						window.setTimeout(\'runChange()\', 1000);
			 		}
			 		
			 }
			 
			 var TimeToFade = 1000.0;

			function fade(eid)
			{
				var element = document.getElementById(eid);
			  	if(element == null)
			    	return;
			   
				if(element.FadeState == null)
			  	{
			    	if(element.style.opacity == null 
			        	|| element.style.opacity == \'\' 
			        	|| element.style.opacity == \'1\')
			    	{
			      		element.FadeState = 2;
			    	}
			    	else
			    	{
			      		element.FadeState = -2;
			    	}
			  	}
			    
				if(element.FadeState == 1 || element.FadeState == -1)
				{
					element.FadeState = element.FadeState == 1 ? -1 : 1;
				    element.FadeTimeLeft = TimeToFade - element.FadeTimeLeft;
				}
				else
				{
					element.FadeState = element.FadeState == 2 ? -1 : 1;
				    element.FadeTimeLeft = TimeToFade;
				    setTimeout("animateFade(" + new Date().getTime() + ",\'" + eid + "\')", 33);
				}  
			}

			function animateFade(lastTick, eid)
			{  
			  var curTick = new Date().getTime();
			  var elapsedTicks = curTick - lastTick;
			  
			  var element = document.getElementById(eid);
			 
			  if(element.FadeTimeLeft <= elapsedTicks)
			  {
			    element.style.opacity = element.FadeState == 1 ? \'1\' : \'0\';
			    element.style.filter = \'alpha(opacity = \' 
			        + (element.FadeState == 1 ? \'100\' : \'0\') + \')\';
			    element.FadeState = element.FadeState == 1 ? 2 : -2;
			    var child = document.getElementById(eid);
          	 var parent = document.getElementById(\'sortable-list\');
          	 parent.removeChild(child);
			    return;
			  }
			 
			  element.FadeTimeLeft -= elapsedTicks;
			  var newOpVal = element.FadeTimeLeft/TimeToFade;
			  if(element.FadeState == 1)
			    newOpVal = 1 - newOpVal;
			
			  element.style.opacity = newOpVal;
			  element.style.filter = \'alpha(opacity = \' + (newOpVal*100) + \')\';
			  
			  setTimeout("animateFade(" + curTick + ",\'" + eid + "\')", 33);
			}
			
			 function runChange()
			 {
			 	var arr = document.getElementsByTagName("legend");
				
				for (i=0; i<arr.length;i++) {
					x= i+1;
					arr[i].innerHTML="Track "+x+"<img class=\'toggle_track\' src=\''.$uri->base().'components/com_maianmedia/images/expand.png\'/>";
			
				}//end for
				
			 }
			
			function expandAll(count){
			
				for (id=0; id<count;id++){
					var row = document.getElementById("albumRow_"+id);
					row.style.display = "";
				
					var row = document.getElementById("mp3Row_"+id);
					row.style.display = "";
				
					var row = document.getElementById("previewRow_"+id);
					row.style.display = "";
				
					var row = document.getElementById("otherRow_"+id);
					row.style.display = "";
					
					var row = document.getElementById("keywordRow_"+id);
					row.style.display = "";
					
				}// end for
			
				var matchClass = "image-handle";
				var elems = document.getElementsByTagName("*"),i;
    				for (i in elems)
    				{
    					if((" "+elems[i].className+" ").indexOf(" "+matchClass+" ") > -1)
           				{
    					elems[i].style.margin  = "0px";
    					}
    				}
			}
			
			function collapseAll(count){
			
				for (id=0; id<count;id++){
					var row = document.getElementById("albumRow_"+id);
					row.style.display = \'none\';
				
					var row = document.getElementById("mp3Row_"+id);
					row.style.display = \'none\';
				
					var row = document.getElementById("previewRow_"+id);
					row.style.display = \'none\';
				
					var row = document.getElementById("otherRow_"+id);
					row.style.display = \'none\';
					
					var row = document.getElementById("keywordRow_"+id);
					row.style.display = \'none\';
					
				}
				var matchClass = "image-handle";
				var elems = document.getElementsByTagName("*"),i;
    				for (i in elems)
    				{
    					if((" "+elems[i].className+" ").indexOf(" "+matchClass+" ") > -1)
           				{
    						elems[i].style.margin  = "5px 0 0 -35px";
    					}
    				}
			}
			 
			function displayRow(id){
			
				var row = document.getElementById("albumRow_"+id);
			
				if (row.style.display == "") row.style.display = \'none\';
			
				else row.style.display = "";
				
				var row = document.getElementById("mp3Row_"+id);
			
				if (row.style.display == "") row.style.display = \'none\';
			
				else row.style.display = "";
				
				var row = document.getElementById("previewRow_"+id);
			
				if (row.style.display == "") row.style.display = \'none\';
			
				else row.style.display = "";
				
				var row = document.getElementById("otherRow_"+id);
			
				if (row.style.display == "") row.style.display = \'none\';
			
				else row.style.display = "";
				
				var row = document.getElementById("keywordRow_"+id);
			
				if (row.style.display == "") row.style.display = \'none\';
			
				else row.style.display = "";
			}
			 
			</script>';

		$version = JVERSION;

		echo $css.$this->sortScript().$script;
	}
}
