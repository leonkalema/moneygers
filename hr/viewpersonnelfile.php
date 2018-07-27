<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();

session_start();
$id = decryptValue($_GET['id']);

	if(isset($_GET['id'])){
	$q=mysql_query("SELECT * from personnel where id='$id'");
	
	while($row=mysql_fetch_array($q)){
		$names=$row[guard];
		$name=mysql_result(mysql_query("SELECT concat(p.firstname,' ',  p.lastname, ' ',p.othernames) as guardname FROM (persons p INNER JOIN guards g ON (g.personid=p.id)) INNER JOIN personnel ps ON (ps.guard=g.guardid) WHERE ps.guard='$names' "),"guardname");
		$type=$row[type];
		$notes=$row[notes];
		$action=$row[actiontaken];
		if($row['date'] != "0000-00-00 00:00:00"){
			$date=date("d-M-Y",strtotime($row['date']));
		} else {
			$date = "Not Set";
		}
		$takenby = $row['takenby'];
		$letter = $row['disciplineletter'];
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - View Personnel File
</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>
<script type="text/javascript" src="../javascript/tabber.js"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="750" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
  <tr> 
    <td height="7" colspan="2"></td><tr> 

  </tr>
    <td colspan="2"><?php include "../core/header.php";?></td>
  </tr>
  <tr> 
    <td height="7" colspan="2"></td>
  </tr>
  <tr> 
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellpadding="0" cellspacing="0">
      <tr>
        <td class="headings">
            <?php if(!isset($_GET['t'])){?><a href="managepersonnel.php">Manage Personel</a> &gt; <?php } ?>View Personnel File          </td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          <tr>
            <td align="right" class="label">Guard  Name</td>
            <td>
              <?php echo $name; ?>            </td>
          </tr>
          <tr>
            <td height="17" align="right" valign="top" class="label">Discipline Status:</td>
            <td><?php echo $type; ?></td>
            </tr>
          
          <tr>
            <td align="right" class="label">Comments: </td>
            <td><?php echo $notes; ?></td>
          </tr>
          <tr>
            <td height="18" align="right" class="label" width="25%" nowrap>Action Taken on the Guard: </td>
            <td><?php echo $action; ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Taken By: </td>
            <td><?php echo $takenby; ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Letter:</td>
            <td><?php if ($letter!='') {echo $letter; ?>&nbsp;&nbsp;<a href="../files/<?php echo $letter; ?>">View</a><?php } else { echo "No Letter submitted";}?></td>
			</tr>
          <tr>
            <td align="right" class="label">Date Taken:</td>
            <td><?php echo $date; ?></td>
          </tr>
          
          
          <tr>
            <td colspan="2" align="left" class="label"><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"></td>
            </tr>
          
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


