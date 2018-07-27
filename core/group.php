<?php
include_once "../include/commonfunctions.php"; 
session_start();

openDatabaseConnection();

if(isset($_GET['id']) || isset($_GET['action'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['action'];
}

if($action=="edit" && !userHasRight($_SESSION['userid'], "61")){
	$url="../core/login.php";
	$_SESSION['errors'] = "You do not have permission to edit this group";
	forwardToPage($url);
}

//if($action == 'edit') {
	$group = getRowAsArray("SELECT * FROM groups WHERE id='".$id."'");
//}
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>          Edit User Group            <?php } else {?>            Create User Group          <?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
        <td class="headings"><a href="managegroups.php">Manage Groups</a> &gt; <?php if($action == 'edit') {?>
          Edit User Group
            <?php } else {?>
            Create User Group
          <?php } ?> </td>
      </tr>
      <tr>
        <td><form action="processgroup.php" method="post" name="group" id="group" onSubmit=" return isNotNullOrEmptyString('name', 'Please enter a name for the group.');"><table width="100%" border="0">
          <tr>
            <td width="31%" align="right" class="label"><font class="redtext">*</font> is a required field </td>
            <td colspan="2">&nbsp;</td>
          </tr>
		 <?php if(isset($_SESSION['errors']) && $_SESSION['errors'] != ""){?>
		  <tr>
            <td width="31%"> </td>
            <td colspan="2"><font class="redtext"><b><?php echo $_SESSION['errors'];?></b></font></td>
          </tr>
		 <?php 
		 	$_SESSION['errors'] = "";
		 } ?>
          <tr>
            <td height="24" align="right" class="label2">Group Name:<font class="redtext">*</font></td>
            <td width="39%">
              &nbsp;
              <input type="text" name="name" id="name" value="<?php echo $group['name']; ?>">
              &nbsp;&nbsp;<img src="../images/bullet.gif" width="5" height="11"> <a href="#" onClick="setDiv('../include/searchforpage.php?area=groups&value=','name_search','name','Searching...'); return false; ">Check Av</a><a href="#" onClick="setDiv('../include/searchforpage.php?area=groups&value=','name_search','name','Searching...'); return false; ">ailability</a></td>
            <td width="30%"><div id="name_search" style="width:150; height:25; font-style:normal; color:#000066; font-weight:bolder; font-size:14px">&nbsp;</div></td>
          </tr>
          <tr>
            <td height="41" align="right" valign="top" class="label2">Rights:&nbsp;</td>
            <td colspan="2"><div style="width:320; height:140; overflow:auto;" id="right_show">&nbsp;
			&nbsp;
			<?php
			//$id=$_GET['id'];
			if(isset($_GET['action']) && $_GET['action']=='edit'){
				$result=mysql_query("select rights from groups where id='$id'");
				$row=mysql_fetch_array($result);
				$rights=$row['rights'];
				$sep=explode(',',$rights);
				//echo $sep;
					
				$selected_items = $sep;
		    }
			echo showRightsList($selected_items);
			
			?>
			</div>               </td>
          </tr>
          <tr>
            <td height="20" rowspan="2" align="right" valign="top" class="label">&nbsp;</td>
            <td colspan="2" valign="top" class="label">Rights Missing? <img src="../images/bullet.gif" width="5" height="11"> <a href="#" onClick="setDiv('../include/addforpage.php?area=rights','right_add','','Loading...'); return false;">Add User Rights</a> | <a href="#" onClick="setDiv('../include/showlist.php?area=rights&type=list','right_show','','Loading...'); return false;">Refresh List</a></td>
            </tr>
          <tr>
            <td colspan="2" valign="top" class="label2"><div id="right_add" style="width:30; height:25; font-style:normal; color:#000066; font-weight:bolder; font-size:14px">&nbsp;</div> </td>
          </tr>
          <tr>
            <td height="41" align="right" valign="top" class="label">Description:</td>
            <td colspan="2">&nbsp;
              <textarea name="description" id="description"><?php echo $group['description']; ?></textarea></td>
          </tr>
          
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="2">&nbsp;
              <input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <input type="submit" name="submit" id="submit" value="Save">
              <input type="hidden" name="lastupdatedby" id="lastupdatedby" value="<?php echo $_SESSION['userid']; ?>">
              <input type="hidden" name="edit" id="edit" value="<?php 
			  if(isset($_GET['id']) && $_GET['id'] != ""){
			  	echo $_GET['id'];
			  } ?>"></td>
          </tr>
        </table>
        </form></td>
      </tr>
    </table>
    </td>
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