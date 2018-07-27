<?php
	include_once '../include/commonfunctions.php';
	// initialize a session
	session_start();
	openDatabaseConnection();
	
	if(isset($_POST['archive'])){
		$formvalues = array_merge($_POST);
		for($i=0;$i<count($formvalues['reminder']);$i++){
			mysql_query("UPDATE messages SET isactive = 'N' WHERE id='".$formvalues['reminder'][$i]."'");
			
		}
	}
	
	//Show the reminders which are system generated.
	generateSystemReminders();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<link rel='stylesheet' type='text/css' href='../calendar/calendar_style.css' />
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script language="JavaScript" type="text/javascript" src="../calendar/calendar.js"></script>
</head>

<body topmargin="0" bottommargin="0">
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td height="7" colspan="2"></td>
  </tr>
  <tr> 
    <td colspan="2"><?php include "../core/header.php";?></td>
  </tr>
  <tr> 
    <td colspan="2"><table width="99%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="257" align="right" style="color:#000;">NAVIGATION <img src="../images/nav.jpg" align="absmiddle"></td>
    <td width="361" align="center" style="color:#000;">&nbsp;FAVOURITES <img src="../images/nav.jpg" width="260" height="2" align="absmiddle"></td>
    <td width="244" align="right" style="color:#000;">&nbsp;REMINDERS <img src="../images/nav.jpg" align="absmiddle"></td>
  </tr>
