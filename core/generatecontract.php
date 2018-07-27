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
$assignment = getRowAsArray("SELECT a.client, a.rate, a.callsign, a.contactname, a.contactphone, a.contactfax, a.contactemail, a.startdate, a.enddate, a.rate, c.boxno, c.plotno FROM assignments a, clients c WHERE c.name = a.client AND a.id='".$_POST['edit']."'");
//Form the download name
$filename = "ClientContract_".str_replace(" ","-",$assignment['client'])."_".$downloadtime.".doc";
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
<title>Client Contract - <?php echo $assignment['client'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body topmargin="0" bottommargin="0">
<table>
<tr><td align="center" colspan="2">
<b>THE REPUBLIC OF UGANDA</b>
<br><br>
<b>CONTRACT ACT (CAP.73)</b>
<br><br>
<b>CONTRACT FOR SECURITY SERVICES</b>
<br><br>
This Agreement Number <b><?php echo strtotime("now")."/".date("y",strtotime("now"));?></b> is made this <b><?php echo date("jS",strtotime("now"));?> day</b> of <b><?php echo date("F Y",strtotime("now"));?></b>
<br><br>
<b>BETWEEN</b>
</td></tr>
<tr>
  <td colspan="2">
<b><?php echo $settings['companyname'];?></b>, P.O. Box <?php echo $settings['pobox'];?>, <?php echo $settings['headqtrscity'];?>, <?php echo $settings['headqtrscoutry'];?> (hereinafter referred to as &quot;<?php echo $settings['abbreviation'];?>&quot; which expression shall where the context so admits include its successors in title and assignees) on the one part.
<br>
<br>
     <b>AND</b>
<br><br>
<b><?php echo $assignment['client'];?></b>, P O Box <?php echo $assignment['boxno'];?>- Uganda (hereinafter referred to as &quot;the Client&quot; which expression shall where the context so admits include its successors in title and assignees) on the other part.
<br>
<br>
<b>WHEREAS:-</b>
<br><?php echo $settings['abbreviation'];?> is a limited liability company formed for the purpose of operating security systems and offering security services as requested by other parties.
<br><br>
<b>AND WHEREAS</b> the Client is desirous of engaging <?php echo $settings['abbreviation'];?> for purposes of providing it with security services as hereafter agreed.
<br><br>
<b>NOW THIS AGREEMENT WITNESSETH</b> as follows:
<?php echo $settings['abbreviation'];?> undertakes to provide security services as requested by the Client and detailed in Schedule &quot;A&quot; annexed hereto and the Client undertakes to pay the consideration as fully detailed, subject to the following terms and conditions.
<br><br>
<b>1.	COMMENCEMENT AND DURATION</b>
<br>
This Agreement commences with effect from <u><?php echo date("d-M-Y",strtotime($assignment['startdate']));?></u> as the effective date of Agreement between the Parties and shall remain in force for a period of <b><?php 
if($assignment['enddate'] != "0000-00-00"){
	$daydiffarray = getDayDifference($assignment['startdate'],"",$assignment['enddate'],"");
	if($daydiffarray[0] > 365){ 
		$years = round($daydiffarray[0]/365);
		$days = $daydiffarray[0] - ($years*365);
		echo $years." year(s)";
		if($days > 0){
		echo " and ".$days." days";
		}
		
	} else {
		echo $daydiffarray[0]." days";
	} 
} else {
 echo "UNSPECIFIED";
}
?></b> from <u><?php echo date("d-M-Y",strtotime($assignment['startdate']));?></u> until <u><?php 
if($assignment['enddate'] != "0000-00-00"){
 echo date("d-M-Y",strtotime($assignment['enddate']));
} else {
 echo "UNSPECIFIED";
}
?></u> renewable at the instance of both Parties, provided that either Party hereto shall be entitled to require the other Party to enter into negotiations for the variation of the terms hereof upon expiry of the initial period, failing which this Agreement will determine upon the expiry of the initial period and/ as hereafter provided under clause 8.
<br><br>
<b>2.	CONSIDERATION</b>
<br>i. 	The consideration payable by the Client to <?php echo $settings['abbreviation'];?> shall be as set out in Schedule &quot;A&quot; hereto;
<br>
<?php if($type == "alarm"){ ?>a.	<b>Ug.Shs. <?php echo commify(implode("",explode(",",str_replace(" ","",$_POST['amount']))));?> (Uganda Shillings <?php echo num2words(implode("",explode(",",str_replace(" ","",$_POST['amount']))));?> Only)</b>, VAT inclusive per backup of Alarm System that includes monthly monitoring, servicing and a 24 hr Quick Response Force.

<?php } else if($type == "guard"){ ?>
a.	<b>Ug.Shs. <?php echo commify($guardtotal);?>/= (Uganda Shillings <?php echo num2words($guardtotal);?> Only)</b>, per month for each armed security officer.

<?php } else { ?>
a.	<b>Ug.Shs. <?php echo commify($guardtotal);?>/= (Uganda Shillings <?php echo num2words($guardtotal);?> Only)</b>, per month for each unarmed security officer.
<br><br>
b.	<b>Ug.Shs. <?php echo commify(implode("",explode(",",str_replace(" ","",$_POST['amount']))));?>/- (Uganda Shillings <?php echo num2words(implode("",explode(",",str_replace(" ","",$_POST['amount']))));?> Only)</b>, per month per backup of the Alarm System.
<?php } ?>
<br>
<br>

<?php if($type == "alarm" || $type == "both"){?>
 ii.	<?php if($type == "both"){ echo "The equipment";} else {?>The Radio Alarm Transmitter <?php } ?> installed remains the property of <?php echo $settings['abbreviation'];?>, and shall be withdrawn on termination of the services herein provided.
<br><br>
iii.
<?php } else { echo "<br><br>ii.";}?>
	The amount payable per month shall be invoiced by <?php echo $settings['abbreviation'];?> to the Client on the first day of each month and is payable upon delivery of the same no later than the seventh day of the succeeding month.
<br><br>
<b>3.	OBLIGATIONS OF  <?php echo $settings['abbreviation'];?></b>
<br>
<?php echo $settings['abbreviation'];?> undertakes for the duration of this Agreement;
<br>
(a)	To exercise all due care and diligence in the provision of the service detailed in schedule, &quot;A&quot; which shall be provided on a twenty-four (24) hour basis.
<br>
<?php if($type == "alarm"){?>
(b)	To provide technicians who shall make periodic check visits to the premises to service and maintain the equipment.
<br>(c)	To, on the activation of the alarm system, dispatch a Quick Response Force (QRF) Vehicle through radio communication to render the necessary assistance to the client.
<br>(d)	To mount the sign plates on the premises that indicate the premises are being guarded or protected by <?php echo $settings['abbreviation'];?>.
<br>
(e)	To provide the Client with comprehensive, quality and efficient services covering every aspect of the Client's security requirements in the most cost-effective manner.
<?php } else if($type == "guard"){?>
(b)	To provide the Client with trained personnel to render the services described in this Agreement and meet all the Client's requirements. 
<br>(c)	The security officer(s) in charge of the premises will at all times properly look after the property entrusted to USL for the purpose of carrying out the terms of this Agreement
<br>(d)	To provide a supervisor/inspector who shall make periodic check visits to the premises to ascertain the guards' effectiveness at work
<br>(e)	All security officers employed in the performance of USL duties have or will have been subjected to a thorough medical inspection and passed as fit for their duties
<br>(f)	To mount the sign plates on the premises that indicate the premises are being guarded by USL
<br>(g)	To provide the Client with comprehensive, quality and efficient services covering every aspect of the Client's security requirements in the most cost-effective manner.

<?php } else {?>
(b)	To provide the Client with trained personnel to render the services described in this Agreement and meet all the Client's requirements. 
<br>(c)	The security officers in charge of the premises will at all times properly look after the property entrusted to USL for the purpose of carrying out the terms of this Agreement.
<br>(d)	To provide a supervisor/inspector who shall make periodic check visits to the premises to ascertain the guard's effectiveness at work
<br>(e)	To provide technicians who shall make periodic check visits to the premises to service and maintain the equipment.
<br>(f)	All security officers employed in the performance of USL duties have or will have been subjected to a thorough medical inspection and passed as fit for their duties.
<br>(g)	To, on the activation of the alarm system, dispatch a Quick Response Force (QRF) Vehicle through radio communication to render the necessary assistance to the client.
<br>(h)	To mount the sign plates on the premises that indicate the premises are being guarded or protected by USL.
<br>(i)	To provide the Client with comprehensive, quality and efficient services covering every aspect of the Client's security requirements in the most cost-effective manner.

<?php } ?>
<br>
<br><b>4.	INDEMNITY</b>
<br>
<?php echo $settings['abbreviation'];?> will indemnify the Client against loss or damage to property resulting from the sole and negligent actions of the security officer(s) while performing their duties within the scope of their employment with <?php echo $settings['abbreviation']; if($type == "alarm" || $type == "both"){?>, and/loss or damage to property resulting from non-response to an alarm activation by our QRF, owing to the sole and negligent actions of the QRF<?php }?> to a specified, defined and limited amount as hereafter mentioned, provided that;
<br>
<br>
(a)	Such actions and/or non-response are due to the sole and negligent actions of the security officer(s) of <?php echo $settings['abbreviation']; if($type == "alarm" || $type == "both"){?> and or QRF respectively<?php } ?>.
<br><br>
(b)	The Client shall have made provision for insurance to cover the loss and/or reduce and/or prevent the perpetuity of the loss.
<br><br>
(c)	The loss or any consequential loss or indirect loss or damage sustained by the Client, as a result of the sole and negligent actions of the security officer(s) of <?php echo $settings['abbreviation'];?> and/or QRF, is limited to and not in excess of <b>Ug.Shs. 3,000,000/=</b>.
<br>
<br>
(d)	Such loss shall upon occurrence thereof have been communicated immediately by the client to the General Manager or an authorized representative of <?php echo $settings['abbreviation'];?>. Such communication shall be <b><u>verbal</u></b>.
<br>
<br>
(e)	Notice of all claims against <?php echo $settings['abbreviation'];?> in respect of any loss or damage resulting from the sole and negligent actions of the security officer(s) of <?php echo $settings['abbreviation']; if($type == "alarm" || $type == "both"){?>and/or QRF<?php } ?> as provided under clause (a) and (c) above, shall thereafter be given in writing to <?php echo $settings['abbreviation'];?> at the address at the head of this Agreement no later than seven (7) days of the occurrence of such loss or damage. In the event of failure to provide such notice, it is hereby agreed that <?php echo $settings['abbreviation'];?> shall not be held responsible for such claim.
<br><br>
(f)	       It is hereby understood and agreed that any monies required to be paid to the 
Client in indemnity as herein above provided shall be payable within a reasonable period after the liability for <?php echo $settings['abbreviation'];?> for such loss has been established through investigations by the police, the Client and <?php echo $settings['abbreviation'];?>, and the said losses verified and determined; and/or in cases to be determined by arbitration/a court of law, the payment shall be made within a reasonable period after an arbitration award/ final judgment has been made/passed and the extracting of an award/final decree. Such period shall, depending on the circumstances of each event/incident/case, be determined and agreed upon in writing by the authorized representatives of the Parties to the Agreement.
<br><br>
<b>5.	OBLIGATIONS OF THE CLIENT</b>
<br>
a)	To exclusively engage <?php echo $settings['abbreviation'];?> as its security services provider, unless the contrary has previously been agreed upon in writing by the parties to this Agreement. 
<br><br>
b)	To duly pay <?php echo $settings['abbreviation'];?> in return for the services provided under this Agreement.
<br><br>
c)	To indemnify <?php echo $settings['abbreviation'];?> in full against all claims, liabilities, loss, damage, costs and expenses (including legal expenses) awarded against or incurred by the Client in respect of which <?php echo $settings['abbreviation'];?> has no liability.
<br><br>
d)	To maintain in force a policy of insurance, and provide <?php echo $settings['abbreviation'];?> with evidence of such insurance as and when requested.
<br><br>
e)	To notify <?php echo $settings['abbreviation'];?> in writing of all alleged misconduct or unfitness of the guards provided.
<br><br>
f)	To notify <?php echo $settings['abbreviation'];?> of any required changes in the security requirements, including but not limited to circumstances likely to have a significant and adverse effect on the Client 's security or result into damage upon the premises and allow for <?php echo $settings['abbreviation'];?> to make necessary recommendations to accommodate the changes.
<br>
<br>
g)	To permit <?php echo $settings['abbreviation'];?> to affix upon the Client's premises such signpost or marks indicating that the services are provided by <?php echo $settings['abbreviation'];?>.
<br>
<br>
h)	To request <?php echo $settings['abbreviation'];?> in writing for permission to recruit or hire <?php echo $settings['abbreviation'];?> staff before the same are recruited and or hired by the Client.
<br><br>
<b>6.	DISPUTES</b>
<br><?php echo $settings['abbreviation'];?> and the Client will endeavor to resolve any dispute which arises between 
the parties through good faith negotiations, as hereunder provided;
<br><br>
(a)	The <?php echo $settings['abbreviation'];?> General Manager and the Client 's Manager or their appointed representatives as agreed will attempt to resolve the dispute between the parties within fourteen (14) days of the matter being referred to them, or any other period agreed upon by the Parties; 
<br><br>
(b)	If the above persons are unable to resolve the matter within fourteen (14) days of the matter being referred to them, or any other period agreed upon, such matter shall be resolved exclusively by arbitration as hereafter provided; 
<br><br>
(c)	Any controversy or claim, whether based on contract, tort or other legal claim arising out or relating to this Agreement, including its interpretation, performance, breach of or termination that is not resolved by good faith negotiations as here above provided, shall be resolved exclusively by Arbitration as hereafter provided;
<br><br>
(i) 	The Arbitration shall be conducted under the Arbitration and Conciliation Act, Laws of Uganda
<br>
(ii) 	The Arbitration shall be conducted by a single arbitrator agreed upon between the Parties, or failing Agreement within seven (7) days of notification by either Party to the other of the existence of a dispute or claim, to be appointed at the written request of any Party to the dispute by the Chairman for the time being of the Center for Arbitration and Dispute Resolution.
<br><br><b>7.	FORCE MAJEURE</b>
<br>(a)	Neither Party hereto shall incur any liability by reason of any failure to fulfill any obligation within the terms of this Agreement, if such failure is occasioned by force majeure including but not limited to such events as Acts of God, strikes, lockouts, boycotts, fire, flood, prohibitive Governmental regulation or any other cause beyond the reasonable control of the parties rendering the performance of this Agreement impossible whereupon all dues under this Agreement shall become due and owing and, payable immediately to <?php echo $settings['abbreviation'];?> by the Client. The dues shall in any case be payable within fifteen (15) days of the date of occurrence of the frustrating event and no later than thirty (30) days thereof. For the avoidance of doubt the dues that shall be paid by the Client, are dues owing for services actually performed as at the date of occurrence of the frustrating event. 
<br><br>

