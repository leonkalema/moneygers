<?php
  $url = $_SERVER['HTTP_REFERER'];
  include_once "../include/commonfunctions.php";
  include_once "../include/lib.php";
  $conn = new connection();
  $inspection = new inspection();
  $inspection->link = $conn->link;
  $inspection->inspectionId2 = decrypt($_GET['id'],"code");
  $failed = $inspection->get_failed();
  
?>

<html>
  <head>
    <title>Failed details
	</title>
	<link rel="stylesheet" href="../Styles/site_css.css" />
    <link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
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
        <td class="headings">Failed for <?php echo $_GET['item']; ?></td>
      </tr>
      <tr>
        <td>
        <table width="99%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
                  <?php
			  $j = 0;
			  if(mysql_num_rows($failed) < 1)
			  	echo "<tr><td colspan=\"8\"><br>No results to show</td></tr>";
				
				else
			   while($row=mysql_fetch_array($failed)) { 
			      if(($j%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
                  <tr class="<?php echo $rowclass; ?>">
                 <?php    
					if($row['dust'] == 1)
					echo "<tr class=\"".$rowclass."\"><td><br>dust</td></tr>";
				if($ro['marks'] == 1)
					echo "<tr class=\"".$rowclass."\"><td><br>marks</td></tr>";
				if($row2['floors'] == 1)
					echo "<tr class=\"".$rowclass."\"><td><br>floors</td></tr>";
                 //echo "<tr class=\"".$rowclass."\"><td><br>floors</td></tr>";
			  $j++;
			  }
			  //echo $j;
			  ?>
		</table>
        
		<br><br>
        <center>
		<a href="<?php echo $url; ?>" ><button>back</button></a>
        
		</center>
        </td>
        </tr>
	</table>
  </body>
</html>  