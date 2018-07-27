<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

//Approve overtime
if(isset($_POST['approve'])){
	$formvalues = array_merge($_POST);
	for($i=0;$i<count($formvalues['OTid']);$i++){
		mysql_query("UPDATE assignmentovertime SET status = 'approved' WHERE id = '".$formvalues['OTid'][$i]."'");
	}
}
//Reject overtime
if(isset($_POST['reject'])){
	$formvalues = array_merge($_POST);
	for($i=0;$i<count($formvalues['OTid']);$i++){
		mysql_query("UPDATE assignmentovertime SET status = 'rejected' WHERE id = '".$formvalues['OTid'][$i]."'");
	}
}
//Archive overtime
if(isset($_POST['archive'])){
	$formvalues = array_merge($_POST);
	for($i=0;$i<count($formvalues['OTid']);$i++){
		mysql_query("UPDATE assignmentovertime SET status = 'archived' WHERE id = '".$formvalues['OTid'][$i]."'");
	}
}

//Go through the overtime column in the schedule table picking the overtime
$scheduleresult = mysql_query("SELECT id, overtimeentry, dateentered FROM guardschedule");
$rawfieldovertime = array();
//Overrall counter
$k=0;
while($line = mysql_fetch_array($scheduleresult, MYSQL_ASSOC)){
	$guardassgnarr = split(",",$line['overtimeentry']);
	for($i=0;$i<count($guardassgnarr);$i++){
		//Pick guardid and assignment
		$overtimearr = split("=",$guardassgnarr[$i]);
		if($overtimearr[1] != ""){
			//Overtime Row Array: previous schedule id, schedule date, guard ID, Assignment Code
			$rawfieldovertime[$k] = array($line['id'], $line['dateentered'], $overtimearr[0], $overtimearr[1]);
			//Increament overall counter to store array values
			$k++;
		}
	}
}

$result = mysql_query("SELECT guardid, scheduleid FROM assignmentovertime WHERE scheduleid <> ''");
//Put all guard and schedule id data in arrays
$guardsarr = array();
$schedulearr = array();
$j = 0;
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	$guardsarr[$j] = $row['guardid'];
	$schedulearr[$j] = $row['scheduleid'];
	$j++;
}

//For those not in the db arrays, save them into the db
for($i=0;$i<$k;$i++){
	$savedstr = "Y";
	for($x=0;$x<count($guardsarr);$x++){	
		if(($rawfieldovertime[$i][2] == $guardsarr[$x]) && ($rawfieldovertime[$i][0] == $schedulearr[$x])){
			$savedstr = "N";
		}
	}
	if($savedstr == "Y"){
		mysql_query("INSERT INTO assignmentovertime (guardid, assignment, date, scheduleid, status, date_of_entry) VALUES ('".$rawfieldovertime[$i][2]."', '".$rawfieldovertime[$i][3]."', '".$rawfieldovertime[$i][1]."', '".$rawfieldovertime[$i][0]."', '', NOW())");
	}
}

//Display the appropriate list of overtime
if(isset($_GET['a'])){
	$freeOTquery = "SELECT * FROM assignmentovertime WHERE status = '".$_GET['a']."' AND scheduleid <> '' ORDER BY date DESC";
	
} else {
	$freeOTquery = "SELECT * FROM assignmentovertime WHERE status = '' AND scheduleid <> '' ORDER BY date DESC";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Approve Overtime</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>

</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="750" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
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
        <td class="headings">Approve Overtime </td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="approveovertime.php">
          <table width="100%" border="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><?php 
			  if(!isset($_GET['a'])){
			  	echo "<span class=\"label\">New</span>";
			  } else {
			  	echo "<a href=\"approveovertime.php\">New</a>";
			  }
			  ?> | <?php 
			  if(isset($_GET['a']) && $_GET['a'] == "approved"){
			  	echo "<span class=\"label\">Approved</span>";
			  } else {
			  	echo "<a href=\"approveovertime.php?a=approved\">Approved</a>";
			  }
			  ?> | <?php 
			  if(isset($_GET['a']) && $_GET['a'] == "rejected"){
			  	echo "<span class=\"label\">Rejected</span>";
			  } else {
			  	echo "<a href=\"approveovertime.php?a=rejected\">Rejected</a>";
			  }
			  ?> | <?php 
			  if(isset($_GET['a']) && $_GET['a'] == "archived"){
			  	echo "<span class=\"label\">Archived</span>";
			  } else {
			  	echo "<a href=\"approveovertime.php?a=archived\">Archived</a>";
			  }
			  ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <?php
			
			if(howManyRows($freeOTquery) == 0){          			
				echo "<tr><td>There are no new overtime entries to display</td></tr>";
		   	} else { 
			?>
            <tr>
              <td><div style="padding:4px;width:720px;height:300px;overflow: auto">
			  <table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
                  <tr class="tabheadings">
                   <?php if(userHasRight($_SESSION['userid'], "143")){?>
					<td></td><?php } ?>
                    <td>Date</td>
                    <td nowrap>Assignment Code</td>
                    <td>Client</td>
                    <td>Guard</td>
                  </tr>
                  <?php 
			  //for($i=0;$i<count($displayarr);$i++) { 
			  $i = 0;
			  $result = mysql_query($freeOTquery);
			  while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
				  
			   ?>
                  <tr class="<?php echo $rowclass; ?>">
                    <?php if(userHasRight($_SESSION['userid'], "143")){?>
					<td><input type="checkbox" name="OTid[]" value="<?php echo $row['id'];?>"></td>
					<?php } ?>
                    <td><?php 
				echo date("d-M-Y",strtotime($row['date'])); ?></td>
                    <td><?php echo $row['assignment']; ?></td>
                    <td><?php 
				$assgnarr = getRowAsArray("SELECT client FROM assignments WHERE callsign = '".$row['assignment']."'");
				echo $assgnarr['client']; ?></td>
                    <td><?php echo $row['guardid']; 
				echo " (".getGuardNameById($row['guardid']).")";
				?></td>
                  </tr>
                  <?php 
			  	$i++;
			  } 
			  ?>
              </table></div></td>
            </tr>
            <?php } ?>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
			<?php if(userHasRight($_SESSION['userid'], "143")){?>
              <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
                  <input type="submit" name="approve" id="approve" value="Approve">
                  <input type="submit" name="reject" id="reject" value="Reject">
                  <input type="submit" name="archive" id="archive" value="Archive"></td><?php } ?>
            </tr>
          </table>
                </form>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" class="copyright"><?php include('../include/footer.php');?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
