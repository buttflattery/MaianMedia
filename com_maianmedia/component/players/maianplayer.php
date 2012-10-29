<?php defined( '_JEXEC' ) or die( 'Restricted access' );

class MaianPlayer extends JObject
{
	/**
	 * The xml params element
	 *
	 * @access	private
	 * @var		object
	 * @since	1.5
	 */
	var $_xml = null;

	var $_SETTINGS;
	var $skin_name;
	var $params;
	var $_log;
	var $uri;

	function __construct()
	{
		$this->uri =& JURI::getInstance();
		$db = & JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_settings");

		$this->_SETTINGS = $db->loadObject();

		$this->skin_name = $this->_SETTINGS->homepage_url;

		$this->params = new stdClass();

		$XMLFile = JPATH_COMPONENT_SITE.DS.'players'.DS.get_class($this).DS.'playerDetails.xml';

		$xml = & JFactory::getXMLParser('Simple');

		if ($xml->loadFile($XMLFile))
		{
			if ($params = & $xml->document->params) {
				foreach ($params as $param)
				{
					$this->setXML( $param );
					$result = true;
				}
			}
		}

		$array = array();

		$params = $this->getParams('params', '_default');

		foreach ($params as $param){

			$key = trim(urldecode($param[5]));
			$val = trim(urldecode($param[4]));
			$array[$key] = $val;
		}

		if(trim($this->_SETTINGS->player_params) != ''){
			$lines = explode("\n", trim($this->_SETTINGS->player_params));
			for ($i=0; $i<count($lines);$i++){
				list($key,$val) = explode("=", $lines[$i]);
				$key = trim(urldecode($key));
				$array[$key] = trim(urldecode($val));
			}
		}

		$this->params = (object) $array;

		if($this->_SETTINGS->log_errors == '1'){
			$this->_log = new MaianLogger(JPATH_COMPONENT_SITE.DS.'log', MaianLogger::DEBUG);
		}else{
			$this->_log = new MaianLogger(JPATH_COMPONENT_SITE.DS.'log', MaianLogger::OFF);
		}


		parent::__construct();
	}


	/**
	 * Render a parameter type
	 *
	 * @param	object	A param tag node
	 * @param	string	The control name
	 * @return	array	Any array of the label, the form element and the tooltip
	 * @since	1.5
	 */
	function getParam(&$node, $control_name = 'params', $group = '_default')
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
			$result[1] = JText::_('Element not defined for type').' = '.$type;
			$result[5] = $result[0];
			return $result;
		}

		//get value
		$value = $this->get($node->attributes('name'), $node->attributes('default'), $group);

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
	function getParams($name = 'params', $group = '_default')
	{
		if (!isset($this->_xml[$group])) {
			return array();
		}
		$results = array();
		foreach ($this->_xml[$group]->children() as $param)  {
			$results[] = $this->getParam($param, $name);
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

	function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='')
	{
		$output = '<label id="'.$control_name.$name.'-lbl" for="'.$control_name.$name.'"';
		if ($description) {
			$output .= ' class="hasTip" title="'.JText::_($label).'::'.JText::_($description).'">';
		} else {
			$output .= '>';
		}
		$output .= JText::_( $label ).'</label>';

		return $output;
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

	function getTrackInfo($id){

		$db =&JFactory::getDBO();
		// Get tracks..
		$id=intval($id);
		$db->setQuery("SELECT * FROM #__m15_tracks WHERE id = $id") ;

		return $db->loadObject();
	}

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

}