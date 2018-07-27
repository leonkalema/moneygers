<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

// Delete leave application
if(isset($_GET['id']) && $_GET['a'] == "delete"){
	if($_GET['a'] == "delete"){
		mysql_query("DELETE FROM leaveapplications WHERE id = '".trim($_GET['id'])."'");
	}
}

//Mark an approved leave application as sold
if(isset($_GET['d']) && decryptValue($_GET['a']) == "marksold"){
	mysql_query("UPDATE leaveapplications SET sold = 'Y' WHERE id='".decryptValue($_GET['d'])."'");
	
	
}

if(isset($_POST['ArchiveLeaveApplications'])){
	$formvalues = array_merge($_POST);
	//Archive all selected leave applications
	for($i=0;$i<count($formvalues['leaveapplication']);$i++){
		mysql_query("UPDATE leaveapplications SET isactive = 'N' WHERE id='".$formvalues['leaveapplication'][$i]."'");
	}
	forwardToPage("manageleave.php");
}

if(isset($_POST['ActivateLeaveApplications'])){
	$formvalues = array_merge($_POST);
	//Archive all selected assignments
	for($i=0;$i<count($formvalues['leaveapplication']);$i++){
		mysql_query("UPDATE leaveapplications SET isactive = 'Y' WHERE id='".$formvalues['leaveapplication'][$i]."'");
	}
	forwardToPage("manageleave.php");
}


