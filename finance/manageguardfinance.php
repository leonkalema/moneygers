<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

//Clear all previous formvalue session values
$_SESSION['formvalues'] = "";

// Searching for a assignment overtime	
if(isset($_GET['a']) && $_GET['a'] == "search"){
	$_SESSION['searchguardfinance'] = trim($_GET['v']);
	
	//Search through all the guard finance and get the relevant results
	
	//search by guard Name
	if($_GET['type'] == "Name"){
		$searchvalues = $_SESSION['searchguardfinance'];
		
		// Scan through the search values separated by a space
		$searchvalue = explode(" ",$searchvalues);
		
		$searchresultsarray = array();
		
		$where = "WHERE (p.firstname LIKE '%".$searchvalue[0]."%' OR p.lastname LIKE '%".$searchvalue[0]."%' OR p.othernames LIKE '%".$searchvalue[0]."%'  OR p.birthlastname LIKE '%".$searchvalue[0]."%') AND (p.lastname LIKE '%".$searchvalue[1]."%' OR p.firstname LIKE '%".$searchvalue[1]."%' OR p.othernames LIKE '%".$searchvalue[1]."%' OR p.birthlastname LIKE '%".$searchvalue[1]."%')";
		
	}
	//search by Guard ID
	if($_GET['type'] == "Guard ID"){
		$searchvalue = $_SESSION['searchguardfinance'];
		$searchresultsarray = array();
		
		$where = "WHERE g.guardid LIKE '%".$searchvalue."%'";
	}	
}else {
	$where ="";
}

//If the person is generating payslips for more than one guard
if(isset($_POST['generateslip'])){
	$formvalues = array_merge($_POST);
	$selectedguards = array();
	
	foreach($formvalues as $key => $value){
		//Pick only selected checkboxes
		if(substr($key,0,6) == "guard_"){
			array_push($selectedguards,$value);
		}
	}
	$_SESSION['selectedguards'] = $selectedguards;
}

//Default start and end dates are this month's start and end dates respectively
$startdate = "01-".date("M")."-".date("Y");
$enddate = date("d-M-Y", mktime(0, 0, 0, (date("m",strtotime("now"))+1), 0, date("Y",strtotime("now"))));

