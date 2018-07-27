<?php
include_once "../class/class.client.php";
session_start();
openDatabaseConnection();

//
//$client = new Client;
/*
// If you are searching for clients
if(isset($_GET['v']) && trim($_GET['v']) != ""){
	$_SESSION['searchclient'] = $_GET['v'];

	$where = "WHERE name LIKE '%".trim($_GET['v'])."%'";
	$clients = $client->getSearchableClients($where);
}else { 
	$clients = $client->getAllClients();
}*/
if(isset($_POST['ArchiveClients'])){
	$formvalues = array_merge($_POST);
	//Archive all selected clients
	for($i=0;$i<count($formvalues['client']);$i++){
		mysql_query("UPDATE clients SET isactive = 'N' WHERE id='".$formvalues['client'][$i]."'");
	}
	//forwardToPage("manageclients.php");
}

if(isset($_POST['ActivateClients'])){
	$formvalues = array_merge($_POST);
	//Archive all selected clients
	for($i=0;$i<count($formvalues['client']);$i++){
		mysql_query("UPDATE clients SET isactive = 'Y' WHERE id='".$formvalues['client'][$i]."'");
	}
	//forwardToPage("manageclients.php");
}

if(isset($_GET['a']) && $_GET['a'] == "archive"){
	$query=mysql_query("SELECT * FROM clients WHERE isactive='N' ORDER BY datecreated DESC") or die (mysql_error());
} else {
//searching for clients
	if(isset($_GET['v']) && trim($_GET['v']) != ""){
	$_SESSION['searchclient'] = $_GET['v'];

	$where = " WHERE isactive='Y' AND name LIKE '%".trim($_GET['v'])."%'";
	//$clients = $client->getSearchableClients($where);
	$query=mysql_query("SELECT * FROM clients ".$where." ORDER BY datecreated DESC");
} 
	else {
		$query=mysql_query("SELECT * FROM clients WHERE isactive='Y' ORDER BY datecreated DESC");
		}
}


$clients = mysql_num_rows($query);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Clients</title>
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
        <td class="headings">Manage Clients </td>
      </tr>
      <tr>
        <td>
		<form name="form1" method="post" action="manageclients.php">
		<table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?php if(userHasRight($_SESSION['userid'], "48")){?>
			<span class="label">
              <input type="button" name="newclient" value="Create New Client" onClick="javascript:document.location.href='../core/client.php'">
            </span> <?php } ?> 
			[ <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ ?><a href="../core/manageclients.php" title="Displays active clients.">View Active Clients</a><?php } else {?><a href="../core/manageclients.php?a=archive" title="Displays clients who have been archived.">View Archive</a><?php } ?> ]   </td>           
            </tr>
          <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><div id="searchtable"><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search For Client: </td>
                  <td><input name="searchclient" id="searchclient" type="text" size="30" value="<?php if(isset($_SESSION['searchclient'])){ echo $_SESSION['searchclient'];}?>"></td>
                
                 <td><input type="button" name="Button" value="Search Clients" onClick="pickFormItemAndDirect('searchclient', '../core/manageclients.php?v=', 'Please enter all or part of the client name')"></td>
                </tr>
              </table>
              </div></td>
            </tr>
            
            <tr>
              <td>&nbsp;</td>
            </tr>
			<?php
			if(count($clients) == 0){          			
				echo "<tr><td>There are no clients to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:97%;height:420px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			  	<?php if(userHasRight($_SESSION['userid'], "53")){?>
                <td></td>
                
				<td>Edit</td>
				<?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "49")){?>
                <td>Delete</td>
				<?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "47")){?>
                <td>Add Assignment</td>
				<?php } ?>
                <td>Name</td>
                <td>Mobile Phone</td>
                <td>Fax</td>
				<td>Email</td>
                <td>Assignments</td>
                <!--td>Is Active</td-->
                <td>Client Period </td>
                <td></td>
              </tr>
			  <?php
			  $i = 0;
			   while($theclient=mysql_fetch_array($query, MYSQL_ASSOC)) { 
			   //foreach($clients as $theclient) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
			  <?php if(userHasRight($_SESSION['userid'], "53")){?>
			  <td><input type="checkbox" name="client[]" id="client[]<?php echo $theclient['id']; ?>" value="<?php echo $theclient['id']; ?>"></td>
                <td><a href="../core/client.php?action=edit&id=<?php echo encryptValue($theclient['id']); ?>" title="Modify client's details.">Edit</a></td>
                <?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "49")){?>
                <td><a href="#" onClick="javascript:deleteEntity('../core/deleteclient.php?id=<?php echo $theclient['id']; ?>', 'client', '<?php echo $theclient['name']; ?>')" class="normaltxtlink" title="Delete client.">Delete</a></td>
                <?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "47")){?>
                <td><a href="../core/assignment.php?clientid=<?php echo encryptValue($theclient['id']); ?>" title="Add assignment for <?php echo $theclient['name']; ?>.">Add Assignment</a></td>
				<?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "51")){?>
                <td><a href="../core/viewclient.php?id=<?php echo encryptValue($theclient['id']); ?>" class="normaltxtlink" title="View client's details."><?php echo $theclient['name']; ?></a></td>
				<?php } ?>
                <td><?php echo $theclient['contphone']; ?></td>
				<td><?php echo $theclient['fax']; ?></td>
				<td><?php echo $theclient['email']; ?></td>
                <td>
				<?php
				$q=mysql_query("SELECT count(id) AS number FROM assignments WHERE client='".$theclient['name']."' GROUP BY client");
				
				$row=mysql_fetch_array($q);
				$no_assignments=$row['number'];
				if($no_assignments==0) { 
					echo "0"; 
				} else { 
					echo $no_assignments;  
					if(userHasRight($_SESSION['userid'], "51")){?> <a href="manageassignments.php?a=search&clientid=<?php echo encryptValue($theclient['id']); ?>" title="View assignments for <?php echo $theclient['name']; ?>.">View All</a><?php } 		}		
				?>
				
				&nbsp;</td>
                <!--td><?php echo changeBinaryToPageValues($theclient['isactive']); ?></td-->
                <td nowrap="nowrap"><?php 
				$datecreated=$theclient['datecreated'];
				$age=strtotime(date('y-m-d'))-strtotime($datecreated);
				$age1=round($age/84270);
				echo $age1." days";
				
				 ?>&nbsp;</td>
                 <td><a href="managebuildings.php?id=<?php echo encryptValue($theclient['id']); ?>" title="Manage buildlings for <?php echo $theclient['name']; ?>.">Buildings</a></td>
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
			 <td><input  type="submit" <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ echo "name=\"ActivateClients\" value=\"Re-Activate\""; } else { echo "name=\"ArchiveClients\" value=\"Archive\"";} ?>> <?php if(isset($_GET['a']) && $_GET['a'] == "search"){ ?><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"><?php } ?>
			 </td>
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
