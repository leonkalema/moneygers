<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
$settings = getRowAsArray("SELECT * FROM settings");

$downloadtime = date("d-m-y-Hi")."Hrs";

// required for IE, otherwise Content-disposition is ignored
if(ini_get('zlib.output_compression'))
	ini_set('zlib.output_compression', 'Off');
//Get the assignment details
$assignment = getRowAsArray("SELECT * FROM assignments WHERE id='".$_GET['id']."'");
//Form the download name
$filename = "ClientContract_".preg_replace(" ","-",$assignment['client'])."_".$downloadtime.".doc";
# This line will stream the file to the user rather than spray it across the screen
header("Content-type: application/vnd.ms-word");

# replace excelfile.xls with whatever you want the filename to default to
header("Content-Disposition: attachment;filename=".$filename);
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
?>
        							
		

<table>
<tr><td align="center" colspan="2">
<b>THE REPUBLIC OF UGANDA</b>
<br><br>
<b>CONTRACT ACT (CAP.73)</b>
<br><br>
<b>CONTRACT FOR SECURITY SERVICES</b>
<br><br>
This Agreement Number <b>……../08</b> is made this ……….<b>day</b> of ……..<b>2008</b>
<br><br>
<b>BETWEEN</b>
</td></tr>
<tr><td colspan="2">
<b>ULTIMATE SECURITY LIMITED</b>, P.O. Box 21644, Kampala, Uganda (hereinafter referred to as “USL” which expression shall where the context so admits include its successors in title and assignees) on the one part.
<br><br>
     <b>AND</b>
<br><br>
………………………………………, P O Box ………., ………….- Uganda (hereinafter referred to as “the Client” which expression shall where the context so admits include its successors in title and assignees) on the other part.
<br><br>
<b>WHEREAS:-</b>
<br>USL is a limited liability company formed for the purpose of operating security systems and offering security services as requested by other parties.
<br><br>
<b>AND WHEREAS</b> the Client is desirous of engaging USL for purposes of providing it with security services as hereafter agreed.
<br><br>
<b>NOW THIS AGREEMENT WITNESSETH</b> as follows:
USL undertakes to provide security services as requested by the Client and detailed in Schedule “A” annexed hereto and the Client undertakes to pay the consideration as fully detailed, subject to the following terms and conditions.
<br><br>
<b>1.	COMMENCEMENT AND DURATION</b>
<br>
This Agreement commences with effect from ……………. as the effective date of Agreement between the Parties and shall remain in force for a period of <b>……… year</b> from …………. until …………… renewable at the instance of both Parties, provided that either Party hereto shall be entitled to require the other Party to enter into negotiations for the variation of the terms hereof upon expiry of the initial period, failing which this Agreement will determine upon the expiry of the initial period and/ as hereafter provided under clause 8.
<br><br>
<b>2.	CONSIDERATION</b>
<br>i. 	The consideration payable by the Client to USL shall be as set out in Schedule “A” hereto;
<br>
a.	<b>Ug.Shs. ……………(Uganda Shillings ……………………………… only)</b>, VAT inclusive per backup of Alarm System that includes monthly monitoring, servicing and a 24 hr Quick Response Force.
<br>
<br>
 ii.	The Radio Alarm Transmitter installed remains the property of USL, and shall be withdrawn on termination of the services herein provided.
