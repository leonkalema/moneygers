<?php
include_once "../class/class.region.php";
session_start();
openDatabaseConnection();
$region = new Region;
$action = $_GET['action'];
$id = decryptValue($_GET['id']);
if($action == 'edit') {
	$region->get($id);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>
          Edit Region
            <?php } else {?>
            Create Region
          <?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
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
        <td class="headings"><a href="manageregions.php">Manage Regions </a> &nbsp;&gt; <?php if($action == 'edit') {?>
          Edit Region
            <?php } else {?>
            Add Region
          <?php } ?></td>
      </tr>
	  <tr>
	  	<td colspan="2"><span class="redtext"><?php if (isset($_GET['message'])){ echo $_GET['message']; }?></span></td>
	  </tr>
      <tr>
        <td><form action="processregion.php" method="post" name="region" id="region" onSubmit=" return isNotNullOrEmptyString('code', 'Please enter a code for the region.') && isNotNullOrEmptyString('name', 'Please enter a name for the region.');"><table width="99%" border="0">
          <tr>
            <td width="13%" align="right" class="label"><font class="redtext">*</font> is a required field </td>
            <td width="87%">
              <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
              <input type="hidden" name="createdby" id="createdby" value="<?php echo $_SESSION['userid']; ?>">
              <input type="hidden" name="lastupdatedby" id="lastupdatedby" value="<?php echo $_SESSION['userid']; ?>"></td>
          </tr>
		
          <tr>
           <td align="right" class="label">Code:<font class="redtext">*</font> </td>
            <td colspan="3" nowrap><table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
		    <?php if($action == 'edit') {?>
			<td width="33%" height="13" nowrap><input type="text" name="code" value="<?php echo $region->getCode(); ?>" readonly=""></td> <?php } else{?>
              <td width="32%" height="13" nowrap><input type="text" name="code" id="code" value="<?php echo $region->getCode(); ?>">
                &nbsp;<img src="../images/bullet.gif"><a href="#" onClick="setDiv('../include/searchforpage.php?area=regions&value=','code_search','code','Searching...');  return false; ">Check Availability</a></td>
              <td width=""><div id="code_search" style="width:250; height:25; font-style:normal; font-weight:bolder; font-size:14px">&nbsp;</div></td>
			  <?php } ?>
            </tr>
          </table> 
          </tr>
          <tr>
           <td align="right" class="label">Name:<font class="redtext">*</font></td>
            <td colspan="3" nowrap><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="1%" height="13" nowrap><input type="text" name="name" id="name" value="<?php echo $region->getName(); ?>">
                &nbsp;<img src="../images/bullet.gif" hspace="2"><a href="#" onClick="setDiv('../include/searchforpage.php?area=names&value=','region_search','name','Searching...');  return false; ">Check Availability</a></td>
              <td width="99%"><div id="region_search" style="width:250; height:25; font-style:normal;padding-left:5px; font-weight:bolder; font-size:14px">&nbsp;&nbsp;&nbsp;</div></td>
            </tr>
          </table></tr>
    
          <tr>
           <td align="right" class="label" valign="top">Description:</td>
            <td><textarea name="description" id="description"><?php echo $region->getDescription(); ?></textarea></td>
          </tr>
		  <tr>
           <td align="right" class="label">Areas Covered:</td>
		   	<td><textarea name="Area[]" id="Area[]1"><?php echo $region->getAreasCovered(); ?></textarea></td>
		</tr>
		<tr>
			<td></td>
            <td><img src="../images/bullet.gif">&nbsp;<a href="#" onClick="Addtextbox('Area','area');">Add Area </a> | <a href="#" onClick="Removetextbox('area');">Remove Area </a></td>
		  </tr>
		  <tr>
           <td align="right" class="label">&nbsp;</td>
            <td><table id="area">
            </table></td> 
          </tr>
		  
		  <tr>
           <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td> 
          </tr>
		  
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <input type="submit" name="submit" id="submit" value="Save">
			  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"></td>
          </tr>
        </table>
        </form></td>
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
