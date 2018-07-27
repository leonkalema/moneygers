<?php
	include_once "../include/commonfunctions.php";
	include_once "../class/class.building.php";
	include_once "../class/class.room.php";
	include_once "../class/class.client.php";
	$id = decryptValue($_GET['id']);
	$id2 = decryptValue($_GET['id2']);
	//die($id2);
	session_start();
	openDatabaseConnection();
	$building = new building();
	
	$building->buildingId = $id2;
	$data = $building->get_building_rooms();
	$row_array = $building->get_building_client();
	$message = "";
	if(isset($_POST['submit'])){
		if(empty($_POST['name']))
			$message = "You must fill the company name";
		else{
			//die("Here");
			$building->buildingName = $_POST['name'];
			$building->update_building();
			$a = 0;
			$room = new room();
			for($a;$a<count($_POST['field_']);$a++)
			{
				$room->roomId = $_POST['id'][$a];
				$room->roomName = $_POST['field_'][$a];
				$room->update_room();
			}
			$a = 0;
			for($a;$a<count($_POST['field']);$a++){
				$room->buildingId = $building->buildingId;
				$room->roomName = $_POST['field'][$a];
				if(!empty($room->roomName))
					$room->set_room();
			}
			header("Location: managebuildings.php?id=".$_GET['id']);	
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>
<link rel="stylesheet" href="../Styles/site_css.css" />
		<script src="../javascript/jquery-1.8.3.js"></script>
		<script language="javascript" type="text/javascript">
		
		var count = 1;
		$(function(){
			$('a#add_field').click(function(){
				count += 1;
				$('#container').append(
						'<br /><br />Room Number:&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "field[]" />'); 
			});
		});
		</script>
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
        <td class="headings">Edit Building
    		
        </td>
        <td style="text-align:right">
        	<b>Quick links &raquo;</b><br /><br />
        	 <a href="managebuildings.php?id=<?php echo $_GET['id']; ?>">Manage buildings</a> &nbsp;|&nbsp;
       		 <a href="manageclients.php">Manage clients</a>
        </td>
      </tr>
      <tr>
        <td><br /><br />
		<table width="100%" border="0" cellpadding="2" cellspacing="2">
          
			
          <tr>
            <td><div style="padding:4px;width:97%;height:420px;overflow: auto">
            <b>Client:</b>&nbsp; <?php echo $row_array['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
            <b>Building:</b>&nbsp; <?php echo $row_array['buildingName']; ?>
            <br /><br />
			<?php
		if($message != "") echo "<span class=\"redtext\">".$message."<br><br></span>";
		?>
            <form method="post">
            	
                <?php
					echo "Building Name:&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"name\" value=\"".$row_array['buildingName']."\" /><br><br>";
					while($row = mysql_fetch_array($data)){
						 
						echo "Room Number:&nbsp;&nbsp;&nbsp; <input type=\"text\" name=\"field_[]\" value=\"".$row['roomName']."\" ><br><br>";
						echo "<input type=\"hidden\" name=\"id[]\" value=\"".$row['roomID']."\">";
						
					}
				?>
                <div id="container">
           
            </div>
            <a href="#" id="add_field">&raquo;Add new room</a>
            <br /><br />
            <input type="submit" value="Update" name="submit" />
            </form>
            </td>
          </tr>
        </table>
        </td>
        </tr>
        </table>
        </td>
        </tr>
        </table>
        </body>
</html>