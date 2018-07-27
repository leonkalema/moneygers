<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

if(isset($_GET['d']) && $_GET['d'] == "delete"){
	$id=decryptValue($_GET['id']);
	mysql_query("DELETE FROM equipment WHERE id='".$id."'");
	$_SESSION['msg'] = "The item has been successfully deleted";
}


// Searching for a leave application	
if(isset($_GET['a']) && $_GET['a'] == "search"){
	$_SESSION['searchinventory'] = trim($_GET['v']);
	
	//Search through all the leave application and get the relevant results
	
	//search by Guard Name
	if($_GET['type'] == "Item Name"){
		$searchvalue = $_SESSION['searchinventory'];
		$searchresultsarray = array();
		
		$whereclause = "WHERE name LIKE '%".trim($_GET['v'])."%' ";
	}
	
	//search by Guard ID
	if($_GET['type'] == "Serial No"){
		$searchvalue = $_SESSION['searchinventory'];
		$searchresultsarray = array();
		
		$whereclause = "WHERE serialno LIKE '%".$searchvalue."%'";
	}
	
	//search by Leave type
	if($_GET['type'] == "Item Type"){
		$searchvalue = $_SESSION['searchinventory'];
		$searchresultsarray = array();
		
		$whereclause = "WHERE type LIKE '%".$searchvalue."%'";
	}	
}
else {
	$whereclause="";
}

//Generate custom made query
$query = "SELECT * FROM equipment ".$whereclause." ORDER BY date_of_entry DESC";

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
            <td>&nbsp;</td>
          </tr>
          <tr>
	  <td>
	  <form method="post" action="">
	  <div id="searchtable"><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td>Search for Items: </td>
                  <td><input name="searchinventory" id="searchinventory" type="text" size="20" value="<?php if(isset($_SESSION['searchinventory'])){ echo $_SESSION['searchinventory'];}?>"></td>
                  <td>Search By: 
                    <select name="type" id="type">
                      <option value="Item Name">Item Name</option>
					  <option value="Item Type">Item Type</option>
					  <option value="Serial No" <?php if(isset($_GET['type']) && $_GET['type'] == "Serial No"){ echo "selected";}?>>Serial No</option>	
                    </select> 
					</td>
                  <td><input type="button" name="Button" value="Search Items" onClick="pickFormItemTypeAndDirect('searchinventory', '../inventory/inventorystock.php?a=search&v=', 'Please enter item name or item type or serial number!')"></td>
                </tr>
              </table>
              </div></form></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
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
                <td>Type</td>
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
                <td><a href="#" onClick="javascript:deleteEntity('../inventory/inventorystock.php?id=<?php echo encryptValue($line['id']); 
				echo "&d=delete";?>', 'item', '<?php echo "item ".$line['serialno']; ?>')" class="normaltxtlink" title="Delete this item from inventory.">Delete</a></td><?php } ?>
                <td><?php echo $line['name']; ?></td>
                <td><?php echo $line['serialno']; ?></td>
                <td><?php echo $line['instore']; ?></td>
				<td><?php echo $line['type']; ?></td>
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
