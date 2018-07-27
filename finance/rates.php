<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
$formvalues = array_merge($_POST);

if(isset($_POST['SaveRate'])){
	//Update the selected assignment rates
	for($i=0;$i<count($formvalues['assignment']);$i++){
		mysql_query("UPDATE assignments SET rate = '".$formvalues['rate'][$i]."' WHERE id = '".$formvalues['assignment'][$i]."'");
		$formvalues['isAssignments'] = "YES";
	}
	
	//Update the selected guard rates
	for($i=0;$i<count($formvalues['guard']);$i++){
		mysql_query("UPDATE guards SET rate = '".$formvalues['rate'][$i]."', overtimerate = '".$formvalues['overtimerate'][$i]."' WHERE id = '".$formvalues['guard'][$i]."'");
	}
	
	//Show appropriate message
	if(mysql_error() == ""){
		$_SESSION['msg'] = "Your rates have been successfully updated";
	} else {
		$_SESSION['msg'] = "There were problems saving the rates. Please contact your administrator.";
	}
}	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Update Rates</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings"><a href="../finance/managerates.php">Manage Rates </a> &gt; Add Rates </td>
      </tr>
      <tr>
        <td><form action="../finance/rates.php" method="post" name="form1" id="form1"><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td width="18%" align="right">&nbsp;</td>
            <td width="82%" class="redtext"><?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != ""){ echo $_SESSION['msg'];
			$_SESSION['msg'] = "";
			}?></td>
          </tr>
			<tr>
			  <td colspan="2"><table width="100%" border="0" cellpadding="2" cellspacing="2"><tr><td colspan="2"><table width="100%" border="0" cellpadding="2" cellspacing="2" >
                <?php 
		
		//********************************************************************************
		//Display assignment rates for editing
		//********************************************************************************
		if(isset($formvalues['isAssignments']) && $formvalues['isAssignments'] == "YES"){
			 if(count($formvalues['assignment']) != 0){
			 	// Show the last added first in the newly created array from the string
				//$array = array_reverse(split(",",$formvalues['assignments']));
			 	for($i=0;$i<count($formvalues['assignment']);$i++){
			 		$row = getRowAsArray("SELECT id,client,callsign,rate FROM assignments WHERE id='".$formvalues['assignment'][$i]."'"); 
					if(($i%2)==0) {
				     $rowclass = "evenrow";
				  	} else {
				     $rowclass = "oddrow";
				  	}
					?>
					<tr class="<?php echo $rowclass; ?>"><td colspan="2"><input type="hidden" name="assignment[]" id="assignment[]<?php echo $row['id'];?>" value="<?php echo $row['id'];?>"></td></tr>
					<tr class="<?php echo $rowclass; ?>">
					<td width="1%" align="right" class="label">Client:</td>
					<td>
					<?php echo $row['client'];?></td>
					</tr>
					
					<tr class="<?php echo $rowclass; ?>">
					  <td align="right" nowrap class="label">Assignment Call Sign:</td>
					  <td><?php echo $row['callsign'];?></td>
                </tr>
                <tr class="<?php echo $rowclass; ?>">
                  <td align="right" class="label">Assignment Rate:<font class="redtext">*</font></td>
                  <td><input type="text" name="rate[]" id="rate[]<?php echo $line['id'];?>" value="<?php echo $row['rate'];?>" /> 
                    (Do NOT put commas or points e.g., 10000) </td>
                </tr>		 
			 	<?php } 
				echo "</table></td></tr>";
				
			 	}  else {
				echo "<tr><td>There are no assignment rates to edit.</td></tr>";
				}
			 //********************************************************************************
			 //Display guard rates for editing
			 //********************************************************************************
			 } else {
			 	if(count($formvalues['guard']) != 0){
			 	for($i=0;$i<count($formvalues['guard']);$i++){
			 		$row = getRowAsArray("SELECT g.id,g.guardid, g.rate, g.overtimerate, p.firstname, p.lastname, p.othernames, p.birthlastname FROM persons p, guards g WHERE p.id = g.personid AND g.id='".$formvalues['guard'][$i]."'"); 
					if(($i%2)==0) {
				     $rowclass = "evenrow";
				  	} else {
				     $rowclass = "oddrow";
				  	}
					?>
					<tr class="<?php echo $rowclass; ?>"><td colspan="2"><input type="hidden" name="guard[]" id="guard[]<?php echo $row['id'];?>" value="<?php echo $row['id'];?>"></td></tr>
					<tr class="<?php echo $rowclass; ?>">
					<td width="1%" align="right" class="label" nowrap>Guard Name:</td>
					<td>
					<?php echo $row['firstname']." ".$row['lastname']." ".$row['othernames']." ".$row['birthlastname'];?></td>
					</tr>
					
					<tr class="<?php echo $rowclass; ?>">
					  <td align="right" nowrap class="label">Guard ID:</td>
					  <td><?php echo $row['guardid'];?></td>
                </tr>
                <tr class="<?php echo $rowclass; ?>">
                  <td align="right" class="label">Guard Rate:<font class="redtext">*</font></td>
                  <td><input type="text" name="rate[]" id="rate[]<?php echo $line['id'];?>" value="<?php echo $row['rate'];?>" /> 
                    (Do NOT put commas or points e.g., 10000) </td>
                </tr>	
				<tr class="<?php echo $rowclass; ?>">
                  <td align="right" class="label">Guard Overtime Rate:<font class="redtext">*</font></td>
                  <td><input type="text" name="overtimerate[]" id="overtimerate[]<?php echo $line['id'];?>" value="<?php echo $row['overtimerate'];?>" /> 
                    (Do NOT put commas or points e.g., 10000) </td>
                </tr>	 
			 	<?php } ?>
				</table></td></tr>
				<?php
			 	}  else {
				echo "<tr><td>There are no guard rates to edit.</td></tr>";
				}
			 }
			 
			 
			 ?>
			</table></td></tr><tr>
			  <td align="right" class="label">&nbsp;</td>
			  <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
			    &nbsp;&nbsp;
                <input type="submit" name="SaveRate" id="SaveRate" value="Save">                </td>
			  </tr>
        </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include("../include/footer.php");?>&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
