<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

$subsecids = getRowAsArray("SELECT substeps FROM helpsection WHERE id = '".$_GET['sid']."'");

if(isset($_GET['action']) && $_GET['action'] == "delete"){
	mysql_query("DELETE FROM helpsubsection WHERE id = '".$_GET['id']."'");
	//remove the id from the section id list
	$oldarray = split(",",$subsecids['substeps']);
	$newarray = array();
	//Remove the id
	for($i=0;$i<count($oldarray);$i++){
		if($oldarray[$i] != $_GET['id']){
			array_push($newarray,$oldarray[$i]);
		}
	}
	//Update the table row of the group
	mysql_query("UPDATE helpsection SET substeps = '".implode(",",$newarray)."' WHERE id = '".$_GET['sid']."'");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Sub Sections</title>
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
        <td class="headings"><a href="managesection.php">Manage Help Sections</a> &gt; Manage Help Sub Sections</td>
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
              <input name="newsubsection" type="button" id="newsubsection" onClick="javascript:document.location.href='../help/addsubsection.php?sid=<?php echo $_GET['sid'];?>'" value="Create New Help Sub Section">
            </span></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
			<?php
			$subsecarray = split(",",$subsecids['substeps']);
			if($subsecids['substeps'] == ""){          			
				echo "<tr><td>There are no help sub sections to display.</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
                <td width="1%">Edit</td>
                <td width="1%">Delete</td>
				<td width="1%">Step</td>
                <td width="97%">Details</td>
              </tr>
			  <?php
			  for($i=0;$i<count($subsecarray);$i++) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
				  $line = getRowAsArray("SELECT * FROM helpsubsection WHERE id='".$subsecarray[$i]."'");
				  if($line['imageURL'] != ""){
				  	$details = $line['imageURL'];
				  } else {
				  	$details = $line['details'];
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
                <td><a href="../help/addsubsection.php?action=edit&id=<?php echo $line['id']; ?>&sid=<?php echo $_GET['sid']; ?>" class="normaltxtlink">Edit</a></td>
                <td><a href="javascript:deleteEntity('../help/managesubsection.php?id=<?php echo $line['id']; ?>&sid=<?php echo $_GET['sid']; ?>&action=delete', 'help sub section', '<?php echo $details; ?>')" class="normaltxtlink">Delete</a></td>
                
                <td><?php echo $line['step']; ?></td>
				<td><?php echo $details; ?></td>
              </tr>
			  <?php } ?>
            </table></td>
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
