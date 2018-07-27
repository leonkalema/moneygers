<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
$id=decryptValue($_GET['id']);
$data = getRowAsArray("SELECT * FROM users WHERE id = '".$id."'");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - View User</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
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
    <td colspan="2" align="center" valign="top"><table width="100%" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings"><?php if(userHasRight($_SESSION['userid'], "130")){?><a href="manageusers.php">Manage Users</a> &gt;<?php } ?> View User </td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td width="19%" align="right" class="label">Firstname: </td>
            <td width="81%">
              <?php echo $data['firstname']; ?>            </td>
          </tr>
          <tr>
            <td align="right" class="label">Lastname:</td>
            <td><?php echo $data['lastname']; ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Email:</td>
            <td><?php echo $data['email']; ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Telephone Number:</td>
            <td><?php echo $data['telephonenumber']; ?></td>
          </tr>
          <tr>
            <td align="right" class="label" valign="top">Address:</td>
            <td><?php echo "<div style=\"width:150\">".$data['address']."</div>"; ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Username:</td>
            <td><?php echo $data['username']; ?></td>
          </tr>
         <?php $line = getRowAsArray("SELECT name FROM groups WHERE id = '".$data['usergroup']."'");
			 ?> <tr>
            <td align="right" class="label" valign="top">User Group: </td>
            <td><?php echo $line['name']; ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Is Active: </td>
            <td>
			<?php if ($data['isactive'] == "Y") echo "YES"; else echo "NO"; ?></td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"></td>
          </tr>
          
        </table>
        </td>
      </tr>
    </table></td>
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
