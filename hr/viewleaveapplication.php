<?php
include_once "../class/class.leaveapplication.php";
session_start();
$leaveapplication = new LeaveApplication;
$id=decryptValue($_GET['id']);
$leaveapplication->get($id);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - View Leave Application </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="750" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
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
        <td class="headings">View Leave Application</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td align="right" class="label">Guard ID: </td>
            <td>
              <?php echo $leaveapplication->getGuardId(); ?>            </td>
          </tr>
          <tr>
            <td align="right" class="label" valign="top">Leave Start Date:</td>
            <td><?php echo changeMySQLDateToPageFormat($leaveapplication->getLeaveStartDate()); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Leave End Date:</td>
            <td><?php echo changeMySQLDateToPageFormat($leaveapplication->getLeaveEndDate()); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Leave Type:</td>
            <td><?php echo $leaveapplication->getLeaveType(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Reason: </td>
            <td>
			<?php echo $leaveapplication->getReason();?>
			</td>
          </tr>
          
          <tr>
            <td align="right" class="label">Verified By: </td>
            <td><?php echo $leaveapplication->getVerifiedBy(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Date verified: </td>
            <td><?php echo changeMySQLDateToPageFormat($leaveapplication->getDateVerified()); ?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Employment Date: </td>
            <td><?php echo changeMySQLDateToPageFormat($leaveapplication->getEmploymentDate()); ?></td>
          </tr>
		  
		  <tr>
            <td align="right" class="label">Days Entitled Per Year: </td>
            <td><?php echo $leaveapplication->getDaysEntitledPerYear(); ?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Total Days Accumulated: </td>
            <td><?php echo $leaveapplication->getTotalDaysaccumulated(); ?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Date Of Operations Approval: </td>
            <td><?php echo changeMySQLDateToPageFormat($leaveapplication->getDateOfOperations()); ?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Date Of Payroll Clerk Approval: </td>
            <td><?php echo changeMySQLDateToPageFormat($leaveapplication->getDateOfPayrollClerkApproval()); ?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Date Of Human Resource Approval: </td>
            <td><?php echo changeMySQLDateToPageFormat($leaveapplication->getDateOfHumanResourceApproval()); ?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Advance Taken: </td>
            <td><?php echo $leaveapplication->getAdvanceTaken(); ?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Travel Allowances: </td>
            <td><?php echo $leaveapplication->getTravelAllowances(); ?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Staff Debt Taken: </td>
            <td><?php echo $leaveapplication->getLoanTaken(); ?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Total Payment Approved: </td>
            <td><?php echo $leaveapplication->getTotalPaymentApproved(); ?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Date Uniform Returned: </td>
            <td><?php echo changeMySQLDateToPageFormat($leaveapplication->getDateUniformReturned()); ?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Commences On: </td>
            <td><?php echo changeMySQLDateToPageFormat($leaveapplication->getCommencesOn()); ?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Terminates On: </td>
            <td><?php echo changeMySQLDateToPageFormat($leaveapplication->getTerminatesOn()); ?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Approval/Rejection Message: </td>
            <td><?php echo $leaveapplication->getApprovalMessage(); ?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Date Approved/Rejected: </td>
            <td><?php echo changeMySQLDateToPageFormat($leaveapplication->getDateApproved()); ?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Status:</td>
            <td><?php echo $leaveapplication->getStatus(); ?></td>
          </tr>
		
          <tr>
            <td align="right" class="label">Payroll Clerk Approved: </td>
            <td>
			<?php echo changeBinaryToPageValues($leaveapplication->payrollClerkApproved());?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Operations Approved: </td>
            <td>
			<?php echo changeBinaryToPageValues($leaveapplication->operationsApproved());?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Human Resouce Approved: </td>
            <td>
			<?php echo changeBinaryToPageValues($leaveapplication->humanResourceApproved());?></td>
          </tr>
		  <tr>
            <td align="right" class="label">Uniform Returned: </td>
            <td>
			<?php echo changeBinaryToPageValues($leaveapplication->uniformReturned());?></td>
          </tr>
		  
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label"><input type="button" name="returntolist" value="Manage Leave Application" onClick="javascript:document.location.href='../hr/manageleaveapplication.php'"></td>
            <td><span class="label">
              <input type="button" name="newuser" value="Create New Leave Application" onClick="javascript:document.location.href='../hr/leaveapplication.php'">
              <input type="button" name="editleaveapplication" value="Edit Leave Application" onClick="javascript:document.location.href='../hr/leaveapplication.php?id=<?php echo $_GET['id']; ?>&action=edit'">
            </span></td>
          </tr>

        </table>
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
