<?php
include_once "../class/class.user.php";
session_start();

$user = new User;
//decrypt GET id
$id=decryptValue($_GET['id']);

$user->delete($id);
forwardToPage('../core/manageusers.php');
?>
