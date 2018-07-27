<?php
	include_once "../include/commonfunctions.php";
  	include_once "../include/lib.php";
	$conn = new connection();
	$supervision = new supervision();
	$supervision->link = $conn->link;
	$supervision->supervisionId = decrypt($_GET['id'],"code");
	$row_array = $supervision->get_supervision_id();
	if(isset($_GET['message']))
		$message = $_GET['message'];
	else 
		$message = null;
	
	if(isset($_POST['submit'])){
		//die("here");
		$supervision = new supervision();
		$supervision->link = $conn->link;
		$supervision->supervisionId = $_POST['supervisionId'];
		$supervision->today = time();
		$supervision->general = trim($_POST['general']);
		$supervision->staff = trim($_POST['staff']);
		$supervision->attendance = trim($_POST['attendance']);
		$supervision->duties = trim($_POST['duties']);
		$supervision->requests = trim($_POST['requests']);
		$supervision->materials = trim($_POST['materials']);
		$supervision->challenges = trim($_POST['challenges']);
		$supervision->conclusion = trim($_POST['conclusion']);
		if($supervision->update_supervision()){
			$message = "Successfully updated !!";
			header("Location: redirect_1.php?id=".encrypt($supervision->supervisionId,"code")."&msg=$message");
		}
	}
?>

<html>
	<head>
		<title>Review supervision</title>
		<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>
		<link rel="stylesheet" href="../Styles/site_css.css" />
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
        <td class="headings">Review supervision</td>
       
      </tr>
      <tr>
       <td style="text-align:right; width:200px; vertical-align:top;">
        	<b>Quick links &raquo;</b><br /><br />
        	 <a href="manageinspection.php">Manage Inspection Records</a><br><a href="supervision-report.php">Manage monthly reports</a>
        </td>
      </tr>
      <tr>
        <td>
     
        <br><br>
			<form method="post">
				<input type="hidden" name="supervisionId" value="<?php echo decrypt($_GET['id'],"code"); ?>" />
				<?php
					if($message != null)
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id=\"message\">".$message."</span><br><br>";
				?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Supervisor:</b>&nbsp;
			<?php echo $row_array['inspectorName']; ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Client:</b>&nbsp;
			<?php echo $row_array['name']; ?>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Building:</b>&nbsp;
			<?php echo $row_array['buildingName']; ?><br><br>
				<table id = "sup">
					<tr>
						<td>
							General overview:<br>
							<textarea id="sup" name = "general"cols="40" rows="7"><?php echo $row_array['general']; ?></textarea><br><br>
							Staff:<br>
							<textarea id="sup" name = "staff"cols="40" rows="7"><?php echo $row_array['staff']; ?></textarea><br><br>
							Attendance:<br>
							<textarea id="sup" name = "attendance"cols="40" rows="7"><?php echo $row_array['attendance']; ?></textarea><br><br>
							Duties:<br>
							<textarea id="sup" name = "duties"cols="40" rows="7"><?php echo $row_array['duties']; ?></textarea><br><br>
						</td>
						<td>
							
							Requests / complaints:<br>
							<textarea id="sup" name = "requests"cols="40" rows="7"><?php echo $row_array['requests']; ?></textarea><br><br>
							Materials:<br>
							<textarea id="sup" name = "materials"cols="40" rows="7"><?php echo $row_array['materials']; ?></textarea><br><br>
							Challenges:<br>
							<textarea id="sup" name = "challenges"cols="40" rows="7"><?php echo $row_array['challenges']; ?></textarea><br><br>
							Conclusion:<br>
							<textarea id="sup" name = "conclusion"cols="40" rows="7"><?php echo $row_array['conclusion']; ?></textarea><br><br>
						</td>
					</tr>
				</table>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="update" />
			</form>
		
		</td>
      </tr>
    </table>
    </td>
   </tr>
  </table>
	</body>
</html>