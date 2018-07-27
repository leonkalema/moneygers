<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

	//Get all the known statuses in the db
	$statusarr = getAllScheduleStatus();
	$id=$_GET['id'];
	$_SESSION['searchtype'] = "";
	$availableguards = array();
	
	// If you are searching
	if(isset($_GET['v']) && trim($_GET['v']) != ""){
		$_SESSION['searchactiveguard'] = trim($_GET['v']);
		$_SESSION['searchtype'] = trim($_GET['type']);
		
		$searchvalues = $_SESSION['searchactiveguard'];
		// Scan through the search values separated by a space
		$searchvalue = explode(" ",trim($searchvalues));
		
		//IF the user wants to see all
		if($_SESSION['searchactiveguard'] == "ALL"){
			$whereclause = "";
		} else {
			$whereclause = "AND (p.firstname LIKE '%".$searchvalue[0]."%' OR p.lastname LIKE '%".$searchvalue[0]."%' OR p.othernames LIKE '%".$searchvalue[0]."%'  OR p.birthlastname LIKE '%".$searchvalue[0]."%') AND (p.lastname LIKE '%".$searchvalue[1]."%' OR p.firstname LIKE '%".$searchvalue[1]."%' OR p.othernames LIKE '%".$searchvalue[1]."%' OR p.birthlastname LIKE '%".$searchvalue[1]."%') ";
		}
		
	} else { $whereclause = "";}

	//Array to hold the search results
	$searchresultarray = array();
	$addclause = "";
	$searchtype = getRowAsArray("SELECT id, status FROM guardstatus WHERE id='".$_SESSION['searchtype']."'");
	
	if(isset($_SESSION['searchtype']) && trim($_SESSION['searchtype']) != ""){
		$addclause = " AND g.status='".$_SESSION['searchtype']."' ";
	}
	$sresult=mysql_query("SELECT g.guardid, g.statusstartdate FROM persons p, guards g WHERE g.personid = p.id AND g.isarchived = 'N' ".$addclause.$whereclause);
	
	while($row = mysql_fetch_array($sresult, MYSQL_ASSOC)){
		array_push($availableguards, $row['guardid']);
	}
	
	
	/*//Get the active guards into an array
	$schedulearray = getRowAsArray("SELECT schedule FROM guardschedule WHERE dateentered = '".date("Y-m-d", strtotime("now"))."'");
	
	//Set to yesterday's schedule if today's is not yet submitted.
	if($schedulearray['schedule'] == ""){
		$schedulearray = getRowAsArray("SELECT schedule FROM guardschedule WHERE dateentered = ".date("Y-m-d", strtotime("yesterday"))."");
	}
	
	$schedules = split(",",$schedulearray['schedule']);
	$availableguards = array();
	
	
	for($i=0;$i<count($schedules);$i++){
		$schedulepair = split("=",$schedules[$i]);
		
		//Add to the available guards if the guard is assigned to available assignments
		if($searchtype['status'] == "On Duty"){
			if(!in_array($schedulepair[1], $statusarr) && $schedulepair[1] != "" && in_array($schedulepair[0],$searchresultarray)){
				array_push($availableguards,$schedulepair[0]);
			}
		} else {
			if($schedulepair[1] == $searchtype['status'] && in_array($schedulepair[0],$searchresultarray)){
				array_push($availableguards,$schedulepair[0]);
			}
		}
	}
	*/
	/*//If the search is on guards on leave, look for those who may not be included
	// in today's schedule
	if($searchtype['status'] == "Leave"){
		//Get all active guards and check for those on leave
		$guardsresult = mysql_query("SELECT guardid FROM guards WHERE isarchived='N'");
		
		while($data = mysql_fetch_array($guardsresult,MYSQL_ASSOC)){
			//Returns TRUE or FALSE for guards on leave and start and end date in array
			$leavearr = isOnLeave($data['guardid']);
			
			if($leavearr[0] && !in_array($data['guardid'],$availableguards)){
				array_push($availableguards, $data['guardid']);
			}
		}
	}*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Search Guards</title>
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
    <td height="136" colspan="2" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings">Search Guards </td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          
          <tr>
            <td>&nbsp;</td>
          </tr>
		  <tr>
		    <td><form action="" method="post" name="searchguards">
		        <table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                  <tr>
                    <td>Search  Guards:</td>
                    <td><input type="checkbox" name="allvalues" id="allvalues" value="ALL" onClick="document.getElementById('searchactiveguard').value ='ALL'" <?php if($_SESSION['searchactiveguard'] == "ALL"){ echo "checked";}?>></td>
                    <td>                       All&nbsp;</td>
                    <td><b>OR</b> &nbsp;&nbsp;
                      <input name="searchactiveguard" id="searchactiveguard" type="text" size="20" value="<?php if(isset($_SESSION['searchactiveguard'])){ echo $_SESSION['searchactiveguard'];}?>" onClick="uncheckOption('allvalues')">                      &nbsp;</td>
                    <td>Search By:
                      <select name="type" id="type">
                          <?php echo generateSelectOptions(getAllGuardStatusDrop(), $_SESSION['searchtype']);?>
                      </select></td>
                    <td><input type="button" name="Button" value="Search Guards" onClick="pickFormItemTypeAndDirect('searchactiveguard', '../operations/manageactiveguards.php?a=search&v=', 'Please enter the guard\'s name and select the status you want to search.')"></td>
                  </tr>
                </table>
		    </form></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
		  
			<?php
			if(count($availableguards) == 0 || $availableguards[0] == ""){          			
				echo "<tr><td>Your search returned no results. <br><br><b>This search presents an update on the current status of the guards. If they are not shown, please check with the operations personnel whether the guards schedule data has been submitted.</b></td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:720px;height:300px;overflow: auto"  id="printresults_div">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
			<tr><td colspan="3"><b>Guards with status "<?php 
			$statusarray = getAllGuardStatusDrop();
			echo $statusarray[$_SESSION['searchtype']];?>" as at <?php echo date("d-M-Y");?></b></td></tr>
              <tr style="font-family: tahoma;
	font-size: 11px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
                <td width="19%">Guard ID </td>
                <td width="23%">Guard Name </td>
				<td width="21%">Start Date </td>
              </tr>
			  <?php
			 for($i=0; $i<count($availableguards); $i++){
			      if(($i%2)==0) {
				     	$rowclass = "oddrow";
				 	} else {
				     	$rowclass = "evenrow";
				 	}
			   ?>
              <tr class="<?php echo $rowclass; ?>">
                <td><?php echo $availableguards[$i];?></td>
                <td><?php 
				$guard = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames, g.id, g.dateofemployment FROM guards g, persons p WHERE g.personid = p.id AND g.guardid = '".$availableguards[$i]."'"); ?>
				<a href="../hr/index.php?id=<?php echo encryptValue($guard['id']); ?>&a=view"   title="View guard's details."><?php echo $guard['firstname']." ".$guard['lastname']." ".$guard['othernames']; ?></a></td>
                <td><?php 
				//Get the day the status started
				if($searchtype['status'] == "Leave"){
					$statusarr = isOnLeave($availableguards[$i]);
					echo date("d-M-Y", strtotime($statusarr[1]));
				
				} else {
					$resultarr = getRowAsArray("SELECT statusstartdate FROM guards WHERE guardid='".$availableguards[$i]."'");
					echo date("d-M-Y", strtotime($resultarr['statusstartdate']));
				}
				?>&nbsp;</td>
              </tr>
			  <?php  } ?>
            </table></div><br>
<br>
<input type="button" name="Button" id="submit" value="Print"  onClick="openPopWindow(600,350,'Guard Print Report','print')"></td>
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
