
<div id="mm_contact">
	<h2 class="title">
	<?php  echo $tplDisplayData['FORM_TEXT']; ?>
	</h2>
	<?php  echo $tplDisplayData['CONTACT_MESSAGE']; ?>
	<br /> <br />
	<form method="post" name="cform"
		action="<?php  echo $tplDisplayData['C_URL']; ?>">
		<p <?php  echo $tplDisplayData['FORM_DISPLAY']; ?>>
			<input type="hidden" name="process" value="1" /> <label
				class="lclass"><?php  echo $tplDisplayData['NAME_TEXT']; ?>:<br /> </label>
			<input type="text" class="formBox" name="name"
				value="<?php  echo $tplDisplayData['NAME_VALUE']; ?>" size="18" />
				<?php  echo $tplDisplayData['N_ERROR']; ?>
			<br /> <br /> <label class="lclass"><?php  echo $tplDisplayData['EMAIL_TEXT']; ?>:<br />
			</label> <input type="text" class="formBox" name="email"
				value="<?php  echo $tplDisplayData['EMAIL_VALUE']; ?>" size="18" />
				<?php  echo $tplDisplayData['E_ERROR']; ?>
			<br /> <br /> <label class="lclass"><?php  echo $tplDisplayData['SUBJECT_TEXT']; ?>:<br />
			</label> <input type="text" class="formBox" name="subject"
				value="<?php  echo $tplDisplayData['SUBJECT_VALUE']; ?>" size="18" />
				<?php  echo $tplDisplayData['S_ERROR']; ?>
			<br /> <br /> <label class="lclass"><?php  echo $tplDisplayData['COMMENT_TEXT']; ?>:<br />
			</label>
			<textarea name="comments" rows="5" cols="40">
			<?php  echo $tplDisplayData['COMMENT_VALUE']; ?>
			</textarea>
			<?php  echo $tplDisplayData['C_ERROR']; ?>
			<br /> <br />
		
		
		<div id="mm_captcha">
		<?php  echo $tplDisplayData['CAPTCHA']; ?>
		</div>
		<?php if(isset($tplDisplayData['CAPTCHA']) && $tplDisplayData['CAPTCHA'] != ''){?>
		<input class="formButton" name="send" type="submit"
			value="<?php  echo $tplDisplayData['SEND_TEXT']; ?>"
			title="<?php  echo $tplDisplayData['SEND_TEXT']; ?>" />
		<?php }?>
	</form>
</div>
