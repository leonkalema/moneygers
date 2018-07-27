<?php
include_once "../class/class.region.php";
session_start();

$region = new Region;
$region->delete($_GET['id']);
forwardToPage('../core/manageregions.php');
?>
