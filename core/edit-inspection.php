<?php
	 include_once "../include/commonfunctions.php";
  	include_once "../include/lib.php";
	$conn = new connection();
	$inspection = new inspection();
	$inspection->link = $conn->link;
	// $e_inspection = new connection();
	// $e_inspection->link = $conn->link;
	//die($_GET['id']);
	$inspection->inspectionId = decrypt($_GET['id'],"code");
	//die("ds".$inspection->inspectionId);
	$result = $inspection->get_inspection_id();
	$row_array = $inspection->get_inspection_id_3();
	$i = 0;
	$message = "";
	
	
	
	if(isset($_POST['submit'])){
		
		
		$inspection = new inspection();
		$inspection->inspectionId = decrypt($_GET['id'],"code");
		$inspection->link = $conn->link;
		$inspection->comments = trim($_POST['comments']);
		if($inspection->comments != ""){
			//$message = "Comments cannot be blank !!";
			$inspection->add_comments();
		}
		$a = 0;
		$count = $_POST['last'];
		
		for($a; $a<$count; $a++){
			$inspection->inspectionId2 = $_POST['id2'][$a];
			//die($inspection->inspectionId2." here");
			if(isset($_POST["passed_".($a+1)]) && $_POST["passed_".($a+1)] == "on"){
				$inspection->passed = 1;
				if(isset($_POST["missed_".($a+1)]) && $_POST["missed_".($a+1)] == "on"){
					$inspection->missed = 1;
				}
				else{
					$inspection->missed = 0;
				}
				
				if(isset($_POST["method_".($a+1)]) && $_POST["method_".($a+1)] == "on"){
					$inspection->method = 1;
				}
				else{
					$inspection->method = 0;
				}
				
				if(isset($_POST["standard_".($a+1)]) && $_POST["standard_".($a+1)] == "on"){
					$inspection->standard = 1;
				}
				else{
					$inspection->standard = 0;
				}
				
				if(isset($_POST["surface_".($a+1)]) && $_POST["surface_".($a+1)] == "on"){
					$inspection->surface = 1;
				}
				else{
					$inspection->surface = 0;
				}
				
				$inspection->update_inspection_2();
				//echo $inspection->missed." ".$inspection->method." ".$inspection->standard." ".$inspection->surface."<br>";
			}
			else{
				$inspection->passed = 0;
				//die("Here ".$_POST["dust_".($a+1)]);
				if(isset($_POST["missed_".($a+1)]) && $_POST["missed_".($a+1)] == "on"){
					$inspection->missed = 1;
				}
				else{
					$inspection->missed = 0;
				}
				
				if(isset($_POST["method_".($a+1)]) && $_POST["method_".($a+1)] == "on"){
					$inspection->method = 1;
				}
				else{
					$inspection->method = 0;
				}
				
				if(isset($_POST["standard_".($a+1)]) && $_POST["standard_".($a+1)] == "on"){
					$inspection->standard = 1;
				}
				else{
					$inspection->standard = 0;
				}
				
				if(isset($_POST["surface_".($a+1)]) && $_POST["surface_".($a+1)] == "on"){
					$inspection->surface = 1;
				}
				else{
					$inspection->surface = 0;
				}
				
				if(isset($_POST["dust_".($a+1)]) && $_POST["dust_".($a+1)] == "on"){
					$inspection->dust = 1;
				}
				else{
					$inspection->dust = 0;
				}
				
				if(isset($_POST["marks_".($a+1)]) && $_POST["marks_".($a+1)] == "on"){
					$inspection->marks = 1;
				}
				else{
					$inspection->marks = 0;
				}
				
				if(isset($_POST["floors_".($a+1)]) && $_POST["floors_".($a+1)] == "on"){
					$inspection->floors = 1;
				}
				else{
					$inspection->floors = 0;
				}
				//echo $inspection->dust." ".$inspection->marks." ".$inspection->floors."<br>";
				$inspection->update_inspection_2();
				
			}
		}
		
		if(isset($_POST['field']))
		{
			$item = new item();
			$item->link = $conn->link;
			$item->inspectionId = decrypt($_GET['id'],"code");
			$count2 = count($_POST['field']);
				//die($count2." elements");
			$a =0;
		for($a; $a<$count2; $a++){
			
			$item->itemName = trim($_POST['field'][$a]);
			if($item->itemName != "")
			{
			$itemId = $item->set_item();
			//die($itemId." this".$_POST["passed".($a+1)]);
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
				//echo $inspection->dust."j ".$inspection->marks."l ".$inspection->floors."<br>";
			}
			}
		}
		}
		
		header("Location: view-details.php?id=".$_GET['id']);
		//die("here");
		
	} 
?>

