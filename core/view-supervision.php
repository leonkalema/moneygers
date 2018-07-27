<?php
	include_once "../include/commonfunctions.php";
  	include_once "../include/lib.php";
	$url = $_SERVER['HTTP_REFERER'];
	$conn = new connection();
	$supervision = new supervision();
	$supervision->link = $conn->link;
	$supervision->supervisionId = decrypt($_GET['id'],"code");
	$row_array = $supervision->get_supervision_id();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
        <td class="headings">Supervision Report Details</td>
        <td style="text-align:right; width:200px;">
        	<b>Quick links &raquo;</b><br /><br />
        	 <a href="manageinspection.php">Manage Inspection Records</a><br><a href="supervision-report.php">Manage monthly reports</a>
        </td>
      </tr>
      <tr>
        <td>
        <br /><br />
        <div class="clear"></div>
        <div style="width:1000">
        <div class="fl_left">
        <?php 
		echo "<a href=\"review-supervision.php?id=".$_GET['id']."\"><button>Edit Details</button></a>";
	?>
   		</div>
        
    <div class="clear"></div>
    </div>
        <br /><br />
        <b>Date:</b>&nbsp;
        <?php
		$str = date("M-Y",$row_array['date']);
		echo $str;
		?>
        &nbsp;&nbsp;<b>Supervisor:</b>&nbsp;
			<?php echo $row_array['inspectorName']; ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Client:</b>&nbsp;
			<?php echo $row_array['name']; ?>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Building:</b>&nbsp;
			<?php echo $row_array['buildingName']; ?>
        <br><br>    
        <b>General overview:</b>
        <br />
        <?php
			echo $row_array['general'];
		?>
        
        <br><br />    
        <b>Staff:</b>
        <br />
        <?php
			echo $row_array['staff'];
		?>
        <br><br />   
        <b>Attendance:</b>
        <br />
        <?php
			echo $row_array['attendance'];
		?>
        
        <br><br />   
        <b>Duties:</b>
        <br />
        <?php
			echo $row_array['duties'];
		?>
        
        <br><br />     
        <b>Requests / Complaints:</b>
        <br />
        <?php
			echo $row_array['requests'];
		?>
        
        <br><br />    
        <b>Materials:</b>
        <br />
        <?php
			echo $row_array['materials'];
		?>
        
        <br><br />     
        <b>Challenges:</b>
        <br />
        <?php
			echo $row_array['challenges'];
		?>
        <br><br />   
        <b>Conclusion:</b>
        <br />
        <?php
			echo $row_array['conclusion'];
		?>
        </td>
        </tr>
  </table>
</body>
</html>