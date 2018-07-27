<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_GET['d']) && $_GET['d'] == "delete"){
	$id=decryptValue($_GET['id']);
	mysql_query("DELETE FROM equipment WHERE id='".$id."'");
	$_SESSION['msg'] = "The item has been successfully deleted";
}


//Display the appropriate list of items
if(isset($_GET['a'])){
	$category=$_GET['a'];
	
	$query="SELECT eq.id,eq.name as itemname,ed.name as itemtype, ed.category,eq.status,eq.instore FROM equipment eq LEFT OUTER JOIN equipmentdetails ed  ON (eq.type = ed.category) WHERE  eq.type = '$category'  ";
	//echo "SELECT eq.id,eq.name as itemname,ed.name as itemtype, ed.category,eq.status,eq.instore FROM equipment eq LEFT OUTER JOIN equipmentdetails ed  ON (eq.type = ed.category) WHERE  eq.type = '$category' ";exit;
	//$query = "SELECT * FROM equipmentdetails WHERE category = '$category' AND type ='Type' ORDER BY name ";
	
} else {
	$category="Uniforms";
	$query = "SELECT eq.id,eq.name as itemname,ed.name as itemtype, ed.category,eq.status,eq.instore FROM equipment eq LEFT OUTER JOIN equipmentdetails ed  ON (eq.type = ed.category) WHERE  eq.type = '$category' ";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Inventory Stock</title>
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
        <td class="headings">Manage Inventory Stock</td>
      </tr>
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
        <td><form name="form1" method="post" action="inventorystock1.php">
          <table width="100%" border="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><?php 
			  if(!isset($_GET['a'])){
			  	echo "<span class=\"label\">Uniforms</span>";
			  } else {
			  	echo "<a href=\"inventorystock1.php\">Uniforms</a>";
			  }
			  ?> | <?php 
			  if(isset($_GET['a']) && $_GET['a'] == "Vehicles"){
			  	echo "<span class=\"label\">Vehicles</span>";
			  } else {
			  	echo "<a href=\"inventorystock1.php?a=Vehicles\">Vehicles</a>";
			  }
			  ?> | <?php 
			  if(isset($_GET['a']) && $_GET['a'] == "Guns"){
			  	echo "<span class=\"label\">Guns</span>";
			  } else {
			  	echo "<a href=\"inventorystock1.php?a=Guns\">Guns</a>";
			  }
			  ?> | <?php 
			  if(isset($_GET['a']) && $_GET['a'] == "Others"){
			  	echo "<span class=\"label\">Others</span>";
			  } else {
			  	echo "<a href=\"inventorystock1.php?a=Others\">Others</a>";
			  }
			  ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <?php
			
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no items in inventory under this category.</td></tr>";
		   	} else { 
			?>
            <tr>
              <td><div style="padding:4px;width:720px;height:300px;overflow: auto">
			  <table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
                  <tr class="tabheadings">
				  <?php if(userHasRight($_SESSION['userid'], "110")){?>
					<td width="7%">Edit</td>
					<?php } ?>
					<?php if(userHasRight($_SESSION['userid'], "111")){?>
					<td width="7%">Delete</td>
					<?php } ?>
                    <td width="21%" nowrap>Item Type</td>
					<td width="65%" nowrap>Item Name</td>
                  </tr>
                  <?php 
			  //for($i=0;$i<count($displayarr);$i++) { 
			  $i = 0;
			  $result = mysql_query($query);
			  while($line = mysql_fetch_array($result, MYSQL_ASSOC)){
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
                    <td><?php echo $line['itemtype']; ?></td>
					<td><?php echo $line['itemname']; ?></td>
                  </tr>
                  <?php 
			  	$i++;
			  } 
			  ?>
              </table></div></td>
            </tr>
            <?php } ?>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
                </form>        </td>
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
