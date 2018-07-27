<?php
include_once "../class/class.client.php";
session_start();

$client = new Client;
$client->delete($_GET['id']);
forwardToPage('../core/manageclients.php');
?>

