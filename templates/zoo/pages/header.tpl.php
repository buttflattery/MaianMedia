<?php if($tplDisplayFront['SELECT_LANG'] == '1'){ ?>
<div id="territories">
	<div id="territoryList">
		<ul>
		<?php echo $tplDisplayFront['RENDER_LANG']?>
		</ul>
	</div>
</div>
		<?php } ?>
<div id="mm_header">
<?php jimport( 'joomla.application.module.helper' );
if(!JModuleHelper::isEnabled('maiancart')){?>
	<a id="mm_cart"
		href="<?php echo JRoute::_('index.php?option=com_maianmedia&section=cart&view=viewcart')?>">
		<img
		src="components/com_maianmedia/<?php echo getTplPath($this->SETTINGS->homepage_url, 'img')?>/icons/shopping_cart.png" />
		<?php echo $tplDisplayFront['ITEMS_IN_CART'] ?>&nbsp; <font
		id="cart_count"><?php echo $tplDisplayFront['CART_COUNT'] ?> </font>&nbsp;(<i
		id="cart_total"><?php echo $tplDisplayFront['CART_TOTAL'] ?> </i>) </a>
		<?php }?>

		<?php if($tplDisplayFront['SHOW_NAV'] == '1'){ ?>
	<div id="mm_navigation">
		<ul>
		<?php if(isset($tplDisplayFront['PARAMS']['f_display']) && $tplDisplayFront['PARAMS']['f_display'] != '0'){ ?>
			<li id="mm_free_url"><a
				href="<?php echo $tplDisplayFront['F_URL'] ?>"
				title="<?php echo $tplDisplayFront['FREE']; ?>"><?php echo $tplDisplayFront['FREE']; ?>
			</a></li>
			<?php } ?>
			<?php if(isset($tplDisplayFront['PARAMS']['p_display']) && $tplDisplayFront['PARAMS']['p_display'] != '0'){ ?>
			<li id="mm_pop_url"><a href="<?php echo $tplDisplayFront['H_URL'] ?>"
				title="<?php echo $tplDisplayFront['HOMEPAGE']; ?>"><?php echo $tplDisplayFront['HOMEPAGE']; ?>
			</a></li>
			<?php } ?>
			<?php if(isset($tplDisplayFront['PARAMS']['m_display']) && $tplDisplayFront['PARAMS']['m_display'] != '0'){ ?>
			<li id="mm_music_url"><a
				href="<?php echo $tplDisplayFront['A_URL'] ?>"
				title="<?php echo $tplDisplayFront['ARTISTS']; ?>"><?php echo $tplDisplayFront['ARTISTS']; ?>
			</a></li>
			<?php } ?>
			<?php if(isset($tplDisplayFront['PARAMS']['c_display']) && $tplDisplayFront['PARAMS']['c_display'] != '0'){ ?>
			<li id="mm_contact_url"><a
				href="<?php echo $tplDisplayFront['C_URL'] ?>"
				title="<?php echo $tplDisplayFront['CONTACT']; ?>"><?php echo $tplDisplayFront['CONTACT']; ?>
			</a></li>
			<?php } ?>
			<?php if(isset($tplDisplayFront['PARAMS']['l_display']) && $tplDisplayFront['PARAMS']['l_display'] != '0'){ ?>
			<li id="mm_licence_url"><a
				href="<?php echo $tplDisplayFront['L_URL'] ?>"
				title="<?php echo $tplDisplayFront['LICENCE']; ?>"><?php echo $tplDisplayFront['LICENCE']; ?>
			</a></li>
			<?php } ?>
		</ul>

	</div>
	<?php } ?>

	<?php if($tplDisplayFront['SHOW_SEARCH'] == '1'){ ?>
	<div id="search_box">
		<form method="get" action="index.php?option=com_maianmedia">
			<input type="hidden" name="option" value="com_maianmedia" /> <input
				type="hidden" name="task" value="search" /> <input id="textfield1"
				type="text" class="searchBox" name="keywords" value="" /> <input
				id="submit1" class="formButton" type="submit" value="Search"
				title="Search" />
		</form>
	</div>
	<?php } ?>
</div>
<div id="mm_main">