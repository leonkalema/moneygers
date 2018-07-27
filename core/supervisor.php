<?php
	//die("Here");
	include_once "../include/commonfunctions.php";
  	include_once "../include/lib.php";
	$conn = new connection();
	$supervision = new supervision();
	$supervision->link = $conn->link;
	$message = "";
	$date = time();
	if(isset($_POST['submit'])){
		//die("here");
		if(!isset($_POST['supervisor']) || empty($_POST['supervisor']) || $_POST['supervisor'] == "Select supervisor")
			$message = "You must select a supervisor";
		elseif($_POST['month'] == "0" || $_POST['year'] == "0")
			$message = "Please select a both month and year";
		elseif($_POST['building'] == "Select building")
			$message = "Please select a building";
		//die($message);	
		if($message == "")
		{
			//die("here1 ".$_POST['supervisor']);
			$today = mktime(0,0,0,$_POST['month'] + 1,0,$_POST['year']);
			$supervision = new supervision();
			$supervision->link = $conn->link;
			$supervision->supervisorId = $_POST['supervisor'];
			$supervision->today = $today;
			$supervision->buildingId = $_POST['building'];
			$supervision->general = trim($_POST['general']);
			$supervision->staff = trim($_POST['staff']);
			$supervision->attendance = trim($_POST['attendance']);
			$supervision->duties = trim($_POST['duties']);
			$supervision->requests = trim($_POST['requests']);
			$supervision->materials = trim($_POST['materials']);
			$supervision->challenges = trim($_POST['challenges']);
			$supervision->conclusion = trim($_POST['conclusion']);
			$supervisionId = $supervision->set_supervision();
			header("Location: view-supervision.php?id=".encrypt($supervisionId,"code"));
		}
	}
?>

<html>
	<head>
		<title>Create new supervision</title>
		<link rel="stylesheet" href="../Styles/site_css.css" />
	<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>
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
        <td class="headings">Create New Supervision Report</td>
      </tr>
      <tr>
      	 <td style="text-align:right; width:200px;">
        	<b>Quick links &raquo;</b><br /><br />
        	 <a href="manageinspection.php">Manage Inspection Records</a><br><a href="supervision-report.php">Manage monthly reports</a>
        </tr>
      </td>
      <tr>
        <td><br><br>
			<form method="post">
				<?php if($message != "") echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id=\"message\">".$message."</span><br><br>"; ?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Month:</b>&nbsp;&nbsp;
				<select name="month">
					<option value="0">Select month</option>
					<option value="1">Jan</option>
					<option value="2">Feb</option>
					<option value="3">Mar</option>
					<option value="4">Apr</option>
					<option value="5">May</option>
					<option value="6">Jun</option>
					<option value="7">Jul</option>
					<option value="8">Aug</option>
					<option value="9">Sep</option>
					<option value="10">Oct</option>
					<option value="11">Nov</option>
					<option value="12">Dec</option>
				</select>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Year:</b>&nbsp;&nbsp;
				<select name="year">
					<option value="0">Select year</option>
					<option value="2005">2005</option>
					<option value="2006">2006</option>
					<option value="2007">2007</option>
					<option value="2008">2008</option>
					<option value="2009">2009</option>
					<option value="2010">2010</option>
					<option value="2011">2011</option>
					<option value="2012">2012</option>
					<option value="2013">2013</option>
				</select>
				&nbsp;&nbsp;&nbsp;&nbsp;<b>Supervisor:</b>&nbsp;
			<select name="supervisor">
				<option>Select supervisor</option>
				<?php
				$inspectors = new utilities();
				$inspectors->link = $conn->link;
				$inspectors->table = "inspectors";
				$inspectors->filter = "inspectorName";
				$inspectors->write_option_list(); 
				unset($inspectors);
				?>
			</select><br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Client:</b>&nbsp;&nbsp;
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
			</select>
			&nbsp;&nbsp;<b>Building:</b>&nbsp;&nbsp;
			<select name = "building" id="txtHint">
            <br><br>
				<table id = "sup">
					<tr>
						<td>
							<b>General overview:</b><br>
							<textarea id="sup" name = "general"cols="40" rows="7"><?php if(isset($_POST['submit'])) echo $_POST['general']; ?></textarea><br><br>
							<b>Staff:</b><br>
							<textarea id="sup" name = "staff"cols="40" rows="7"><?php if(isset($_POST['submit'])) echo $_POST['staff']; ?></textarea><br><br>
							<b>Attendance:</b><br>
							<textarea id="sup" name = "attendance"cols="40" rows="7"><?php if(isset($_POST['submit'])) echo $_POST['attendance']; ?></textarea><br><br>
							<b>Duties:</b><br>
							<textarea id="sup" name = "duties"cols="40" rows="7"><?php if(isset($_POST['submit'])) echo $_POST['duties']; ?></textarea><br><br>
						</td>
						<td>
							
							<b>Requests / complaints:</b><br>
							<textarea id="sup" name = "requests"cols="40" rows="7"><?php if(isset($_POST['submit'])) echo $_POST['requests']; ?></textarea><br><br>
							<b>Materials:</b><br>
							<textarea id="sup" name = "materials"cols="40" rows="7"><?php if(isset($_POST['submit'])) echo $_POST['materials']; ?></textarea><br><br>
							<b>Challenges:</b><br>
							<textarea id="sup" name = "challenges"cols="40" rows="7"><?php if(isset($_POST['submit'])) echo $_POST['challenges']; ?></textarea><br><br>
							<b>Conclusion:</b><br>
							<textarea id="sup" name = "conclusion"cols="40" rows="7"><?php if(isset($_POST['submit'])) echo $_POST['conclusion']; ?></textarea><br><br>
						</td>
					</tr>
				</table>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="save" />
			</form>
		
		</td>
      </tr>
    </table>
	</body>
</html>