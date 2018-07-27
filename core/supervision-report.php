<?php
	
  include_once "../include/commonfunctions.php";
  	include_once "../include/lib.php";
	require_once('../calendar/calendar/classes/tc_calendar.php'); 
  $conn = new connection();
  $supervision = new supervision();
  $supervision->link = $conn->link;
  $data = $supervision->get_supervision();
  
  if(isset($_POST['button1'])){
		//die("Here");
		//die($_POST['date3']." ".$_POST['date4']);
					$date1 = explode("-",$_POST['date3']);
					$date1_1 = mktime(0 ,0 ,0 ,$date1[1],$date1[2],$date1[0]);
					$date2 = explode("-",$_POST['date4']);
					$date2_2 = mktime(23 ,59 ,59 ,$date2[1],$date2[2],$date2[0]);
					//die($date2[0]." ".$date2[1]." ".$date2[2]);
					$search = new utilities();
					$search->link = $conn->link;
					$search->column = 0;
					$search->searchString = 0;
					$search->startDate = $date1_1;
					$search->endDate = $date2_2;
					$data = $search->search2();
	}
	
	if(isset($_POST['button2'])){
		$search = new utilities();
		$search->link = $conn->link;
		$search->startDate = 0;
		$search->endDate = 0;
		//die($_POST['criteria']);
		if($_POST['criteria'] == "inspector")
			$search->column = "inspectorName";
		else
			$search->column = "name";
		$search->searchString = trim($_POST['sstring']);
		//die($search->searchString."hj");
		$data = $search->search2();
	}

?>

<html>
  <head>
    <title>
	  Supervision list
	</title>
  <link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../calendar/calendar/calendar.js"></script>
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>
<script language="javascript" src="../javascript/jquery-1.8.3.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function($){
			$('div#date').hide();
			$('div#sstring').hide();
});
function toggleDivs(){
		$(document).ready(function($){
		var x = document.getElementById('criteria').value;
		//alert(x);
		if(x == "date"){
			$('div#date').show();
			$('div#sstring').hide();
		}
		else{
			$('div#date').hide();
			$('div#sstring').show();
		}
	});
}
</script>

</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
  <tr> 
    <td height="7" colspan="2"></td>
  </tr>
  <tr> 
    <td colspan="2"><?php include "../core/header.php";?></td>
  </tr>
  <tr> 
    <td height="7" colspan="2"></td>
  </tr>
  <tr> 
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings">Manage Supervision Records </td>
      </tr>
      <tr>
        <td>
        
        <table width="100%" border="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td> <?php if(userHasRight($_SESSION['userid'], "47")){?>
                <input type="button" name="supervision" value="Create New Supervision Report" onClick="javascript:document.location.href='../core/supervisor.php'"><?php } ?>				
              </td>
            </tr>
			 <tr>
         <td>&nbsp;</td>
       </tr>
	  <td><div id="searchtable">
      <form method="post">
              <table><tr>
              	<td style="vertical-align:top">
                <br>
              	<b>Select search criteria: &nbsp; </b>
             	<select id="criteria" onChange="toggleDivs()" name="criteria" value="<?php echo $_POST['criteria'] ?>">
                	<option></option>
                	<option value="date">Date</option>
                    <option value="inspector">Supervisor</option>
                    <option value="client">Client</option>
                </select>
                </td>
                <td style="padding-top:16px; vertical-align:top">
                <div id="date">
                <table><tr>
                <td style="padding-right:6px; font-weight:bold">
                Date period:<br><br>
                </td>
                <td>
                <?php
				//die("Here");
				
	$thisweek = date('W');
	$thisyear = date('Y');
	
	$dayTimes = getDaysInWeek($thisweek, $thisyear);
	//----------------------------------------
	//die("Here ".$dayTimes);
	$date1 = date('Y-m-d', $dayTimes[0]);
	$date2 = date('Y-m-d', $dayTimes[(sizeof($dayTimes)-1)]);


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
				echo "<span style=\"padding:10;\">";
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
					  echo "</span>";
					  ?>
						<input type="submit" name="button1" id="button1" value="Search" >
				</td>
                </tr>
                </table>
                </div>
                <div id="sstring">
                	<b>Enter search string:</b> &nbsp;
                	<input type="text" name="sstring" />
                    <input type="submit" name="button2" id="button2" value="Search" >
                </div>
                </td>
               </tr>
              </table>
              </form>
              <table width="99%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
                  <tr class="tabheadings">
                  	<td>Month of supervision</td>
                    <td>Supervisor </td>
                    <td>Client </td>
                  	<td>&nbsp;</td>
					<?php if(userHasRight($_SESSION['userid'], "47")){?>
                    <td>Delete</td><?php } ?>
					
                  </tr>
                  <?php
			  $j = 0;
			  if(mysql_num_rows($data) < 1)
			  	echo "<tr><td colspan=\"8\"><br>No results to show</td></tr>";
				
				else
			   while($row=mysql_fetch_array($data)) { 
			   		
					$str = date("M-Y",$row['date']);
			      if(($j%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
                  <tr class="<?php echo $rowclass; ?>">
                    
					<?php if(userHasRight($_SESSION['userid'], "47")){
					echo "<td>".$str."</td>";
		  			echo "<td>".$row['inspectorName']."</td>";
					echo "<td>".$row['name']."</td>";
					echo "<td><a href=\"view-supervision.php?id=".encrypt($row['supervisionId'],"code")."\">Full report &raquo;</a></td>";
					echo "<td><a href=\"delete.php?id=".encrypt($row['supervisionId'],"code")."&table=supervision&rname=supervisionId&page=sup\"><img src=\"../images/del.png\" width=\"25\" height=\"20\" title=\"Delete\"/></a></td>";
					}
					
					?>
                  </tr>
                  <?php 
			  $j++;
			  }?>
		</table>
  
    </td>
    </tr>
    </table>
	<br/> <br />
	</div>
</div>
  </body>
</html>
