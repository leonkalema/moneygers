<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_POST['detail'])){
	$formvalues = array_merge($_POST);
	$_SESSION['formvalues'] = $formvalues;
	$reporttype = $formvalues['reporttype'];
	
	$formvalues['startdate'] = "'".changeDateFromPageCombosToMySQLFormat($formvalues['start_day'], $formvalues['start_month'], $formvalues['start_year'])."'";
	$_SESSION['startdate'] = $formvalues['startdate'];
	$formvalues['enddate'] = "'".changeDateFromPageCombosToMySQLFormat($formvalues['end_day'], $formvalues['end_month'], $formvalues['end_year'])."'";
	$_SESSION['enddate'] = $formvalues['enddate'];
}

// If the person has come from the payment status page to generate an invoice
if(isset($_GET['pid']) && trim($_GET['pid']) != ""){
	$pid = decryptValue($_GET['pid']);
	$array = getRowAsArray("SELECT client AS clientname, lastpaymentdate AS startdate FROM assignments WHERE id='$pid'");
	$_SESSION['formvalues'] = $array;
}

if(isset($_GET['f'])){
	$reporttype = $_GET['f'];
	$_SESSION['reporttype'] = $_GET['f'];
}
$settings = getRowAsArray("SELECT * FROM settings");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Generate Guard Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0" onLoad="setDiv('../include/reportdetails.php?area=<?php echo $_SESSION['reporttype'];
?>&value=','reportdetails','','Loading...'); return false; ">
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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings">Generate <?php echo $_GET['f'];?> Report </td>
      </tr>
      <tr>
        <td><form action="../finance/report.php" method="post" name="guardreport" id="guardreport" onSubmit="return <?php if($_SESSION['reporttype'] == "Client Invoice"){ ?>isNotNullOrEmptyString('clientname', 'Please enter the client\'s name.') && <?php } ?>checkhidden();"><table width="100%" border="0" cellpadding="5" cellspacing="2">
          
            <tr>
            <td width="1%" align="left" class="label"><input type="button" name="cancel" id="cancel" value="<< Back" onClick="document.location.href='../core/dashboard.php'"></td>
            <td width="99%" colspan="3" valign="top"></td>
            </tr>
            <tr>
            <td rowspan="2" align="right" nowrap class="label">Generate Report For: </td>
            
			<td valign="top" width="99%"><select name="reporttype" id="reporttype" onChange="pickFormItemAndDirect('reporttype', '../finance/report.php?f=', 'Please select a report type')">
              <option value="">&lt;Select One&gt;</option>
			  <?php 
			  $group_result = mysql_query("SELECT id, viewedby FROM reportdetails GROUP BY reporttype");
			  $id_array = array();
			  while($line1 = mysql_fetch_array($group_result, MYSQL_ASSOC)){
			  		$view_array = split(",",$line1['viewedby']);
					if(in_array($_SESSION['groups'],$view_array)){
						array_push($id_array,$line1['id']);
					}
			  }
			  
			  // Remove duplicate arrays
			  $clean_ids = array_unique($id_array);
			  for($i=0;$i<count($clean_ids);$i++){
			  	$report_result = mysql_query("SELECT reporttype FROM reportdetails WHERE id = '".$clean_ids[$i]."'");
			  	while($line = mysql_fetch_array($report_result, MYSQL_ASSOC)){
			  		echo "<option value=\"".$line['reporttype']."\"";
					if($line['reporttype'] == $reporttype){
						echo " selected";
					}
					echo ">".$line['reporttype']."</option>";
			  	}
			  }
			  ?>
                        </select></td>
			<td width="99%" rowspan="2" align="right" valign="top" nowrap class="label"><span  class="label">With Details:</span> <br>
			  <br>
			  (These details will appear<br>
			  in the report generated<br> 
			  below.) </td>
               <td width="97%" colspan="2" rowspan="2" valign="top"><div id="guardid_search" style="width:250; height:170; font-style:normal; color:#000066; font-weight:bolder; font-size:14px;overflow: auto; border-color:#CCCCCC; border-style:solid;"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                   <?php
				   		$result = mysql_query("SELECT * FROM reportdetails WHERE reporttype = '".$reporttype."' ");
				   		while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
				      		$row = "<tr><td width=\"1%\"><input type=\"checkbox\" id=\"detail_".$line['id']."\" name=\"detail[]\" value=\"".$line['id']."\" onclick=\"if(this.checked){document.getElementById('checkthis".$line['id']."').value='1'; } else{ document.getElementById('checkthis".$line['id']."').value=''; }\"";
					  		if(isset($formvalues) && in_array($line['id'],$formvalues['detail'])){ $row .= "checked";}
					  		$row .= "></td><td width=\"99%\">".$line['detail']."<input type=\"hidden\" name=\"check\" id=\"checkthis".$line['id']."\" value=\"\" /></td></tr>";
					  
					  		echo $row;
				   		}
				   ?>
				   
                 </table>
				 <input type="hidden" name="check" id="checkthis2" value="" />
               </div><br>
