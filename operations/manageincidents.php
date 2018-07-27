<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_GET['id']) && isset($_GET['a'])){
	if($_GET['a'] == "delete"){
		mysql_query("DELETE FROM incidents WHERE id = '".trim($_GET['id'])."'");
	}
}

// Searching for incidents
if(isset($_GET['a']) && $_GET['a'] == "search"){
	$_SESSION['searchincident'] = trim($_GET['v']);
	
	//Search through all the assignment overtime and get the relevant results
	
	//search by Reference number
	if($_GET['type'] == "Ref. No"){
		$searchvalue = $_SESSION['searchincident'];
		$searchresultsarray = array();
		
		$where = "WHERE refno LIKE '%".$searchvalue."%'";
	}
	//search by Assignment
	if($_GET['type'] == "Assignment"){
		$searchvalue = $_SESSION['searchincident'];
		$searchresultsarray = array();
		
		$where = "WHERE assignment LIKE '%".$searchvalue."%'";
	}
	
}
else {
	$where = "";
}

$query = "SELECT * FROM incidents ".$where." ORDER BY date_of_entry DESC ";


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Incidents</title>
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
        <td class="headings">Manage Incidents </td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          <tr>
            <td></td>
          </tr>
          <tr>
		  <?php if(userHasRight($_SESSION['userid'], "98")){?>
            <td><span class="label">
              <input type="button" name="newincident" value="Create New Incident" onClick="javascript:document.location.href='../operations/incident.php'">
            </span></td><?php } ?>
            </tr>
          <tr>
            <td></td>
          </tr>
		  <tr>
              <td><form method="post" action="">
			  <div id="searchtable"><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td>Search For Incidents: </td>
                  <td><input name="searchincident" id="searchincident" type="text" size="20" value="<?php if(isset($_SESSION['searchincident'])){ echo $_SESSION['searchincident'];}?>"></td>
                  <td>Search By: 
                    <select name="type" id="type">
                      <option value="Ref. No">Ref. No</option>
					  <option value="Assignment" <?php if(isset($_GET['type']) && $_GET['type'] == "Assignment"){ echo "selected";}?>>Assignment</option>	
                    </select>
				  </td>
                  <td><input type="button" name="Button" value="Search Incidents" onClick="pickFormItemTypeAndDirect('searchincident', '../operations/manageincidents.php?a=search&v=', 'Please enter a reference number or assignment')"></td>
                </tr>
              </table>
              </div></form></td>
            </tr>
            
			<?php
			//$query = "SELECT * FROM incidents";
			
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no incidents to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td>
			<div style="padding:4px;width:720px;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			  <?php if(userHasRight($_SESSION['userid'], "99")){?>
                <td width="7%">Edit</td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "100")){?>
                <td width="7%">Delete</td><?php } ?>
                <?php if(userHasRight($_SESSION['userid'], "98")){?>
				<td width="15%">Actions</td>
				<?php } ?>
                 <td width="15%">Assignment </td>
				 <td width="23%">Reference Number</td>
				 <td width="15%">Date Occured</td>
                 <td width="18%">Action(s) Taken </td>
               
              </tr>
			  <?php
			  // Display the incidents 
			  $incidentresult = mysql_query($query);
			  $i = 0;
			   while($theincident=mysql_fetch_array($incidentresult, MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
                <?php if(userHasRight($_SESSION['userid'], "99")){?>
				<td><a href="incident.php?a=edit&id=<?php echo encryptValue($theincident['id']); ?>" class="normaltxtlink" title="Modify incident details.">Edit</a></td><?php } ?>
                <?php if(userHasRight($_SESSION['userid'], "100")){?>
				<td><a href="#" onClick="javascript:deleteEntity('../operations/manageincidents.php?id=<?php echo $theincident['id']; ?>&a=delete', 'incident', '<?php echo $theincident['refno']; ?>')" class="normaltxtlink" title="Delete this incident.">Delete</a></td><?php } ?>
                <?php if(userHasRight($_SESSION['userid'], "98")){?>
				<td nowrap><a href="../operations/incidentactions.php?id=<?php echo encryptValue($theincident['assignment']);?>" class="normaltxtlink" title="Add/remove actions on this incident.">Manage Actions</a></td>
				<?php } ?>
                <td><?php echo $theincident['assignment']; ?></td>
                <td><a href="incident.php?id=<?php echo encryptValue($theincident['id']); ?>&a=view" class="normaltxtlink" title="View incident details."><?php echo $theincident['refno']; ?></a></td><td nowrap><?php echo date("d-M-Y",strtotime($theincident['date'])); ?></td>
                <td><?php $var1=$theincident['actiontaken']; ?>  
				<?php $var2= explode(",", $var1);
				$num=count($var2);
				echo $num;
				?>
				</td>
				
              </tr>
			  <?php 
			  $i++;
			  } ?>
            </table></div></td>
          </tr>			
			<?php } ?>


        </table>
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
