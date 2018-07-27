<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

// If you are searching
if(isset($_GET['v']) && trim($_GET['v']) != ""){
	$where = "WHERE type LIKE '%".trim($_GET['v'])."%'";
	$_SESSION['searchservicetype'] = $_GET['v'];
} else { $where = "";}

if(isset($_GET['action']) && $_GET['action'] == "delete"){
	mysql_query("DELETE FROM servicetypes WHERE id = '".$_GET['id']."'");
}

$query = "SELECT * FROM servicetypes ".$where." ORDER BY type";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Tribes</title>
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
        <td class="headings">Manage Service Types </td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
          

          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><span class="label">
              <input name="newservicetype" type="button" id="newservicetype" onClick="javascript:document.location.href='../core/addservicetype.php'" value="Create New Service Type">
            </span></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
		  <tr>
		    <td><div id="searchtable">
              <table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search For Service Type:</td>
                  <td><input name="searchservicetype" id="searchservicetype" type="text" size="30" value="<?php if(isset($_SESSION['searchservicetype'])){ echo $_SESSION['searchservicetype'];}?>"></td>
                  <td><input type="button" name="Button" value="Search Service Types" onClick="pickFormItemAndDirect('searchservicetype', '../core/manageservicetypes.php?v=', 'Please enter all or part of the service type')"></td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
			<?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no service types to display.</td></tr>";
		   	} else { 
			?>
          <tr>
            <td>
			<div style="padding:4px;width:100%;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
                <td width="2%">Edit</td>
                <td width="2%">Delete</td>
                <td width="20%" nowrap>Service Type</td>
				<td width="15%" nowrap>Start Time</td>
				<td width="61%">End Time</td>
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
                <td><a href="../core/addservicetype.php?action=edit&id=<?php echo encryptValue($line['id']); ?>" class="normaltxtlink" title="Modify this service type details.">Edit</a></td>
                <td><a href="#" onClick="javascript:deleteEntity('../core/manageservicetypes.php?id=<?php echo $line['id']; ?>&action=delete', 'service type', '<?php echo $line['type']; ?>')" class="normaltxtlink" title="Delete this service type.">Delete</a></td>
                
                <td><?php echo $line['type']; ?></td>
				<td><?php echo date("H:i",strtotime($line['starttime'])); ?></td>
				<td><?php echo date("H:i",strtotime($line['endtime'])); ?></td>
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
