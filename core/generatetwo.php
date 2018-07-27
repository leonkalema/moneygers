<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if($_POST['submit']){
$settings = getRowAsArray("SELECT * FROM settings");
$downloadtime = date("d-m-y-Hi")."Hrs";
$type = $_POST['type'];
$guardtotal = implode("",explode(",",str_replace(" ","",$_POST['guardamount_night']))) + implode("",explode(",",str_replace(" ","",$_POST['guardamount_day'])));

// required for IE, otherwise Content-disposition is ignored
if(ini_get('zlib.output_compression'))
	ini_set('zlib.output_compression', 'Off');
//Get the assignment details
$assignment = getRowAsArray("SELECT a.client, a.servicetype, a.assignedguards, a.rate, a.callsign, a.contactname, a.contactphone, a.contactfax, a.contactemail, a.exception, a.startdate, a.enddate, a.starttime, a.endtime, a.rate, a.directions, a.equipmenttypes, c.boxno, c.plotno, c.floorno FROM assignments a, clients c WHERE c.name = a.client AND a.id='".$_POST['edit']."'");

//Mark the Temporary Works Order basing on whether the client is new or old.
if(howManyRows("SELECT * FROM assignments WHERE client LIKE '%".$assignment['client']."%'") > 1){
	$assignment['deployment'] = "old";
} else {
	$assignment['deployment'] = "new";
}

//Form the download name
$filename = "ClientTWO_".str_replace(" ","-",$assignment['client'])."_".$downloadtime.".doc";
# This line will stream the file to the user rather than spray it across the screen
header("Content-type: application/vnd.ms-word");

# replace excelfile.xls with whatever you want the filename to default to
header("Content-Disposition: attachment;filename=".$filename);
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Client Temporary Works Order - <?php echo $assignment['client'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
@page { size 8.5in 11in; margin: 2cm }
div.page { page-break-after: always }
</style>
</head>
<body topmargin="0" bottommargin="0"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div class="page"><table>
      
        <tr>
          <td colspan="3"><table width="100%">
            <tr>
              <td><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2" valign="top">Plot 4 Katonga Road,  Nakasero</td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top">                      P O Box 21644<br />
                      KAMPALA</td>
                  </tr>
                  <tr>
                    <td valign="top">Tel:</td>
                    <td valign="top">0414 301500 / 345382 /  345391</td>
                  </tr>
                  <tr>
                    <td width="5%" rowspan="2" valign="top">&nbsp;</td>
                    <td valign="top">                      0414 322353 - Entebbe  Branch</td>
                  </tr>
                  <tr>
                    <td valign="top">0434 120555 - Jinja Branch</td>
                  </tr>
                  <tr>
                    <td valign="top">Fax: </td>
                    <td valign="top">0414 345395</td>
                  </tr>
              </table></td>
              <td colspan="2" align="right"><img src="file:///C:/wamp/www/smartguard/images/ultimatelogo.gif" /></td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td bgcolor="#CCCCCC"><table border="0" cellspacing="0" cellpadding="0">
              <tr <?php if($assignment['deployment'] == "new"){ echo "bgcolor='#999999'";}?>>
                <td nowrap><b>NEW DEPLOYMENT&nbsp;&nbsp;</b></td>
                <td><?php if($assignment['deployment'] == "new"){ echo "<img src='file:///C:/wamp/www/smartguard/images/tick.gif'>";}?></td>
              </tr>
          </table></td>
          <td colspan="2" bgcolor="#CCCCCC" align="right"><table border="0" cellspacing="0" cellpadding="0">
              <tr <?php if($assignment['deployment'] == "old"){ echo "bgcolor='#999999'";}?>>
                <td nowrap><b>VARIATION OF CONTRACT&nbsp;&nbsp;&nbsp;</b></td>
                <td><?php if($assignment['deployment'] == "old"){ echo "<img src='file:///C:/wamp/www/smartguard/images/tick.gif'>";}?></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td><b>Date:</b> <?php echo date("d-M-Y");?></td>
          <td colspan="2"><b>Call Sign:</b> <?php echo $assignment['callsign'];?></td>
        </tr>
        <tr>
          <td colspan="3"><hr></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><b style="font-size:18px">CLIENT DETAILS</b> </td>
        </tr>
        <tr>
          <td><b>Customer/Account Name:</b></td>
          <td colspan="2"><?php echo $assignment['client'];?></td>
        </tr>
        <tr>
          <td><b>Contact Person:</b></td>
          <td colspan="2"><?php echo $assignment['contactname'];?></td>
        </tr>
        <tr>
          <td><b>Tel. Numbers:</b></td>
          <td colspan="2"><?php echo $assignment['contactphone'];?></td>
        </tr>
        <tr>
          <td><b>Physical &amp; Postal Address:</b></td>
          <td colspan="2"><?php if($assignment['plotno'] != ""){
  				echo "Plot No: ".$assignment['plotno'];
				
				if($assignment['floorno'] != ""){ echo " Floor No: ".$assignment['floorno'];}
			}
  			if($assignment['boxno'] != ""){
  				echo " <br>P.O.Box: ".$assignment['boxno'];
			}
  ?></td>
        </tr>
        <tr>
          <td><b>Site Description:</b></td>
          <td colspan="2"><?php echo "<div width='150'>".$assignment['directions']."</div>";?></td>
        </tr>
        <tr>
          <td colspan="3"><hr></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><b style="font-size:18px">DETAILS OF SERVICE</b> </td>
        </tr>
        <tr>
          <td><b>Service Status:</b> </td>
          <td colspan="2"><?php echo $assignment['servicetype'];?></td>
        </tr>
        <tr>
          <td valign="top"><b>Service Details:</b></td>
          <td colspan="2"><?php echo "<div width='150'>";
  if($type == "guard" || $type == "both"){
     echo $assignment['assignedguards']." guards will be deployed.<br>";
  }
  echo " Services start on ".date("d-M-Y", strtotime($assignment['startdate']));
  
  if($assignment['enddate'] != "0000-00-00" && $assignment['enddate'] != ""){
  	echo " and end on ".date("d-M-Y", strtotime($assignment['enddate']));
  }
  echo " from ".$assignment['starttime']." to ".$assignment['endtime'].".";
  
  
  if($assignment['exception'] != "0000-00-00" || $assignment['exception'] != ""){
  	$exceptionarr = split(",", $assignment['exception']);
	echo "<br> Services will not be provided on ";
  	for($i=0;$i<count($exceptionarr);$i++){
  		if($i>0){
			echo " and ";
		}
		echo date("d-M-Y", strtotime($exceptionarr[$i]));
  	}
  }
  echo ".</div>";
  ?></td>
        </tr>
        <tr>
          <td><b>Equipment <?php if($type == "alarm" || $type == "both"){ echo "Installed";} else {?>Deployed<?php }?>:</b> </td>
          <td colspan="2"><?php
  $equipmentarr = split(",",$assignment['equipmenttypes']);
  for($i=0;$i<count($equipmentarr);$i++){
  	if($i>0){ echo ", <br>";}
	
	echo substr($equipmentarr[$i],-1,1)." ".substr($equipmentarr[$i], 0, -1)."(s)";
  }
  ?></td>
        </tr>
        <tr>
          <td valign="top"><b>Charges:</b></td>
          <td colspan="2"><?php 
$total = 0;
if($type == "alarm" || $type == "both"){?>
              <b>
                <?php if($type == "both"){ echo "a. ";}?>
                PANIC ALARM SYSTEM SERVICES</b><br />
            Monthly Backup that includes monthly Monitoring,
            Servicing, Maintenance and 24 Hours Quick <br>
            Response Force	= <b>Ug.Shs.
              <?php $monthrate = ($assignment['rate']*30);
echo commify($monthrate);
?>
              /=</b> per month, <br>
            Plus V.A.T 		=	Ug.Shs.
            <?php $tax = $monthrate*($settings['VATrate']/100); echo commify($tax);?>
            /= per month
            <?php 
	$total += $monthrate + $tax;
} 

if($type == "guard" || $type == "both"){
?>
            <b>
              <?php if($type == "both"){ echo "<br><br>b. ";}?>
              SECURITY GUARD SERVICES;</b><br>
            <br> <u><?php echo $_POST['guards_day'];?></u>
            Day Guard(s) <b>Ug.Shs.
              <?php $daycharge = implode("",explode(",",str_replace(" ","",$_POST['guardamount_day'])));
	echo commify($daycharge);
	$total += $daycharge;
?>
              /=</b>, <br>
            &nbsp; <u><?php echo $_POST['guards_night'];?></u>
             Night Guard(s) <b>Ug.Shs.
              <?php $nightcharge = implode("",explode(",",str_replace(" ","",$_POST['guardamount_night'])));
	echo commify($nightcharge);
	$total += $nightcharge;
?>
              /=</b>
            <?php } ?>
            <br>
            <br>
            <b>TOTAL =	Ug.Shs.
              <?php echo commify($total)."/=";?>
              <br>
              (Uganda Shillings <?php echo num2words($total);?> Only).</b></td>
        </tr>
        <tr>
          <td colspan="3"><hr></td>
        </tr>
        <tr>
          <td><b style="font-size:18px">AGREED BY:</b> </td>
          <td><b><?php echo $settings['abbreviation'];?></b></td>
          <td><b>CLIENT</b></td>
        </tr>
        <tr>
          <td><b>Name:</b></td>
          <td width="218" style="border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #000000;">&nbsp;</td>
          <td width="321" style="border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #000000;">&nbsp;</td>
        </tr>
        <tr>
          <td><b>Title:</b></td>
          <td style="border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #000000;">&nbsp;</td>
          <td style="border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #000000;">&nbsp;</td>
        </tr>
        <tr>
          <td><b>Signature:</b></td>
          <td style="border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #000000;">&nbsp;</td>
          <td style="border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #000000;">&nbsp;</td>
        </tr>
        <tr>
          <td><b>Telephone Contacts: </b></td>
          <td style="border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #000000;">&nbsp;</td>
          <td style="border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #000000;">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" height="1"></td>
        </tr>
        <tr>
          <td colspan="3"><u><b>Note:     All terms and conditions of service contract apply. (Overleaf)</b></u></td>
        </tr>
        <tr>
          <td colspan="3" height="1"></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><i><b style="font-family:'Times New Roman', Times, serif; font-size:18px">&ldquo;Your Ultimate Partner in Security&rdquo;</b></i></td>
        </tr>
    </table> 
    </div></td>
  </tr>
  <tr>
    <td><div class="page"><table>
    <tr>
      <td colspan="3"><b style="font-size:18px">TERMS AND CONDITIONS -
        <?php if($type == "guard"){ echo "GUARDING SERVICES";}?>
      </b></td>
    </tr>
    <tr>
      <td colspan="3"><b>1. Provider&rsquo;s  Obligations</b>
          <ul>
            <li>To provide trained personnel, who will at all  times, guard the premises and ensure 
              the  security of the premises entrusted to the Provider.</li>
            <li>To provide a supervisor/inspector to check the  premises to ascertain the guards&rsquo; effectiveness  at work.</li>
            <li>To exercise all due care and diligence in the  provision of the service detailed which  shall be provided on a twelve (12) and or twenty-four (24) hour basis.</li>
            <li>To mount the sign plates on the premises that  indicate the premises are being protected  by USL</li>
          </ul>
        <b>2.Client Obligations.</b>
          <ul>
            <li>To provide all necessary and accurate information for  the Provider&rsquo;s assessment of  the required security services.</li>
            <li>To immediately notify the Provider of any changes  in the security requirements, including  circumstances likely to have an adverse effect on the Client&lsquo;s security for  which the Provider shall make necessary recommendations. In absence of such  information, the Provider shall not be liable in case of the occurrence of any  incidents / events / losses / damage.</li>
            <li>To promptly notify the Provider, verbally and  thereafter in writing, of any security incidences,  in any case no later than forty eight (48) hours of the&nbsp; occurrence  of the incident. The Client shall be deemed to have waived rights to any claims  the Client may have against the Provider.</li>
            <li>To formalize services by execution of contract with  the Provider once the assignments  is confirmed as permanent, a formal contract shall be executed by the Client  with the Provider. </li>
            <li>To permit affixing upon its premises signposts or  marks indicating the provision of security  services by USL.</li>
          </ul>
        <b>3. Payments: </b>
          <ul>
            <li>All  payments shall be promptly made at the Head Offices within seven (7) days of  the provision of the services herein detailed/delivery of invoices to the  client. </li>
            <li>If the  above payments remain unpaid for a period of seven (7) days after such payment  has become due, the outstanding payment shall attract an interest rate of 26%  per annum, not withstanding all accruing legal rights of the Provider.</li>
          </ul></td>
    </tr>
    <tr>
      <td colspan="3"><b>4. Equipment:</b> <br />
          <br />
        Any  equipment deployed remains the property of the Provider, and such equipment is  not Limited to Firearms, Radios, batons, Active Guard etc, and shall be  withdrawn on termination of the services herein provided. <br />
        <br /></td>
    </tr>
    <tr>
      <td colspan="3"><b>5. Disputes: </b> <br />
          <br />
        All disputes shall be resolved in  accordance with the Laws of Uganda. The Provider and Client shall endeavor to  settle any dispute amicably. <br /></td>
    </tr>
    <tr>
      <td colspan="3"><b>Authority  of Execution: </b> <br />
          <br />
        The  signatories hereto hereby warrant that they have the due authority to sign this  Agreement (for and on behalf of the Parties). <br />
        <br />
        By signature/seal/stamp (as applicable) hereof, the Client is deemed to  have read, understood and accepted the above terms and conditions by which both  the Provider and Client. </td>
    </tr>
    <tr>
      <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><br />
                <b>CLIENT:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; _____________________&nbsp;</b></td>
          <td><b>Date:&nbsp;&nbsp;&nbsp;&nbsp; _____________</b></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><b><?php echo $settings['abbreviation'];?>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; _____________________&nbsp;</b></td>
          <td><b>Date:&nbsp;&nbsp;&nbsp;&nbsp; _____________</b></td>
        </tr>
      </table></td>
    </tr>
</table></div></td>
  </tr>
</table>

</body>
<?php
/************************************************************************************
* Show form to generate contract.
*************************************************************************************/
} else {
//Get the assignment details
$assignment = getRowAsArray("SELECT * FROM assignments WHERE id='".$_GET['id']."'");

$type = decryptValue($_GET['t']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Generate Client Temporary Works Order</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="750" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
  <tr> 
    <td height="7"></td>
  </tr>
  <tr> 
    <td><?php include "../core/header.php";?></td>
  </tr> <tr> 
    <td height="7"></td>
  </tr>
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings"><a href="manageassignments.php">Manage Assignments</a> &gt; Generate Client Temporary Works Order (T.W.O)</td>
      </tr> 
      <tr>
        <td><form action="generatetwo.php" method="post" name="group" id="group" onSubmit=" return <?php if($type == "guard" || $type == "both"){ ?>isNotNullOrEmptyString('guardamount_day', 'Please enter the guard amount for the day shift.') && isNotNullOrEmptyString('guards_day', 'Please enter the number of guards for the day shift.') && isNotNullOrEmptyString('guardamount_night', 'Please enter the guard amount for the night shift.') && isNotNullOrEmptyString('guards_night', 'Please enter the number of guards for the night shift.');<?php  } ?>"><table width="100%" border="0">
          <tr>
            <td width="19%" align="right"><font class="redtext">*</font> is a required field </td>
            <td width="81%">&nbsp;</td>
          </tr>
		  <tr>
            <td height="30" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="4">
              <tr>
                <td class="label2">NOTE:<br>
                  To generate a complete T.W.O, please ensure the following: </td>
              </tr>
              <tr>
                <td>1. The client has been registered with full contact details.<br>
                  2. The charge rate of the client has been set by the Finance department.</td>
              </tr>
              
            </table></td>
            </tr>
          <?php if($type == "guard" || $type == "both"){?>
		  <tr>
            <td height="30" class="redtext" colspan="2"><b>NOTE: Number of assigned guards is: <?php echo $assignment['assignedguards'];?></b></td>
          </tr>
		  <tr>
            <td height="30" align="right" class="label2">Guard Amount<br> (Day Shift):<font class="redtext">*</font></td>
            <td nowrap>
              Shs.&nbsp;
              <input type="text" name="guardamount_day" id="guardamount_day" value=""> [V.A.T inclusive]</td>
          </tr>
		  <tr>
            <td height="30" align="right" class="label2">Number of Day Guards:<font class="redtext">*</font></td>
            <td nowrap>
             <input type="text" name="guards_day" id="guards_day" value=""> [Enter "0" (zero) if none]
</td>
          </tr>
		  <tr>
            <td height="30" align="right" class="label2">Guard Amount<br> (Night Shift):<font class="redtext">*</font></td>
            <td nowrap>
              Shs.&nbsp;
              <input type="text" name="guardamount_night" id="guardamount_night" value=""> [V.A.T inclusive]
</td>
          </tr>
		  <tr>
            <td height="30" align="right" class="label2">Number of Night Guards:<font class="redtext">*</font></td>
            <td nowrap>
             <input type="text" name="guards_night" id="guards_night" value=""> [Enter "0" (zero) if none]
</td>
          </tr>
		  <?php 
		  
		  } ?>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;
              <input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <input type="submit" name="submit" id="submit" value="Generate T.W.O &gt;&gt;">
              <input type="hidden" name="edit" id="edit" value="<?php echo $_GET['id']; ?>">
			  <input type="hidden" name="type" id="type" value="<?php echo $type; ?>"></td>
          </tr>
        </table>
        </form></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top" class="copyright">&copy;Solutions 
      For Business Limited</td>
  </tr>
  <tr> 
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  </div>
</table>
</body>
</html>
<?php } ?>