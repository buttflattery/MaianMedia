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

$SETTINGS = &$this->get('Data');

$lines = explode("\n", trim($SETTINGS->extra_params));

for ($i=0; $i<count($lines);$i++){
	list($key,$val) = explode("=", $lines[$i]);
	$params [trim(urldecode($key))] = trim(urldecode($val));
}

// Load language files..
$lang = opendir(JPATH_COMPONENT_SITE.DS.'lang'.DS);
$langs = array();
while ($READ = readdir($lang))
{
	if ($READ != "." && $READ != ".." && $READ != "index.html" && $READ != ".svn") {
		$langs[$READ]= $READ;
		//echo '<option'.(($READ == $SETTINGS->language) ? ' selected' : '').'>'.substr($READ, 0, strpos($READ, '.')).'</option>'."\n";
	}
}

closedir($lang);

$skins = array();
$tpl = opendir(JPATH_COMPONENT_SITE.DS.'templates'.DS);

while (false !== ($file = readdir($tpl))) {
	if ($file != "." && $file != ".." && $file != ".svn") {

		if (is_dir(JPATH_COMPONENT_SITE.DS.'templates'.DS.$file)) {
			// found a directory, do something with it?
			$skins[$file]= $file;
		}
	}
}

closedir($tpl);

$popP = "";
$musicP = "";
if ($SETTINGS->default_page == 0) {
	$popP = 'checked';
}
else if ($SETTINGS->default_page == 1) {
	$musicP = 'checked';
}

$radioBox = '<checked>';
$uri =& JURI::getInstance();
JHTML::_('behavior.modal', 'a.modal');

$classname = $SETTINGS->player;
$XMLFile = JPATH_COMPONENT_SITE.DS.'players'.DS.'dewplayer'.DS.'playerDetails.xml';
include_once(JPATH_COMPONENT_SITE.DS.'players'.DS.'maianplayer.php');
	
if(is_file(JPATH_COMPONENT_SITE.DS.'players'.DS.$SETTINGS->player.DS.'player.php')){
	include_once(JPATH_COMPONENT_SITE.DS.'players'.DS.$SETTINGS->player.DS.'player.php');
	$XMLFile = JPATH_COMPONENT_SITE.DS.'players'.DS.$SETTINGS->player.DS.'playerDetails.xml';
}else{
	include_once(JPATH_COMPONENT_SITE.DS.'players'.DS.'dewplayer'.DS.'player.php');
	$classname = "dewplayer";
}
	
$player = new $classname();
	

?>

