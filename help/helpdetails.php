<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
$data = getRowAsArray("SELECT * FROM helpsection WHERE id='".$_GET['sid']."'");
?>
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
<tr><td align='left' valign='top' colspan='2'><b style="color:#FFF; font-weight:bolder; font-size:14px;"><?php echo $data['details'];?></b></td></tr>
<?php 
	if($data['substeps'] != ""){
		$array = split(",",$data['substeps']);
		for($i=0;$i<count($array);$i++){ 
			$stepdata = getRowAsArray("SELECT * FROM helpsubsection WHERE id='".$array[$i]."'");
		
			if($stepdata['imageURL'] != ""){
				echo "<tr><td align='left' valign='top' colspan='2'><img src='".$stepdata['imageURL']."' style =\"border:solid 4px #fff;\"></td></tr>";
			} else {
				echo "<tr><td align='left' valign='top'>".$stepdata['step']."</td><td>".nl2br(stripslashes($stepdata['details']))."</td></tr>";
			}
		}
	} else {
		echo "<tr><td align='left' valign='top'>There is no help on this topic. </td></tr>";
	}
	?>
</table>