<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'inc'.DS.'helper.php');

class MaianViewHelper extends MaianHelper
{
	function __construct($params, $SETTINGS, $skin)
	{
		parent::__construct($params, $SETTINGS, $skin);
		$this->tplDisplayData = array();
		$this->tplDisplayData['RENDER_LANG'] = $this->getLangDisplay();
	}

	function place_holder(){
		/* this is an example function you can add your own code here */
		/* You can also call code in this function from the browser */
		/* Example url index.php?option=com_maianmedia&view=place_holder*/
	}
}