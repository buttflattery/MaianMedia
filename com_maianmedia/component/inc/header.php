<?php

/*+++++++++++++++++++++++++++++++++++++++++++++

Script: Maian Music v1.2
Written by: David Ian Bennett
E-Mail: support@maianscriptworld.co.uk
Website: http://www.maianscriptworld.co.uk

+++++++++++++++++++++++++++++++++++++++++++++

This File: header.php
Description: Public Header

+++++++++++++++++++++++++++++++++++++++++++++*/

defined('_JEXEC') or die('Restricted access');

$db =& JFactory::getDBO();

$db->setQuery("SELECT * FROM #__m15_settings LIMIT 1");
$SETTINGS = $db->loadObject();

$tplDisplayFront=array();

$tplDisplayFront['TITLE']=$this->title;
$tplDisplayFront['STORE_NAME']=str_replace("{website}",cleanData($this->SETTINGS->website_name), JText::_(_msg_public_header));
$tplDisplayFront['META_DESC']=JText::_(_msg_public_header13);
$tplDisplayFront['META_KEYS']=(isset($this->meta_keys) ? $this->meta_keys : JText::_(_msg_public_header14));
$tplDisplayFront['FEED_URL']=JRoute::_('index.php?option=com_maianmedia&view=rss');
$tplDisplayFront['FORM_LOAD']= (isset($cartOnLoad) ? ' onload="document.form.submit()"' : '');
//$tplDisplayFront['CART_COUNT']= ($this->MM_CART->cartCount()>0 ? '<a href="'.JRoute::_('index.php?option=com_maianmedia&section=cart&view=viewcart').'" class="cart_count_link">'.$this->MM_CART->cartCount().'</a>' : $this->MM_CART->cartCount());
$tplDisplayFront['CART_COUNT']= ($this->MM_CART->cartCount()>0 ? '<b style="font-size: large;">'.$this->MM_CART->cartCount().'</b>' : $this->MM_CART->cartCount());
$tplDisplayFront['CART_TOTAL']= ($this->MM_CART->cartCount()>0 ? '<i>'.get_cur_symbol($this->MM_CART->cartTotal(), $this->SETTINGS->paypal_currency).'</i>':get_cur_symbol($this->MM_CART->cartTotal(), $this->SETTINGS->paypal_currency));
$tplDisplayFront['ITEMS_IN_CART']=JText::_(_msg_public_header2);
$tplDisplayFront['HOMEPAGE']=JText::_(_msg_public_header3);
$tplDisplayFront['ARTISTS']=JText::_(_msg_public_header4);
$tplDisplayFront['CONTACT']=JText::_(_msg_public_header5);
$tplDisplayFront['ABOUT']=JText::_(_msg_public_header6);
$tplDisplayFront['SEARCH']=JText::_(_msg_public_header7);
$tplDisplayFront['LICENCE']= JText::_(_msg_public_header12);
$tplDisplayFront['FREE']= JText::_(_msg_free_download);
$tplDisplayFront['KEYWORDS']=JText::_(_msg_public_header8);
$tplDisplayFront['KEY_VALUE']=isset($_GET['keywords']) ? cleanData($_GET['keywords']) : '';
$tplDisplayFront['PB_JUKEBOX']= JText::_(_msg_public_header9);
$tplDisplayFront['PB_MESSAGE']=JText::_(_msg_public_header10);
$tplDisplayFront['SHOW_NAV'] = $SETTINGS->show_nav;
$tplDisplayFront['SHOW_SEARCH'] = $SETTINGS->search;
$tplDisplayFront['SELECT_LANG'] = $SETTINGS->select_lang;
$tplDisplayFront['H_URL']=JRoute::_('index.php?option=com_maianmedia&view=mostpop');
$tplDisplayFront['A_URL']=JRoute::_('index.php?option=com_maianmedia&view=music');
$tplDisplayFront['C_URL']=JRoute::_('index.php?option=com_maianmedia&view=contact');
$tplDisplayFront['P_URL']=JRoute::_('index.php?option=com_maianmedia&view=about');
$tplDisplayFront['L_URL']=JRoute::_('index.php?option=com_maianmedia&view=licence');
$tplDisplayFront['F_URL']=JRoute::_('index.php?option=com_maianmedia&view=freebie');
$tplDisplayFront['CART_MOD'] = $this->cartMod();
$tplDisplayFront['RENDER_LANG'] = $this->getLangDisplay();
?>
