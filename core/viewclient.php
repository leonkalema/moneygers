<?php
include_once "../class/class.client.php";
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$client = new Client;
$id = decryptValue($_GET['id']);
$client->get($id);

//$id=$_GET['id'];

if(isset($_GET['id'])){
	$query=mysql_query("select * from clients where id='$id'");
}
	
	
	while($row=mysql_fetch_array($query)){
		$name=$row[name];
		$plotno=$row[plotno];
		$boxno=$row[boxno];
		$floorno=$row[floorno];
		$genphone=$row[genphone];
		$contname=$row[contname];
		$contposition=$row[contposition];
		$contphone=$row[contphone];
		$fax=$row[fax];
		$email=$row[email];
		$billingtype=$row[billingtype];
		$bank=$row[bank];
		$accountnumber=$row[accountnumber];
		$isactive=$row[isactive];
	}
	
	// separate telephone numbers if they are more than 1
	$telephone=explode(",", $genphone);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - View Client</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style2 {
	font-size: 10px;
	font-weight: bold;
}
-->
</style>
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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings"><a href="manageclients.php">Manage Clients</a> &gt; View Client</td>
      </tr>
      <tr>
        <td height="340"><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td width="37%" align="right" class="label">Name: </td>
            <td colspan="2">
              <?php echo $client->getName(); ?>            </td>
          </tr>
          <tr>
            <td height="17" rowspan="3" align="right" valign="top" class="label">Address:</td>
            <td width="16%"><span class="label">Plot No:<br>
              (Street/Address) </span></td>
            <td width="47%"><?php echo $plotno; ?>&nbsp;</td>
          </tr>
          <tr>
            <td class="label">P. O. Box:</td>
            <td><?php echo $boxno; ?>&nbsp;</td>
          </tr>
          <tr>
            <td class="label">Floor &amp; Room No:<br>
              (If Applicable)</td>
            <td><?php echo $floorno; ?>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">Telephone(s): </td>
            <td colspan="2"><?php echo $telephone[0]; ?><br><?php echo $telephone[1]; ?><br><?php echo $telephone[2]; ?></td>
          </tr>
          <tr>
            <td height="18" align="right" class="label">Contact Name:  </td>
            <td colspan="2"><?php echo $contname; ?></td>
          </tr>
          <tr>
            <td height="18" align="right" class="label">Contact Position: </td>
            <td colspan="2"><?php echo $contposition; ?></td>
          </tr>
          <tr>
            <td height="18" align="right" class="label">Mobile: </td>
            <td colspan="2"><?php echo $contphone; ?>&nbsp;</td>
          </tr>
		  <tr>
            <td height="18" align="right" class="label">Fax: </td>
            <td colspan="2"><?php echo $fax; ?>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">Email:</td>
            <td colspan="2"><?php echo $email; ?>&nbsp;</td>
          </tr>
          
          
          <tr>
            <td align="right" class="label">The Client is : </td>
            <td colspan="2"><?php 
			if($isactive=='Y'){
			echo "ACTIVE";
		}
			else{
			echo "INACTIVE";
		}
			
			 ?>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>

        </table>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
