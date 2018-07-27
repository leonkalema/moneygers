<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

// Searching for a assignment overtime	
if(isset($_GET['a']) && $_GET['a'] == "search"){
	$_SESSION['searchassignmentovertime'] = trim($_GET['v']);
	
	//Search through all the assignment overtime and get the relevant results
	
	//search by Client
	if($_GET['type'] == "Client"){
		$searchvalue = $_SESSION['searchassignmentovertime'];
		$searchresultsarray = array();
		
		$where = "WHERE isactive='Y' AND client LIKE '%".$searchvalue."%'";
	}
	//search by call sign
	if($_GET['type'] == "Call Sign"){
		$searchvalue = $_SESSION['searchassignmentovertime'];
		$searchresultsarray = array();
		
		$where = "WHERE isactive='Y' AND callsign LIKE '%".$searchvalue."%'";
	}
	//search by Service type
	if($_GET['type'] == "Service Type"){
		$searchvalue = $_SESSION['searchassignmentovertime'];
		$searchresultsarray = array();
		
		$where = "WHERE isactive='Y' AND servicetype LIKE '%".$searchvalue."%'";
	}	
}
/*else{
	$where="";
}*/
$query=mysql_query("SELECT * FROM assignments ".$where." ORDER BY datecreated DESC");

$assignments = mysql_num_rows($query);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - View Overtime</title>
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
        <td class="headings">Manage Overtime</td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="../core/manageassignments.php">
          <table width="100%" border="0">
            <tr>
              <td></td>
            </tr>
            <tr>
			<?php if(userHasRight($_SESSION['userid'], "91")){?>
              <td>
                <input type="button" name="manageovertime" value="Manage Assignments Overtime" onClick="javascript:document.location.href='../core/manageassignments.php'"></td>
				<?php } ?>	
            </tr>
            <tr>
              <td></td>
            </tr>
			<tr>
              <td>
	  <form method="post" action=""><div id="searchtable"><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search For Assignment Overtime: </td>
                  <td><input name="searchassignmentovertime" id="searchassignmentovertime" type="text" size="20" value="<?php if(isset($_SESSION['searchassignmentovertime'])){ echo $_SESSION['searchassignmentovertime'];}?>"></td>
                  <td class="label">Search By: 
                    <select name="type" id="type">
                      <option value="Client">Client</option>
					  <option value="Call Sign">Call Sign</option>				  
					  <option value="Service Type" <?php if(isset($_GET['type']) && $_GET['type'] == "Service Type"){ echo "selected";}?>>Service Type</option>	
                    </select>                    
					</td>
                  <td><input type="button" name="Button" value="Search" onClick="pickFormItemTypeAndDirect('searchassignmentovertime', '../finance/overtimereport.php?a=search&v=', 'Please enter a client name or call sign')"></td>
                </tr>
              </table>
              </div></form></td>
        </tr>
            <tr>
              <td></td>
            </tr>
            <?php
			if(count($assignments) == 0){          			
				echo "<tr><td>There are no assignments to display</td></tr>";
		   	} else { 
			?>
            <tr>
              <td><div style="padding:4px;width:90%;height:400px;overflow: auto">
			  <table width="100%" border="0" class="contenttableborder" cellpadding="4" cellspacing="0">
                  <tr class="tabheadings">
                    <td width="12%">Client</td>
                    <td width="13%">Call Sign </td>
                    <td width="10%">Service type</td>
					<td width="13%">Overtime</td>
                    <td width="18%">Start Date </td>
                    <td width="16%">End Date</td>
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
                    
                    
                    <td><?php echo $theassignment['client'];
				echo  $client['name']; ?></td>
                    <td><a href="../core/assignment.php?a=view&id=<?php echo encryptValue($theassignment['id']); ?>" class="normaltxtlink" title="View assignment details for <?php echo $theassignment['client'];
				echo  $client['name']; ?>"><?php echo $theassignment['callsign']; ?></a></td>
                    <td><?php echo $theassignment['servicetype']; ?></td>
					<td>(<?php 
				$hours = 0;
				$overtimearray = split(",", $theassignment['overtimeids']);
				for($i=0;$i<count($overtimearray);$i++){
					$overtime = getRowAsArray("SELECT duration FROM assignmentovertime WHERE id='".$overtimearray[$i]."'");
					$hours += $overtime['duration'];
				}
				echo $hours;?>
                      Hrs)
					  <?php if($hours !=0 && userHasRight($_SESSION['userid'], "92")){?><a href="../core/assignmentovertime.php?id=<?php echo encryptValue($theassignment['callsign']); ?>&a=view" class="normaltxtlink" title="View overtime details for <?php echo $theassignment['client'];
				echo  $client['name']; ?>">Details</a><?php } ?>	 </td>
                    <td><?php echo date("d-M-Y",strtotime($theassignment['startdate'])); ?></td>
                    <td><?php echo date("d-M-Y",strtotime($theassignment['enddate'])); ?></td>
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
          </table>
                </form>
    </td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td colspan="2" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</body>
</html>
