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
// no direct access
defined('_JEXEC') or die('Restricted access');

class Image{

	// uploading graphic
	function upload($mWidth, $mHeight, $sWidth, $sHeight, $bg, $Quality){
		jimport('joomla.language.helper');
		jimport('joomla.filesystem.file');

		$dest = JPATH_SITE.DS.'images'.DS.'maianmedia';
		$destThumb = JPATH_SITE.DS.'images'.DS.'maianmedia'.DS.'thumbs';

		if(!JFolder::exists($dest)){
			JFolder::create($dest, '0755');
		}

		if(!JFolder::exists($destThumb)){
			JFolder::create($destThumb, '0755');
		}

		//global $mainframe;

		$option	= JRequest::getCmd('option');
		$client	=& JApplicationHelper::getClientInfo(JRequest::getVar('client', '0', '', 'int'));
		// generowanie hash'a umieszczanego na początku nazwy grafiki
		$randomHash = rand(100000, 999999);
		// jeżeli przesyłana grafika jest formatu JPG/PNG/GIF
		if( $_FILES['image']['type'] == 'image/pjpeg' ||
		$_FILES['image']['type'] == 'image/jpg' ||
		$_FILES['image']['type'] == 'image/jpeg' ||
		$_FILES['image']['type'] == 'image/png' ||
		$_FILES['image']['type'] == 'image/gif' ||
		$_FILES['image']['type'] == 'image/x-png' ){
			// usuń z nazwy wszelkie znaki powodujace problemy w linkach
			$new_name = preg_replace('/[^a-zA-Z0-9.]/', '_', $_FILES['image']['name']);

				
			if(!JFile::upload($_FILES['image']['tmp_name'], $dest.DS.$randomHash.$new_name)){
				//$mainframe->redirect('index.php?option='.$option.'&client='.$client->id.'&task=view_group&cids='.$_POST["gid"], JText::_(_ERROR_MOVING_FILE), 'error');
			}
		}
		else{
			// jeżeli grafika nie jest formatu JPG/PNG/GIF zwróć odpowiedni komunikat w formacie JSON
			//$mainframe->redirect('index.php?option='.$option.'&client='.$client->id.'&task=view_group&cids='.$_POST["gid"], JText::_(_INVALID_TYPE), 'error');
		}

		// jeżeli wszystko ok to tworzymi miniaturki - średnią ...
		$this->createThumbnail($dest.DS.$randomHash.$new_name, $randomHash.$new_name,$mWidth,$mHeight,false,$bg,$$mediumThumb, $Quality);
		//$this->createThumbnail($dest.DS.$randomHash.$new_name, $randomHash.$new_name,$sWidth,$sHeight,'s',false,$bg,$smallThumb, $Quality);
		// zwrócenie hasha
		return $randomHash.$new_name;
	}

	/*
		Metoda do tworzenia miniatur
		*/

