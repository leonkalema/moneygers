<?php
include_once "../include/commonfunctions.php"; 
session_start();
openDatabaseConnection();

if(isset($_POST['searchaverage'])){
	$formvalues = array_merge($_POST);
	$formvalues['startdate'] = trim(changeDateFromPageCombosToMySQLFormat($formvalues['start_day'], $formvalues['start_month'], $formvalues['start_year']),"'");
	$formvalues['enddate'] = trim(changeDateFromPageCombosToMySQLFormat($formvalues['end_day'], $formvalues['end_month'], $formvalues['end_year']),"'");
	
	$searchresult = mysql_query("SELECT * FROM fueldistribution WHERE date >=".changeDateFromPageCombosToMySQLFormat($formvalues['start_day'], $formvalues['start_month'], $formvalues['start_year'])." AND date <=".changeDateFromPageCombosToMySQLFormat($formvalues['end_day'], $formvalues['end_month'], $formvalues['end_year']));
	
	//Array to organize the vehicle stats into managable form
	$vehiclestats = array();
	while($line=mysql_fetch_array($searchresult, MYSQL_ASSOC)){
		//litres used
		if(trim($line['litresreceived']) != "") {
			$vehiclestats[$line['vehicleregno']][0] += $line['litresreceived'];
			//Days counted
			$vehiclestats[$line['vehicleregno']][1]++;
			$vehiclestats[$line['vehicleregno']][2] .= ",".$line['petrostation'];
			$vehiclestats[$line['vehicleregno']][3] += $line['costperlitre'];
		}
	}
	
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Average Fuel Consumption</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings">Average Fuel Consumption</td>
      </tr>
      <tr>
        <td>
		<form action="fuelreport.php" method="post">
		<table width="100%" border="0">
          <tr>
            <td colspan="3"><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td width="99"><b>Select Period:</b> </td>
                  <td width="76">Start Date: </td>
                  <td nowrap>
				  Day:
                    
                    <select id="start_day" name="start_day">
                      <?php 
					if(isset($formvalues['startdate']) && $formvalues['startdate'] != ""){ 
							$date =  date("d", strtotime($formvalues['startdate']));
						} else { 
							$date =  "";
						}
					echo generateSelectOptions(getTime('day',''),  $date);?>
                    </select>
                    &nbsp;Month:

<select id="start_month" name="start_month">
  <?php 
  if(isset($formvalues['startdate']) && $formvalues['startdate'] != ""){ 
							$date =  date("F", strtotime($formvalues['startdate']));
						} else { 
							$date =  "";
						}
  echo generateSelectOptions(getTime('month',''), $date);?>
</select>
&nbsp;Year:

<select id="start_year" name="start_year">
  <?php 
  if(isset($formvalues['startdate']) && $formvalues['startdate'] != ""){ 
	$date =  date("Y", strtotime($formvalues['startdate']));
} else { 
	$date =  "";
}
						
  echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>End Date: </td>
                  <td nowrap>Day:
                    <select id="end_day" name="end_day">
                      <?php 
					if(isset($formvalues['enddate']) && $formvalues['enddate'] != ""){ 
							$date =  date("d", strtotime($formvalues['enddate']));
						} else { 
							$date =  "";
						}
					echo generateSelectOptions(getTime('day',''),  $date);?>
                    </select>
&nbsp;Month:
<select id="end_month" name="end_month">
  <?php 
  if(isset($formvalues['enddate']) && $formvalues['enddate'] != ""){ 
							$date =  date("F", strtotime($formvalues['enddate']));
						} else { 
							$date =  "";
						}
  echo generateSelectOptions(getTime('month',''), $date);?>
</select>
&nbsp;Year:
<select id="end_year" name="end_year">
  <?php 
  if(isset($formvalues['enddate']) && $formvalues['enddate'] != ""){ 
							$date =  date("Y", strtotime($formvalues['enddate']));
						} else { 
							$date =  "";
						}
						
  echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                  </tr>
                <tr>
                  <td align="right"><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"></td>
                  <td colspan="2"><input name="searchaverage" type="submit" id="searchaverage" value="Search"></td>
                  </tr>
              </table></td>
            </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3"><?php if(isset($_POST['searchaverage'])){?><div style="padding:4px;width:740px;height:270px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
			<?php
			if(count($vehiclestats) == 0){ ?>
				<tr><td>There are no recorded stats in the selected period.</td></tr>
			<?php } else {?>
              <tr class="tabheadings">
			  	<td>Vehicle</td>
                <td>Litres Used</td>
				<td>Average Price</td>
                <td>Fuel Collection Points </td>
              </tr>
			  <?php
			  $i = 0;
			   foreach($vehiclestats as $key => $value) { 
			     if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
			  <td><?php echo $key;?></td>
				
                <td><?php echo round($value[0]/$value[1],2);
				?></td>
				<td><?php echo "Shs. ".commify(round($value[3]/$value[1]));
				?></td>
				<td><?php 
				echo "<div style='width:250px'>".implode(", ",split(",",trim($value[2],",")))."</div>"; ?></td>
				
              </tr>
			  <?php 
			  $i++;
			  } ?>
            </table></div><?php } ?></td>
            </tr>
          <tr>
            <td width="14%" align="right" class="label">&nbsp;</td>
            <td width="86%" colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
		  <?php } ?>
        </table>
        </form></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" class="copyright"><?php include('../include/footer.php');?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>