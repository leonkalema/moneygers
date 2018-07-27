<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_POST['SavePAYE'])){
	$formvalues = array_merge($_POST);
	$idstring = "";
	$oldidstring = "";
	$fullidstring = "";
	
	//Update the old actions
	if(isset($formvalues['id']) && count($formvalues['id']) != 0){
	//print_r($formvalues['id']);exit;
		for($i=0;$i<count($formvalues['id']);$i++){
		
			// remove the commas and extra spaces and then save into the db
			$formvalues['fixedtax'][$i] = implode("",split(",",$formvalues['fixedtax'][$i]));
			$formvalues['lowerlevel'][$i] = implode("",split(",",$formvalues['lowerlevel'][$i]));
			$formvalues['upperlevel'][$i] = implode("",split(",",$formvalues['upperlevel'][$i]));
			
			mysql_query("UPDATE payeranges SET fixedtax= '".$formvalues['fixedtax'][$i]."', lowerlevel = '".$formvalues['lowerlevel'][$i]."', upperlevel = '".$formvalues['upperlevel'][$i]."', percentagetax='".$formvalues['percentagetax'][$i]."', type = '".$formvalues['type'][$i]."' WHERE id = '".$formvalues['id'][$i]."'");
			
		}
		mysql_query("DELETE FROM payeranges WHERE id NOT IN (".implode(",",$formvalues['id']).") ");
	}
	
	//Save the new actions too
	if(trim($formvalues['newfixedtax']) != ""){
		// remove the commas and extra spaces and then save into the db
		$formvalues['newfixedtax'] = implode("",split(",",$formvalues['newfixedtax']));
		$formvalues['newlowerlevel'] = implode("",split(",",$formvalues['newlowerlevel']));
		$formvalues['newupperlevel'] = implode("",split(",",$formvalues['newupperlevel']));
		//Insert new ranges
		mysql_query("INSERT INTO payeranges (fixedtax, lowerlevel, upperlevel, percentagetax, type) VALUES ('".$formvalues['newfixedtax']."','".$formvalues['newlowerlevel']."','".$formvalues['newupperlevel']."', '".$formvalues['newpercentagetax']."', '".$formvalues['newtype']."')");
		
		
	}
	
	if(mysql_error() == ""){
		$_SESSION['msg'] = "The PAYE formula has been successfully updated";
	} else {
		$_SESSION['msg'] = "There were problems saving the PAYE formula. Please contact your administrator.";
	}
}

