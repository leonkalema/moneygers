<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_GET['id']) || isset($_GET['a'])){
	$action = $_GET['a'];
	$id = decryptValue($_GET['id']);
	
	if($action == "delete"){
		mysql_query("DELETE FROM transactions WHERE id = '".$id."'");
	}
}

if(isset($_GET['t'])){
	$type = decryptValue($_GET['t']);
} else {
	$type = "outflow";
}

if(isset($_GET['ia'])){
	$isactive = decryptValue($_GET['ia']);
} else {
	$isactive = "Y";
}

//Activate or de-activate the transactions
if(isset($_POST['activate'])){
	$formvalues = array_merge($_POST);
	for($i=0;$i<count($formvalues['transaction']);$i++){
		mysql_query("UPDATE transactions SET isactive='Y' WHERE id='".$formvalues['transaction'][$i]."'");
	}
	
	$_SESSION['msg'] = "The transactions you selected have been activated.";
	forwardToPage('../finance/managetransactions.php?t='.encryptValue($formvalues['transactiontype']).'&ia='.encryptValue("Y"));
}

//De-activate the transactions
if(isset($_POST['archive'])){
	
	$formvalues = array_merge($_POST);
	for($i=0;$i<count($formvalues['transaction']);$i++){
		mysql_query("UPDATE transactions SET isactive='N' WHERE id='".$formvalues['transaction'][$i]."'");
	}
	
	$_SESSION['msg'] = "The transactions you selected have been archived.";
	forwardToPage('../finance/managetransactions.php?t='.encryptValue($formvalues['transactiontype']).'&ia='.encryptValue("N"));
}


// Searching for specific transactions
if(isset($_GET['a']) && $_GET['a'] == "search"){
	$_SESSION['searchtransaction'] = trim($_GET['v']);
	
	$where = " AND particulars LIKE '%".$_SESSION['searchtransaction']."%' AND account = '".$_GET['type']."'";
}else {
	$where = "";
}

