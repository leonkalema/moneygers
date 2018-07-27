<?php
include_once "../class/class.group.php";
session_start();

$group = new Group;
$group->delete($_GET['id']);
forwardToPage('../core/managegroups.php');
?>
