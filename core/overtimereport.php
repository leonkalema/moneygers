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
	$query=mysql_query("SELECT * FROM assignments WHERE isactive='N'");
} else {
	$query=mysql_query("SELECT * FROM assignments WHERE isactive='Y'");
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
              <td>
                <input type="button" name="newassignment" value="Create New Assignment" onClick="javascript:document.location.href='../core/assignment.php'">
 [ <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ ?><a href="../core/manageassignments.php">View Active Assignments</a><?php } else {?><a href="../core/manageassignments.php?a=archive">View Archive</a><?php } ?> ]              </td>
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
              <td><div style="padding:4px;width:720px;height:400px;overflow: auto">
			  <table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
                  <tr class="tabheadings">
                    <td width="7%">&nbsp;</td>
					<td width="7%">Edit</td>
                    <td width="13%">Delete</td>
                    <td width="13%">Add Overtime</td>
                    <td width="12%">Client</td>
                    <td width="13%">Call Sign </td>
                    <td width="21%">Service type</td>
                    <td width="18%">Start Date </td>
                    <td width="16%">End Date</td>
                  </tr>
                  <?php
			  $i = 0;
			   while($theassignment=mysql_fetch_array($query, MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
                  <tr class="<?php echo $rowclass; ?>">
                    <td><input type="checkbox" name="assignment[]" id="assignment[]<?php echo $theassignment['id']; ?>" value="<?php echo $theassignment['id']; ?>"></td>
					<td><a href="../core/assignment.php?action=edit&id=<?php echo encryptValue($theassignment['id']); ?>" class="normaltxtlink">Edit</a></td>
                    <td><a href="#" onClick="javascript:deleteEntity('../core/deleteassignment.php?id=<?php echo $theassignment['id']; ?>', 'assignment', '<?php echo $theassignment['name']; ?>')" class="normaltxtlink">Delete</a></td>
                    <td><a href="../core/assignmentovertime.php?id=<?php echo encryptValue($theassignment['callsign']); ?>" class="normaltxtlink">Add</a> (
                        <?php 
				$hours = 0;
				$overtimearray = split(",", $theassignment['overtimeids']);
				for($i=0;$i<count($overtimearray);$i++){
					$overtime = getRowAsArray("SELECT duration FROM assignmentovertime WHERE id='".$overtimearray[$i]."'");
					$hours += $overtime['duration'];
				}
				echo $hours;?>
                      Hrs)</td>
                    <td><a href="../core/assignment.php?a=view&id=<?php echo encryptValue($theassignment['id']); ?>" class="normaltxtlink"><?php echo $theassignment['client'];
				echo  $client['name']; ?></a></td>
                    <td><?php echo $theassignment['callsign']; ?></td>
                    <td><?php echo $theassignment['servicetype']; ?></td>
                    <td><?php echo changeMySQLDateToPageFormat($theassignment['startdate']); ?></td>
                    <td><?php echo changeMySQLDateToPageFormat($theassignment['enddate']); ?></td>
                  </tr>
                  <?php 
			  $i++;
			  } ?>
              </table></div></td>
            </tr>
            <?php } ?>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><input  type="submit" <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ echo "name=\"ActivateAssignments\" value=\"Re-Activate\""; } else { echo "name=\"ArchiveAssignments\" value=\"Archive\"";} ?>></td>
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
