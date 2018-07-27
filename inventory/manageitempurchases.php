<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

if(isset($_GET['a']) && $_GET['a'] == "delete"){
	$id=decryptValue($_GET['id']);
	mysql_query("DELETE FROM itempurchases WHERE id='".$id."'");
	$_SESSION['msg'] = "The item has been successfully deleted";
}


// Searching for a leave application	
if(isset($_GET['a']) && $_GET['a'] == "search"){
	$_SESSION['searchitempurchases'] = trim($_GET['v']);
	
	//Search through all the leave application and get the relevant results
	
	//search by Item Name
	if($_GET['type'] == "Item Name"){
		$searchvalue = $_SESSION['searchitempurchases'];
		$searchresultsarray = array();
		
		$whereclause = "AND i.itemname LIKE '%".trim($_GET['v'])."%' ";
	}
	
	//search by Supplier
	if($_GET['type'] == "Supplier"){
		$searchvalue = $_SESSION['searchitempurchases'];
		$searchresultsarray = array();
		
		$whereclause = "AND s.suppliername LIKE '%".$searchvalue."%'";
	}
	
	//search by Item type
	if($_GET['type'] == "Item Type"){
		$searchvalue = $_SESSION['searchitempurchases'];
		$searchresultsarray = array();
		
		$whereclause = "AND i.itemtype LIKE '%".$searchvalue."%'";
	}	
}
else {
	$whereclause="";
}

//Generate custom made query
$query = "SELECT i.id, i.itemtype, i.itemname,	i.cost, i.supplier, i.date_of_entry FROM itempurchases i, suppliers s WHERE i.supplier = s.id ".$whereclause." ORDER BY i.date_of_entry DESC";

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
    <td colspan="2" align="center" valign="top">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings">Manage Item Purchase </td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          

          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
		   <?php if(userHasRight($_SESSION['userid'], "168")){?>
            <td><span class="label">
              <input type="button" name="newitem" value="Register Purchase" onClick="javascript:document.location.href='../inventory/itempurchases.php'">
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
                  <td><input name="searchitempurchases" id="searchitempurchases" type="text" size="20" value="<?php if(isset($_SESSION['searchitempurchases'])){ echo $_SESSION['searchitempurchases'];}?>"></td>
                  <td>Search By: 
                    <select name="type" id="type">
                      <option value="Item Name">Item Name</option>
					  <option value="Item Type">Item Type</option>
					  <option value="Supplier" <?php if(isset($_GET['type']) && $_GET['type'] == "Supplier"){ echo "selected";}?>>Supplier</option>	
                    </select> 
					</td>
                  <td><input type="button" name="Button" value="Search Items" onClick="pickFormItemTypeAndDirect('searchitempurchases', '../inventory/manageitempurchases.php?a=search&v=', 'Please enter item name, type or supplier')"></td>
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
            <td><div style="padding:4px;width:720px;height:350px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			  <?php if(userHasRight($_SESSION['userid'], "166")){?>
				<td width="4%" height="21">Edit</td>
				<?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "169")){?>
                <td width="6%">Delete</td>
                <?php } ?>
                <td width="14%">Item Type </td>
				<td width="19%">Item Name</td>
				<td width="10%">Cost</td>
                <td width="11%">Supplier</td>
				<td width="36%">Purchase Date </td>
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
               <?php if(userHasRight($_SESSION['userid'], "166")){?>
				<td><a href="../inventory/itempurchases.php?id=<?php echo encryptValue($line['id']);
				echo "&a=edit";
				?>" class="normaltxtlink" title="Modify item details.">Edit</a></td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "169")){?>
                <td><a href="#" onClick="javascript:deleteEntity('../inventory/manageitempurchases.php?id=<?php echo encryptValue($line['id']); 
				echo "&a=delete";?>', 'item', '<?php echo $line['itemname']; ?>')" class="normaltxtlink" title="Delete this item from purchased items.">Delete</a></td><?php } ?>
                <td><?php echo $line['itemtype']; ?></td>
                <td><a href="../inventory/itempurchases.php?id=<?php echo encryptValue($line['id']);?>&a=view" class="normaltxtlink"><?php echo $line['itemname']; ?></a></td>
                <td><?php echo commify($line['cost']); ?></td>
                <td><?php echo getSupplierById($line['supplier']); ?></td>
				<td><?php echo date("d-M-Y",strtotime($line['date_of_entry'])); ?></td>
                </tr>
			  <?php 
			  $i++;
			  } ?>
            </table>
            </div></td>
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
