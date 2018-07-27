<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_POST['ArchiveAssignments'])){
	$formvalues = array_merge($_POST);
	//Archive all selected assignments
	for($i=0;$i<count($formvalues['assignment']);$i++){
		mysql_query("UPDATE assignments SET isactive = 'N' WHERE id='".$formvalues['assignment'][$i]."'");
	}
	forwardToPage("manageassignments.php");
}

if(isset($_POST['ActivateAssignments'])){
	$formvalues = array_merge($_POST);
	//Archive all selected assignments
	for($i=0;$i<count($formvalues['assignment']);$i++){
		mysql_query("UPDATE assignments SET isactive = 'Y' WHERE id='".$formvalues['assignment'][$i]."'");
	}
	forwardToPage("manageassignments.php");
}


if(isset($_GET['a']) && $_GET['a'] == "archive"){
	$query=mysql_query("SELECT * FROM assignments WHERE isactive='N' ORDER BY datecreated DESC");
} else {
	if(isset($_GET['a']) && $_GET['a'] == "search"){
		$clientid=decryptValue($_GET['clientid']);
		$clientdata = getRowAsArray("SELECT name FROM clients WHERE id='$clientid' ");
		$query=mysql_query("SELECT * FROM assignments WHERE isactive='Y' AND client= '".$clientdata['name']."' ORDER BY datecreated DESC");
		
		$_SESSION['searchassignment'] = trim($_GET['v']);
	
	//search by Client Name
	if($_GET['type'] == "Client Name"){
		$searchvalue = $_SESSION['searchassignment'];
		$searchresultsarray = array();
		
		$where = "WHERE isactive='Y' AND client LIKE '%".$searchvalue."%'";
		$query=mysql_query("SELECT * FROM assignments ".$where." ORDER BY datecreated DESC");
	}
	//search by Call Sign
	if($_GET['type'] == "Call Sign"){
		$searchvalue = $_SESSION['searchassignment'];
		$searchresultsarray = array();
		
		$where = "WHERE isactive='Y' AND callsign LIKE '%".$searchvalue."%'";
		$query=mysql_query("SELECT * FROM assignments ".$where." ORDER BY datecreated DESC");
	}
	//search by Service type
	if($_GET['type'] == "Service Type"){
		$searchvalue = $_SESSION['searchassignment'];
		$searchresultsarray = array();
		
		$where = "WHERE isactive='Y' AND servicetype LIKE '%".$searchvalue."%'";
		$query=mysql_query("SELECT * FROM assignments ".$where." ORDER BY datecreated DESC");
	}	
		
} 
	else {
		$query=mysql_query("SELECT * FROM assignments WHERE isactive='Y' ORDER BY lastupdatedate  DESC");
		}
}


