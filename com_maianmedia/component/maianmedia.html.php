<?php
/*
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
 * This version may have been modified pursuant to the GNU General Public License,
 * and as distributed it includes or is derivative of works licensed under the
 * GNU General Public License or other free or open source software licenses.
 * Changes must attribute the work in the manner specified by the author or licensor
 * (but not in any way that suggests that they endorse you or your use of the work).
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class HTML_maiainFront {

	function show_MainPage($tplDisplayHome){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'home.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_MusicPage($tplDisplayData){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'music.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_CatPage($tplDisplayData){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'categories.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_ContactPage($tplDisplayData){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'contact.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_LicencePage($tplDisplayData){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'licence.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_AboutPage($tplDisplayData){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'about.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_SearchPage($tplDisplayData){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'search.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_AlbumPage($tplDisplayData){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'album.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_CartPage($tplDisplayData){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'cart.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_CheckoutPage($tplDisplayData){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		//include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'paypal'.DS.'checkout.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		//include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_ThanksPage($tplDisplayData){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'paypal'.DS.'thanks.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}


	function show_CancelPage($tplDisplayData){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'paypal'.DS.'cancel.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_InvalidPage($tplDisplayData){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'paypal'.DS.'error.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_ErrorPage($tplDisplayData){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'paypal'.DS.'error.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_FreePage($tplDisplayData){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'free.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_SinglePage($tplDisplayData){

		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'free.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_DownloadPage($tplDisplayData){
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'header.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'header.tpl.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'paypal'.DS.'download.tpl.php');
		include_once(JPATH_COMPONENT.DS.'inc'.DS.'footer.php');
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'footer.tpl.php');
	}

	function show_DownloadItemPage($tplDisplayData){
		echo '<link href="components/com_maianmedia/'.getTplPath($this->skin_name, 'css').'/mm_stylesheet.css" rel="stylesheet" type="text/css" />';
		include_once(JPATH_COMPONENT.DS.getTplPath($this->skin_name).DS.'pages'.DS.'download_item.tpl.php');
	}

	function show_RSS($rss_feed){

		echo (get_magic_quotes_gpc() ? stripslashes(trim($rss_feed)) : trim($rss_feed));
		exit;
	}

}
?>