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

		return '<span id="for_dummies">'.JText::_(_msg_cart10).'</span>
		
		<img id="cart_icon" src="'.$uri->root().'components/com_maianmedia/'.getTplPath($this->skin_name, 'img').'/icons/shopping_cart.png" /> 
			<span id="cart_items">'.JText::_(_msg_public_header2).'&nbsp;
					<font id="cart_count">'.$items.'</font>&nbsp;(<span id="cart_total">'.$total.'</span>)';

	}
}