$assignments = mysql_num_rows($query);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Assignments</title>
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
        <td class="headings">Manage Assignments </td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="manageassignments.php">
          <table width="100%" border="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td> <?php if(userHasRight($_SESSION['userid'], "47")){?>
                <input type="button" name="newassignment" value="Create New Assignment" onClick="javascript:document.location.href='../core/assignment.php'"><?php } ?>				
 [ <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ ?><a href="../core/manageassignments.php" title="Displays active assignments.">View Active Assignments</a><?php } else {?><a href="../core/manageassignments.php?a=archive" title="Displays assignments that have been archived.">View Archive</a><?php } ?> ]              </td>
            </tr>
			 <tr>
         <td>&nbsp;</td>
       </tr>
	  <td><div id="searchtable"><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search for Assignments: </td>
                  <td><input name="searchassignment" id="searchassignment" type="text" size="20" value="<?php if(isset($_SESSION['searchassignment'])){ echo $_SESSION['searchassignment'];}?>"></td>
                  <td nowrap><span class="label">Search By:</span>                    <select name="type" id="type">
                      <option value="Client Name">Client Name</option>
					  <option value="Call Sign">Call Sign</option>
					  <option value="Service Type" <?php if(isset($_GET['type']) && $_GET['type'] == "Service Type"){ echo "selected";}?>>Service Type</option>
                    </select>					</td>
                  <td><input type="button" name="Button" value="Search Assignments" onClick="pickFormItemTypeAndDirect('searchassignment', '../core/manageassignments.php?a=search&v=', 'Please enter a client name or service type')"></td>
                </tr>
              </table>
              </div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
			
			
            <?php
			if(count($assignments) == 0){          			
				echo "<tr><td>There are no assignments to display</td></tr>";
		   	} else { 
			?>
            <tr>
              <td><div style="padding:4px;width:97%;height:400px;overflow: auto">
			  <table width="99%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
                  <tr class="tabheadings">
					<?php if(userHasRight($_SESSION['userid'], "47")){?>
                    <td>&nbsp;</td>
					<td>Edit</td><?php } ?>
					<?php if(userHasRight($_SESSION['userid'], "47")){?>
                    <td>Delete</td><?php } ?>
					<td>Client</td>
                    <td>Call Sign </td>
                    <td>Service type</td>
                    <td>Start Date </td>
                    <td>End Date</td>
					<?php if(userHasRight($_SESSION['userid'], "186")){?>
					<td>Generate Temp WO </td>
					<?php } ?>
                  </tr>
                  <?php
			  $j = 0;
			   while($theassignment=mysql_fetch_array($query, MYSQL_ASSOC)) { 
			      if(($j%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
                  <tr class="<?php echo $rowclass; ?>">
                    
					<?php if(userHasRight($_SESSION['userid'], "47")){?>
					<td><input type="checkbox" name="assignment[]" id="assignment[]<?php echo $theassignment['id']; ?>" value="<?php echo $theassignment['id']; ?>"></td>
					<td><a href="../core/assignment.php?action=edit&id=<?php echo encryptValue($theassignment['id']); ?>" title="Modify assignment.">Edit</a></td>
					<?php } ?>
					<?php if(userHasRight($_SESSION['userid'], "47")){?>
                    <td><a href="#" onClick="javascript:deleteEntity('../core/deleteassignment.php?id=<?php echo encryptValue($theassignment['id']); ?>', 'assignment', '<?php echo $theassignment['name']; ?>')" title="Delete assignment.">Delete</a></td>
                    <?php } ?>
                   
                    <td><a href="../core/assignment.php?a=view&id=<?php echo encryptValue($theassignment['id']); ?>" class="normaltxtlink" title="View assignment information for <?php echo $theassignment['client'];  $client['name']; ?>"><?php echo $theassignment['client'];	echo  $client['name']; ?></a></td>
                    <td><?php echo $theassignment['callsign']; ?></td>
                    <td><?php echo $theassignment['servicetype']; ?></td>
                    <td nowrap="nowrap"><?php echo date("d-M-Y",strtotime($theassignment['startdate'])); ?></td>
                    <td nowrap="nowrap"><?php 
					if(trim($theassignment['enddate']) != "" && $theassignment['enddate'] !="0000-00-00"){
					echo date("d-M-Y",strtotime($theassignment['enddate']));
					} ?></td>
					<?php if(userHasRight($_SESSION['userid'], "186")){?>
					<td nowrap="nowrap"><img src="../images/file.gif" alt="Assignment Temporary Works Order" border="0">  <a href="../core/generatetwo.php?id=<?php echo $theassignment['id'];?>&t=<?php 
					if(preg_match("/alarm/i",$theassignment['servicetype'])){
						$type = "alarm";
					} else if(preg_match("/shift/i",$theassignment['servicetype'])){
						$type = "guard";
					} else {
						$type = "both";
					}
					echo encryptValue($type);?>"  title="Generate the Temporary Works Order for this assignment.">Work Order </a></td>
					<?php }?>
                  </tr>
                  <?php 
			  $j++;
			  } ?>
              </table></div></td>
            </tr>
            <?php } ?>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><?php if(userHasRight($_SESSION['userid'], "47")){?>
			  <input  type="submit" <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ echo "name=\"ActivateAssignments\" value=\"Re-Activate\""; } else { echo "name=\"ArchiveAssignments\" value=\"Archive\"";} ?>><?php } ?>
			   <?php if(isset($_GET['a']) && $_GET['a'] == "search"){ ?><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"><?php } ?></td>
            </tr>
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
