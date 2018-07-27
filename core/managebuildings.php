<?php
	include_once "../include/commonfunctions.php";
	include_once "../class/class.building.php";
	include_once "../class/class.room.php";
	include_once "../class/class.client.php";
	$id = decryptValue($_GET['id']);
	session_start();
	openDatabaseConnection();
	$building = new building();
	$client = new Client();
	$client->get($id);
	$building->clientId = $id;
	$data = $building->get_building();
	$room = new room();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../Styles/site_css.css" />
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
        <td class="headings">Manage Buildings</td>
        <td style="text-align:right">
        	<b>Quick links &raquo;</b><br /><br />
        	 <a href="manageclients.php">Manage clients</a>
        </td>
      </tr>
      <tr>
        <td>
        	<form name="form1" method="post" action="manageclients.php">
		<table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?php if(userHasRight($_SESSION['userid'], "48")){?>
			
              <a href="../core/add-building.php?id=<?php echo $_GET['id']; ?>">New Building &raquo;</a>
              
           <?php } ?> 
			  </td>           
            </tr>
          <tr>
              <td>&nbsp;</td>
            </tr>
            
            
          <tr>
            <td><div style="padding:4px;width:97%;height:420px;overflow: auto">
            <b>Client:</b>&nbsp; <?php echo $client->name; ?>
            <br /><br />
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			  	<?php if(userHasRight($_SESSION['userid'], "53")){?>
                <td></td>
                <td>Building</td>
                <td>Number of rooms</td>
                <td></td>
              </tr>
			  <?php
			  $i = 0;
			   while($row=mysql_fetch_array($data)) { 
			   		//die()
				  $room->buildingId = $row['buildingID'];
				  $rooms = $room->get_room_count();
				  
			   
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
              <?php
			  	echo "<td>".($i+1)."</td>";
				echo "<td>".$row['buildingName']."</td>";
				echo "<td>".$rooms['sum']."</td>";
				echo "<td><a href=\"edit-building.php?id=".$_GET['id']."&id2=".encryptValue($row['buildingID'])."\" title=\"Edit, Add a new rooms to\">Edit</a></td>";
			  ?>
              </tr>
            <?php
			$i++;
			   }
			   }
			?>
              
        </td>
      </tr>
    </table>

<body>
</body>
</html>