(b)	If the circumstances prevail for a continuous period of more than thirty (30) working days on the part of either party, this Agreement shall be suspended and negotiations between the Parties for the continued provision of security services by <?php echo $settings['abbreviation'];?> shall re-commence on determination of the intervening or frustrating event. 
<br><br>
(c)	If the circumstances prevail for a continuous period of more than three (3) months, either Party shall be entitled to determine this Agreement forthwith.
<br><br>
<b>8.	TERMINATION</b>
<br>(a)	Except as hereinafter provided, this Agreement shall terminate at the expiry of the term herein agreed upon and/or if earlier terminated, by either Party giving to the other <b><?php if($type == "alarm"){ echo "One (01) month's";} else if($type == "guard"){ echo $_POST['terminationtime']." Months";} else { echo "seven (7) Days";}?></b> notice in writing or payment in lieu of such notice.
<br>
<br>
(b)	If either Party breaches any part or provision of the Agreement and fails to remedy such breach within twenty one (21) days of written notice to do so, the Party giving such notice shall be entitled to cancel this Agreement without prejudice to any other rights which the Party giving notice may have against the defaulting party resulting from this Agreement.
<br><br>
(c)	On non payment, if the payments or any part thereof shall remain unpaid for a period of one (1) month after such payment has become due, <?php echo $settings['abbreviation'];?> may give the Client seven (7) days notice to terminate this Agreement and unless such sum has been paid before the expiration of such notice this Agreement shall automatically determine, upon expiry of the seven (7) days and <?php echo $settings['abbreviation'];?>'s obligations under it shall cease but without prejudice to the liability of the Client in respect of any rights accruing to <?php echo $settings['abbreviation'];?> as a result of such or any other breach of this Agreement.
<br><br>
(d)	Either Party shall be entitled to terminate this Agreement with immediate effect by notice in writing, if either party goes into liquidation, steps are taken to commence winding-up or a receiver is appointed over any or all of either party 's assets.  All dues owing to <?php echo $settings['abbreviation'];?> by the Client shall be immediately payable upon determination hereof.
<br>
<br>
(e)	The termination of this Agreement, for whatever reason shall not affect the rights of the Parties, accruing prior to the termination.
<br><br>
(f)	Upon determination of this Agreement, <?php echo $settings['abbreviation'];?> shall remove and discontinue the use of all signs and other material likely to make it appear that <?php echo $settings['abbreviation'];?> is still providing the Client with security services. 
<br><br>
<b>9.	CORRESPONDENCE AND COMMUNICATIONS</b>
<br>
The Parties agree that regular communication between the authorized officers and management of the respective Parties is integral to their contractual relationship. Each party shall, therefore, on execution of this Agreement as soon as practicable , provide to the other, names, direct telephone numbers, within their respective business, as contacts to discuss any issues arising in relation to this Agreement.
<br><br>
<b>10.	FURTHER TERMS AND CONDITIONS</b>	
<br>
(a)	This Agreement constitutes the whole and entire Agreement between the Parties relating to the provision of Security services. Except to the extent repeated in this Agreement, this Agreement supersedes and extinguishes any pre-contractual statements made or given by either party to any other person. Each Party acknowledges that, in entering into this Agreement, it is not relying on any pre-contractual statement which is not set out in this Agreement. No Party shall have any right of action against the other arising out of or in connection, with any pre-contractual statement (save in the case of fraud) except to the extent repeated in this Agreement. 
<br><br>
(b)	No review, variation, addition, or consensual cancellation of this Agreement to this Agreement shall be of any force or effect unless reduced to writing and signed by the parties or their duly authorized representatives.
<br><br>
(c) 	No waiver of any of the terms and conditions of this Agreement will be binding or effectual for any purpose unless expressed in writing and signed by the Parties hereto giving the same, and any such waiver will be effective only in the specific instance and for the purpose given.  No failure or delay on the part of either Party hereto in exercising any right, power or privilege hereunder will operate as a waiver 	thereof, nor will any single or partial exercise of any right, power or privilege preclude any other or further exercise of such right, or power or privilege or the exercise of any other right, power or privilege.
<br><br>
(d)	Should any of the terms and conditions of this Agreement be held to be invalid, unlawful or unenforceable, such terms and conditions will be severable from the remaining terms and conditions that will continue to be valid and enforceable.  If any term or condition held to be invalid is capable of amendment to render it valid, the parties agree to negotiate an amendment to remove the invalidity.
<br><br>
(e)	The construction, validity and performance of this Agreement shall be governed in all respects by the laws of Uganda. 
<br><br>
(f)	The signatories hereto hereby warrant that they have the due authority to sign this Agreement for and on behalf of the Parties and further warrant for and on behalf of their respective principals that no issue shall be raised and no objection to the validity or enforceability of this Agreement shall be taken based upon the mode of execution of this Agreement.
<br><br><br>