$query = "SELECT * FROM payeranges";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Update the PAYE Formulae</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="90" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
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
        <td class="headings">Update the PAYE Formulae</td>
      </tr>
      <tr>
        <td><form action="payeformula.php" method="post" name="form1" id="form1" ><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td width="18%" align="right">&nbsp;</td>
            <td width="82%" class="redtext"><?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != ""){ echo $_SESSION['msg'];
			$_SESSION['msg'] = "";
			}?></td>
          </tr>
			<tr>
			  <td colspan="2"><table width="100%" border="0" cellpadding="2" cellspacing="2"><tr><td colspan="2"><table width="100%" border="0" cellpadding="2" cellspacing="2" id="rangetable" >
                <?php 
			if(howManyRows($query) > 0){
			 $result1 = mysql_query($query);
			 $i=0;
			 while($row = mysql_fetch_array($result1,MYSQL_ASSOC)){
					if(($i%2)==0) {
				     $rowclass = "evenrow";
				  	} else {
				     $rowclass = "oddrow";
				  	}
					?>
					<tr class="<?php echo $rowclass; ?>"><td colspan="3"><input type="hidden" name="id[]" id="id[]<?php echo ($i+1);?>" value="<?php echo $row['id'];?>"></td></tr>
					<tr class="<?php echo $rowclass; ?>">
					<td align="right" class="label" width="1%">Fixed Tax:<font class="redtext">*</font></td>
					<td width="49%" class="label"><input type="text" name="fixedtax[]" id="fixedtax[]<?php echo ($i+1);?>" value="<?php echo number_format($row['fixedtax']);?>" />
					  Shs</td>
					<td width="50%">Type:
                      <select id="type[]<?php echo ($i+1);?>" name="type[]">
                        <option value="local" <?php if($row['type'] == "local"){ echo "selected";}?>>Local</option>
                        <option value="foreign" <?php if($row['type'] == "foreign"){ echo "selected";}?>>Foreign</option>
                      </select></td>
					</tr>
					
					<tr class="<?php echo $rowclass; ?>">
					  <td align="right" class="label">Lower Limit:<font class="redtext">*</font></td>
					  <td colspan="2" class="label"><input type="text" name="lowerlevel[]" id="lowerlevel[]<?php echo ($i+1);?>" value="<?php echo number_format($row['lowerlevel']);?>" />
					    Shs</td>
                </tr>
                <tr class="<?php echo $rowclass; ?>">
                  <td align="right" class="label" nowrap>Upper Limit:</td>
                  <td colspan="2" class="label"><input type="text" name="upperlevel[]" id="upperlevel[]<?php echo ($i+1);?>" value="<?php echo number_format($row['upperlevel']);?>" />
                    Shs</td>
                </tr>
                <tr class="<?php echo $rowclass; ?>">
                  <td align="right" class="label" nowrap>Tax Percentage:<font class="redtext">*</font></td>
                  <td colspan="2" class="label"><input type="text" name="percentagetax[]" id="percentagetax[]<?php echo ($i+1);?>" value="<?php echo $row['percentagetax'];?>" />
                    %<br>
                    (e.g., &quot;15&quot; for 15%) </td>
                </tr>		 
			 	<?php 
					$i++;
				} ?>
				</table></td></tr>
				<?php
			 } 
			
			 ?><tr>
                  <td align="right" class="label"><a name="AddRange"></a></td>
                  <td nowrap>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#AddRange" onClick= "showHideLayer('addrange')" >Add Range</a>  | <a href="#" onClick="removeMultRows('rangetable',5)">Remove Range</a></td>
                </tr>
				
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><hr color="#CCCCCC"></td>
                </tr>
				<tr>
                  <td colspan="2"><div id="addrange" style="height:0px; visibility:hidden"><table width="100%">
                <tr>
                  <td colspan="3" class="label"><font class="redtext">*</font> is a required field</td>
                  </tr>
                <tr>
                  <td align="right" class="label" width="1%">Fixed Tax:<font class="redtext">*</font></td>
                  <td width="49%" class="label"><input type="text" name="newfixedtax" id="newfixedtax" value="" />
                    Shs</td>
                  <td width="50%" class="label">Type: 
                    <select id="newtype" name="newtype">
                      <option value="local" selected>Local</option>
					  <option value="foreign">Foreign</option>
                    </select></td>
                </tr>
                <tr>
                  <td align="right" class="label">Lower Limit:<font class="redtext">*</font></td>
                  <td colspan="2" class="label"><input type="text" name="newlowerlevel" id="newlowerlevel" value="" />
                    Shs</td>
                </tr>
                <tr>
                  <td align="right" class="label" nowrap>Upper Limit:</td>
                  <td colspan="2" class="label"><input type="text" name="newupperlevel" id="newupperlevel" value="" />
                    Shs</td>
                </tr>
                <tr>
                  <td align="right" class="label" nowrap>Tax Percentage:<font class="redtext">*</font></td>
                  <td colspan="2" class="label"><input type="text" name="newpercentagetax" id="newpercentagetax" value="" />
                    %<br>
                    (e.g., &quot;15&quot; for 15%) </td>
                </tr>
                
                </table>
                  </div>
              </table></td>
			  </tr>
			<tr>
			  <td align="right" class="label">&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr>
			  <td align="right" class="label">&nbsp;</td>
			  <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
			    &nbsp;&nbsp;
               <input type="submit" name="SavePAYE" id="SavePAYE" value="Save">                </td>
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
