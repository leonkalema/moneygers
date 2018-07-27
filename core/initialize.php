<?php
	include_once "../include/commonfunctions.php";
	include_once "../include/lib.php";
	$conn = new connection();
	$inspection = new inspection();
	$inspection->link = $conn->link;
	$message="";
	
	if(isset($_POST['submit2'])){
		if($_POST['building'] == "Select building" || $_POST['inspector'] == "Select inspector" || !isset($_POST['item2']) )
			$message = "You must fill in all the fields";
		//die($message." ...");
		if($message == ""){
			$inspection = new inspection();
			$inspection->link = $conn->link;
			$inspection->buildingId = $_POST['building'];
			$inspection->roomId = $_POST['item2'];
			$inspection->inspectorID = $_POST['inspector'];
			$inspection->today = time();
			
			//$inspection->comments = trim($_POST['comments']);
			$inspectionId = $inspection->add_inspection();
			
			$item = new item();
			$item->link = $conn->link;
			$item->inspectionId = $inspectionId;
			$i_id = $item->inspectionId;
			header("Location: finalize.php?id=".encrypt($i_id,"code"));
		}
	}
	
	
		
		//die("here"); 
?>

<html>
	<head>
		<title>New Inspection</title>
		<script src="../javascript/jquery-1.8.3.js"></script>
		<link rel="stylesheet" href="../Styles/site_css.css" />
		<script language="javascript" type="text/javascript">
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
		
		function showItem(str)
		{
			//alert(str);
			var xmlhttp;    
			if (str=="")
			  {
			  document.getElementById("txtHint").innerHTML="";
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
			    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
			    }
			  }
			xmlhttp.open("GET","data2.php?q="+str,true);
			xmlhttp.send();
		}
		
		var count = 1;
		$(function(){
			$('a#add_field').click(function(){
				count += 1;
				$('#container').append(
						'<br /><br />&nbsp;<input type = "text" name = "field[]" />' 
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="pass[]" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="dust[]" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="marks[]" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="floors[]" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="missed[]" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="method[]" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="standard[]" />'
						+ '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="surface[]" />'
						
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
        <td class="headings">Add room and supervisor.
        </td>
        <td style="text-align:right; width:200px;">
        	<b>Quick links &raquo;</b><br /><br />
        	 <a href="manageinspection.php">Manage Inspection Records</a><br><a href="supervision-report.php">Manage monthly reports</a>
        </td>
      </tr>
      <tr>
        <td>
		<br>
		<p>
		<form method = "post" id="">
			<?php if($message != "") echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id=\"message\">".$message."</span><br><br>"; ?>
			<div id = "general">
            &nbsp;&nbsp;Client:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name = "client" onChange="showItem(this.value)">
				<option>Select client</option>
				<?php
				$buildings = new utilities();
				$buildings->link = $conn->link;
				$buildings->table = "clients";
				$buildings->filter = "name";
				$buildings->write_option_list(); 
				unset($OptionList);
				?>
			</select><br><br>
			&nbsp;&nbsp;Building:&nbsp;&nbsp;
			<select name = "building" id="txtHint" onChange="showItem2(this.value)">
				
			</select><br><br>
			&nbsp;&nbsp;Room:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="item2" id="txtHint2">
			</select><br><br>
			
			&nbsp;&nbsp;Inspector:&nbsp;
			<select name="inspector">
				<option>Select inspector</option>
				<?php
				$inspectors = new utilities();
				$inspectors->link = $conn->link;
				$inspectors->table = "inspectors";
				$inspectors->filter = "inspectorName";
				$inspectors->write_option_list(); 
				unset($inspectors);
				?>
			</select></br><br>
			</div><br>
			&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit2" value="continue" />
			<br>
            <br><br>
	</div>
		</form>
        </td>
      </tr>
    </table>
		
	
	</body>
</html>