IN WITNESS WHEREOF the parties have hereunto affixed their hands and signatures in the presence of their respective witnesses on this <b><?php echo date("jS",strtotime("now"));?> day</b> of <b><?php echo date("F Y",strtotime("now"));?></b>.
</td></tr><tr><td>
<b>THE COMMON SEAL	
<br>OF ULTIMATE SECURITY LTD</b              				
><br>is hereunto affixed by its 						' <?php echo $settings['abbreviation'];?> '
<br>Authorized Representative
<br>
<br>......................................
<br>GENERAL MANAGER
</td>
  <td>________________________
    <b><br>
    '
    <?php echo $settings['abbreviation'];?>'</b></td>
</tr>
<tr><td>
<br>Signed and Delivered by	
<br><br>.......................................<br><br></td>
<td>________________________
    <br>
    <b>'CLIENT'</b></td>
</tr>

<tr>
  <td colspan="2">
All in the presence of:         	 


<br>
<br>____________________________
<br>
<b>'WITNESS'</b>


<br>
<br><br>
<b><i><u>DRAWN BY</u></i></b>
<br>LEGAL DEPARTMENT
<br><?php echo $settings['companyname'];?>
<br>P.O.BOX <?php echo $settings['pobox'];?>
<br><?php echo strtoupper($settings['headqtrscity']);?>
<br><?php echo strtoupper($settings['headqtrscountry']);?>
</td></tr>

