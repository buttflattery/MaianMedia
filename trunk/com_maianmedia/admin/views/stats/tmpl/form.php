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

$uri =& JURI::getInstance();
$document = &JFactory::getDocument();
$SETTINGS = $this->settings;
$sales = $this->sales;
$db =& JFactory::getDBO();
$document = &JFactory::getDocument();
$document->addScript('components/com_maianmedia/js/js_code.js');
$document->addScript('components/com_maianmedia/js/slider.js');
?>

<form style="background-color: #FFF" id="adminForm" action="index.php"
	method="post" name="adminForm">
	<?php
	$uri =& JURI::getInstance();
	$root_url = $uri->root(); //root url
	$root_base = $uri->base(); //base url
	$root_current = $uri->current();

	$db->setQuery("SELECT * FROM #__m15_albums ".(isset($sql) ? $sql : 'ORDER BY artist,name')."
                             ") ;
	$q_albums = $db->loadObjectList();

	$limStart = 0;
	$limEnd = 5;

	$divCount = count($q_albums) / $limEnd;

	if(count($q_albums) < 5){
		$divCount = 1;
	}
	$i  = 1;
	$addTag = 1;
	?>
	<table>
		<tr>
			<td id="mychart"><iframe name="chartFrame" class="chartFrame"
					height="300px" width="600px" scrolling="no"
					src="<?php echo $uri->root().'administrator/index.php?option=com_maianmedia&format=raw&controller=stats&task=getChart&cid='.$q_albums[0]->id; ?>"></iframe>
			</td>
			<td>
				<div id="slider1" class="sliderwrapper">
					<div class="contentdiv">
					<?php

					foreach($q_albums as $ALBUMS){
						$i+=1;
						$db->setQuery("SELECT count(*) AS a_count FROM #__m15_purchases
                                    WHERE item_id = 'a".$ALBUMS->id."'
                                    AND track_id  = '0'") ;
						$PURCHASES = $db->loadObject();
							
						if($PURCHASES->a_count == null){
							$purchasesCount = 0;
						}else{
							$purchasesCount = number_format($PURCHASES->a_count);
						}

						$trackCount = number_format(getTrackPurchasesForAlbum($ALBUMS->id));
							
						if($purchasesCount != 0 || number_format(getTrackPurchasesForAlbum($ALBUMS->id)) != 0 ){?>
						<div class="musicRow">
							<a target="chartFrame"
								href="<?php echo $uri->root().'administrator/index.php?option=com_maianmedia&format=raw&controller=stats&task=getChart&cid='.$ALBUMS->id; ?>"><img
								src="<?php echo $uri->base(); ?>/components/com_maianmedia/images/trackStats.png"
								alt="<?php echo _msg_statistics8; ?>"
								title="<?php echo _msg_statistics8; ?>" border="0" /> </a>
							<ul class="musicInfo">
								<li><b><?php echo cleanData($ALBUMS->artist); ?> - <?php echo cleanData($ALBUMS->name); ?>
								</b></li>
								<?php

								echo str_replace(array('{hits}','{albums}','{tracks}'),
								array(number_format($ALBUMS->hits),
								$purchasesCount,
								number_format(getTrackPurchasesForAlbum($ALBUMS->id))
								),
								_msg_statistics7); ?>

							</ul>
						</div>
						<?php

						if($addTag == 5){
							$addTag = 0;
							?>
					</div>
					<?php if($i + 5 < count($q_albums )){
						echo $i;?>
					<div class="contentdiv">

					<?php
					}
						}?>

						<?php

						$addTag+=1;


						}//end if
					}//end for each
					?>

					<?php if($i + 5 < count($q_albums )){
						echo $i;?>
					</div>

					<?php } ?>
				</div>
			</td>
		</tr>
		<tr>
			<td id="mypag">
				<div id="paginate-slider1" class="pagination"></div>
			</td>
		</tr>
	</table>

</form>
<script type="text/javascript">

featuredcontentslider.init({
id: "slider1", //id of main slider DIV
contentsource: ["inline", ""], //Valid values: ["inline", ""] or ["ajax", "path_to_file"]
toc: "#increment", //Valid values: "#increment", "markup", ["label1", "label2", etc]
nextprev: ["Previous", "Next"], //labels for "prev" and "next" links. Set to "" to hide.
enablefade: [true, 0.2], //[true/false, fadedegree]
autorotate: [false, 3000], //[true/false, pausetime]
onChange: function(previndex, curindex){ //event handler fired whenever script changes slide
//previndex holds index of last slide viewed b4 current (1=1st slide, 2nd=2nd etc)
//curindex holds index of currently shown slide (1=1st slide, 2nd=2nd etc)
}
})

</script>
