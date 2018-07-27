<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

if(isset($_SESSION['formvalues']) && count($_SESSION['formvalues']) > 0 && !isset($_GET['id'])){
	$formvalues = $_SESSION['formvalues'];
}

if( isset($_GET['id']) && !userHasRight($_SESSION['userid'], "110")){
	$url="../core/login.php";
	$_SESSION['errors'] = "You donot have permission to edit this item";
	forwardToPage($url);
}

if(isset($_GET['id']) && $_GET['id'] != ""){
	$id = decryptValue($_GET['id']);
	$formvalues = getRowAsArray("SELECT * FROM equipment WHERE id = '$id'");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Inventory Item <?php if(isset($_GET['d'])) {
		if($_GET['d'] == "view"){ 
			echo "View";
		} else { 
			echo "Edit";
		}
		
		} else { 
			echo "Register";
		}?></title>
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
        <td class="headings"><a href="inventorystock.php">Manage Inventory Items</a> &gt; Item <?php if(isset($_GET['d'])) {
		if($_GET['d'] == "view"){ 
			echo "View";
		} else { 
			echo "Edit";
		}
		
		} else { 
			echo "Register";
		}?></td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="processitem.php" onSubmit="return isNotNullOrEmptyString('type', 'Please select the item type.') && isNotNullOrEmptyString('serialno', 'Please enter the serial number.') && isNotNullOrEmptyString('status', 'Please select the item status.');">
          <table width="100%" border="0" cellpadding="5">
            <tr>
              <td align="center" colspan="2"><font class="redtext">*</font> is a required field </td>
            </tr><?php
		if(isset($_GET['msg'])) {?>
            <tr>
              <td align="center" class="redtext" colspan="2"><?php echo $_GET['msg']; ?></td>
            </tr>
            <?php } ?>
            
            <tr>
              <td align="right" nowrap class="label" width="1%">Item  Type: <font class="redtext">*</font></td>
              <td width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="8%" rowspan="2" valign="top"><div id="itemtype_show"><select name="type" id="type">
                      <?php echo generateSelectOptions(getAllEquipmentTypes(), $formvalues['type']);?>
                    </select></div></td>
                    <?php if(!(isset($_GET['a']) && $_GET['a'] == "return") && !isset($_GET['d'])){ ?>
					<td colspan="2" valign="top" nowrap>&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/addforpage.php?area=itemtype','itemtype_add','','Loading...'); return false;">Add New Type</a> | <a href="#" onClick="setDiv('../include/showlist.php?area=itemtype','itemtype_show','','Loading...'); return false;">Refresh List</a></td>
                    <?php }?>
                  </tr>
                  <tr>
                    <td width="2%" valign="top" nowrap>&nbsp;</td>
                    <td width="90%" valign="top" nowrap><div id="itemtype_add" style="width:350px; height:0px; font-style:normal; color:#000066; font-weight:bolder; font-size:14px"></div></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Item Name: </td>
              <td><input type="text" name="name" id="name" value="<?php echo $formvalues['name'];?>"></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Serial No.: <font class="redtext">*</font></td>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td width="28%" valign="top"><input type="text" name="serialno" id="serialno" value="<?php echo $formvalues['serialno'];?>"></td>
                  <td width="23%" valign="top">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/searchforpage.php?area=return_serialno&value=','serialno_search','serialno','Searching...'); return false; ">Check Availability</a>&nbsp;</td>
                  <td width="49%"><div id="serialno_search" style="width:200px; height:0px; font-style:normal; font-weight:bolder; font-size:14px"></div></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Status: <font class="redtext">*</font></td>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="7%" valign="top"><div id="itemstatus_show"><select name="status" id="status">
                      <?php echo generateSelectOptions(getAllEquipmentStatus(), $formvalues['status']);?>
                    </select></div>					</td>
                    <?php if(!(isset($_GET['a']) && $_GET['a'] == "return") && !isset($_GET['d'])){ ?>
                    <td colspan="2" valign="top" nowrap>&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/addforpage.php?area=itemstatus','itemstatus_add','','Loading...'); return false;">Add New Status</a> | <a href="#" onClick="setDiv('../include/showlist.php?area=itemstatus','itemstatus_show','','Loading...'); return false;">Refresh List </a></td>
                    <?php }?>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td width="2%" valign="top" nowrap>&nbsp;</td>
                    <td width="91%" valign="top" nowrap><div id="itemstatus_add" style="width:350px; height:0px; font-style:normal; font-weight:bolder; font-size:14px"></div></td>
                  </tr>
                </table></td>
            </tr>
            

            <tr>
              <td>&nbsp;</td>
              <td nowrap><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
                &nbsp;&nbsp;
                <?php 
			if(!(isset($_GET['d']) && $_GET['d'] == "view")){ ?><input type="submit" name="save" value="Save"><?php } ?>
               
                <input name="edit" type="hidden" id="edit" value="<?php 
				if(isset($_GET['d']) && $_GET['d']== "edit"){
					echo $_GET['id'];
				}
				
				$_SESSION['formvalues'] = array();
				?>"></td>
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
