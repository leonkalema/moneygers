<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();

session_start();

$id=$_GET['id'];
//$q=mysql_query("SELECT * FROM guardstatustrack WHERE status = 'Sick'");

// If you are searching
	if(isset($_GET['v']) && trim($_GET['v']) != ""){
		$_SESSION['searchsickguard'] = trim($_GET['v']);
		$searchvalues = $_SESSION['searchsickguard'];
		
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
		if($schedulepair[1] == "Sick"){
			array_push($availableguards,$schedulepair[0]);
		}
	}
	
	$_SESSION['frompage'] = "../operations/managesickguards.php";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Personnel Files</title>
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
        <td class="headings">Manage Sick Guards </td>
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
                  <td>Search For Sick Guards:</td>
                  <td><input name="searchsickguard" id="searchsickguard" type="text" size="30" value="<?php if(isset($_SESSION['searchsickguard'])){ echo $_SESSION['searchsickguard'];}?>"></td>
                  <td><input type="button" name="Button" value="Search Sick Guards" onClick="pickFormItemAndDirect('searchsickguard', '../operations/managesickguards.php?v=', 'Please enter all or part of the guard name')"></td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
			<?php
			if($personnels == 0){          			
				echo "<tr><td>There are no Sick Guards to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:720px;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			  <?php if(userHasRight($_SESSION['userid'], "136")){?>
			  <td width="5%">Edit</td>
			  <?php } ?>
                <td width="9%">Guard ID </td>
                <td width="17%">Guard Name </td>
                <td width="15%">Type of Illness </td>
                <td width="14%">Start Date of Sickness </td>
                <td width="16%">Expected Recovery Date </td>
				<td width="24%">Notes </td>
              </tr>
			  <?php
			  $i=0;
			   	while($thepersonnel=mysql_fetch_array($q,MYSQL_ASSOC)){
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
				  //Show only the sick guards
				  if(in_array($thepersonnel['guardid'],$availableguards)){
				  
				  	//Get sickness details if they are available
					$sickresult = mysql_query("SELECT * FROM guardstatustrack WHERE guard = '".$thepersonnel['guardid']."' AND status = 'Sick'");
					$illnesstype = "";
					$startdate = "";
					$enddate = "";
					$notes = "";
					
					while($row = mysql_fetch_array($sickresult, MYSQL_ASSOC)){
						if(strtotime($row['date_ended']) > strtotime("now") || $row['date_ended'] == "0000-00-00 00:00:00"){
							$illnesstype = 	$row['illness'];
							$startdate = date("d-M-Y",strtotime($row['date_started']));
							if($row['date_ended'] != "0000-00-00 00:00:00"){
								$enddate = date("d-M-Y",strtotime($row['date_ended']));
							}
							$notes = 	$row['notes'];
						}
					}
			   ?>
              <tr class="<?php echo $rowclass; ?>">
			  <?php 
				$guard = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames FROM guards g, persons p WHERE g.personid = p.id AND g.guardid = '".$thepersonnel['guardid']."'"); 	?>
			  	<?php if(userHasRight($_SESSION['userid'], "136")){?>
                <td valign="top">
					<a href="../hr/changestatus.php?t=Sick&gid=<?php echo encryptValue($thepersonnel['guardid']);?>" class="normaltxtlink" title="Change status for <?php echo $guard['firstname']." ".$guard['lastname']." ".$guard['othernames'];?>">Edit</a><?php }?></td>
				<td valign="top" nowrap><?php echo $thepersonnel['guardid'];?></td>
				<td valign="top" nowrap><a href="../hr/index.php?id=<?php echo encryptValue($thepersonnel['id']); ?>&a=view" class="normaltxtlink" title="View details of <?php echo $guard['firstname']." ".$guard['lastname']." ".$guard['othernames'];?>"><?php 
				 echo $guard['firstname']." ".$guard['lastname']." ".$guard['othernames']; ?></a></td>
                <td valign="top"><?php echo $illnesstype; ?>&nbsp;</td>
                <td valign="top"><?php  echo $startdate;?>&nbsp;</td>
                <td valign="top"><?php echo $enddate;?>&nbsp;</td>
				 <td valign="top"><?php if($notes != ""){?><div style="padding:3px;width:170px;overflow: auto;"><?php echo $notes;?></div> <?php } else { echo "&nbsp;";}?></td>
              </tr>
			  <?php 
			  		$i++;
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