if(isset($_GET['a']) && $_GET['a'] == "archive"){
	$query=("SELECT * FROM leaveapplications WHERE isactive='N' ORDER BY datecreated DESC") or die(mysql_error());
} else {
	// Searching for a leave application	
	if(isset($_GET['a']) && $_GET['a'] == "search"){
		$_SESSION['searchleaveapplication'] = trim($_GET['v']);
	
		
	
	//search by Guard Name
	if($_GET['type'] == "Guard Name"){
		$searchvalues = $_SESSION['searchleaveapplication'];
		// Scan through the search values separated by a space
		$searchvalue = explode(" ",$searchvalues);
		
		$whereclause = " AND (p.firstname LIKE '%".$searchvalue[0]."%' OR p.lastname LIKE '%".$searchvalue[0]."%' OR p.othernames LIKE '%".$searchvalue[0]."%'  OR p.birthlastname LIKE '%".$searchvalue[0]."%') AND (p.lastname LIKE '%".$searchvalue[1]."%' OR p.firstname LIKE '%".$searchvalue[1]."%' OR p.othernames LIKE '%".$searchvalue[1]."%' OR p.birthlastname LIKE '%".$searchvalue[1]."%') ";
	}
	
	//search by Guard ID
	if($_GET['type'] == "Guard ID"){
		$searchvalue = $_SESSION['searchleaveapplication'];
		$searchresultsarray = array();
		
		$whereclause = " AND l.guardid LIKE '%".$searchvalue."%'";
	}
	
	//search by Leave type
	if($_GET['type'] == "Leave Type"){
		$searchvalue = $_SESSION['searchleaveapplication'];
		$searchresultsarray = array();
		
		$whereclause = " AND l.leavetype LIKE '%".$searchvalue."%'";
	}
	//search by leave id
	if(isset($_GET['leaveid'])){
		$searchvalue = $_SESSION['searchleaveapplication'];
		$searchresultsarray = array();
		
		$whereclause = " AND l.id LIKE '%".$_GET['leaveid']."%'";
	}

//Searching for guards on leave or supposed to go on leave this month
} else if($_GET['a']== "sactive"){
	$leave_appns = array();
	$start_date = date("01-M-Y",strtotime("now"));
	$end_date = cal_days_in_month(CAL_GREGORIAN, date("m",strtotime("now")), date("Y",strtotime("now")))."-".date("M-Y",strtotime("now"));
	
	$leaveresult = mysql_query("SELECT * FROM leaveapplications WHERE isactive = 'Y'");
	
	while($line = mysql_fetch_array($leaveresult,MYSQL_ASSOC)){
		//Check for those who are on leave
		if(($line['leavetype'] == "Annual" && $line['gmapproved'] == "Y") || ($line['leavetype'] == "Pass Leave" && $line['humanresourceapproved'] == "Y" && $line['payrollclerkapproved'] == "Y") || ($line['humanresourceapproved'] == "Y" && $line['operationsapproved'] == "Y"  && $line['payrollclerkapproved'] == "Y")){
		
			if((strtotime($start_date) <= strtotime($line['leavestartdate'])) && (strtotime($line['leavestartdate']) < strtotime($end_date))){
				
				array_push($leave_appns, $line['id']);
			}
		}
	}

	//Generate where clause to be added to the query
	$whereclause = "AND (";
	for($i=0;$i<count($leave_appns);$i++){
		$whereclause .= "l.id = ".$leave_appns[$i];
		if($i < (count($leave_appns) - 1)){
			$whereclause .= " OR ";
		}
	}
	$whereclause .= ")";
	
} else {
	$whereclause="";
}

$query = "SELECT * FROM persons p INNER JOIN guards g ON (g.personid = p.id) INNER JOIN leaveapplications l ON (g.guardid=l.guardid) WHERE l.status <> 'Archived' AND l.isactive <> 'N'  ".$whereclause." ORDER BY l.datecreated DESC";
}



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
        <td class="headings">Manage Leave </td>
      </tr>
      <tr>
        <td>
		<form name="form1" method="post" action="manageleave.php">
		<table width="100%" border="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
		   <?php if(userHasRight($_SESSION['userid'], "65")){ ?>
            <td>
              <input type="button" name="newincident" value="Register Leave Application" onClick="javascript:document.location.href='../hr/leave.php'">
		   <?php } ?> [ <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ ?><a href="../hr/manageleave.php" title="Displays active  leave applications.">View Active Leave Applications</a><?php } else {?><a href="../hr/manageleave.php?a=archive" title="Displays leave applications that have been archived.">View Archive</a><?php } ?> ] </td>
            </tr>
		  <tr>
         <td>&nbsp;</td>
       </tr>
	  <td>
	  <form method="post" action="">
	  <div id="searchtable"><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search for Leave Applications: </td>
                  <td><input name="searchleaveapplication" id="searchleaveapplication" type="text" size="20" value="<?php if(isset($_SESSION['searchleaveapplication'])){ echo $_SESSION['searchleaveapplication'];}?>"></td>
                  <td nowrap class="label">Search By: 
                    <select name="type" id="type">
                      <option value="Guard Name">Guard Name</option>
					  <option value="Guard ID">Guard ID</option>
					  <option value="Leave Type" <?php if(isset($_GET['type']) && $_GET['type'] == "Leave Type"){ echo "selected";}?>>Leave Type</option>	
                    </select> 
					</td>
                  <td><input type="button" name="Button" value="Search Leave Applications" onClick="pickFormItemTypeAndDirect('searchleaveapplication', '../hr/manageleave.php?a=search&v=', 'Please enter a guard name or ID or leave type')"></td>
                </tr>
              </table>
              </div></form></td>
        </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
			<?php $whereclause = "";
			if(isset($_GET['a']) && $_GET['a'] == "search"){
				$whereclause = " AND id='".$_GET['leaveid']."'";
			}
			//$query = "SELECT * FROM leaveapplications WHERE status <> 'Archived'".$whereclause." ORDER BY datecreated DESC";
			
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no leave applications to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:100%;height:400px;overflow: auto" id="printresults_div">
			<table width="100%" border="0" style="border: 1px; 
	border-style: solid;
	border-color: #adaefe" cellpadding="2" cellspacing="0">
              <tr style="font-family: tahoma;
	font-size: 12px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
			  <?php if(userHasRight($_SESSION['userid'], "65")){?>
			   <td>&nbsp;</td><?php } ?>
			  <?php if(userHasRight($_SESSION['userid'], "68")){?>
                <td width="7%">Delete</td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "67")){?>
				<td width="7%">Edit</td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "69")){?>
				<td width="7%">View</td><?php } ?>
				<td width="7%">Staff</td>
                <td width="13%">Name</td>
                <td width="12%">Start Date</td>
                 <td width="13%">End Date</td>
				 <td width="21%">Type</td>
				 <?php if(userHasRight($_SESSION['userid'], "70") || userHasRight($_SESSION['userid'], "71") || userHasRight($_SESSION['userid'], "72")){?>
                 <td width="18%">Approvals</td>
				 <?php } ?>
				 <?php if(userHasRight($_SESSION['userid'], "196")){?><td width="21%">Mark Sold</td><?php } ?>
              </tr>
			  <?php
			  // Display the leave applications
			  $result = mysql_query($query);
			  $i = 0;
			   while($row=mysql_fetch_array($result, MYSQL_ASSOC)) { 
			      if(!$i%2) {
				     	$rowclass = "oddrow";
				 	} else {
				     	$rowclass = "evenrow";
				 	}
				
				  //Getting the guard names
				 $line = getRowasArray("SELECT p.firstname, p.lastname, p.othernames FROM persons p, guards g WHERE g.personid=p.id AND g.guardid = '".$row['guardid']."'");
			   ?>
              <tr class="<?php echo $rowclass; ?>">
			   <?php if(userHasRight($_SESSION['userid'], "65")){?>
                <td>&nbsp;</td><?php } ?>
				 <?php if(userHasRight($_SESSION['userid'], "68")){?>
				<td>&nbsp;</td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "67")){?>
				<td>&nbsp;</td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "69")){?>
                <td>&nbsp;</td><?php } ?>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td> 
				<?php if(userHasRight($_SESSION['userid'], "70") || userHasRight($_SESSION['userid'], "71") || userHasRight($_SESSION['userid'], "72")){?>
                <td nowrap>&nbsp;</td>
				<td nowrap>&nbsp;</td>
				<?php } 
				
				if(userHasRight($_SESSION['userid'], "196")){?>
				<td nowrap>&nbsp;</td><?php } ?>
              </tr>
              <tr style="<?php echo $rowclass; ?>">
			  <?php if(userHasRight($_SESSION['userid'], "65")){?>
			  <td><input type="checkbox" name="leaveapplication[]" id="leaveapplication[]<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>"></td><?php } ?>
			  <?php if(userHasRight($_SESSION['userid'], "68")){?>
                <td><a href="#" onClick="javascript:deleteEntity('../hr/manageleave.php?id=<?php echo $row['id']; ?>&a=delete', 'leave application', '<?php echo "by ".$line['firstname']." ".$line['lastname']." ".$line['othernames']; ?>')" class="normaltxtlink" title="Delete leave application">Delete</a></td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "67")){?>
				<td><a href="../hr/leave.php?id=<?php echo encryptValue($row['id']); ?>&a=edit" class="normaltxtlink" title="Modify leave application.">Edit</a></td>
				<?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "69")){?>
				<td><a href="../hr/leave.php?id=<?php echo encryptValue($row['id']); ?>&a=view" class="normaltxtlink" title="View leave application.">View</a></td><?php } ?>
				<td><?php echo $row['guardid']; ?></td>
                <td><?php 
				//$line = getRowasArray("SELECT p.firstname, p.lastname, p.othernames FROM persons p, guards g WHERE g.personid=p.id AND g.guardid = '".$row['guardid']."'");
				echo $line['firstname']." ".$line['lastname']." ".$line['othernames']; ?></td>
                <td><?php echo date("d-M-Y",strtotime($row['leavestartdate']));?></td>
                <td><?php echo date("d-M-Y",strtotime($row['leaveenddate']));?></td>
                <td><?php echo $row['leavetype'];?></td>
                <td nowrap>
				
				<?php 
				//Only GM approves annual leave
				if($row['leavetype'] != "Annual"){
				
				//Only Finance and HR need to approve pass leave
				if($row['leavetype'] != "Pass Leave"){
				if(userHasRight($_SESSION['userid'], "70")){?>
				<a href="approvals.php?id=<?php echo encryptValue($row['id']);?>&t=operations&ty=<?php echo encryptValue($row['leavetype']);?>" title="Approve under Operations">Operations Approval</a>
				[<?php if($row['operationsapproved'] == "Y"){
					echo "Y";
				} else {
					echo "N";
				}?>]<br>
				<?php }
				}
				 ?>
				
				<?php if(userHasRight($_SESSION['userid'], "71")){?>
				<a href="approvals.php?id=<?php echo encryptValue($row['id']);?>&t=hr&ty=<?php echo encryptValue($row['leavetype']);?>" title="Approve under Human Resource.">HR Approval</a> [<?php if($row['humanresourceapproved'] == "Y"){
					echo "Y";
				} else {
					echo "N";
				}?>] <br>
				<?php } ?>
				
				<?php if(userHasRight($_SESSION['userid'], "72")){?>
				<a href="approvals.php?id=<?php echo encryptValue($row['id']);?>&t=finance&ty=<?php echo encryptValue($row['leavetype']);?>" title="Approve under finance">Finance Approval</a>
				[<?php if($row['payrollclerkapproved'] == "Y"){
					echo "Y";
				} else {
					echo "N";
				}?>]
				<br>
				<?php } ?>
				
				<?php
				}
				
				
				if($row['leavetype'] == "Annual"){?>
				<a href="approvals.php?id=<?php echo encryptValue($row['id']);?>&t=gm<?php 
				if(userHasRight($_SESSION['userid'], "162")){
					echo "&p=edit";
				} else {
					echo "&p=view";
				}?>" title="Approve as General Manager">GM Approval</a>
				[<?php if($row['gmapproved'] == "Y"){
					echo "Y";
				} else {
					echo "N";
				}?>]
				<?php } ?>
				</td>
				<?php if(userHasRight($_SESSION['userid'], "196")){?>
				<td nowrap><?php 
				$isapproved = "N";
				//Mark set approved string for only those meeting leave approval conditions
				if($row['leavetype'] == "Annual" && $row['gmapproved'] == "Y"){
					$isapproved = "Y";
				
				} else if($row['leavetype'] == "Pass Leave" && $row['humanresourceapproved'] == "Y" && $row['payrollclerkapproved'] == "Y"){
					$isapproved = "Y";
				
				} else if($row['humanresourceapproved'] == "Y" && $row['payrollclerkapproved'] == "Y"&& $row['operationsapproved'] == "Y"){
					$isapproved = "Y";
				}
				
				if($row['sold'] == "N" && $isapproved == "Y"){?><a href="javascript:confirmAction('manageleave.php?d=<?php echo encryptValue($row['id']);?>&a=<?php echo encryptValue("marksold");?>&t=<?php echo $row['sold'];?>', 'Are you sure you want to mark this leave application <?php echo "by ".$line['firstname']." ".$line['lastname']." ".$line['othernames']; ?> as sold?')" title="Mark this leave as sold">Mark</a><?php }
				
				if($row['sold'] == "Y"){ echo "<b>SOLD</b>";}
				?></td>
				<?php } ?>
              </tr>
			  <?php 
			  $i++;
			  } ?>
            </table>
            </div></td>
          </tr>			
			<?php } ?>
			<tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><input  type="submit" <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ echo "name=\"ActivateLeaveApplications\" value=\"Re-Activate\""; } else { echo "name=\"ArchiveLeaveApplications\" value=\"Archive\"";} ?>> <?php if(isset($_GET['a']) && $_GET['a'] == "search"){ ?><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"><?php } ?> <input type="button" name="Button" id="submit" value="Print"  onClick="openPopWindow(600,350,'Financial Report','print')"></td>
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
