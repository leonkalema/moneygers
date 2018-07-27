<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

//Set edit mode for the inspection
if(isset($_GET['id']) || isset($_GET['a'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['a'];
	
	// details from the inspection table
	$inspectiondetails = getRowAsArray("SELECT * FROM inspections WHERE id = '".$id."'");
	$formvalues['commentids'] = split(",",$inspectiondetails['commentids']);
}

if(isset($_POST['AddReport'])){
	$formvalues = array_merge($_POST);
	$formvalues['commentids'] = array();
	if(trim($formvalues['newlocation']) != ""){
		mysql_query("INSERT INTO comments (madeby, location, details, type, date) VALUES ('".$formvalues['madeby']."','".$formvalues['newlocation']."', '".$formvalues['newdetail']."', 'Inspection', ".changeDateFromPageCombosToMySQLFormat($formvalues['inspection_day'], $formvalues['inspection_month'], $formvalues['inspection_year']).")");
		array_push($formvalues['commentids'],mysql_insert_id());
	}
	
	//Update the entered reports
	for($i=0;$i<count($formvalues['comment']);$i++){
		mysql_query("UPDATE comments SET details = '".$formvalues['details'][$i]."' WHERE id = '".$formvalues['comment'][$i]."'");
		
		array_push($formvalues['commentids'],$formvalues['comment'][$i]);
	}
	
	//Show appropriate message
	if(mysql_error() == ""){
		$_SESSION['msg'] = "Your reports have been successfully updated";
	} else {
		$_SESSION['msg'] = "There were problems saving the reports. Please contact your administrator.";
	}
	$inspectiondetails['date_of_entry'] = trim(changeDateFromPageCombosToMySQLFormat($formvalues['inspection_day'], $formvalues['inspection_month'], $formvalues['inspection_year']), "'");
	$inspectiondetails['madeby'] = $formvalues['madeby'];
	
	if(trim($formvalues['edit']) != ""){
		$id = trim($formvalues['edit']);
	}
}

if(isset($action) && $action == "delete"){
	$newarray = array();
	for($i=0;$i<count($formvalues['commentids']);$i++){
		if($formvalues['commentids'][$i] != decryptValue($_GET['d'])){
			array_push($newarray, $formvalues['commentids'][$i]);
		}
	}
	$formvalues['commentids'] = $newarray;
	 
	mysql_query("DELETE FROM comments WHERE id = '".decryptValue($_GET['d'])."'");
	mysql_query("UPDATE inspections SET commentids = '".implode(",",$formvalues['commentids'])."' WHERE id = '".$id."'");
	
	//Show appropriate message
	if(mysql_error() == ""){
		$_SESSION['msg'] = "Your report has been successfully deleted";
	} else {
		$_SESSION['msg'] = "There were problems deleting the report. Please contact your administrator.";
	}
	
}

if(isset($_POST['SaveAll'])){
	$_SESSION['inspectionvalues'] = array_merge($_POST);
	
	forwardToPage("processinspection.php");
}	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>Edit <?php } else if($action == "view") {?>View <?php } else { ?> Register <?php } ?>Inspection</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings"><a href="../operations/inspections.php">Manage Inspections</a> &gt; <?php if($action == 'edit') { echo "Edit";} else { echo "Register";} ?> Inspection</td>
      </tr>
      <tr>
        <td><form action="addinspection.php" method="post" name="form1" id="form1" onSubmit="return isNotNullOrEmptyString('madeby', 'Please select the inspector\'s name.') &&  isNotNullOrEmptyString('inspection_day', 'Please select the inspection day.') && isNotNullOrEmptyString('inspection_month', 'Please select the inspection month.') && isNotNullOrEmptyString('inspection_year', 'Please select the inspection year.') <?php if(!isset($inspectiondetails['commentids']) &&  !isset($formvalues['commentids'])){?>&& isNotNullOrEmptyString('newlocation', 'Please enter the location of the inspection.') && isNotNullOrEmptyString('newdetails', 'Please enter the report from the inspection.')<?php }?>;"><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td width="1%" align="center" nowrap><font class="redtext">*</font> is a required field </td>
            <td class="redtext"><?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != ""){ echo $_SESSION['msg'];
			$_SESSION['msg'] = "";
			}?></td>
          </tr>
            <tr>
              <td colspan="2">
			  <div id="printresults_div"><table><tr><td align="right"><b>Inspector:<font class="redtext">*</font></b></td>
              <td><?php if(isset($_GET['id']) || (isset($action) && $action == "view")){ 
					echo $inspectiondetails['madeby'];
					?> 
			    <input type="hidden" name="madeby" id="madeby" value="<?php echo $inspectiondetails['madeby'];?>">
			    <?php } else {?><select id="madeby" name="madeby">
              <?php echo generateSelectOptions(getAllInspectors(), $inspectiondetails['madeby']);?>
            </select><?php } ?></td>
            </tr>
            
             <tr>
             <td align="right" nowrap><b>Inspection Date:<font class="redtext">*</font></b></td>
             <td colspan="3">Day: <?php if(isset($action) && $action == "view"){ 
					echo date("d", strtotime($inspectiondetails['date_of_entry']));
				} else {?>
           <select id="inspection_day" name="inspection_day">
<?php 
if(isset($inspectiondetails['date_of_entry']) && $inspectiondetails['date_of_entry'] != "0000-00-00 00:00:00"){
 	$date = date("d", strtotime($inspectiondetails['date_of_entry']));
 } else {
 	if(isset($id)){
		$date = "";
	} else {
		$date = date("d", strtotime("now"));
	}
 }
echo generateSelectOptions(getTime('day',''), $date);?>
</select><?php } ?>
               &nbsp;Month:
               <?php 
			   if(isset($action) && $action == "view"){ 
					echo date("F", strtotime($inspectiondetails['date_of_entry']));
				} else {?>
<select id="inspection_month" name="inspection_month">
 <?php 
 if(isset($inspectiondetails['date_of_entry']) && $inspectiondetails['date_of_entry'] != "0000-00-00 00:00:00"){
 	$date = date("F", strtotime($inspectiondetails['date_of_entry']));
 } else {
 	if(isset($id)){
		$date = "";
	} else {
		$date = date("F", strtotime("now"));
	}
 }
 echo generateSelectOptions(getTime('month',''), $date);?> 
</select>
<?php } ?>
&nbsp;Year:
<?php if(isset($action) && $action == "view"){ 
					echo date("Y", strtotime($inspectiondetails['date_of_entry']));
				} else {?>
<select id="inspection_year" name="inspection_year">
 <?php 
 if(isset($inspectiondetails['date_of_entry']) && $inspectiondetails['date_of_entry'] != "0000-00-00 00:00:00"){
 	$date = date("Y", strtotime($inspectiondetails['date_of_entry']));
 } else {
 	if(isset($id)){
		$date = "";
	} else {
		$date = date("Y", strtotime("now"));
	}
 }
 echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select>
<?php } ?></td>
          </tr>
			
		<tr>
		<td align="right" valign="top"><b>Add Report(s): <font class="redtext">*</font></b></td>
