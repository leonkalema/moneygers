<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_POST['detail'])){
	$formvalues = array_merge($_POST);
	$_SESSION['formvalues'] = $formvalues;
	$reporttype = $formvalues['reporttype'];
	
	if($reporttype = "Control Shift"){
		$shiftdate = date("Y-m-d H:i:s",strtotime($formvalues['day']."-".$formvalues['month']."-".$formvalues['year']));
		$_SESSION['shiftdate'] = $shiftdate;
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

<body class="mainbackground" topmargin="0" bottommargin="0" onLoad="setDiv('../include/reportdetails.php?area=<?php echo $_SESSION['reporttype'];
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
        <td><form action="../operations/report.php" method="post" name="guardreport" id="guardreport" onSubmit="return checkhidden();"><table width="100%" border="0" cellpadding="5" cellspacing="2">
          
            <tr>
            <td width="1%" align="right" class="label">&nbsp;</td>
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
			<td width="99%" rowspan="2" align="right" valign="top" nowrap><span  class="label">With Details:</span> <br>
			  <br>
			  (These details will appear<br>
			  in the report generated<br> 
			  below.) </td>
               <td width="97%" colspan="2" rowspan="2" valign="top"><div id="guardid_search" style="width:250; height:170; font-style:normal; color:#000066; font-weight:bolder; font-size:14px;overflow: auto; border-color:#CCCCCC; border-style:solid;"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                   <?php
				   		$result = mysql_query("SELECT * FROM reportdetails WHERE reporttype = '".$reporttype."' ORDER BY detail");
				   		while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
				      		$row = "<tr><td width=\"1%\"><input type=\"checkbox\" id=\"detail_".$line['id']."\" name=\"detail[]\" value=\"".$line['id']."\" onclick=\"if(this.checked){document.getElementById('checkthis".$line['id']."').value='1'; } else{ document.getElementById('checkthis".$line['id']."').value=''; }\"";
					  		if(isset($formvalues) && in_array($line['id'],$formvalues['detail'])){ $row .= "checked";}
					  		$row .= "></td><td width=\"99%\">".$line['detail']."<input type=\"hidden\" name=\"check\" id=\"checkthis".$line['id']."\" value=\"\" /></td></tr>";
					  
					  		echo $row;
				   		}
				   ?>
				   
                 </table>
 <input type="hidden" name="check" id="checkthis2" value="" />
               </div>
			   <br>
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
			  <tr><td colspan="5">
              <div id="printresults_div"><table width="100%" border="0" cellpadding="5" cellspacing="2">
  <tr>
    <td colspan="5"><?php echo $_SESSION['reporttype'];?> Report for <b><?php 
	if(isset($_SESSION['shiftdate']) && $_SESSION['shiftdate'] != "0000-00-00 00:00:00"){ echo date("d-M-Y",strtotime($_SESSION['shiftdate']));} else {
		echo date("d-M-Y");
	}?></b> &nbsp;|&nbsp; &nbsp;&nbsp; Generated by <b><?php echo $_SESSION['names'];?></b></td>
  </tr>
  <tr>
    <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="2" style="border: 1px; 
	border-style: solid;
	border-color: #adaefe">
      <?php   $query = "";
	  		  $wherestr = "";
//**********************************************************************************************			// If the report is for control shift incidents
//**********************************************************************************************
			  if($reporttype == "Control Shift"){
			  	if($formvalues['timefrom'] != ""){
					$wherestr .= " AND timereported >= '".$formvalues['timefrom']."'";
			  	}
				if($formvalues['timeto'] != ""){
					$wherestr .= " AND timereported <= '".$formvalues['timeto']."'";
			  	}
			  	$query = "SELECT * FROM incidents WHERE date = '".$shiftdate."' ".$wherestr;
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
        <?php if(in_array("21",$formvalues['detail'])){?>
        <td>Reference No</td>
        <?php } ?>
        <?php if(in_array("23",$formvalues['detail'])){?>
        <td>Assignment</td>
        <?php } ?>
		<?php if(in_array("22",$formvalues['detail'])){?>
        <td>Details</td>
        <?php } ?>
		<?php if(in_array("28",$formvalues['detail'])){?>
        <td>Checked By</td>
        <?php } ?>
		<?php if(in_array("26",$formvalues['detail'])){?>
        <td>Action(s) Taken</td>
        <?php } ?>
		<?php if(in_array("27",$formvalues['detail'])){?>
        <td>Guard Responsible</td>
        <?php } ?>
		<?php if(in_array("25",$formvalues['detail'])){?>
        <td>Date</td>
        <?php } ?>
		<?php if(in_array("24",$formvalues['detail'])){?>
        <td>Reported By</td>
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
        <?php if(in_array("21",$formvalues['detail'])){?>
        <td valign="top"><?php echo $line['refno'];?></td>
        <?php } ?>
        <?php if(in_array("23",$formvalues['detail'])){?>
        <td valign="top"><?php 
		$data = getRowAsArray("SELECT client FROM assignments WHERE callsign = '".$line['assignment']."'");
		echo $line['assignment']." (".$data['client'].")";?></td>
        <?php } ?>
        <?php if(in_array("22",$formvalues['detail'])){?>
        <td valign="top"><div style="width:150px"><?php echo $line['details'];?></div></td>
        <?php } ?>
		<?php if(in_array("28",$formvalues['detail'])){?>
        <td valign="top"><?php 
		$guard = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames FROM guards g, persons p WHERE g.guardid = '".$line['checkedby']."' AND g.personid = p.id");
				
		echo $line['checkedby'];
		if($guard['firstname'] != "" || $guard['lastname'] != "" || $guard['othernames'] != ""){
			echo " (".$guard['firstname']." ".$guard['lastname']." ".$guard['othernames'].")";
		}
		?></td>
        <?php } ?>
		<?php if(in_array("26",$formvalues['detail'])){?>
        <td valign="top"><?php $actions = split(",",$line['actiontaken']);
		if(trim($line['actiontaken']) != ""){
			echo "<table>";
			for($k=0;$k<count($actions);$k++){
				$action_row = getRowAsArray("SELECT * FROM incidentactions WHERE id = '".$actions[$k]."'");
				echo "<tr><td valign=\"top\">".($k+1).".</td><td><div style=\"width:150px\">".$action_row['details']."</div></td></tr>";
				echo "<tr><td colspan=\"2\"><hr></td></tr>";
			}
			echo "</table>";
		} else { echo "None";}
		?></td>
        <?php } ?>
		<?php if(in_array("27",$formvalues['detail'])){?>
        <td valign="top"><?php 
		$guard = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames FROM guards g, persons p WHERE g.guardid = '".$line['guardresponsible']."' AND g.personid = p.id");
		
		echo $line['guardresponsible'];
		if($guard['firstname'] != "" || $guard['lastname'] != "" || $guard['othernames'] != ""){
			echo " (".$guard['firstname']." ".$guard['lastname']." ".$guard['othernames'].")";
		}
		?></td>
        <?php } ?>
		<?php if(in_array("25",$formvalues['detail'])){?>
        <td valign="top"><?php echo date("d-M-Y",strtotime($line['date']));?></td>
        <?php } ?>
		<?php if(in_array("24",$formvalues['detail'])){?>
        <td valign="top"><?php 
		$guard = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames FROM guards g, persons p WHERE g.guardid = '".$line['reportedby']."' AND g.personid = p.id");
		
		echo $line['reportedby']." (".$guard['firstname']." ".$guard['lastname']." ".$guard['othernames'].")";?></td>
        <?php } ?>
      </tr>
      <?php $i++; } ?>
    </table></td>
  </tr>
  <?php } ?>
</table></div>
             </td> </tr>
            <tr>
              <td align="right" class="label">&nbsp;</td>
              <td colspan="4">&nbsp;</td>
            </tr>
			<?php if(howManyRows($query) != 0){ ?>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="3"><input type="button" name="cancel" id="cancel" value="Cancel" onClick="javascript:window.location.href='../core/dashboard.php';">
			<input type="button" name="Button" id="submit" value="Print"  onClick="openPopWindow(600,350,'Guard Print Report','print')">
			<b> [ Export &gt;&gt; <a href="#"   onClick="openPopWindow(600,350,'MS Word Export for the Guard Report','msword')" title="Export report to MS Word"><img src="../images/mswordimg.gif" width="16" height="16" border="0"></a>&nbsp;&nbsp;<a href="#"   onClick="openPopWindow(600,350,'MS Excel Export for the Guard Report','msexcel')" title="Export report to MS Excel"><img src="../images/msexcelimg.gif" width="16" height="16" border="0"></a> ] </b></td>
          </tr> <?php } ?>
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
