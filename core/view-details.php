<?php
  include_once "../include/commonfunctions.php";
  include_once "../include/lib.php";
  $url = $_SERVER['HTTP_REFERER'];
  $conn = new connection();
  $inspection = new inspection();
  $inspection->link = $conn->link;
  
  $inspection->inspectionId = decrypt($_GET['id'],"code");
  
?>

<html>
  <head>
    <title>Inspection details
	</title>
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
        <td class="headings">Inspection details</td>
        <td style="text-align:right; width:200px;">
        	<b>Quick links &raquo;</b><br /><br />
        	 <a href="manageinspection.php">Manage Inspection Records</a><br><a href="supervision-report.php">Manage monthly reports</a>
        </td>
      </tr>
      <tr>
        <td>
		<br><br>    
        <div class="clear"></div>
        
        <?php 
		echo "&nbsp;&nbsp;<a href=\"edit-inspection.php?id=".$_GET['id']."\"><button>Edit Details</button></a>";
		
		$result_row = $inspection->get_inspection_id_3()
	?>
   		
    
    
    
    <br><br>
    
    <b>Client:</b> &nbsp;<?php echo $result_row['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Building:</b> &nbsp;<?php echo $result_row['buildingName']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Room:</b> &nbsp;<?php echo $result_row['roomName']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Inspector:</b> &nbsp;<?php echo $result_row['inspectorName']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
    <?php
    $str = date("d-M-Y",$result_row['date']);
	echo "<b>Inspection date:</b> &nbsp; $str";
	?>
    <br><br>
    <table id="details">
	  <th>Item</th>
	  <th>Status</th>
	  <th>Missed</th>
	  <th>Method</th>
	  <th>Standard</th>
	  <th>Surface</th>
	  <?php
		$passed = 0;
		$inspected = 0;
		$missed = 0;
		$method = 0;
		$standard = 0;
		$surface = 0;
		$result = $inspection->get_inspection_id();
		
		while($row = mysql_fetch_array($result))
		{
		  if($row['missed'] == 1)
			$missed++;
		  if($row['method'] == 1)
		    $method++;
		  if($row['standard'] == 1)
		    $standard++;
		  if($row['surface'] == 1)
		    $surface++;
	      echo "<tr>";
		    echo "<td>".$row['itemName']."</td>";
			if($row['passed'] == 1){
			  $passed++;
		      echo "<td><img src=\"../images/3.png\" width=\"16\" height=\"16\" ></td>";
			}
			else{
			  
			  echo "<td><a title=\"see failed\" href=\"failed.php?id=".encrypt($row['inspectionId2'],"code")."&item=".$row['itemName']."\"><img src=\"../images/close_16.png\" width=\"16\" height=\"16\" ></a></td>";
			  /* echo "<div style=\"visibility:hidden;\">";
              echo "<div id=\"demo2_tip".$row['inspectionId2']."\">";
              //echo "<img src=\"src/tooltips.gif\" style=\"float:right;margin-left:12px;\" alt=\"\" />";
              
			  while($row2 = mysql_fetch_array($failed)){
				echo "<b>".$row2['itemName']."</b><br />";
				//echo "The tooltip content comes from an element on the page. So this approach is <strong>Search Engine Friendly</strong>.";
				if($row2['dust'] == 1)
					echo "<br>dust";
				if($row2['marks'] == 1)
					echo "<br>marks";
				if($row2['floors'] == 1)
					echo "<br>floors";
				}
              echo "</div>";
			  echo "</div>"; */
			}
		    echo "<td>";
				if($row['missed'] == 1)
					echo "<b><img src=\"../images/3.png\" width=\"16\" height=\"16\" ></b>";
				else
					echo "<b><img src=\"../images/close_16.png\" width=\"16\" height=\"16\" ></b>";
			echo "</td>";
			echo "<td>";
				if($row['method'] == 1)
					echo "<b><img src=\"../images/3.png\" width=\"16\" height=\"16\" ></b>";
				else
					echo "<b><img src=\"../images/close_16.png\" width=\"16\" height=\"16\" ></b>";
			echo "</td>";
			echo "<td>";
				if($row['standard'] == 1)
					echo "<b><img src=\"../images/3.png\" width=\"16\" height=\"16\" ></b>";
				else
					echo "<b><img src=\"../images/close_16.png\" width=\"16\" height=\"16\" ></b>";
			echo "</td>";
			echo "<td>";
				if($row['surface'] == 1)
					echo "<b><img src=\"../images/3.png\" width=\"16\" height=\"16\" ></b>";
				else
					echo "<b><img src=\"../images/close_16.png\" width=\"16\" height=\"16\" ></b>";
			echo "</td>";
				/*echo "&nbsp;&nbsp;Method:&nbsp;<b>".$row['method']."</b>";
				echo "&nbsp;&nbsp;Standard:&nbsp;<b>".$row['standard']."</b>";
				echo "&nbsp;&nbsp;Surface:&nbsp;<b>".$row['surface']."</b>";
			echo "</td>"; */
		  echo "</tr>";
		  $inspected++;
		}
	  ?>
	</table>
    </td>
    </tr>
    </table>
    <div class="fl_left">
    <table>
   
    <tr><td>
    Total passed:&nbsp; <b><?php echo $passed; ?></b>
	&nbsp;&nbsp;Total inspected:&nbsp; <b><?php echo $inspected; ?></b><br /> <br />
    </td></tr>
    <tr><td>
	<b>Fault Analysis</b>
	<div id="line"></div><br>
	Missed:&nbsp;<b><?php echo $missed; ?></b>
	&nbsp;Method:&nbsp;<b><?php echo $method; ?></b>
	&nbsp;Standard:&nbsp;<b><?php echo $standard; ?></b>
	&nbsp;Surface:&nbsp;<b><?php echo $surface; ?></b>
	<br><br>
    <b>Comments:</b>
    
    <br>
    <div id="line"></div><br>
    <?php
		echo $result_row['comments'];
	?>
    </td></tr>
    </table>
    <br>
    
    </div>
    <div class="clear"></div>
    
	</div>
    <div class="fl_right" style="text-align:left">
	
    </div>
  </body>
</html>