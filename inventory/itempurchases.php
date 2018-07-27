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
	$action = $_GET['a'];
	$formvalues = getRowAsArray("SELECT id, itemtype, itemname,	description, cost, department, supplier, status, approvedby AS whoapproved FROM itempurchases WHERE id = '$id'");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Inventory Item <?php if(isset($_GET['a'])) {
		if($_GET['a'] == "view"){ 
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
        <td class="headings"><a href="manageitempurchases.php">Manage  Item Purchases</a> &gt; <?php if(isset($_GET['a'])) {
		if($_GET['a'] == "view"){ 
			echo "View";
		} else { 
			echo "Edit";
		}
		
		} else { 
			echo "Add";
		}?> Item Purchase </td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="processitempurchases.php" onSubmit="return isNotNullOrEmptyString('itemtype', 'Please select the item type.') && isNotNullOrEmptyString('itemname', 'Please enter the item name.') && isNotNullOrEmptyString('status', 'Please select the item status.') && isNotNullOrEmptyString('cost', 'Please enter the cost of the item.') && isNotNullOrEmptyString('supplier', 'Please select the supplier of the item.') && isNotNullOrEmptyString('department', 'Please select the department for which the item was bought.');">
          <table width="100%" border="0" cellpadding="5">
            <tr>
              <td align="left" colspan="2">Fields marked with <font class="redtext">*</font> are all required</td>
            </tr><?php
		if(isset($_GET['msg'])) {?>
            <tr>
              <td align="center" class="redtext" colspan="2"><?php echo $_GET['msg']; ?></td>
            </tr>
            <?php } ?>
            
            <tr>
              <td align="right" nowrap class="label">Item Type: <font class="redtext">*</font></td>
              <td valign="top"><?php if($action == "view"){
			  	echo $formvalues['itemtype'];
			  } else {?>
			  	<table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="8%" rowspan="2" valign="top"><div id="itemtype_show"><select name="itemtype" id="itemtype">
                      <?php echo generateSelectOptions(getAllEquipmentTypes(), $formvalues['itemtype']);?>
                    </select></div></td>
                    <?php if(!(isset($_GET['a']) && $_GET['a'] == "return") && !isset($_GET['a'])){ ?>
					<td colspan="2" valign="top" nowrap>&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/addforpage.php?area=itemtype','itemtype_add','','Loading...'); return false;">Add New Type</a> | <a href="#" onClick="setDiv('../include/showlist.php?area=itemtype','itemtype_show','','Loading...'); return false;">Refresh List</a></td>
                    <?php }?>
                  </tr>
                  <tr>
                    <td width="2%" valign="top" nowrap>&nbsp;</td>
                    <td width="90%" valign="top" nowrap><div id="itemtype_add" style="width:350px; height:0px; font-style:normal; color:#000066; font-weight:bolder; font-size:14px"></div></td>
                  </tr>
                </table>
				<?php } ?>
				</td>
            </tr>
            <tr>
              <td align="right" nowrap class="label" width="22%">Item Name: <font class="redtext">*</font></td>
                  <td width="78%" valign="top"><?php if($action == "view"){
			  	echo $formvalues['itemname'];
			  } else {?>
                      <input type="text" name="itemname" id="itemname" value="<?php echo $formvalues['itemname'];?>">
                      <?php } ?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Description: </td>
              <td><?php if($action == "view"){
			  	echo "<div style='width:150px'>".$formvalues['description']."</div>";
			  } else {?>
                <textarea name="description" cols="19" rows="3" id="description"><?php echo $formvalues['description'];?></textarea>
                <?php } ?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Status: <font class="redtext">*</font></td>
              <td><?php if($action == "view"){
			  	echo $formvalues['status'];
			  } else {?><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="7%" valign="top"><div id="itemstatus_show">
                      <select name="status" id="status">
                          <?php echo generateSelectOptions(getAllEquipmentStatus(), $formvalues['status']);?>
                        </select>
                    </div></td>
                    <?php if(!(isset($_GET['a']) && $_GET['a'] == "return") && !isset($_GET['a'])){ ?>
                    <td colspan="2" valign="top" nowrap>&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/addforpage.php?area=itemstatus','itemstatus_add','','Loading...'); return false;">Add New Status</a> | <a href="#" onClick="setDiv('../include/showlist.php?area=itemstatus','itemstatus_show','','Loading...'); return false;">Refresh List </a></td>
                    <?php }?>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td width="2%" valign="top" nowrap>&nbsp;</td>
                    <td width="91%" valign="top" nowrap><div id="itemstatus_add" style="width:350px; height:0px; font-style:normal; color:#000066; font-weight:bolder; font-size:14px"></div></td>
                  </tr>
              </table>
                <?php } ?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Cost: <font class="redtext">*</font></td>
              <td>UGX 
                <?php if($action == "view"){
			  	echo "<b>".commify($formvalues['cost'])."</b>";
			  } else {?>
                <input type="text" name="cost" id="cost" value="<?php echo commify($formvalues['cost']);?>">
                <?php } ?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Supplier: <font class="redtext">*</font></td>
              <td><?php if($action == "view"){
			  	echo getSupplierById($formvalues['supplier']);
			  } else {?>
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="7%" valign="top"><div id="suppliers_show">
                      <select name="supplier" id="supplier">
                        <?php echo generateSelectOptions(getAllSuppliers(), $formvalues['supplier']);?>
                        </select>
                      </div></td>
                    <?php if(!(isset($_GET['a']) && $_GET['a'] == "return") && !isset($_GET['a'])){ ?>
                    <td colspan="2" valign="top" nowrap>&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/addforpage.php?area=suppliers','suppliers_add','','Loading...'); return false;">Add New Supplier</a> | <a href="#" onClick="setDiv('../include/showlist.php?area=suppliers','suppliers_show','','Loading...'); return false;">Refresh List </a></td>
                    <?php }?>
                    </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td width="2%" valign="top" nowrap>&nbsp;</td>
                    <td width="91%" valign="top" nowrap><div id="suppliers_add" style="width:350px; height:0px; font-style:normal; color:#000066; font-weight:bolder; font-size:14px"></div></td>
                  </tr>
                  </table>
                <?php } ?>              </tr>
            <tr>
              <td align="right" nowrap class="label">Department: <font class="redtext">*</font></td>
              <td><?php if($action == "view"){
			  	echo getDepartmentById($formvalues['department']);
			  } else {?>
                <select name="department" id="department">
                  <?php echo generateSelectOptions(getAllDepartments(), $formvalues['department']);?>
                  </select>
                <?php } ?>              </tr>
            <tr>
              <td align="right" nowrap class="label">Who Approved: </td>
              <td><?php if($action == "view"){
			  	echo $formvalues['whoapproved'];
			  } else {?>
                <input type="text" name="whoapproved" id="whoapproved" value="<?php echo $formvalues['whoapproved'];?>">
                <?php } ?>            </tr>
            <tr>
              <td align="right" nowrap class="label">&nbsp;</td>
              <td>            
            </tr>
            

            <tr>
              <td>&nbsp;</td>
              <td nowrap><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
                &nbsp;&nbsp;
                <?php 
			if($action != "view"){ ?><input type="submit" name="save" value="Save"><?php } ?>
               
                <input name="edit" type="hidden" id="edit" value="<?php 
				if(isset($_GET['a']) && $_GET['a']== "edit"){
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
