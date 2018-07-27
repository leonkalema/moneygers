<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
if(trim($_GET['value']) != ""){
	$query_sec = " WHERE details LIKE '%".$_GET['value']."%'";
}
?>
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="2">
				<?php
				   		$result = mysql_query("SELECT * FROM helpsection".$query_sec);
				   		$i = 0;
						while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
				      		if(($i%2)==0) {
				    			$rowclass = "evenrow";
				  			} else {
				     			$rowclass = "oddrow";
				  			}
							
							$row = "<tr class = \"".$rowclass."\"><td>".$line['step']."</td><td><a href=\"javascript:setDiv('helpdetails.php?sid=".$line['id']."','helpdetails','','loading...')\" class=\"normaltxtlink\">".$line['details']."</a></td></tr>";
					  
					  		echo $row;
				   			$i++;
						}
				   ?>
                </table>