<tr><td align="center" colspan="2">
&nbsp;<br><br>
</td></tr>

<tr><td align="center" colspan="2">
<b style="font-size:26px">&quot;Schedule A&quot;</b>
</td></tr>
<tr><td colspan="2">
<b>Location:</b>			
<br><br>	
	Plot <?php echo $assignment['plotno'];?>
	<br>P O Box <?php echo str_replace(" ","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>",$assignment['boxno']);?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>Uganda.

	
	<br><br>Call Sign:	<?php echo $assignment['callsign'];?>
	<br>Contact Person:	<?php echo $assignment['contactname'];?> 
<br>Tel: <?php echo $assignment['contactphone'];?> 
<br>Fax: <?php echo $assignment['contactfax'];?> 
<br>Cell/Emergency: <?php echo $assignment['emergencyno'];?> 
<br>E-mail:	<?php echo $assignment['contactemail'];?> 


	
<br><br><br>
<?php 
$total = 0;
if($type == "alarm" || $type == "both"){?>
<b><?php if($type == "both"){ echo "a. ";}?>PANIC ALARM SYSTEM SERVICES</b><br>
<br>
Monthly Backup that includes monthly Monitoring,
Servicing, Maintenance and 24 Hours Quick 
<br>
Response Force	=	<b>Ug.Shs. <?php $monthrate = ($assignment['rate']*30);
echo commify($monthrate);
?>/=</b> per month, 
<br>
Plus V.A.T 		=	Ug.Shs.   <?php $tax = $monthrate*($settings['VATrate']/100); echo commify($tax);?>/= per month
<?php 
	$total += $monthrate + $tax;
} 