	function createThumbnail($path, $name, $baseWidth, $baseHeight, $str, $bg, $pathB, $Quality){
		jimport('joomla.language.helper');
		jimport('joomla.filesystem.file');
		//
		$imageToChange = $path; // wysyłany obrazek

		// składowe koloru tła
		$hex_color = strtolower(trim($bg,'#;&Hh'));
		$bg = array_map('hexdec',explode('.',wordwrap($hex_color, ceil(strlen($hex_color)/3),'.',1)));
		$bgColorR = $bg[0];
		$bgColorG = $bg[1];
		$bgColorB = $bg[2];

		// zmienna logiczna określająca czy obrazek ma być rozciągnięty (true) czy dopasowany (false)
		$stretch = ($str == false) ? $_POST['stretch'] : (($str == 1) ? true : false);
		// pobranie informacji o wysłanym obrazku
		$imageData = getimagesize($path);
		// tworzenie pustego szablonu na miniaturkę
		$imageBG = imagecreatetruecolor($baseWidth, $baseHeight);
		// tworzenie koloru i wypełnianie nim szablonu
		$rgb = imagecolorallocate($imageBG, $bgColorR, $bgColorG, $bgColorB);

		if($imageData['mime'] == 'image/jpeg' || $imageData['mime'] == 'image/pjpeg' || $imageData['mime'] == 'image/jpg' || $imageData['mime'] == 'image/gif') imagefill($imageBG, 0, 0, $rgb);

		// ładowanie wysłanego obrazka na podstawie typu MIME
		if($imageData['mime'] == 'image/jpeg' || $imageData['mime'] == 'image/pjpeg' || $imageData['mime'] == 'image/jpg') $imageSource = @imagecreatefromjpeg($path);
		elseif($imageData['mime'] == 'image/gif') $imageSource = @imagecreatefromgif($path);
		else $imageSource = @imagecreatefrompng($path);
		// tutaj może wystąpić błąd gdy obrazek jest za duży - nic nie zostanie wtedy wypisane...

		// ustawienie wymiarów obrazka w zmiennych
		$imageSourceWidth = imagesx($imageSource);
		$imageSourceHeight = imagesy($imageSource);

		// jeżeli nie wybrano rozciągania obrazka
		if(!$stretch){
			// oblicz ratio dla pierwszego skalowania
			$ratio = ($imageSourceWidth > $imageSourceHeight) ? $baseWidth/$imageSourceWidth : $baseHeight/$imageSourceHeight;
			// oblicz nowe wymiary obrazka
			$imageSourceNWidth = $imageSourceWidth * $ratio;
			$imageSourceNHeight = $imageSourceHeight * $ratio;
			// obliczanie ratio dla drugiego skalowania
			if($baseWidth > $baseHeight){
				if($imageSourceNHeight > $baseHeight){
					$ratio2 = $baseHeight / $imageSourceNHeight;
					$imageSourceNHeight *= $ratio2;
					$imageSourceNWidth *= $ratio2;
				}
			}else{
				if($imageSourceNWidth > $baseWidth){
					$ratio2 = $baseWidth / $imageSourceNWidth;
					$imageSourceNHeight *= $ratio2;
					$imageSourceNWidth *= $ratio2;
				}
			}
			// ustalanie pozycji wstawienia minitury
			$base_x = floor(($baseWidth - $imageSourceNWidth) / 2);
			$base_y = floor(($baseHeight - $imageSourceNHeight) / 2);
		}
		else{ // gdy uruchomiono rozciąganie obrazka
			$imageSourceNWidth = $baseWidth;
			$imageSourceNHeight = $baseHeight;
			$base_x = 0;
			$base_y = 0;
		}
			
		if(!($imageData['mime'] == 'image/jpeg' || $imageData['mime'] == 'image/pjpeg' || $imageData['mime'] == 'image/jpg' || $imageData['mime'] == 'image/gif')){
			imagealphablending($imageBG, false);
			imagesavealpha($imageBG, true);
		}

		// kopiowanie grafiki na bazie obliczonych/wygenerowanych parametrów
		imagecopyresampled($imageBG, $imageSource, $base_x,$base_y, 0, 0, $imageSourceNWidth, $imageSourceNHeight, $imageSourceWidth, $imageSourceHeight);

		// zapisanie obrazka w zalezności od typu MIME
		if($imageData['mime'] == 'image/jpeg' || $imageData['mime'] == 'image/pjpeg' || $imageData['mime'] == 'image/jpg') imagejpeg($imageBG,$pathB.DS.'thumbs'.DS.$name, $Quality);
		elseif($imageData['mime'] == 'image/gif') imagegif($imageBG, $pathB.'thumbs'.DS.$name);
		else imagepng($imageBG, $pathB.'thumbs'.DS.$name/*, $Quality*/);
		// zwrócenie wartości 1 świadczącej o powodzeniu operacji
		return ($stretch) ? 1 : 0;
	}
}

?>