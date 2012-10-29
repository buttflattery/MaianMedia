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
$days = array(
              '01',
              '02',
              '03',
              '04',
              '05',
              '06',
              '07',
              '08',
              '09',
              '10',
              '11',
              '12',
              '13',
              '14',
              '15',
              '16',
              '17',
              '18',
              '19',
              '20',
              '21',
              '22',
              '23',
              '24',
              '25',
              '26',
              '27',
              '28',
              '29',
              '30',
              '31',
);

$months = array(
                '01' => _msg_calendar,
                '02' => _msg_calendar2,
                '03' => _msg_calendar3,
                '04' => _msg_calendar4,
                '05' => _msg_calendar5,
                '06' => _msg_calendar6,
                '07' => _msg_calendar7,
                '08' => _msg_calendar8,
                '09' => _msg_calendar9,
                '10' => _msg_calendar10,
                '11' => _msg_calendar11,
                '12' => _msg_calendar12
);

$years = array();

for ($i='2007'; $i<date("Y")+5; $i++)
{
	$years[] = $i;
}
 
?>