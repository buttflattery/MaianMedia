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

jimport('joomla.application.component.controller');

/**
 * Hello World Component Controller
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class MaianControllerStats extends MaianControllerDefault
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		//$this->registerTask( 'add'  , 	'edit' );
	}

	function getChart()
	{
		$cid = JRequest::getVar( 'cid' );
		$uri =& JURI::getInstance();

		$db =& JFactory::getDBO();
		$db->setQuery("SELECT count(*) AS total_sales FROM #__m15_purchases WHERE item_id = 'a".$cid."'") ;

		$album_sales = $db->loadObject();

		if(isset($album_sales)){

			echo '<html>
				<head>
					<script type="text/javascript" src="'.$uri->root().'administrator/components/com_maianmedia/utilities/charts/js/swfobject.js"></script>
					<script type="text/javascript">
						swfobject.embedSWF(
 						 "'.$uri->root().'administrator/components/com_maianmedia/utilities/charts/open-flash-chart2DZ.swf", "my_chart",
 							 "100%", "100%", "9.0.0", "expressInstall.swf",
 							 {"data-file":"'.urlencode($uri->root().'administrator/index.php?option=com_maianmedia&controller=stats&format=raw&task=genChart&cid='.$cid).'"}, {wmode:"transparent"}  );
					</script>
				</head>
				<body>
				<div id="my_chart"></div>
							</body>
					</html>';
		}else{
			echo MaianText::_(_msg_sales13);
		}


	}

	function genChart()
	{
		$cid = JRequest::getVar( 'cid' );
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__m15_albums WHERE id = '".$cid."'") ;
		$album = $db->loadObject();

		$db->setQuery("SELECT * FROM #__m15_tracks
                                    WHERE track_album = '".$cid."'
                                    ORDER BY track_order") ;
		$tracks  = $db->loadObjectList();

		$db->setQuery("SELECT count(*) AS total_sales FROM #__m15_purchases WHERE item_id = 'a".$cid."'") ;

		$album_sales = $db->loadObject();
		$total= 0;
		foreach ($tracks  as $TRACK) {

			$db->setQuery("SELECT count(*) AS t_count FROM #__m15_purchases
                                WHERE item_id = 't".$TRACK->id."'") ;
			$PURCHASES= $db->loadObject();
			$total = $total+$PURCHASES->t_count;
		}

		foreach ($tracks  as $TRACK) {

			$db->setQuery("SELECT count(*) AS t_count FROM #__m15_purchases
                                WHERE track_id = '".$TRACK->id."'") ;
			$PURCHASES= $db->loadObject();
			$total = $total+$PURCHASES->t_count;
		}

		$trackArray = array();
		if(count($tracks) > 0){
			$x = 0;
			for($x=count($tracks)-1; $x >= 0; $x-=1){

				$trackArray[] = cleanData($tracks[$x]->track_name);
			}
		}
			
		require_once(JPATH_COMPONENT.DS.'utilities'.DS.'charts'.DS.'php-ofc-library'.DS.'open-flash-chart.php');

		$y = new y_axis();
		$y->set_offset( true );
		$y->set_labels( $trackArray );

		$title = new title( cleanData($album->name).'-'.cleanData($album->artist));

		$hbar = new hbar( '#0000FF' );
		$hbar->set_key( 'Tracks', 12);

		foreach ($tracks as $TRACK) {
			$db->setQuery("SELECT count(*) AS t_count FROM #__m15_purchases
                                  WHERE item_id = 't".$TRACK->id."'") ;	  
			$PURCHASES = $db->loadObject();

			$percent = intval($PURCHASES->t_count)/intval($total)*100;

			$tmp = new hbar_value(0,$percent);
			$tmp->set_tooltip( "Sale #val#%<br> $PURCHASES->t_count Tracks Sold" );

			$hbar->append_value($tmp);

		}

		$hbar2 = new hbar( '#FF0000' );
		$hbar2->set_key( 'Albums', 12);

		foreach ($tracks as $TRACK) {

			$db->setQuery("SELECT count(*) AS t_count FROM #__m15_purchases
			WHERE track_id   = '{$TRACK->id}'") ;
			$PURCHASES = $db->loadObject();

			$percent = intval($PURCHASES->t_count)/intval($total)*100;

			$tmp = new hbar_value(0,$percent);
			$tmp->set_tooltip( "Sale #val#%<br> $PURCHASES->t_count Tracks Sold" );

			$hbar2->append_value($tmp);

		}

		$chart = new open_flash_chart();
		$chart->set_title( $title );
		$chart->add_element( $hbar );
		$chart->add_element( $hbar2 );

		$x_labels = new x_axis_labels();
		$x_labels->set_steps(10);

		$x = new x_axis();
		$x->set_offset( false );

		for($x_num=10; $x_num<=100; $x_num+=10){

			$percentArray[] = $x_num;
		}

		$x->set_labels( $percentArray );
		$x->set_labels( $x_labels );

		$chart->set_x_axis( $x );
		$chart->add_y_axis( $y );

		echo $chart->toPrettyString();
	}

	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display()
	{
		// loading view for this task
		JRequest::setVar( 'layout', 'form'  );

		parent::display();
	}


}