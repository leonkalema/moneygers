<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

if(isset($_GET['d']) && $_GET['d'] == "delete"){
	mysql_query("DELETE FROM equipment WHERE id='".$_GET['id']."'");
	$_SESSION['msg'] = "The item has been successfully deleted";
}

// Searching for a leave application	
if(isset($_GET['a']) && $_GET['a'] == "search"){
	$_SESSION['searchinventory'] = trim($_GET['v']);
	$_SESSION['searchtype'] = $_GET['type'];
	
	//Search through all the item stock and get the relevant results
	$whereclause = " WHERE name LIKE '%".$_SESSION['searchinventory']."%' AND type LIKE '%".$_SESSION['searchtype']."%'";
	$query = "SELECT * FROM equipment ".$whereclause." ORDER BY date_of_entry DESC";
	
} else {
	// default query run 
	$query = "SELECT ed.category,eq.id,eq.name,eq.status,eq.serialno,eq.instore,eq.date_of_entry FROM equipmentdetails ed, equipment eq WHERE ed.name=eq.type ORDER BY name";
}
$result = mysql_query($query);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Inventory Stock</title>
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
        <td class="headings">Manage Inventory Stock </td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          

          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
		   <?php if(userHasRight($_SESSION['userid'], "108")){?>
            <td><span class="label">
              <input type="button" name="newitem" value="Register New Item" onClick="javascript:document.location.href='../inventory/item.php'">
            </span></td><?php } ?>
            </tr>
         
		 <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
          <tr>
		   <tr>
            <td><form name="form1" method="post" action="">
              <table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td>Search For Item: </td>
                  <td><input name="searchitem" id="searchitem" type="text" size="30" value="<?php if(isset($_SESSION['searchitem'])){ echo $_SESSION['searchitem'];}?>"></td>
                  <td>Search in:
                    <select name="type" id="type">
                        <?php echo generateSelectOptions(getAllEquipmentTypes(), $_SESSION['searchtype']);?>
                      </select>
                  </td>
                  <td><input type="button" name="Button" value="Search Item" onClick="pickFormItemTypeAndDirect('searchitem', 'inventorystock.php?a=search&v=', 'Please enter the item name.')"></td>
                </tr>
              </table>
                        </form>
            </td>
          </tr>
            
			<?php
			if(mysql_num_rows($result) == 0){          			
				echo "<tr><td>There are no items to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:720px;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			  <?php if(userHasRight($_SESSION['userid'], "110")){?>
				<td>Edit</td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "111")){?>
                <td>Delete</td><?php } ?>
                <td>Item Name</td>
				<td>Serial No.</td>
                <td>In Store</td>
				<td>Entered On</td>
              </tr>
			  <?php
			  $i = 0;
			   while($line = mysql_fetch_array($result,MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
               <?php if(userHasRight($_SESSION['userid'], "110")){?>
				<td><a href="../inventory/item.php?id=<?php echo encryptValue($line['id']);
				echo "&d=edit";
				?>" class="normaltxtlink" title="Modify item details.">Edit</a></td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "111")){?>
                <td><a href="#" onClick="javascript:deleteEntity('../inventory/inventorystock.php?id=<?php echo $line['id']; 
				echo "&d=delete";?>', 'item', '<?php echo "item ".$line['serialno']; ?>')" class="normaltxtlink" title="Delete this item from inventory.">Delete</a></td><?php } ?>
                <td><?php echo $line['name']; ?></td>
                <td><?php echo $line['serialno']; ?></td>
                <td><?php echo $line['instore']; ?></td>
				<td><?php echo date("d-M-Y",strtotime($line['date_of_entry'])); ?></td>
              </tr>
			  <?php 
			  $i++;
			  } ?>
            </table></div></td>
          </tr>			
			<?php } ?>

        </table> </td>
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