<br><br>
iii.	The amount payable per month shall be invoiced by USL to the Client on the first day of each month and is payable upon delivery of the same no later than the seventh day of the succeeding month.
<br><br>
<b>3.	OBLIGATIONS OF THE USL</b>
<br>
USL undertakes for the duration of this Agreement;
<br>
(a)	To exercise all due care and diligence in the provision of the service detailed in schedule, “A” which shall be provided on a twenty -four (24) hour basis.
<br>(b)	To provide technicians who shall make periodic check visits to the premises to service and maintain the equipment.
<br>(c)	To, on the activation of the alarm system, dispatch a Quick Response Force (QRF) Vehicle through radio communication to render the necessary assistance to the client.
<br>(d)	To mount the sign plates on the premises that indicate the premises are being guarded or protected by USL.
<br>(e)	To provide the Client with comprehensive, quality and efficient services covering every aspect of the Client’s security requirements in the most cost-effective manner.
<br><br><b>4.	INDEMNITY</b>
<br>USL will indemnify the Client against loss or damage to property resulting from the sole and negligent actions of the security officer(s) while performing their duties within the scope of their employment with USL, and/loss or damage to property resulting from non-
response to an alarm activation by our QRF, owing to the sole and negligent actions of the QRF to a specified, defined and limited amount as hereafter mentioned, provided that;
<br><br>
(a)	Such actions and/or non-response are due to the sole and negligent actions of the security officer(s) of USL and or QRF respectively.
<br><br>
(b)	The Client shall have made provision for insurance to cover the loss and/or reduce and/or prevent the perpetuity of the loss.
<br><br>
(c)	The loss or any consequential loss or indirect loss or damage sustained by the Client, as a result of the sole and negligent actions of the security officer (s) of USL and/or QRF, is limited to and not in excess of <b>Ug.Shs. 3,000,000/=</b>.
<br><br>
(d)	Such loss shall upon occurrence thereof have been communicated immediately by the client to the General Manager or an authorized representative of USL. Such communication shall be <b><u>verbal</u></b>.
<br>
<br>
(e)	Notice of all claims against USL in respect of any loss or damage resulting from the sole and negligent actions of the security officer(s) of USL and/or QRF as provided under clause (a) and (c) above, shall thereafter be given in writing to USL at the address at the head of this Agreement no later than seven (7) days of the occurrence of such loss or damage. In the event of failure to provide such notice, it is hereby agreed that USL shall not be held responsible for such claim.
<br><br>
(f)	       It is hereby understood and agreed that any monies required to be paid to the 
Client in indemnity as herein above provided shall be payable within a reasonable period after the liability for USL for such loss has been established through investigations by the police, the Client and USL, and the said losses verified and determined; and/or in cases to be determined by arbitration/a court of law, the payment shall be made within a reasonable period after an arbitration award/ final judgment has been made/passed and the extracting of an award/final decree. Such period shall, depending on the circumstances of each event/incident/case, be determined and agreed upon in writing by the authorized representatives of the Parties to the Agreement.
<br><br>
<b>5.	OBLIGATIONS OF THE CLIENT</b>
<br>
a)	To exclusively engage USL as its security services provider, unless the contrary has previously been agreed upon in writing by the parties to this Agreement. 
<br><br>
b)	To duly pay USL in return for the services provided under this Agreement.
<br><br>
c)	To indemnify USL in full against all claims, liabilities, loss, damage, costs and expenses (including legal expenses) awarded against or incurred by the Client in respect of which USL has no liability.
<br><br>
d)	To maintain in force a policy of insurance, and provide USL with evidence of such insurance as and when requested.
<br><br>
e)	To notify USL in writing of all alleged misconduct or unfitness of the guards provided.
<br><br>
f)	To notify USL of any required changes in the security requirements, including but not limited to circumstances likely to have a significant and adverse effect on the Client ‘s security or result into damage upon the premises and allow for USL to make necessary recommendations to accommodate the changes.
<br><br>
g)	To permit USL to affix upon the Client’s premises such signpost or marks indicating that the services are provided by USL.
<br><br>
h)	To request USL in writing for permission to recruit or hire USL staff before the same are recruited and or hired by the Client.
<br><br>
<b>6.	DISPUTES</b>
<br>USL and the Client will endeavor to resolve any dispute which arises between 
the parties through good faith negotiations, as hereunder provided;
<br><br>
(a)	The USL General Manager and the Client ‘s Manager or their appointed representatives as agreed will attempt to resolve the dispute between the parties within fourteen (14) days of the matter being referred to them, or any other period agreed upon by the Parties; 
<br><br>
(b)	If the above persons are unable to resolve the matter within fourteen (14) days of the matter being referred to them, or any other period agreed upon, such matter shall be resolved exclusively by arbitration as hereafter provided; 
<br><br>
(c)	Any controversy or claim, whether based on contract, tort or other legal claim arising out or relating to this Agreement, including its interpretation, performance, breach of or termination that is not resolved by good faith negotiations as here above provided, shall be resolved exclusively by Arbitration as hereafter provided;
<br><br>
(i) 	The Arbitration shall be conducted under the Arbitration and Conciliation Act, Laws of Uganda
<br>
(ii) 	The Arbitration shall be conducted by a single arbitrator agreed upon between the Parties, or failing Agreement within seven (7) days of notification by either Party to the other of the existence of a dispute or claim, to be appointed at the written request of any Party to the dispute by the Chairman for the time being of the Center for Arbitration and Dispute Resolution.
<br><br><b>7.	FORCE MAJEURE</b>
<br>(a)	Neither Party hereto shall incur any liability by reason of any failure to fulfill any obligation within the terms of this Agreement, if such failure is occasioned by force majeure including but not limited to such events as Acts of God, strikes, lockouts, boycotts, fire, flood, prohibitive Governmental regulation or any other cause beyond the reasonable control of the parties rendering the performance of this Agreement impossible whereupon all dues under this Agreement shall become due and owing and, payable immediately to USL by the Client. The dues shall in any case be payable within fifteen (15) days of the date of occurrence of the frustrating event and no later than thirty (30) days thereof. For the avoidance of doubt the dues that shall be paid by the Client, are dues owing for services actually performed as at the date of occurrence of the frustrating event. 
<br><br>

