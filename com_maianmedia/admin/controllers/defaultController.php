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

class MaianControllerDefault extends JController
{
	/**
	 * The xml params element
	 *
	 * @access	private
	 * @var		object
	 * @since	1.5
	 */
	var $_xml = null;

	/**
	 * loaded elements
	 *
	 * @access	private
	 * @var		array
	 * @since	1.5
	 */
	var $_elements = array();

	/**
	 * This holds the file handle for this instance's log file
	 * @var resource
	 */
	var $_log = null;
	var $_SETTINGS = null;
	var $root_url, $base_url, $current_url;

	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		$db = & JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_settings");
		$this->_SETTINGS = $db->loadObject();

		$uri =& JURI::getInstance();
		$this->root_url = $uri->root(); //root url
		$this->base_url = $uri->base(); //base url
		$this->current_url = $uri->current();

		if($this->_SETTINGS->log_errors == '1'){
			$this->_log = new MaianLogger(JPATH_COMPONENT_SITE.DS.'log', MaianLogger::DEBUG);
		}else{
			$this->_log = new MaianLogger(JPATH_COMPONENT_SITE.DS.'log', MaianLogger::OFF);
		}

		parent::__construct();


	}

	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display()
	{
		// loading view for this task
		parent::display();
	}

	function about()
	{
		// loading view for this task
		jimport( 'joomla.database.database' );
		$pathvalue = JPATH_LIBRARIES.DS.'joomla'.DS.'factory.php';
		require_once( $pathvalue );
		jimport( 'joomla.application.component.view' );
		JToolBarHelper::title(   MaianText::_( _msg_header2), 'about.png' );
		//$db =& JFactory::getDBO();
		//$$database =& JFactory::getDBO();
		require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'tmpl'.DS.'about.php');
		//echo'test';
	}

	function tools()
	{
		// loading view for this task
		jimport( 'joomla.database.database' );
		require_once(JPATH_LIBRARIES.DS.'joomla'.DS.'factory.php');
		jimport( 'joomla.application.component.view' );

		$tool = JRequest::getVar( 'tool' );

		switch ($tool) {
			case "run_import":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'source'.DS.'run_import.php');
				break;
			case "import_view":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'tmpl'.DS.'import_view.php');
				break;
			case "run_backup":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'source'.DS.'run_backup.php');
				break;
			case "import_backup":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'source'.DS.'import_backup.php');
				break;
			case "backup_view":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'tmpl'.DS.'backup_view.php');
				break;
			case "system_view":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'tmpl'.DS.'system_view.php');
				break;
			case "update_view":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'tmpl'.DS.'update_view.php');
				break;
			case "run_download":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'source'.DS.'run_download.php');
				break;
			case "load_tree":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'source'.DS.'load_tree.php');
				break;
			case "load_root":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'source'.DS.'load_root.php');
				break;
			case "run_update":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'source'.DS.'run_update.php');
				break;
			case "custom":

				$document = &JFactory::getDocument();
				$document->addCustomTag('<link href="components/com_maianmedia/stylesheet.css" rel="stylesheet" type="text/css" />');

				JToolBarHelper::title(   MaianText::_(_setup25), 'template.png' );
				JToolBarHelper::save();
				JToolBarHelper::apply();
				JToolBarHelper::cancel();

				require_once(JPATH_COMPONENT.DS.'views'.DS.'tools'.DS.'custom.php');
				break;
			case "menu-edit":

				$document = &JFactory::getDocument();
				$document->addCustomTag('<link href="components/com_maianmedia/stylesheet.css" rel="stylesheet" type="text/css" />');
				$document->addCustomTag('<link href="components/com_maianmedia/utilities/simple-js-accordions/style.css" rel="stylesheet" type="text/css" />');
				$document->addScript(JURI::base().'components/com_maianmedia/utilities/simple-js-accordions/accordian-src.js');
				//$document->addCustomTag('<script type="text/javascript">
				//			window.document.onload = new Accordian(\'basic-accordian\',5,\'header_highlight\');
				//</script>');

				JToolBarHelper::title(MaianText::_(_msg_header9), 'menu-edit.png' );
				JToolBarHelper::save();
				JToolBarHelper::apply();
				JToolBarHelper::cancel();

				require_once(JPATH_COMPONENT.DS.'views'.DS.'tools'.DS.'menus.php');
				break;
			default:
				JToolBarHelper::title(   MaianText::_( _msg_header3), 'tools.png' );
				require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'tmpl'.DS.'tools.php');
		}

	}

	function getPage($page){

		$view = '';

		if($page->name == 'about'){
			$view = "mostpop";
		}elseif($page->name == 'cat'){
			$view = "categories";
		}elseif($page->name == 'free'){
			$view = "freebie";
		}else{
			$view = $page->name;
		}
		return $view;
	}

	function getDownload()
	{
		$file_path = $_GET["file"];
		$fname = basename($_GET["file"]);

		// remove some bad chars
		$asfname = str_replace(array('"',"'",'\\','/'), '', $fname);
		if ($asfname === '') $asfname = 'NoName';

		// file size in bytes
		$fsize = filesize($file_path);

		// file extension
		$fext = strtolower(substr(strrchr($fname,"."),1));

		// get mime type
		$mtype = '';
		// mime type is not set, get from server settings
		if (function_exists('mime_content_type')) {
			$mtype = mime_content_type($file_path);
		}
		else if (function_exists('finfo_file')) {
			$finfo = finfo_open(FILEINFO_MIME); // return mime type
			$mtype = finfo_file($finfo, $file_path);
			finfo_close($finfo);
		}
		if ($mtype == '') {
			$mtype = "application/force-download";
		}


		set_time_limit(0);
		// set headers
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Type: $mtype");
		header("Content-Disposition: attachment; filename=\"$asfname\"");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . $fsize);

		// download
		// @readfile($file_path);
		$file = @fopen($file_path,"rb");
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
			


		fclose($fh);
	}

	function readfile_chunked() {

		$archiveName = $_GET["file"];

		// set headers
		header("Cache-Control: no-store, must-revalidate");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Content-Type: audio/mpeg");
		header('Content-Length: ' . filesize($file));

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



	function cancel(){
		jimport( 'joomla.database.database' );
		require_once(JPATH_LIBRARIES.DS.'joomla'.DS.'factory.php');
		jimport( 'joomla.application.component.view' );

		$document = &JFactory::getDocument();
		$document->addCustomTag('<link href="components/com_maianmedia/stylesheet.css" rel="stylesheet" type="text/css" />');

		JToolBarHelper::title(   MaianText::_( _msg_header3), 'tools.png' );
		require_once(JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'tmpl'.DS.'tools.php');
	}

	function getVersion(){
		/* TODO Snoppy should move to the utilities folder */
		require_once(JPATH_COMPONENT.DS.'common'.DS.'Snoopy.class.php');
			
		//Get current version
		$filename=JPATH_COMPONENT.DS.'maianmedia.xml';
		$output="";
		$file = fopen($filename, "r");
		$bool = true;

		while($bool) {
			//read file line by line into variable
			$output = fgets($file, 4096);
			if(strpos($output ,'<version>')){
				$current_version = substr($output, strpos($output ,'<version>')+9, strpos($output ,'</version>') - 10);
				$bool = false;
			}

		}
		fclose ($file);

		jimport( 'joomla.environment.uri' );

		$uri =& JURI::getInstance();

		$s = new Snoopy();
		$s->read_timeout = 90;
		$s->referer = $uri->root();

		@$s->fetch('http://support.aretimes.com/versions/comprofilerversion.php?currentversion='.urlencode($current_version));
		$version_info = $s->results;
		$version_info_pos = strpos($version_info, ":");

		if ($version_info_pos === false) {
			$version = $version_info;
			$info = null;
		} else {
			$version = substr( $version_info, 0, $version_info_pos );
			$info = substr( $version_info, $version_info_pos + 1 );
		}

		if($s->error || $s->status != 200){
			echo '<font color="red">Unable to determine version</font>';
			//echo '<font color="red">'. $s->error .' '. ($s->status == -100 ? 'Timeout' : $s->status).'</font><br/>';
		} else if($current_version == $version){
			echo MaianText::_(_setup32).' '.$version.'&nbsp;&nbsp;<font color="green">' ._setup31.' '. $current_version . '</font>' . $info.'<br/>';
		} else {
			echo MaianText::_(_setup32).' '.$version.'&nbsp;&nbsp;<font color="red">' ._setup31.' '. $current_version . '</font>' . $info.'<br/>';
		}

	}

	function downloadRemoteFile($url,$dir,$file_name = NULL){
		if($file_name == NULL){ $file_name = basename($url);}
		$url_stuff = parse_url($url);
		$port = isset($url_stuff['port']) ? $url_stuff['port'] : 80;

		$fp = fsockopen($url_stuff['host'], $port);
		if(!$fp){ return false;}

		$query  = 'GET ' . $url_stuff['path'] . " HTTP/1.0\n";
		$query .= 'Host: ' . $url_stuff['host'];
		$query .= "\n\n";

		fwrite($fp, $query);
		@set_time_limit(0);
		while ($tmp = fread($fp, 8192))   {
			$buffer .= $tmp;
		}

		preg_match('/Content-Length: ([0-9]+)/', $buffer, $parts);
		$file_binary = substr($buffer, - $parts[1]);
		if($file_name == NULL){
			$temp = explode(".",$url);
			$file_name = $temp[count($temp)-1];
		}
		$file_open = fopen($dir . "/" . $file_name,'w');
		if(!$file_open){ return false;}
		fwrite($file_open,$file_binary);
		fclose($file_open);
		return $file_name;
	}

	function getSingleStatement($record) {
		$insert = "";
		foreach($record as $key => $value){
			$insert = $insert.$key.",";
		}

		$len = strlen($insert) - 1;

		$insert = substr($insert, 0, $len).") VALUES (";

		foreach($record as $key => $value){
			//if(ctype_digit($value)){
			//$insert = $insert.$value.",";
			//}else{
			$value = str_replace("\'", "'", $value);
			$value = str_replace('\"', '"', $value);
			$value = str_replace("'", "\'", $value);
			$value = str_replace('"', '\"', $value);
			$insert = $insert."'".$value."',";

			//}
		}
			
		$insert = substr($insert, 0, strlen($insert) - 1).")";

		return trim($insert);
	}

	function getStatements($records) {
		$insert = "";
		$first = true;

		foreach($records as $record){

			if($first){
				foreach($record as $key => $value){
					$insert = $insert.$key.",";
				}
				$first = false;

				$len = strlen($insert) - 1;
				$insert = substr($insert, 0, $len).") VALUES (";
			}

			foreach($record as $key => $value){
				if(is_int($value)){
					$insert = $insert.$value.",";
				}else{
					$insert = $insert."'".$value."',";
				}
			}

			$insert = substr($insert, 0, strlen($insert) - 1)."),(";
		}

		$insert = substr($insert, 0, strlen($insert) - 2);

		return trim($insert);
	}

	function updateSingleStatement($table, $data){
		$db =& JFactory::getDBO();

		$update = "UPDATE $table SET ";
		foreach($data as $key => $value){
			$value = str_replace("\'", "'", $value);
			$value = str_replace('\"', '"', $value);
			$value = str_replace("'", "\'", $value);
			$value = str_replace('"', '\"', $value);
				
			$update = $update.$key."='".$value."',";
		}

		$update = substr($update, 0, strlen($update) - 1)." WHERE id=".$data->id;

		$db->setQuery($update);
		$db->query();
			
	}

	function updateInsertStatement($table, $data){
		$db =& JFactory::getDBO();

		$db->setQuery("Select id from $table WHERE id =".$data->id);

		$id = $db->loadObject();

		if(isset($id)){
			$this->updateSingleStatement($table, $data);
		}else{
			$insert = "INSERT INTO ".$table."(";
			$insert = $insert." ".$this->getSingleStatement($data);
			$db->setQuery($insert);

			$db->query();
		}

	}

	function renderSettingsAjax(){

		$player = JRequest::getVar('player_');

		$XMLFile = JPATH_COMPONENT_SITE.DS.'players'.DS.$player.DS.'playerDetails.xml';
		$data = $this->_SETTINGS->player_params;
		echo '<div id="settings_player">'.$this->renderSettings($XMLFile, $this->_SETTINGS->player_params, false, 'player-params').'</div>';
	}

	/**
	 * Render
	 *
	 * @access	public
	 * @param	string	The name of the control, or the default text area if a setup file is not found
	 * @return	string	HTML
	 * @since	1.5
	 */
	function renderSettings($path, $data, $embed=false, $name='params')
	{
		$xml = & JFactory::getXMLParser('Simple');

		if ($xml->loadFile($path))
		{
			if ($params = & $xml->document->params) {
				foreach ($params as $param)
				{
					$this->setXML( $param );
					$result = true;
				}
			}
		}

		$ns = $this->stringToObject($data);
		$params = $this->getParams($name, '_default', $ns);
		$html = array ();

		$html[] = '<table width="100%" class="paramlist admintable" cellspacing="1">';

		if ($description = $this->_xml['_default']->attributes('description')) {
			// add the params description to the display
			$desc	= MaianText::_($description);
			$html[]	= '<tr><td class="paramlist_description" colspan="2">'.$desc.'</td></tr>';
		}

		foreach ($params as $param)
		{
			$html[] = '<tr>';

			if ($param[0]) {
				$html[] = '<td width="40%" class="paramlist_key"><span class="editlinktip">'.$param[0].'</span></td>';
				$html[] = '<td class="paramlist_value">'.$param[1].'</td>';
			} else {
				$html[] = '<td class="paramlist_value" colspan="2">'.$param[1].'</td>';
			}

			$html[] = '</tr>';
		}

		if (count($params) < 1) {
			$html[] = $tr."<td colspan=\"2\"><i>".MaianText::_('There are no Parameters for this item')."</i></td></tr>";
		}

		$html[] = '</table>';

		return implode("\n", $html);
	}

	/**
	 * Sets the XML object from custom xml files
	 *
	 * @access	public
	 * @param	object	An XML object
	 * @since	1.5
	 */
	function setXML( &$xml )
	{
		if (is_object( $xml ))
		{
			if ($group = $xml->attributes( 'group' )) {
				$this->_xml[$group] = $xml;
			} else {
				$this->_xml['_default'] = $xml;
			}
			if ($dir = $xml->attributes( 'addpath' )) {
				$this->addElementPath( JPATH_ROOT . str_replace('/', DS, $dir) );
			}
		}
	}

	/**
	 * Render a parameter type
	 *
	 * @param	object	A param tag node
	 * @param	string	The control name
	 * @return	array	Any array of the label, the form element and the tooltip
	 * @since	1.5
	 */
	function getParam(&$node, $control_name = 'params', $group = '_default', $values)
	{
		//get the type of the parameter
		$type = $node->attributes('type');

		//remove any occurance of a mos_ prefix
		$type = str_replace('mos_', '', $type);

		$element =& $this->loadElement($type);

		// error happened
		if ($element === false)
		{
			$result = array();
			$result[0] = $node->attributes('name');
			$result[1] = MaianText::_('Element not defined for type').' = '.$type;
			$result[5] = $result[0];
			return $result;
		}

		//get value
		$property = $node->attributes('name');

		if (isset($values->$property)) {
			$value = $values->$property;
		}else{
			$value = $this->get($node->attributes('name'), $node->attributes('default'), $group);
		}

		return $this->renderElement($node, $value, $control_name, $element);
	}

	/**
	 * Render all parameters
	 *
	 * @access	public
	 * @param	string	The name of the control, or the default text area if a setup file is not found
	 * @return	array	Aarray of all parameters, each as array Any array of the label, the form element and the tooltip
	 * @since	1.5
	 */
	function getParams($name = 'params', $group = '_default', $values)
	{
		if (!isset($this->_xml[$group])) {
			return false;
		}
		$results = array();
		foreach ($this->_xml[$group]->children() as $param)  {
			$results[] = $this->getParam($param, $name, $group, $values);
		}
		return $results;
	}

	function renderElement(&$xmlElement, $value, $control_name = 'params', $element)
	{
		$name	= $xmlElement->attributes('name');
		$label	= $xmlElement->attributes('label');
		$descr	= $xmlElement->attributes('description');
		//make sure we have a valid label
		$label = $label ? $label : $name;
		$result[0] = $this->fetchTooltip($label, $descr, $xmlElement, $control_name, $name);
		$result[1] = $element->fetchElement($name, $value, $xmlElement, $control_name);
		$result[2] = $descr;
		$result[3] = $label;
		$result[4] = $value;
		$result[5] = $name;

		return $result;
	}

	/**
	 * Loads a element type
	 *
	 * @access	public
	 * @param	string	elementType
	 * @return	object
	 * @since	1.5
	 */
	function &loadElement( $type, $new = false )
	{
		$false = false;
		$signature = md5($type);

		if( (isset( $this->_elements[$signature] ) && !is_a($this->_elements[$signature], '__PHP_Incomplete_Class'))  && $new === false ) {
			return	$this->_elements[$signature];
		}

		$location = JPATH_COMPONENT.DS.'utilities'.DS.'template'.DS.'elements'.DS.$type.'.php';

		if(file_exists($location)){
			include_once($location);
		}

		$elementClass	=	'JElement'.$type;
		if( !class_exists( $elementClass ) )
		{
			if( isset( $this->_elementPath ) ) {
				$dirs = $this->_elementPath;
			} else {
				$dirs = array();
			}

			$file = JFilterInput::clean(str_replace('_', DS, $type).'.php', 'path');

			jimport('joomla.filesystem.path');
			if ($elementFile = JPath::find($dirs, $file)) {
				include_once $elementFile;
			} else {
				return $false;
			}
		}

		if( !class_exists( $elementClass ) ) {
			return $false;
		}

		$this->_elements[$signature] = new $elementClass($this);

		return $this->_elements[$signature];
	}

	function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='')
	{
		$output = '<label id="'.$control_name.$name.'-lbl" for="'.$control_name.$name.'"';
		if ($description) {
			$output .= ' class="hasTip" title="'.MaianText::_($label).'::'.MaianText::_($description).'">';
		} else {
			$output .= '>';
		}
		$output .= MaianText::_( $label ).'</label>';

		return $output;
	}

	function updateParams(){
		$params = JRequest::getVar('params');
		$lines = "";
		$bool = true;

		foreach ($params  as $k => $v)
		{
			if($bool){
				$lines =$k.'='.$v;
				$bool = false;
			}else{
				$lines .="\r\n".$k.'='.$v;
			}

		}

		$db =& JFactory::getDBO();

		$db->setQuery("UPDATE #__m15_settings SET extra_params='$lines' WHERE id='1';");
		$db->query();

		require_once(JPATH_COMPONENT.DS.'views'.DS.'settings'.DS.'tmpl'.DS.'tplParams.php');
	}

	function display_player()
	{
		jimport( 'joomla.environment.uri' );

		$uri =& JURI::getInstance();
		$root_url = $uri->root(); //root url
		$root_base = $uri->base(); //base url
		$root_current = $uri->current(); //current url pathj

		$player_type = JRequest::getVar( 'player_type' );

		include_once(JPATH_COMPONENT_SITE.DS.'players'.DS.'maianplayer.php');

		if(JRequest::getVar('save')){

			$this->updatePlayerParams();
		}

		if(is_file(JPATH_COMPONENT_SITE.DS.'players'.DS.$player_type.DS.'player.php')){
			include_once(JPATH_COMPONENT_SITE.DS.'players'.DS.$player_type.DS.'player.php');
			$player = new $player_type();
				
			echo '<div id="settings_player">'.$player->getplayer("test.mp3").'</div>';
		}

	}//end display_player

	function updatePlayerParams(){

		$params = JRequest::getVar('player-params');
		$lines = "";
		$bool = true;

		foreach ($params  as $k => $v)
		{
			if($bool){
				$lines =$k.'='.$v;
				$bool = false;
			}else{
				$lines .="\r\n".$k.'='.$v;
			}

		}

		$db =& JFactory::getDBO();

		$db->setQuery("UPDATE #__m15_settings SET player_params='$lines' WHERE id='1';");
		$db->query();

	}

	function getPlayerParams($subDir){
		$objDOM = new DOMDocument();
		$objDOM->load(JPATH_COMPONENT_SITE.DS.'players'.DS.$subdir.DS.'playerDetails.xml');
		echo $this->renderSettings($templateXMLFile, $SETTINGS->extra_params);
	}

	/**
	 * Parse an .ini string, based on phpDocumentor phpDocumentor_parse_ini_file function
	 *
	 * @access public
	 * @param mixed The INI string or array of lines
	 * @param boolean add an associative index for each section [in brackets]
	 * @return object Data Object
	 */
	function &stringToObject( $data, $process_sections = false )
	{
		static $inistocache;

		if (!isset( $inistocache )) {
			$inistocache = array();
		}

		if (is_string($data))
		{
			$lines = explode("\n", $data);
			$hash = md5($data);
		}
		else
		{
			if (is_array($data)) {
				$lines = $data;
			} else {
				$lines = array ();
			}
			$hash = md5(implode("\n",$lines));
		}

		if(array_key_exists($hash, $inistocache)) {
			return $inistocache[$hash];
		}

		$obj = new stdClass();

		$sec_name = '';
		$unparsed = 0;
		if (!$lines) {
			return $obj;
		}

		foreach ($lines as $line)
		{
			// ignore comments
			if ($line && $line{0} == ';') {
				continue;
			}

			$line = trim($line);

			if ($line == '') {
				continue;
			}

			$lineLen = strlen($line);
			if ($line && $line{0} == '[' && $line{$lineLen-1} == ']')
			{
				$sec_name = substr($line, 1, $lineLen - 2);
				if ($process_sections) {
					$obj-> $sec_name = new stdClass();
				}
			}
			else
			{
				if ($pos = strpos($line, '='))
				{
					$property = trim(substr($line, 0, $pos));

					// property is assumed to be ascii
					if ($property && $property{0} == '"')
					{
						$propLen = strlen( $property );
						if ($property{$propLen-1} == '"') {
							$property = stripcslashes(substr($property, 1, $propLen - 2));
						}
					}
					// AJE: 2006-11-06 Fixes problem where you want leading spaces
					// for some parameters, eg, class suffix
					// $value = trim(substr($line, $pos +1));
					$value = substr($line, $pos +1);

					if (strpos($value, '|') !== false && preg_match('#(?<!\\\)\|#', $value))
					{
						$newlines = explode('\n', $value);
						$values = array();
						foreach($newlines as $newlinekey=>$newline) {

							// Explode the value if it is serialized as an arry of value1|value2|value3
							$parts	= preg_split('/(?<!\\\)\|/', $newline);
							$array	= (strcmp($parts[0], $newline) === 0) ? false : true;
							$parts	= str_replace('\|', '|', $parts);

							foreach ($parts as $key => $value)
							{
								if ($value == 'false') {
									$value = false;
								}
								else if ($value == 'true') {
									$value = true;
								}
								else if ($value && $value{0} == '"')
								{
									$valueLen = strlen( $value );
									if ($value{$valueLen-1} == '"') {
										$value = stripcslashes(substr($value, 1, $valueLen - 2));
									}
								}
								if(!isset($values[$newlinekey])) $values[$newlinekey] = array();
								$values[$newlinekey][] = str_replace('\n', "\n", $value);
							}

							if (!$array) {
								$values[$newlinekey] = $values[$newlinekey][0];
							}
						}

						if ($process_sections)
						{
							if ($sec_name != '') {
								$obj->$sec_name->$property = $values[$newlinekey];
							} else {
								$obj->$property = $values[$newlinekey];
							}
						}
						else
						{
							$obj->$property = $values[$newlinekey];
						}
					}
					else
					{
						//unescape the \|
						$value = str_replace('\|', '|', $value);

						if ($value == 'false') {
							$value = false;
						}
						else if ($value == 'true') {
							$value = true;
						}
						else if ($value && $value{0} == '"')
						{
							$valueLen = strlen( $value );
							if ($value{$valueLen-1} == '"') {
								$value = stripcslashes(substr($value, 1, $valueLen - 2));
							}
						}

						if ($process_sections)
						{
							$value = str_replace('\n', "\n", $value);
							if ($sec_name != '') {
								$obj->$sec_name->$property = $value;
							} else {
								$obj->$property = $value;
							}
						}
						else
						{
							$obj->$property = str_replace('\n', "\n", $value);
						}
					}
				}
				else
				{
					if ($line && $line{0} == ';') {
						continue;
					}
					if ($process_sections)
					{
						$property = '__invalid'.$unparsed ++.'__';
						if ($process_sections)
						{
							if ($sec_name != '') {
								$obj->$sec_name->$property = trim($line);
							} else {
								$obj->$property = trim($line);
							}
						}
						else
						{
							$obj->$property = trim($line);
						}
					}
				}
			}
		}

		$inistocache[$hash] = clone($obj);
		return $obj;
	}

}//end MaianControllerDefault