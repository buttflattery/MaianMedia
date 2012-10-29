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


	function displayCartIcon($items, $total){
		$uri =& JURI::getInstance();

		return
		'<span id="cart_count">'.$items.'</span>&nbsp;<span id="items-cart">	
		'.JText::_(_msg_public_header2).'</span>&nbsp; <span id="cart_total">| Total: '.$total.' |</span>	
		 <span id="for_dummies">'.JText::_(_msg_cart10).'</span>';
	}


}