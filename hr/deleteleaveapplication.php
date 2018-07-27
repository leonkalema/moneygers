<?php
include_once "../class/class.leaveapplication.php";
session_start();

$leaveapplication = new LeaveApplication;
$leaveapplication->delete($_GET['id']);
forwardToPage('../hr/manageleaveapplication.php');
?>

