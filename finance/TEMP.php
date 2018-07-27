<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="5" style="border: 1px; 
	border-style: solid;
	border-color: #adaefe;">
                  <tr>
                    <td style="background-color:#CCCCCC;" valign="top"><span style="font-size:24px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold"><?php echo $settings['companyname'];?></span><br>
                      <br>
                      <span style="font-size:20px; font-family:Verdana, Arial, Helvetica, sans-serif">PAYSLIP</span></td>
                    <td rowspan="2" style="background-color:#CCCCCC; border-bottom:solid; border-bottom-color:#adaefe;" align="right"><?php echo "<img src=\"".$settings['companylogo']."\" width=\"130\" height=\"120\" border=\"1\">"; ?></td>
                  </tr>
                  <tr>
                    <td style="background-color:#CCCCCC; border-bottom:solid; border-bottom-color:#adaefe;" valign="bottom"><span style="font-size:20px; font-family:Verdana, Arial, Helvetica, sans-serif">Month Ending: <?php echo date("d-M-Y",strtotime($formvalues['viewdate']));?></span></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="27%" style="font-size:16px; font-family:Verdana, Arial, Helvetica, sans-serif">Employee:</td>
                        <td width="73%" style="font-size:16px; font-family:Verdana, Arial, Helvetica, sans-serif">&nbsp;</td>
                      </tr>
                      <tr>
                        <td style="font-size:16px; font-family:Verdana, Arial, Helvetica, sans-serif">Date of Employment: </td>
                        <td style="font-size:16px; font-family:Verdana, Arial, Helvetica, sans-serif"><b><?php echo date("d-M-Y",strtotime($data['dateofemployment']));?></b></td>
                      </tr>
                      
                    </table></td>
                    </tr>
                  
                  <tr>
                    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td style="background-color:#adaefe; border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><b>PAYMENTS</b></td>
                        <td style="background-color:#adaefe; border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><b>UGX</b></td>
                        <td style="background-color:#adaefe; border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><b>DEDUCTIONS</b></td>
                        <td style="background-color:#adaefe; border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><b>UGX</b></td>
                      </tr>
                      <tr>
                        <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px">Gross Salary </td>
                        <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><?php 
						$amount = getGuardCharge($id,$startdate,"");
						$totalamount = getGuardCharge($id,$startdate,"") + $bonustotal - $deductiontotal;
					echo commify($amount);
					 ?></td>
                        <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px">PAYE</td>
                        <td><?php $paye = generatePAYEAmount($totalamount,"local");
						echo "(".commify($paye).")";
					?></td>
                      </tr>
                      <tr>
                        <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px">&nbsp;</td>
                        <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px">&nbsp;</td>
                        <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px">NSSF</td>
                        <td><?php 
						$nssf = round($totalamount*($settings['employeenssfrate']/100));
						echo "(".commify($nssf).")";
					?></td>
                      </tr>
                     <?php if($formvalues['countlength'] > 0){?>
                      <tr>
                        <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><b>Other Payments:</b></td>
                        <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px">&nbsp;</td>
                        <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><b>Other Deductions: </b></td>
                        <td>&nbsp;</td>
                      </tr>
                      <?php for($k=0;$k<$formvalues['countlength'];$k++){?>
					  <tr><td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><?php 
					  if(isset($bonusarray[$k][1]) && $bonusarray[$k][1] != ""){
					  	echo $bonusarray[$k][1];
					  } else {
					  	echo "&nbsp;";
					  }
					  ?></td>
                        <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><?php 
						if(isset($bonusarray[$k][0]) && $bonusarray[$k][0] != ""){
					  	echo commify($bonusarray[$k][0]);
					  } else {
					  	echo "&nbsp;";
					  }
						?></td>
                        <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><?php 
						if(isset($deductionarray[$k][1]) && $deductionarray[$k][1] != ""){
					  	echo $deductionarray[$k][1];
					  } else {
					  	echo "&nbsp;";
					  }
						?></td>
                        <td><?php 
						if(isset($deductionarray[$k][0]) && $deductionarray[$k][0] != ""){
					  	echo "(".commify($deductionarray[$k][0]).")";
					  } else {
					  	echo "&nbsp;";
					  }
						?></td>
                      </tr>
					  
					  <?php } //End of FOR loop
					  
					   } ?>
                      <tr>
                        <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><b>Total Pay </b></td>
                        <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><b><?php echo  commify($totalamount);?></b></td>
                        <td style="border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><b>Total Deductions </b></td>
                        <td><?php 
						$totaldeduction = $paye + $nssf + $deductiontotal;
						echo "(".commify($totaldeduction).")";?></td>
                      </tr>
                      <tr>
                        <td style="background-color:#adaefe; border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px">&nbsp;</td>
                        <td style="background-color:#adaefe; border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px">&nbsp;</td>
                        <td style="background-color:#adaefe; border-right-color:#CCCCCC; border-right-style:solid; border-right-width:1px"><b>NET PAY </b></td>
                        <td style="background-color:#adaefe; "><b><?php echo commify($totalamount - $totaldeduction);?></b></td>
                      </tr>
                    </table></td>
                    </tr>
                </table>
</body>
</html>
