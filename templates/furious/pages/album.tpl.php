<?php JHTML::_('behavior.mootools');?>

<?php if(isset($tplDisplayData['DETECT_COOKIES']) && $tplDisplayData['DETECT_COOKIES'] == '1'){ ?>
<div class="generic_dialog" id="fb-modal">
	<div class="generic_dialog_popup" style="top: 125px;">
		<table class="pop_dialog_table" id="pop_dialog_table"
			style="width: 532px;">
			<tbody>
				<tr>
					<td class="pop_topleft" />
					<td class="pop_border pop_top" />
					<td class="pop_topright" />
				</tr>

				<tr>
					<td class="pop_border pop_side" />
					<td id="pop_content" class="pop_content">
						<h2 class="dialog_title">
							<span>Cookies are disabled</span>
						</h2>
						<div class="dialog_content">
							<div class="dialog_summary">In order to use this system you must
								enable cookies.</div>

							<div class="dialog_buttons">
								<input type="button" value="Close" name="close"
									class="inputsubmit" id="fb-close" />

							</div>
						</div>
					</td>
					<td class="pop_border pop_side" />
				</tr>
				<tr>
					<td class="pop_bottomleft" />
					<td class="pop_border pop_bottom" />
					<td class="pop_bottomright" />

				</tr>
			</tbody>
		</table>
	</div>
</div>

<SCRIPT LANGUAGE="JAVASCRIPT">
 <!--
   var tmpcookie = new Date();
   chkcookie = (tmpcookie.getTime() + '');
   document.cookie = "chkcookie=" + chkcookie + "; path=/";
    if (document.cookie.indexOf(chkcookie,0) < 0) {
    	var ele = document.getElementById("fb-modal");
		ele.style.display = "block";
    	window.addEvent('domready',function() {
    		$('fb-close').addEvent('click',function() {
    			var ele = document.getElementById("fb-modal");
    			ele.style.display = "none";
    		});
    	});
    }
 //-->
</SCRIPT>
<?php } ?>

<div id="mm_album_info">
	<div id="album_image">
	<?php echo $tplDisplayData['IMG_INLINE_STYLE']; ?>
	</div>
	<h2 class="title">
	<?php echo $tplDisplayData['NAME']; ?>
	</h2>
	<p id="mm_artist">
	<?php echo $tplDisplayData['ARTIST']; ?>
	</p>
	<div id="mm_message">
	<?php echo $tplDisplayData['ALBUM_MESSAGE']; ?>
	</div>
	<?php echo $tplDisplayData['CHILDREN']; ?>
</div>

	<?php echo ($this->SETTINGS->ajax == '1' ? "<!--":"<")?>
form method="post" action="
	<?php echo $tplDisplayData['FORM_ACTION']; ?>
"
	<?php echo ($this->SETTINGS->ajax == '1' ? "-->":">")?>
<input type="hidden"
	name="process" value="1" />
<input
	type="hidden" name="album"
	value="<?php echo $tplDisplayData['ALBUM_ID']; ?>" />
<div id="album_name">
	<div id="album_name_left">

	<?php if($tplDisplayData['ALBUM_COST'] > 0){ ?>

		[ <a href="<?php echo $tplDisplayData['ADD_URL']; ?>"
			title="<?php echo $tplDisplayData['ADD_ALL']; ?>"><?php echo $tplDisplayData['ADD_ALL']; ?>
		</a> ]
		<?php echo $tplDisplayData['DISCOUNT']; ?>
		<span id="ploading" class="al_loading"><?php echo $tplDisplayData['ALBUM_ADDED']; ?>
		</span>
		<?php }?>

		<?php if($tplDisplayData['ADD_PHYSICAL_URL'] != ""){ ?>
		<br /> [ <a href="<?php echo $tplDisplayData['ADD_PHYSICAL_URL']; ?>"
			title="<?php echo $tplDisplayData['ADD_PHYSICAL']; ?>"><?php echo $tplDisplayData['ADD_PHYSICAL']; ?>
		</a> ]
		<?php echo $tplDisplayData['PHYSICAL_PRICE']; ?>
		<?php }?>
	</div>

	<div id="right_message">
	<?php echo $tplDisplayData['TRACKS_RIGHT']; ?>
	</div>
</div>

<span style="display: none;" class="button_align"><input
	class="formButton" type="submit"
	value="<?php echo $tplDisplayData['ADD_TO_CART']; ?>"
	title="<?php echo $tplDisplayData['ADD_TO_CART']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;<input
	class="formButton" type="button"
	value="<?php echo $tplDisplayData['CANCEL']; ?>"
	title="<?php echo $tplDisplayData['CANCEL']; ?>"
	onclick="window.location='<?php echo $tplDisplayData['URL']; ?>'" /> </span>

<div id="tracks">
	<table width="100%" cellspacing="0" cellpadding="0">
		<tr id="album_tr">
			<th align="left" width="3%">#</th>
			<th align="left" width="56%"><?php echo $tplDisplayData['TRACK_NAME']; ?>
			</th>
			<th align="left" width="5%">Duration</th>
			<th align="left" width="22%"><?php echo $tplDisplayData['TRACK_OPTIONS']; ?>
			</th>
			<th align="left" width="8%"><?php echo $tplDisplayData['TRACK_COST']; ?>
			</th>
			<th align="left" width="6%">+Add</th>
		</tr>
		<?php echo $tplDisplayData['ALBUM_DATA']; ?>
	</table>
</div>
<span style="display: none;" class="button_align"><input
	class="formButton" type="submit"
	value="<?php echo $tplDisplayData['ADD_TO_CART']; ?>"
	title="<?php echo $tplDisplayData['ADD_TO_CART']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;<input
	class="formButton" type="button"
	value="<?php echo $tplDisplayData['CANCEL']; ?>"
	title="<?php echo $tplDisplayData['CANCEL']; ?>"
	onclick="window.location='<?php echo $tplDisplayData['URL']; ?>'" /> </span>
<p class="hits">
<?php echo $tplDisplayData['HITS']; ?>
</p>
<?php echo ($this->SETTINGS->ajax == '1' ? "<!--":"</")?>
form
<?php echo ($this->SETTINGS->ajax == '1' ? "-->":">")?>