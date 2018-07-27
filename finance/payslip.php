<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_GET['id'])){
	$id = decryptValue($_GET['id']);	
}

// View the payslip
if(isset($_POST['viewpayslip'])){
	$formvalues = array_merge($_POST);
	$id = $formvalues['guardid'];
	//Get the last date in the selected month
	$lastday = mktime(0, 0, 0, (date("m",strtotime($formvalues['viewmonth']))+1), 0, $formvalues['viewyear']);
	$formvalues['viewdate'] = date("d-M-Y",$lastday);
	
	
}

$data = getRowAsArray("SELECT g.guardid, g.financialstatus, g.lastpaymentdate, g.dateofemployment, p.firstname,p.lastname,p.othernames  FROM guards g, persons p WHERE g.personid = p.id AND g.guardid='".$id."'");

//Get the global settings to customise the form
$settings = getRowAsArray("SELECT * FROM settings");

//use the appropriate start date
if(isset($formvalues['includeoutstanding'])){
	$startdate = $data['lastpaymentdate'];
} else {
	$startdate = "01-".$formvalues['viewmonth']."-".$formvalues['viewyear'];
}

//use the appropriate end date
//if this month is not the selected month
$selectedstartdate = "01-".$formvalues['viewmonth']."-".$formvalues['viewyear'];
if(date("M-Y") != date("M-Y",strtotime($selectedstartdate))){
	$enddate = $formvalues['viewdate'];
} else {
	$enddate = "";
}


//************************************************************
//Extracting the other deductions and bonuses
//Set the financial status based on IDs from the DB
//************************************************************
if(trim($data['financialstatus']) != ""){
	$combinedarray = split(",",trim($data['financialstatus']));
	
	//Classify approved bonuses or deductions in multi-dimensional arrays
	$bonusarray = array();
	$deductionarray = array();
	$bonustotal = 0;
	$deductiontotal = 0;
	//Set the operational dates for the calculations
	if($startdate != ""){
		$viewstartdate = $startdate;
	} else {
		$viewstartdate = $data['dateofemployment'];
	}
	
	$viewenddate = $formvalues['viewdate'];
	
	for($i=0;$i<count($combinedarray);$i++){
		$financedata = getRowAsArray("SELECT * FROM guardfinance WHERE id='".$combinedarray[$i]."'");
		if($financedata['approved'] == "Y" && (strtotime($financedata['date']) >= strtotime($viewstartdate)) && (strtotime($financedata['date']) <= strtotime($viewenddate))){
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
	
	//Determine which array to use when counting
	if(count($deductionarray) > count($bonusarray)){
		$formvalues['countlength'] = count($deductionarray);
	} else {
		$formvalues['countlength'] = count($bonusarray);
	}
}

//Put all necessary values in session for access when exporting
$formvalues['startdate'] = $startdate;
$formvalues['enddate'] = $enddate;
$formvalues['bonusarray'] = $bonusarray;
$formvalues['deductionarray'] = $deductionarray;
$formvalues['bonustotal'] = $bonustotal;
$formvalues['deductiontotal'] = $deductiontotal;
$_SESSION['formvalues'] = $formvalues;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Generate Pay Slip for <?php echo getGuardNameById($id);?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings"><a href="../finance/manageguardfinance.php">Manage Guard Finances</a> &gt; Generate Pay Slip for <?php echo getGuardNameById($id);?></td>
      </tr>
      <tr>
        <td><form action="../finance/payslip.php" method="post" name="form1" id="form1" onSubmit="return isNotNullOrEmptyString('viewmonth', 'Please select the pay month.') && isNotNullOrEmptyString('viewyear', 'Please select the pay year.');"><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td width="18%" align="right">&nbsp;</td>
            <td width="82%" class="redtext"><?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != ""){ echo $_SESSION['msg'];
			$_SESSION['msg'] = "";
			}?></td>
          </tr>
		  <tr>
            <td width="18%">&nbsp;</td>
            <td width="82%">&nbsp;</td>
          </tr>
		  
		  <tr>
            <td width="18%" align="right" class="label">Select Pay Month: </td>
            <td width="82%" class="label">Month:
              <select id="viewmonth" name="viewmonth">
  <?php 
				   if(isset($formvalues['viewdate']) && trim($formvalues['viewdate']) != ""){
	$date = date("F", strtotime($formvalues['viewdate']));
} else {
	$date = date("F", strtotime("now"));
}
				   echo generateSelectOptions(getTime('month',''), $date);?>
</select>
&nbsp;Year:
<select id="viewyear" name="viewyear">
  <?php 
				    if(isset($formvalues['viewdate']) && trim($formvalues['viewdate']) != ""){
	$date = date("Y", strtotime($formvalues['viewdate']));
} else {
	$date = date("Y", strtotime("now"));
}
				   echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select></td>
          </tr>
		  
			<tr>
			  <td>&nbsp;</td>
			  <td class="label">
			    <input type="checkbox" name="includeoutstanding" id="includeoutstanding" value="Y" <?php if(!isset($formvalues['includeoutstanding']) && isset($_POST['viewpayslip'])){ //Do nothing 
				} else { echo "checked";}?>>
			    Include Outstanding Payments</td>
			</tr>
			
			<tr>
			  <td align="right" class="label">&nbsp;</td>
			  <td><input type="submit" name="viewpayslip" id="viewpayslip" value="View Pay Slip &gt;&gt;"></td>
			  </tr>
			<tr>
			  <td align="right" class="label">&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr>
			  <td colspan="2"><?php if(isset($_POST['viewpayslip'])){ ?>
			  <div id="printresults_div">
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
</table>
			  </div>
			    <?php }?></td>
			  </tr>
			<tr>
			  <td align="right" class="label">&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr>
			  <td align="right" class="label">&nbsp;</td>
			  <td class="label"><?php 
			if(isset($_POST['viewpayslip'])){ ?>
			    <input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">&nbsp;
                <input type="button" name="print" id="print" value="Print"  onClick="openPopWindow(600,350,'Guard Print Report','print')"><b> [ Export &gt;&gt; <a href="#"   onClick="openPopWindow(600,350,'Payslip Report','msword')" title="Export report to MS Word"><img src="../images/mswordimg.gif" width="16" height="16" border="0"></a>&nbsp;&nbsp;<a href="#"   onClick="openPopWindow(600,350,'Payslip Report','msexcel')" title="Export report to MS Excel"><img src="../images/msexcelimg.gif" width="16" height="16" border="0"></a> ] 
                <?php } ?>
                <input type="hidden" name="guardid" id="guardid" value="<?php echo $id;?>"></td>
			  </tr>
        </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include("../include/footer.php");?></a></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
