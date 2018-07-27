<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_GET['t']) && trim($_GET['t']) != ""){
	$type_view = decryptValue($_GET['t']);
} else {
	$type_view = "Client";
}

if(isset($_POST['ArchiveComplaints'])){
	$formvalues = array_merge($_POST);
	//Archive all selected complaints
	for($i=0;$i<count($formvalues['complaint']);$i++){
		mysql_query("UPDATE complaints SET isactive = 'N' WHERE id='".$formvalues['complaint'][$i]."'");
	}
	forwardToPage("complaints.php?t=".encryptValue($formvalues['whotype']));
}

if(isset($_POST['ActivateComplaints'])){
	$formvalues = array_merge($_POST);
	//Archive all selected complaints
	for($i=0;$i<count($formvalues['complaint']);$i++){
		mysql_query("UPDATE complaints SET isactive = 'Y' WHERE id='".$formvalues['complaint'][$i]."'");
	}
	forwardToPage("complaints.php?t=".encryptValue($formvalues['whotype']));
}

if(isset($_GET['a']) && $_GET['a'] == "delete"){
	mysql_query("DELETE FROM complaints WHERE id = '".$_GET['id']."'");
}

if(isset($_GET['a']) && $_GET['a'] == "archive"){
	$query="SELECT * FROM complaints WHERE isactive='N' AND  type='".$type_view."'ORDER BY madeon DESC";
} else{
//searching for complaints
	if(isset($_GET['v']) && trim($_GET['v']) != ""){
	$_SESSION['searchcomplaint'] = $_GET['v'];

	$where = " WHERE isactive='Y' AND madeby LIKE '%".trim($_GET['v'])."%' AND type='".$type_view."'";
	$query="SELECT * FROM complaints ".$where." ORDER BY madeon DESC";

	} else {
		$query="SELECT * FROM complaints WHERE isactive='Y' AND type='".$type_view."' ORDER BY madeon DESC";
	}
}

$complaintresult = mysql_query($query);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage <?php echo $type_view;?> Complaints</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings">Manage <?php echo $type_view;?> Complaints</td>
      </tr>
      <tr>
        <td>
<form name="form1" method="post" action="complaints.php">
		<table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?php if(userHasRight($_SESSION['userid'], "177")){?>
			<input type="button" name="newcomplaint" value="Create New Complaint" onClick="javascript:document.location.href='../operations/addcomplaint.php?t=<?php echo encryptValue($type_view);?>'">
             <?php } ?> 
			[ <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ ?><a href="../operations/complaints.php?t=<?php echo encryptValue($type_view);?>" title="Displays active complaints.">View Active Complaints</a><?php } else {?><a href="../operations/complaints.php?a=archive&t=<?php echo encryptValue($type_view);?>" title="Displays complaints which have been archived.">View Archive</a><?php } ?> ]   </td>           
            </tr>
          <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><div id="searchtable"><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td>Search For Complaints:<br>
                    (Enter <?php echo $type_view; ?> Name) </td>
                  <td><input name="searchcomplaint" id="searchcomplaint" type="text" size="30" value="<?php if(isset($_SESSION['searchcomplaint'])){ echo $_SESSION['searchcomplaint'];}?>"></td>
                  <td><input type="button" name="Button" value="Search Complaints" onClick="pickFormItemAndDirect('searchcomplaint', '../operations/complaints.php?t=<?php echo encryptValue($type_view);?>&v=', 'Please enter all or part of the complaint name')"></td>
                </tr>
              </table>
              </div></td>
            </tr>
            
            <tr>
              <td>&nbsp;</td>
            </tr>
			<?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no complaints to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:97%;height:270px;overflow: auto">
			<table width="99%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			  	<td width="4%"></td>
				<?php if(userHasRight($_SESSION['userid'], "174") || userHasRight($_SESSION['userid'], "175")){?>
                <td width="7%">Edit</td>
				<?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "179") || userHasRight($_SESSION['userid'], "180")){?>
                <td width="10%">Delete</td>
				<?php } ?>
                <td width="24%"><?php echo $type_view;?></td>
                <td width="45%">Complaint</td>
                <td width="10%">Made On</td>
              </tr>
			  <?php
			  $i = 0;
			   while($row=mysql_fetch_array($complaintresult, MYSQL_ASSOC)) { 
			     if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
			  <td><input type="checkbox" name="complaint[]" id="complaint[]<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>"></td>
              <?php if(userHasRight($_SESSION['userid'], "174") || userHasRight($_SESSION['userid'], "175")){?>
			  <td><a href="../operations/addcomplaint.php?action=edit&id=<?php echo encryptValue($row['id']); ?>&t=<?php echo encryptValue($type_view); ?>" class="normaltxtlink" title="Modify complaint details.">Edit</a></td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "179") || userHasRight($_SESSION['userid'], "180")){?>
                <td><a href="#" onClick="javascript:deleteEntity('../operations/complaints.php?id=<?php echo $row['id']; ?>&t=<?php echo encryptValue($type_view);?>&a=delete', 'complaint', '<?php echo $row['details']; ?>')" class="normaltxtlink" title="Delete complaint.">Delete</a></td><?php } ?>
				
				
                <td><?php 
				if($type_view == "Guard"){
					echo getGuardNameById($row['madeby']);
				} else {
					echo $row['madeby'];
				}
				?></td>
				<td><?php echo "<div style='width:220px;'>".$row['details']."</div>"; ?></td>
				<td><?php echo date("d-M-Y",strtotime($row['madeon'])); ?></td>
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
			 <td><input  type="submit" <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ echo "name=\"ActivateComplaints\" value=\"Re-Activate\""; } else { echo "name=\"ArchiveComplaints\" value=\"Archive\"";} ?>> <?php if(isset($_GET['a']) && $_GET['a'] == "search"){ ?><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"><?php } ?>
			   <input type="hidden" name="whotype" id="whotype" value="<?php 
			 echo $type_view; ?>"></td>
         </tr>
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
