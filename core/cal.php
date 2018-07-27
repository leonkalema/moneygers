<?php 
	require_once('../calendar/calendar/classes/tc_calendar.php'); 
	if(isset($_POST['button2'])){
		//die($_POST['date3']." ".$_POST['date4']);
					$date1 = explode("-",$_POST['date3']);
					$date1_1 = mktime(0 ,0 ,0 ,$date1[1],$date1[2],$date1[0]);
					$date2 = explode("-",$_POST['date4']);
					$date2_2 = mktime(23 ,59 ,59 ,$date2[1],$date2[2],$date2[0]);
					die($date1[0]." ".$date1[1]." ".$date1[2]);
	}
?>
<link href="../calendar/calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../calendar/calendar/calendar.js"></script>
<form method="post">
<?php
	$thisweek = date('W');
	$thisyear = date('Y');

	$dayTimes = getDaysInWeek($thisweek, $thisyear);
	//----------------------------------------

	$date1 = date('Y-m-d', $dayTimes[0]);
	$date2 = date('Y-m-d', $dayTimes[(sizeof($dayTimes)-1)]);

	function getDaysInWeek ($weekNumber, $year, $dayStart = 1) {
	  // Count from '0104' because January 4th is always in week 1
	  // (according to ISO 8601).
	  $time = strtotime($year . '0104 +' . ($weekNumber - 1).' weeks');
	  // Get the time of the first day of the week
	  $dayTime = strtotime('-' . (date('w', $time) - $dayStart) . ' days', $time);
	  // Get the times of days 0 -> 6
	  $dayTimes = array ();
	  for ($i = 0; $i < 7; ++$i) {
		$dayTimes[] = strtotime('+' . $i . ' days', $dayTime);
	  }
	  // Return timestamps for mon-sun.
	  return $dayTimes;
	}


  $myCalendar = new tc_calendar("date3", true, false);
  $myCalendar->setIcon("../calendar/calendar/images/iconCalendar.gif");
  $myCalendar->setDate(date('d', strtotime($date1)), date('m', strtotime($date1)), date('Y', strtotime($date1)));
  $myCalendar->setPath("../calendar/calendar/");
  $myCalendar->setYearInterval(1970, 2020);
  //$myCalendar->dateAllow('2009-02-20', "", false);
  $myCalendar->setAlignment('left', 'bottom');
  $myCalendar->setDatePair('date3', 'date4', $date2);
  //$myCalendar->setSpecificDate(array("2011-04-01", "2011-04-04", "2011-12-25"), 0, 'year');
  $myCalendar->writeScript();
					  ?>
                      
<?php
					  $myCalendar = new tc_calendar("date4", true, false);
					  $myCalendar->setIcon("../calendar/calendar/images/iconCalendar.gif");
					  $myCalendar->setDate(date('d', strtotime($date2)), date('m', strtotime($date2)), date('Y', strtotime($date2)));
					  $myCalendar->setPath("../calendar/calendar/");
					  $myCalendar->setYearInterval(1970, 2020);
					  //$myCalendar->dateAllow("", '2009-11-03', false);
					  $myCalendar->setAlignment('left', 'bottom');
					  $myCalendar->setDatePair('date3', 'date4', $date1);
					  //$myCalendar->setSpecificDate(array("2011-04-01", "2011-04-04", "2011-12-25"), 0, 'year');
					  $myCalendar->writeScript();
					  ?>

<input type="submit" name="button2" id="button2" value="Go" >
</form>