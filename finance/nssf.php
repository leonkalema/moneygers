<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
// The query for guard information
$query = "SELECT g.id, g.guardid, g.nssfno, g.rate,g.lastpaymentdate,g.financialstatus, p.firstname,p.lastname,p.othernames FROM guards g, persons p WHERE g.personid = p.id";
//The global settings for this package
$settings = getRowAsArray("SELECT employeenssfrate, employernssfrate, companyname, employerno FROM settings");

//If the user had edited some of the information
if(isset($_POST['save'])){
	$formvalues = array_merge($_POST);
	
	// Update NSSF guard numbers
	for($i=0;$i<count($formvalues['nssf']);$i++){
		mysql_query("UPDATE guards SET nssfno = '".$formvalues['nssf'][$i]."' WHERE id = '".$formvalues['id'][$i]."'");
	}
	// Update the month we are viewing
	$formvalues['date'] = date("F Y",strtotime($formvalues['month']."-".$formvalues['year']));
	// Set the start day and end day for the amount calculations
	$formvalues['startdate'] = date("d-M-Y",strtotime("01-".$formvalues['month']."-".$formvalues['year']));
	$formvalues['enddate'] = date("d-M-Y",strtotime("next month ".$formvalues['month']."-".$formvalues['year']));
	
}

$_SESSION['reporttype'] = "NSSF Schedule";
$_SESSION['formvalues'] = $formvalues;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - NSSF Schedule</title>
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
        <td class="headings">NSSF Schedule [ <?php if(isset($_GET['a'])){?><a href="nssf.php">View</a><?php } else { ?><a href="nssf.php?a=edit">Edit</a><?php } ?> ] </td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="nssf.php">
          <div id="printresults_div">
		  <table width="100%" border="0">
            <tr>
              <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                  <td class="label"><?php if(isset($_GET['a'])){?>
                    Top band details (company name, employer no, NSSF Percentage) are editable by admin only.<br>
                    [ <a href="../settings?t=NSSF Details Change">Request Change</a> ] <br>
                    <?php } ?>
                    <span style="font-size:24px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold"><?php echo $settings['companyname'];?></span></td>
                  </tr>
                <tr>
                  <td><span class="label2" style="font-size:20px; font-weight:bold">NATIONAL SOCIAL SECURITY FUND</span></td>
                  </tr>
                <tr>
                  <td><span class="label2" style="font-size:20px;">MONTHLY SCHEDULE OF STANDARD CONTRIBUTIONS</span> </td>
                </tr>
                <tr>
                  <td><b class="label">Month:</b> <span style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif">
                    <?php 
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
?>
                  </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b class="label">Employer No:</b> <?php echo $settings['employerno'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b class="label">Sheet No:</b> __________</td>
                  </tr>
              </table></td>
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
              <td><table width="100%" style="border: 1px; 
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
                    <td width="13%">NSSF No </td>
                    <td width="16%">Gross Salary (Shs) </td>
					<td width="12%" nowrap>Employee NSSF (Shs)<br>(<?php echo $settings['employeenssfrate']; ?>%) </td>
					<td width="12%" nowrap>Employer NSSF (Shs)<br>(<?php echo $settings['employernssfrate']; ?>%) </td>
                  </tr>
                  <?php
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
						<input type="text" name="nssf[]" id="nssf[]<?php echo $guard['id'];?>" value="<?php echo $guard['nssfno'];?>"><input name="id[]" id="id[]<?php echo $guard['id'];?>" type="hidden" value="<?php echo $guard['id'];?>">
					  <?php } else {
						echo $guard['nssfno'];
					 } ?></td>
                    <td><?php 
					// Based on settings, determine the start and end dates
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
					$amount = getGuardCharge($guard['guardid'],$startdate,$enddate) + getGuardFinance($guard['financialstatus'],$startdate,"","Bonus") - getGuardFinance($guard['financialstatus'],$startdate,$enddate,"Deduction");
					echo number_format($amount); ?></td>
					<td><?php 
					$employeesub_total = round($amount*($settings['employeenssfrate']/100));
					echo number_format($employeesub_total);
					$employeetotalamount += $employeesub_total;
					 ?></td>
					 <td><?php 
					$employersub_total = round($amount*($settings['employernssfrate']/100));
					echo number_format($employersub_total);
					$employertotalamount += $employersub_total;
					 ?></td>
                  </tr>
                  <?php 
			  		$i++;
			  } ?>
			  <tr><td><b><?php echo "Total";?></b></td><td></td><td></td><td><b><?php echo number_format($employeetotalamount);?></b></td><td><b><?php echo number_format($employertotalamount);?></b></td></tr>
			<?php  if(isset($_GET['a'])){ ?>
						<tr><td>&nbsp;</td><td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
&nbsp;&nbsp;
<input type="submit" name="save" value="View"></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
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
