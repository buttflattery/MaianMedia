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

jimport('joomla.application.component.controller');

/**
 * Hello World Component Controller
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class MaianControllerTracks extends MaianControllerDefault
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		//$this->registerTask( 'add'  , 	'edit' );
	}

	/* save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		$model = $this->getModel('Tracks');
		$start = JRequest::getVar('limitstart');

		if ($model->store($post)) {
			$msg = MaianText::_( MaianText::_(str_replace("{count}",$model->tracksAdded,_msg_add13)) );
		} else {
			$msg = MaianText::_( 'There was an error saving these tracks' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_maianmedia&controller=albums&view=albums&limitstart='.$start;
		$this->setRedirect($link, $msg);
	}

	/* save a record (and redirect to main page)
	 * @return void
	 */
	function update_tracks()
	{
		$model = $this->getModel('Tracks');

		if ($model->update($post)) {
			$msg = MaianText::_( 'Tracks Updated!' );
		} else {
			$msg = MaianText::_( 'There was an error saving these tracks' );
		}

		$start = JRequest::getVar('limitstart');
		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_maianmedia&controller=albums&view=albums&limitstart='.$start;
		$this->setRedirect($link, $msg);
	}

	function edit()
	{
		JRequest::setVar( 'view', 'track' );
		JRequest::setVar( 'layout', 'view_tracks'  );
		//JRequest::setVar('hidemainmenu', 0);

		// Register Extra tasks
		//$this->registerTask( 'save'  , 	'update_track' );

		parent::display();
	}
	function cancel()
	{
		$msg = MaianText::_(_msg_op_cancel);
		$start = JRequest::getVar('limitstart');
		$this->setRedirect( 'index.php?option=com_maianmedia&controller=albums&view=albums&limitstart='.$start, $msg );
	}

	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display()
	{
		// loading view for this task
		JRequest::setVar( 'view', 'tracks' );
		parent::display();
	}

	function removeTrack()
	{
		$db =& JFactory::getDBO();
		$cid = JRequest::getVar('deleteThis');

		$db->setQuery("SELECT track_album FROM #__m15_tracks WHERE id=$cid");
		$album_id = $db->LoadObject();

		$db->setQuery("DELETE FROM #__m15_tracks WHERE id=$cid");
		$db->query();

		$db->setQuery("SELECT id FROM #__m15_tracks WHERE track_album=$album_id->track_album ORDER BY track_order");
		$list = $db->loadObjectList();

		$i = 1;
		foreach ($list AS $TRACK){
			$db->SetQuery("UPDATE #__m15_tracks SET track_order=$i WHERE id=".$TRACK->id);
			$i++;
		}


		//$this->setRedirect( 'index.php?option=com_maianmedia&controller=tracks&amp;task=edit&amp;view=track&amp;cid=&'.$album, $msg );

	}

	function add()
	{
		JRequest::setVar( 'view', 'track' );
		JRequest::setVar( 'layout', 'default');
		JRequest::setVar('hidemainmenu', 1);
			
		parent::display();

	}

	function manager(){
		include(JPATH_COMPONENT.DS.'utilities'.DS.'filemanager'.DS.'FileManager.php');

		$db =& JFactory::getDBO();

		$db->setQuery("Select * from #__m15_settings Limit 1");
		$settings = $db->loadObject();

		if($type == '0'){
			$dest = $settings->mp3_path;
		}else{
			$dest = JPATH_SITE.$settings->preview_path;
		}

		$browser = new FileManager(array(
			'directory' => $dest,
			'assetBasePath' => 'components/com_maianmedia/utilities/filemanager/Assets',
			'upload' => true,
			'destroy' =>true,			
		));

		$browser->fireEvent(!empty($_GET['event']) ? $_GET['event'] : null);
	}

	function getTracks()
	{
		jimport( 'joomla.environment.uri' );

		$numOf = JRequest::getVar('arrayElements');

		$uri =& JURI::getInstance();
		$root_url = $uri->root(); //root url
		$root_base = $uri->base(); //base url
		$root_current = $uri->current(); //current url pathj

		JRequest::setVar( 'view', 'track' );
		JRequest::setVar( 'layout', 'table'  );
		JRequest::setVar( 'type', 'track' );

		require_once(JPATH_COMPONENT.DS.'views'.DS.'track'.DS.'tmpl'.DS.'table.php');

	}

	function move_file(){
		$upload = JRequest::getVar('uploadTrack_');
		$filename = JRequest::getVar('filename');
		$type = JRequest::getVar('checked');
		$subFolder = JRequest::getVar('sub_folder_');
		$subFolder = str_replace(" ","_",$subFolder );

		$db =& JFactory::getDBO();

		$db->setQuery("Select * from #__m15_settings Limit 1");
		$settings = $db->loadObject();
		//Retrieve file details from uploaded file, sent from upload form
		//$file = JRequest::getVar('file_upload', null, 'files', 'array');

		//Import filesystem libraries. Perhaps not necessary, but does not hurt
		jimport('joomla.filesystem.file');

		//Clean up filename to get rid of strange characters like spaces etc
		$filename = JFile::makeSafe($filename);

		//Set up the source and destination of the file
		if($type == '0'){
			$dest = $settings->mp3_path;
		}else{

			$dest = JPATH_SITE.$settings->preview_path;


		}

		$dest = str_replace("\\","//",$dest);

		$src = JPATH_COMPONENT.DS."uploader".DS."tmp".DS.$filename;

		//First check if the folder from settings exist
		if ( JFolder::exists($dest)) {

			if(!JFolder::exists($dest.DS.$subFolder)){
				JFolder::create($dest.DS.$subFolder);
				$dest = $dest.DS.$subFolder.DS.str_replace(" ","_",$filename);
			}else{
				$dest = $dest.DS.str_replace(" ","_",$filename);
			}

			if (JFile::copy($src, $dest)){

				echo '<input id=\'subId\' type=\'hidden\' value=\'30\'value=\''.$subFolder.'\' />';
				echo '<input id=\'inputPath\' type=\'hidden\' value=\'30\'value=\''.$type.'\' />';
			} else {
				jimport( 'joomla.error.error' );
				$errors = JError::getErrors();
				echo '<div class=\'sucErr\'><div>'.MaianText::_(_msg_tracks12).'</div><br><div>'.$errors.'</div></div>';
			}
		} else {
			echo '<div class=\'sucErr\'>'.MaianText::_(str_replace("{PATH}",$dest,_msg_tracks11)).'</div>';
		}

		JFile::delete($src);
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

	function updateHash($sessionid, $data){

		$md5loc = strpos($data, '$md5=');
		$header = substr($data,0,$md5loc+5);
		$header = $header.'\''.$sessionid."';?>";

		return $header;
	}

	function uploaderjs(){
		jimport('joomla.filesystem.file');

		$merge = '$merge';
		$session = & JFactory::getSession();

		$user =& JFactory::getUser();

		$md5 =md5($user->password);

		$authFile = JPATH_COMPONENT.DS.'utilities'.DS.'filemanager'.DS.'auth.php';
		JPath::setPermissions($authFile, '0755');
		$data = JFile::read($authFile);

		$sess = $session->getId();

		$data = $this->updateHash($md5, $data);
		$data = JFile::write($authFile,$data);
			
		$session = $this->endecrypt($md5,$session->getId());
		$sessionid = str_replace('%','-per-',$session);
		$sessionid = str_replace('.','-dot-',$sessionid);

		$filesize = str_replace('M','',ini_get("upload_max_filesize"));
		$path = "administrator/components/com_maianmedia/utilities/filemanager/Assets/";
		$output = "
		FileManager.implement({
  
		  options: {
		    resizeImages: true,
		    upload: true,
		    uploadAuthData: {session : '".$sess."'}
		  },
		  
		  hooks: {
		    show: {
		      upload: function() {
		        this.startUpload();
		      }
		    },
		    
		    cleanup: {
		      upload: function(){
		        if (!this.options.upload  || !this.upload) return;
		        
		        if (this.upload.uploader) this.upload.uploader.set('opacity', 0).dispose();
		      }
		    }
		  },
		
		  onDialogOpenWhenUpload: function(){
		    if (this.swf && this.swf.box) this.swf.box.setStyle('visibility', 'hidden');
		  },
		  
		  onDialogCloseWhenUpload: function(){
		    if (this.swf && this.swf.box) this.swf.box.setStyle('visibility', 'visible');
		  },
		  
		  startUpload: function(){
		    
		    if (!this.options.upload || this.swf) return;
		    
		    var self = this;
		    this.upload = {
		      button: this.addMenuButton('upload').inject(this.menu, 'bottom').addEvents({
		        click: function(){
		          return false;
		        },
		        mouseenter: function(){
		          this.addClass('hover');
		        },
		        mouseleave: function(){
		          this.removeClass('hover');
		          this.blur();
		        },
		        mousedown: function(){
		          this.focus();
		        }
		      }),
		      list: new Element('ul', {'class': 'filemanager-uploader-list'}),
		      uploader: new Element('div', {opacity: 0}).adopt(
		        new Element('h2', {text: this.language.upload}),
		        new Element('div', {'class': 'filemanager-uploader'})
		      )
		    };
		    this.upload.uploader.getElement('div').adopt(this.upload.list);
		    //this.closeIcon.appearOn(this.upload.button, 0.5);
		    
		    if (this.options.resizeImages){
		      var resizer = new Element('div', {'class': 'checkbox'}),
		        check = (function(){ this.toggleClass('checkboxChecked'); }).bind(resizer);
		      check();
		      this.upload.label = new Element('label').adopt(
		        resizer, new Element('span', {text: this.language.resizeImages})
		      ).addEvent('click', check).inject(this.menu);
		    }
		    
		    var File = new Class({
		
		      Extends: Swiff.Uploader.File,
		      
		      initialize: function(base, data){
		
		        this.parent(base, data);
		        
		        this.setOptions({
		         // url: self.options.url +'&session=".$sess."&'+ Object.toQueryString(Object.merge({}, self.options.uploadAuthData, {
		            url: self.options.url + (self.options.url.indexOf('?') == -1 ? '?' : '&') + '&auth=".$sess."&'+ Object.toQueryString(Object.merge({}, self.options.uploadAuthData, {
		         	event: 'upload',
		            directory: self.normalize(self.Directory),
		            resize: self.options.resizeImages && resizer.hasClass('checkboxChecked') ? 1 : 0
		          }))
		        });
		      },
		      
		      render: function(){
		        if (this.invalid){
		          var message = self.language.uploader.unknown, sub = {
		            name: this.name,
		            size: Swiff.Uploader.formatUnit(this.size, 'b')
		          };
		          
		          if (self.language.uploader[this.validationError])
		            message = self.language.uploader[this.validationError];
		          
		          if (this.validationError == 'sizeLimitMin')
		              sub.size_min = Swiff.Uploader.formatUnit(this.base.options.fileSizeMin, 'b');
		          else if (this.validationError == 'sizeLimitMax')
		              sub.size_max = Swiff.Uploader.formatUnit(this.base.options.fileSizeMax, 'b');
		          
		          new Dialog(new Element('div', {html: message.substitute(sub, /\\?\$\{([^{}]+)\}/g)}) , {language: {confirm: self.language.ok}, buttons: ['confirm']});
		          return this;
		        }
		        
		        this.addEvents({
		          open: this.onOpen,
		          remove: this.onRemove,
		          requeue: this.onRequeue,
		          progress: this.onProgress,
		          stop: this.onStop,
		          complete: this.onComplete
		        });
		        
		        this.ui = {};
		        this.ui.icon = new Asset.image(self.assetBasePath+'Images/Icons/' + this.extension + '.png', {
		          'class': 'icon',
		          onerror: function(){ new Asset.image(self.assetBasePath + 'Images/Icons/default.png').replaces(this); }
		        });
		        this.ui.element = new Element('li', {'class': 'file', id: 'file-' + this.id});
		        this.ui.title = new Element('span', {'class': 'file-title', text: this.name});
		        this.ui.size = new Element('span', {'class': 'file-size', text: Swiff.Uploader.formatUnit(this.size, 'b')});
		        
		        var file = this;
		        this.ui.cancel = new Asset.image(self.assetBasePath+'Images/cancel.png', {'class': 'file-cancel', title: self.language.cancel}).addEvent('click', function(){
		          file.remove();
		          self.tips.hide();
		          self.tips.detach(this);
		        });
		        self.tips.attach(this.ui.cancel);
		        
		        var progress = new Element('img', {'class': 'file-progress', src: self.assetBasePath+'Images/bar.gif'});
		
		        this.ui.element.adopt(
		          this.ui.cancel,
		          progress,
		          this.ui.icon,
		          this.ui.title,
		          this.ui.size
		        ).inject(self.upload.list).highlight();
		        
		        this.ui.progress = new Fx.ProgressBar(progress).set(0);
		              
		        this.base.reposition();
		
		        return this.parent();
		      },
		
		      onOpen: function(){
		        this.ui.element.addClass('file-running');
		      },
		
		      onRemove: function(){
		        this.ui = this.ui.element.destroy();
		      },
		
		      onProgress: function(){
		        this.ui.progress.start(this.progress.percentLoaded);
		      },
		
		      onStop: function(){
		        this.remove();
		      },
		
		      onComplete: function(){
		        this.ui.progress = this.ui.progress.cancel().element.destroy();
		        this.ui.cancel = this.ui.cancel.destroy();
		        
		        var response = JSON.decode(this.response.text);
		        if (!response.status)
		          new Dialog(('' + response.error).substitute(self.language, /\\?\$\{([^{}]+)\}/g) , {language: {confirm: self.language.ok}, buttons: ['confirm']});
		        
		        this.ui.element.set('tween', {duration: 2000}).highlight(response.status ? '#e6efc2' : '#f0c2c2');
		        (function(){
		          this.ui.element.setStyle('overflow', 'hidden').morph({
		            opacity: 0,
		            height: 0
		          }).get('morph').chain(function(){
		            this.element.destroy();
		            if (!self.upload.list.getElements('li').length)
		              self.upload.uploader.fade(0).get('tween').chain(function(){
		                self.fillInfo();
		              });
		          });
		        }).delay(5000, this);
		      }
		    });
		    
		    this.getFileTypes = function() {
		      var fileTypes = {};
		      if(this.options.filter == 'image')
		        fileTypes = {'Images (*.jpg, *.gif, *.png)': '*.jpg; *.jpeg; *.bmp; *.gif; *.png'};
		      if(this.options.filter == 'video')
		        fileTypes = {'Videos (*.avi, *.flv, *.mov, *.mpeg, *.mpg, *.wmv, *.mp4)': '*.avi; *.flv; *.fli; *.movie; *.mpe; *.qt; *.viv; *.mkv; *.vivo; *.mov; *.mpeg; *.mpg; *.wmv; *.mp4'};
		      if(this.options.filter == 'audio')
		        fileTypes = {'Audio (*.aif, *.mid, *.mp3, *.mpga, *.rm, *.wav)': '*.aif; *.aifc; *.aiff; *.aif; *.au; *.mka; *.kar; *.mid; *.midi; *.mp2; *.mp3; *.mpga; *.ra; *.ram; *.rm; *.rpm; *.snd; *.wav; *.tsi'};
		      if(this.options.filter == 'text')
		        fileTypes = {'Text (*.txt, *.rtf, *.rtx, *.html, *.htm, *.css, *.as, *.xml, *.tpl)': '*.txt; *.rtf; *.rtx; *.html; *.htm; *.css; *.as; *.xml; *.tpl'};
		      if(this.options.filter == 'application')
		        fileTypes = {'Application (*.bin, *.doc, *.exe, *.iso, *.js,*.odt, *.pdf, *.php, *.ppt, *.swf, *.rar, *.zip)': '*.ai; *.bin; *.ccad; *.class; *.cpt; *.dir; *.dms; *.drw; *.doc; *.dvi; *.dwg; *.eps; *.exe; *.gtar; *.gz; *.js; *.latex; *.lnk; *.lnk; *.oda; *.odt; *.ods; *.odp; *.odg; *.odc; *.odf; *.odb; *.odi; *.odm; *.ott; *.ots; *.otp; *.otg; *.pdf; *.php; *.pot; *.pps; *.ppt; *.ppz; *.pre; *.ps; *.rar; *.set; *.sh; *.skd; *.skm; *.smi; *.smil; *.spl; *.src; *.stl; *.swf; *.tar; *.tex; *.texi; *.texinfo; *.tsp; *.unv; *.vcd; *.vda; *.xlc; *.xll; *.xlm; *.xls; *.xlw; *.zip'};
		      
		  		return fileTypes;
		    };
		    
		    this.swf = new Swiff.Uploader({
		      id: 'SwiffFileManagerUpload',
		      path: this.assetBasePath + 'Swiff.Uploader.swf',
		      queued: false,
		      target: this.upload.button,
		      allowDuplicates: true,
		      instantStart: true,
		      fileClass: File,
		      timeLimit: 260,
		      fileSizeMax: ".$filesize." * 1024 * 1024,
		      typeFilter: this.getFileTypes(),
		      zIndex: this.SwiffZIndex || 9999,
		      onSelectSuccess: function(){
		        self.fillInfo();
		        self.info.getElement('h2.filemanager-headline').setStyle('display', 'none');
		        self.preview.adopt(self.upload.uploader);
		        self.upload.uploader.fade(1);
		      },
		      onComplete: function(){
		        self.load(self.Directory, true);
		      },
		      onFail: function(error) {
		        if(error != 'empty') {
		          $$(self.upload.button, self.upload.label).dispose();
		          new Dialog(new Element('div', {html: self.language.flash[error] || self.language.flash.flash}), {language: {confirm: self.language.ok}, buttons: ['confirm']});
		        }
		      }
		    });
		  }
		  
		});";
		echo $output;
	}

	function preview() {

		$archiveName = $_GET["path"];

		// set headers
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		header("Content-Type: audio/mpeg");
		header("Content-Disposition: attachment; filename=\"".basename($archiveName)."\";" );
		header("Content-Transfer-Encoding: binary");
			
		$file = @fopen($archiveName,"rb");

		if ($file) {
			while(!feof($file)) {

				print(fread($file, 1024*8));
				flush();
				if (connection_status()!=0) {
					@fclose($file);
					die();
				}

			}
			@fclose($file);
		}

	}

}