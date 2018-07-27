<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

// If you are searching
if(isset($_GET['v']) && trim($_GET['v']) != ""){
	$where = "WHERE type='Uniform' AND name LIKE '%".trim($_GET['v'])."%'";
	$_SESSION['searchguarduniform'] = $_GET['v'];
	$query = "SELECT id, name FROM equipmentdetails ".$where." ORDER BY name";
}

if(isset($_GET['action']) && $_GET['action'] == "delete"){
	$id=decryptValue($_GET['id']);
	mysql_query("DELETE FROM equipmentdetails WHERE type='Uniform' AND id = '".$id."'");
}

if(!isset($query)){
	$query = "SELECT id, name FROM equipmentdetails WHERE type='Uniform' ORDER BY name";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Guard Uniform</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>

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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings">Manage Guard Uniform </td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
          

          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><span class="label">
              <input name="newguarduniform" type="button" id="newguarduniform" onClick="javascript:document.location.href='../core/addguarduniform.php'" value="Create New Guard Uniform">
            </span></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
		  <tr>
		    <td><div id="searchtable">
              <table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search For Guard Uniform:</td>
                  <td><input name="searchguarduniform" id="searchguarduniform" type="text" size="30" value="<?php if(isset($_SESSION['searchguarduniform'])){ echo $_SESSION['searchguarduniform'];}?>"></td>
                  <td><input type="button" name="Button" value="Search Guard Uniform" onClick="pickFormItemAndDirect('searchguarduniform', '../core/manageguarduniform.php?v=', 'Please enter all or part of the guard uniform name')"></td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
			<?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no guard uniforms to display.</td></tr>";
		   	} else { 
			?>
          <tr>
            <td>
			<div style="padding:4px;width:720px;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
                <td width="1%">Edit</td>
                <td width="1%">Delete</td>
                <td width="98%">Guard Uniform </td>
              </tr>
			  <?php
			  $result = mysql_query($query);
			  $i = 0;
			  while($line = mysql_fetch_array($result,MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
                <td><a href="../core/addguarduniform.php?action=edit&id=<?php echo encryptValue($line['id']); ?>" class="normaltxtlink" title="Modify this guard uniform details.">Edit</a></td>
                <td><a href="#" onClick="javascript:deleteEntity('../core/manageguarduniform.php?id=<?php echo encryptValue($line['id']); ?>&action=delete', 'guard uniform', '<?php echo $line['name']; ?>')" class="normaltxtlink" title="Modify this guard uniform.">Delete</a></td>
                <td><?php echo $line['name']; ?></td>
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
    <td colspan="2" align="left" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
