
<h2 class="title">
<?php echo $tplDisplayData['TRACK_TEXT']; ?>
</h2>
<?php echo $tplDisplayData['TRACK_MESSAGE']; ?>
<br />
<br />

<?php echo isset($tplDisplayData['GET_EMAIL']) ? $tplDisplayData['GET_EMAIL']:""; ?>
<div id="tracks">
	<table width="100%" cellspacing="0" cellpadding="0">
		<tr height="10px" id="album_tr">

			<th align="left" width="40%"><?php echo $tplDisplayData['TRACK_NAME']; ?>
			</th>
			<th align="left" width="7%">Duration</th>
			<th align="left" width="10%"><b><?php echo $tplDisplayData['TRACK_OPTIONS']; ?>
			</b></th>
			<th align="left" width="30%"><b><?php echo $tplDisplayData['TRACK_ALBUM']; ?>
			</b></th>
			<th align="left" width="8%">Download</th>
		</tr>
		<?php echo $tplDisplayData['TRACK_DATA']; ?>
	</table>
</div>
<p>
<?php echo $tplDisplayData['PAGE_NUMBERS']; ?>
</p>
<input
	name="Itemid" type="hidden"
	value="<?php echo JRequest::getVar('Itemid'); ?>" />
