<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$uri =& JURI::getInstance();
?>
<link
	href="<?php echo $uri->root();?>/modules/mod_maianaio/tmpl/mm_module.css"
	rel="stylesheet" type="text/css" />
<!-- Popular Music Box from http://www.AreTimes.com -->
<div class="maian_wrapper">
<?php echo $table_top	?>
<?php echo $most_pop; ?>
<?php echo $table_bottom; ?>
	<div style="clear: both;"></div>
</div>
