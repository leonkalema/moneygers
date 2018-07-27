<?php
	include_once "../include/commonfunctions.php";
	include_once "../include/lib.php";
	$conn = new connection();
	$inspection = new inspection();
	$inspection->link = $conn->link;
	$inspection->inspectionId = decrypt($_GET['id'],"code");
	$row_array = $inspection->get_inspection_id_3();
	
	
	if(isset($_POST['submit'])){
		
		$inspection = new inspection();
		$inspection->link = $conn->link;
		$a = 0;
		$count = count($_POST['field']);
		//die($count." fields ".$_POST['inspectionId']);
		$item = new item();
		$item->link = $conn->link;
		$item->inspectionId = $_POST['inspectionId'];
		$inspection->inspectionId = $_POST['inspectionId'];
		$inspection->comments = trim($_POST['comments']);
		$inspection->add_comments();
		for($a; $a<$count; $a++){
			$item->itemName = trim($_POST['field'][$a]);
			if(isset($item->itemName) && $item->itemName != "" && $item->itemName != null && !empty($item->itemName)){
			$itemId = $item->set_item();
			//die($itemId." this");
			$inspection->itemID = $itemId;
			if(isset($_POST["passed".($a+1)]) && $_POST["passed".($a+1)] == "on"){
				$inspection->passed = 1;
				if(isset($_POST["missed".($a+1)]) && $_POST["missed".($a+1)] == "on"){
					$inspection->missed = 1;
				}
				else{
					$inspection->missed = 0;
				}
				
				if(isset($_POST["method".($a+1)]) && $_POST["method".($a+1)] == "on"){
					$inspection->method = 1;
				}
				else{
					$inspection->method = 0;
				}
				
				if(isset($_POST["standard".($a+1)]) && $_POST["standard".($a+1)] == "on"){
					$inspection->standard = 1;
				}
				else{
					$inspection->standard = 0;
				}
				
				if(isset($_POST["surface".($a+1)]) && $_POST["surface".($a+1)] == "on"){
					$inspection->surface = 1;
				}
				else{
					$inspection->surface = 0;
				}
				
				$inspection->add_inspection2();
				//echo $inspection->missed." ".$inspection->method." ".$inspection->standard." ".$inspection->surface."<br>";
			}
			else{
				$inspection->passed = 0;
				if(isset($_POST["missed".($a+1)]) && $_POST["missed".($a+1)] == "on"){
					$inspection->missed = 1;
				}
				else{
					$inspection->missed = 0;
				}
				
				if(isset($_POST["method".($a+1)]) && $_POST["method".($a+1)] == "on"){
					$inspection->method = 1;
				}
				else{
					$inspection->method = 0;
				}
				
				if(isset($_POST["standard".($a+1)]) && $_POST["standard".($a+1)] == "on"){
					$inspection->standard = 1;
				}
				else{
					$inspection->standard = 0;
				}
				
				if(isset($_POST["surface".($a+1)]) && $_POST["surface".($a+1)] == "on"){
					$inspection->surface = 1;
				}
				else{
					$inspection->surface = 0;
				}
				
				if(isset($_POST["dust".($a+1)]) && $_POST["dust".($a+1)] == "on"){
					$inspection->dust = 1;
				}
				else{
					$inspection->dust = 0;
				}
				
				if(isset($_POST["marks".($a+1)]) && $_POST["marks".($a+1)] == "on"){
					$inspection->marks = 1;
				}
				else{
					$inspection->marks = 0;
				}
				
				if(isset($_POST["floors".($a+1)]) && $_POST["floors".($a+1)] == "on"){
					$inspection->floors = 1;
				}
				else{
					$inspection->floors = 0;
				}
				
				$inspection->add_inspection2();
				//echo $inspection->missed." ".$inspection->method." ".$inspection->standard." ".$inspection->surface." ".$inspection->dust." ".$inspection->marks." ".$inspection->floors."<br>";
			}
		}
		}
		
		header("Location: view-details.php?id=".encrypt($_POST['inspectionId'],"code"));
		//die("here");
		
	} 
?>

<html>
	<head>
		<title>New Inspection</title>
		<link rel="stylesheet" href="../Styles/site_css.css" />
		<script src="../javascript/jquery-1.8.3.js"></script>
		<script language="javascript" type="text/javascript">
		
		var count = 1;
		$(function(){
			$('a#add_field').click(function(){
				count += 1;
				$('#container').append(
						'<br /><br />&nbsp;<input type = "text" name = "field[]" />' 
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="passed'+count+'" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="dust'+count+'" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="marks'+count+'" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="floors'+count+'" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="missed'+count+'" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="method'+count+'" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="standard'+count+'" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="surface'+count+'" />'
						
				);
			
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
        <td class="headings">Add Inspection Items</td>
        <td style="text-align:right; width:200px;">
        	<b>Quick links &raquo;</b><br /><br />
        	 <a href="manageinspection.php">Manage Inspection Records</a><br><a href="supervision-report.php">Manage monthly reports</a>
        </td>
      </tr>
      <tr>
        <td><br><br>
		<p>
		<form method = "post" id="">
			<!--<div id = "sub_title">General information:</div>-->
			<br>
			<input type="hidden" name="inspectionId" value="<?php echo $row_array['inspectionID']; ?>" />
			<div id = "general">
            &nbsp;&nbsp;&nbsp;<b>Client:</b>
			<?php echo $row_array['name']; ?>
			&nbsp;&nbsp;&nbsp;<b>Building:</b>
			<?php echo $row_array['buildingName']; ?>
			&nbsp;&nbsp;&nbsp;<b>Room:</b>
			<?php echo $row_array['roomName']; ?>
			&nbsp;&nbsp;<b>Inspector:</b>
			<?php echo $row_array['inspectorName']; ?>
			</div><br>
			<div>
            <table><tr>
            <td style="vertical-align:top">
				&nbsp;&nbsp;&nbsp;<b>Item</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       				<b>Passed</b>
			</td>
            <td style="vertical-align:top; padding-left:30;">
				
					<div class="fl_left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<b>Failed inspection</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<b>Fault analysis</b><br><br>
					Dust &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;marks &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;floors&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Missed &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Method &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Standard&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;           Surface
					</div>
			</td>
            </tr></table>
			</div>
			<div class="clear"></div>
			<div id="container">
				<br>&nbsp;<input type = "text" name = "field[]" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="passed1" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="dust1" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="marks1" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="floors1" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="missed1" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="method1" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="standard1" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="surface1" />
			</div>
			&nbsp;&nbsp;<a href="#" id="add_field"><span>&raquo; Add new item</span></a><br><br>
			&nbsp;&nbsp;<b>Comments:</b><br>
			&nbsp;&nbsp;<textarea name = "comments"cols="40" rows="7"><?php echo $row_array['comments']; ?></textarea><br><br>
			&nbsp;&nbsp;<input type="submit" name="submit" value="Finish" />
			<br>
		</form>
		<br><br>
        </p>
        </td>
      </tr>
    </table>
	
	</body>
</html>
