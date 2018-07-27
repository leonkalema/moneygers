<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

// Delete guard claims
if(isset($_GET['id']) && isset($_GET['a'])){
	if($_GET['a'] == "delete"){
		mysql_query("DELETE FROM guardclaims WHERE id = '".trim($_GET['id'])."'");
	}
}


if(isset($_POST['ArchiveGuardClaims'])){
	$formvalues = array_merge($_POST);
	//Archive all selected guard claims
	for($i=0;$i<count($formvalues['guardclaims']);$i++){
		mysql_query("UPDATE guardclaims SET isactive = 'N' WHERE id='".$formvalues['guardclaims'][$i]."'");
	}
	forwardToPage("manageguardclaims.php");
}

if(isset($_POST['ActivateGuardClaims'])){
	$formvalues = array_merge($_POST);
	//Activate all selected guard claims
	for($i=0;$i<count($formvalues['guardclaims']);$i++){
		mysql_query("UPDATE guardclaims SET isactive = 'Y' WHERE id='".$formvalues['guardclaims'][$i]."'");
	}
	forwardToPage("manageguardclaims.php");
}


if(isset($_GET['a']) && $_GET['a'] == "archive"){
	$query=("SELECT * FROM guardclaims WHERE isactive='N' ORDER BY datecreated DESC") or die(mysql_error());
} else {
// Searching for a guard claim
if(isset($_GET['a']) && $_GET['a'] == "search"){
	$_SESSION['searchguardclaim'] = trim($_GET['v']);
	
		
	
	//search by Guard Name
	if($_GET['type'] == "Guard Name"){
		$searchvalues = $_SESSION['searchguardclaim'];
		// Scan through the search values separated by a space
		$searchvalue = explode(" ",$searchvalues);
		
		$whereclause = " AND (p.firstname LIKE '%".$searchvalue[0]."%' OR p.lastname LIKE '%".$searchvalue[0]."%' OR p.othernames LIKE '%".$searchvalue[0]."%'  OR p.birthlastname LIKE '%".$searchvalue[0]."%') AND (p.lastname LIKE '%".$searchvalue[1]."%' OR p.firstname LIKE '%".$searchvalue[1]."%' OR p.othernames LIKE '%".$searchvalue[1]."%' OR p.birthlastname LIKE '%".$searchvalue[1]."%') ";
	}
	
	//search by Guard ID
	if($_GET['type'] == "Guard ID"){
		$searchvalue = $_SESSION['searchguardclaim'];
		$searchresultsarray = array();
		
		$whereclause = " AND c.guardid LIKE '%".$searchvalue."%'";
	}
	
} else {$whereclause="";}

$query = "SELECT * FROM persons p INNER JOIN guards g ON (g.personid = p.id) INNER JOIN guardclaims c ON (g.guardid=c.guardid) WHERE c.claimstatus <> 'Archived' AND c.isactive <> 'N'  ".$whereclause." ORDER BY c.datecreated DESC";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Guard Claims</title>
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
        <td class="headings">Manage Guard Claims <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ echo "- Archive";}?></td>
      </tr>
      <tr>
        <td>
		<form name="form2" method="post" action="">
		<table width="100%" border="0"> 
		   <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <input type="button" name="newclaim" value="Register Guard Claim" onClick="javascript:document.location.href='../finance/guardclaim.php'">
		    [ <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ ?><a href="../finance/manageguardclaims.php" title="Displays active guard claims.">View Active Guard Claims</a><?php } else {?><a href="../finance/manageguardclaims.php?a=archive" title="Displays guard claims that have been archived.">View Archive</a><?php } ?> ] </td>
            </tr>
		    <tr>
              <td>&nbsp;</td>
            </tr>
	  
	  <td>
	  
	  <div id="searchtable"><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search for Staff Debt Applications: </td>
                  <td><input name="searchguardclaim" id="searchguardclaim" type="text" size="20" value="<?php if(isset($_SESSION['searchguardclaim'])){ echo $_SESSION['searchguardclaim'];}?>"></td>
                  <td nowrap class="label">Search By: 
                    <select name="type" id="type">
                      <option value="Guard Name">Guard Name</option>
					  <option value="Guard ID">Guard ID</option>	
                    </select> 
					</td>
                  <td><input type="button" name="Button" value="Search Guard Claims" onClick="pickFormItemTypeAndDirect('searchguardclaim', '../finance/manageguardclaims.php?a=search&v=', 'Please enter a guard name or ID')"></td>
                </tr>
              </table>
              </div>
	  </td>
      </tr>
		<tr>
		  <td>&nbsp;</td>
		</tr>
		<?php
		
		if(howManyRows($query) == 0){          			
			echo "<tr><td>There are no guard claims to display.</td></tr>";
		} else { 
		?>
	  <tr>
		<td><div style="padding:4px;width:97%;height:300px;overflow: auto" id="printresults_div">
		<table width="99%" border="0" style="border: 1px; 
	border-style: solid;
	border-color: #adaefe" cellpadding="3" cellspacing="0">
		  <tr style="font-family: tahoma;
	font-size: 12px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
		 <td width="4%">&nbsp;</td>
		  <td width="6%">Delete</td>
			<td width="4%">Edit</td>
			<td width="7%">Guard ID</td>
			<td width="14%">Name</td>
			<td width="13%" align="left">Claim Amount</td>
			<td width="31%">Reason</td>
			<td width="8%">Date</td>
			<td width="13%">Approval</td>
		  </tr>
		  <?php
		  // Display the guard claims
		  $result = mysql_query($query);
		  $i = 0;
		   while($row=mysql_fetch_array($result, MYSQL_ASSOC)) { 
			  if(($i%2)==0) {
				     	$rowclass = "oddroow";
				 	} else {
				     	$rowclass = "evenrow";
				 	}
			  //Getting the guard names
			 $line = getRowasArray("SELECT p.firstname, p.lastname, p.othernames FROM persons p, guards g WHERE g.personid=p.id AND g.guardid = '".$row['guardid']."'");
		   ?>
		  <tr class="<?php echo $rowclass; ?>">
		 
		 <td valign="top"><input type="checkbox" name="guardclaims[]" id="guardclaims[]<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>"></td>
		 
		 <td valign="top"><a href="#" onClick="javascript:deleteEntity('../finance/manageguardclaims.php?id=<?php echo $row['id']; ?>&a=delete', 'guard claim', '<?php echo "by ".$line['firstname']." ".$line['lastname']." ".$line['othernames']; ?>')" class="normaltxtlink" title="Delete guard claim">Delete</a></td>
		 
		 <td valign="top"><a href="../finance/guardclaim.php?id=<?php echo encryptValue($row['id']); ?>&a=edit" class="normaltxtlink" title="Modify guard claim.">Edit</a></td>
			
			<td align="left" valign="top"><?php echo $row['guardid']; ?></td>
			<td valign="top"><?php 
			echo $line['firstname']." ".$line['lastname']." ".$line['othernames']; ?></td>
			<td align="center" valign="top"><?php echo commify($row['amount']);?>&nbsp;&nbsp;&nbsp;</td>
			<td valign="top"><div style="padding:3px;width:220px;height:40px;overflow: auto;"><?php echo $row['reason']; ?></div></td>
			<td valign="top"><?php echo date("d-M-Y", strtotime($row['datecreated'])); ?></td>
			<td valign="top" nowrap>
			<a href="#" onClick="javascript:confirmAction('processguardclaim.php?d=<?php echo encryptValue($row['id']);?>&a=<?php echo encryptValue("approve");?>', 'Are you sure you want to approve this claim by <?php echo $line['firstname']." ".$line['lastname']." ".$line['othernames']; ?>?')" class="normaltxtlink" title="Approval of the guard claim">Approve</a>
			[<?php if($row['claimstatus'] == "Approved"){
				echo "Y";
			} else {
				echo "N";
			}?>]			</td>
			
		  </tr>
		  <?php 
		  $i++;
		  } ?>
		</table>
		</div></td>
	  </tr>			
		
		<tr>
		  <td>&nbsp;</td>
		</tr>
		<tr>
		  <td><input  type="submit" <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ echo "name=\"ActivateGuardClaims\" value=\"Re-Activate\""; } else { echo "name=\"ArchiveGuardClaims\" value=\"Archive\"";} ?>> <?php if(isset($_GET['a']) && $_GET['a'] == "search"){ ?><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"><?php } ?> <input type="button" name="Button" id="submit" value="Print"  onClick="openPopWindow(600,350,'Financial Report','print')"></td>
		</tr>
		
		<?php } ?>
	 
	</table></form>
		</td>
	  </tr>
    </table>
	</td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" class="copyright"><?php include("../include/footer.php");?>&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
