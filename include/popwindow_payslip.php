<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if($_GET['type'] == "msword" || $_GET['type'] == "msexcel"){
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

//Get the global settings to customise the form
$settings = getRowAsArray("SELECT * FROM settings");

//Get the selected guards whose payslip you are going to generate
$selectedguards = array();
$guardid = $formvalues['guardid'];
if(isset($_SESSION['selectedguards']) && count($_SESSION['selectedguards']) > 0){
	$selectedguards = $_SESSION['selectedguards'];
} else {
	array_push($selectedguards, $guardid);
}

//If the person is coming from the single payslip form
if(isset($formvalues['startdate'])){
	$startdate = $formvalues['startdate'];
	if($formvalues['enddate'] != "" && $formvalues['enddate'] != "0000-00-00 00:00:00"){
		$enddate = $formvalues['enddate'];
	} else {
		$enddate = date("d-M-Y", mktime(0, 0, 0, (date("m",strtotime("now"))+1), 0, date("Y",strtotime("now"))));
	}
	

//Generating many payslips
} else {
	$startdate = "01-".date("M")."-".date("Y");
	$enddate = date("d-M-Y", mktime(0, 0, 0, (date("m",strtotime("now"))+1), 0, date("Y",strtotime("now"))));
}

//Generate payslip for each guard
for($h=0;$h<count($selectedguards);$h++){
	$data = getRowAsArray("SELECT g.guardid, g.financialstatus, g.lastpaymentdate, g.dateofemployment, p.firstname,p.lastname,p.othernames  FROM guards g, persons p WHERE g.personid = p.id AND g.guardid='".$selectedguards[$h]."'");
	$id = $selectedguards[$h];
	
	if(trim($data['financialstatus']) != ""){
		$combinedarray = split(",",trim($data['financialstatus']));
	
		//Classify approved bonuses or deductions in multi-dimensional arrays
		$bonusarray = array();
		$deductionarray = array();
	
		for($i=0;$i<count($combinedarray);$i++){
			$financedata = getRowAsArray("SELECT * FROM guardfinance WHERE id='".$combinedarray[$i]."'");
			if($financedata['approved'] == "Y" && (strtotime($financedata['date']) >= strtotime($startdate)) && (strtotime($financedata['date']) <= strtotime($enddate))){
			
				$categorydetails = getRowAsArray("SELECT category FROM financecategories WHERE id='".$financedata['category']."'");
				if($financedata['type'] == "Bonus"){
				//Set all bonuses according to category
				
				//If the category is old
				if(isset($categorydetails['category']) && isset($bonusarray[$categorydetails['category']])){
					$bonusarray[$categorydetails['category']] += $financedata['amount'];
				
				//If the category is new
				} else if(isset($categorydetails['category'])){
					$bonusarray[$categorydetails['category']] = $financedata['amount'];
				
				//If the category doesnt exist
				} else {
					$bonusarray["Others"] += $financedata['amount'];
				}
				
				/*array_push($bonusarray,array($financedata['amount'],$financedata['reason'])); 
				$bonustotal += $financedata['amount'];*/
			}
			if($financedata['type'] == "Deduction"){
				//Set all deductions according to category
				
				//If the category is old
				if(isset($categorydetails['category']) && isset($deductionarray[$categorydetails['category']])){
					$deductionarray[$categorydetails['category']] += $financedata['amount'];
				
				//If the category is new
				} else if(isset($categorydetails['category'])){
					$deductionarray[$categorydetails['category']] = $financedata['amount'];
				
				//If the category doesnt exist
				} else {
					$deductionarray["Others"] += $financedata['amount'];
				}
				
				/*array_push($deductionarray,array($financedata['amount'],$financedata['reason'])); 
				$deductiontotal += $financedata['amount'];*/
			}
			}
		}
	}
	
	
	//Show the guard slips in the array
?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" style="border-color:#000000">
  <tr>
    <td style="background-color:#adaefe; border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px" nowrap><b>TIGER SECURITY<br>
CASUAL PAY</b></td>
    <td style="background-color:#adaefe; border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><b>WAGES DAYS WORKED </b></td>
    <td style="background-color:#adaefe; border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><b>BONUS</b></td>
    <td style="background-color:#adaefe; border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><b>OVERTIME EXTRA </b></td>
    <td style="background-color:#adaefe; border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><b>GROSS</b></td>
    <td style="background-color:#adaefe; border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><b>DEDUCIBLE</b></td>
    <td style="background-color:#adaefe;"><b>NET PAY </b></td>
  </tr>
  <tr>
    <td valign="top" style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px; border-bottom-color:#CCCCCC; border-bottom-style:solid; border-bottom-width:1px"><?php echo "".$id." &nbsp; ".getGuardNameById($id);?></td>
    <td valign="top" style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px; border-bottom-color:#CCCCCC; border-bottom-style:solid; border-bottom-width:1px"><?php 
						$amount = getGuardCharge($id,$startdate,$enddate);
						$totalamount = $amount;
					echo commify($amount);
					 ?></td>
    <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px; border-bottom-color:#CCCCCC; border-bottom-style:solid; border-bottom-width:1px" valign="top">
	<?php if(isset($bonusarray) && count($bonusarray) > 0){?>
	<table  border="0" cellspacing="0" cellpadding="0" width="200">
	<?php 
	
	foreach($bonusarray as $key => $value){
	/*for($k=0;$k<count($bonusarray);$k++){
		if(isset($bonusarray[$k][0]) && $bonusarray[$k][0] != ""){*/
	?>
	<tr><td><?php 
	echo $key;
	//echo $bonusarray[$k][1]; ?></td>
	<td width="1%"><?php 
	$totalamount += $value;
	echo " ".commify($value);
	
	//$totalamount += $bonusarray[$k][0];
						//echo " ".commify($bonusarray[$k][0]);?></td></tr>
	<tr><td colspan="2"><hr></td></tr>
	<?php }
	
	/*}
	
	}*/ ?>
	</table>
	<?php } else { echo "&nbsp;";} ?>	</td>
    <td valign="top" style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px; border-bottom-color:#CCCCCC; border-bottom-style:solid; border-bottom-width:1px"><?php $overtimeamount = getGuardOvertimePay($id,$startdate,$enddate);
	$totalamount += $overtimeamount;
	echo commify($overtimeamount);?></td>
    <td valign="top" style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px; border-bottom-color:#CCCCCC; border-bottom-style:solid; border-bottom-width:1px"><b><?php echo commify($totalamount);?></b></td>
    <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px; border-bottom-color:#CCCCCC; border-bottom-style:solid; border-bottom-width:1px" valign="top">
	<table  border="0" cellspacing="0" cellpadding="0" width="200">
	<tr><td>PAYE Tax</td><td><?php $paye = generatePAYEAmount($totalamount,"local");
						echo "(".commify($paye).")";
					?></td></tr>
	<tr><td colspan="2"><hr></td></tr>
	<tr><td>Social Security Fund</td><td><?php 
						$nssf = round($totalamount*($settings['employeenssfrate']/100));
						echo "(".commify($nssf).")";
					?></td></tr>
	<tr><td colspan="2"><hr></td></tr>
	<?php 
	//Initialise the deductions and add any other deductions to set figure
	$totaldeduction = $paye + $nssf;
	
	/*for($k=0;$k<count($deductionarray);$k++){
		if(isset($deductionarray[$k][1]) && $deductionarray[$k][1] != ""){*/
	foreach ($deductionarray AS $key=>$value){
		
	?>
	<tr><td><?php 
	echo $key;
	//echo $deductionarray[$k][1];?></td>
	<td width="1%"><?php 
					$totaldeduction += $value;
					echo " (".commify($value).")";
					//$totaldeduction += $deductionarray[$k][0];
						//echo " (".commify($deductionarray[$k][0]).")";
						?></td></tr>
		<tr><td colspan="2"><hr></td></tr>
	<?php 
	}
	/*} }*/ ?>
	</table>	</td>
    <td valign="top" style="border-bottom-color:#CCCCCC; border-bottom-style:solid; border-bottom-width:1px"><b><?php $netamount = $totalamount - $totaldeduction;
	
	if($netamount < 0){
		echo "(".commify(substr($netamount,1)).")";
	} else {
		echo commify($netamount);
	}
	?></b></td>
  </tr>
  <tr><td colspan="7"><span style="font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #666666;">CUT ALONG THIS LINE</span></td></tr>
  <tr><td colspan="7" style="border-top-width: 1px;
	border-top-style: dashed;
	border-top-color: #999999;" height="5"></td></tr>
</table>
 <?php }
 
 	//}
 } ?>