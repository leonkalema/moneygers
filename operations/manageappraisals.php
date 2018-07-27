<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

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
		
		//$where = "WHERE p.firstname LIKE '%".$searchvalue."%' OR p.lastname LIKE '%".$searchvalue."%'";
		
		$where = "WHERE (p.firstname LIKE '%".$searchvalue[0]."%' OR p.lastname LIKE '%".$searchvalue[0]."%' OR p.othernames LIKE '%".$searchvalue[0]."%'  OR p.birthlastname LIKE '%".$searchvalue[0]."%') AND (p.lastname LIKE '%".$searchvalue[1]."%' OR p.firstname LIKE '%".$searchvalue[1]."%' OR p.othernames LIKE '%".$searchvalue[1]."%' OR p.birthlastname LIKE '%".$searchvalue[1]."%')";
		
	}
	//search by Guard ID
	if($_GET['type'] == "Guard ID"){
		$searchvalue = $_SESSION['searchguardfinance'];
		$searchresultsarray = array();
		
		$where = "WHERE g.guardid LIKE '%".$searchvalue."%'";
	}	
}
else {
	$where ="";
	}

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
        <td class="headings">Manage Guard Bonuses </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
	  <tr>
        <td><form name="form1" method="post" action="">
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
					<td width="10%">Guard ID</td>
                    <td width="23%">Guard Name</td>
                    <td width="25%">Bonus Amount (Shs) </td>
					<?php if(userHasRight($_SESSION['userid'], "72")){?>
                    <td width="42%">Approval</td><?php } ?>
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
				  //$row=getRowAsArray("SELECT * FROM guardfinance where guard ");
			   ?>
                  <tr class="<?php echo $rowclass; ?>">
				  <td>
				  <?php if(userHasRight($_SESSION['userid'], "43")){?>
				  <a href="../hr/?id=<?php echo encryptValue($guard['id']);?>&a=view" class="normaltxtlink" title="View guard details"><?php echo $guard['guardid'];?></a><?php } else echo $guard['guardid']; ?></td>
                    <td><?php echo $guard['firstname']." ".$guard['lastname']." ".$guard['othernames'];?></td>
                    <td><?php 
					echo number_format(getGuardFinance($guard['financialstatus'],"","","Bonus")); ?>
					<?php if(userHasRight($_SESSION['userid'], "136")){?>&nbsp;&nbsp;(<a href="../operations/appraisals.php?id=<?php echo encryptValue($guard['guardid']);?>&t=add" class="normaltxtlink" title="Update bonuses.">Update</a>)&nbsp;<?php } ?></td>
                    <td nowrap="nowrap"><?php if(userHasRight($_SESSION['userid'], "72")){?>
                      <a href="approveappraisals.php?id=<?php echo encryptValue($guard['guardid']);?>&t=finance" title="Finance manager approval" class="normaltxtlink">Approval</a> [<?php if($row['financeapproved'] == "Y"){
						echo "Y";
						} else {
						echo "N";
						}?>]
                    <?php } ?></td>
                  </tr>
                  <?php 
			  		$i++;
			  } ?>
              </table>
              </div></td>
            </tr>
            <?php } ?>
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
