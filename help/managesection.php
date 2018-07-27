<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

if(isset($_GET['action']) && $_GET['action'] == "delete"){
	mysql_query("DELETE FROM helpsection WHERE id = '".$_GET['id']."'");
}

$query = "SELECT * FROM helpsection ORDER BY id ";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Sections</title>
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
        <td class="headings">Manage Help Sections</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
          

          <tr>
            <td><b class="redtext"><?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != ""){ echo $_SESSION['msg'];
			$_SESSION['msg'] = "";
			}?></b>&nbsp;</td>
          </tr>
          <tr>
            <td><span class="label">
              <input name="newright" type="button" id="newsection" onClick="javascript:document.location.href='../help/addsection.php'" value="Create New Help Section">
            </span></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
			<?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no help sections to display.</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:720px;height:340px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
                <td width="1%">Edit</td>
                <td width="1%">Delete</td>
				<td width="1%">Step</td>
                <td width="96%">Details</td>
				<td width="1%" nowrap>Sub Sections</td>
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
                <td><a href="../help/addsection.php?action=edit&id=<?php echo $line['id']; ?>" class="normaltxtlink">Edit</a></td>
                <td><a href="javascript:deleteEntity('../help/managesection.php?id=<?php echo $line['id']; ?>&action=delete', 'help section', '<?php echo $line['details']; ?>')" class="normaltxtlink">Delete</a></td>
                
                <td><?php echo $line['step']; ?></td>
				<td><?php echo $line['details']; ?></td>
				<td nowrap><a href="../help/addsubsection.php?sid=<?php echo $line['id']; ?>" class="normaltxtlink">New</a> | <a href="../help/managesubsection.php?sid=<?php echo $line['id']; ?>" class="normaltxtlink">Manage</a></td>
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