<html>
	<head>
		<title>Edit inspection</title>
		
		<script src="../javascript/jquery-1.8.3.js"></script>
		<link rel="stylesheet" href="../Styles/site_css.css" />
		<script language="javascript" type="text/javascript">
		var ctr = 0;
		
		$(function(){
			$('a#add_field').click(function(){
			
				//var last = document.getElementById("last").innerHTML;
				
				//alert(last+' This');
				ctr += 1;
				//alert(ctr+' This');
				$('#container').append(
						'<br /><br />&nbsp;<input type = "text" name = "field[]" />' 
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="passed'+ctr+'" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="dust'+ctr+'" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="marks'+ctr+'" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="floors'+ctr+'" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="missed'+ctr+'" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="method'+ctr+'" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="standard'+ctr+'" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="surface'+ctr+'" />'
						
				);
			
			});
		});
		
		function show(str){
			alert(str+" this");
		}
		function showItem2(str)
		{
			//alert(str);
			var xmlhttp;    
			if (str=="")
			  {
			  document.getElementById("txtHint2").innerHTML="";
			  return;
			  }
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			    {
			    document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
			    }
			  }
			xmlhttp.open("GET","data.php?q="+str,true);
			xmlhttp.send();
		}
		</script>
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
        <td class="headings">Edit inspection</td>
        <td style="text-align:right; width:200px;">
        	<b>Quick links &raquo;</b><br /><br />
        	 <a href="manageinspection.php">Manage Inspection Records</a><br><a href="supervision-report.php">Manage monthly reports</a>
        </td>
      </tr>
      <tr>
        <td><br><br>
		<p>
		<?php  
			if($message != "")
				echo "<span id=\"message\">".$message."</span><br /><br />";
		?>
		<form method = "post" id="inspect">
			<input type="hidden" name = "inspection_id" value="<?php echo $row_array['inspectionID']; ?>">
			<div id = "general">
            <b>Client:</b>&nbsp;
			<?php echo $row_array['name']; ?>
			<b>Building:</b>&nbsp;
			<?php echo $row_array['buildingName']; ?>
			&nbsp;&nbsp;<b>Room:</b>&nbsp;
			<?php echo $row_array['roomName']; ?>
			
			&nbsp;&nbsp;<b>Inspector:</b>&nbsp;
			<?php echo $row_array['inspectorName']; ?>
			</div>
			<br>
			<div>
            <table><tr>
            
				<td style="vertical-align:top">&nbsp;&nbsp;&nbsp;<b>Item</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<b>Passed</b>
				</td>
                <td style="vertical-align:top">
				
					<div class="fl_left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<b>Failed inspection</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<b>Fault analysis</b><br><br>
					&nbsp;&nbsp;&nbsp;Dust &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;marks &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;floors&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Missed &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Method &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Standard&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Surface
					</div>
				</td>
              </tr>
            </table>
			</div>
			<div class="clear"></div>
			<div id="container">
			<table id="edit">
				<?php
					$result = $inspection->get_inspection_id();
					$i=0;
					$j=1;
					while($row = mysql_fetch_array($result)){
						echo "<input type=\"hidden\" name=\"id2[]\" value=\"".$row['inspectionId2']."\" />";
						echo "<tr>";
						
						echo "<td id=\"name\"><br>&nbsp;".$row['itemName']."</td>";
						echo "<td>";
						if($row['passed'] == 1)
								echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" checked=\"yes\" name = \"passed_".$j."\" />";
							else
								echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name = \"passed_".$j."\" />";
						if($row['passed'] == 0){
							$inspection->inspectionId2 = $row['inspectionID2'];
							$result_array = $inspection->get_inspection_id_2();
							if($result_array['dust'] == 1)
									echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" checked=\"yes\" name = \"dust_".$j."\" />";
								else
									echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name = \"dust_".$j."\" />";
							if($result_array['marks'] == 1)
									echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" checked=\"yes\" name = \"marks_".$j."\" />";
								else
									echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name = \"marks_".$j."\" />";
							if($result_array['floors'] == 1)
									echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" checked=\"yes\" name = \"floors_".$j."\" />";
								else
									echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name = \"floors_".$j."\" />";
						}
						else
						{
							echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name = \"dust_".$j."\" />";
							echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name = \"marks_".$j."\" />";
							echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name = \"floors_".$j."\" />";
						}
						if($row['missed'] == 1)
								echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" checked=\"yes\" name = \"missed_".$j."\" />";
							else
								echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name = \"missed_".$j."\" />";
						if($row['method'] == 1)
								echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" checked=\"yes\" name = \"method_".$j."\" />";
							else
								echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name = \"method_".$j."\" />";
						if($row['standard'] == 1)
								echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" checked=\"yes\" name = \"standard_".$j."\" />";
							else
								echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name = \"standard_".$j."\" />";
						if($row['surface'] == 1)
								echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" checked=\"yes\" name = \"surface_".$j."\" />";
							else
								echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name = \"surface_".$j."\" />";
						echo "</td>";
						echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"delete.php?id=".encrypt($row['itemID'],"code")."&table=items&rname=itemid&page=edt&id2=".encrypt($row_array['inspectionID'],"code")."\"><img src=\"../images/_0005_Delete.png\" width=\"16\" height=\"16\" title=\"Delete\"/></a></td>";
						
						/* echo "<tr>";
							echo "<td>".$row['itemName']."</td>";
							if($row['passed'] == 1)
								echo "<td><input type=\"checkbox\" checked=\"yes\" name = \"passed".$row['itemID']."\" /></td>";
							else
								echo "<td><input type=\"checkbox\" name = \"passed".$row['itemID']."\" /></td>";
							echo "<input type=\"hidden\" name = \"itemId[]\" value=\"".$row['itemID']."\" />";
						echo "</tr>"; */
						$i++;
						$j++;
						echo "</tr>";
					}
				?>
				<!--<br>&nbsp;<input type = "text" name = "field[]" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="passed1" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="dust1" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="marks1" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="floors1" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="missed1" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="method1" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="standard1" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="surface1" />-->
				</table>
			</div><br>
			<input type="hidden" name="last" value="<?php echo $i; ?>" />
			&nbsp;&nbsp;<a href="#" id="add_field"><span>&raquo; Add new item</span></a><br><br>
			&nbsp;&nbsp;<b>Comments:</b><br>
			&nbsp;&nbsp;<textarea name = "comments"cols="40" rows="7"><?php echo $row_array['comments']; ?></textarea><br><br>
			&nbsp;&nbsp;<input type="submit" name="submit" value="Update" />
			
			
		<br>
		</form>
		<br><br>
	</div>
    </td>
    </tr>
    </table>
	</body>
</html>