<td><table border="0" cellpadding="2" cellspacing="2"  style="border: 1px; 
	border-style: solid;
	border-color: #adaefe;">
                <?php 
		
		//********************************************************************************
		//Display comments for editing
		//********************************************************************************
		if(isset($formvalues['commentids']) && count($formvalues['commentids']) > 0){
				
				$commentarr = $formvalues['commentids'];
				
				for($i=0;$i<count($commentarr);$i++){
			 		$row = getRowAsArray("SELECT id,location,details FROM comments WHERE id='".$commentarr[$i]."'"); 
					if(($i%2)==0) {
				     $rowclass = "oddrow";
				  	} else {
				     $rowclass = "evenrow";
				  	}
					?>
					<tr class="<?php echo $rowclass; ?>">
					<td width="1%" align="right" nowrap class="label"><input type="hidden" name="comment[]" id="comment[]<?php echo $row['id'];?>" value="<?php echo $row['id'];?>">
					  <?php if(isset($action) && $action != "view"){?>[<a href="#" onClick="javascript:deleteEntity('addinspection.php?id=<?php echo encryptValue($id); ?>&d=<?php echo encryptValue($row['id']); ?>&a=delete', 'report', '<?php echo $row['details']; ?>')">Delete</a>] <?php } ?> <b>Assignment/Location:</b></td>
					<td>
					<?php echo $row['location'];?></td>
					</tr>
					
                <tr class="<?php echo $rowclass; ?>">
                  <td align="right" class="label"><b>Details:<font class="redtext">*</font></b></td>
                  <td><?php if($action == "view"){?><div style="width:150px"><?php echo $row['details'];?></div><?php } else {?><textarea name="details[]" id="details[]<?php echo $line['id'];?>"><?php echo $row['details'];?></textarea><?php } ?></td>
                </tr>		 
			 	<?php } 
				
			 	}  else {
				echo "<tr><td colspan=\"2\">There are no reports entered yet.</td></tr>";
				}
			 //********************************************************************************
			 // Display form to enter new report
			 //********************************************************************************
			 
			 if($action != "view"){
			  ?>
					<tr><td colspan="2">&nbsp;</td></tr>
					<tr><td colspan="2"><hr color="#CCCCCC"></td></tr>
					<tr><td colspan="2">NEW REPORT:</td></tr>
                <tr>
                  <td align="right" class="label" nowrap>Assignment/Location:<font class="redtext">*</font></td>
                  <td><input type="text" name="newlocation" id="newlocation" value="" /></td>
                </tr>	
				<tr>
                  <td align="right" class="label">Details:<font class="redtext">*</font></td>
                  <td><textarea name="newdetail" id="newdetail"></textarea></td>
                </tr>	 
			 	<tr>
                  <td colspan="2" class="label"><input type="submit" name="AddReport" id="AddReport" value="Update"></td>
                  </tr><?php } ?>
				</table></td></tr></table></div>
			  </td>
		</tr>

  
		   <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
          <tr>
            <td colspan="2" class="label"><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:document.location.href='../operations/inspections.php'">
			  <?php if($action != "view"){?><input type="submit" name="SaveAll" id="SaveAll" value="Save Inspection">
			  <input type="hidden" name="edit" id="edit" value="<?php 
			   if((isset($_GET['id']) && $_GET['id'] != "") || ($formvalues['edit'] != "")){
			  	echo $id;
			  } ?>"><?php } else { ?><input type="button" name="Button" id="submit" value="Print"  onClick="openPopWindow(600,350,'Guard Print Report','print')"><?php } ?></td>
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
