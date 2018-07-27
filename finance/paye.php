<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
// The query for guard information
$query = "SELECT g.id, g.guardid, g.tinno, g.rate,g.lastpaymentdate,g.financialstatus, p.firstname,p.lastname,p.othernames FROM guards g, persons p WHERE g.personid = p.id";
//The global settings for this package
$settings = getRowAsArray("SELECT companyname, companytinno FROM settings");

//If the user had edited some of the information
if(isset($_POST['save'])){
	$formvalues = array_merge($_POST);
	
	// Update PAYE guard numbers
	for($i=0;$i<count($formvalues['tin']);$i++){
		mysql_query("UPDATE guards SET tinno = '".$formvalues['tin'][$i]."' WHERE id = '".$formvalues['id'][$i]."'");
	}
	// Update the month we are viewing
	$formvalues['date'] = date("F Y",strtotime($formvalues['month']."-".$formvalues['year']));
	// Set the start day and end day for the amount calculations
	$formvalues['startdate'] = date("d-M-Y",strtotime("01-".$formvalues['month']."-".$formvalues['year']));
	$formvalues['enddate'] = date("d-M-Y",strtotime("next month ".$formvalues['month']."-".$formvalues['year']));
	
}

$_SESSION['reporttype'] = "PAYE Schedule";
$_SESSION['formvalues'] = $formvalues;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - PAYE Schedule</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>

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
        <td class="headings">PAYE Schedule [ <?php if(isset($_GET['a'])){?><a href="paye.php">View</a><?php } else { ?><a href="paye.php?a=edit">Edit</a><?php } ?> ] </td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="paye.php">
          <div id="printresults_div">
		  <table width="100%" border="0">
            <tr>
              <td align="center" class="label"><?php if(isset($_GET['a'])){?>Top band details i.e., the company name, TIN no and the PAYE formula are editable by admin only.<br>
                [ <a href="../settings?t=PAYE Details Change">Request Change</a> ] <br>
                <?php } ?><span style="font-size:24px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold"><?php echo $settings['companyname'];?></span><br>
                <span class="label2" style="font-size:20px; font-family:Verdana, Arial, Helvetica, sans-serif">TIN No: <?php echo $settings['companytinno'];?></span><br>
                <span class="label2" style="font-size:20px; font-family:Verdana, Arial, Helvetica, sans-serif">PAYE Returns </span><br>
<span style="font-size:20px; font-family:Verdana, Arial, Helvetica, sans-serif"><?php 
if(isset($formvalues['date']) && $formvalues['date'] != "0000-00-00"){
	$date = date("F Y",strtotime($formvalues['date']));
} else {
	// Return the current month
	$date = date("F Y");
}

