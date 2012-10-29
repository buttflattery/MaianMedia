<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<link
	href="components/com_maianmedia/views/mm_stylesheet.css"
	rel="stylesheet" type="text/css" />
<!-- Music Search from http://www.AreTimes.com -->
<div id="search_box">
	<form method="get" action="index.php?option=com_maianmedia">
		<input type="hidden" name="option" value="com_maianmedia" />
		<?php if ($moduletype == 0 && $view == 0){?>
		<input type="hidden" name="view" value="music" /> <select name="cat">
		<?php echo $output_string?>
		</select>
		<?php }elseif($moduletype == 2 && $view == 1){?>
		<input type="hidden" name="view" value="singles" /> <input
			type="hidden" name="mfilter" value="1" /> <select name="keywords">
			<?php echo $output_string?>
		</select>
		<?php }else{?>
		<input type="hidden" name="task" value="search" />
		<?php if ($moduletype == 0){?>
		<input type="hidden" name="cat_filter" value="1" />
		<?php }elseif ($moduletype == 1){?>
		<input type="hidden" name="artist_filter" value="1" />
		<?php }elseif ($moduletype == 2){?>
		<input type="hidden" name="keyword_filter" value="1" />
		<?php }?>
		<select name="keywords" />
		<?php echo $output_string?>
		</select>
		<?php }?>
		<input id="submit1"
			class="<?php echo (isset($style) && $style !='' ? $style:'formButton') ?>"
			type="submit" value="Search" title="Search" />
			<?php if (isset($itemId) && JRequest::getVar('option') == 'com_maianmedia'){?>
		<input type="hidden" name="Itemid" value="<?php echo $itemId?>" />
		<?php }?>
	</form>
</div>
