<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

	//Get all the known statuses in the db
	$statusarr = getAllScheduleStatus();
	//$id=$_GET['id'];
	
	// If you are searching
	if(isset($_GET['v']) && trim($_GET['v']) != ""){
		$_SESSION['searchactiveguard'] = trim($_GET['v']);
		$searchvalues = $_SESSION['searchactiveguard'];
		
		// Scan through the search values separated by a space
		$searchvalue = explode(" ",$searchvalues);
		
		$whereclause = "AND (p.firstname LIKE '%".$searchvalue[0]."%' OR p.lastname LIKE '%".$searchvalue[0]."%' OR p.othernames LIKE '%".$searchvalue[0]."%'  OR p.birthlastname LIKE '%".$searchvalue[0]."%') AND (p.lastname LIKE '%".$searchvalue[1]."%' OR p.firstname LIKE '%".$searchvalue[1]."%' OR p.othernames LIKE '%".$searchvalue[1]."%' OR p.birthlastname LIKE '%".$searchvalue[1]."%') ";
		
		
	} else { $whereclause = "";}
	
	$q=mysql_query("SELECT g.id, g.guardid, g.dateofemployment FROM persons p, guards g WHERE g.personid = p.id AND g.isarchived = 'N' ".$whereclause);
	$personnels = mysql_num_rows($q);
	
	//Get the active guards into an array
	$schedulearray = getRowAsArray("SELECT schedule FROM guardschedule WHERE dateentered = '".date("Y-m-d", strtotime("now"))."'");
	
	//Set to yesterday's schedule if today's is not yet submitted.
	if($schedulearray['schedule'] == ""){
		$schedulearray = getRowAsArray("SELECT schedule FROM guardschedule WHERE dateentered = ".date("Y-m-d", strtotime("yesterday"))."");
	}
	
	$schedules = split(",",$schedulearray['schedule']);
	$availableguards = array();
	for($i=0;$i<count($schedules);$i++){
		$schedulepair = split("=",$schedules[$i]);
		//Add to the available guards if the guard is assigned to avaialble assignments
		if(!in_array($schedulepair[1], $statusarr) && $schedulepair[1] != ""){
			array_push($availableguards,$schedulepair[0]);
		}
	}
	// get the call sign of the assignment.
	$guardlocations = array();
	for($i=0;$i<count($schedules);$i++){
		$schedulepair = split("=",$schedules[$i]);
		//Add to the available guards if the guard is assigned to avaialble assignments
		if(!in_array($schedulepair[1], $statusarr) && $schedulepair[1] != ""){
			array_push($guardlocations,$schedulepair[1]);
		}
	}
	
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Guard Locations</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>

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
    <td height="136" colspan="2" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings">Guard Location <?php if (isset($_GET['v'])) {?> <a href="../operations/guardlocation.php">View All </a><?php } ?></td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          
          <tr>
            <td>&nbsp;</td>
          </tr>
		  <tr>
		    <td><div id="searchtable">
              <table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td>Search For Active Guards:</td>
                  <td><input name="searchactiveguard" id="searchactiveguard" type="text" size="30" value="<?php if(isset($_SESSION['searchactiveguard'])){ echo $_SESSION['searchactiveguard'];}?>"></td>
                  <td><input type="button" name="Button" value="Search Active Guards" onClick="pickFormItemAndDirect('searchactiveguard', '../operations/guardlocation.php?v=', 'Please enter all or part of the guard ID')"></td>
                </tr>
              </table>
            </div></td>
          </tr>
			<?php
			if($personnels == 0){          			
				echo "<tr><td>There are no Guard locations for today to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:720px;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
                <td width="19%">Guard ID </td>
                <td width="23%">Guard Name </td>
				<td width="21%">Today's Location </td>
              </tr>
			  <?php
			  $i=0;
			   	while($thepersonnel=mysql_fetch_array($q,MYSQL_ASSOC)){
				if($i<sizeof($guardlocations)){
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
				  
				  //Show only the active guards
				  if(in_array($thepersonnel['guardid'],$availableguards)){
			   ?>
              <tr class="<?php echo $rowclass; ?>">
                <td><?php echo $thepersonnel['guardid'];?></td>
                <td><?php 
				$guard = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames FROM guards g, persons p WHERE g.personid = p.id AND g.guardid = '".$thepersonnel['guardid']."'"); ?>
				<a href="../hr/index.php?id=<?php echo encryptValue($thepersonnel['id']); ?>&a=view" class="normaltxtlink"  title="View guard's details."><?php echo $guard['firstname']." ".$guard['lastname']." ".$guard['othernames']; ?></a></td>
                <td><?php
					$sub= mysql_query("SELECT client FROM assignments WHERE callsign='$guardlocations[$i]' ") or die (mysql_error());
					$locationname=mysql_result($sub,"client");
					echo $locationname;
				?>
				</td>
              </tr>
			  <?php 
			  		$i++;
			  		}
				}
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