if(isset($_GET['a'])){ ?>
	
<select id="month" name="month">
  <?php 
  if(isset($formvalues['date']) && $formvalues['date'] != "0000-00-00 00:00:00"){ 
		$date =  date("F", strtotime($formvalues['date']));
	} else { 
		if(isset($_GET['a']) && $_GET['a'] == "return"){
			$date = "";
		} else {
			$date =  date("F", strtotime("now"));
		}
	}
						
  echo generateSelectOptions(getTime('month',''), $date);?>
</select>
&nbsp;&nbsp; 
<select id="year" name="year">
  <?php 
   if(isset($formvalues['date']) && $formvalues['date'] != "0000-00-00 00:00:00"){ 
		$date =  date("Y", strtotime($formvalues['date']));
	} else { 
		if(isset($_GET['a']) && $_GET['a'] == "return"){
			$date = "";
		} else {
			$date =  date("Y", strtotime("now"));
		}
	}
  echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select>
<?php } else {
	echo $date;
}
?></span></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            
            <?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no guards to display</td></tr>";
		   	} else { 
			?>
            <tr>
              <td><table width="100%" border="0" style="border: 1px; 
	border-style: solid;
	border-color: #adaefe" cellpadding="2" cellspacing="0">
                  <tr  style="font-family: tahoma;
	font-size: 11px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
                    <td width="12%">Guard Name</td>
                    <td width="13%">TIN No </td>
                    <td width="16%">Gross Salary (Shs) </td>
					<td width="12%">PAYE (Shs) </td>
                  </tr>
                  <?php
			  //Multidimensional array to save details to be used in the next table
			  $guardpayedetails = array();
			  $i = 0;
			  $totalamount = 0;
			  $guardresult = mysql_query($query);
			   while($guard=mysql_fetch_array($guardresult, MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "oddrow";
				  } else {
				     $rowclass = "evenrow";
				  }
			   ?>
                  <tr class="<?php echo $rowclass; ?>">
				  <td><?php echo $guard['firstname']." ".$guard['lastname']." ".$guard['othernames'];?></td>
                    <td><?php 
					if(isset($_GET['a'])){ ?>
						<input type="text" name="tin[]" id="tin[]<?php echo $guard['id'];?>" value="<?php echo $guard['tinno'];?>"><input name="id[]" id="id[]<?php echo $guard['id'];?>" type="hidden" value="<?php echo $guard['id'];?>">
					  <?php } else {
						echo $guard['tinno'];
					 } ?></td>
                    <td><?php 
					// Based on settings, determine the start and end dates
					//$amount=0;
					if(isset($formvalues['startdate'])){
						if($formvalues['startdate'] != "0000-00-00 00:00:00") { 
							$startdate = $formvalues['startdate'];
						} else {
							$startdate = "";
						}
						
						if($formvalues['enddate'] != "0000-00-00 00:00:00") { 
							$enddate = $formvalues['enddate'];
						} else {
							$enddate = "";
						}
					} else {
						$startdate = "";
						$enddate = "";
					}
				$guardcharge=getGuardCharge($guard['guardid'],$startdate,$enddate);
				$guardfinance_b=getGuardFinance($guard['financialstatus'],$startdate,"","Bonus");
				$guardfinance_d=getGuardFinance($guard['financialstatus'],$startdate,$enddate,"Deduction");
				//$amount = getGuardCharge($guard['guardid'],$startdate,$enddate) + getGuardFinance($guard['financialstatus'],$startdate,"","Bonus") - getGuardFinance($guard['financialstatus'],$startdate,$enddate,"Deduction");
				$amount=$guardcharge + $guardfinance_b - $guardfinance_d;
					echo commify($amount); 
					?></td>
					<td><?php 
					$sub_total = generatePAYEAmount($amount,"local");
					echo commify($sub_total);
					$totalamount += $sub_total;
					//Save the guard payment details for use in the next table
					array_push($guardpayedetails, array($guard['guardid'],$amount,$sub_total));
					 ?></td>
                  </tr>
                  <?php 
			  		$i++;
			  } ?>
			  <tr><td><b><?php echo "Total";?></b></td><td></td><td></td><td><b><?php echo commify($totalamount);?></b></td></tr>
			<tr><td>&nbsp;</td><td></td><td></td><td>&nbsp;</td></tr>
						<tr style="font-family: tahoma;
	font-size: 11px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
						  <td>Category of Employees </td>
						  <td>Number of Employees </td>
						  <td>Amount Paid (Shs) </td>
						  <td>Tax Payable (Shs) </td>
					    </tr>
						<?php 
						$query = "SELECT * FROM payeranges WHERE type='local'";
						$k = 0;
						$result = mysql_query($query);
						while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
							$details_array = getPAYEData($guardpayedetails,$row['lowerlevel'],$row['upperlevel']);
							if(($k%2)==0) {
				     			$rowclass = "oddrow";
				  			} else {
				     			$rowclass = "evenrow";
				  			}
						?>
						<tr class="<?php echo $rowclass; ?>">
						  <td><?php 
						  if($row['lowerlevel'] == "0"){
						  	echo "Below ".commify($row['upperlevel']);
						  } else if($row['lowerlevel'] != "0" && (trim($row['upperlevel']) != "" && $row['upperlevel'] != "0")){
						  	echo commify($row['lowerlevel'])." Shs to ".commify($row['upperlevel'])." Shs";
						  } else if($row['lowerlevel'] != "0" && (trim($row['upperlevel']) == "" || $row['upperlevel'] == "0")){
						  	echo "Above ".commify($row['lowerlevel']);
						  }
						  
						  ?></td>
						  <td><?php echo commify($details_array[0]);
						  ?></td>
						  <td><?php echo commify($details_array[1]);?></td>
						  <td><?php echo commify($details_array[2]);?></td>
					    </tr>
				<?php 
					$k++;
				} ?>
				<tr>
						  <td><b class="label2">Total</b></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td><b><?php echo commify($totalamount);?></b></td>
					    </tr>
				<?php 
				 if(isset($_GET['a'])){ ?>		
				<tr><td>&nbsp;</td><td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
&nbsp;&nbsp;
<input type="submit" name="save" value="View"></td><td>&nbsp;</td><td>&nbsp;</td></tr>
			<?php }?>
              </table></td>
            </tr>
            <?php } ?>
          </table></div>
                </form>
        </td>
      </tr>
	  <?php  if(!isset($_GET['a'])){ ?>
	  <tr><td align="center"><input type="button" name="cancel2" id="cancel2" value="<< Back" onClick="javascript:history.go(-1);">
          <input type="button" name="Button" id="submit" value="Print"  onClick="openPopWindow(600,350,'Financial Report','print')">
          <b class="label"> [ Export &gt;&gt; <a href="#"   onClick="openPopWindow(600,350,'Special Report','msword')" title="Export report to MS Word"><img src="../images/mswordimg.gif" width="16" height="16" border="0"></a>&nbsp;&nbsp;<a href="#"   onClick="openPopWindow(600,350,'Special Report','msexcel')" title="Export report to MS Excel"><img src="../images/msexcelimg.gif" width="16" height="16" border="0"></a> ] </b></td>
	  </tr> <?php } ?>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
