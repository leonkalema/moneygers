<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

if( isset($_GET['id']) && !userHasRight($_SESSION['userid'], "115")){
	$url="../core/login.php";
	$_SESSION['errors'] = "You donot have permission to edit item issues";
	forwardToPage($url);
}

if(isset($_SESSION['formvalues']) && count($_SESSION['formvalues']) > 0 && !isset($_GET['id'])){
	$formvalues = $_SESSION['formvalues'];
}

if(isset($_GET['id']) && $_GET['id'] != ""){
	$id = decryptValue($_GET['id']);
	$formvalues = getRowAsArray("SELECT * FROM itemissue WHERE id = '$id'");
}

if(isset($_POST['itemtype'])){
	forwardToPage("index.php?a=".$_POST['actiontype']."&type=".$_POST['itemtype']);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if(isset($_GET['a']) && $_GET['a'] == "return"){ echo "Return";} else { echo "Issue";}?> Item <?php if(isset($_GET['d'])){ if($_GET['d'] == "view"){ echo "View";} else { echo "Edit";}}?></title>
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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings"><a href="itemissues.php<?php if(isset($_GET['a']) && $_GET['a'] == "return"){ echo "?a=return";}?>">Manage Item <?php if(isset($_GET['a']) && $_GET['a'] == "return"){ echo "Return";} else { echo "Issue";}?>s</a> &gt; <?php if(isset($_GET['a']) && $_GET['a'] == "return"){ echo "Return";} else { echo "Issue";}?> Item <?php if(isset($_GET['d'])) {if($_GET['d'] == "view"){ echo "View";} else { echo "Edit";}}?></td>
      </tr>
      <tr>
        <td><form name="form1" method="post" <?php if(isset($_GET['type'])){?>action="processinventory.php" onSubmit="return isNotNullOrEmptyString('itemserial', 'Please select the item serial number.') && isNotNullOrEmptyString('issue_day', 'Please specify the date issued.') && isNotNullOrEmptyString('guardresponsible', 'Please enter the guard who is responsible for this item.') && isNotNullOrEmptyString('assignment', 'Please enter the assignment call sign.') && isNotNullOrEmptyString('itemstatus', 'Please select the item status.')<?php } else { ?>action="index.php" onSubmit="return isNotNullOrEmptyString('itemtype', 'Please select the item type.')<?php } echo ";\""; ?> >
          <table width="100%" border="0" cellpadding="5">
            <tr>
              <td align="center" colspan="2"><font class="redtext">*</font> is a required field </td>
            </tr><?php
		if($_SESSION['error'] != '') {
		 ?>
            
            <tr>
              <td align="center" class="redtext" colspan="2"><?php echo $_SESSION['error']; ?></td>
            </tr>
            <?php $_SESSION['error'] = "";
		  } ?>
            
			<?php if(!isset($_GET['type']) && !isset($_GET['id'])){?>
            <tr>
              <td align="right" nowrap class="label">Item Type: <font class="redtext">*</font></td>
              <td><select name="itemtype" id="itemtype">
                <?php echo generateSelectOptions(getAllEquipmentTypes(), "");?>
              </select>
                <input type="submit" name="save" value="<?php if(isset($_GET['a']) && $_GET['a'] == "return"){
					echo "Return";
				} else {
					echo "Issue";
				}?> Item">
                <input type="hidden" name="actiontype" id="actiontype" value="<?php echo $_GET['a'];?>"></td>
            </tr>
			<?php } else {?>
			
            <tr>
              <td align="right" nowrap class="label" width="1%">Item Serial No.: <font class="redtext">*</font></td>
              <td width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="28%" height="27" valign="top"><?php if(isset($_GET['d'])){ echo $formvalues['serialno'];
					echo "<input name=\"itemserial\" type=\"hidden\" id=\"itemserial\" value=\"".$formvalues['serialno']."\">";
					} else {?>
					<select name="itemserial" id="itemserial">
					  <?php if(isset($formvalues['itemserial'])) {
						$serial = $formvalues['itemserial'];
					  } 
					  
						if(isset($_GET['a']) && $_GET['a'] == "issue"){
							echo generateSelectOptions(getAllItemSerialsForIssue($_GET['type']), $serial);
						}else {
							echo generateSelectOptions(getAllItemSerialsForReturn($_GET['type']), $serial);
						}
					  ?>
                     </select>
					<?php } ?></td>
                    
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label"><?php if(isset($_GET['a']) && $_GET['a'] == "return"){
					echo "Return";
				} else {
					echo "Issu";
				}?>ing Officer: </td>
              <td><?php if(isset($_GET['d'])){ 
			  $person = getRowAsArray("SELECT firstname, lastname, othernames FROM persons WHERE id = '".$formvalues['inventoryofficer']."'");
				echo $person['firstname']." ".$person['lastname']." ".$person['othernames'];
			  } else { echo $_SESSION['names']; }?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Date <?php if(isset($_GET['a']) && $_GET['a'] == "return"){
					echo "Returne";
				} else {
					echo "Issue";
				}?>d: <font class="redtext">*</font></td>
              <td>Day:
                <?php 
			if(isset($_GET['d']) && $_GET['d'] == "view"){
				if(isset($formvalues['date']) && $formvalues['date'] != "0000-00-00 00:00:00"){ 
					$date =  date("d", strtotime($formvalues['date']));
				} else { 
					$date = "";
				}
				echo $date;	
			} else {
			?>
                <select id="issue_day" name="issue_day">
                  <?php 
				if(isset($formvalues['date']) && $formvalues['date'] != "0000-00-00 00:00:00"){ 
					$date =  date("d", strtotime($formvalues['date']));
				} else { 
					if(isset($_GET['a']) && $_GET['a'] == "return"){
						$date = "";
					} else {
						$date =  date("d", strtotime("now"));
					}
				}
						
				echo generateSelectOptions(getTime('day',''),$date);?>
                </select>
                <?php } ?>
