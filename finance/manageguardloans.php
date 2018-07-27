<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

// Delete loan application
if(isset($_GET['id']) && isset($_GET['a'])){
	if($_GET['a'] == "delete"){
		mysql_query("DELETE FROM loanapplications WHERE id = '".trim($_GET['id'])."'");
	}
}


if(isset($_POST['ArchiveLoanApplications'])){
	$formvalues = array_merge($_POST);
	//Archive all selected loan applications
	for($i=0;$i<count($formvalues['loanapplication']);$i++){
		mysql_query("UPDATE loanapplications SET isactive = 'N' WHERE id='".$formvalues['loanapplication'][$i]."'");
	}
	forwardToPage("manageguardloans.php");
}

if(isset($_POST['ActivateLoanApplications'])){
	$formvalues = array_merge($_POST);
	//Archive all selected assignments
	for($i=0;$i<count($formvalues['loanapplication']);$i++){
		mysql_query("UPDATE loanapplications SET isactive = 'Y' WHERE id='".$formvalues['loanapplication'][$i]."'");
	}
	forwardToPage("manageguardloans.php");
}


if(isset($_GET['a']) && $_GET['a'] == "archive"){
	$query=("SELECT * FROM loanapplications WHERE isactive='N' ORDER BY datecreated DESC") or die(mysql_error());
} else {
// Searching for a loan application	
if(isset($_GET['a']) && $_GET['a'] == "search"){
	$_SESSION['searchloanapplication'] = trim($_GET['v']);
	
		
	
	//search by Guard Name
	if($_GET['type'] == "Guard Name"){
		$searchvalues = $_SESSION['searchloanapplication'];
		// Scan through the search values separated by a space
		$searchvalue = explode(" ",$searchvalues);
		
		$whereclause = " AND (p.firstname LIKE '%".$searchvalue[0]."%' OR p.lastname LIKE '%".$searchvalue[0]."%' OR p.othernames LIKE '%".$searchvalue[0]."%'  OR p.birthlastname LIKE '%".$searchvalue[0]."%') AND (p.lastname LIKE '%".$searchvalue[1]."%' OR p.firstname LIKE '%".$searchvalue[1]."%' OR p.othernames LIKE '%".$searchvalue[1]."%' OR p.birthlastname LIKE '%".$searchvalue[1]."%') ";
	}
	
	//search by Guard ID
	if($_GET['type'] == "Guard ID"){
		$searchvalue = $_SESSION['searchloanapplication'];
		$searchresultsarray = array();
		
		$whereclause = " AND l.guardid LIKE '%".$searchvalue."%'";
	}
	
	//search by loan id
	if(isset($_GET['loanid'])){
		$searchvalue = $_SESSION['searchloanapplication'];
		$searchresultsarray = array();
		
		$whereclause = " AND l.id LIKE '%".$_GET['loanid']."%'";
	}
	
}
else {$whereclause="";}

$query = "SELECT * FROM persons p INNER JOIN guards g ON (g.personid = p.id) INNER JOIN loanapplications l ON (g.guardid=l.guardid) WHERE l.loanstatus <> 'Archived' AND l.isactive <> 'N'  ".$whereclause." ORDER BY l.datecreated DESC";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Guard Staff Debts</title>
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
    <td colspan="2" align="center" valign="top">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings">Manage Staff Debt </td>
      </tr>
      <tr>
        <td>
		
		<table width="100%" border="0"> 
		<form name="form2" method="post" action="manageguardloans.php">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
		   <?php if(userHasRight($_SESSION['userid'], "159") || userHasRight($_SESSION['userid'], "32")){ ?>
            <td>
              <input type="button" name="newloan" value="Register Staff Debt Application" onClick="javascript:document.location.href='../finance/loan.php'">
		   <?php } ?> [ <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ ?><a href="../finance/manageguardloans.php" title="Displays active staff debt applications.">View Active Staff Debt Applications</a><?php } else {?><a href="../finance/manageguardloans.php?a=archive" title="Displays staff debt applications that have been archived.">View Archive</a><?php } ?> ] </td>
            </tr>
		    <tr>
              <td>&nbsp;</td>
            </tr>
	  
	  <td>
	  <form method="post" action="">
	  <div id="searchtable"><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search for Staff Debt Applications: </td>
                  <td><input name="searchloanapplication" id="searchloanapplication" type="text" size="20" value="<?php if(isset($_SESSION['searchloanapplication'])){ echo $_SESSION['searchloanapplication'];}?>"></td>
                  <td nowrap class="label">Search By: 
                    <select name="type" id="type">
                      <option value="Guard Name">Guard Name</option>
					  <option value="Guard ID">Guard ID</option>	
                    </select> 
					</td>
                  <td><input type="button" name="Button" value="Search Staff Debt Applications" onClick="pickFormItemTypeAndDirect('searchloanapplication', '../finance/manageguardloans.php?a=search&v=', 'Please enter a guard name or ID')"></td>
                </tr>
              </table>
              </div></form>
	  </td>
      </tr>
		<tr>
		  <td>&nbsp;</td>
		</tr>
		<?php $whereclause = "";
		if(isset($_GET['a']) && $_GET['a'] == "search"){
			$whereclause = " AND id='".$_GET['loanid']."'";
		}
		//$query = "SELECT * FROM loanapplications WHERE loanstatus <> 'Archived'".$whereclause." ORDER BY datecreated DESC";
		
		if(howManyRows($query) == 0){          			
			echo "<tr><td>There are no staff debt applications to display</td></tr>";
		} else { 
		?>
	  <tr>
		<td><div style="padding:4px;width:97%;height:300px;overflow: auto">
		<table width="100%" border="0" class="contenttableborder" cellpadding="3" cellspacing="0">
		  <tr class="tabheadings">
		 <?php if(userHasRight($_SESSION['userid'], "159") || userHasRight($_SESSION['userid'], "32")){ ?>
		   <td width="4%">&nbsp;</td>
		   <?php } ?>
		  <?php if(userHasRight($_SESSION['userid'], "161") || userHasRight($_SESSION['userid'], "32")){?>
			<td width="7%">Delete</td>
			<?php } ?>
			<?php if(userHasRight($_SESSION['userid'], "161") || userHasRight($_SESSION['userid'], "32")){?>
			<td width="4%">Edit</td>
			<?php } ?>
			<?php if(userHasRight($_SESSION['userid'], "69")){?>
			<td width="5%">View</td>
			<?php } ?>
			<td width="7%">Guard ID </td>
			<td width="12%">Name</td>
			<td width="15%">Staff Debt Amount</td>
			 <?php if(userHasRight($_SESSION['userid'], "83") ){?>
			 <td width="24%">Approval</td>
			 <?php } ?>
			 <?php if(userHasRight($_SESSION['userid'], "69") ){?>
			 <td width="22%" nowrap>Application Letter </td>
			 <?php } ?>
		  </tr>
		  <?php
		  // Display the loan applications
		  $result = mysql_query($query);
		  $i = 0;
		   while($row=mysql_fetch_array($result, MYSQL_ASSOC)) { 
			  if(($i%2)==0) {
				 $rowclass = "evenrow";
			  } else {
				 $rowclass = "oddrow";
			  }
			  //Getting the guard names
			 $line = getRowasArray("SELECT p.firstname, p.lastname, p.othernames FROM persons p, guards g WHERE g.personid=p.id AND g.guardid = '".$row['guardid']."'");
		   ?>
		  <tr class="<?php echo $rowclass; ?>">
		  <?php if(userHasRight($_SESSION['userid'], "159") || userHasRight($_SESSION['userid'], "32")){ ?>
		  <td><input type="checkbox" name="loanapplication[]" id="loanapplication[]<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>"></td><?php } ?>
		  <?php if(userHasRight($_SESSION['userid'], "161") || userHasRight($_SESSION['userid'], "32")){?>
			<td><a href="#" onClick="javascript:deleteEntity('../finance/manageguardloans.php?id=<?php echo $row['id']; ?>&a=delete', 'staff debt application', '<?php echo "by ".$line['firstname']." ".$line['lastname']." ".$line['othernames']; ?>')" title="Delete staff debt application">Delete</a></td>
			<?php } ?>
			<?php if(userHasRight($_SESSION['userid'], "161") || userHasRight($_SESSION['userid'], "32")){?>
			<td><a href="../finance/loan.php?id=<?php echo encryptValue($row['id']); ?>&a=edit" title="Modify staff debt application.">Edit</a></td>
			<?php } ?>
			<?php if(userHasRight($_SESSION['userid'], "69")){?>
			<td><a href="../finance/loan.php?id=<?php echo encryptValue($row['id']); ?>&a=view" title="View staff debt application.">View</a></td>
			<?php } ?>
			<td align="left"><?php echo $row['guardid']; ?></td>
			<td><?php 
			//$line = getRowasArray("SELECT p.firstname, p.lastname, p.othernames FROM persons p, guards g WHERE g.personid=p.id AND g.guardid = '".$row['guardid']."'");
			echo $line['firstname']." ".$line['lastname']." ".$line['othernames']; ?></td>
			<td align="center"><?php echo number_format($row['loanamount']);?>&nbsp;&nbsp;&nbsp;</td>
			<td nowrap>
			<?php if(userHasRight($_SESSION['userid'], "83")){?>				
			<a href="approvals.php?id=<?php echo encryptValue($row['id']);?>&t=gm" title="General manager approval">GM Approval</a>
			[<?php if($row['gmapproved'] == "Y"){
				echo "Y";
			} else {
				echo "N";
			}?>]
			<?php } ?></td>
			<?php if(userHasRight($_SESSION['userid'], "69")){?>	
			<td><?php if (trim($row['appnletter']) == ""){ echo "No Letter";} else { ?><img src="../images/file.gif" alt="Staff Debt Application Letter" border="0"> <a href="../finance/<?php echo $row['appnletter'];?>"  title="View guard's scanned application letter.">View Letter</a><?php } ?></td>
			<?php } ?>
		  </tr>
		  <?php 
		  $i++;
		  } ?>
		</table>
		</div></td>
	  </tr>			
		<?php } ?>
		<tr>
		  <td>&nbsp;</td>
		</tr>
		<?php if(userHasRight($_SESSION['userid'], "159") || userHasRight($_SESSION['userid'], "32")){ ?>
		<tr>
		  <td><input  type="submit" <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ echo "name=\"ActivateLoanApplications\" value=\"Re-Activate\""; } else { echo "name=\"ArchiveLoanApplications\" value=\"Archive\"";} ?>> <?php if(isset($_GET['a']) && $_GET['a'] == "search"){ ?><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"><?php } ?></td>
		</tr>
		<?php } ?>
	 </form>
	</table>
		</td>
	  </tr>
    </table>
	</td>
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
