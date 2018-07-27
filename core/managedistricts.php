<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

// If you are searching
if(isset($_GET['v']) && trim($_GET['v']) != ""){
	$where = "WHERE district LIKE '%".trim($_GET['v'])."%'";
	$_SESSION['searchdistrict'] = $_GET['v'];
} else { $where = "";}

if(isset($_GET['action']) && $_GET['action'] == "delete"){
	$id=decryptValue($_GET['id']);
	mysql_query("DELETE FROM district WHERE id = '".$id."'");
}

//Generate custom made query
$query = "SELECT * FROM district ".$where." ORDER BY district";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Districts</title>
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
        <td class="headings">Manage Districts </td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
          

          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr><?php if(userHasRight($_SESSION['userid'], "127")){?>
            <td><span class="label">
              <input name="newdistrict" type="button" id="newdistrict" onClick="javascript:document.location.href='../core/adddistrict.php'" value="Create New District">
            </span></td>
			<?php } ?>
            </tr>
			<tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
		    <td><div id="searchtable">
              <table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search For District:</td>
                  <td><input name="searchdistrict" id="searchdistrict" type="text" size="30" value="<?php if(isset($_SESSION['searchdistrict'])){ echo $_SESSION['searchdistrict'];}?>"></td>
                  <td><input type="button" name="Button" value="Search Districts" onClick="pickFormItemAndDirect('searchdistrict', '../core/managedistricts.php?v=', 'Please enter all or part of the district name')"></td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
		  
			<?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no districts to display.</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:720px;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
                <?php if(userHasRight($_SESSION['userid'], "127")){?>
				<td width="1%">Edit</td><?php } ?>
                <?php if(userHasRight($_SESSION['userid'], "127")){?>
				<td width="1%">Delete</td><?php } ?>
                <td width="98%">District Name </td>
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
                <?php if(userHasRight($_SESSION['userid'], "127")){?><td><a href="../core/adddistrict.php?action=edit&id=<?php echo encryptValue($line['id']); ?>" class="normaltxtlink" title="Modify district information.">Edit</a></td><?php } ?>
                <?php if(userHasRight($_SESSION['userid'], "127")){?><td><a href="#" onClick="javascript:deleteEntity('../core/managedistricts.php?id=<?php echo encryptValue($line['id']); ?>&action=delete', 'district', '<?php echo $line['district']; ?>')" class="normaltxtlink" title="Delete this district.">Delete</a></td><?php } ?>
                
                <td><?php echo $line['district']; ?></td>
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
