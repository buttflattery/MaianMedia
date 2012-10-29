<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'inc'.DS.'helper.php');
$uri =& JURI::getInstance();
$db =& JFactory::getDBO();

$db->setQuery("SELECT * FROM #__m15_settings LIMIT 1");
$SETTINGS = $db->loadObject();

if($SETTINGS->select_lang == '1'){

	$changeLang = JRequest::getVar('getlang');

	if(!isset($_SESSION['maian_lang'])){
		$_SESSION['maian_lang']=$SETTINGS->language;
	}

	if (isset($changeLang)){
		$_SESSION['maian_lang']= $changeLang.'.php';
	}

	if($_SESSION['maian_lang'] == ""){
		include_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'lang'.DS.'english.php');
	}else{
		include_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'lang'.DS.$_SESSION['maian_lang']);
	}

	//$this->RENDER_LANG = $this->getLangDisplay();
}else{
	if($SETTINGS->language == ""){
		include_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'lang'.DS.'english.php');
	}else{
		include_once(JPATH_SITE.DS.'components'.DS.'com_maianmedia'.DS.'lang'.DS.$SETTINGS->language);
	}
}



?>

<a id="mm_cart"
	href="<?php echo JRoute::_('index.php?option=com_maianmedia&section=cart&view=viewcart')?>">
	<img
	src="<?php echo $uri->root()?>components/com_maianmedia/<?php echo getTplPath($SETTINGS->homepage_url, 'img')?>/icons/shopping_cart.png" />
	<?php echo JText::_(_msg_public_header2) ?>&nbsp; <font id="cart_count"><?php echo $CART_COUNT ?>
</font>&nbsp;(<i id="cart_total"><?php echo $CART_TOTAL ?> </i>) </a>
