<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_POST['ArchiveAppraisals'])){
	$formvalues = array_merge($_POST);
	//Archive all selected appraisals
	for($i=0;$i<count($formvalues['appraisal']);$i++){
		mysql_query("UPDATE appraisals SET isactive = 'N' WHERE id='".$formvalues['appraisal'][$i]."'");
	}
}

if(isset($_POST['ActivateAppraisals'])){
	$formvalues = array_merge($_POST);
	//Archive all selected appraisals
	for($i=0;$i<count($formvalues['appraisal']);$i++){
		mysql_query("UPDATE appraisals SET isactive = 'Y' WHERE id='".$formvalues['appraisal'][$i]."'");
	}
}

if(isset($_GET['a']) && $_GET['a'] == "delete"){
	mysql_query("DELETE FROM appraisals WHERE id = '".$_GET['id']."'");
}

if(isset($_GET['a']) && $_GET['a'] == "archive"){
	$query=mysql_query("SELECT * FROM appraisals WHERE isactive='N' ORDER BY registrationdate DESC") or die (mysql_error());
} else{
//searching for appraisals
	if(isset($_GET['v']) && trim($_GET['v']) != "" || isset($_GET['t'])){
	$_SESSION['searchappraisal'] = $_GET['v'];
	
	if(isset($_GET['t'])){
		$wherestr = " WHERE a.isactive='Y' AND a.guard=g.guardid ";
		if(trim($_GET['v']) != ""){
			$wherestr .= " AND a.guard LIKE '%".trim($_GET['v'])."%'";
		}
		$wherestr .= " AND j.id = g.jobtitle AND (j.jobtitle = 'Driver' OR j.jobtitle = 'Car Commander')";
	} else {
		$wherestr = " WHERE a.isactive='Y' AND a.guard LIKE '%".trim($_GET['v'])."%'";
	}
	
	$query=mysql_query("SELECT a.id, a.details, a.guard, a.madeby, a.registrationdate, a.assignment FROM appraisals a, guards g, jobtitles j ".$wherestr." ORDER BY a.registrationdate DESC");
 
	} else {
		$query=mysql_query("SELECT * FROM appraisals WHERE isactive='Y' ORDER BY registrationdate DESC");
	}
}


$appraisals = mysql_num_rows($query);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Guard Appraisals</title>
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
        <td class="headings">Manage Appraisals</td>
      </tr>
      <tr>
        <td>
<form name="form1" method="post" action="appraisals.php">
		<table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td>&nbsp;</td>
          </tr>
		  <?php if(!isset($_GET['t'])){?>
          <tr>
            <td><?php if(userHasRight($_SESSION['userid'], "172")){?>
			<span class="label">
              <input type="button" name="newappraisal" value="Create New Appraisal" onClick="javascript:document.location.href='../operations/addappraisal.php'">
            </span> <?php } ?> 
			[ <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ ?><a href="../operations/appraisals.php" title="Displays active appraisals.">View Active Appraisals</a><?php } else {?><a href="../operations/appraisals.php?a=archive" title="Displays appraisals who have been archived.">View Archive</a><?php } ?> ]   </td>           
            </tr>
          <tr>
              <td>&nbsp;</td>
            </tr>
			<?php } ?>
            <tr>
              <td><div id="searchtable"><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td>Search For Appraisals:<br>
                    (Enter guard's ID) </td>
                  <td><input name="searchappraisal" id="searchappraisal" type="text" size="30" value="<?php if(isset($_SESSION['searchappraisal'])){ echo $_SESSION['searchappraisal'];}?>"></td>
                  <td><input type="button" name="Button" value="Search Appraisals" onClick="pickFormItemAndDirect('searchappraisal', '../operations/appraisals.php?<?php if(isset($_GET['t'])){ echo "t=drivers&";}?>v=', 'Please enter all or part of the appraisal name')"></td>
                </tr>
              </table>
              </div></td>
            </tr>
            
            <tr>
              <td>&nbsp;</td>
            </tr>
			<?php
			if(count($appraisals) == 0){          			
				echo "<tr><td>There are no appraisals to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:740px;height:270px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			  	<?php if(!isset($_GET['t'])){?><td></td>
				<?php if(userHasRight($_SESSION['userid'], "173")){?>
                <td>Edit</td>
				<?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "171")){?>
                <td>Delete</td>
				<?php }
				
				} ?>
                <td>Guard</td>
                <td>Assignment</td>
                <td>Appraisal</td>
				<td>Made By</td>
				<td>Date</td>
              </tr>
			  <?php
			  $i = 0;
			   while($row=mysql_fetch_array($query, MYSQL_ASSOC)) { 
			     if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
			  <?php if(!isset($_GET['t'])){?><td><input type="checkbox" name="appraisal[]" id="appraisal[]<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>"></td>
              <?php if(userHasRight($_SESSION['userid'], "173")){?>
			  <td><a href="../operations/addappraisal.php?action=edit&id=<?php echo encryptValue($row['id']); ?>" class="normaltxtlink" title="Modify appraisal details.">Edit</a></td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "172")){?>
                <td><a href="#" onClick="javascript:deleteEntity('../operations/appraisals.php?id=<?php echo $row['id']; ?>&a=delete', 'appraisal', '<?php echo $row['details']; ?>')" class="normaltxtlink" title="Delete appraisal.">Delete</a></td><?php } 
				}
				?>
				
				
                <td><?php 
				
				echo $row['guard'];?></td>
				
                <td><?php $assignarr = getRowAsArray("SELECT client FROM assignments WHERE callsign= '".$row['assignment']."'"); 
				echo $row['assignment']." (".$assignarr['client'].")";
				?></td>
				<td><?php echo "<div style='width:150px'>".$row['details']."</div>"; ?></td>
				<td><?php echo $row['madeby']; ?></td>
                <td><?php echo date("d-M-Y",strtotime($row['registrationdate'])); ?></td>
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
			<?php if(!isset($_GET['t'])){?>
		 <tr>
			 <td><input  type="submit" <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ echo "name=\"ActivateAppraisals\" value=\"Re-Activate\""; } else { echo "name=\"ArchiveAppraisals\" value=\"Archive\"";} ?>> <?php if(isset($_GET['a']) && $_GET['a'] == "search"){ ?><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"><?php } ?>
			 </td>
         </tr><?php } ?>
        </table>
		</form></td>
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
