<?php
	//die("Here");
	include_once "../include/commonfunctions.php";
	include_once "../class/class.building.php";
	include_once "../class/class.room.php";
	session_start();
	openDatabaseConnection();
	
	$building = new building();
	$building->clientId = decryptValue($_GET['id']);
	$data = $building->get_building();
	$message = "";
	if(isset($_POST['submit'])){
		$count = sizeof($_POST['field']);
		//die($count."this");
		if(empty($_POST['name']))
			$message = "You must enter the building name";
		if($message == ""){
			$building->buildingName = $_POST['name'];
			$buildingId = $building->set_building();
			$room = new room();
			
			$i=0;
			for($i;$i<$count;$i++){
				if(!empty($_POST['field'][$i])){
					$room->buildingId = $buildingId;
					$room->roomName = $_POST['field'][$i];
					$room->set_room();
				}
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
        <td class="headings">Create Building
        	
        </td>
        <td style="text-align:right">
        	<b>Quick links &raquo;</b><br /><br />
        	 <a href="managebuildings.php?id=<?php echo $_GET['id']; ?>">Manage buildings</a> &nbsp;|&nbsp;
       		 <a href="manageclients.php">Manage clients</a>
        </td>
      </tr>
      <tr>
        <td><br /><br />
        <?php
		if($message != "") echo "<span class=\"redtext\">".$message."<br><br></span>";
		?>
        	<form method="post" name="client" id="client" onSubmit=" return isNotNullOrEmptyString('name', 'Please enter the building name.');">
            Building Name: * <input type="text" name="name" value="" />
            <br  /><br />
            <div id="container">
            Room Number:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="field[]"  />
            </div>
            <a href="#" id="add_field">&raquo;Add new room</a>
            <br /><br />
            <input type="submit" value="Save" name="submit" />
            </form>
		</td>
      </tr>
     </table>
    </td>
    </tr>
    </table>
    </body>
    </html>
   