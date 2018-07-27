<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_POST['ArchiveInspections'])){
	$formvalues = array_merge($_POST);
	//Archive all selected inspections
	for($i=0;$i<count($formvalues['inspection']);$i++){
		mysql_query("UPDATE inspections SET isactive = 'N' WHERE id='".$formvalues['inspection'][$i]."'");
	}
}

if(isset($_POST['ActivateInspections'])){
	$formvalues = array_merge($_POST);
	//Archive all selected inspections
	for($i=0;$i<count($formvalues['inspection']);$i++){
		mysql_query("UPDATE inspections SET isactive = 'Y' WHERE id='".$formvalues['inspection'][$i]."'");
	}
}

if(isset($_GET['a']) && $_GET['a'] == "delete"){
	$inspectionsarr = getRowAsArray("SELECT commentids FROM inspections WHERE id = '".$_GET['id']."'");
	$commentstodelete = split(",",$inspectionsarr['commentids']);
	//delete all the comments attached to the inspection
	for($i=0;$i<count($commentstodelete); $i++){
		mysql_query("DELETE FROM comments WHERE id = '".$commentstodelete[$i]."'");
	}
	//Then also delete the inspection record
	mysql_query("DELETE FROM inspections WHERE id = '".$_GET['id']."'");
	
}

//Search for inspections
if(isset($_POST['Search'])){
	$formvalues = array_merge($_POST);
	$wherestr = "AND date_of_entry = ".changeDateFromPageCombosToMySQLFormat($formvalues['search_day'], $formvalues['search_month'], $formvalues['search_year']);
	
	$query="SELECT * FROM inspections WHERE isactive='Y' ".$wherestr." ORDER BY date_of_entry DESC";
	
} else {
	$query="SELECT * FROM inspections WHERE isactive='Y' ORDER BY date_of_entry DESC";
}

if(isset($_GET['a']) && $_GET['a'] == "archive"){
	$query="SELECT * FROM inspections WHERE isactive='N' ORDER BY date_of_entry DESC";

}

$inspectionresult = mysql_query($query);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Inspections</title>
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
        <td class="headings">Manage Assignment Inspection </td>
      </tr>
      <tr>
        <td>
<form name="form1" method="post" action="inspections.php">
		<table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?php if(userHasRight($_SESSION['userid'], "177")){?>
			<input type="button" name="newinspection" value="Create New inspection" onClick="javascript:document.location.href='../operations/addinspection.php'">
             <?php } ?> 
			[ <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ ?><a href="../operations/inspections.php" title="Displays active inspections.">View Active Inspections</a><?php } else {?><a href="../operations/inspections.php?a=archive" title="Displays inspections which have been archived.">View Archive</a><?php } ?> ]   </td>           
            </tr>
          <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><div id="searchtable"><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td>Search For Inspections:<br>
                    (Select Date) </td>
                  <td nowrap>Day:
                    
                    <select id="search_day" name="search_day">
                      <?php 
if(isset($formvalues['search_day'])){
 	$date = $formvalues['search_day'];
 } else {
 	$date = date("d", strtotime("now"));
 }
echo generateSelectOptions(getTime('day',''), $date);?>
                    </select>
                    &nbsp;Month:

<select id="search_month" name="search_month">
  <?php 
if(isset($formvalues['search_month'])){
 	$date = $formvalues['search_month'];
 } else {
 	$date = date("F", strtotime("now"));
 }
 echo generateSelectOptions(getTime('month',''), $date);?>
</select>
&nbsp;Year:

<select id="search_year" name="search_year">
  <?php 
if(isset($formvalues['search_year'])){
 	$date = $formvalues['search_year'];
 } else {
 	$date = date("Y", strtotime("now"));
 }
 echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select></td>
                  <td><input type="submit" name="Search" id="Search" value="Search Inspections"></td>
                </tr>
              </table>
              </div></td>
            </tr>
            
            <tr>
              <td>&nbsp;</td>
            </tr>
			<?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no inspections to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:740px;height:270px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			  	<td></td>
				<?php if(userHasRight($_SESSION['userid'], "181")){?>
                <td>Edit</td>
				<?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "183")){?>
                <td>Delete</td>
				<?php } ?>
                <td>Date of Inspection</td>
				<td>Inspector</td>
                <td>Assignments</td>
                <td>Reports</td>
              </tr>
			  <?php
			  $i = 0;
			   while($row=mysql_fetch_array($inspectionresult, MYSQL_ASSOC)) { 
			     if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
			  <td><input type="checkbox" name="inspection[]" id="inspection[]<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>"></td>
              <?php if(userHasRight($_SESSION['userid'], "181")){?>
			  <td><a href="../operations/addinspection.php?a=edit&id=<?php echo encryptValue($row['id']); ?>" class="normaltxtlink" title="Modify inspection details.">Edit</a></td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "183")){?>
                <td><a href="#" onClick="javascript:deleteEntity('../operations/inspections.php?id=<?php echo $row['id']; ?>&a=delete', 'inspection', '<?php echo $row['details']; ?>')" class="normaltxtlink" title="Delete inspection.">Delete</a></td><?php } ?>
				
				
                <td><?php echo date("d-M-Y",strtotime($row['date_of_entry']));?></td>
				<td><?php echo getGuardNameById($row['madeby'])." (".$row['madeby'].")"; ?></td>
				<td><?php 
				//getRowAsArray("SELECT g.guardid , concat(p.firstname,' ', p.lastname,' ', p.othernames)  AS name FROM persons p, guards g WHERE name = '".$row['madeby']."'");
				$commentresult = mysql_query("SELECT * FROM comments WHERE madeby = '".$row['madeby']."' AND type = 'Inspection'");
				
				$assignment_arr = array();
				while($line = mysql_fetch_array($commentresult, MYSQL_ASSOC)){
					if(date("d-M-Y",strtotime($line['date'])) == date("d-M-Y",strtotime($row['date_of_entry']))){
					array_push($assignment_arr, $line['location']);
					}
				}
				echo implode(",",$assignment_arr); ?></td>
				<td><a href="../operations/addinspection.php?a=view&id=<?php echo encryptValue($row['id']); ?>" class="normaltxtlink" title="View all inspection reports for <?php echo $row['madeby']; ?> on <?php echo date("d-M-Y",strtotime($row['date_of_entry']));?>.">View All (<?php echo howManyRows("SELECT * FROM comments WHERE madeby = '".$row['madeby']."' AND date = '".$row['date_of_entry']."' AND type = 'Inspection'"); ?>)</a></td>
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
			 <td><input  type="submit" <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ echo "name=\"ActivateInspections\" value=\"Re-Activate\""; } else { echo "name=\"ArchiveInspections\" value=\"Archive\"";} ?>> <?php if(isset($_GET['a']) && $_GET['a'] == "search"){ ?><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"><?php } ?>
			   </td>
         </tr>
        </table>
		</form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" class="copyright">&copy;Solutions 
      For Business Limited</td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
