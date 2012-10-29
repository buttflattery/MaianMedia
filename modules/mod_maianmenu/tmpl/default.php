<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<div id="mm_navigation">
	<ul>
	<?php if( $params->get('f_display') != '0'){ ?>
		<li id="mm_free_url"><a href="<?php echo $F_URL?>"
			title="<?php echo $FREE; ?>"><?php echo $FREE; ?> </a></li>
			<?php } ?>
			<?php if( $params->get('p_display') != '0'){ ?>
		<li id="mm_pop_url"><a href="<?php echo $H_URL?>"
			title="<?php echo $HOMEPAGE; ?>"><?php echo $HOMEPAGE; ?> </a></li>
			<?php } ?>
			<?php if( $params->get('m_display') != '0'){ ?>
		<li id="mm_music_url"><a href="<?php echo $A_URL?>"
			title="<?php echo $ARTISTS; ?>"><?php echo $ARTISTS; ?> </a></li>
			<?php } ?>
			<?php if( $params->get('c_display') != '0'){ ?>
		<li id="mm_contact_url"><a href="<?php echo $C_URL?>"
			title="<?php echo $CONTACT; ?>"><?php echo $CONTACT; ?> </a></li>
			<?php } ?>
			<?php if( $params->get('l_display') != '0'){ ?>
		<li id="mm_licence_url"><a href="<?php echo $L_URL?>"
			title="<?php echo $LICENCE; ?>"><?php echo $LICENCE; ?> </a></li>
			<?php } ?>
	</ul>

</div>
