<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

// If you are searching
if(isset($_GET['v']) && trim($_GET['v']) != ""){
	$where = "WHERE accountname LIKE '%".trim($_GET['v'])."%'";
	$_SESSION['searchaccount'] = $_GET['v'];
} else { $where = "";}

if(isset($_GET['action']) && $_GET['action'] == "delete"){
	mysql_query("DELETE FROM accounts WHERE id = '".$_GET['id']."'");
}

$query = "SELECT * FROM accounts ".$where." ORDER BY accountname";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Accounts</title>
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
        <td class="headings">Manage Accounts </td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
          

          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><span class="label">
              <input name="newaccount" type="button" id="newaccount" onClick="javascript:document.location.href='../core/addaccount.php'" value="Create New Account">
            </span></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
		   <tr>
		    <td><div id="searchtable">
              <table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search For Transaction Type:</td>
                  <td><input name="searchaccount" id="searchaccount" type="text" size="30" value="<?php if(isset($_SESSION['searchaccount'])){ echo $_SESSION['searchaccount'];}?>"></td>
                  <td><input type="button" name="Button" value="Search Account" onClick="pickFormItemAndDirect('searchaccount', '../core/manageaccounts.php?v=', 'Please enter all or part of the account name')"></td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
			<?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no accounts to display.</td></tr>";
		   	} else { 
			?>
          <tr>
            <td>
			<div style="padding:4px;width:720px;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
                <td width="1%">Edit</td>
                <td width="1%">Delete</td>
				<td width="3%">Account Name</td>
				<td width="95%">Account Type</td>
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
                <td><a href="addaccount.php?action=edit&id=<?php echo encryptValue($line['id']); ?>" class="normaltxtlink" title="Modify this account's details.">Edit</a></td>
                <td><a href="#" onClick="javascript:deleteEntity('../core/manageaccounts.php?id=<?php echo $line['id']; ?>&action=delete', 'account', '<?php echo $line['transaction']; ?>')" class="normaltxtlink" title="Delete this account's details.">Delete</a></td>
                
                <td nowrap><?php echo $line['accountname']; ?></td>
				<td><?php 
				if($line['type'] == "outflow"){
					echo "Out Flow";
				} else {
					echo "In Flow";
				}?></td>
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
