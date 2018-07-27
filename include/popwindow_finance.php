<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
$settings = getRowAsArray("SELECT * FROM settings");

if(($_GET['type'] == "msword" || $_GET['type'] == "msexcel") && isset($_SESSION['formvalues']) && count($_SESSION['formvalues']) != 0){
$downloadtime = date("d-m-y-Hi")."Hrs";

// required for IE, otherwise Content-disposition is ignored
if(ini_get('zlib.output_compression'))
	ini_set('zlib.output_compression', 'Off');

if($_GET['type'] == "msword"){
	$filename = "SmartGuardDownload-".$downloadtime.".doc";
	# This line will stream the file to the user rather than spray it across the screen
	header("Content-type: application/vnd.ms-word");

} else if($_GET['type'] == "msexcel"){
	$filename = "SmartGuardDownload-".$downloadtime.".xls";
	header("Content-type: application/vnd.ms-excel");

}

# replace excelfile.xls with whatever you want the filename to default to
header("Content-Disposition: attachment;filename=".$filename);
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
$formvalues = $_SESSION['formvalues'];



if($_SESSION['reporttype'] == "Client Invoice"){ 
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
        <td><?php if(in_array("34",$formvalues['detail'])){?>Plot <?php echo $invoice['plotno'];?><br />
          P.O.Box <?php echo $invoice['boxno'];?><br>
          Tel: <?php echo $invoice['genphone'];?><br>
		  Mobile: <?php echo $invoice['contphone'];?><br>
          Email: <?php echo $invoice['email']; } else { echo "&nbsp;";} ?></td>
        <td valign="top"><?php if(in_array("33",$formvalues['detail'])){?><b>Duration:</b><br>
          <?php echo date("d-M-Y",strtotime($formvalues['start_day']."-".$formvalues['start_month']."-".$formvalues['start_year']));?> <b>To</b> <?php echo date("d-M-Y",strtotime($formvalues['end_day']."-".$formvalues['end_month']."-".$formvalues['end_year'])); } ?></td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr style="font-family: tahoma;
	font-size: 12px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
        <?php if(in_array("29",$formvalues['detail']) || in_array("35",$formvalues['detail'])){?>
		<td>Assignment</td>
        <td>QTY</td>
		<?php } ?>
		<?php if(in_array("32",$formvalues['detail'])){?>
        <td>Rate (Shs)</td>
		<?php } ?>
		<td>Charge (Shs) </td>
      </tr>
	  <?php 
	  $result = mysql_query("SELECT callsign, servicetype,assignedguards, enddate, startdate,rate,amountdue,exception FROM assignments WHERE client = '".$formvalues['clientname']."'");
	  $i = 0;
	  $total = 0;
	  while($line = mysql_fetch_array($result,MYSQL_ASSOC)){
	  	if(($i%2)==0) {
			$rowclass = "background-color:#FFFFFF";
		} else {
			$rowclass = "background-color:#CCCCCC; padding-bottom:2px";
		}
	  ?>
      <tr style="<?php echo $rowclass;?>">
        <?php if(in_array("29",$formvalues['detail']) || in_array("35",$formvalues['detail'])){?><td><?php if(in_array("29",$formvalues['detail'])){ echo $line['callsign']; }?> <?php if(in_array("35",$formvalues['detail'])){ echo "(".$line['servicetype'].")"; } ?> </td>
		<?php } ?>
		<?php if(in_array("32",$formvalues['detail'])){ ?>
        <td><?php echo number_format($line['assignedguards']);?></td>
        <?php } ?>
        <?php if(in_array("32",$formvalues['detail'])){ ?><td><?php echo number_format($line['rate']);?></td><?php } ?>
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
		echo number_format($sub_total);
		?></td><?php } ?>
      </tr>
	  <?php $i++;
	  
	  } 
	  //Total charge of the invoice
	  if(in_array("31",$formvalues['detail'])){ 
	  ?>
      <tr bgcolor="#CCCCCC">
        <td><b>Total Charge </b></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><b><?php echo number_format($total);?></b></td>
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
<?php
	//**********************************************************************************************
	// Guard Payroll
	//**********************************************************************************************
	} else if($_SESSION['reporttype'] == "Guard Payroll"){ 
			  	$formvalues['startdate'] = $_SESSION['startdate'];
				$formvalues['enddate'] = $_SESSION['enddate'];
				?>
			  <table width="100%" border="0" cellpadding="5" cellspacing="2">
  <tr>
    <td colspan="5"><?php echo $_SESSION['reporttype']; ?> Report for the period <b><?php echo date("d-M-Y",strtotime(trim($formvalues['startdate'],"'")));?> TO <?php echo date("d-M-Y",strtotime(trim($formvalues['enddate'],"'")));?></b> &nbsp;|&nbsp; &nbsp;&nbsp; Generated by <b><?php echo $_SESSION['names'];?></b></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2" style="border: 1px; 
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
		<td>Leave (Days)</td>
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
				     	$rowclass = "background-color:#FFFFFF";
				 	} else {
				     	$rowclass = "background-color:#CCCCCC; padding-bottom:2px";
				 	}
				?>
      <tr style="<?php echo $rowclass; ?>">
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
    
  <?php if(in_array("49",$formvalues['detail'])){ ?> <tr style="font-family: tahoma;
	font-size: 11px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
		<td>TOTAL </td>
	    <td>&nbsp;</td>
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
  <?php }
  
  } ?>
  </table></td>
  </tr>
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
				     	$rowclass = "background-color:#FFFFFF";
				 	} else {
				     	$rowclass = "background-color:#CCCCCC; padding-bottom:2px";
				 	}
			   ?>
                    <tr style="<?php echo $rowclass; ?>">
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
<?php 
      }

//**********************************************************************************************
// Print window
//**********************************************************************************************
} else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<script language="javascript">
function loadListFromParentWindow() {
	// load the results of the 
	document.getElementById("printresults_div").innerHTML = opener.document.getElementById("printresults_div").innerHTML;
	// change the title of this page to be the same as the opener
	document.title = <?php if(isset($_GET['title']) && trim($_GET['title']) != ""){ 
		echo "'".$_GET['title']."';";
	} else { 
		echo "opener.document.title;";
	}?>
}
</script>

<style type="text/css">
<!--
td {font-family: verdana;
	font-size: 11px;
	text-decoration: none;}
-->
</style>
</head>
<body onLoad="loadListFromParentWindow()">
<form name="contentform" id="contentform" method="post" action="popwindow_finance.php">
  <input name="print" type="button" value="Print" onClick="window.print()">
&nbsp;&nbsp;&nbsp;
<input name="close" type="button" value="Close Window" onClick="window.close()">
<br>
<br>
<div id="printresults_div"></div>
</form>
</body>
</html>
<?php } ?>