</table>
</td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">
	  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="3">
        
        <tr>
        <td width="31%" align="left" valign="top"><table width="257" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><img src="../images/spacer.gif" width="1" height="4"></td>
          </tr>
          <tr>
            <td><?php if(userHasRight($_SESSION['userid'], "45") || userHasRight($_SESSION['userid'], "49") || userHasRight($_SESSION['userid'], "131") || userHasRight($_SESSION['userid'], "159") || userHasRight($_SESSION['userid'], "65")){?>
              <table width="230" border="0" align="left" cellpadding="4" cellspacing="0" class="ottercellborder">
                <tr>
                  <td bgcolor="#010066" class="tabheadings">Administration and Human Resource</td>
                </tr>
                <tr>
                  <td align="center" valign="top" ><table width="220" border="0" align="center" cellpadding="4" cellspacing="0">
                    <tr>
                      <?php //if(userHasRight($_SESSION['userid'], "45")){?>
                      <td width="16" align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td width="188" align="left" valign="top"><a href="../hr/manageguards.php" title="Register, edit and delete guard details.">Manage Staff Details</a></td>
                      <?php //} ?>
                    </tr>
                    <tr>
                      <?php //if(userHasRight($_SESSION['userid'], "49")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../core/manageclients.php" title="Create new clients, edit and delete client details and add assignments for clients.">Manage Cients</a></td>
                      <?php //} ?>
                    </tr>
                    <tr>
                      <?php if(userHasRight($_SESSION['userid'], "131")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="manageusers.php"  title="Register new users, view, edit or delete user details.">Manage User Accounts</a></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../finance/manageguardloans.php" title="Create, approve/reject loan applications.">Manage Staff Debts</a></td>
                    </tr>
                    <tr valign="top">
                      <td align="right"><img src="../images/bulletstar.gif"  /></td>
                      <td><a href="../hr/manageleave.php" title="Manage, view, approve/reject leave applications">Manage Leave</a></td>
                    </tr>
                    <tr valign="top">
                      <td align="right"><img src="../images/bulletstar.gif"  /></td>
                      <td><a href="../hr/managepromotions.php" title="Change guard job positions.">Promotions</a></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="#" onClick="setDiv('../include/dashboardlinks.php?area=HR','dashboardlinks','','Loading...'); return false;"  title="Click here to see more links.">More Links &gt;&gt; </a></td>
                    </tr>
                  </table></td>
                </tr>
              </table>
              <?php } ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top"><?php if(userHasRight($_SESSION['userid'], "34")){?>
            <table width="230" border="0" cellpadding="4" cellspacing="0" class="ottercellborder">
              <tr>
                <td width="220" class="tabheadings">Operations 
                  Management</td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="220" border="0" align="center" cellpadding="4" cellspacing="0">
                    <tr>
                      <?php //if(userHasRight($_SESSION['userid'], "47")){?>
                      <td width="12" align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td width="149" align="left" valign="top"><a href="../core/manageassignments.php" title="Create new assignments, edit/delete assignments, post assignment overtime/replacement.">Manage Assignments </a></td>
                      <?php //} ?>
                    </tr>
                    <tr>
                      <?php //if(userHasRight($_SESSION['userid'], "47")){?>
                      <td width="12" align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td width="149" align="left" valign="top"><a href="../core/manageinspection.php" title="Create new inspection, edit/delete inspection..">Manage inspection records</a></td>
                      <?php //} ?>
                    </tr>
                    <tr>
                      <?php //if(userHasRight($_SESSION['userid'], "47")){?>
                      <td width="12" align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td width="149" align="left" valign="top"><a href="../core/supervision-report.php" title="Create new supervision, edit/delete supervision..">Manage monthly reports</a></td>
                      <?php //} ?>
                    </tr>
                    <tr>
                      <?php //if(userHasRight($_SESSION['userid'], "80")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../operations/index.php" title="Search for client, select assignments and generate their schedule for a specified week.">View/Generate Staff Schedules </a></td>
                      <?php //} ?>
                    </tr>
                    <tr>
                      <?php if(userHasRight($_SESSION['userid'], "95")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../operations/report.php?f=Control Shift" title="Generate control shift report for a specified date.">Generate Control Shift Reports </a></td>
                      <?php } ?>
                    </tr>
                    <tr>
                     <?php if(userHasRight($_SESSION['userid'], "170")){?>
					  <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../operations/appraisals.php" title="Manages guard's perfomance appraisal records.">Manage Perfomance Appraisals</a></td>
					  <?php } ?>
                    </tr>
					
                    <tr>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="#" onClick="setDiv('../include/dashboardlinks.php?area=operations','dashboardlinks','','Loading...'); return false;" title="Click here to see more links.">More Links &gt;&gt; </a></td>
                    </tr>
                </table></td>
              </tr>
            </table>
          <?php } ?></td>
      </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
      <tr>
        <td rowspan="4" align="left" valign="top"><?php if(userHasRight($_SESSION['userid'], "35")){?>
            <table class="ottercellborder" width="230" border="0" cellspacing="0" cellpadding="4">
              <tr>
                <td class="tabheadings">Inventory 
                  Management</td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="220" border="0" align="center" cellpadding="4" cellspacing="0">
                    <tr>
                      <?php if(userHasRight($_SESSION['userid'], "108") || userHasRight($_SESSION['userid'], "111")){?>
                      <td width="12" align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td width="149" align="left" valign="top"><a href="../inventory/inventorystock.php" title="Add new items, search items in inventory, edit and/or delete items.">Manage Inventory Stock </a></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <?php if(userHasRight($_SESSION['userid'], "116")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../inventory/itemissues.php" title="Issue items, search issued items, edit/delete item issues">Manage 
                        Item Issues </a></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <?php if(userHasRight($_SESSION['userid'], "120")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../inventory/itemissues.php?a=return" title="Return items, search returned items, edit/delete item returns">Manage 
                        Item Returns </a></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <?php if(userHasRight($_SESSION['userid'], "109")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../core/guardreport.php?f=Item Location" title="Generate a report about where items are at a particular time.">Track 
                        Stock Items (Reports) </a> </td>
                      <?php } ?>
                    </tr>
					 <tr>
                      <?php if(userHasRight($_SESSION['userid'], "166")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../inventory/manageitempurchases.php" title="Registers item purchases. Allows edit/delete of purchase records.">Manage Item Purchases</a></td>
                      <?php } ?>
                    </tr>
                </table></td>
              </tr>
            </table>
          <?php } ?></td>
          </tr>
		  <tr><td>&nbsp;</td></tr>
		  
      <tr></tr>
      <tr></tr>
		  <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
		  <tr>
            <td align="left" valign="top"><?php if(userHasRight($_SESSION['userid'], "79") || userHasRight($_SESSION['userid'], "81") || userHasRight($_SESSION['userid'], "82") || userHasRight($_SESSION['userid'], "83")){?>
              <table class="ottercellborder" width="230" border="0" cellspacing="0" cellpadding="4">
                <tr>
                  <td class="tabheadings">Finance 
                    and Accounting</td>
                </tr>
                <tr>
                  <td align="center" valign="top"><table width="220" border="0" align="center" cellpadding="4" cellspacing="0">
                      <tr>
                        <?php if(userHasRight($_SESSION['userid'], "79")){?>
                        <td width="12" align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                        <td width="149" align="left" valign="top"><a href="../finance/report.php?f=Client Invoice" title="Generate client Profoma Invoice report.">Generate 
                          profoma invoice</a></td>
                        <?php } ?>
                      </tr>
                      <tr>
                        <?php if(userHasRight($_SESSION['userid'], "88")){?>
                        <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                        <td align="left" valign="top"><a href="../finance/manageguardfinance.php" title="Includes guard claims (approved and not approved) as well as deductions">Guard financial status </a></td>
                        <?php } ?>
                      </tr>
                      <tr>
                        <?php if(userHasRight($_SESSION['userid'], "83")){?>
                        <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                        <td align="left" valign="top"><a href="../finance/report.php?f=Guard Payroll" title="Generate guard payroll report for a specified period of time.">Generate 
                          payroll for personnel salaries </a></td>
                        <?php } ?>
                      </tr>
                      <tr>
                        <?php if(userHasRight($_SESSION['userid'], "185")){?>
                        <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                        <td align="left" valign="top"><a href="../finance/managetransactions.php?t=<?php echo encryptValue("outflow");?>" title="Add, edit, search and delete general ledger entries.">Manage Ledger Entries </a> </td>
                        <?php } ?>
                      </tr>
                      <tr>
                        <?php if(userHasRight($_SESSION['userid'], "185")){?>
                        <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                        <td align="left" valign="top"><a href="../finance/managetransactions.php?t=<?php echo encryptValue("inflow");?>" title="Add, edit, search and delete financial inflow transactions.">Manage Transactions</a> </td>
                        <?php } ?>
                      </tr>
                      <tr>
                        <?php if(userHasRight($_SESSION['userid'], "199")){?>
                        <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                        <td align="left" valign="top"><a href="../finance/manageguardloans.php" title="Create, modify or delete staff debt applications.">Manage Staff Debts</a> </td>
                        <?php } ?>
                      </tr>
                      <tr>
                        <?php if(userHasRight($_SESSION['userid'], "200")){?>
                        <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                        <td align="left" valign="top"><a href="../finance/manageguardclaims.php" title="Create, modify or delete guard claims.">Manage Guard Claims</a> </td>
                        <?php } ?>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                        <td align="left" valign="top"><a href="#" onClick="setDiv('../include/dashboardlinks.php?area=morereports','dashboardlinks','','Loading...'); return false;" title="Click here to see links to custom reports">Custom reports &gt;&gt; </a></td>
                      </tr>
                  </table></td>
                </tr>
              </table>
              <?php } ?></td>
          </tr>
		  <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top"><?php if(userHasRight($_SESSION['userid'], "150") || userHasRight($_SESSION['userid'], "155") || userHasRight($_SESSION['userid'], "156") || userHasRight($_SESSION['userid'], "157") || userHasRight($_SESSION['userid'], "158")){?>
            <table class="ottercellborder" width="239" border="0" cellspacing="0" cellpadding="4">
              <tr>
                <td colspan="2" bgcolor="#010066" class="tabheadings">Transport 
                  Management</td>
              </tr>
              <tr>
                <?php if(userHasRight($_SESSION['userid'], "108") || userHasRight($_SESSION['userid'], "111")){?>
                <td width="12" align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                <td width="149" align="left" valign="top"><a href="../transport/managefueldistribution.php" title="Manage vehicle fuel distribution.">Fuel Distribution</a></td>
                <?php } ?>
              </tr>
              <tr>
                <?php if(userHasRight($_SESSION['userid'], "116")){?>
                <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                <td align="left" valign="top"><a href="../transport/managevehicleservice.php" title="Manage vehicle service details.">Service vehicles</a></td>
                <?php } ?>
              </tr>
              <tr>
                <?php if(userHasRight($_SESSION['userid'], "116")){?>
                <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                <td align="left" valign="top"><a href="../transport/index.php" title="Manage vehicle Daily log book.">Daily vehicle log </a></td>
                <?php } ?>
              </tr>
			  <tr>
                <?php if(userHasRight($_SESSION['userid'], "116")){?>
                <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                <td align="left" valign="top"><a href="../hr/manageguards.php?a=search&t=drivers" title="View all active drivers and commanders.">View all drivers and commanders</a></td>
                <?php } ?>
              </tr>
			  <tr>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="#" onClick="setDiv('../include/dashboardlinks.php?area=transport','dashboardlinks','','Loading...'); return false;" title="Click here to see more transport reports">More Reports &gt;&gt; </a></td>
                    </tr>
            </table>
          <?php } ?></td>
          </tr>
		  <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        <td width="69%" rowspan="7" valign="top">
            <table width="99%" border="0" align="right" cellpadding="4" cellspacing="0">
              
              <tr align="center" valign="top">
                <td width="321" align="left" valign="top"><div  id="dashboardlinks"><?php include('../include/dashboardlinks.php');?></div></td>
                <td width="241" align="right"><table cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="right"><a href="../core/reminders.php" title="View remiders that were archived"><img src="../images/archieve.jpg" border="0" /></a><a href="../settings/index.php" title="Send message to other user groups"><img src="../images/messages.jpg" alt="send msg" border="0"></a> </td>
                  </tr>
                  <tr valign="top">
                    <td width="239"><form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        
                        <tr>
                          <td><div style="padding:4px;width:230px;height:350px;overflow: auto">
                            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                              <?php 
						   $remindersresult = mysql_query("SELECT * FROM messages WHERE isactive = 'Y' ORDER BY date DESC");
						   while($line = mysql_fetch_array($remindersresult,MYSQL_ASSOC)){ 
						   		if(in_array($_SESSION['groups'],split(",",$line['sentto'])) || ($_SESSION['groups'] == "1" && trim($line['sentto']) == "")){
						   ?>
                              <tr>
                                <td width="5%" valign="top"><input type="checkbox" name="reminder[]" value="<?php echo $line['id'];?>"></td>
                                    <td width="95%" valign="top" style="color:""><b><?php echo date("d-M-Y",strtotime($line['date'])).":</b> ";
							  
							  
							  echo $line['reason'];?> - <?php 
							  $showstr = substr($line['details'],0,80);
							  //Make sure you dont break a link
							  if(preg_match("/<a /i",$showstr) && !preg_match("/</a> /i",$showstr)){
							  	 $showstr = substr($line['details'],0,(strpos($showstr,"<a ") - 1));
							  }
							  
							  echo $showstr;
							  if(strlen($line['details']) > 80){
							  	echo "...&nbsp;&nbsp;<a href=\"../settings/?id=".$line['id']."&sby=".$line['sentby']."&a=view\">Details</a>";
							  }
							  
							  if($line['sentby'] != ""){
							  	$name = getRowAsArray("SELECT firstname, lastname FROM users WHERE id='".$line['sentby']."'");
							  	echo  "<br>By ".$name['firstname']." ".$name['lastname'];
							  } else {
							  	echo "<br>System Generated";
							  }
							  ?> </b></td>
                                  </tr>
                              <?php 
						   		}
						   }?>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                                  </tr>
                              </table>
                                
                          </div></td>
                          </tr>
                        </table>   
					   <table width="80%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;<input name="archive" type="image" id="archive" value="archieve" src="../images/markarchieved.jpg"></td>
  </tr>
</table>

                      </form></td>
                  </tr>
                </table></td>
              </tr>
              
              <tr valign="top">
                <td colspan="2" align="left" height="49"></td>
              </tr>
          </table></td>
        </tr>
      
      <!--<tr>
        <td align="left" valign="top"><?php if(userHasRight($_SESSION['userid'], "47") || userHasRight($_SESSION['userid'], "80") || userHasRight($_SESSION['userid'], "95")){?>
            <table width="230" border="0" cellpadding="4" cellspacing="0" class="ottercellborder">
              <tr>
                <td width="220" bgcolor="#010066" class="tabheadings"><font color="#FFFFFF">Operations 
                  Management</font></td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="220" border="0" align="center" cellpadding="4" cellspacing="0">
                    <tr>
                      <td width="47" rowspan="4" align="center" valign="top"><img src="../images/customer.gif" width="57" height="50"></td>
                      <?php //if(userHasRight($_SESSION['userid'], "47")){?>
                      <td width="12" align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td width="149" align="left" valign="top"><a href="../core/manageassignments.php" class="normaltxt" title="Create new assignments, edit/delete assignments, post assignment overtime/replacement.">Manage assignments </a></td>
                      <?php //} ?>
                    </tr>
                    <tr>
                      <?php //if(userHasRight($_SESSION['userid'], "80")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../operations/index.php" class="normaltxt" title="Search for client, select assignments and generate their schedule for a specified week.">View client schedules </a></td>
                      <?php //} ?>
                    </tr>
                    <tr>
                      <?php //if(userHasRight($_SESSION['userid'], "95")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../operations/report.php?f=Control Shift" class="normaltxt" title="Generate control shift report for a specified date.">Generate control shift Reports </a></td>
                      <?php //} ?>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="#" class="normaltxt" onClick="setDiv('../include/dashboardlinks.php?area=operations','dashboardlinks','','Loading...'); return false;" title="Click here to see more links.">More links &gt;&gt; </a></td>
                    </tr>
                </table></td>
              </tr>
            </table>
          <?php } ?></td>
      </tr>-->
      <!--<tr>
        <td rowspan="2" align="left" valign="top"><?php if(userHasRight($_SESSION['userid'], "108") || userHasRight($_SESSION['userid'], "111") || userHasRight($_SESSION['userid'], "116") || userHasRight($_SESSION['userid'], "120") || userHasRight($_SESSION['userid'], "109") ){?>
            <table class="ottercellborder" width="230" border="0" cellspacing="0" cellpadding="4">
              <tr>
                <td bgcolor="#010066" class="tabheadings"><font color="#FFFFFF">Inventory 
                  Management</font></td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="220" border="0" align="center" cellpadding="4" cellspacing="0">
                    <tr>
                      <td width="47" rowspan="5" align="center" valign="top"><img src="../images/inventorymanagement.gif" width="47" height="42"></td>
                      <?php //if(userHasRight($_SESSION['userid'], "108") || userHasRight($_SESSION['userid'], "111")){?>
                      <td width="12" align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td width="149" align="left" valign="top"><a href="../inventory/inventorystock.php" class="normaltxt" title="Add new items, search items in inventory, edit and/or delete items.">Manage inventory stock </a></td>
                      <?php //} ?>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../inventory/manageitempurchases.php" class="normaltxt" title="Issue items, search issued items, edit/delete item issues">Manage 
                        item purchases </a></td>
                    </tr>
                    <tr>
                      <?php //if(userHasRight($_SESSION['userid'], "116")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../inventory/itemissues.php" class="normaltxt" title="Issue items, search issued items, edit/delete item issues">Manage 
                        item issues </a></td>
                      <?php //} ?>
                    </tr>
                    <tr>
                      <?php //if(userHasRight($_SESSION['userid'], "120")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../inventory/itemissues.php?a=return" class="normaltxt" title="Return items, search returned items, edit/delete item returns">Manage 
                        item returns </a></td>
                      <?php //} ?>
                    </tr>
                    <tr>
                      <?php //if(userHasRight($_SESSION['userid'], "109")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../core/guardreport.php?f=Item Location" class="normaltxt" title="Generate a report about where items are at a particular time.">Track 
                        stock items (Reports) </a> </td>
                      <?php //} ?>
                    </tr>
                </table></td>
              </tr>
            </table>
          <?php } ?></td>
      </tr>-->
      <!--<tr>
        <td>&nbsp;</td>
      </tr>-->
     
      <!--<tr>
        <td align="left" valign="top"><?php if(userHasRight($_SESSION['userid'], "145")){?>
            <table class="ottercellborder" width="230" border="0" cellspacing="0" cellpadding="4">
              <tr>
                <td bgcolor="#010066" class="tabheadings"><font color="#FFFFFF">Technical 
                  Management</font></td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="220" border="0" align="center" cellpadding="4" cellspacing="0">
                    <tr>
                      <td width="47" rowspan="5" align="center" valign="top"><img src="../images/technical2.jpg" width="47" height="42"></td>
                      <?php //if(userHasRight($_SESSION['userid'], "145") || userHasRight($_SESSION['userid'], "111")){?>
                      <td width="12" align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../technical/alarminstallations.php" class="normaltxt" title="Manage alarm installations.">Install Alarms</a></td
                      ><?php //} ?>
                    </tr>
                    <tr>
                      <?php //if(userHasRight($_SESSION['userid'], "146")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../technical/managealarminstallations.php" class="normaltxt" title="Manage installed alarms.">Alarms Installed</a></td>
                      <?php //} ?>
                    </tr>
                    <tr>
                      <?php //if(userHasRight($_SESSION['userid'], "147")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../technical/managealarminstallations.php?a=serviced" class="normaltxt" title="View serviced alarms.">Alarms Serviced </a></td>
                      <?php //} ?>
                    </tr>
                    <tr>
                      <?php //if(userHasRight($_SESSION['userid'], "149")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../technical/managealarminstallations.php?a=decommissioned" class="normaltxt" title="View decommisioned alarms."> Alarms Decommissioned</a></td>
                      <?php //} ?>
                    </tr>
                    <tr>
                      <?php //if(userHasRight($_SESSION['userid'], "148")){?>
                      <td align="right" valign="top"><img src="../images/bulletstar.gif" ></td>
                      <td align="left" valign="top"><a href="../technical/managealarminstallations.php?a=transfered" class="normaltxt" title="Manage alarm transfers.">Alarm Transfers </a></td>
                      <?php //} ?>
                    </tr>
                </table></td>
              </tr>
            </table>
          <?php } ?></td>
      </tr>-->
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
