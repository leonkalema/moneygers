<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if($_GET['type'] == "msword" || $_GET['type'] == "msexcel"){
$downloadtime = date("d-m-y-Hi")."Hrs";

// required for IE, otherwise Content-disposition is ignored
if(ini_get('zlib.output_compression'))
	ini_set('zlib.output_compression', 'Off');

if($_GET['type'] == "msword"){
	$filename = "SmartGuardDownload-".$downloadtime.".doc";
	# This line will stream the file to the user rather than spray it across the screen
	header("Content-type: application/vnd.ms-word");

} else if($_GET['type'] == "msexcel"){
	$filename = "SmartGuardDownload-".$downloadtime.".xls";
	header("Content-type: application/vnd.ms-excel");

}

# replace excelfile.xls with whatever you want the filename to default to
header("Content-Disposition: attachment;filename=".$filename);
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
$formvalues = $_SESSION['formvalues'];

if($_SESSION['reporttype'] == "NSSF Schedule"){ 

// The query for guard information
$query = "SELECT g.id, g.guardid, g.nssfno, g.rate,g.lastpaymentdate,g.financialstatus, p.firstname,p.lastname,p.othernames FROM guards g, persons p WHERE g.personid = p.id";
//The global settings for this package
$settings = getRowAsArray("SELECT employeenssfrate, employernssfrate, companyname, employerno FROM settings");
?><table width="100%"  border="1" cellpadding="3" cellspacing="0" bordercolor="#000066" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">
            <tr>
              <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                  <td>
                    <span style="font-size:24px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold"><?php echo $settings['companyname'];?></span></td>
                  </tr>
                <tr>
                  <td><span style="font-size:20px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold">NATIONAL SOCIAL SECURITY FUND</span></td>
                  </tr>
                <tr>
                  <td><span style="font-size:20px; font-family:Verdana, Arial, Helvetica, sans-serif;">MONTHLY SCHEDULE OF STANDARD CONTRIBUTIONS</span> </td>
                </tr>
                <tr>
                  <td><b>Month:</b> <span style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif">
                    <?php 
if(isset($formvalues['date']) && $formvalues['date'] != "0000-00-00"){
	$date = date("F Y",strtotime($formvalues['date']));
} else {
	// Return the current month
	$date = date("F Y");
}

if(isset($_GET['a'])){ ?>
                    <select id="month" name="month">
                      <?php 
  if(isset($formvalues['date']) && $formvalues['date'] != "0000-00-00 00:00:00"){ 
		$date =  date("F", strtotime($formvalues['date']));
	} else { 
		if(isset($_GET['a']) && $_GET['a'] == "return"){
			$date = "";
		} else {
			$date =  date("F", strtotime("now"));
		}
	}
						
  echo generateSelectOptions(getTime('month',''), $date);?>
                    </select>
&nbsp;&nbsp;
<select id="year" name="year">
  <?php 
   if(isset($formvalues['date']) && $formvalues['date'] != "0000-00-00 00:00:00"){ 
		$date =  date("Y", strtotime($formvalues['date']));
	} else { 
		if(isset($_GET['a']) && $_GET['a'] == "return"){
			$date = "";
		} else {
			$date =  date("Y", strtotime("now"));
		}
	}
  echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select>
<?php } else {
	echo $date;
}
?>
                  </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Employer No:</b> <?php echo $settings['employerno'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Sheet No:</b> __________</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            
            <?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no guards to display</td></tr>";
		   	} else { 
			?>
            <tr>
              <td><table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
                  <tr  style="font-family: tahoma;
	font-size: 11px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
                    <td width="12%">Guard Name</td>
                    <td width="13%">NSSF No </td>
                    <td width="16%">Gross Salary </td>
					<td width="12%" nowrap>Employee NSSF (Shs)<br>(<?php echo $settings['employeenssfrate']; ?>%) </td>
					<td width="12%" nowrap>Employer NSSF (Shs)<br>(<?php echo $settings['employernssfrate']; ?>%) </td>
                  </tr>
                  <?php
			  $i = 0;
			  $totalamount = 0;
			  $guardresult = mysql_query($query);
			   while($guard=mysql_fetch_array($guardresult, MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "background-color:#FFFFFF";
				  } else {
				     $rowclass = "background-color:#CCCCCC; padding-bottom:2px";
				  }
			   ?>
                  <tr style="<?php echo $rowclass; ?>">
				  <td><?php echo $guard['firstname']." ".$guard['lastname']." ".$guard['othernames'];?></td>
                    <td><?php 
						echo $guard['nssfno'];
					 ?></td>
                    <td><?php 
					// Based on settings, determine the start and end dates
					if(isset($formvalues['startdate'])){
						if($formvalues['startdate'] != "0000-00-00 00:00:00") { 
							$startdate = $formvalues['startdate'];
						} else {
							$startdate = "";
						}
						
						if($formvalues['enddate'] != "0000-00-00 00:00:00") { 
							$enddate = $formvalues['enddate'];
						} else {
							$enddate = "";
						}
					} else {
						$startdate = "";
						$enddate = "";
					}
					 //echo "Start Date: ".$startdate." End Date: ".$enddate;
					$amount = getGuardCharge($guard['guardid'],$startdate,$enddate) + getGuardFinance($guard['financialstatus'],$startdate,$enddate,"Bonus") - getGuardFinance($guard['financialstatus'],$startdate,$enddate,"Deduction");
					echo "Shs ".number_format($amount); ?></td>
					<td><?php 
					$employeesub_total = round($amount*($settings['employeenssfrate']/100));
					echo number_format($employeesub_total);
					$employeetotalamount += $employeesub_total;
					 ?></td>
					 <td><?php 
					$employersub_total = round($amount*($settings['employernssfrate']/100));
					echo number_format($employersub_total);
					$employertotalamount += $employersub_total;
					 ?></td>
                  </tr>
                  <?php 
			  		$i++;
			  } ?>
			  <tr><td><b><?php echo "Total";?></b></td><td></td><td></td><td><b><?php echo number_format($employeetotalamount);?></b></td><td><b><?php echo number_format($employertotalamount);?></b></td></tr>
              </table></td>
            </tr>
            <?php } ?>
          </table><?php 

//*******************************************************************************************
// PAYE Schedule Report
//*******************************************************************************************
} else if($_SESSION['reporttype'] == "PAYE Schedule"){

// The query for guard information
$query = "SELECT g.id, g.guardid, g.tinno, g.rate,g.lastpaymentdate,g.financialstatus, p.firstname,p.lastname,p.othernames FROM guards g, persons p WHERE g.personid = p.id";

//The global settings for this package
$settings = getRowAsArray("SELECT * FROM settings");
 ?>
<table width="100%"   border="1" cellpadding="3" cellspacing="0" bordercolor="#000066" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">
            <tr>
              <td align="center"><span style="font-size:24px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold"><?php echo $settings['companyname'];?></span><br>
                <span style="font-size:20px; font-family:Verdana, Arial, Helvetica, sans-serif">TIN No: <?php echo $settings['companytinno'];?></span><br>
                <span style="font-size:20px; font-family:Verdana, Arial, Helvetica, sans-serif">PAYE Returns </span><br>
<span style="font-size:20px; font-family:Verdana, Arial, Helvetica, sans-serif"><?php 
if(isset($formvalues['date']) && $formvalues['date'] != "0000-00-00"){
	$date = date("F Y",strtotime($formvalues['date']));
} else {
	// Return the current month
	$date = date("F Y");
}
echo $date;

?></span></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            
            <?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no guards to display</td></tr>";
		   	} else { 
			?>
            <tr>
              <td><table width="100%" style="border: 1px; 
	border-style: solid;
	border-color: #adaefe" cellpadding="2" cellspacing="0">
                  <tr  style="font-family: tahoma;
	font-size: 11px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
                    <td width="12%">Guard Name</td>
                    <td width="13%">TIN No </td>
                    <td width="16%">Gross Salary (Shs) </td>
					<td width="12%">PAYE (Shs) </td>
                  </tr>
                  <?php
			  //Multidimensional array to save details to be used in the next table
			  $guardpayedetails = array();
			  $i = 0;
			  $totalamount = 0;
			  $guardresult = mysql_query($query);
			   while($guard=mysql_fetch_array($guardresult, MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "background-color:#FFFFFF";
				  } else {
				     $rowclass = "background-color:#CCCCCC; padding-bottom:2px";
				  }
			   ?>
                  <tr style="<?php echo $rowclass; ?>">
				  <td><?php echo $guard['firstname']." ".$guard['lastname']." ".$guard['othernames'];?></td>
                    <td><?php echo $guard['tinno']; ?></td>
                    <td><?php 
					// Based on settings, determine the start and end dates
					if(isset($formvalues['startdate'])){
						if($formvalues['startdate'] != "0000-00-00 00:00:00") { 
							$startdate = $formvalues['startdate'];
						} else {
							$startdate = "";
						}
						
						if($formvalues['enddate'] != "0000-00-00 00:00:00") { 
							$enddate = $formvalues['enddate'];
						} else {
							$enddate = "";
						}
					} else {
						$startdate = "";
						$enddate = "";
					}
					$amount = getGuardCharge($guard['guardid'],$startdate,$enddate) + getGuardFinance($guard['financialstatus'],$startdate,"","Bonus") - getGuardFinance($guard['financialstatus'],$startdate,$enddate,"Deduction");
					echo number_format($amount); ?></td>
					<td><?php 
					$sub_total = generatePAYEAmount($amount,"local");
					echo number_format($sub_total);
					$totalamount += $sub_total;
					 //Save the guard payment details for use in the next table
					array_push($guardpayedetails, array($guard['guardid'],$amount,$sub_total));
					 ?></td>
                  </tr>
                  <?php 
			  		$i++;
			  } ?>
			  <tr><td><b><?php echo "Total";?></b></td><td></td><td></td><td><b><?php echo number_format($totalamount);?></b></td></tr>
			<tr><td>&nbsp;</td><td></td><td></td><td>&nbsp;</td></tr>
						<tr style="font-family: tahoma;
	font-size: 11px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
						  <td>Category of Employees </td>
						  <td>Number of Employees </td>
						  <td>Amount Paid (Shs) </td>
						  <td>Tax Payable (Shs) </td>
					    </tr>
						<?php 
						$query = "SELECT * FROM payeranges WHERE type='local'";
						$k = 0;
						$result = mysql_query($query);
						while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
							$details_array = getPAYEData($guardpayedetails,$row['lowerlevel'],$row['upperlevel']);
							if(($k%2)==0) {
				     			$rowclass = "background-color:#FFFFFF";
				  			} else {
				     			$rowclass = "background-color:#CCCCCC; padding-bottom:2px";
				  			}
						?>
						<tr style="<?php echo $rowclass; ?>">
						  <td><?php 
						  if($row['lowerlevel'] == "0"){
						  	echo "Below ".number_format($row['upperlevel']);
						  } else if($row['lowerlevel'] != "0" && $row['upperlevel'] != ""){
						  	echo number_format($row['lowerlevel'])." Shs to ".number_format($row['upperlevel'])." Shs";
						  } else if($row['lowerlevel'] != "0" && trim($row['upperlevel']) == ""){
						  	echo "Above ".number_format($row['lowerlevel']);
						  }
						  
						  ?></td>
						  <td><?php echo number_format($details_array[0]);
						  ?></td>
						  <td><?php echo number_format($details_array[1]);?></td>
						  <td><?php echo number_format($details_array[2]);?></td>
					    </tr>
				<?php 
					$k++;
				} ?>
				<tr>
						  <td><b>Total</b></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td><b><?php echo number_format($totalamount);?></b></td>
					    </tr>
            <?php } ?>
          </table>
<?php }

} ?>