$query = "SELECT * FROM transactions WHERE type='".$type."' AND isactive='".$isactive."'".$where." ORDER BY date_of_entry DESC";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage <?php if($type == "outflow"){ echo "Ledger Entries";} else { echo "Transactions";}?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>

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
        <td class="headings">Manage <?php if($type == "outflow"){ echo "Ledger Entries";} else { echo "Transactions";}?></td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="managetransactions.php">
          <table width="100%" border="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><span class="label">
                <input type="button" name="newtransaction" value="Create New <?php if($type == "outflow"){ echo "Ledger Entry";} else { echo "Transaction";}?>" onClick="javascript:document.location.href='../finance/transaction.php?t=<?php echo $_GET['t'];?>'">
                <?php
			   if(isset($_POST['archive']) || ($isactive == "N")){
			   		if($type == "outflow"){ 
						echo "<a href=\"../finance/managetransactions.php?t=".$_GET['t']."\">View Active Ledger Entries</a>";
					} else { 
						echo "<a href=\"../finance/managetransactions.php?t=".$_GET['t']."\">View Active Transactions</a>";
					}
				
			   } else {
			   		if($type == "outflow"){ 
						echo "<a href=\"../finance/managetransactions.php?t=".$_GET['t']."&ia=".encryptValue("N")."\">View Archived Ledger Entries</a>";
					} else { 
						echo "<a href=\"../finance/managetransactions.php?t=".$_GET['t']."&ia=".encryptValue("N")."&a=archive\">View Archived Transactions</a>";
					}
			   
			   } ?>
              </span></td>
            </tr>
            <?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != ""){?>
            <tr>
              <td><br><br><b><font class="redtext"><?php echo $_SESSION['msg'];?></font></b></td>
            </tr>
            <?php 
				$_SESSION['msg'] = "";
			}?>
			<tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search Tr<span class="label">a</span>nsactions: </td>
                  <td><input name="searchtransaction" id="searchtransaction" type="text" size="20" value="<?php if(isset($_SESSION['searchtransaction'])){ echo $_SESSION['searchtransaction'];}?>"></td>
                  <td nowrap class="label">In Account:
                    <select name="type" id="type">
                        <?php 
					  if(isset($_GET['type'])){
							$name = $_GET['type'];
						} else {
							$name = "";
						}
					  echo generateSelectOptions(getAllAccounts($type), $name); ?>
                      </select>
                  </td>
                  <td><input type="button" name="Button" value="Search Transactions" onClick="pickFormItemTypeAndDirect('searchtransaction', '../finance/managetransactions.php?a=search&t=<?php echo encryptValue($type);?>&v=', 'Please enter the whole or part of the particulars.')"></td>
                </tr>
              </table></td>
            </tr>
			<tr>
              <td>&nbsp;</td>
            </tr>
			<tr>
			
            <?php
			if(howManyRows($query) == 0){          			
				if($type == "outflow"){ 
					echo "<tr><td>There are no Ledger Entries to display</td></tr>";
				}else {
					echo "<tr><td>There are no transactions to display</td></tr>";
				}
				
		   	} else { 
			?>
            <tr>
              <td><div style="padding:4px;width:720px;height:300px;overflow: auto">
                <table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
                    <tr class="tabheadings">
                      <td width="1%"></td>
                      <td width="7%">Edit</td>
                      <td width="13%">Delete</td>
                      <td width="13%">Particulars</td>
					  <td width="13%">Account</td>
                      <td width="21%">Amount</td>
                      <td width="18%">Date</td>
                      <td width="18%">Received By</td>
                      <?php if($type == "outflow"){ ?>
                      <td width="18%">Passed By</td>
                      <?php }?>
                      <td width="18%">Payment Form </td>
                    </tr>
                    <?php
			  // Display the transactions
			  $result = mysql_query($query);
			  $i = 0;
			   while($line=mysql_fetch_array($result, MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
                    <tr class="<?php echo $rowclass; ?>">
                      <td><input type="checkbox" id="transaction[]<?php echo $line['id']; ?>" name="transaction[]" value="<?php echo $line['id']; ?>"></td>
                      <td><a href="../finance/transaction.php?id=<?php echo encryptValue($line['id']); ?>&a=edit&t=<?php echo $_GET['t'];?>" class="normaltxtlink">Edit</a></td>
                      <td><a href="javascript:deleteEntity('../finance/managetransactions.php?id=<?php echo encryptValue($line['id']); ?>&a=delete&t=<?php echo $_GET['t'];?>', '<?php 
				if($type == "outflow"){
					echo "ledger entry";
				}else {
					echo "transaction";
				}
				?>', '<?php echo $line['particulars']; ?>')" class="normaltxtlink">Delete</a></td>
                      <td><?php echo $line['particulars']; ?></td>
					  <td><?php 
					  $accountdetails = getRowAsArray("SELECT * FROM accounts WHERE id='".$line['account']."'");
					  echo "<b>".$accountdetails['accountname']."</b>"; ?></td>
                      <td><?php echo commify($line['amount']); ?></td>
                      <td><?php 
				if($line['date_of_entry'] != "0000-00-00 00:00:00"){
					echo date("d-M-Y",strtotime($line['date_of_entry']));
				}
				?>
                      </td>
                      <td><?php echo $line['receivedby']; ?></td>
                      <?php if($type == "outflow"){ ?>
                      <td><?php echo $line['passedby']; ?></td>
                      <?php }?>
                      <td><?php echo $line['paymentform']; ?></td>
                    </tr>
                    <?php 
			  $i++;
			  } ?>
                  </table>
              </div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><input type="submit" <?php
		  		if($type == "outflow"){
					$viewvalue = "Ledger Entries";
		  		} else {
					$viewvalue = "Transactions";
				}
			   if($isactive == "N"){ echo "name=\"activate\" id=\"activate\" value=\"Activate ".$viewvalue."\""; } else { echo "name=\"archive\" id=\"archive\" value=\"Archive ".$viewvalue."\"";} 
			   ?>>
                <input type="hidden" name="transactiontype" id="transactiontype" value="<?php echo $type;?>"></td>
            </tr>
            <?php } ?>
          </table>
                </form>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
