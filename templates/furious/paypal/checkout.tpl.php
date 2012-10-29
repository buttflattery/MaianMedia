
<div id="paypal_connection">
<?php echo $tplDisplayData['CONNECTING']; ?>
	<br /> <br /> <img
		src="components/com_maianmedia/<?php echo getTplPath($this->skin_name, 'img')?>/cart/connecting.gif"
		alt="<?php echo $tplDisplayData['CONNECTING']; ?>"
		title="<?php echo $tplDisplayData['CONNECTING']; ?>" />
</div>
<?php echo $tplDisplayData['PAYPAL_FORM_FIELDS']; ?>

<script type="text/javascript">
setTimeout("document.paypal_form.submit()", 2000);
</script>
