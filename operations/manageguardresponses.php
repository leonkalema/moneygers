<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();

session_start();

	$id=$_GET['id'];
	$q=mysql_query("SELECT * from guardresponseforms");
	
	$personnels = mysql_num_rows($q);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Personnel Files</title>
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
        <td class="headings">Manage Guard Responses </td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          

          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><span class="label">
              <input type="button" name="newguardresponse" value="Create New Guard Responses" onClick="javascript:document.location.href='../operations/guardresponses.php'">
            </span></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
			<?php
			if(count($personnels) == 0){          			
				echo "<tr><td>There are no Guard Responses to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:720px;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
                <td width="14%">Edit</td>
                <td width="8%">Delete</td>
                <td width="13%">Assignment</td>
                <td width="17%">ID</td>
                <td width="23%">Location</td>
                <td width="25%">Date</td>
              </tr>
			  <?php
			  $i=0;
			   	while($thepersonnel=mysql_fetch_array($q,MYSQL_ASSOC)){
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
                <td><a href="../operations/guardresponses.php?action=edit&id=<?php echo encryptValue($thepersonnel['id']); ?>" class="normaltxtlink">Edit</a></td>
                <td><a href="#" onClick="javascript:deleteEntity('../operations/deleteguardresponses.php?id=<?php echo $thepersonnel['id']; ?>', 'GuardResponse', '<?php echo $thepersonnel['id']; ?>')" class="normaltxtlink">Delete</a></td>
                <td><a href="../hr/viewassignment.php?id=<?php echo $thepersonnel['id']; ?>" class="normaltxtlink"><?php echo $thepersonnel['assignment']; ?></a></td>
                <td><a href="../operations/viewguardresponses.php?id=<?php echo $thepersonnel['id']; ?>" class="normaltxtlink"><?php echo $thepersonnel['id']; ?></a></td>
                <td><?php echo $thepersonnel['location']; ?>&nbsp;</td>
                <td><?php echo $thepersonnel['datecreated']; ?></td>
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
    <td colspan="2" align="left" valign="top" class="copyright"><?php include('../include/footer.php');?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