&nbsp;Month:
<?php 
			if(isset($_GET['d']) && $_GET['d'] == "view"){
				if(isset($formvalues['date']) && $formvalues['date'] != "0000-00-00 00:00:00"){ 
					$date =  date("F", strtotime($formvalues['date']));
				} else { 
					$date = "";
				}
				echo $date;	
			} else {
			?>
<select id="issue_month" name="issue_month">
  <?php 
  if(isset($formvalues['date']) && $formvalues['date'] != "0000-00-00 00:00:00"){ 
		$date =  date("F", strtotime($formvalues['date']));
	} else { 
		if(isset($_GET['a']) && $_GET['a'] == "return"){
			$date = "";
		} else {
			$date =  date("F", strtotime("now"));
		}
	}
						
  echo generateSelectOptions(getTime('month',''), $date);?>
</select>
<?php } ?>
&nbsp;Year:
<?php if(isset($_GET['d']) && $_GET['d'] == "view"){
				if(isset($formvalues['date']) && $formvalues['date'] != "0000-00-00 00:00:00"){ 
					$date =  date("Y", strtotime($formvalues['date']));
				} else { 
					$date = "";
				}
				echo $date;
				
			} else {
			?>
<select id="issue_year" name="issue_year">
  <?php 
   if(isset($formvalues['date']) && $formvalues['date'] != "0000-00-00 00:00:00"){ 
		$date =  date("Y", strtotime($formvalues['date']));
	} else { 
		if(isset($_GET['a']) && $_GET['a'] == "return"){
			$date = "";
		} else {
			$date =  date("Y", strtotime("now"));
		}
	}
  echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select>
<?php } ?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Guard Responsible: <font class="redtext">*</font></td>
              <td><?php 
			if(isset($_GET['d']) && $_GET['d'] == "view"){ 
				$guard = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames FROM guards g, persons p WHERE p.id = g.personid AND guardid = '".$formvalues['guardresponsible']."'");
				echo $guard['firstname']." ".$guard['lastname']." ".$guard['othernames'];
			} else {
			?><table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td width="28%" valign="top"><input type="text" name="guardresponsible" id="guardresponsible" value="<?php echo $formvalues['guardresponsible'];?>"></td>
                  <td width="23%" valign="top">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&value=','guardname_search','guardresponsible','Searching...'); return false; ">Search for Guard</a>&nbsp;</td>
                  <td width="49%"><div id="guardname_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
                </tr>
              </table><?php } ?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">On Assignment: <font class="redtext">*</font><br>
                (Client name) </td>
              <td><?php 
			if(isset($_GET['d']) && $_GET['d'] == "view"){ 
				echo $formvalues['assignment'];
			} else {
			?>
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="28%" valign="top"><input type="text" name="assignment" id="assignment" value="<?php echo $formvalues['assignment'];?>"></td>
                    <td width="23%" valign="top" nowrap>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_assignments&value=','assignments_search','assignment','Searching...'); return false; ">Search for Assignment</a>&nbsp;</td>
                    <td width="49%"><div id="assignments_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
                  </tr>
                </table>
                <?php } ?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Item Status: <font class="redtext">*</font></td>
              <td><?php 
			if(isset($_GET['d']) && $_GET['d'] == "view"){ 
				echo $formvalues['status'];
			} else {
			?><select name="itemstatus" id="itemstatus">
              
			  <?php if(isset($formvalues['itemstatus'])) {
			  	$status = $formvalues['itemstatus'];
			  } 
			  
			  if(isset($formvalues['status'])){
			  	$status = $formvalues['status'];
			  }
			  echo generateSelectOptions(getAllEquipmentStatus(), $status);
			  ?>
                        </select><?php } ?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Present Condition:</td>
              <td><?php 
			if(isset($_GET['d']) && $_GET['d'] == "view"){ 
				echo "<div style=\"height:100px;width:150px\">".$formvalues['issuecondition']."</div>";
			} else {
			?>
                <textarea name="presentcondition" id="presentcondition" cols="21" rows="4"><?php if(isset($_GET['d'])){ 
				echo $formvalues['issuecondition'];
		} else { 
			echo $formvalues['presentcondition'];
			
		}?></textarea><?php } ?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
           
            <tr>
              <td>&nbsp;</td>
              <td nowrap><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
                &nbsp;&nbsp;
                <?php 
			if(!(isset($_GET['d']) && $_GET['d'] == "view")){ ?><input type="submit" name="save" value="Save"><?php } ?>
                <input name="documenttype" type="hidden" id="documenttype" value="<?php 
				if(isset($_GET['a']) && substr($_GET['a'],0,6) == "return"){
					echo "return";
				} else {
					echo "issue";
				}
				
				$_SESSION['formvalues'] = array();
				?>">
                <input name="edit" type="hidden" id="edit" value="<?php 
				if(isset($_GET['d']) && $_GET['d']== "edit"){
					echo $_GET['id'];
				}
				?>"></td>
            </tr>
			<?php } ?>
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