if($type == "guard" || $type == "both"){
?>
<b><?php if($type == "both"){ echo "<br><br>b. ";}?>SECURITY GUARD SERVICES</b><br>
<br>
i. <u><?php echo $_POST['guards_day'];?></u> <?php if($type == "both"){ echo "Una";} else {echo "A";}?>rmed Day Guard(s)   <b>Ug.Shs. <?php $daycharge = implode("",explode(",",str_replace(" ","",$_POST['guardamount_day'])));
	echo commify($daycharge);
	$total += $daycharge;
?>/=</b>
<br>
ii. <u><?php echo $_POST['guards_night'];?></u> <?php if($type == "both"){ echo "Una";} else {echo "A";}?>rmed Night Guard(s) <b>Ug.Shs. <?php $nightcharge = implode("",explode(",",str_replace(" ","",$_POST['guardamount_night'])));
	echo commify($nightcharge);
	$total += $nightcharge;
?>/=</b>
<?php } ?>
<br><br><b>TOTAL =	Ug.Shs. <?php 
echo commify($total)."/=";?>

<br>
Uganda Shillings <?php echo num2words($total);?> Only.</b></td>
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
<title>Moneyge My Company - Generate Client Contract</title>
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
        <td class="headings"><a href="manageassignments.php">Manage Assignments</a> &gt; Generate Client Contract</td>
      </tr> 
      <tr>
        <td><form action="generatecontract.php" method="post" name="group" id="group" onSubmit=" return <?php if($type == "alarm" || $type == "both"){?>isNotNullOrEmptyString('amount', 'Please enter the alarm amount.')<?php } if($type == "guard" || $type == "both"){ if($type == "both"){ echo " && ";}?>isNotNullOrEmptyString('guardamount_day', 'Please enter the guard amount for the day shift.') && isNotNullOrEmptyString('guards_day', 'Please enter the number of guards for the day shift.') && isNotNullOrEmptyString('guardamount_night', 'Please enter the guard amount for the night shift.') && isNotNullOrEmptyString('guards_night', 'Please enter the number of guards for the night shift.')<?php  } 
		
		if($type == "guard"){ echo " && isNotNullOrEmptyString('terminationtime', 'Please enter the time allowance before termination in months.')";} ?>;"><table width="100%" border="0">
          <tr>
            <td width="19%" align="right"><font class="redtext">*</font> is a required field </td>
            <td width="81%">&nbsp;</td>
          </tr>
		  <tr>
            <td height="30" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="4">
              <tr>
                <td class="label2">NOTE:<br>
                  To generate a complete contract, please ensure the following: </td>
              </tr>
              <tr>
                <td>1. The client has been registered with full contact details.<br>
                  2. The charge rate of the client has been set by the Finance department.</td>
              </tr>
              
            </table></td>
            </tr>
          <?php if($type == "alarm" || $type == "both"){?>
		  <tr>
            <td height="30" align="right" class="label2">Alarm Amount:<font class="redtext">*</font></td>
            <td nowrap>
              Shs.&nbsp;
              <input type="text" name="amount" id="amount" value=""> [V.A.T exclusive]</td>
          </tr>
		  <?php } 
		  
		  if($type == "guard" || $type == "both"){?>
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
		  <?php if($type == "guard"){ ?>
		  <tr>
            <td height="30" align="right" class="label2">Notice Period Before Termination:<font class="redtext">*</font></td>
            <td nowrap>
              <input type="text" name="terminationtime" id="terminationtime" value=""> Months</td>
          </tr>
		  
		  <?php }
		  
		  } ?>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;
              <input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <input type="submit" name="submit" id="submit" value="Generate Contract &gt;&gt;">
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
</table>
</body>
</html>
<?php } ?>