(b)	If the circumstances prevail for a continuous period of more than thirty (30) working days on the part of either party, this Agreement shall be suspended and negotiations between the Parties for the continued provision of security services by USL shall re-commence on determination of the intervening or frustrating event. 
<br><br>
(c)	If the circumstances prevail for a continuous period of more than three (3) months, either Party shall be entitled to determine this Agreement forthwith.
<br><br>
<b>8.	TERMINATION</b>
<br>(a)	Except as hereinafter provided, this Agreement shall terminate at the expiry of the term herein agreed upon and/or if earlier terminated, by either Party giving to other one (01) month’s notice in writing or payment in lieu of such notice.
<br><br>
(b)	If either Party breaches any part or provision of the Agreement and fails to remedy such breach within twenty one (21) days of written notice to do so, the Party giving such notice shall be entitled to cancel this Agreement without prejudice to any other rights which the Party giving notice may have against the defaulting party resulting from this Agreement.
<br><br>
(c)	On non payment, if the payments or any part thereof shall remain unpaid for a period of one (1) month after such payment has become due, USL may give the Client seven (7) days notice to terminate this Agreement and unless such sum has been paid before the expiration of such notice this Agreement shall automatically determine, upon expiry of the seven (7) days and USL’s obligations under it shall cease but without prejudice to the liability of the Client in respect of any rights accruing to USL as a result of such or any other breach of this Agreement.
<br><br>
(d)	Either Party shall be entitled to terminate this Agreement with immediate effect by notice in writing, if either party goes into liquidation, steps are taken to commence winding –up or a receiver is appointed over any or all of either party ‘s assets.  All dues owing to USL by the Client shall be immediately payable upon determination hereof.
<br><br>
(e)	The termination of this Agreement, for whatever reason shall not affect the rights of the Parties, accruing prior to the termination.
<br><br>
(f)	Upon determination of this Agreement, USL shall remove and discontinue the use of all signs and other material likely to make it appear that USL is still providing the Client with security services. 
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

IN WITNESS WHEREOF the parties have hereunto affixed their hands and signatures in the presence of their respective witnesses on this …….. day of <b>……………2008</b>.
</td></tr><tr><td>
<b>THE COMMON SEAL	
<br>OF ULTIMATE SECURITY LTD</b              				
><br>is hereunto affixed by its 						‘ USL ’
<br>Authorized Representative
<br>
<br>………………………………..
<br>GENERAL MANAGER
</td>
  <td>________________________
    <b><br>
    &lsquo;USL&rsquo;</b> </td>
</tr>
<tr><td>
Signed and Delivered by	
<br>…………………………………</td>
<td>________________________
    <br>
    <b>‘CLIENT’</b> </td>
</tr>

<tr><td colspan="2">
All in the presence of: 			          ]         	 


<br><br>____________________________
<br><b>‘WITNESS’</b>


<br><br><br>
<b><i><u>DRAWN BY</u></i></b>
<br>LEGAL DEPARTMENT
<br>ULTIMATE SECURITY LTD.
<br>P.O.BOX 21644
<br>KAMPALA
<br>UGANDA
</td></tr>



<tr><td align="center" colspan="2">
<b style="font-size:26px">“Schedule A”</b>
</td></tr>
<tr><td colspan="2">
<b>Location:</b>			
<br><br>	
	Plot ……………………….. 
	<br>P O Box ……..
<br>KAMPALA
	
	<br><br>Call Sign:			………
	<br>Contact Person:		……………… 
<br>Tel: 				………………….
<br>Fax:				………………….
<br>Cell: 				………………….
<br>E-mail:				………………….


	
<br><br><br>
PANIC ALARM SYSTEM SERVICES

<br><br>i.	Monthly Backup that includes monthly Monitoring,
Servicing, Maintenance and 24 Hours Quick 
<br>Response Force	=	<b>Ug.Shs…………..</b> per month, 
<br>Plus V.A.T 		=	Ug.Shs.   ………... per month

<br><br><b>TOTAL		=	Ug.Shs………………….

<br>Uganda Shillings …………………………………………………………………. 	only.</b></td></tr>
</table>
