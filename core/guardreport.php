<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_POST['detail'])){
	$formvalues = array_merge($_POST);
	$_SESSION['formvalues'] = $formvalues;
	$reporttype = $formvalues['reporttype'];
	// When determining the item location
	if(isset($formvalues['itemserial'])){
		$item = $formvalues['itemserial'];
	}
}

if(isset($_GET['f'])){
	$reporttype = $_GET['f'];
	$_SESSION['reporttype'] = $_GET['f'];
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Generate Guard Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0"  onLoad="setDiv('../include/reportdetails.php?area=<?php echo $_SESSION['reporttype'];
?>&value=','reportdetails','','Loading...'); return false; ">
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
        <td class="headings">Generate <?php echo $_GET['f'];?> Report </td>
      </tr>
      <tr>
        <td><form action="guardreport.php" method="post" name="guardreport" id="guardreport"><table width="100%" border="0" cellpadding="5" cellspacing="2">
          
            <tr>
            <td width="1%" align="left" class="label"><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"></td>
            <td width="99%" colspan="3" valign="top">&nbsp;</td>
            </tr>
            <tr>
            <td rowspan="2" align="right" nowrap class="label">Generate Report For: </td>
            
			<td valign="top" width="99%"><select name="reporttype" id="reporttype" onChange="pickFormItemAndDirect('reporttype', '../core/guardreport.php?f=', 'Please select a report type')">
              <option value="">&lt;Select One&gt;</option>
			  <?php 
			  $group_result = mysql_query("SELECT id, viewedby FROM reportdetails GROUP BY reporttype");
			  $id_array = array();
			  while($line1 = mysql_fetch_array($group_result, MYSQL_ASSOC)){
			  		$view_array = split(",",$line1['viewedby']);
					if(in_array($_SESSION['groups'],$view_array)){
						array_push($id_array,$line1['id']);
					}
			  }
			  
			  // Remove duplicate arrays
			  $clean_ids = array_unique($id_array);
			  for($i=0;$i<count($clean_ids);$i++){
			  	$report_result = mysql_query("SELECT reporttype FROM reportdetails WHERE id = '".$clean_ids[$i]."'");
			  	while($line = mysql_fetch_array($report_result, MYSQL_ASSOC)){
			  		echo "<option value=\"".$line['reporttype']."\"";
					if($line['reporttype'] == $reporttype){
						echo " selected";
					}
					echo ">".$line['reporttype']."</option>";
			  	}
			  }
			  ?>
                        </select></td>
			<td width="99%" rowspan="2" align="right" valign="top" nowrap class="label"><span  class="label">With Details:</span> <br>
			  <br>
			  (These details will appear<br>
			  in the report generated<br> 
			  below.) </td>
               <td width="97%" colspan="2" rowspan="2" valign="top"><div id="guardid_search" style="width:250; height:170; font-style:normal; color:#000066; font-weight:bolder; font-size:14px;overflow: auto; border-color:#CCCCCC; border-style:solid;"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                   <?php
				   		$result = mysql_query("SELECT * FROM reportdetails WHERE reporttype = '".$reporttype."' ORDER BY detail");
				   		while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
				      		$row = "<tr><td width=\"1%\"><input type=\"checkbox\" id=\"detail_".$line['id']."\" name=\"detail[]\" value=\"".$line['id']."\"";
					  		if(isset($formvalues) && in_array($line['id'],$formvalues['detail'])){ $row .= "checked";}
					  		$row .= "></td><td width=\"99%\">".$line['detail']."</td></tr>";
					  
					  		echo $row;
				   		}
				   ?>
				   
                 </table>
               </div><br>
<br>
<a href="javascript:selectAllBoxes('detail_','guardreport')" title="Click to select all the above options.">Select All</a></td>
               </tr>
            <tr>
              <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td height="110" valign="top"><div id="reportdetails">&nbsp;</div></td>
                </tr>
                <tr>
                  <td><input type="submit" name="Report" id="Report" value="&gt;&gt; Generate Report"></td>
                </tr>
              </table></td>
            </tr>
            
            <tr>
              <td colspan="5"><hr color="#CCCCCC"></td>
              </tr>
			  <?php  if(isset($formvalues)) { ?>
			  <tr><td colspan="5"><div id="printresults_div" style="padding:4px;width:720px;height:400px;overflow: auto">
                <table width="100%" border="0" cellpadding="5" cellspacing="2">
                  <tr>
                    <td colspan="5" class="label"><?php echo $_SESSION['reporttype'];?> Report for <b><?php echo date("d-M-Y");?></b> &nbsp;|&nbsp; &nbsp;&nbsp; Generated By <b><?php echo $_SESSION['names'];?></b></td>
                  </tr>
                  <tr>
                    <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="2" style="border: 1px; 
	border-style: solid;
	border-color: #adaefe">
                        <?php   $query = "";
	  		  $wherestr = "";
//**********************************************************************************************			// If the report is for daily schedule of the guards
//**********************************************************************************************
			  if($reporttype == "Guard Daily Schedule"){
			  	$wherestr = "AND (";
			  	$result = mysql_query("SELECT id, startdate, enddate, exception FROM assignments");
				$exception_in = array();
				// Record all those assignments that are not active today
				while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
					$startdate = date("d-m-Y",strtotime($row['startdate']));
					$enddate = date("d-m-Y",strtotime($row['enddate']));
					$today = date("d-m-Y",strtotime("now"));
					$exception_array = split(",",$row['exception']);
					// If today lies on one of the exception dates
					for($j=0;$j<count($exception_array);$j++){
						if($today == date("d-m-Y",strtotime($exception_array[$j]))){
							array_push($exception_in,$row['id']);
						}
					}
					// If today is out of range of the assignment days
					if($today < $startdate && $today > $enddate){
						array_push($exception_in,$row['id']);
					}
				}
				// remove duplicates
				$exception_in = array_unique($exception_in);
				// generate a where string if the exception array is not empty
				if(count($exception_in) > 0){
					for($k=0;$k<count($exception_in);$k++){
						if($k == 0){
							$wherestr .= " a.id <> '".$exception_in[$k]."'";
						} else {
							$wherestr .= " AND a.id <> '".$exception_in[$k]."'";
						}
					}
					// Close bracket so that these conditions are all considered once in the AND
					$wherestr .= ")";
				}
			  
			  	$query = "SELECT a.callsign, a.client, a.assignedguard, a.startdate, a.enddate, a.exception, a.servicetype, c.name, c.contphone, c.email, c.plotno, c.boxno, c.genphone FROM assignments a, clients c WHERE a.client = c.name ".$wherestr;
			  
//**********************************************************************************************			// Generate report for item location
//**********************************************************************************************
			  } else if($reporttype == "Item Location"){
			  	if(isset($_POST['itemtype'])){
					$_SESSION['itemtype'] = $_POST['itemtype'];
					$wherestr = "AND e.type = '".$_POST['itemtype']."'";
				}
				
				$query = "SELECT i.type AS issuetype, i.serialno, i.guardresponsible, i.status, i.assignment, i.date, i.inventoryofficer, a.client, a.region, e.name FROM itemissue i, assignments a, equipment e WHERE a.callsign = i.assignment AND i.serialno = e.serialno ".$wherestr;
			  }


//**********************************************************************************************			// Exceute queries
//**********************************************************************************************
			  if(howManyRows($query) == 0){
			  	echo "<tr><td>Sorry. There are no results for your report.</td></tr>";
			  } else {
			  ?>
                        <tr style="font-family: tahoma;
	font-size: 11px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
                          <?php if(in_array("4",$formvalues['detail'])){?>
                          <td>Call Sign</td>
                          <?php } ?>
                          <?php if(in_array("3",$formvalues['detail'])){?>
                          <td>Client</td>
                          <?php } ?>
                          <?php if(in_array("1",$formvalues['detail']) || in_array("2",$formvalues['detail'])){?>
                          <td>Assigned Guards</td>
                          <?php } ?>
                          <?php if(in_array("5",$formvalues['detail'])){?>
                          <td>Client Phone</td>
                          <?php } ?>
                          <?php if(in_array("6",$formvalues['detail'])){?>
                          <td>Other Client Contacts</td>
                          <?php } ?>
                          <?php if(in_array("7",$formvalues['detail'])){?>
                          <td>Duration</td>
                          <?php } ?>
                          <?php if(in_array("8",$formvalues['detail'])){?>
                          <td>Service Type</td>
                          <?php } ?>
                          <?php if(in_array("16",$formvalues['detail'])){?>
                          <td>Current Location</td>
                          <?php } ?>
                          <?php if(in_array("18",$formvalues['detail'])){?>
                          <td>Return Date</td>
                          <?php } ?>
                          <?php if(in_array("15",$formvalues['detail'])){?>
                          <td>In Custody Of</td>
                          <?php } ?>
                          <?php if(in_array("20",$formvalues['detail'])){?>
                          <td>Issued By</td>
                          <?php } ?>
                          <?php if(in_array("13",$formvalues['detail'])){?>
                          <td>Item Name</td>
                          <?php } ?>
                          <?php if(in_array("14",$formvalues['detail'])){?>
                          <td>Item Serial No.</td>
                          <?php } ?>
                          <?php if(in_array("19",$formvalues['detail'])){?>
                          <td>Item Status</td>
                          <?php } ?>
                          <?php if(in_array("17",$formvalues['detail'])){?>
                          <td>On Assignment</td>
                          <?php } ?>
                        </tr>
                        <?php 
				$i = 0;
				$result1 = mysql_query($query);
				while($line=mysql_fetch_array($result1,MYSQL_ASSOC)){
					if(($i%2)==0) {
				     	$rowclass = "background-color:#FFFFFF";
				 	} else {
				     	$rowclass = "background-color:#CCCCCC; padding-bottom:2px";
				 	}
				?>
                        <tr style="<?php echo $rowclass; ?>">
                          <?php if(in_array("4",$formvalues['detail'])){?>
                          <td valign="top"><?php echo $line['callsign'];?></td>
                          <?php } ?>
                          <?php if(in_array("3",$formvalues['detail'])){?>
                          <td valign="top"><?php echo $line['name'];?></td>
                          <?php } ?>
                          <?php if(in_array("1",$formvalues['detail']) || in_array("2",$formvalues['detail'])){?>
                          <td valign="top"><?php 
		$guardarray = split(",",$line['assignedguard']);
		for($j=0;$j<count($guardarray);$j++){
			if(in_array("2",$formvalues['detail'])){ echo $guardarray[$j];}
			if(in_array("1",$formvalues['detail'])){ 
				$guard = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames FROM guards g, persons p WHERE g.guardid = '".$guardarray[$j]."' AND g.personid = p.id");
				//echo " (".$guard['firstname']." ".$guard['lastname']." ".$guard['othernames'].")";
			}
			echo "<br>";
		}
		?></td>
                          <?php } ?>
                          <?php if(in_array("5",$formvalues['detail'])){?>
                          <td valign="top"><?php echo $line['contphone'];?></td>
                          <?php } ?>
                          <?php if(in_array("6",$formvalues['detail'])){?>
                          <td valign="top"><?php echo "General Phone: ".$line['genphone'];
		echo "<br>Plot No.: ".$line['plotno'];
		echo "Floor No.: ".$line['floorno'];
		echo "<br>P.O.Box: ".$line['boxno'];
		echo "<br>Email: ".$line['email'];
		?></td>
                          <?php } ?>
                          <?php if(in_array("7",$formvalues['detail'])){?>
                          <td valign="top"><?php echo $line['startdate']." TO ".$line['enddate'];?></td>
                          <?php } ?>
                          <?php if(in_array("8",$formvalues['detail'])){?>
                          <td valign="top"><?php echo $line['servicetype'];?></td>
                          <?php } ?>
                          <?php if(in_array("16",$formvalues['detail'])){?>
                          <td valign="top"><?php 
		if($line['issuetype'] == "return" && (date("d-m-Y",strtotime("now")) > date("d-m-Y",strtotime($line['date'])))){
			echo "In Store";
		} else {
			echo $line['client'];
			if(trim($line['region']) != ""){
		 		echo " (Region ".$line['region'].")";
			}
		}
		?></td>
                          <?php } ?>
                          <?php if(in_array("18",$formvalues['detail'])){?>
                          <td valign="top"><?php echo date("d-M-Y",strtotime($line['date']));?></td>
                          <?php } ?>
                          <?php if(in_array("15",$formvalues['detail'])){?>
                          <td valign="top"><?php 
		$guard = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames FROM guards g, persons p WHERE g.guardid = '".$line['guardresponsible']."' AND g.personid = p.id");
		echo $guard['firstname']." ".$guard['lastname']." ".$guard['othernames']." (".$line['guardresponsible'].")";?></td>
                          <?php } ?>
                          <?php if(in_array("20",$formvalues['detail'])){?>
                          <td valign="top"><?php 
		$person = getRowAsArray("SELECT firstname, lastname, othernames FROM persons WHERE id = '".$line['inventoryofficer']."'");
		echo $person['firstname']." ".$person['lastname']." ".$person['othernames'];
		?></td>
                          <?php } ?>
                          <?php if(in_array("13",$formvalues['detail'])){?>
                          <td valign="top"><?php echo $line['name'];?></td>
                          <?php } ?>
                          <?php if(in_array("14",$formvalues['detail'])){?>
                          <td valign="top"><?php echo $line['serialno'];?></td>
                          <?php } ?>
                          <?php if(in_array("19",$formvalues['detail'])){?>
                          <td valign="top"><?php echo $line['status'];?></td>
                          <?php } ?>
                          <?php if(in_array("17",$formvalues['detail'])){?>
                          <td valign="top"><?php echo $line['assignment'];?></td>
                          <?php } ?>
                        </tr>
                        <?php $i++; } ?>
                    </table></td>
                  </tr>
                  <?php } ?>
                </table>
			    </div></td> 
			  </tr><?php //}?>
            <tr>
              <td align="right" class="label">&nbsp;</td>
              <td colspan="4">&nbsp;</td>
            </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="3"><input type="button" name="cancel" id="cancel" value="Cancel" onClick="javascript:window.location.href='../core/dashboard.php';">
			<input type="button" name="Button" id="submit" value="Print"  onClick="openPopWindow(600,350,'Guard Print Report','print')">
			<b> [ Export &gt;&gt; <a href="#"   onClick="openPopWindow(600,350,'MS Word Export for the Guard Report','msword')" title="Export report to MS Word"><img src="../images/mswordimg.gif" width="16" height="16" border="0"></a>&nbsp;&nbsp;<a href="#"   onClick="openPopWindow(600,350,'MS Excel Export for the Guard Report','msexcel')" title="Export report to MS Excel"><img src="../images/msexcelimg.gif" width="16" height="16" border="0"></a> ] </b></td>
          </tr>
<?php } ?>
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
