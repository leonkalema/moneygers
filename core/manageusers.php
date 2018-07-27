<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();


if(isset($_GET['a']) && $_GET['a'] == "search"){
$query = "SELECT * FROM users";
	if(isset($_GET['groupid'])){
		$groupid=decryptValue($_GET['groupid']);
		$query .= " WHERE usergroup = '$groupid' ";
	
	} else if($_GET['userid']){
		$query .= " WHERE id = '".$_GET['userid']."'";
	}
}

// If you are searching
else if(isset($_GET['v']) && trim($_GET['v']) != ""){
	$_SESSION['searchuser'] = trim($_GET['v']);
	$searchvalues = $_SESSION['searchuser'];
	
	// Scan through the search values separated by a space
	$searchvalue = explode(" ",$searchvalues);
	
	$where= "WHERE (firstname LIKE '%".$searchvalue[0]."%' or lastname LIKE '%".$searchvalue[0]."%') AND (firstname LIKE '%".$searchvalue[1]."%' or lastname LIKE '%".$searchvalue[1]."%') ";

$query = " SELECT * FROM users ".$where." ORDER BY id DESC";
	
} 
else {
	$where = "";
	$query = "SELECT * FROM users ".$where." ORDER BY id DESC";
}




?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Users</title>
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
        <td class="headings">Manage Users </td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="2" cellspacing="2">

          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?php if(userHasRight($_SESSION['userid'], "54")){?>
              <input type="button" name="newuser" value="Create New User" onClick="javascript:document.location.href='../core/user.php'"><?php } ?>
            <?php if(isset($_GET['a'])){?><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"><?php }?></td>
			
            </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
		  <tr>
		    <td><div id="searchtable">
              <table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search For User:</td>
                  <td><input name="searchuser" id="searchuser" type="text" size="30" value="<?php if(isset($_SESSION['searchuser'])){ echo $_SESSION['searchuser'];}?>"></td>
                  <td><input type="button" name="Button" value="Search Users" onClick="pickFormItemAndDirect('searchuser', '../core/manageusers.php?v=', 'Please enter all or part of the name')"></td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
			<?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no users to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:98%;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			  <?php if(userHasRight($_SESSION['userid'], "56")){?>
                <td>Edit</td><?php } ?>				
				<?php if(userHasRight($_SESSION['userid'], "57")){?>
                <td>Delete</td><?php } ?>
                <td>Name</td>
                <td>Username</td>
                <td>Email</td>
                <td>Telephone</td>
                <td>Is Active</td>
              </tr>
			  <?php
			  $i = 0;
			  $result = mysql_query($query);
			  while($theuser = mysql_fetch_array($result, MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
			  <?php if(userHasRight($_SESSION['userid'], "56")){?>
                <td><a href="../core/user.php?action=edit&id=<?php echo encryptValue($theuser['id']); ?>" class="normaltxtlink" title="Modify <?php echo $theuser['firstname']." ".$theuser['lastname']; ?>'s details.">Edit</a></td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "57")){?>
                <td><?php if($theuser['username'] != "admin"){?><a href="#" onClick="javascript:deleteEntity('../core/deleteuser.php?id=<?php echo encryptValue($theuser['id']); ?>', 'user', '<?php echo $theuser['name']; ?>')" class="normaltxtlink" title="Remove user from the system.">Delete</a><?php }?> </td>
			<?php } ?>
                <td><?php echo $theuser['firstname']." ".$theuser['lastname']; ?></td>				
                <td><?php echo $theuser['username']; ?></td>
                <td><?php echo $theuser['email']; ?></td>
                <td><?php echo $theuser['telephonenumber']; ?></td>
                <td><?php echo changeBinaryToPageValues($theuser['isactive']); ?></td>
              </tr>
			  <?php 
			  $i++;
			  } ?>
            </table></div></td>
          </tr>			
			<?php } ?>

        </table>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include("../include/footer.php");?></a></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
