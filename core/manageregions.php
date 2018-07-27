<?php
include_once "../class/class.region.php";
session_start();

$region= new Region;
$id = decryptValue($_GET['id']);
if($action == 'edit') {
	$region->get($id);
}

// If you are searching for regions
if(isset($_GET['v']) && trim($_GET['v']) != ""){
	$_SESSION['searchregion'] = $_GET['v'];

	$where = "WHERE name LIKE '%".trim($_GET['v'])."%' OR description LIKE '%".trim($_GET['v'])."%' OR areascovered LIKE '%".trim($_GET['v'])."%' ";
	
	$regions = $region->getSearchableRegions($where);
}else { 
	$regions = $region->getAllRegions();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Regions</title>
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
        <td class="headings">Manage Regions </td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          

          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
		  <?php if(userHasRight($_SESSION['userid'], "103")){?>
            <td><span class="label">
              <input type="button" name="newregion" value="Create New Region" onClick="javascript:document.location.href='../core/region.php'">
            </span></td><?php } ?>
            </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
		  <tr>
		    <td><div id="searchtable">
              <table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search For Region:</td>
                  <td><input name="searchregion" id="searchregion" type="text" size="30" value="<?php if(isset($_SESSION['searchregion'])){ echo $_SESSION['searchregion'];}?>"></td>
                  <td><input type="button" name="Button" value="Search Regions" onClick="pickFormItemAndDirect('searchregion', '../core/manageregions.php?v=', 'Please enter all or part of the region name')"></td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
		  	<?php
			if(count($regions) == 0){          			
				echo "<tr><td>There are no regions to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td>
			<div style="padding:4px;width:720px;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
                <?php if(userHasRight($_SESSION['userid'], "103")){?>
				<td>Edit</td><?php } ?>
                <?php if(userHasRight($_SESSION['userid'], "103")){?>
				<td>Delete</td><?php } ?>
                <td>Name</td>
                <td>Description</td>
				<td>Areas Covered</td>
                <td>Code</td>
              </tr>
			  <?php
			  $i = 0;
			   foreach($regions as $theregion) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
                <?php if(userHasRight($_SESSION['userid'], "103")){?>
				<td><a href="../core/region.php?action=edit&id=<?php echo encryptValue($theregion['id']); ?>" class="normaltxtlink" title="Modify region details.">Edit</a></td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "103")){?>
                <td><a href="#" onClick="javascript:deleteEntity('../core/deleteregion.php?id=<?php echo $theregion['id']; ?>', 'region', '<?php echo $theregion['name']; ?>')" class="normaltxtlink" title="Delete this region.">Delete</a></td><?php } ?>
                <td><a href="../core/viewregion.php?id=<?php echo encryptValue($theregion['id']); ?>" class="normaltxtlink" title="View region details."><?php echo $theregion['name']; ?></a></td>
                <td><?php echo $theregion['description']; ?></td>
				<td><?php echo $theregion[areascovered];?></td>
                <td><?php echo $theregion['code']; ?></td>
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