<form id="adminForm" action="index.php" method="post" name="adminForm">
	<p>
	<?php echo MaianText::_( _msg_settings); ?>
	</p>
	<fieldset style="background-color: #FFF" class="adminform">
		<legend>
		<?php echo MaianText::_( _msg_settings2 ); ?>
		</legend>
		<table class="admintable">
			<tr>
				<td width="100" align="right" class="key"><label for="greeting"> <?php echo MaianText::_( _msg_settings41 ); ?>:
				</label></td>
				<td align="left" style="padding: 5px">
					<fieldset class="radio">
						<input id="show_mostpop" class="styled" type="radio"
							name="default_page" value="0" <?php echo $popP; ?>><label
							for="show_mostpop"><?php echo MaianText::_(_msg_settings42); ?> </label>
						<input id="show_music" class="styled" type="radio"
							name="default_page" value="1" <?php echo $musicP; ?>><label
							for="show_music"><?php echo MaianText::_(_msg_settings43); ?> </label>
							<?php echo toolTip(_msg_javascript,_msg_javascript39); ?>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings3); ?>
				</td>
				<td align="left" style="padding: 5px" width="70%"><input
					class="formBox" type="text" name="website_name" maxlength="250"
					size="30" value="<?php echo cleanData($SETTINGS->website_name); ?>" />
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings4); ?>
				</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="email_address" maxlength="250" size="30"
					value="<?php echo cleanData($SETTINGS->email_address); ?>" /></td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_( _msg_settings7); ?>
				</td>
				<td align="left" style="padding: 5px"><select name="language">
				<?php
					
				foreach ($langs AS $key => $value) {
					echo '<option'.(($key == $SETTINGS->language) ? ' selected' : '').'>'.substr($key, 0, strpos($key, '.')).'</option>'."\n";
				}

				?>
				</select></td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_frontpage_lang); ?>
				</td>
				<td align="left" style="padding: 5px">
					<fieldset class="radio">
						<input id="select_lang_yes" class="styled" type="radio"
							name="select_lang" value="1"
							<?php echo ($SETTINGS->select_lang == '1'? ' checked' : ''); ?>>
						<label for="select_lang_yes"><?php echo MaianText::_(_msg_script2); ?>
						</label> <input id="select_lang_no" class="styled" type="radio"
							name="select_lang" value="0"
							<?php echo ($SETTINGS->select_lang == '0' || $SETTINGS->select_lang == ''? ' checked' : ''); ?>>
						<label for="select_lang_no"><?php echo MaianText::_(_msg_script3); ?>
						</label>

						<?php echo toolTip(_msg_javascript,_msg_javascript_lang); ?>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_('Template'); ?>
				</td>
				<td align="left" style="padding: 5px"><select
					onchange="setTpl(this.value);" name="homepage_url">
					<?php

					foreach ($skins AS $key => $value) {
						echo '<option value="'.$key.'" style="padding-left:3px"'.($SETTINGS->homepage_url==$key ? ' selected' : '').'>'.$value.'</option>'."\n";
					}

					?>
				</select><a style="padding-left: 5px" class="modal" id="tplParams"
					href="index.php?option=com_maianmedia&controller=settings&format=raw&task=tplParams&skin=<?php echo ($SETTINGS->homepage_url ? $SETTINGS->homepage_url : 'classic')?>"
					rel="{handler: 'iframe', size: {x: 570, y: 400}}"
					title="<?php echo MaianText::_(_msg_header3)?>"><?php echo MaianText::_( _msg_header3) ?>
				</a></td>
			</tr>

			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_( _msg_settings26); ?>
				</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="rssfeeds" maxlength="3" size="30"
					style="width: 10%"
					value="<?php echo cleanData($SETTINGS->rssfeeds); ?>"> <?php echo toolTip(_msg_javascript,_msg_javascript36); ?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_( _msg_settings27); ?>
				</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="poplinks" maxlength="3" size="30"
					style="width: 10%"
					value="<?php echo cleanData($SETTINGS->poplinks); ?>"> <?php echo toolTip(_msg_javascript,_msg_javascript37); ?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings46); ?>
				</td>
				<td align="left" style="padding: 5px"><input type="text" name="days"
					maxlength="3" size="30" style="width: 10%"
					value="<?php echo cleanData($SETTINGS->days); ?>"> <?php echo toolTip(_msg_javascript,_msg_javascript41); ?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings47); ?>
				</td>
				<td align="left" style="padding: 5px">
					<fieldset class="radio">
						<input id="ajax_yes" class="styled" type="radio" name="ajax"
							value="1"
							<?php echo ($SETTINGS->ajax == '1'? ' checked' : ''); ?>> <label
							for="ajax_yes"><?php echo MaianText::_(_msg_script2); ?> </label> <input
							id="select_lang_no" class="styled" type="radio" name="ajax"
							value="0"
							<?php echo ($SETTINGS->ajax == '0' || $SETTINGS->ajax == ''? ' checked' : ''); ?>>
						<label for="select_lang_no"><?php echo MaianText::_(_msg_script3); ?>
						</label>
						<?php echo toolTip(_msg_javascript,_msg_javascript40); ?>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings8); ?>
				</td>
				<td align="left" style="padding: 5px">
					<fieldset class="radio">
						<input id="enable_captcha_yes" class="styled" type="radio"
							name="enable_captcha" value="1"
							<?php echo ($SETTINGS->enable_captcha == '1'? ' checked' : ''); ?>>
						<label for="enable_captcha_yes"><?php echo MaianText::_(_msg_script2); ?>
						</label> <input id="enable_captcha_no" class="styled" type="radio"
							name="enable_captcha" value="0"
							<?php echo ($SETTINGS->enable_captcha == '0' || $SETTINGS->enable_captcha == ''? ' checked' : ''); ?>>
						<label for="enable_captcha_no"><?php echo MaianText::_(_msg_script3); ?>
						</label>
						<?php echo toolTip(_msg_javascript,_msg_javascript3); ?>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings48); ?>
				</td>
				<td align="left" style="padding: 5px">
					<fieldset class="radio">
						<input id="search_yes" class="styled" type="radio" name="search"
							value="1"
							<?php echo ($SETTINGS->search == '1'? ' checked' : ''); ?>> <label
							for="search_yes"><?php echo MaianText::_(_msg_script2); ?> </label> <input
							id="search_no" class="styled" type="radio" name="search"
							value="0"
							<?php echo ($SETTINGS->search == '0' || $SETTINGS->search == ''? ' checked' : ''); ?>>
						<label for="search_no"><?php echo MaianText::_(_msg_script3); ?> </label>
						<?php echo toolTip(_msg_javascript,_msg_javascript44); ?>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings52); ?>
				</td>
				<td align="left" style="padding: 5px">
					<fieldset class="radio">
						<input id="show_nav_yes" class="styled" type="radio"
							name="show_nav" value="1"
							<?php echo ($SETTINGS->show_nav == '1'? ' checked' : ''); ?>> <label
							id="show_nav_yes"><?php echo MaianText::_(_msg_script2); ?> </label>
						<input id="show_nav_no" class="styled" type="radio"
							name="show_nav" value="0"
							<?php echo ($SETTINGS->show_nav == '0' || $SETTINGS->show_nav == '' ? ' checked' : ''); ?>>
						<label id="show_nav_no"><?php echo MaianText::_(_msg_script3); ?> </label>
						<?php echo toolTip(_msg_javascript,_msg_javascript45); ?>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings53); ?>
				</td>
				<td align="left" style="padding: 5px">
					<fieldset class="radio">
						<input id="enlargeit_yes" class="styled" type="radio"
							name="enlargeit" value="1"
							<?php echo ($SETTINGS->enlargeit == '1'? ' checked' : ''); ?>> <label
							id="enlargeit_yes"><?php echo MaianText::_(_msg_script2); ?> </label>
						<input id="enlargeit_no" class="styled" type="radio"
							name="enlargeit" value="0"
							<?php echo ($SETTINGS->enlargeit == '0' || $SETTINGS->enlargeit == ''? ' checked' : ''); ?>>
						<label id="enlargeit_no"><?php echo MaianText::_(_msg_script3); ?> </label>
						<?php echo toolTip(_msg_javascript,_msg_javascript46); ?>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_continue); ?>
				</td>
				<td align="left" style="padding: 5px">
					<fieldset class="radio">
						<input id="shopbutton_yes" type="radio" class="styled"
							name="shopbutton" value="1"
							<?php echo ($SETTINGS->shopbutton == '1'? ' checked' : ''); ?>> <label
							for="shopbutton_yes"><?php echo MaianText::_(_msg_script2); ?> </label>
						<input id="shopbutton_no" class="styled" type="radio"
							name="shopbutton" value="0"
							<?php echo ($SETTINGS->shopbutton == '0' || $SETTINGS->shopbutton == '' ? ' checked' : ''); ?>>
						<label for="shopbutton_no"><?php echo MaianText::_(_msg_script3); ?> </label>
						<?php echo toolTip(_msg_javascript,_msg_javascript_continue); ?>
					</fieldset>
				</td>
			</tr>
		</table>
	</fieldset>

	<fieldset style="background-color: #FFF" class="adminform">
		<legend>
		<?php echo MaianText::_( _msg_settings38 ); ?>
		</legend>
		<table class="admintable">
			<tr>

				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings39); ?>
				</td>

				<td align="left" style="padding: 5px"><select STYLE="width: 230px"
					id="player" name="player" onChange="change_player(this.value)">
					<?php
					foreach ($this->getPlayers() AS $key => $value) {
						echo '<option value="'.$key.'" style="padding-left:3px"'.($SETTINGS->player==$key ? ' selected' : '').'>'.$value.'</option>'."\n";
					}
					?>
				</select>
				</td>
				<td><?php echo '<div id="flash_player"><!-- Begin Flash Player -->'.$player->getplayer("test.mp3").'<!-- End Flash Player --></div>';?>
				</td>
				<td><a href="javascript: void(0)"
					onClick="refresh_player(document.getElementById('player').value)"><img
						src="<?php echo $uri->base();?>components/com_maianmedia/images/refresh.png" />
				</a>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_clip); ?>
				</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="clip" maxlength="2" size="30" style="width: 10%"
					value="<?php echo cleanData($SETTINGS->clip != 0 ? $SETTINGS->clip: 15); ?>">
					<?php echo toolTip(_msg_javascript,_msg_javascript_clip); ?></td>
			</tr>
		</table>
		<div id="player_settings">
			<div id="settings_player">
			<?php
			echo $this->renderSettings($XMLFile, $SETTINGS->player_params);
			?>
			</div>
		</div>
	</fieldset>

	<fieldset style="background-color: #FFF" class="adminform">
		<legend>
		<?php echo MaianText::_( _msg_settings9 ); ?>
		</legend>
		<table class="admintable">
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings6); ?>
				</td>
				<td align="left" style="padding: 5px" width="70%"><b><?php echo JPATH_ROOT; ?>
				</b></td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings10); ?>
				</td>
				<td align="left" style="padding: 5px" width="70%"><input
					class="formBox" type="text" name="mp3_path" maxlength="250"
					size="30" value="<?php echo MaianText::_($SETTINGS->mp3_path); ?>"> <?php echo toolTip(_msg_javascript,_msg_javascript4); ?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings11); ?>
				</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" onkeypress="display_url()" name="preview_path"
					maxlength="250" size="30"
					value="<?php echo MaianText::_($SETTINGS->preview_path); ?>"> <?php echo toolTip(_msg_javascript,_msg_javascript5); ?>
					<?php echo MaianText::_(_msg_append); ?> <input type="checkbox"
					onchange="toggleLayer('site_div')" name="append_url" " value="1"
					<?php echo ($SETTINGS->append_url ? ' checked' : ''); ?>> <?php echo toolTip(_msg_javascript,_msg_javascript47); ?>
					<div id="site_div">
					<?php echo ($SETTINGS->append_url ? substr($uri->root(), 0, strlen($uri->root())-1).$SETTINGS->preview_path : ''); ?>
					</div> <input type="hidden" name="site_url"
					value="<?php echo substr($uri->root(), 0, strlen($uri->root())-1);?>">
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings25); ?>
				</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="page_expiry" maxlength="2" size="30"
					style="width: 10%"
					value="<?php echo cleanData($SETTINGS->page_expiry); ?>"> <?php echo toolTip(_msg_javascript,_msg_javascript24); ?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings31); ?>
				</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="download_expiry" maxlength="2" size="30"
					style="width: 10%"
					value="<?php echo cleanData($SETTINGS->download_expiry); ?>"> <?php echo toolTip(_msg_javascript,_msg_javascript30); ?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_('Zip '._msg_sales20); ?>
				</td>
				<td align="left" style="padding: 5px">
					<fieldset class="radio">
						<input id="use_zip_yes" class="styled" type="radio" name="use_zip"
							value="1"
							<?php echo ($SETTINGS->use_zip == '1'? ' checked' : ''); ?>> <label
							for="use_zip_yes"><?php echo MaianText::_(_msg_script2); ?> </label>
						<input id="use_zip_no" class="styled" type="radio" name="use_zip"
							value="0"
							<?php echo ($SETTINGS->use_zip == '0' || $SETTINGS->use_zip == ''? ' checked' : ''); ?>>
						<label for="use_zip_no"><?php echo MaianText::_(_msg_script3); ?> </label>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_('Zip '._msg_public_header2); ?>
				</td>
				<td align="left" style="padding: 5px">
					<fieldset class="radio">
						<input id="use_zip_cart_yes" class="styled" type="radio"
							name="use_zip_cart" value="1"
							<?php echo ($SETTINGS->use_zip_cart == '1'? ' checked' : ''); ?>>
						<label for="use_zip_cart_yes"><?php echo MaianText::_(_msg_script2); ?>
						</label> <input id="use_zip_cart_no" class="styled" type="radio"
							name="use_zip_cart" value="0"
							<?php echo ($SETTINGS->use_zip_cart == '0' || $SETTINGS->use_zip_cart == ''? ' checked' : ''); ?>>
						<label for="use_zip_cart_no"><?php echo MaianText::_(_msg_script3); ?>
						</label>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_lightbox); ?>
				</td>
				<td align="left" style="padding: 5px">
					<fieldset class="radio">
						<input id="hide_lightbox_yes" class="styled" type="radio"
							name="hide_lightbox" value="1"
							<?php echo ($SETTINGS->hide_lightbox == '1'? ' checked' : ''); ?>>
						<label for="hide_lightbox_yes"><?php echo MaianText::_(_msg_script2); ?>
						</label> <input id="hide_lightbox_no" class="styled" type="radio"
							name="hide_lightbox" value="0"
							<?php echo ($SETTINGS->hide_lightbox == '0' || $SETTINGS->hide_lightbox == ''? ' checked' : ''); ?>>
						<label for="hide_lightbox_no"><?php echo MaianText::_(_msg_script3); ?>
						</label>
						<?php echo toolTip(_msg_javascript,_msg_lightbox_javascript); ?>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings51); ?>
				</td>
				<td align="left" style="padding: 5px">
					<fieldset class="radio">
						<input id="show_download_yes" class="styled" type="radio"
							name="show_download" value="1"
							<?php echo ($SETTINGS->show_download == '1'? ' checked' : ''); ?>>
						<label for="show_download_yes"><?php echo MaianText::_(_msg_script2); ?>
						</label> <input id="show_download_no" class="styled" type="radio"
							name="show_download" value="0"
							<?php echo ($SETTINGS->show_download == '0' || $SETTINGS->show_download == ''? ' checked' : ''); ?>>
						<label for="show_download_yes"><?php echo MaianText::_(_msg_script3); ?>
						</label>
						<?php echo toolTip(_msg_javascript,_msg_javascript_show_link); ?>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings30); ?>
				</td>
				<td align="left" style="padding: 5px"><input type="checkbox"
					name="reset" value="1"> <?php echo toolTip(_msg_javascript,_msg_javascript29); ?>
				</td>
			</tr>
		</table>
	</fieldset>

	<fieldset style="background-color: #FFF" class="adminform">
		<legend>
		<?php echo MaianText::_( _msg_settings14 ); ?>
		</legend>
		<table class="admintable">
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_( _msg_settings21); ?>
				</td>
				<td align="left" style="padding: 5px" width="70%"><select
					name="paypal_currency">
					<?php
					/* @todo This is from orginal script.  This should read from an xml file*/
					include(JPATH_COMPONENT.DS.'common'.DS.'currencies.inc.php');

					foreach ($currencies AS $key => $value) {
						echo '<option value="'.$key.'" style="padding-left:3px"'.($SETTINGS->paypal_currency==$key ? ' selected' : '').'>'.$value.'</option>'."\n";
					}
					?>
				</select> <?php echo toolTip(_msg_javascript,_msg_javascript11); ?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_( _msg_settings20); ?>
				</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="paypal_email" maxlength="250" size="30"
					value="<?php echo cleanData($SETTINGS->paypal_email); ?>"> <?php echo toolTip(_msg_javascript,_msg_javascript8); ?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings40); ?>
				</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="pdt" maxlength="250" size="90"
					value="<?php echo cleanData($SETTINGS->pdt); ?>"> <?php echo toolTip(_msg_javascript,_msg_javascript38); ?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_( _msg_settings49); ?>
				</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="paypal_email2" maxlength="250" size="30"
					value="<?php echo cleanData($SETTINGS->paypal_email2); ?>"> <?php echo toolTip(_msg_javascript,_msg_javascript42); ?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings40); ?>
				</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="pdt2" maxlength="250" size="90"
					value="<?php echo cleanData($SETTINGS->pdt2); ?>"> <?php echo toolTip(_msg_javascript,_msg_javascript38); ?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_( _msg_settings19); ?>
				</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="page_style" maxlength="250" size="30"
					value="<?php echo cleanData($SETTINGS->page_style); ?>"> <?php echo toolTip(_msg_javascript,_msg_javascript9); ?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings50); ?>
				</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="minpay" maxlength="2" size="30"
					style="width: 10%"
					value="<?php echo cleanData($SETTINGS->minpay); ?>"> <?php echo toolTip(_msg_javascript,_msg_javascript43); ?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_( _msg_settings16); ?>
				</td>
				<td align="left" style="padding: 5px">
					<fieldset class="radio">
						<input id="paypal_mode_yes" type="radio" class="styled"
							name="paypal_mode" value="1"
							<?php echo ($SETTINGS->paypal_mode == '1'? ' checked' : ''); ?>>
						<label for="paypal_mode_yes"><?php echo MaianText::_(_msg_script2); ?>
						</label> <input id="paypal_mode_no" type="radio" class="styled"
							name="paypal_mode" value="0"
							<?php echo ($SETTINGS->paypal_mode == '0' || $SETTINGS->paypal_mode == ''? ' checked' : ''); ?>>
						<label for="paypal_mode_yes"><?php echo MaianText::_(_msg_script3); ?>
						</label>
						<?php echo toolTip(_msg_javascript,_msg_javascript7); ?>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_( _msg_settings18); ?>
				</td>
				<td align="left" style="padding: 5px">
					<fieldset class="radio">
						<input id="log_errors_yes" type="radio" class="styled"
							name="log_errors" value="1"
							<?php echo ($SETTINGS->log_errors == '1'? ' checked' : ''); ?>> <label
							for="log_errors_yes"><?php echo MaianText::_(_msg_script2); ?> </label>
						<input id="log_errors_no" type="radio" class="styled"
							name="log_errors" value="0"
							<?php echo ($SETTINGS->log_errors == '0' || $SETTINGS->log_errors == ''? ' checked' : ''); ?>>
						<label for="log_errors_no"><?php echo MaianText::_(_msg_script3); ?> </label>
						<?php echo toolTip(_msg_javascript,_msg_javascript10); ?>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(_msg_settings28); ?>
				</td>
				<td align="left" style="padding: 5px">
					<fieldset class="radio">
						<input id="ssl_enabled_yes" type="radio" class="styled"
							name="ssl_enabled" value="1"
							<?php echo ($SETTINGS->ssl_enabled == '1'? ' checked' : ''); ?>>
						<label for="ssl_enabled_yes"><?php echo MaianText::_(_msg_script2); ?>
						</label> <input id="ssl_enabled_no" type="radio" class="styled"
							name="ssl_enabled" value="0"
							<?php echo ($SETTINGS->ssl_enabled == '0' || $SETTINGS->ssl_enabled == ''? ' checked' : ''); ?>>
						<label for="ssl_enabled_no"><?php echo MaianText::_(_msg_script3); ?>
						</label>
						<?php echo toolTip(_msg_javascript,_msg_javascript35); ?>
					</fieldset>
				</td>
			</tr>
		</table>
	</fieldset>

	<fieldset style="background-color: #FFF" class="adminform">
		<legend>
		<?php echo MaianText::_( _msg_settings33); ?>
		</legend>
		<table class="admintable">
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(  _msg_settings34); ?>:</td>
				<td align="left" width="70%" style="padding: 5px">
					<fieldset class="radio">
						<input id="smtp_yes" class="styled" type="radio" name="smtp"
							value="1"
							<?php echo ($SETTINGS->smtp == '1'? ' checked' : ''); ?>> <label
							for="stmp_yes"><?php echo MaianText::_(_msg_script2); ?> </label> <input
							id="smtp_no" class="styled" type="radio" name="smtp" value="0"
							<?php echo ($SETTINGS->smtp == '0' || $SETTINGS->smtp == '' ? ' checked' : ''); ?>>
						<label for="stmp_no"><?php echo MaianText::_(_msg_script3); ?> </label>
					</fieldset> <?php echo toolTip(_msg_javascript,_msg_javascript32); ?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(  _msg_settings35); ?>:</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="smtp_host" size="20"
					value="<?php echo $SETTINGS->smtp_host; ?>"></td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(  _msg_settings36); ?>:</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="smtp_user" size="20"
					value="<?php echo $SETTINGS->smtp_user; ?>"></td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_( _msg_settings37); ?>:</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="smtp_pass" size="20"
					value="<?php echo $SETTINGS->smtp_pass; ?>"></td>
			</tr>
			<tr>
				<td width="100" align="right" class="key"><?php echo MaianText::_(  _msg_settings29); ?>:</td>
				<td align="left" style="padding: 5px"><input class="formBox"
					type="text" name="smtp_port" size="20"
					value="<?php echo $SETTINGS->smtp_port; ?>" style="width: 10%"></td>
			</tr>
		</table>
	</fieldset>

	<input type="hidden" name="id" value="1" /> <input type="hidden"
		name="option" value="com_maianmedia" /> <input type="hidden"
		name="task" value="" /> <input type="hidden" name="boxchecked"
		value="0" /> <input type="hidden" name="controller" value="settings" />

</form>
