<?php
include_once "../include/searchforpage.php";
session_start();
openDatabaseConnection();
if(isset($_GET['id']) || isset($_GET['action'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['action'];
	$data = getRowAsArray("SELECT * FROM users WHERE id = '".$id."'");
}

if($action=="edit"&& !userHasRight($_SESSION['userid'], "56") && $_SESSION['userid']!=$id){
	$url="../core/login.php";
	$_SESSION['errors'] = "You donot have permission to edit this profile";
	forwardToPage($url);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>
          Edit User
            <?php } else {?>
            Create User
          <?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2">
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
    <td colspan="2" align="center" valign="top"><form action="processuser.php" method="post" name="user" id="user" onSubmit="return isNotNullOrEmptyString('firstname', 'Please enter the firstname of the user.') && isNotNullOrEmptyString('lastname', 'Please enter the lastname of the user.') &&  isNotNullOrEmptyString('username', 'Please enter the username of the user.');"><table width="96%" border="0" class="outtertablebg">
      <tr>
        <td class="headings" colspan="2"><?php if($_SESSION['groups'] != "1"){ echo "Edit Your Profile";} else {?><a href="manageusers.php">Manage Users</a> &gt; 
          <?php if($action == 'edit') {?>
          Edit User
          <?php } else {?>
          Create User
          <?php }
		  
		  } ?></td>
      </tr>
      <tr>
        <td>&nbsp;
          
        </td>
      </tr>
      <tr>
        <td align="right" class="label"><font class="redtext">*</font> is a required field </td>
        <td>&nbsp;</td>
      </tr>
      <?php
		if($_SESSION['error'] != '') {
		 ?>
      <tr>
        <td align="senter" colspan="2"><b class="redtext"><?php echo $_SESSION['error']; ?></b></td>
      </tr>
      <?php $_SESSION['error'] = "";
		  } ?>
      <tr>
        <td align="right" class="label">Firstname:<font class="redtext">*</font></td>
        <td><input type="text" name="firstname" id="firstname" value="<?php echo $data['firstname']; ?>">        </td>
      </tr>
      <tr>
        <td align="right" class="label">Lastname:<font class="redtext">*</font></td>
        <td><input type="text" name="lastname" id="lastname" value="<?php echo $data['lastname']; ?>"></td>
      </tr>
      <tr>
        <td align="right" class="label">Email:</td>
        <td><input type="text" name="email" id="email" value="<?php echo $data['email']; ?>"></td>
      </tr>
      <tr>
        <td align="right" class="label">Telephone Number:</td>
        <td><input type="text" name="telephonenumber" id="telephonenumber" value="<?php echo $data['telephonenumber']; ?>"></td>
      </tr>
      <tr>
        <td align="right" class="label" valign="top">Address:</td>
        <td><textarea name="address" id="address"><?php echo $data['address']; ?></textarea></td>
      </tr>
      <tr>
        <td align="right" class="label">Username:<font class="redtext">*</font></td>
        <?php $username_result = mysql_query("SELECT username FROM users");
			$noofusers = mysql_num_rows($username_result);
			?>
        <td colspan="3" nowrap><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="1%" height="13" nowrap><input type="text" name="username" id="username" value="<?php echo $data['username']; ?>" <?php if($data['id'] == "1"){echo "readonly";}?>>
                &nbsp;<img src="../images/bullet.gif"><a href="#" onClick="setDiv('../include/searchforpage.php?area=users&value=','username_search','username','Searching...');  return false; " title="Check whether the username exists.">Check Availability</a></td>
              <td width="99%"><div id="username_search" style="width:250; height:25; font-style:normal; color:#000066; font-weight:bolder; font-size:14px">&nbsp;</div></td>
            </tr>
          </table>        </tr>
		<?php if($action == "edit" ) {?>
	  <tr>
        <td align="right" class="label">Old Password:</td>
        <td class='label'><input type="password" name="oldpassword" id="oldpassword" value=""> 
        <?php if($_SESSION['groups'] == "1"){ echo "<b>NOTE:</b>Dont enter if you are re-setting the user's password.";}?></td>
      </tr>
	  <?php } ?>
      
	  <tr>
        <td align="right" class="label"><?php if($action == "edit" ) { echo "New ";}?>Password:</td>
        <td><input type="password" name="password" id="password" value=""></td>
      </tr>
	  <?php if($_SESSION['groups'] == "1" && $data['id'] != "1"){?>
      <tr>
        <td align="right" class="label" valign="top">User Group:<font class="redtext">*</font></td>
		   <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="13%"><div id="usergroup_show">
                  <select id="groups" name="groups">
                    <?php 
				   //$line = getRowAsArray("SELECT groupid FROM usergroups WHERE userid = '".$id."'");
				   echo generateSelectOptions(getAllUserGroups(),  $data['usergroup']); ?>
                  </select>
                </div></td>
                <td colspan="2">&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/addforpage.php?area=groups','usergroup_add','','Loading...'); return false;" title="Click here to add another user group if it doesn't exist in the list.">Add User Group</a> | <a href="#" onClick="setDiv('../include/showlist.php?area=groups','usergroup_show','','Loading...'); return false;">Refresh List </a> </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td width="2%">&nbsp;</td>
                <td width="85%"><div id="usergroup_add" style="width:350; height:25; font-style:normal; color:#000066; font-weight:bolder; font-size:14px">&nbsp;</div></td>
              </tr>
            </table></td>
          </tr>
            
			<tr>
              <td align="right" class="label">The User is : </td>
              <td class="label"><input type="radio" name="isactive" id="isactive" value="Y" 
			<?php if($data['isactive'] == "Y") {
				echo "checked";
			} ?>>
                Active
                
                &nbsp;&nbsp;
                <input type="radio"   name="isactive" value="N" <?php if($data['isactive']=="N"){ echo "checked";}?>>
              Not Active</td>
            </tr>
			<?php } ?>
            <tr>
              <td align="right" class="label">&nbsp;</td>
              <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
                  <input type="submit" name="submit" id="submit" value="Save">
                  <input type="hidden" name="edit" value="<?php if(isset($action) && $action == "edit"){
				  echo $id;
				  
				  }?>"></td>
            </tr>
          </table></form>
    </td>
  </tr>
    
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
