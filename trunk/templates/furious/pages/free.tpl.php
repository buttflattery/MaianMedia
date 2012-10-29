
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
			<th align="left" width="50%"><b><?php echo $tplDisplayData['TRACK_NAME']; ?>
			</b></th>
			<th align="left" width="8%">Test</th>
			<th align="left" width="14%"><b><?php echo $tplDisplayData['TRACK_OPTIONS']; ?>
			</b></th>
			<th align="left" width="8%">Duration</th>
			<th align="left" width="20%"><b><?php echo $tplDisplayData['TRACK_ALBUM']; ?>
			</b></th>
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