<br>
<a href="javascript:selectAllBoxes('detail_','guardreport')" title="Click to select all the above options.">Select All</a></td>
               </tr>
            <tr>
              <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td height="110" valign="top"><div id="reportdetails">&nbsp;</div></td>
                </tr>
                <tr>
                  <td><input type="submit" name="Report" id="Report" value="&gt;&gt; Generate Report"></td>
                </tr>
              </table></td>
            </tr>
            
            <tr>
              <td colspan="5"><hr color="#CCCCCC"></td>
              </tr>
			  <?php  if(isset($formvalues)) { ?>
			  <tr><td colspan="5">
              <div id="printresults_div">
                <?php
			  if($_SESSION['reporttype'] == "Client Invoice"){ 
			  	$wherestr = "";
			  	$invoice = getRowAsArray("SELECT name, plotno, boxno, genphone, contphone, email  FROM clients WHERE isactive = 'Y' AND name = '".$formvalues['clientname']."'");
			 ?>
                <table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000066" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr bgcolor="#CCCCCC">
        <td><span style="font-size:24px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold">Profoma Invoice <?php if(in_array("11",$formvalues['detail'])){?>For <?php echo $invoice['name']; } ?></span></td>
        <td><?php if(in_array("36",$formvalues['detail'])){?><b>Date:</b> <?php echo date("d-M-Y",strtotime("now")); } else { echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="label"><?php if(in_array("34",$formvalues['detail'])){?>Plot <?php echo $invoice['plotno'];?><br />
          P.O.Box <?php echo $invoice['boxno'];?><br>
          Tel: <?php echo $invoice['genphone'];?><br>
		  Mobile: <?php echo $invoice['contphone'];?><br>
          Email: <?php echo $invoice['email'];?><br> 
		  Contact Person: <?php echo $invoice['contname']; } else { echo "&nbsp;";} ?></td>
        <td valign="top"><?php if(in_array("33",$formvalues['detail'])){?><b class="label">Duration:</b><br>
          <?php echo date("d-M-Y",strtotime($formvalues['start_day']."-".$formvalues['start_month']."-".$formvalues['start_year']));?> <b class="label">To</b> <?php echo date("d-M-Y",strtotime($formvalues['end_day']."-".$formvalues['end_month']."-".$formvalues['end_year'])); } ?></td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td>
	<div style="padding:4px;width:97%;height:300px;overflow: auto">
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr style="font-family: tahoma;
	font-size: 12px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
        <?php if(in_array("29",$formvalues['detail']) || in_array("35",$formvalues['detail'])){?>
		<td width="28%">Assignment</td>
		<td width="14%">QTY</td>
		<?php } ?>
		<?php if(in_array("32",$formvalues['detail'])){?>
        <td width="16%">Rate (Shs) </td>
		<?php } ?>
		<td width="42%">Charge (Shs) </td>
      </tr>
	  <?php 
	  $result = mysql_query("SELECT callsign, servicetype,assignedguards, enddate, startdate,rate,amountdue,exception FROM assignments WHERE client = '".$formvalues['clientname']."'");
	  $i = 0;
	  $total = 0;
	  while($line = mysql_fetch_array($result,MYSQL_ASSOC)){
	  	if(($i%2)==0) {
			$rowclass = "oddrow";
		} else {
			$rowclass = "evenrow";
		}
		
		
		
		//If the assignment was for alarm only
		if(preg_match("/alarm/i", $line['servicetype'])){ 
			$alarmresult = mysql_query("SELECT * FROM alarms WHERE assignment='".$line['callsign']."' AND status <> 'decommissioned'");
			
			while($row = mysql_fetch_array($alarmresult, MYSQL_ASSOC)){
			
			if(($i%2)==0) {
			$rowclass = "oddrow";
		} else {
			$rowclass = "evenrow";
		}
		?>
		<tr class="<?php echo $rowclass;?>">
        <?php if(in_array("29",$formvalues['detail']) || in_array("35",$formvalues['detail'])){?><td><?php if(in_array("29",$formvalues['detail'])){ echo $line['callsign']; }?> <?php if(in_array("35",$formvalues['detail'])){ echo "(".$line['servicetype'].")"; } ?> </td>
		<?php } ?>
		<?php if(in_array("32",$formvalues['detail'])){ ?>
        <td><?php 
		if(trim($row['systemsinstalled']) != ""){
			$systemsids = split(",",$row['systemsinstalled']);
			echo count($systemsids)." (";
			for($k=0;$k<count($systemsids);$k++){
				$systemdetails = getRowAsArray("SELECT * FROM equipmentdetails WHERE id='".$systemsids[$k]."'");
				if($k != 0){ echo ", ";}
				echo $systemdetails['name'];
			}			
			echo ")";
		}
		?></td>
        <?php } ?>
        <?php if(in_array("32",$formvalues['detail'])){ ?><td><?php echo commify($row['rate']);?></td><?php } ?>
        <?php if(in_array("30",$formvalues['detail'])){ ?><td><?php 
		if($line['expirydate'] != "0000-00-00"){
			$startdate = $line['expirydate'];
		} else {
			$startdate = $line['startdate'];
		}
		//Get the days from start to finish minus the exception days 
		$formvalues['startdate'] = trim(changeDateFromPageCombosToMySQLFormat($formvalues['start_day'], $formvalues['start_month'], $formvalues['start_year']),"'");
		$formvalues['enddate'] = trim(changeDateFromPageCombosToMySQLFormat($formvalues['end_day'], $formvalues['end_month'], $formvalues['end_year']),"'");
		
		//If the selected start date is before the actual alarm start date, reset to the 
		//alarm start date.
		if(strtotime($startdate) > strtotime($formvalues['startdate'])){
			$formvalues['startdate'] = $startdate;
		}
		
		$days_array = getDayDifference($formvalues['startdate'],$line['startdate'],$formvalues['enddate'],$line['enddate']);
		$sub_total = $days_array[0]*$row['rate'];
		
		//Save the subtotals to get the total
		$total += ($sub_total + $amountdue);
		echo commify($sub_total); $i++;
		?></td><?php } ?>
      </tr>
		<?php }//End of while loop
		
		//Both guard and alarm
		} else if(preg_match("/both/i", $line['servicetype'])){ 
		
		$alarmresult = mysql_query("SELECT * FROM alarms WHERE assignment='".$line['callsign']."' AND status <> 'decommissioned'");
			
			while($row = mysql_fetch_array($alarmresult, MYSQL_ASSOC)){
				if(($i%2)==0) {
					$rowclass = "oddrow";
				} else {
					$rowclass = "evenrow";
				} ?>
			<tr class="<?php echo $rowclass; ?>">
        <?php if(in_array("29",$formvalues['detail']) || in_array("35",$formvalues['detail'])){?><td><?php if(in_array("29",$formvalues['detail'])){ echo $line['callsign']; }?> <?php if(in_array("35",$formvalues['detail'])){ echo "(".$line['servicetype'].")"; } ?> </td>
		<?php } ?>
		<?php if(in_array("32",$formvalues['detail'])){ ?>
        <td><?php 
		//Display for alarm system
		if(trim($row['systemsinstalled']) != ""){
			$systemsids = split(",",$row['systemsinstalled']);
			echo "<br>".count($systemsids)." (";
			for($k=0;$k<count($systemsids);$k++){
				$systemdetails = getRowAsArray("SELECT * FROM equipmentdetails WHERE id='".$systemsids[$k]."'");
				if($k != 0){ echo ", ";}
				echo $systemdetails['name'];
			}			
			echo ")";
		}
		?></td>
        <?php } ?>
        <?php if(in_array("32",$formvalues['detail'])){ ?><td><?php echo commify($line['rate'])." (for Guards)<br>";
		echo commify($row['rate'])." (for Alarm System)<br>";
		?></td><?php } ?>
        <?php if(in_array("30",$formvalues['detail'])){ ?><td><?php 
		if($line['expirydate'] != "0000-00-00"){
			$startdate = $line['expirydate'];
		} else {
			$startdate = $line['startdate'];
		}
		//Get the days from start to finish minus the exception days 
		$formvalues['startdate'] = trim(changeDateFromPageCombosToMySQLFormat($formvalues['start_day'], $formvalues['start_month'], $formvalues['start_year']),"'");
		$formvalues['enddate'] = trim(changeDateFromPageCombosToMySQLFormat($formvalues['end_day'], $formvalues['end_month'], $formvalues['end_year']),"'");
		
		//If the selected start date is before the actual alarm start date, reset to the 
		//alarm start date.
		if(strtotime($startdate) > strtotime($formvalues['startdate'])){
			$formvalues['startdate'] = $startdate;
		}
		
		$days_array = getDayDifference($formvalues['startdate'],$line['startdate'],$formvalues['enddate'],$line['enddate']);
		$sub_total = $days_array[0]*$row['rate'];
		
		//Save the subtotals to get the total
		$total += ($sub_total + $amountdue);
		echo "Alarm: ".commify($sub_total);$i++;
		?></td><?php } ?>
      </tr>
			
			
			
		<?php   }
		?>
		<tr class="<?php echo $rowclass; ?>">
        <?php if(in_array("29",$formvalues['detail']) || in_array("35",$formvalues['detail'])){?><td><?php if(in_array("29",$formvalues['detail'])){ echo $line['callsign']; }?> <?php if(in_array("35",$formvalues['detail'])){ echo "(".$line['servicetype'].")"; } ?> </td>
		<?php } ?>
		<?php if(in_array("32",$formvalues['detail'])){ ?>
        <td><?php 
		//Dispplay for guards
		echo commify($line['assignedguards'])." guards";
		
		?></td>
        <?php } ?>
        <?php if(in_array("32",$formvalues['detail'])){ ?><td><?php echo commify($line['rate'])." (for Guards)<br>";
		echo commify($row['rate'])." (for Alarm System)<br>";
		?></td><?php } ?>
        <?php if(in_array("30",$formvalues['detail'])){ ?><td><?php 
		//Get the days from start to finish minus the exception days 
		$formvalues['startdate'] = trim(changeDateFromPageCombosToMySQLFormat($formvalues['start_day'], $formvalues['start_month'], $formvalues['start_year']),"'");
		$formvalues['enddate'] = trim(changeDateFromPageCombosToMySQLFormat($formvalues['end_day'], $formvalues['end_month'], $formvalues['end_year']),"'");
		
		$rawexception = split(",",$line['exception']);
		$cleanarray = array();
		$days_array = getDayDifference($formvalues['startdate'],$line['startdate'],$formvalues['enddate'],$line['enddate']);
		for($j=0;$j<count($rawexception);$j++){
			if((strtotime($days_array[1]) < strtotime($rawexception[$j])) && (strtotime($days_array[2]) > strtotime($rawexception[$j]))){
				array_push($cleanarray,$rawexception[$j]);
			}
		}
		
		//Returns array with day diff, right start date, right end date
		$daydiff = $days_array[0] - count($cleanarray);
		
		//Returns the overtime worked at that client's place
		$overtimeresult = mysql_query("SELECT overtimeentry FROM guardschedule WHERE overtimeentry LIKE '%".$line['callsign']."%' AND dateentered >= '".date("Y-m-d",strtotime($days_array[1]))."' AND dateentered <= '".date("Y-m-d",strtotime($days_array[2]))."'");
		$overtimedays = 0;
		//Go through all the overtime entries collecting all those with the set callsign
		while($set = mysql_fetch_array($overtimeresult,MYSQL_ASSOC)){
			
			$overtimearray = split(",",$set['overtimeentry']);
			for($i=0;$i<count($overtimearray);$i++){
				$overtimedata = split("=",$overtimearray[$i]);
				if(trim($overtimedata[1]) == $line['callsign']){
					$overtimedays++;
				}
			}
		}
		$sub_total = $daydiff*$line['rate']  + $overtimedays*$line['rate'];
		if($sub_total < 0){ $sub_total = 0;}
		$amountdue = 0;
		
		//Save the subtotals to get the total
		$total += ($sub_total + $amountdue);
		//echo "Guards: ".commify($sub_total);
		
		//i++;
		?></td><?php } ?>
      </tr>
			
			
			
		<?php 
		
		//Guard invoice
		} else if(preg_match("/shift/i", $line['servicetype'])){ ?>
      <tr class="<?php echo $rowclass; ?>">
        <?php if(in_array("29",$formvalues['detail']) || in_array("35",$formvalues['detail'])){?><td><?php if(in_array("29",$formvalues['detail'])){ echo $line['callsign']; }?> <?php if(in_array("35",$formvalues['detail'])){ echo "(".$line['servicetype'].")"; } ?> </td>
		<?php } ?>
		<?php if(in_array("32",$formvalues['detail'])){ ?>
        <td><?php echo commify($line['assignedguards'])." guards";?></td>
        <?php } ?>
        <?php if(in_array("32",$formvalues['detail'])){ ?><td><?php echo commify($line['rate']);?></td><?php } ?>
        <?php if(in_array("30",$formvalues['detail'])){ ?><td><?php 
		//Get the days from start to finish minus the exception days 
		$formvalues['startdate'] = trim(changeDateFromPageCombosToMySQLFormat($formvalues['start_day'], $formvalues['start_month'], $formvalues['start_year']),"'");
		$formvalues['enddate'] = trim(changeDateFromPageCombosToMySQLFormat($formvalues['end_day'], $formvalues['end_month'], $formvalues['end_year']),"'");
		
		$rawexception = split(",",$line['exception']);
		$cleanarray = array();
		$days_array = getDayDifference($formvalues['startdate'],$line['startdate'],$formvalues['enddate'],$line['enddate']);
		for($j=0;$j<count($rawexception);$j++){
			if((strtotime($days_array[1]) < strtotime($rawexception[$j])) && (strtotime($days_array[2]) > strtotime($rawexception[$j]))){
				array_push($cleanarray,$rawexception[$j]);
			}
		}
		
		//Returns array with day diff, right start date, right end date
		$daydiff = $days_array[0] - count($cleanarray);
		
		//Returns the overtime worked at that client's place
		$overtimeresult = mysql_query("SELECT overtimeentry FROM guardschedule WHERE overtimeentry LIKE '%".$line['callsign']."%' AND dateentered >= '".date("Y-m-d",strtotime($days_array[1]))."' AND dateentered <= '".date("Y-m-d",strtotime($days_array[2]))."'");
		$overtimedays = 0;
		//Go through all the overtime entries collecting all those with the set callsign
		while($set = mysql_fetch_array($overtimeresult,MYSQL_ASSOC)){
			
			$overtimearray = split(",",$set['overtimeentry']);
			for($i=0;$i<count($overtimearray);$i++){
				$overtimedata = split("=",$overtimearray[$i]);
				if(trim($overtimedata[1]) == $line['callsign']){
					$overtimedays++;
				}
			}
		}
		$sub_total = $daydiff*$line['rate']  + $overtimedays*$line['rate'];
		if($sub_total < 0){ $sub_total = 0;}
		$amountdue = 0;
		
		//Save the subtotals to get the total
		$total += ($sub_total + $amountdue);
		echo commify($sub_total);$i++;
		?></td><?php } ?>
      </tr>
	  <?php  } 
	  
	  	
	  } 
	  //Total charge of the invoice
	  if(in_array("31",$formvalues['detail'])){ 
	  ?>
      <tr bgcolor="#CCCCCC">
        <td><b class="label2">Total Charge </b></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><b><?php echo commify($total);?></b></td>
      </tr>
	  <?php } ?>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">Profoma Invoice on <b><?php echo date("d-M-Y");?></b> &nbsp;|&nbsp; &nbsp;&nbsp; Generated by <b><?php echo $_SESSION['names'];?></b></td>
        </tr>
    </table>
	</div></td>
  </tr>
</table>
              </div>			  
			  <?php 
			  } else if($_SESSION['reporttype'] == "Guard Payroll"){ 
			  	
				?>
			  <table width="100%" border="0" cellpadding="5" cellspacing="2">
  <tr>
    <td colspan="5"><?php echo $_SESSION['reporttype']; ?> Report for the period <b><?php echo date("d-M-Y",strtotime(trim($formvalues['startdate'],"'")));?> TO <?php echo date("d-M-Y",strtotime(trim($formvalues['enddate'],"'")));?></b> &nbsp;|&nbsp; &nbsp;&nbsp; Generated by <b><?php echo $_SESSION['names'];?></b></td>
  </tr>
  <tr>
    <td><div style="padding:4px;width:720px;height:400px;overflow: auto" id="printresults_div">
	<table width="100%" border="0" cellspacing="0" cellpadding="2" style="border: 1px; 
	border-style: solid;
	border-color: #adaefe">
      <?php 
//**********************************************************************************************			// If the report is for payroll of the guards
//**********************************************************************************************
			  if($_SESSION['reporttype'] == "Guard Payroll"){
			  	$query = "SELECT g.id, g.guardid, g.rate,g.lastpaymentdate,g.financialstatus, p.firstname,p.lastname,p.othernames FROM guards g, persons p WHERE g.personid = p.id AND g.isarchived = 'N'";	
 			  }
//**********************************************************************************************			// Exceute queries
//**********************************************************************************************
			  if(howManyRows($query) == 0){
			  	echo "<tr><td>Sorry. There are no results for your report.</td></tr>";
			  } else {
			  ?>
      <tr style="font-family: tahoma;
	font-size: 11px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
        <?php if(in_array("44",$formvalues['detail'])){?>
        <td>Guard ID </td>
        <?php } ?>
        <?php if(in_array("43",$formvalues['detail'])){?>
        <td>Guard Name</td>
        <?php } ?>
        <?php if(in_array("45",$formvalues['detail'])){?>
        <td>Gross Payment <br>(Shs) </td>
        <?php } ?>
        <?php if(in_array("50",$formvalues['detail'])){?>
		<td>Leave<br>(Days)</td>
        <?php } ?>
		<?php if(in_array("51",$formvalues['detail'])){?>
		<td>Overtime</td>
		<?php } ?>
		<?php if(in_array("48",$formvalues['detail'])){?>
        <td>Deductions <br>(Shs) </td>
        <?php } ?>
		<?php if(in_array("46",$formvalues['detail'])){?>
        <td>Bonuses <br>(Shs) </td>
        <?php } ?>
		<?php if(in_array("47",$formvalues['detail'])){?>
        <td>Net Payment <br> (Shs) </td>
        <?php } ?>
      </tr>
      <?php 
				$i = 0;
				$totalamount = 0;
				$totalovertimeamount = 0;
				$totalotheramount = 0;
				$totalnssfamount = 0;
				$totalpayeamount = 0;
				$totalbonusamount = 0;
				
				$result1 = mysql_query($query);
				$numrows = mysql_num_rows($result1);
				while($line=mysql_fetch_array($result1,MYSQL_ASSOC)){
					if(($i%2)==0) {
				     	$rowclass = "oddrow";
				 	} else {
				     	$rowclass = "evenrow";
				 	}
				?>
      <tr class="<?php echo $rowclass; ?>">
        <?php if(in_array("44",$formvalues['detail'])){?>
        <td valign="top"><?php echo $line['guardid'];?></td>
        <?php } ?>
        <?php if(in_array("43",$formvalues['detail'])){?>
        <td valign="top"><?php echo $line['firstname']." ".$line['lastname']." ".$line['othernames'];?></td>
        <?php } ?>
        <?php if(in_array("45",$formvalues['detail'])){?>
        <td valign="top"><?php $grossamount = getGuardCharge($line['guardid'],$formvalues['startdate'],$formvalues['enddate']);
		echo commify($grossamount);?></td>
		<?php } ?>
		<?php if(in_array("50",$formvalues['detail'])){?>
		<td align="center" valign="top"><?php $leavedays=getGuardLeaveDays($line['guardid'],$formvalues['startdate'],$formvalues['enddate']);
			echo $leavedays;?></td>
		<?php } ?>
		<?php if(in_array("51",$formvalues['detail'])){?>
		<td valign="top"><?php $overtime=getGuardOvertimePay($line['guardid'],$formvalues['startdate'],$formvalues['enddate']);
			echo commify($overtime);
			$totalovertimeamount += $overtime;
			?></td>
		<?php } ?>
		
		<?php if(in_array("48",$formvalues['detail'])){?>
        <td valign="top"><?php 
		$otheramount = getGuardFinance($line['financialstatus'],$formvalues['startdate'],$formvalues['enddate'],"Deduction");
		$nssfamount = $grossamount*$settings['employeenssfrate']/100;
		$payeamount = generatePAYEAmount($grossamount,"local");
		
		echo "Other (".commify($otheramount).") <br>NSSF (".commify($nssfamount).") <br>PAYE (".commify($payeamount).")"; 
		$totalotheramount += $otheramount;
		$totalnssfamount += $nssfamount;
		$totalpayeamount += $payeamount;
		
		?></td>
        <?php } ?>
		<?php if(in_array("46",$formvalues['detail'])){?>
        <td valign="top"><?php 
		$bonusamount = getGuardFinance($line['financialstatus'],$formvalues['startdate'],$formvalues['enddate'],"Bonus");
		echo commify($bonusamount);
		
		$totalbonusamount += $bonusamount;
		?></td>
        <?php } ?>
		<?php if(in_array("47",$formvalues['detail'])){?>
        <td valign="top"><?php 
		$amount = $grossamount + $overtime + getGuardFinance($line['financialstatus'],$formvalues['startdate'],$formvalues['enddate'],"Bonus") - (getGuardFinance($line['financialstatus'],$formvalues['startdate'],$formvalues['enddate'],"Deduction") + $grossamount*$settings['employeenssfrate']/100 + generatePAYEAmount($grossamount,"local"));
			echo commify($amount);
			//Add up the total amount to be paid
			$totalamount += $amount;
			?></td>
        <?php } ?>
      </tr>
      <?php $i++; } ?>
	  <?php if(in_array("49",$formvalues['detail'])){ ?>
	  <tr style="font-family: tahoma;
	font-size: 11px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
		<td colspan="2">TOTAL AMOUNT </td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td><?php echo "<b>".commify($totalovertimeamount)."</b>"; ?></td>
	    <td><?php echo "Other: <b>".commify($totalotheramount)."</b><br>";
		echo "NSSF: <b>".commify($totalnssfamount)."</b><br>";
		echo "PAYE: <b>".commify($totalpayeamount)."</b><br>";
		 ?></td>
	    <td><?php echo "<b>".commify($totalbonusamount)."</b>"; ?></td>
	    <td><?php echo "<b>".commify($totalamount)."</b>"; ?></td>
	  </tr>
	  <?php } ?>
    </table>
    </div></td>
  </tr>
  <?php  } ?>
</table><?php 

//=========================================================================================
// If the report is a ledger report
//=========================================================================================
} else if($_SESSION['reporttype'] == "Ledger Report"){ 
	
	$formvalues['startdate'] = changeDateFromPageCombosToMySQLFormat($formvalues['start_day'], $formvalues['start_month'], $formvalues['start_year']);
	$formvalues['enddate'] = changeDateFromPageCombosToMySQLFormat($formvalues['end_day'], $formvalues['end_month'], $formvalues['end_year']);
		
	$query = "SELECT * FROM transactions WHERE date_of_entry >= ".$formvalues['startdate']." AND date_of_entry <= ".$formvalues['enddate']." AND type='outflow' ORDER BY date_of_entry DESC";
?>
		<table width="100%" border="0" style="border: 1px; 
	border-style: solid;
	border-color: #adaefe" cellpadding="2" cellspacing="0">
                    <tr style="font-family: tahoma;
	font-size: 12px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
                      <?php if(in_array("52",$formvalues['detail'])){?>
					  <td width="13%">Particulars</td>
					  <?php } ?>
					  <?php if(in_array("53",$formvalues['detail'])){?>
					  <td width="13%">Account</td>
					  <?php } ?>
					  <?php if(in_array("54",$formvalues['detail'])){?>
                      <td width="21%">Amount</td>
					  <?php } ?>
					  <?php if(in_array("55",$formvalues['detail'])){?>
                      <td width="18%">Date</td>
					  <?php } ?>
					  <?php if(in_array("56",$formvalues['detail'])){?>
                      <td width="18%">Received By</td>
					  <?php } ?>
					  <?php if(in_array("57",$formvalues['detail'])){?>
                      <td width="18%">Passed By</td>
					  <?php } ?>
					  <?php if(in_array("58",$formvalues['detail'])){?>
                      <td width="18%">Payment Form </td>
					  <?php } ?>
                    </tr>
                    <?php
			  // Display the transactions
			  $result = mysql_query($query);
			  $i = 0;
			   while($line=mysql_fetch_array($result, MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     	$rowclass = "oddrow";
				 	} else {
				     	$rowclass = "evenrow";
				 	}
			   ?>
                    <tr class="<?php echo $rowclass; ?>">
                     <?php if(in_array("52",$formvalues['detail'])){?>
					  <td><?php echo $line['particulars']; ?></td>
					  <?php } ?>
					  <?php if(in_array("53",$formvalues['detail'])){?>
					  <td><?php 
					  $accountdetails = getRowAsArray("SELECT * FROM accounts WHERE id='".$line['account']."'");
					  echo "<b>".$accountdetails['accountname']."</b>"; ?></td>
					  <?php } ?>
					  <?php if(in_array("54",$formvalues['detail'])){?>
                      <td><?php echo commify($line['amount']); ?></td>
					  <?php } ?>
					  <?php if(in_array("55",$formvalues['detail'])){?>
                      <td><?php 
				if($line['date_of_entry'] != "0000-00-00 00:00:00"){
					echo date("d-M-Y",strtotime($line['date_of_entry']));
				}
				?>
                      </td>
					  <?php } ?>
					  <?php if(in_array("56",$formvalues['detail'])){?>
                      <td><?php echo $line['receivedby']; ?></td>
					  <?php } ?>
					  <?php if(in_array("57",$formvalues['detail'])){?>
					  <td><?php echo $line['passedby']; ?></td>
					  <?php } ?>
					  <?php if(in_array("58",$formvalues['detail'])){?>
                      <td><?php echo $line['paymentform']; ?></td>
					  <?php } ?>
                    </tr>
                    <?php 
			  $i++;
			  } ?>
                  </table>
<?php } ?>
             </td> </tr>
            <tr>
              <td align="right" class="label">&nbsp;</td>
              <td colspan="4">&nbsp;</td>
            </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="3"><input type="button" name="cancel" id="cancel" value="Cancel" onClick="javascript:window.location.href='../core/dashboard.php';">
			<input type="button" name="Button" id="submit" value="Print"  onClick="openPopWindow(600,350,'Financial Report','print')">
			<b class="label"> [ Export &gt;&gt; <a href="#"   onClick="openPopWindow(600,350,'Financial Report','msword')" title="Export report to MS Word"><img src="../images/mswordimg.gif" width="16" height="16" border="0"></a>&nbsp;&nbsp;<a href="#"   onClick="openPopWindow(600,350,'Financial Report','msexcel')" title="Export report to MS Excel"><img src="../images/msexcelimg.gif" width="16" height="16" border="0"></a> ] </b></td>
          </tr>

<?php } ?>				
        </table>		  
        </form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include("../include/footer.php");?>&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