$query = "SELECT g.id, g.guardid, g.rate,g.lastpaymentdate,g.financialstatus, p.firstname,p.lastname,p.othernames FROM guards g INNER JOIN persons p ON (g.personid = p.id) ".$where." ORDER BY p.id DESC ";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Guard Finances</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0" <?php if(isset($_POST['generateslip'])){ ?>onLoad="openPopWindow(600,350,'Payslip Report','msexcel')"<?php } ?>>
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
        <td class="headings">Manage Guard Finances </td>
      </tr>
       <tr>
         <td>&nbsp;</td>
       </tr>
	  <td><form method="post" action="">
	  <div id="searchtable" style="margin-left:5px"><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search Guard Financial Report: </td>
                  <td><input name="searchguardfinance" id="searchguardfinance" type="text" size="20" value="<?php if(isset($_SESSION['searchguardfinance'])){ echo $_SESSION['searchguardfinance'];}?>"></td>
                  <td class="label">Search By: 
                    <select name="type" id="type">
                      <option value="Name">Name</option>
					  <option value="Guard ID" <?php if(isset($_GET['type']) && $_GET['type'] == "Guard ID"){ echo "selected";}?>>Guard ID</option>	
                    </select> 
					</td>
                  <td><input type="button" name="Button" value="Search" onClick="pickFormItemTypeAndDirect('searchguardfinance', '../finance/manageguardfinance.php?a=search&v=', 'Please enter a guard name or ID')"></td>
                </tr>
              </table>
              </div></form></td>
            </tr>
	  <tr>
        <td><form name="payslipsform" id="payslipsform" method="post" action="manageguardfinance.php">
          <table width="100%" border="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            
            <?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no guards to display</td></tr>";
		   	} else { 
			?>
            <tr>
              <td><div style="padding:4px;width:720px;height:400px;overflow:auto">
			  <table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
                  <tr class="tabheadings">
					<td width="1%">&nbsp;</td>
					<td width="11%">Guard ID</td>
                    <td width="12%">Guard Name</td>
                    <td width="12%">Gross Amount <br>
                      (Shs) </td>
                    <td width="20%">Amount Added <br>
                      (Shs) </td>
                    <td width="17%">Amount Subtracted <br>
                      (Shs) </td>
                    <td width="15%">Net Amount<br> 
                      (Shs) </td>
					<td width="13%">Last Payment Date</td>
					<td width="13%">Payslip</td>
                  </tr>
                  <?php
			  $i = 0;
			  $guardresult = mysql_query($query);
			   while($guard=mysql_fetch_array($guardresult, MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
                  <tr class="<?php echo $rowclass; ?>">
				  <td><input type="checkbox" id="guard_<?php echo $guard['id']; ?>" name="guard_<?php echo $guard['id']; ?>" value="<?php echo $guard['guardid'];?>" <?php if(isset($formvalues) && isset($formvalues['guard_'.$guard['id']])){ echo "checked";}?>></td>
				  <td>
				  <?php if(userHasRight($_SESSION['userid'], "43")){?>
				  <a href="../hr/?id=<?php echo encryptValue($guard['id']);?>&a=view" class="normaltxtlink" title="View guard details"><?php echo $guard['guardid'];?></a><?php } else echo $guard['guardid']; ?></td>
                    <td><?php echo $guard['firstname']." ".$guard['lastname']." ".$guard['othernames'];?></td>
                    <td><?php 
					echo commify(getGuardCharge($guard['guardid'],$startdate,$enddate));
					 ?></td>
                    <td><?php 
					echo commify(getGuardFinance($guard['financialstatus'],$startdate,$enddate,"Bonus")); ?>
					<?php if(userHasRight($_SESSION['userid'], "136")){?><br>(<a href="../finance/index.php?id=<?php echo encryptValue($guard['guardid']);?>&t=add" class="normaltxtlink" title="Update bonuses.">Update</a>)<?php } ?></td>
                    <td><?php 
					
					echo commify(getGuardFinance($guard['financialstatus'],$startdate,$enddate,"Deduction")); ?>
					<?php if(userHasRight($_SESSION['userid'], "136")){?><br>(<a href="../finance/index.php?id=<?php echo encryptValue($guard['guardid']);?>&t=subtract" class="normaltxtlink" title="Update deductions.">Update</a>)<?php } ?></td>
                    <td><?php 
					$amount = getGuardCharge($guard['guardid'],$startdate,$enddate) + getGuardFinance($guard['financialstatus'],"","","Bonus") - getGuardFinance($guard['financialstatus'],$startdate,$enddate,"Deduction");
					if($amount < 0){
						echo "(".commify((0 - $amount)).")"; 
					} else {
						echo commify($amount); 
					}?></td>
					<td nowrap="nowrap"><?php 
					if(trim($guard['lastpaymentdate']) != ""){
						echo date("d-M-Y",strtotime($guard['lastpaymentdate']))."<br>";
					} ?>
					<?php if(userHasRight($_SESSION['userid'], "136")){?>(<a href="../finance/index.php?id=<?php echo encryptValue($guard['guardid']);?>&t=date" class="normaltxtlink" title="Update payment date.">Update</a>)<?php } ?></td>
					<td><a href="../finance/payslip.php?id=<?php echo encryptValue($guard['guardid']);?>" class="normaltxtlink" title="Generate pay slip for <?php echo $guard['firstname']." ".$guard['lastname']." ".$guard['othernames'];?>.">Generate</a></td>
                  </tr>
                  <?php 
			  		$i++;
			  } ?>
              </table></div></td>
            </tr>
			<tr><td>&nbsp;</td></tr>
	  <tr>
	    <td><a href="javascript:selectAllBoxes('guard_','payslipsform')" title="Click to select all the above guards.">Select All</a> &nbsp;&nbsp;&nbsp;
	      <input name="generateslip" type="submit" id="generateslip" value="Generate This Month's Pay Slips For Selected"></td></tr>
            <?php } ?>
          </table>
                </form>
        </td>
      </tr>
	  
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
